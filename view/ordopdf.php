






<?php 
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$user=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($user);

?>


<?php
require('vendor/autoload.php');
include_once ('../controller/rendez_vousC.php');



$id = $_POST['id'];
$db=config::getConnexion();
if(isset($_SESSION['iduser'])){
   $user = $_SESSION['iduser'];
}else{
   $user = '';
};

$id = $_POST['id'];
$db = config::getConnexion();
$sql = "SELECT user.firstName AS patient_prenom, user.lastName AS patient_nom,user.EMAIL AS patient_email, coach.prenomcoach AS doctor_prenom, coach.idcoach AS id_doc, coach.nomcoach AS doctor_nom, coach.specialite AS doctor_specialite, l_rendezvous.calendrier as rendezvousc, l_rendezvous.id, l_rendezvous.etat, ordonnance.id_rendezvous, ordonnance.nbrjour, ordonnance.nbrfois, ordonnance.id as idordo
  FROM l_rendezvous
  INNER JOIN user ON l_rendezvous.id_user = user.id
  INNER JOIN coach ON l_rendezvous.id_doc = coach.idcoach
  INNER JOIN ordonnance ON l_rendezvous.id = ordonnance.id_rendezvous
  
  WHERE ordonnance.id = $id";
$result = $db->query($sql);
$list = $result->fetchAll();
$html=''
?>




<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>A simple, clean, and responsive HTML invoice template</title>
        
        <link rel="stylesheet" type="text/css" href="assets/css/invoice.css">
    </head>
    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                    <?php if (is_array($list)): ?>
      <?php foreach ($list as $client): ?>
        <form method="post" action="genpdf.php">
        <table>
                            <tr>
                                <td class="title">
                                <img src="../img/logo2.png" alt="site-logo"  style="width:100%; max-width:300px;">
                                </td>
        
                                <td>
                                    Invoice #: <?php echo $client['patient_nom'];?> <input type="hidden" name="patient_nom" id="patient_nom"  placeholder="email" value=  "<?php echo $client['patient_nom'];?>"><br>
                                   
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                            
                                
                                <td><?php echo $_SESSION['iduser'];?><input type="hidden" name="iduser" id="iduser"  placeholder="iduser" value=  "<?php echo $_SESSION['iduser'];?>"><br>
                                <?php echo $client['patient_email'];?><input type="hidden" name="patient_email" id="patient_email"  placeholder="patient_email" value=  "<?php echo $client['patient_email'];?>"> <?php echo $client['patient_nom'];?><input type="hidden" name="patient_nom" id="patient_nom"  placeholder="email" value=  "<?php echo $client['patient_nom'];?>"><br><br>
                                  
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                
                
                <tr class="heading">
                    <td>
                       liste des medicament
                    </td>
                    
                    <td>
                        #
                    </td>
                </tr>
                
                <tr class="item">
                    <td>
                        nbrfois
                    </td>
                    
                    <td>
                    <?php echo $client['nbrfois'];?> <input type="hidden" name="nbrfois" id="nbrfois"  placeholder="nbrfois" value=  "<?php echo $client['nbrfois'];?>"><br>
                    </td>
                </tr>
                
                <tr class="item">
                    <td>
                        nbrjour
                    </td>
                    
                    <td>
                    <?php echo $client['nbrjour'];?> <input type="hidden" name="nbrjour" id="nbrjour"  placeholder="nbrjour" value=  "<?php echo $client['nbrjour'];?>"><br>
                       
                    </td>
                </tr>

                <button>Generate PDF</button>
                <?php endforeach; ?>
    <?php endif; ?>
                
                
                
            </table>
            </form>
        </div>
        <style>
            /* Set box sizing to border-box for all elements */
* {
  box-sizing: border-box;
}

/* Style the invoice box */
.invoice-box {
  max-width: 800px;
  margin: auto;
  border: 1px solid #ccc;
  padding: 20px;
  font-size: 16px;
  line-height: 24px;
  font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
  color: #555;
}

/* Style the header section */
.invoice-box table {
  width: 100%;
  line-height: inherit;
  text-align: left;
}

.invoice-box table td {
  padding: 5px;
  vertical-align: top;
}

/* Style the header image */
.site-logo {
  height: auto;
  max-width: 100%;
}

/* Style the invoice information section */
.information {
  background-color: #f5f5f5;
}

/* Style the heading row of the items section */
.heading {
  background-color: #eee;
  font-weight: bold;
}

/* Style the item rows */
.item td {
  border-bottom: 1px solid #eee;
}

/* Style the total row */
.total td {
  border-top: 2px solid #eee;
  font-weight: bold;
}

/* Set the media queries for responsive design */
@media only screen and (max-width: 600px) {
  .invoice-box table tr.top table td {
    width: 100%;
    display: block;
    text-align: center;
  }
  
  .invoice-box table tr.information table td {
    width: 100%;
    display: block;
    text-align: center;
  }
}
        </style>