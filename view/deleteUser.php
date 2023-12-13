<?php
include '../controller/UserC.php';
$UserC = new UserC();
$UserC->deleteUser($_GET["idUser"]);
header('Location:AdminPanel.php');

?>
