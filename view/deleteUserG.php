<?php
include '../controller/UserC.php';
$UserC = new UserC();
$UserC->deleteUserG($_GET["idUser"]);
header('Location:AdminPanel.php');

?>
