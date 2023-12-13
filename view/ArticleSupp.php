
<?php
include_once("../config.php");

include '../controller/ArticleC.php';
$articleC = new ArticleC();
$articleC->deleteArticle($_GET["IdArticle"]);
header('Location: ArticlePanel.php');
?>