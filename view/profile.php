<?php
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id = $_SESSION["iduser"];
$nomUser = $UserC->recupererNom($id);
$himage= $UserC->listImage($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>CALMINI</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="../img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="../cssClient/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="../cssClient/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/profile.css">
</head>

<body>
  <!-- Topbar Start -->
  <div class="container-fluid py-2 border-bottom d-none d-lg-block">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
          <div class="d-inline-flex align-items-center">
            <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>+216 53 273 182</a>
            <span class="text-body">|</span>
            <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>CALMINI@gmail.com</a>
          </div>
        </div>
        <div class="col-md-6 text-center text-lg-end">
          <div class="d-inline-flex align-items-center">
            <a class="text-body px-2" href="https://facebook.com/freewebsitecode/">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="text-body px-2" href="https://freewebsitecode.com/">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="text-body px-2" href="https://freewebsitecode.com/">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a class="text-body px-2" href="https://freewebsitecode.com/">
              <i class="fab fa-instagram"></i>
            </a>
            <a class="text-body ps-2" href="https://youtube.com/freewebsitecode/">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <div class="container-fluid sticky-top bg-white shadow-sm">
    <div class="container">
      <nav class="navbar navbar-expand-sm bg-white navbar-light py-3 py-lg-0">

        <a href="index.php" class="navbar-brand logo">
          <img src="../img/logo2.png" alt="site-logo" class="site-logo" style="position: relative !important; right: 100px;">
          <span class="sr-only">Site Logo</span>
        </a>

        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ms-5 py-0">
            <li class="nav-item">
              <a href="mainClient.php" class="nav-link active">Accueil</a>
            </li>
            <li class="nav-item">
              <a href="proposClient.php" class="nav-link "> Propos</a>
            </li>
            <li class="nav-item">
              <a href="EvenementClient.php" class="nav-link">Evenement</a>
            </li>
            <li class="nav-item">
              <a href="PlanClient.php" class="nav-link ">Plan</a>
            </li>
            <li class="nav-item">
              <a href="MedicinsClient.php" class="nav-link ">Medicins</a>
            </li>
            <li class="nav-item">
              <a href="PharmacieClient.php" class="nav-link ">Pharmacie</a>
            </li>
            <li class="nav-item">
              <a href="ArticlesClient.php" class="nav-link">Articles</a>
            </li>
            <li class="nav-item">
              <a href="contactClient.php" class="nav-link">Contact</a>
            </li>

          </ul>
          <ul class="navbar-nav ms-auto" style="padding:0px !important;">

            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding:0px !important;">
                <div class="d-flex align-items-center">
                  <div class="profile-photo me-2">
                    <img src="data:image/png;base64,<?php echo base64_encode($nomUser["PICTURE"]); ?>" alt="profile photo" class="rounded-circle" style="width: 45px; height:45px;">
                  </div>
                  <div class="info d-flex flex-column text-start">
                    <p class="mb-0">Bonjour, <b><?php echo $nomUser["FIRSTNAME"] ?></b></p>
                    <small class="text-muted">Utilisateur</small>
                  </div>
                </div>
              </a>

              <ul class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="profileDropdown">
                <li><a href="profile.php" class="dropdown-item">Mon profil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a href="addUser.php" class="dropdown-item">Se déconnecter</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <!-- Navbar End -->


  <section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-9">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: grey; height:200px;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                <img src="data:image/png;base64,<?php echo base64_encode($nomUser["PICTURE"]); ?>" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark" data-bs-toggle="modal" data-bs-target="#exampleModal" style="z-index: 1;">
                  Edit profile
                </button>
              </div>
              <div class="ms-3" style="margin-top: 130px; ">
                <h5 style="color:white;"><?php echo $nomUser["LASTNAME"] ?> <?php echo $nomUser["FIRSTNAME"] ?></h5>
                <p><?php echo $nomUser["EMAIL"] ?></p>
              </div>
            </div>
            <div class="p-4 text-black" style="background-color: #f8f9fa;">
              <div class="d-flex justify-content-end text-center py-1">
                <div>
                  <!-- <p class="mb-1 h5">253</p>
                <p class="small text-muted mb-0">Photos</p> -->
                </div>
                <div class="px-3">
                  <!-- <p class="mb-1 h5">1026</p>
                <p class="small text-muted mb-0">Followers</p> -->
                </div>
                <div>
                  <!-- <p class="mb-1 h5">478</p>
                <p class="small text-muted mb-0">Following</p> -->
                </div>
              </div>
            </div>
            <div class="card-body p-4 text-black">
              <div class="">
                <p class="lead fw-normal mb-1">About</p>
                <div class="p-4" style="background-color: #f8f9fa;">
                  <p class="font-italic mb-1">BIRTHDAY: <?php echo $nomUser["DOB"]; ?></p>
                  <p class="font-italic mb-1" id="locationOutput">Localisation: <?= $nomUser["LOCALISATION"]; ?></p>
                  <p class="font-italic mb-0">Profession: <?= $nomUser["PROFESSION"]; ?></p>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Recent photos</p>
              </div>
              <div class="">
                <?php foreach($himage as $im){ ?>
                <div style="float:left; margin-right:3px"  class="">
                  <img src="data:image/png;base64,<?php echo base64_encode($im["PICTURE"]); ?>" alt="image 1" class="w-30 rounded-3">
                </div>
                <?php } ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- Button trigger modal
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

  </section>



  <!-- Modal -->
  <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="UpdateProfile.php" name="userForm" enctype="multipart/form-data" oninput="return verif()">
            <div class="mb-3">
              <label for="exampleInputFirstName1" class="form-label">First Name</label>
              <input type="text" name="firstName" class="form-control" id="exampleInputFirstName1" required value="<?= $nomUser["FIRSTNAME"] ?>">
            </div>
            <span id="msgFirstName"></span>
            <div class="mb-3">
              <label for="exampleInputLastName1" class="form-label">Last Name</label>
              <input type="text" name="lastName" class="form-control" id="exampleInputLastName1"  value="<?= $nomUser["LASTNAME"] ?>">
            </div>
            <span id="msgLastName"></span>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?= $nomUser["EMAIL"] ?>">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <span id="msgEmail"></span>
            <div class="mb-3" >
              <label for="exampleInputDOB1" class="form-label">Date of birth</label>
              <input type="date" name="dob" class="form-control" id="exampleInputDOB1"  value="<?= $nomUser["DOB"] ?>">
            </div>
            <span id="msgDOB"></span>
            <div class="mb-3" id="locationDiv">
              <label for="exampleInputLocation1" class="form-label">Location</label>
              <input type="text" name="location" class="form-control"  id="exampleInputLocation1" value="<?= $nomUser["LOCALISATION"] ?>">
              <div id="locationHelp" class="form-text">Tell us more about you!</div>
            </div>
            <span id="msgLocation"></span>
            <div class="mb-3" id="ProfessionDiv">
              <label for="exampleInputProfession1" class="form-label">Profession</label>
              <input type="text" name="profession" class="form-control"  id="exampleInputProfession1" value="<?= $nomUser["PROFESSION"] ?>">
              <div id="professionHelp" class="form-text">What do you do for living?</div>
            </div>
            <span id="msgProfession"></span>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" name="password"  class="form-control" id="exampleInputPassword1">
              <!-- <div id="passwordHelp" class="form-text">Enter password to confirm chnanges.</div> -->
            </div>
            <span id="msg"></span>
            <div class="mb-3">
              <label class="form-label">Photo</label>
              <input id="picture" type="file" name="picture">
            </div>
            <span class="spanClass" id="msgPicture"></span>
            <span id="msgPhoto"></span>
            <div class="modal-footer">
              <!-- <button type="submit" name="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="submit" name="submit" class="btn btn-primary" id="myBtn">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function verif() {
      var email = document.forms["userForm"]["exampleInputEmail1"].value;
      var mdp = document.getElementById("exampleInputPassword1").value;
      var firstName = document.forms["userForm"]["exampleInputFirstName1"].value;
      var lastName = document.forms["userForm"]["exampleInputLastName1"].value;
      var date = document.forms["userForm"]["exampleInputDOB1"].value;
      var location = document.forms["userForm"]["exampleInputLocation1"].value;
      var Profession = document.forms["userForm"]["exampleInputProfession1"].value;
      var picture = document.forms["userForm"]["picture"].value;
      var letters = /^[A-Za-z]+$/;

      var YearNow=new Date().getFullYear();
      var d = new Date( date );
      if ( !!d. valueOf() ) {
        year = d. getFullYear();
      }
      if (firstName == "") {
        var prenomInput = document.getElementById("exampleInputFirstName1");
        prenomInput.style.border = "1px solid red ";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Veuillez entrer votre prenom!</p>";
        document.getElementById("msgFirstName").innerHTML = msg;
        return false;
      } else if (!(firstName.match(letters) && firstName.charAt(0).match(/^[A-Z]+$/))) {
        var prenomInput = document.getElementById("exampleInputFirstName1");
        prenomInput.style.border = "1px solid red ";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Veuillez entrer un prenom valid!</p>";
        document.getElementById("msgFirstName").innerHTML = msg;
        return false
      } else {
        var prenomInput = document.getElementById("exampleInputFirstName1");
        prenomInput.style.border = "1px solid green ";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Prenom valid!</p>";
        document.getElementById("msgFirstName").innerHTML = msg;
      }

      if (lastName == "") {
        var nomInput = document.getElementById("exampleInputLastName1");
        nomInput.style.border = "1px solid red ";
        nomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Veuillez entrer votre nom!</p>";
        document.getElementById("msgLastName").innerHTML = msg;
        return false;
      } else if (!(lastName.match(letters) && lastName.charAt(0).match(/^[A-Z]+$/))) {
        var nomInput = document.getElementById("exampleInputLastName1");
        nomInput.style.border = "1px solid red ";
        nomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Veuillez entrer un nom valid!</p>";
        document.getElementById("msgLastName").innerHTML = msg;
        return false;
      } else {
        var nomInput = document.getElementById("exampleInputLastName1");
        nomInput.style.border = "1px solid green ";
        nomInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Nom valid!</p>";
        document.getElementById("msgLastName").innerHTML = msg;
      }

      if (email == "") {
        var emailInput = document.getElementById("exampleInputEmail1");
        emailInput.style.border = "1px solid red ";
        emailInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>veuillez entrer votre email.</p>";
        document.getElementById("msgEmail").innerHTML = msg;
        return false;
      } else if (!email.match('@gmail.com')) {
        var emailInput = document.getElementById("exampleInputEmail1");
        emailInput.style.border = "1px solid red";
        emailInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Verifiez votre email.</p>";
        document.getElementById("msgEmail").innerHTML = msg;
        return false;
      } else {
        var emailInput = document.getElementById("exampleInputEmail1");
        emailInput.style.border = "1px solid green";
        emailInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Email valid.</p>";
        document.getElementById("msgEmail").innerHTML = msg;
      }

      if (date == "") {
        var prenomInput = document.getElementById("exampleInputDOB1");
        prenomInput.style.border = "1px solid red ";
        prenomInput.style.borderRadius = "55px";
        return false;
      }else if(YearNow-year<10){
        var prenomInput = document.getElementById("exampleInputDOB1");
        prenomInput.style.border = "1px solid red ";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Vous devez avoir au moins dix ans.</p>";
        document.getElementById("msgDOB").innerHTML = msg;
        return false;
      }else {
        var prenomInput = document.getElementById("exampleInputDOB1");
        prenomInput.style.border = "1px solid green";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Age valid.</p>";
        document.getElementById("msgDOB").innerHTML = msg;
      }
      
      if (location == "") {
        var prenomInput = document.getElementById("exampleInputLocation1");
        prenomInput.style.border = "1px solid red ";
        prenomInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>veuillez donner votre localisation.</p>";
        document.getElementById("msgLocation").innerHTML = msg;
        return false;
      }else {
        var prenomInput = document.getElementById("exampleInputLocation1");
        prenomInput.style.border = "1px solid green ";
        prenomInput.style.borderRadius = "55px";
        msg = "";
        document.getElementById("msgLocation").innerHTML = msg;
        
      }
      
      if (Profession == "") {
        var Input = document.getElementById("exampleInputProfession1");
        Input.style.border = "1px solid red ";
        Input.style.borderRadius = "55px";
        msg = "<p style='color:red'>veuillez donner votre Profession.</p>";
        document.getElementById("msgProfession").innerHTML = msg;
        return false;
      }else {
        var Input = document.getElementById("exampleInputProfession1");
        Input.style.border = "1px solid green ";
        Input.style.borderRadius = "55px";
        msg = "";
        document.getElementById("msgProfession").innerHTML = msg;
        
      }
      if (mdp == "") {
        var mdpInput = document.getElementById("exampleInputPassword1");
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
        var mdpInput = document.getElementById("exampleInputPassword1");
        mdpInput.style.border = "1px solid green";
        mdpInput.style.borderRadius = "55px";
        msg = "<p style='color:green'>Mot de passe fort.</p>";
        document.getElementById("msg").innerHTML = msg;
        //return true;
        
      } else {
        var mdpInput = document.getElementById("exampleInputPassword1");
        mdpInput.style.border = "1px solid red";
        mdpInput.style.borderRadius = "55px";
        msg = "<p style='color:red'>Mot de passe faible.</p>";
        document.getElementById("msg").innerHTML = msg;
        return false;
      }
      
      if (picture == "") {
                var prenomInput = document.getElementById("picture");
                prenomInput.style.border = "1px solid red ";
                prenomInput.style.borderRadius = "10px";
                msg = "<p style='color:red'>veuillez choisir une photo.</p>";
                document.getElementById("msgPicture").innerHTML = msg;
                return false;
            }else {
                var prenomInput = document.getElementById("picture");
                prenomInput.style.border = "1px solid green";
                prenomInput.style.borderRadius = "10px";
                msg = "<p style='color:green'>photo valid.</p>";
                document.getElementById("msgPicture").innerHTML = msg;
            }

    }
  </script>
  <!-- Back to Top -->
  <a href="profile.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../lib/easing/easing.min.js"></script>
  <script src="../lib/waypoints/waypoints.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../lib/tempusdominus/js/moment.min.js"></script>
  <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="../jsClient/main.js"></script>
</body>

</html>