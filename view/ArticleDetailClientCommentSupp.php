<?php
include '../controller/CommenterC.php';
include '../config.php';

$commenterC = new CommenterC();
$IdArticle=$_GET["IdArticle"];
$commenterC->deleteCommenter($_GET["IdCommenter"]);
header("Location:ArticleDetailClient.php?IdArticle=$IdArticle");
?>