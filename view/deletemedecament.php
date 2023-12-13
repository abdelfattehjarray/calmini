<?php
include '../controller/pharmacieC.php';
$pharmacieC = new pharmacieC();
$var = $_GET['id'];

$pharmacieC->supprimermed($_GET["num"]);
header("Location: pharmacieAdd.php?id=$var");
?>