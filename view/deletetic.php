<?php
include '../controller/ticketsC.php';
$ticketsC = new ticketsC();
$id_event = $_GET['Id_event'];
$ticketsC->supprimertic($_GET["Id_ticket"]);
header("Location: ticketadd.php?id=$id_event");
?>