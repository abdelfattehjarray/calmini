<?php
require "../controller/coachC.php";
require "../model/coach.php";
require_once "../config.php";


$id=$_GET["idCoach"];
?>
<!-- crud avis-->
<?php
require "../controller/avisC.php";
require "../model/avis.php";
echo $id;
$avisC = new avisC();
//$listAvis = $avisC->displayAvis();

$listAvis = $avisC->displayAvis_de_chacun($id);
$updateAvis = NULL;

$idc="";


if(isset($_GET["removeAvis"])&&!empty($_GET["removeAvis"])){
    //$avisC->deleteAvis($_GET["removeAvis"]);
    $avisC->deleteAvis_decrement($id,$_GET["removeAvis"]);
    header("location: crud_avis.php?idCoach=$id");
}

if(isset($_POST)&&!empty($_POST)){
    if(isset($_GET["updateAvis"])&&!empty($_GET["updateAvis"])){
        $avis = new avis($_POST["commentaire"],new \DateTime($_POST["dateAvis"]), $_POST["evaluation"],$_POST["idTest"]);
        $avisC->updateAvis($_GET["updateAvis"], $avis);
        header("location:crud_avis.php?idCoach=$id"); 
    }
    else{
        $avis = new avis($_POST["commentaire"],new \DateTime($_POST["dateAvis"]), $_POST["evaluation"],$_POST["idTest"]);
       
        //$avisC->addAvis($avis);
        $avisC->nbreavis($_POST["idTest"],$avis);
        $idd = $_POST["idTest"];
        header("location: crud_avis.php?idCoach=$id");

        
    }  
  
    //header("location:http://localhost/web/view/crud_avis.php?idCoach=$id");
}

if(isset($_GET["updateAvis"])&&!empty($_GET["updateAvis"])){
    $updateAvis = $avisC->getAvisById($_GET["updateAvis"]);    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/achref_avis.css">
    
</head>
<style>
/* Center the main title */
h1 {
  text-align: center;
}

/* Style for the form and table containers */
.crudBoxa {
  margin: 20px auto;
  width: 80%;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
}

/* Style for the form */
.cudBoxa {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.inputs {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: none;
  border-bottom: 2px solid #ccc;
  font-size: 16px;
  font-family: 'Roboto', sans-serif;
}

#commentaire {
  height: 100px;
}

/* Style for the error messages */
#error_comment, #error_evaluation {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}

.avis_button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.avis_button:hover {
  background-color: #38b249;
}

/* Style for the table */
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
  font-size: 14px;
  font-family: 'Roboto', sans-serif;
}

th {
  background-color: #4CAF50;
  color: white;
  font-weight: 700;
  text-transform: uppercase;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Style for the buttons in the table */
.danger {
  background-color: #f44336; /* Red */
  border: none;
  color: white;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 2px;
  cursor: pointer;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.danger:hover {
  background-color: #e53935;
}

.primary {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 2px;
  cursor: pointer;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.primary:hover {
  background-color: #38b249;
}

.margin_affichage {
  margin-top: 50px;
}

</style>
<body>
<h1 style="text-align:center">Atelier CRUD PHP</h1>
    <h1>Ajouter un Avis</h1>
<div class="crudBoxa">
<div class="cudBoxa">
    <form method="POST" action="crud_avis.php?idCoach=<?php echo $id; ?><?= ($updateAvis !== NULL)? "&updateAvis=".$updateAvis["idAvis"]: ""; ?>">
           <textarea oninput="checkcomment(this)" value="" name="commentaire" class="inputs" placeholder="write your commentaire here ..." id="commentaire" cols="30" rows="5"><?= ($updateAvis !== NULL)? $updateAvis["commentaire"]: ""; ?></textarea>

           <br/><br/>
    <span id="error_comment"></span>
    <br/>
              <input type="text"  oninput="checkevaluation(this)" value="<?= ($updateAvis !== NULL)? $updateAvis["evaluation"]: ""; ?>" name="evaluation" class="inputs" placeholder="write your evaluation here ..." id="evaluation"><br/><br/>
    
            <span id="error_evaluation"></span>
   <br>
   <input name="idTest" value="<?php echo $id; ?>" hidden> 
              
         <!--<input type="hidden" value=<?=$id?> name="test">-->
              <input type="submit" class="avis_button" name="avis_button" id="avis_button" value="<?= ($updateAvis === NULL)?'Ajouter Avis': 'Update Avis' ?>"/>
    </form>
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
                    <button class="primary" onclick="updateAvis(<?= $listAvis[$i]['idAvis']; ?>)">Update</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div >
 </div>  
 </div >
 </div>  

    <script>
     
    const removeAvis = (id) => {
        location.href = `crud_avis.php?removeAvis=${id}&idCoach=<?php echo $id; ?>`
    }
    const updateAvis = (id) => {
        location.href = `crud_avis.php?updateAvis=${id}&idCoach=<?php echo $id; ?>`
    }
    </script>
     <script src="../js/controle_saisie_front.js"></script>
</body>
</html>