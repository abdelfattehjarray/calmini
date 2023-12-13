<?php
include '../controller/UserC.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

/*Google connect */
$UserC = new UserC();
require('./configGmail.php');
# the createAuthUrl() method generates the login URL.
$login_url = $client->createAuthUrl();
/* 
 * After obtaining permission from the user,
 * Google will redirect to the login.php with the "code" query parameter.
*/
error_reporting(0);


if (isset($_GET['code'])):

  session_start();
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  if(isset($token['error'])){
    header('Location: main.php');
    exit;
  }
  $_SESSION['token'] = $token;
  /* -- Inserting the user data into the database -- */

  # Fetching the user data from the google account
  $client->setAccessToken($token);
  $google_oauth = new Google\Service\Oauth2($client);
  $user_info = $google_oauth->userinfo->get();

  $google_id =$user_info['id'];
  $f_name =$user_info['given_name'];
  $l_name =$user_info['family_name'];
  $emailG =$user_info['email'];
  $gender =$user_info['gender'];
  $local =$user_info['local'];
  $pictureG =$user_info['picture'];


  # Checking whether the email already exists in our database.
  $resultG=$UserC->verifierEmail2($emailG);

  if($resultG){
    # Inserting the new user into the database
    $UserC->addUserG($google_id,$f_name,$l_name,$emailG,$gender,$local,$pictureG);
    } 
    header('Location: mainClient2.php');
  exit;


endif;




/*Google connect */
session_start();

$error = '';

$msg = "";
$return = null;
$code = md5(rand());
$return1 = null;
$user = null;
$imageData = file_get_contents('../img/homme.png');
// $imageBase64 = base64_encode($imageData);
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
    $mdpE=md5($_POST['password']);
    $user = new User(
      null,
      $_POST['lastName'],
      $_POST['firstName'],
      $_POST['email'],
      $mdpE,
      new DateTime($_POST['dob']),
      $code,
      $imageData,
      "",
      "" 
    );
    $return = $UserC->addUser($user);
  } else
    $error = "Missing information";
}

$message = "";
if (isset($_GET["done"])) {
  $message = '<div id="test" style="color:green;">Mot de passe mis a jour.connectez vous</div>';
}
if (isset($_GET["verification"])) {
  $verified = $UserC->verifierOuPas($_GET["verification"]);
  if ($verified) {
    $query = $UserC->vider($_GET["verification"]);
    if ($query) {
      $message = ' <div id="test" style="color:green;">Email verification done.</div>';
    }
  } else {
    header("Location:addUser.php");
  }
}



//login Test

$UserP = "";
$idf = "";
$mess = "";
$msg2 = "";
if (
  isset($_POST["emailL"]) &&
  isset($_POST["passwordL"])
) {
  if (
    !empty($_POST['emailL']) &&
    !empty($_POST["passwordL"])
  ) {

    $emailL = $_POST["emailL"];
    $emailL1=strval($emailL);
    $passwordL = $_POST["passwordL"];
    $list = $UserC->renvoyerColone($emailL);
    $mdpTest=$UserC->renvoyerMdpUser($emailL1);
    $mdpAdmin=$UserC->renvoyerMdpAdmin($emailL1);
    $MDP = md5($passwordL);
    // echo $MDP;

    $UserP = $UserC->MaxId($emailL);
    
    foreach ($UserP as $test) {
      $idf = $test["ID"];
    }
    
    if($MDP==$mdpTest["PASSWORDD"]){
      $return1=$UserC->login($emailL);
    }else
    {
      $return1=false;
    }
    if($MDP==$mdpAdmin["PASSWORDD"]){
      $verif = $UserC->verifAdmin($emailL);
    }else
    {
      $verif=false;
    }
    if ($verif) {
      $adminD=$UserC->adminId($emailL);
      foreach ($adminD as $test) {
        $idf = $test["ID"];
      }
      $_SESSION["iduser"] = $idf;
      header("Location:TableauPanel.php");
    }
    if ($return1 != null) {
      if (empty($list["CODE"])) {
          $_SESSION["iduser"] = $idf;
          header("Location:mainClient.php");
        }else {
          $mess = '<div style="color:red;">You need to verify your email first!</div>';
        }
    } else {
      $msg2 = '<div style="color:red;">Incorrect email or password.Try again</div>';
    }
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/sty.css" />
  <script src="../view/jquery.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <title>Sign in & Sign up Form</title>

  <script type="text/javascript">
    function verif() {
      var email = document.forms["userForm"]["email"].value;
      var mdp = document.getElementById("mdp").value;
      var firstName = document.forms["userForm"]["firstName"].value;
      var lastName = document.forms["userForm"]["lastName"].value;
      var date = document.forms["userForm"]["dob"].value;

      var letters = /^[A-Za-z]+$/;

      var YearNow=new Date().getFullYear();
      var d = new Date( date );
      if ( !!d. valueOf() ) {
        year = d. getFullYear();
      }
      if (firstName == "") {
        var prenomInput = document.getElementById("prenomDiv");
        prenomInput.style.border = "1px solid red ";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Veuillez entrer votre prenom!</p>";
        document.getElementById("msgFirstName").innerHTML = msg;
        return false;
      } else if (!(firstName.match(letters) && firstName.charAt(0).match(/^[A-Z]+$/))) {
        var prenomInput = document.getElementById("prenomDiv");
        prenomInput.style.border = "1px solid red ";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Veuillez entrer un prenom valid!</p>";
        document.getElementById("msgFirstName").innerHTML = msg;
        return false
      } else {
        var prenomInput = document.getElementById("prenomDiv");
        prenomInput.style.border = "1px solid green ";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Nom valid!</p>";
        document.getElementById("msgFirstName").innerHTML = msg;
      }

      if (lastName == "") {
        var nomInput = document.getElementById("nomDiv");
        nomInput.style.border = "1px solid red ";
        nomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Veuillez entrer votre nom!</p>";
        document.getElementById("msgLastName").innerHTML = msg;
        return false;
      } else if (!(lastName.match(letters) && lastName.charAt(0).match(/^[A-Z]+$/))) {
        var nomInput = document.getElementById("nomDiv");
        nomInput.style.border = "1px solid red ";
        nomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Veuillez entrer un nom valid!</p>";
        document.getElementById("msgLastName").innerHTML = msg;
        return false;
      } else {
        var nomInput = document.getElementById("nomDiv");
        nomInput.style.border = "1px solid green ";
        nomInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Nom valid!</p>";
        document.getElementById("msgLastName").innerHTML = msg;
      }

      if (email == "") {
        var emailInput = document.getElementById("emailDiv");
        emailInput.style.border = "1px solid red ";
        emailInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>veuillez entrer votre email.</p>";
        document.getElementById("msgEmail").innerHTML = msg;
        return false;
      } else if (!email.match('@gmail.com')) {
        var emailInput = document.getElementById("emailDiv");
        emailInput.style.border = "1px solid red";
        emailInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Verifiez votre email.</p>";
        document.getElementById("msgEmail").innerHTML = msg;
        return false;
      } else {
        var emailInput = document.getElementById("emailDiv");
        emailInput.style.border = "1px solid green";
        emailInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Email valid.</p>";
        document.getElementById("msgEmail").innerHTML = msg;
      }

      if (date == "") {
        var prenomInput = document.getElementById("dobDiv");
        prenomInput.style.border = "1px solid red ";
        prenomInput.style.borderRadius = "55px";
        return false;
      }else if(YearNow-year<10){
        var prenomInput = document.getElementById("dobDiv");
        prenomInput.style.border = "1px solid red ";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Vous devez avoir au moins dix ans.</p>";
        document.getElementById("msgDate").innerHTML = msg;
        return false;
      }else {
        var prenomInput = document.getElementById("dobDiv");
        prenomInput.style.border = "1px solid green";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Age valid.</p>";
        document.getElementById("msgDate").innerHTML = msg;
      }

      if (mdp == "") {
        var mdpInput = document.getElementById("mdpDiv");
        mdpInput.style.border = "1px solid red";
        mdpInput.style.borderRadius = "55px";
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
        mdpInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Mot de passe fort.</p>";
        document.getElementById("msg").innerHTML = msg;
        return true;
      } else {
        var mdpInput = document.getElementById("mdpDiv");
        mdpInput.style.border = "1px solid red";
        mdpInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Mot de passe faible.</p>";
        document.getElementById("msg").innerHTML = msg;
        return false;
      }
      // const container = document.querySelector(".container");
      // const submit = document.querySelector("#test11");
      // submit.addEventListener("click", () => {
      //   container.classList.add("sign-up-mode");
      //   return true;
      // });
      var onloadCallback = function() {
        alert("grecaptcha is ready!");
      };
    }
  </script>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">

        <form action="" class="sign-in-form" method="POST">
          <h2 class="title">S'identifier</h2>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="emailL" />
          </div>

          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="passwordL" />
          </div>

          <?php


          echo $mess;
          echo $msg2;



          ?>
          <input type="hidden" value="<?php echo $test["ID"]; ?>" name="i1">
          <a style="margin-left: 180px;" href="mdp.php">Mot de passe oublier?</a>
          <div id="divCap" style="margin-top: 5px;">
            <div class="g-recaptcha" data-sitekey="6LcZqLMlAAAAAMp2D-NGeKnRNXLXwuKtpvxmiLR3"></div>
          </div>
          <span id="msgCap"></span>
          <input type="submit" value="Login" id="login" class="btn solid" />

          <?php
          echo $message;
          if ($return) {
            echo ' <div id="test" style="color:green;">We have sent a confirmation email.</div>';
          } elseif ($return === null) {
            echo ' <div id="test" style="display:none;"></div>';
          } else {
            echo ' <div id="test" style="color:red;">Email already used.Try again</div>';
          }

          ?>
          <p class="social-text">Ou Connectez-vous avec les plateformes sociales</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="<?= $login_url ?>"class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>

        </form>

        <form action="" class="sign-up-form" method="POST" name="userForm" id="inputForm" oninput="return verif()">
          <h2 class="title">S'inscrire</h2>
          <?php echo $msg; ?>
          <div class="input-field" id="prenomDiv">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="firstName" name="firstName" id="firstName" />
          </div>
          <span id="msgFirstName"></span>

          <div class="input-field" id="nomDiv">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="lastName" name="lastName" id="lastName" />
          </div>
          <span id="msgLastName"></span>

          <div class="input-field" id="emailDiv">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="email" id="email" />
          </div>
          <span id="msgEmail"></span>

          <div class="input-field" id="dobDiv">
            <i class="fas fa-user"></i>
            <input style="margin-top: 15px;" type="date" placeholder="date of birth" name="dob" />
          </div>
          <span id="msgDate"></span>
          <div class="input-field" id="mdpDiv">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" id="mdp" />
          </div>
          <span id="msg"></span>
          <?php if ($return) {
            echo ' <div id="test" style="color:green;">we have sent you an email of confirmation</div>';
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

            $mail->Subject = 'EMAIL VERIFICATION';

            $mail->Body = '<body style="text-align:center ;font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;">
            <p style="font-weight: bold ;color:#222;font-size:17px;">Your Verification link<br><br><b style="color:#222;font-size:40px;text-align:center"></b></p>
            <a href="http://localhost/Website%202A35%20Golden%20Dawn/view/addUser.php?verification=' . $code . '" style="margin-right: 10px;">http://localhost/Website%202A35%20Golden%20Dawn/view/addUser.php?verification=' . $code . '</a>
            <br><br>';

            $mail->send();
          } elseif ($return === null) {
            echo ' <div id="test" style="display:none;"></div>';
          } else {
            echo ' <div id="test" style="color:red;">Email already used.Try again</div>';
          } ?>
          <input type="submit" class="btn" value="Sign up" id="test11" />

          <p class="social-text">Ou Inscrivez-vous avec les plateformes sociales</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <!-- <script>
      $(document).ready(function() {
        $('#test11').on('click', function() {
          $.ajax({
            url: "AddUser.php",
            type: "POST",
            data: $("#inputForm").serialize(),
            success: function(response) {
              $("#test").html(response);
              $("#test").css("display", "block");
            }
          })
        })

      })
    </script> -->

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            Vous vous sentez débordé, stressé ou même pas d'humeur ? Rejoignez notre communauté et laissez-nous vous aider !
          </p>
          <button class="btn transparent" id="sign-up-btn">
            S'inscrire
          </button>
        </div>
        <img src="../img/intro.png" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Un de nous ?</h3>
          <p>
            Connectez-vous et plongez à nouveau ! Faites-vous aider et aidez les autres à sentir que vous devriez l'être
            sentiment!
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="../img/sing-in.png" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="../js/app.js"></script>
  <script>
    $(document).on('click', '#login', function() {
      var response = grecaptcha.getResponse();
      if (response.length == 0) {
        var Input = document.getElementById("divCap");
        Input.style.border = "1px solid red ";
        //Input.style.borderRadius = "55px";
        msg = "<p style='color:red'>You need to verify that your not a robot!</p>";
        document.getElementById("msgCap").innerHTML = msg;
        return false;
      }
    })
  </script>
</body>

</html>