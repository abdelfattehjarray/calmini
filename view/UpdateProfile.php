<?php
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id = $_SESSION["iduser"];
// create client
$user = null;
$imageData = file_get_contents($_FILES['picture']['tmp_name']);
// create an instance of the controller
$mdp=md5($_POST['password']);
$UserC = new UserC();
        $user = new User(
            $id,
            $_POST['lastName'],
            $_POST['firstName'],
            $_POST['email'],
            $mdp,
            new DateTime($_POST['dob']),
            "",
            $imageData,
            $_POST['location'],
            $_POST['profession']
        );
        $UserC->updateUser($user,$id);
        $UserC->addImage($imageData,$id);
        header('Location:profile.php');


?>