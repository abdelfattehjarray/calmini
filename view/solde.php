<?php
include '../controller/evenementC.php';


$id = $_GET["id"];
$evenementC = new EvenementC();
$evenementC->setSolde($id,1);
echo ("<SCRIPT LANGUAGE='JavaScript'>
           window.alert('Votre evenement est sous solde : 20% !')
           window.location.href='EvenementPanel.php';
       </SCRIPT>");
?>