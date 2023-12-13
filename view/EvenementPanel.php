<?php 
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($id);


include '../controller/evenementC.php';
include '../vendor/autoload.php';

use Twilio\Rest\Client;

$error='';
$EvenementC = new EvenementC();
 // $listepharmacie = $pharmacieC->afficherpharmacie();
  if(isset($_POST["type"]))
{
if($_POST["type"] == "search"){
    $listeevent = $EvenementC->afficherEventRecherche($_POST["search"]);
  }
  else if($_POST["type"] == "tri"){
    $listeevent = $EvenementC->afficherEventtri();
  }
}
  else
  $listeevent = $EvenementC->afficherEvent();
if (
    isset($_POST["Title"]) &&
    isset($_POST["date_deb"]) &&
    isset($_POST["date_fin"])&&
    isset($_POST["Adresse"]) &&
    isset($_POST["Organisateurs"])&&
    isset($_POST["cout"])&&
    isset($_POST["Tags"])&&
    isset($_POST["Image"])&&
    isset($_POST["quantite"])
) {
        $title  =  $_POST['Title'];
        $date_deb  =  $_POST['date_deb'];
        $org  =  $_POST['Organisateurs'];
        $Evenement = new Evenement(
            $_POST['Title'],
            $_POST['date_deb'],
            $_POST['date_fin'],
            $_POST['Adresse'],
            $_POST['Organisateurs'],
            $_POST['cout'],
            $_POST['Tags'],
            $_POST['Image'],
            $_POST['quantite']
        );
        $EvenementC->AjouterEvenement($Evenement);
   /*     $sid = "AC8c2dd76aa78bccb26d32d678115b17f9";
        $token = "b0e1214d992b133894c5e843955f26db";
    //    $twilio = new Client($sid, $token);

     //   $message = $twilio->messages
                  ->create("+21624262449", // to
                           [
                               "body" => "Vous Avez ajouter un evénement : Title : $title | Date Début : $date_deb | Organisateurs : $org , CALMINI",
                               "from" => "+16076383594"
                           ]
                  );

        print($message->sid);*/
        header('Location: EvenementPanel.php');

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
<link rel="stylesheet" href="../css/styleJarray.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
                <a href="MedecinPanel.php">
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
                <a href="EvenementPanel.php"  class="active">
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
        <main class="mai">
            <form  class="forum" action="" method="POST" id="myForm">
                <h2>Add New Evenement</h2>
                <div class="form-group">
                  <label for="Title">Title de Evenement</label>
                  <input type="text" id="title" name="Title" >
                  <span id="titleerror"></span>
                </div>
                <div class="form-group">
                <label for="date_deb">Date debut de Evenement</label>
                <input type="date" id="date_deb" name="date_deb" >
                <span id="datedeberror"></span>
                </div>
                <div class="form-group">
                <label for="date_fin">Date fin de Evenement</label>
                <input type="date" id="date_fin" name="date_fin" >
                <span id="datefinerror"></span>
                </div>
                <div class="form-group">
                  <label for="Title">adresse</label>
                  <input type="text" id="adresse" name="Adresse" >
                  <span id="adresseerror"></span>
                </div>
                <div class="form-group">
                  <label for="Title">Oraganisateurs</label>
                  <input type="text" id="organisateurs" name="Organisateurs" >
                  <span id="orgerror"></span>
                </div>
                <div class="form-group">
                  <label for="Title">Cout</label>
                  <input type="text" id="cout" name="cout" >
                 
                  <span id="couterror"></span>

                </div>
                <div class="form-group">
                  <label for="Title">tags</label>
                  <input type="text" id="tags" name="Tags" >
                  <span id="tagserror"></span>
                </div>
                <div class="form-group">
                  <label for="Title">Quantité ticket</label>
                  <input  type="text" id="quantite" name="quantite" >
                  <span id="quantiteerror"></span>
                </div>
                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" id="image" name="Image">
                  <span id="imgerror"></span>
                </div>
                <button type="submit">Submit</button>
              </form>
              <script>

let myForm = document.getElementById('myForm');


myForm.addEventListener('submit' , function(e){
    let mytitle = document.getElementById('title');
    let mydate_deb = document.getElementById('date_deb');
    let mydate_fin = document.getElementById('date_fin');
    let myadresse = document.getElementById('adresse');
    let myorg = document.getElementById('organisateurs');
    let mycout = document.getElementById('cout');
    let mytags = document.getElementById('tags');
    let myimg = document.getElementById('image');


    
  if(mytitle.value =='')
  {
    let error = document.getElementById('titleerror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
  if(mydate_deb.value =='')
  {
    let error = document.getElementById('datedeberror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
  if(mydate_fin.value =='')
  {
    let error = document.getElementById('datefinerror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
  if(myadresse.value =='')
  {
    let error = document.getElementById('adresseerror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
  if(myorg.value =='')
  {
    let error = document.getElementById('orgerror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
  if(mycout.value =='')
  {
    let error = document.getElementById('couterror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
  if(mytags.value =='')
  {
    let error = document.getElementById('tagserror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
  if(myimg.value =='')
  {
    let error = document.getElementById('imgerror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
 
 
 
})

      </script>

              <section class="recent-articles">
                <h2>Recent evenement</h2>
                <form action="" method="POST">
             
    <input type="text" id="search-field" placeholder="Search..." name="search">
    <button type="submit" name="type" value="search">
search
                    </button>     
                     <button type="submit" name="type" value="tri">
tri
                    </button>  

</form>
  <ul class="article-list">
  <?php
  
    foreach ($listeevent as $Evenement) {
     ?>

    <li>

        <div class="article-info">
       
            <h3><?php echo $Evenement['Title']; ?></h3>

            <div class="actions">
            <a href="deletepage.php?Id_ticket=<?php echo $Evenement['Id_event']; ?>" >  <i class="fas fa-trash ">    </i>
            </a>
            <a href="updatepage.php?Id_ticket=<?php echo $Evenement['Id_event']; ?>" >  <i class="fas fa-edit ">    </i> 
            </a>
            </a>
            <a href="solde.php?id=<?php echo $Evenement['Id_event']; ?>" > <i class="fas fa-percent "></i> 
            </a>
            <a href="ticketadd.php?id=<?php echo $Evenement['Id_event']; ?>" >  consulter </a>
  </div>
  
            <span class="article-date">Cout : <?php echo $Evenement['cout']; ?></span>
            <span class="article-date">Adresse : <?php echo $Evenement['Adresse']; ?></span>
            <span class="article-date">Tags : <?php echo $Evenement['Tags']; ?></span>
            <span class="article-date">Quantité : <?php echo $Evenement['quantite']; ?></span>
            <?php if($Evenement['solde'] == 0){ ?>
            <span class="article-date"><?php echo "Solde : NON";?></span>
            <?php } 
            else{
            ?>
            <span class="article-date"><?php echo "Solde : OUI";?></span>
          </div>
          <?php } ?>
        <div class="article-image">
          <img src="../img/<?php echo $Evenement['Image']; ?>" alt="Article 1">
        </div>
 

    </li>
    <?php
    }?>
  </ul>
              </section>
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
        </div>
    </div>
    <script src="../js/ScriptPanel.js"></script>
</body>
</html>