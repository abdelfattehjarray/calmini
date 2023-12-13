<?php
include '../controller/UserC.php';
$UserC = new UserC();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
$code = md5(rand());

$m = "";
if (isset($_POST["submitpdp"])) {
    $email = $_POST["email"];
    $return3 = $UserC->verifierEmail($email);
    if ($return3) {
        $test = $UserC->updateCode($code, $email);
        if ($test) {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'youcef.ouhab@esprit.tn';
            $mail->Password = 'kojumnzulhyvomqb';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('youcef.ouhab@esprit.tn');
            $mail->addAddress($_POST["email"]);
            $mail->isHTML(true);

            $mail->Subject = 'RECOVERY EMAIL';
            
            $mail->Body = '<body style="text-align:center ;font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;">
            <p style="font-weight: bold ;color:#222;font-size:17px;">Change your password:<br><br><b style="color:#222;font-size:40px;text-align:center"></b></p>
            <a href="http://localhost/Website%202A35%20Golden%20Dawn/view/changePassword.php?reset=' . $code . '" style="margin-right: 10px;">http://localhost/Website%202A35%20Golden%20Dawn/view/changePassword.php?reset=' . $code . '</a>
            <br><br>';
            $mail->send();
            $m = '<div id="test" style="color:green; margin-left:55px;">We have sent you a recovery email.</div>';
        }
    } else {
        $m = '<div id="test" style="color:red; margin-left:88px;">Email not found.Try again</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form - Brave Coder</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="../css/style1.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function verif() {
            var email = document.forms["userForm"]["email"].value;

            if (email == "") {
                var emailInput = document.getElementById("email");
                emailInput.style.border = "1px solid red ";
                emailInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>veuillez entrer votre email.</p>";
                document.getElementById("msgEmail").innerHTML = msg;
                return false;
            } else if (!email.match('@gmail.com')) {
                var emailInput = document.getElementById("email");
                emailInput.style.border = "1px solid red";
                emailInput.style.borderRadius = "20px";
                msg = "<p style='color:red'>Verifiez votre email.</p>";
                document.getElementById("msgEmail").innerHTML = msg;
                return false;
            } else {
                var emailInput = document.getElementById("email");
                emailInput.style.border = "1px solid green";
                emailInput.style.borderRadius = "20px";
                msg = "<p style='color:green'>Email valid.</p>";
                document.getElementById("msgEmail").innerHTML = msg;
            }
        }
    </script>
</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">

                        <a style="color:white;" href="addUser.php"><span class="fa fa-close"></span></a>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="../img/cle.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Forgot Password</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <form action="" method="post" name="userForm" id="inputForm" oninput="return verif()">
                            <input type="email" class="email" name="email" id="email" placeholder="Enter Your Email" required>
                            <span id="msgEmail"></span>
                            <button name="submitpdp" class="btn" type="submit">Send Reset Link</button>
                            <?= $m ?>
                        </form>
                        <div class="social-icons">
                            <p>Back to! <a href="addUser.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->


</body>

</html>