<?php
include '../controller/CategorieC.php';
$CategorieC = new CategorieC();
$CategorieC->supprimercategorie($_GET["num"]);
header('Location: PharamaciePanel.php');
?>