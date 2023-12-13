
<?php
include '../controller/ArticleC.php';
include_once("../config.php");

$articleC = new ArticleC();
$articleC->deleteArticle($_GET["IdArticle"]);
header('Location: ArticlesClient.php');
?>