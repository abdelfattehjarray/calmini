<?php

include '../controller/rendez_vousC.php';
$clientC = new ClientC();
$clientC->deleterendezvous($_GET["id"]);
header('Location:ListClients.php');


?>