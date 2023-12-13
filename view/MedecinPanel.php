<?php 
include_once('../controller/UserC.php');
require "../controller/coachC.php";
require "../model/coach.php";
require_once "configagenda.php";
include "phpqrcode/qrlib.php";
include 'vendor/autoload.php';
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($id);

$coachC = new coachC();

if(!isset($_POST['tri'])){
  $listCoachs= $coachC->displaycoachs();}
  else{
    
  $listCoachs= $coachC->trisCoach($_POST["tri"]);
}

$updateCoach = NULL;
if(isset($_GET["removeCoach"])&&!empty($_GET["removeCoach"])){
    $coachC->deleteCoach($_GET["removeCoach"]);
    header('location:MedecinPanel.php');
}

if(isset($_POST["btncrud"])&&!empty($_POST["btncrud"])){
    if(isset($_GET["updateCoach"])&&!empty($_GET["updateCoach"])){
         //QRcode
$qrCodeText =$_POST["nomCoach"] ."-".$_POST["prenomCoach"]."-".$_POST["tel"]. "CALMINI";
$location="../qrcode/". $qrCodeText.".png";
QRcode::png($qrCodeText,$location);
   //QRcode
        $coach = new coach($_POST["nomCoach"], $_POST["prenomCoach"], $_POST["tel"],$_POST["mail"],$_POST["specialite"],$_POST["experience"],$_POST["details"],$_POST["image"],$qrCodeText);
        $coachC->updateCoach($_GET["updateCoach"], $coach);
    }
    else{
     //QRcode
$qrCodeText =$_POST["nomCoach"] ."-".$_POST["prenomCoach"]."-".$_POST["tel"]. "CALMINI";
$location="../qrcode/". $qrCodeText.".png";
QRcode::png($qrCodeText,$location);
   //QRcode
        $coach = new coach($_POST["nomCoach"], $_POST["prenomCoach"], $_POST["tel"],$_POST["mail"],$_POST["specialite"],$_POST["experience"],$_POST["details"],$_POST["image"],$qrCodeText);
        $coachC->addCoach($coach);
    }  
    header('location:MedecinPanel.php');
}

if(isset($_GET["updateCoach"])&&!empty($_GET["updateCoach"])){
    $updateCoach = $coachC->getCoachById($_GET["updateCoach"]);    
}

?>
<?php
//bar chart

$db = config::getConnexion();
$q1= $db->query("SELECT * FROM coach WHERE 2>=experience");
$q1->execute();
$c1=count($q1->fetchAll());
$q2= $db->query("SELECT * FROM coach WHERE experience between 3 and 5");
$q2->execute();
$c2=count($q2->fetchAll());
$q3= $db->query("SELECT * FROM coach WHERE experience between 6 and 10");
$q3->execute();
$c3=count($q3->fetchAll());


$q4= $db->query("SELECT * FROM coach WHERE experience between 11 and 15");
$q4->execute();
$c4=count($q4->fetchAll());

$q5= $db->query("SELECT * FROM coach WHERE experience>=15");
$q5->execute();
$c5=count($q5->fetchAll());
//pie chart

$qb1= $db->query("SELECT * FROM coach WHERE specialite = 'nutritionniste'");
$qb1->execute();
$cb1=count($qb1->fetchAll());
$qb2= $db->query("SELECT * FROM coach WHERE specialite = 'Therapist'");
$qb2->execute();
$cb2=count($qb2->fetchAll());
$qb3= $db->query("SELECT * FROM coach WHERE specialite = 'entraineur'");
$qb3->execute();
$cb3=count($qb3->fetchAll());




?>    
   <?php
require "../controller/avisC.php";
require "../model/avis.php";
//echo $id;
$avisC = new avisC();
$listAvis = $avisC->displayAvis();

//$listAvis = $avisC->displayAvis_de_chacun($id);
$updateAvis = NULL;

//$idc="";


if(isset($_GET["removeAvis"])&&!empty($_GET["removeAvis"])){
   $avisC->deleteAvis($_GET["removeAvis"]);
    //$avisC->deleteAvis_decrement($_GET["idCoacha"],$_GET["removeAvis"]);
    header("location:MedecinPanel.php");
}

if(isset($_POST["avis_button"])&&!empty($_POST["avis_button"])){
 
        $avis = new avis($_POST["commentaire"],new \DateTime($_POST["dateAvis"]), $_POST["evaluation"],$_POST["idCoacha"]);
       
        //$avisC->addAvis($avis);
        $avisC->nbreavis($_POST["idCoacha"],$avis);
        $idd = $_POST["idTest"];
        

        
     
    header("location:MedecinPanel.php");
}



?>        
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try</title>
    
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+icons+sharp">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="../css/stylePanel.css">
<link rel="stylesheet" href="../css/achref.css">

<link rel="stylesheet" href="../css/achref_avis.css">
<link rel="stylesheet" href="../css/chatbot.css">
<link rel="stylesheet" href="../chatbot/style.css">

<script src="../js/filter.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/CSS/bootsrap.css"/>

</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
            <img src="../img/logo2.png" alt="site-logo" class="site-logo" style="position: relative !important; right: 100px;">

                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">
                        close
                        </span>

                </div>
            </div>
            <div class="sidebar">
                <a href="TableauPanel.php"  >
                    <span class="material-symbols-sharp">
                        grid_view
                        </span>
                        <h3>Tableau de bord</h3>
                </a>
                <a href="MedecinPanel.php" class="active">
                    <span class="material-symbols-sharp">
                        clinical_notes
                        </span>
                        <h3>Medecin</h3>
                </a>
                <a href="ConsultationPanel.php">
                    <span class="material-symbols-sharp">
                        meeting_room
                        </span>
                        <h3>Consultation</h3>
                </a>
                <a href="ordonnoncePanel.php">
                    <span class="material-symbols-sharp">
                        vaccines
                        </span>
                        <h3>ordonnonce</h3>
                </a>
                <a href="PharamaciePanel.php">
                    <span class="material-symbols-sharp">
                        vaccines
                        </span>
                        <h3>Pharamacie</h3>
                </a>
                <a href="EvenementPanel.php">
                    <span class="material-symbols-sharp">
                        event
                        </span>
                        <h3>Evenement</h3>
                        <span class="message-count">26</span>
                </a> <a href="ArticlePanel.php">
                    <span class="material-symbols-sharp">
                        article
                        </span>
                        <h3>Article</h3>
                </a> <a href="AdminPanel.php">
                    <span class="material-symbols-sharp">
                        account_circle
                        </span>
                        <h3>Admin</h3>
                </a> <a href="ReclamationPanel.php">
                    <span class="material-symbols-sharp">
                        problem
                        </span>
                        <h3>Reclamation</h3>
                </a> <a href="ParametrePanel.php">
                    <span class="material-symbols-sharp">
                        settings
                        </span>
                        <h3>Paramètre</h3>
                </a>
                <a href="main.php">
                    <span class="material-symbols-sharp">
                        logout
                        </span>
                        <h3>Disconnecter</h3>
                </a>
            </div>
        </aside>
        <!----- end of aside -->
        <main>
        <div class="crudBox">
        <h1 ><?= ($updateCoach === NULL) ? 'Ajouter Coach' : 'Modifier Coach' ?></h1>
        <br>
<div class="cudBox">


<!-- debut formulaire achref-->
<form method="POST" action="MedecinPanel.php<?= ($updateCoach !== NULL)? "?updateCoach=".$updateCoach["idCoach"]: ""; ?>">
<table>
                                      <!-- prenom coach control saisie-->
    <tr>
<input type="text" autocomplete="none" value="<?= ($updateCoach !== NULL)? $updateCoach["nomCoach"]: ""; ?>" class="input" name="nomCoach" placeholder="Nom Coach" id="nomCoach" onkeydown="checkName(this)"><br/><br/>
</tr>
<tr >
<span id="error_nomCoach"></span>
</tr>
<tr >
<span></span>  
</tr>
                                       <!-- prenom coach control saisie-->
<tr>
<input type="text" autocomplete="none" value="<?= ($updateCoach !== NULL)? $updateCoach["prenomCoach"]: ""; ?>" class="input" name="prenomCoach" placeholder="Prenom Coach" id="prenomCoach" onkeydown="checkPrenom(this)"><br/><br/>
</tr>
<tr >
<span id="error_prenomCoach"></span>
</tr>
<tr >
<span></span> 
</tr>

  <!-- tel coach control saisie-->

<tr>
<input type="text"  autocomplete="none"value="<?= ($updateCoach !== NULL)? $updateCoach["tel"]: ""; ?>" name="tel"class="input"  placeholder="telephone" id="tel" onkeydown="checkTel(this)"><br/><br/>
</tr>

<tr >
<span id="error_tel"></span>
</tr>
<tr >
<span></span>  
</tr>

<!-- tel coach control saisie-->

<tr>
<input type="text"  autocomplete="none" value="<?= ($updateCoach !== NULL)? $updateCoach["mail"]: ""; ?>" name="mail" class="input" placeholder="mail" id="mail" onkeydown="checkmail(this)"><br/><br/>
</tr>
<tr >
<span id="error_mail"></span>
<br>
</tr>

<tr >
<span></span>   
</tr>

<!-- specialite coach control saisie-->



<tr>
<select name="specialite" id="specialite" class="input" onclick="checkspecialite(this)">
<option value="">Select your specialite</option>
<option value="Therapist" <?= ($updateCoach !== NULL && $updateCoach["specialite"] == "Therapist")? "selected": ""; ?>>Therapist</option>
<option value="entraineur" <?= ($updateCoach !== NULL && $updateCoach["specialite"] == "entraineur")? "selected": ""; ?>>entraineur</option>
<option value="nutritionniste" <?= ($updateCoach !== NULL && $updateCoach["specialite"] == "nutritionniste")? "selected": ""; ?>>nutritionniste</option>
</select><br/><br/>
</tr>

<tr >
<span id="error_specialite"></span>
</tr>
<tr >
<span></span>   
</tr>

<!-- specialite coach control saisie-->

<tr>
<input type="text"  autocomplete="none" value="<?= ($updateCoach !== NULL)? $updateCoach["experience"]: ""; ?>" class="input" name="experience" placeholder="Experience" id="experience" onkeydown="checkexperience(this)"><br/><br/>
</tr> 

<tr >
<span id="error_experience"></span>
</tr>
<tr >
<span></span>  
</tr>

<!-- details coach control saisie-->

<tr>
<textarea class="input" id="btn" cols="30" rows="10" name="details" placeholder="details" onkeydown="checkdetails(this)"><?= ($updateCoach !== NULL)? $updateCoach["details"]: ""; ?></textarea><br/><br/>
</tr>

<tr >
<span id="error_details"> </span>
</tr>
<tr >
<span></span>  
</tr>
<input type="file" id="image" name="image" value="<?= ($updateCoach !== NULL)? $updateCoach["image"]: ""; ?>"/>
<!-- fin control saisie control saisie-->
<tr> 
    <br>
<input type="submit" name="btncrud" class="submit-button"value="<?= ($updateCoach === NULL)?'Ajouter coach': 'Update coach' ?>"/>


<input type="reset" class="submit-button" id="resetBtn" value="Annuler"/>

</tr>
</table>

</form>      
<!--fin formulaire-->
</div>
<!--Add charts -->
<div class="graphBox">

 <div class="box">
  <canvas id="barChart" ></canvas>                 
 </div>
 <br>
  <div class="box1">
<canvas id="pieChart"></canvas> 
  </div>

</div>
</div>
<!--***************************************************************************************************-->

<br>
<!--***************************************************************************************************-->

<div class="crudBox">

<br>
<div class="margin_affichage">
<div class="recent-orders">


<h1>Liste des Coachs</h1>
    <!--   afficher-->
    <br><br>
    <!-- Form with a select input for sorting -->

    <form method="post" action="">
    <select name="tri" class="input" id="tri">
  <option value="">Tri par defaut</option>
  <option value="nomCoach" <?php  $tri_choi="nomCoach"; ?>>nomCoach</option>
  <option value="prenomCoach" <?php  $tri_choi="prenomCoach"; ?>>prenomCoach</option>
  <option value="specialite" <?php  $tri_choi="specialite"; ?>>specialite</option>
  <option value="experience" <?php  $tri_choi="experience"; ?>>experience</option>

  </select>
  <input type="submit" name="btntri" class="submit-button" value="Trier">
</form>
     
     <!-- <form method="GET" action="MedecinPanel.php">
                  </form> -->
                  <input type="text" class="recherche" name="" id="myInput" placeholder="cherhcer" oninput="searchFun()"> 


<div>
<table border="1" id="myTable">

<thead>
    <th col-index=1>id Coach</th>

    <th col-index=2>nomCoach <br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>

    <th col-index=3>prenomCoach<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
    </th>

    <th col-index=4>tel<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>

    <th col-index=5>mail<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>

    <th col-index=6>specialite<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>
    <th col-index=7>experience<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>
    <th >Détails
        
    </th>
    <th >QRcode
        
    </th>
    <th >Actions
        
        </th>


</thead>
<tbody>
<?php
for ($i = 0; $i < count($listCoachs); $i++) {
?>
<tr>
    <td><?= $listCoachs[$i]["idCoach"]; ?></td>
    <td><?= $listCoachs[$i]["nomCoach"]; ?></td>
    <td><?= $listCoachs[$i]["prenomCoach"]; ?></td>
    <td><?= $listCoachs[$i]["tel"]; ?></td>
    <td><?= $listCoachs[$i]["mail"]; ?></td>
    <td><?= $listCoachs[$i]["specialite"]; ?></td>
    <td><?= $listCoachs[$i]["experience"]; ?></td>
    <td><?= $listCoachs[$i]["details"]; ?></td>
    <td><img src="../qrcode/<?= $listCoachs[$i]["codecoach"]?>.png"></td>

    <td><button class="danger" onclick="removeCoach(<?= $listCoachs[$i]['idCoach']; ?>)">Supprimer</button>
    <button class="primary" onclick="updateCoach(<?= $listCoachs[$i]['idCoach']; ?>)">Update</button></td>
</tr>
<?php } ?>
</tbody>
</table>


</div>

</div>
<!---->
<br>
<br>
<style>
.cudBox2 {
  position:relative ;
     /*couleur du groupe box*/
    padding:20px;
    width: 100%;/* group box largeur // */
box-shadow: 0 7px 25px rgba(0,0,0,0.08);
border-radius: 20px;
min-width:500px;
min-height:400px;
background:#fff;
align-items: center;
margin-right: -60px;
/* margin-left: 150px; */
}
</style>


<div class="cudBox2">
<br>
    <h2 align="center">
        <a href="#">
            Full Calendar
        </a>
    </h2>
    <br>
<div id="calendar">
 </div>
</div>

<br>
<br>


 <!--  *****************************************************************crud avis-->
 <h1>Ajouter un Avis</h1>
 <br>
<br>
<div class="graphBox">
<div class="box1">
    <form method="POST" action="MedecinPanel.php">
    <textarea oninput="checkcomment(this)" value="" name="commentaire" class="inputavis_back " placeholder="write your commentaire here ..." id="commentaire" cols="30" rows="5"></textarea>

                                   <br/><br/>
                                   <span id="error_comment"></span>
                                     <br/>
              <input type="text"  oninput="checkevaluation(this)"  name="evaluation" class="inputavis_back " placeholder="write your evaluation here ..." id="evaluation"><br/><br/>
    
                                  <span id="error_evaluation"></span>
                                           <br>
                                 <input name="idTest" value="<?php echo $id; ?>" hidden> 
                                  <input type="text"    name="idCoacha" class="inputavis_back" placeholder="idCoacha" id="idCoacha"><br/><br/>

         <!--<input type="hidden" value=<?=$id?> name="test">-->
              <input type="submit" class="submit-button" name="avis_button" id="avis_button" value="Ajouter Avis"/>
    </form>
  </div>
  </div>
</div >
</div >


<br>
<br>
<div class="margin_affichage">
<div class="recent-orders">
<div class="crudBoxa">
<div class="rboxa">
<h1>Liste des Avis</h1> 
<br>
<br>
    <table border="1">
        <thead>
            <th>id Avis</th>
            <th>Commentaire</th>
            <th>dateavis</th>
            <th>evaluation</th>
            <th>idCoach</th>
            <th>action</th>
            
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($listAvis); $i++) {
            ?>
                <tr>
                    <td><?= $listAvis[$i]["idAvis"]; ?></td>
                    <td><?= $listAvis[$i]["commentaire"]; ?></td>
                    <td><?= $listAvis[$i]["dateAvis"]; ?></td>
                    <td><?= $listAvis[$i]["evaluation"]; ?></td>
                    <td><?= $listAvis[$i]["idCoach"]; ?></td>
                    <td><button class="danger" onclick="removeAvis(<?= $listAvis[$i]['idAvis']; ?>)">Supprimer</button>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div >
 </div>  
 </div >
 </div>  


<!--  *****************************************************************fin  crud avis-->

 
    <a href="calendar.php">
            <iframe id="calendar" 
                title="Inline Frame Example"
                width="650"
                height="600"
                src="calendar.php">
            </iframe>
    </a>
    <a href="calendar.php" class="calendar">
          <span class="material-symbols-outlined">
            calendar_month
          </span>
    </a>
    
    <a href="chatbot.php">
          
    </a>
    <a href="chatbot.php" class="chatbot">
          <span class="material-symbols-outlined">
           chatbot
          </span>
    </a>



        </main>
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-sharp">
                        menu
                        </span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">
                        light_mode
                        </span>
                    <span class="material-symbols-sharp">
                        dark_mode
                        </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Bonjour, <b><?php echo $nomUser["FIRSTNAME"] ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                    <img  src="data:image/png;base64,<?php echo base64_encode($nomUser["PICTURE"]); ?>">
                    </div>
                </div>
            </div>
            <!---END OF TOP-->
            <div class="recent-updates">
                <h2>notification</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../img/profile-2.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../img/profile-3.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../img/profile-4.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <!----END OF RECENT UPDATES-->
            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            shopping_cart
                            </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Commandes en ligne</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div> 
                <div class="item offline">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            local_mall
                            </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Commandes hors ligne</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>1100</h3>
                    </div>
                </div>   
                <div class="item customers">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            person
                            </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>nouveaux clients</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="success">+25%</h5>
                        <h3>849</h3>
                    </div>
                </div>   
                <div class="item add-product">
                    <div>
                        <span class="material-symbols-sharp">
                            add
                            </span> 
                        <h3>Ajouter un produit</h3>
                    
                    </div>
                </div>               
            </div>
            <div class="qrscanner"><a href="scannerqrcode/qrscanner.php" ><img src="../img/qrcode.png"></a></div>
            <div class="qrscanner"><a href="zoom.php" ><img src="../img/zoom.png"></a></div>
           
        </div>
    </div>
    <script src="../js/ScriptPanel.js"></script>
    <script>

/*recherche function */

            function searchFun() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        // loop through all the td elements of the current row
        for (j = 0; j < tr[i].cells.length; j++) {
            td = tr[i].cells[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break; // exit the loop if a match is found
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}
            /*retourner a la meme page de crud */

    const removeCoach = (id) => {
        location.href = `MedecinPanel.php?removeCoach=${id}`
    }
    const updateCoach = (id) => {
        location.href = `MedecinPanel.php?updateCoach=${id}`
    }
                  /*filtrer*/
    window.onload = () => {
                console.log(document.querySelector("#myTable > tbody > tr:nth-child(1) > td:nth-child(2) ")
                    .innerHTML);
            };

            getUniqueValuesFromColumn()
    </script>
    <script src="../js/index.js"></script>
   <!--js stat scripts --> 
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

   <script >
    var c1 = "<?php echo $c1; ?>";
    var c2 = "<?php echo $c2; ?>";
    var c3 = "<?php echo $c3; ?>";
    var c4 = "<?php echo $c4; ?>";
    var c5 = "<?php echo $c5; ?>";
    console.log(c1);
    console.log(c2);
    console.log(c3);
    console.log(c4);
    console.log(c5);

/* bar chart*/ 
var ctx = document.getElementById('barChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Débutant', 'Junior ', 'Intermédiaire ', 'Avancé ', 'Expert'],
        datasets: [{
            label: 'Niveau d\'experience',
            data: [c1, c2, c3, c4, c5],
            backgroundColor: [
                'rgba(255, 99, 132, 0.4)',
                'rgba(54, 162, 235, 0.4)',
                'rgba(255, 206, 86, 0.4)',
                'rgba(75, 192, 192, 0.4)',
                'rgba(153, 102, 255, 0.4)',
                'rgba(255, 159, 64,0.4)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235,0.5)',
                'rgba(255, 206, 86,0.5)',
                'rgba(75, 192, 192,0.5)',
                'rgba(153, 102, 255,0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


var cb1 = "<?php echo $cb1; ?>";
    var cb2 = "<?php echo $cb2; ?>";
    var cb3 = "<?php echo $cb3; ?>";

/* bar chart*/ 
var cty = document.getElementById('pieChart').getContext('2d');
var myChart = new Chart(cty, {
    type: 'polarArea',
    data: {
        labels: ['nutritionniste', 'therapist', 'entraineur'],
        datasets: [{
            label: 'specialite',
            data: [cb1, cb2, cb3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
   </script>
   <!--controle de saisie des inputs-->
   <script src="../js/controle_saisie.js"></script>
   <script>
     
    const removeAvis = (id) => {
        location.href = `MedecinPanel.php?removeAvis=${id}`
    }
    
    </script>
     <script src="../js/controle_saisie_front.js"></script>
     <!--****************** calendar-->

     <script src="https:cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function(){
            var calendar =  $("#calendar").fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events:'loadCalendar.php',
                selectable:true,
                selectHelper:true,
                select:function(start,end,allDay){
                    var title = prompt("enter event title");
                    if(title){
                        var start = $.fullCalendar.formatDate(start,"Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url:'insertCalendar.php',
                            type:'POST',
                            data: {
                                title:title,
                                start:start,
                                end:end  
                            },success:function(){
                                calendar.fullCalendar('refetchEvents');
                                alert("added successfully");
                            }
                        })

                    }
                },
                eventClick:function(event){
                    if(confirm("Are you sure you want to remove it?")){
                      var id = event.id;
                      $.ajax({
                        url:'deleteCalendar.php',
                        method:'POST',
                        data:{id:id},
                        success:function(){
                            calendar.fullCalendar('refetchEvents');
                            alert("deleted successfully");
                        }
                      })  
                    }
                },
                eventResize:function(event){
                    var start = $.fullCalendar.formatDate(start,"Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:'updateCalendar.php',
                        method:'POST',
                        data:{
                            start:start,
                            end:end,
                            id:id
                        },
                        success:function(data){
                            calendar.fullCalendar('refetchEvents');
                            alert("updated successfully");

                        }

                      })
                },
                eventColor: '#6B8E23',
                eventDrop: function(event, start, end) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                    url: 'updateCalendar.php',
                    method: 'POST',
                        data: {
                        title:title,
                        start: start,
                        end: end,
                        id: id
                        },
                    success: function(data) {
                    calendar.fullCalendar('refetchEvents');
                    alert("updated successfully");
        }
    })
}



            })
        })
    </script>
  <script src="../chatbot/app.js"></script>
</body>
</html>