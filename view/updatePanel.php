<?php

include_once('../controller/UserC.php');


$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($id);


$error = "";

// create client
$user = null;
// $imageData = file_get_contents('../img/homme.png');
// $imageBase64 = base64_encode($imageData);
// create an instance of the controller

if (
    isset($_POST["idUser"]) &&
    isset($_POST["lastName"]) &&
    isset($_POST["firstName"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"]) &&
    isset($_POST["dob"])

) {
    if (
        !empty($_POST["idUser"]) &&
        !empty($_POST['lastName']) &&
        !empty($_POST["firstName"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        !empty($_POST["dob"])
    ) {
        $MDP = md5($_POST['password']);
        $imageData = file_get_contents($_FILES['picture']['tmp_name']);
        $user = new User(
            $_POST['idUser'],
            $_POST['lastName'],
            $_POST['firstName'],
            $_POST['email'],
            $MDP,
            new DateTime($_POST['dob']),
            "",
            $imageData,
            "",
            ""
        );
        $id=$_POST["idUser"];
        $UserC->updateUser($user,$id);
        header('Location:AdminPanel.php');
    } else
        $error = "Missing information";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+icons+sharp">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/stylePanel.css">
    <link rel="stylesheet" href="../css/AdminCss.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function verif() {
            var email = document.forms["userForm"]["email"].value;
            var mdp = document.getElementById("mdp").value;
            var firstName = document.forms["userForm"]["firstName"].value;
            var lastName = document.forms["userForm"]["lastName"].value;
            var date = document.forms["userForm"]["dob"].value;
            var picture = document.forms["userForm"]["picture"].value;
            var letters = /^[A-Za-z]+$/;


            var YearNow = new Date().getFullYear();
            var d = new Date(date);
            if (!!d.valueOf()) {
                year = d.getFullYear();
            }

            if (firstName == "") {
                var prenomInput = document.getElementById("prenomDiv");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Veuillez entrer votre prenom!</p>";
                document.getElementById("msgFirstName").innerHTML = msg;
                return false;
            } else if (!(firstName.match(letters) && firstName.charAt(0).match(/^[A-Z]+$/))) {
                var prenomInput = document.getElementById("prenomDiv");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Veuillez entrer un prenom valid!</p>";
                document.getElementById("msgFirstName").innerHTML = msg;
                return false
            } else {
                var prenomInput = document.getElementById("prenomDiv");
                prenomInput.style.border = "1px solid green ";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Nom valid!</p>";
                document.getElementById("msgFirstName").innerHTML = msg;
            }

            if (lastName == "") {
                var nomInput = document.getElementById("nomDiv");
                nomInput.style.border = "1px solid red ";
                nomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Veuillez entrer votre nom!</p>";
                document.getElementById("msgLastName").innerHTML = msg;
                return false;
            } else if (!(lastName.match(letters) && lastName.charAt(0).match(/^[A-Z]+$/))) {
                var nomInput = document.getElementById("nomDiv");
                nomInput.style.border = "1px solid red ";
                nomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Veuillez entrer un nom valid!</p>";
                document.getElementById("msgLastName").innerHTML = msg;
                return false;
            } else {
                var nomInput = document.getElementById("nomDiv");
                nomInput.style.border = "1px solid green ";
                nomInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Nom valid!</p>";
                document.getElementById("msgLastName").innerHTML = msg;
            }

            if (email == "") {
                var emailInput = document.getElementById("emailDiv");
                emailInput.style.border = "1px solid red ";
                emailInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>veuillez entrer votre email.</p>";
                document.getElementById("msgEmail").innerHTML = msg;
                return false;
            } else if (!email.match('@gmail.com')) {
                var emailInput = document.getElementById("emailDiv");
                emailInput.style.border = "1px solid red";
                emailInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Verifiez votre email.</p>";
                document.getElementById("msgEmail").innerHTML = msg;
                return false;
            } else {
                var emailInput = document.getElementById("emailDiv");
                emailInput.style.border = "1px solid green";
                emailInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Email valid.</p>";
                document.getElementById("msgEmail").innerHTML = msg;
            }

            if (date == "") {
                var prenomInput = document.getElementById("dobDiv");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "20px";
                return false;
            } else if (YearNow - year < 10) {
                var prenomInput = document.getElementById("dobDiv");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Age non valid.</p>";
                document.getElementById("msgDate").innerHTML = msg;
                return false;
            } else {
                var prenomInput = document.getElementById("dobDiv");
                prenomInput.style.border = "1px solid green";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Age valid.</p>";
                document.getElementById("msgDate").innerHTML = msg;
            }

            if (picture == "") {
                var prenomInput = document.getElementById("picture");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>veuillez choisir une photo.</p>";
                document.getElementById("msgPicture").innerHTML = msg;
                return false;
            }else {
                var prenomInput = document.getElementById("picture");
                prenomInput.style.border = "1px solid green";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>photo valid.</p>";
                document.getElementById("msgPicture").innerHTML = msg;
            }


            if (mdp == "") {
                var mdpInput = document.getElementById("mdpDiv");
                mdpInput.style.border = "1px solid red";
                mdpInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>veuillez entrer votre mot de passe.</p>";
                document.getElementById("msg").innerHTML = msg;
                return false;
            } else if (mdp.match(/[0-9]/g) &&
                mdp.match(/[A-Z]/g) &&
                mdp.match(/[a-z]/g) &&
                mdp.match(/[^a-zA-Z\d]/g) &&
                mdp.length >= 10) {
                var mdpInput = document.getElementById("mdpDiv");
                mdpInput.style.border = "1px solid green";
                mdpInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Mot de passe fort.</p>";
                document.getElementById("msg").innerHTML = msg;
                return true;
            } else {
                var mdpInput = document.getElementById("mdpDiv");
                mdpInput.style.border = "1px solid red";
                mdpInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Mot de passe faible.</p>";
                document.getElementById("msg").innerHTML = msg;
                return false;
            }


        }
    </script>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">

                <img src="../img/logo2.png" alt="site-logo" class="site-logo" style="position: relative !important; right: 100px;">



                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">
                        close
                    </span>

                </div>
            </div>
            <div class="sidebar">
                <a href="TableauPanel.php">
                    <span class="material-symbols-sharp">
                        grid_view
                    </span>
                    <h3>Tableau de bord</h3>
                </a>
                <a href="MedecinPanel.php">
                    <span class="material-symbols-sharp">
                        clinical_notes
                    </span>
                    <h3>Medecin</h3>
                </a>
                <a href="ConsultationPanel.php">
                    <span class="material-symbols-sharp">
                        meeting_room
                    </span>
                    <h3>Consultation</h3>
                </a>
                <a href="PharamaciePanel.php">
                    <span class="material-symbols-sharp">
                        vaccines
                    </span>
                    <h3>Pharamacie</h3>
                </a>
                <a href="EvenementPanel.php">
                    <span class="material-symbols-sharp">
                        event
                    </span>
                    <h3>Evenement</h3>
                    <span class="message-count">26</span>
                </a> <a href="ArticlePanel.php">
                    <span class="material-symbols-sharp">
                        article
                    </span>
                    <h3>Article</h3>
                </a> <a href="AdminPanel.php" class="active">
                    <span class="material-symbols-sharp">
                        account_circle
                    </span>
                    <h3>Admin</h3>
                </a> <a href="ReclamationPanel.php">
                    <span class="material-symbols-sharp">
                        problem
                    </span>
                    <h3>Reclamation</h3>
                </a> <a href="ParametrePanel.php">
                    <span class="material-symbols-sharp">
                        settings
                    </span>
                    <h3>Paramètre</h3>
                </a>
                <a href="main.php">
                    <span class="material-symbols-sharp">
                        logout
                    </span>
                    <h3>Disconnecter</h3>
                </a>
            </div>
        </aside>
        <!----- end of aside -->
        <main>
        <?php
    // if (isset($_POST['idUser'])) {
        $user = $UserC->showUser($_POST['idUser']);

    ?>
            <div class="addUser-card1">
                <h1>Modifier les données d'un Utilisateurs:</h1>
                <form action="" class="sign-up-form" method="POST" name="userForm" enctype="multipart/form-data" oninput="return verif()">
                <div class="input-field1">
                    <i class="fas fa-user"></i>
                        <input type="text" placeholder="Id" name="idUser" value="<?php echo $user['ID']; ?>" />
                    </div>
                <div class="input-field1" id="prenomDiv">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="firstName" name="firstName" id="firstName"  value="<?php echo $user['FIRSTNAME']; ?>"/>
                    </div>
                    <span class="spanClass" id="msgFirstName"></span>

                    <div class="input-field1" id="nomDiv">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="lastName" name="lastName" id="lastName" value="<?php echo $user['LASTNAME']; ?>"/>
                    </div>
                    <span class="spanClass" id="msgLastName"></span>

                    <div class="input-field1" id="emailDiv">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" id="email" value="<?php echo $user['EMAIL']; ?>" />
                    </div>
                    <span class="spanClass" id="msgEmail"></span>

                    <div class="input-field1" id="dobDiv">
                        <i class="fas fa-user"></i>
                        <input style="margin-top: 15px;" type="date" placeholder="date of birth" name="dob" id="dob" "/>
                    </div>
                    <span class="spanClass" id="msgDate"></span>

                    <input id="picture" style="margin-left: 110px;" type="file" name="picture">
                    <span class="spanClass" id="msgPicture"></span>
                    <div class="input-field1" id="mdpDiv">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" id="mdp"  />
                    </div>
                    <span class="spanClass" id="msg"></span>

                    <button class="circular-button1" type="submit">
                    <img src="../img/cogwheel.png" style="width:30px; height: 30px;" alt="cogwheel.png">
                    </button>
                </form>
            </div>
            <?php
    //}
    ?>
        </main>
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-sharp">
                        menu
                    </span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">
                        light_mode
                    </span>
                    <span class="material-symbols-sharp">
                        dark_mode
                    </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Bonjour, <b>Ahmed</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="../img/profile-1.jpg">
                    </div>
                </div>
            </div>
            <!---END OF TOP-->
            <div class="recent-updates">
                <h2>notification</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../img/profile-2.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../img/profile-3.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../img/profile-4.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <!----END OF RECENT UPDATES-->
            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            shopping_cart
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Commandes en ligne</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            local_mall
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Commandes hors ligne</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>1100</h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            person
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>nouveaux clients</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="success">+25%</h5>
                        <h3>849</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div>
                        <span class="material-symbols-sharp">
                            add
                        </span>
                        <h3>Ajouter un produit</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/ScriptPanel.js"></script>
</body>

</html>