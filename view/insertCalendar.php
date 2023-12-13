<?php

require_once "configagenda.php";


if(isset($_POST['title'])){
    $sql = "INSERT INTO agenda (title,start_coach,end_coach	)
    VALUES(:title,:start_coach,:end_coach)";
    $db = configagenda::getConnexion();
    $query = $db->prepare($sql);
    $query->bindValue('title', $_POST['title']);
    $query->bindValue('start_coach', $_POST['start']);
    $query->bindValue('end_coach', $_POST['end']);
    $query->execute();
    
    
}
?>