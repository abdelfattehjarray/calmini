<?php

require_once "configagenda.php";

if(isset($_POST['id'])){
    try {
        $id = $_POST['id']; // retrieve the value of 'id'
        $sql = "DELETE FROM agenda WHERE id = ?";
        $db = configagenda::getConnexion();
        $query = $db->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        
    } catch (Exception $e) {
        die('Error: '.$e->getMessage());
    }
    
}
?>
