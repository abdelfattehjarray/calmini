<?php
include_once ('../controller/rendez_vousC.php');


    $id = $_GET['id'];
    $rendezvous = new ClientC();
    $result = $rendezvous->deleterendezvous($id);

    header('Location: mesrendezvous.php');

?>