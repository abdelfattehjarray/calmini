<?php

include('../controller/UserC.php');
include('../view/search.php');
$UserC = new UserC();


session_start();
$id = $_SESSION["iduser"];
$nomUser = $UserC->recupererNomA($id);

$imageData = file_get_contents('../img/homme.png');
// $imageBase64 = base64_encode($imageData);
$user = null;

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
        $MDP = md5($_POST['password']);
        $user = new User(
            null,
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
        $UserC->addUser1($user);
        header('Location:AdminPanel.php');
    } else
        $error = "Missing information";
}
if (
    isset($_POST["firstNameA"]) &&
    isset($_POST["lastNameA"]) &&
    isset($_POST["emailA"]) &&
    isset($_POST["passwordA"]) &&
    isset($_POST["dobA"])
) {
    if (
        !empty($_POST['firstNameA']) &&
        !empty($_POST["lastNameA"]) &&
        !empty($_POST["emailA"]) &&
        !empty($_POST["passwordA"]) &&
        !empty($_POST["dobA"])
    ) {
        $MDP = md5($_POST['passwordA']);
        $imageData = file_get_contents($_FILES['picture']['tmp_name']);
        $user = new User(
            null,
            $_POST['lastNameA'],
            $_POST['firstNameA'],
            $_POST['emailA'],
            $MDP,
            new DateTime($_POST['dobA']),
            "",
            $imageData,
            "",
            ""
        );
        $UserC->addAdmin($user);
        header('Location:AdminPanel.php');
    } else
        $error = "Missing information";
}
$bar = "";
if (isset($_GET["barre"])) {

    if (!empty($_GET["barre"])) {
        $list = $UserC->searchUser($_GET["barre"]);
    }
}
if (!empty($_POST['sort'])) {
    $selected = $_POST['sort'];
    $list = $UserC->sortUser($selected);
}
$tab5 = array();
$tab4 = array();
$tab3 = array();
$tab2 = array();
$tab1 = array();
$list1 = $UserC->extractYear();
foreach ($list1 as $data) {
    $annee = $data['DOB'];
    $aujourdhui = date("Y-m-d");
    $diff = date_diff(date_create($annee), date_create($aujourdhui));
    $age = $diff->format('%y');
    $age = intval($age);
    echo '<script>console.log(' . $age . ')</script>';


    if ($age < 18) {
        array_push($tab1, $age);
    } elseif ($age >= 18 && $age <= 25) {
        array_push($tab2, $age);
    } elseif ($age > 25 && $age <= 30) {
        array_push($tab3, $age);
    } elseif ($age > 30 && $age <= 35) {
        array_push($tab4, $age);
    } else {
        array_push($tab5, $age);
    }
}
$var1 = count($tab1);
$var2 = count($tab2);
$var3 = count($tab3);
$var4 = count($tab4);
$var5 = count($tab5);
// print_r($tab1);
// print_r($tab2);
// print_r($tab3);
// print_r($tab4);
// print_r($tab5);
// echo $var1;
// echo $var2;
// echo $var3;
// echo $var4;
// echo $var5;

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

    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="../view/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/AdminCss.css">
    <script type="text/javascript">
        function verif() {
            var email = document.forms["userForm"]["email"].value;
            var mdp = document.getElementById("mdp").value;
            var firstName = document.forms["userForm"]["firstName"].value;
            var lastName = document.forms["userForm"]["lastName"].value;
            var date = document.forms["userForm"]["dob"].value;
            
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
            var letters = /^[A-Za-z]+$/;

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
            var email = document.forms["userForm"]["email"].value;
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
    <script type="text/javascript">
        function verifA() {
            //Ajout admin
            var email = document.forms["userFormA"]["emailA"].value;
            var mdp = document.getElementById("mdpA").value;
            var firstName = document.forms["userFormA"]["firstNameA"].value;
            var lastName = document.forms["userFormA"]["lastNameA"].value;
            var date = document.forms["userFormA"]["dobA"].value;
            var picture = document.forms["userFormA"]["picture"].value;
            var letters = /^[A-Za-z]+$/;
            var YearNow = new Date().getFullYear();
            var d = new Date(date);
            if (!!d.valueOf()) {
                year = d.getFullYear();
            }


            if (firstName == "") {
                var prenomInput = document.getElementById("prenomDivA");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Veuillez entrer votre prenom!</p>";
                document.getElementById("msgFirstNameA").innerHTML = msg;
                return false;
            } else if (!(firstName.match(letters) && firstName.charAt(0).match(/^[A-Z]+$/))) {
                var prenomInput = document.getElementById("prenomDivA");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Veuillez entrer un prenom valid!</p>";
                document.getElementById("msgFirstNameA").innerHTML = msg;
                return false
            } else {
                var prenomInput = document.getElementById("prenomDivA");
                prenomInput.style.border = "1px solid green ";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Nom valid!</p>";
                document.getElementById("msgFirstNameA").innerHTML = msg;
            }
            var letters = /^[A-Za-z]+$/;

            if (lastName == "") {
                var nomInput = document.getElementById("nomDivA");
                nomInput.style.border = "1px solid red ";
                nomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Veuillez entrer votre nom!</p>";
                document.getElementById("msgLastNameA").innerHTML = msg;
                return false;
            } else if (!(lastName.match(letters) && lastName.charAt(0).match(/^[A-Z]+$/))) {
                var nomInput = document.getElementById("nomDivA");
                nomInput.style.border = "1px solid red ";
                nomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Veuillez entrer un nom valid!</p>";
                document.getElementById("msgLastNameA").innerHTML = msg;
                return false;
            } else {
                var nomInput = document.getElementById("nomDivA");
                nomInput.style.border = "1px solid green ";
                nomInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Nom valid!</p>";
                document.getElementById("msgLastNameA").innerHTML = msg;
            }
            var email = document.forms["userFormA"]["emailA"].value;
            if (email == "") {
                var emailInput = document.getElementById("emailDivA");
                emailInput.style.border = "1px solid red ";
                emailInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>veuillez entrer votre email.</p>";
                document.getElementById("msgEmailA").innerHTML = msg;
                return false;
            } else if (!email.match('@gmail.com')) {
                var emailInput = document.getElementById("emailDivA");
                emailInput.style.border = "1px solid red";
                emailInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Verifiez votre email.</p>";
                document.getElementById("msgEmailA").innerHTML = msg;
                return false;
            } else {
                var emailInput = document.getElementById("emailDivA");
                emailInput.style.border = "1px solid green";
                emailInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Email valid.</p>";
                document.getElementById("msgEmailA").innerHTML = msg;
            }

            if (date == "") {
                var prenomInput = document.getElementById("dobDivA");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "20px";
                return false;
            } else if (YearNow - year < 10) {
                var prenomInput = document.getElementById("dobDivA");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Age non valid.</p>";
                document.getElementById("msgDateA").innerHTML = msg;
                return false;
            } else {
                var prenomInput = document.getElementById("dobDivA");
                prenomInput.style.border = "1px solid green";
                prenomInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Age valid.</p>";
                document.getElementById("msgDateA").innerHTML = msg;
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
                var mdpInput = document.getElementById("mdpDivA");
                mdpInput.style.border = "1px solid red";
                mdpInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>veuillez entrer votre mot de passe.</p>";
                document.getElementById("msgA").innerHTML = msg;
                return false;
            } else if (mdp.match(/[0-9]/g) &&
                mdp.match(/[A-Z]/g) &&
                mdp.match(/[a-z]/g) &&
                mdp.match(/[^a-zA-Z\d]/g) &&
                mdp.length >= 10) {
                var mdpInput = document.getElementById("mdpDivA");
                mdpInput.style.border = "1px solid green";
                mdpInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Mot de passe fort.</p>";
                document.getElementById("msgA").innerHTML = msg;
                return true;
            } else {
                var mdpInput = document.getElementById("mdpDivA");
                mdpInput.style.border = "1px solid red";
                mdpInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Mot de passe faible.</p>";
                document.getElementById("msgA").innerHTML = msg;
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
                <a href="ordonnoncePanel.php">
                    <span class="material-symbols-sharp">
                        vaccines
                        </span>
                        <h3>ordonnonce</h3>
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
            <div class="addUser-card" id="card">
                <h1>Ajouter une nouvelle personnes:</h1>
                <form action="" class="sign-up-form" method="POST" name="userForm" oninput="return verif()">
                    <div class="input-field" id="prenomDiv">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="firstName" name="firstName" id="firstName" />
                    </div>
                    <span class="spanClass" id="msgFirstName"></span>

                    <div class="input-field" id="nomDiv">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="lastName" name="lastName" id="lastName" />
                    </div>
                    <span class="spanClass" id="msgLastName"></span>

                    <div class="input-field" id="emailDiv">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" id="email" />
                    </div>
                    <span class="spanClass" id="msgEmail"></span>

                    <div class="input-field" id="dobDiv">
                        <i class="fas fa-user"></i>
                        <input style="margin-top: 15px;" type="date" placeholder="date of birth" name="dob" id="dob" />
                    </div>
                    <span class="spanClass" id="msgDate"></span>

                    <div class="input-field" id="mdpDiv">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" id="mdp" />
                    </div>
                    <span class="spanClass" id="msg"></span>

                    <button class="circular-button" type="submit">
                        <span class="plus-symbol">+</span>
                    </button>
                </form>

            </div>
            <div class="addUser-card2" id="cardA">
                <h1>Ajouter un nouvel admin:</h1>
                <form action="" class="sign-up-form" method="POST" name="userFormA" enctype="multipart/form-data" oninput="return verifA()">
                    <div class="input-field" id="prenomDivA">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="firstName" name="firstNameA" id="firstNameA" />
                    </div>
                    <span class="spanClass" id="msgFirstNameA"></span>

                    <div class="input-field" id="nomDivA">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="lastName" name="lastNameA" id="lastNameA" />
                    </div>
                    <span class="spanClass" id="msgLastNameA"></span>

                    <div class="input-field" id="emailDivA">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="emailA" id="emailA" />
                    </div>
                    <span class="spanClass" id="msgEmailA"></span>

                    <div class="input-field" id="dobDivA">
                        <i class="fas fa-user"></i>
                        <input style="margin-top: 15px;" type="date" placeholder="date of birth" name="dobA" id="dobA" />
                    </div>
                    <span class="spanClass" id="msgDateA"></span>
                    <input id="picture" style="margin-left: 260px;" type="file" name="picture">
                    <span class="spanClass" id="msgPicture"></span>
                    <div class="input-field" id="mdpDivA">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="passwordA" id="mdpA" />
                    </div>

                    <span class="spanClass" id="msgA"></span>

                    <button class="circular-button" type="submit">
                        <span class="plus-symbol">+</span>
                    </button>
                </form>

            </div>
            <br>
            <h1>Liste des Utilisateurs CALMINI et Google:</h1>
            <div class="search-bar">
                <form action="" method="get" class="search-box">
                    <label for="search-input" class="visually-hidden"></label>
                    <input type="text" id="search-input" placeholder="Rechercher" name="barre" value="<?php echo $bar; ?>">
                    <button type="submit" class="search-button">
                        <img src="../img/search.png" alt="Rechercher">
                    </button>
                </form>
            </div>

            <!-- <form action="" method="POST">
                <select class="select-custom" name="sort">
                    <option value="ID">ID</option>
                    <option value="LASTNAME">LastName</option>
                    <option value="FIRSTNAME">FirstName</option>
                </select>
                <input style=" display:flex; float:right; margin-top:8px; margin-right:12px; width: 25px; height:25px;" type="image" name="submitS" src="../img/reload (1).png">
            </form> -->
            <div id="output" style="display: block;"></div>

            <script>
                $(document).ready(function() {
                    $('#search-input').keyup(function() {
                        let input = $(this).val();
                        if (input != "") {
                            $.ajax({
                                url: "search.php",
                                type: "POST",
                                data: {
                                    input: input
                                },
                                success: function(date) {
                                    $("#output").html(date);
                                    $("#output").css("display", "block");
                                    //$(".user-card").css("display","none");
                                }
                            })
                        } else {
                            $("#output").css("display", "none");
                        }
                        // $(".user-card").css("display","none");
                        // $("#output").css("display","block");
                    })

                })
            </script>
            <br>
            <!-- <div>
                <form action="" method="POST">
                    <button class="select-custom" name="show">Show Users</button>
                </form>
            </div> -->
            <?php //if (isset($_POST["show"])) {
                $list = $UserC->listUser();
                $listG = $UserC->listUserG();
            ?>
            <?php foreach ($list as $user) : ?>
                <div class="user-card" id="trah">

                    <img id="userImage" src="data:image/png;base64,<?php echo base64_encode($user["PICTURE"]); ?>" alt="User Image" 9 />
                    <h2>ID: <?php echo $user['ID']; ?></h2>
                    <h3>Nom: <?php echo $user['LASTNAME']; ?></h3>
                    <h3>Prenom: <?php echo $user['FIRSTNAME']; ?></h3>
                    <p>Email: <?php echo $user['EMAIL']; ?></p>
                    <p>Mot de passe: ##########</p>
                    <p>DoB: <?php echo $user['DOB']; ?></p>
                    <br>
                    <div class="div1">
                        <form method="POST" action="updatePanel.php" class="formBtn">
                            <input style="display:flex; width: 25px; height:25px; margin-left:247px;" class="input1" type="image" name="update" src="../img/cogwheel.png">
                            <input type="hidden" value=<?PHP echo $user['ID']; ?> name="idUser">
                        </form>
                    </div>

                    <div class="div2"><a href="deleteUser.php?idUser=<?php echo $user['ID']; ?>"><img class="trashCan" style="width: 25px; height: 25px; margin-left:247px; margin-top:30px;" src="../img/garbage.png" alt="tashCan-image"></a></div>


                </div>
            <?php endforeach; ?>
            <br>
            <br>
            <?php foreach ($listG as $user) : ?>
                <div class="user-card" id="trah">

                    <img id="userImage" src="<?php echo $user["profile_pic"]; ?>" alt="User Image" 9 />
                    <h2>ID: <?php echo $user['id']; ?></h2>
                    <h3>Nom: <?php echo $user['first_name']; ?></h3>
                    <h3>Prenom: <?php echo $user['last_name']; ?></h3>
                    <p>Email: <?php echo $user['email']; ?></p>
                    <br>

                    <div class="div2"><a href="deleteUserG.php?idUser=<?php echo $user['id']; ?>"><img class="trashCan" style="width: 25px; height: 25px; margin-left:247px; margin-top:30px;" src="../img/garbage.png" alt="tashCan-image"></a></div>


                </div>
            <?php endforeach;//} ?>


            <div>
                <canvas id="myChart"></canvas>
            </div>

            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        datasets: [{
                            //label: '# of people by age',
                            data: [{
                                x: '0-18',
                                y: <?php echo json_encode($var1) ?>
                            }, {
                                x: '18-25',
                                y: <?php echo json_encode($var2) ?>
                            }, {
                                x: '25-30',
                                y: <?php echo json_encode($var3) ?>
                            }, {
                                x: '30-35',
                                y: <?php echo json_encode($var4) ?>
                            }, {
                                x: '35>',
                                y: <?php echo json_encode($var5) ?>
                            }, ],
                            backgroundColor: "lightgray",
                            borderWidth: 1,
                            borderColor: 'black'

                        }]
                    },
                    options: {
                        animations: {
                            tension: {
                                duration: 1000,
                                easing: 'linear',
                                from: 1,
                                to: 0,
                                loop: true
                            }
                        },
                        scales: {
                            y: { // defining min and max so hiding the dataset does not change scale range
                                min: 0,
                                max: 8
                            }
                        }
                    }
                });
            </script>



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
                        <p>Bonjour, <b><?php echo $nomUser["FIRSTNAME"] ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="data:image/png;base64,<?php echo base64_encode($nomUser["PICTURE"]); ?>">
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