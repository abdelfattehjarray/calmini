<?php 
include '../controller/UserC.php';
$UserC = new UserC();
$msg="";
if(isset($_GET["reset"])){
    $return4=$UserC->verifierOuPas($_GET["reset"]);
    if($return4){
        if(isset($_POST["submit"])){
            $password=$_POST["password"];
            $confirm_password=$_POST["confirm-password"];
            if($password===$confirm_password){
                $test=$UserC->updateMdp(md5($password),$_GET["reset"]);
                if($test){
                    header("Location: addUser.php?done=1");
                }
            }else{
                $msg= '<div style="color:red; margin-left:12px;">Password does not match.</div>';
            }
        }
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
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="../css/style1.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
    function verif() {
      var mdp = document.getElementById("mdp").value;

      if (mdp == "") {
        var mdpInput = document.getElementById("mdp");
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
        var mdpInput = document.getElementById("mdp");
        mdpInput.style.border = "1px solid green";
        mdpInput.style.borderRadius = "20px";
        msg = "<p style='color:green'>Mot de passe fort.</p>";
        document.getElementById("msg").innerHTML = msg;
        return true;
      } else {
        var mdpInput = document.getElementById("mdp");
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
                            <img src="../img/mot-de-passe.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Change Password</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <form action="" method="post" name="userForm" id="inputForm" oninput="return verif()">
                        <?=$msg;?>
                            <input type="password" class="password" name="password" id="mdp" placeholder="Enter Your Password" required>
                            <span id="msg"></span>
                            <input type="password" class="confirm-password" name="confirm-password" id="mdp" placeholder="Confirm Password" required>
                            
                            <button name="submit" class="btn" type="submit">Change Password</button>
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