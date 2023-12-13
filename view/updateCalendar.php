<?php


require_once "configagenda.php";


if(isset($_POST['title'])){

  $sql ="
  UPDATE agenda SET title=:title,start_coach=:start_coach,end_coach=:end_coach WHERE id=:id
  ";
  $db = configagenda::getConnexion();
  $query = $db->prepare($sql);
  $query->bindValue('title', $_POST['title']);
  $query->bindValue('start_coach', $_POST['start']);
  $query->bindValue('end_coach', $_POST['end']);
  $query->bindValue(':id', $_POST['id']);
  $query->execute();  
}
?>
