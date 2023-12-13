<?php

include_once "../config.php";
include '../controller/UserC.php';
$error = '';
$UserC = new UserC();

$msg = "";
if (
    isset($_POST["firstName"]) &&
    isset($_POST["lastName"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"]) &&
    isset($_POST["dob"])
) {
    if (
        !empty($_POST['firstName']) &&
        !empty($_POST["lastName"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        !empty($_POST["dob"])
    ) {
        $user = new User(
            null,
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['email'],
            $_POST['password'],
            new DateTime($_POST['dob']),
            md5(rand())
        );
        $return = $UserC->addUser($user);
        if ($return) {
            //echo '<script>alert("WELLCOME!") </script>';
        } else {
            //$msg = "<div class='alert alert-danger'>email already used</div>";
        }
    } else
        $error = "Missing information";
}

?>