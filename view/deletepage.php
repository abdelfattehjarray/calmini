<?php
include '../controller/evenementC.php';
$EvenementC = new EvenementC();
$EvenementC->supprimerEvenement($_GET["Id_ticket"]);
header('Location: EvenementPanel.php');
?>