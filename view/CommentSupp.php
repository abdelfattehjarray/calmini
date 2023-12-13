
<?php
include '../controller/CommenterC.php';
include '../config.php';
include_once("../config.php");

$commenterC = new CommenterC();
$IdArticle=$_GET["IdArticle"];
$commenterC->deleteCommenter($_GET["IdCommenter"]);
header("Location: ArticleMod.php?IdArticle=$IdArticle");
?>