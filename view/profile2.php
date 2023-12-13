<?php
include_once('../controller/UserC.php');
session_start();
require('./configGmail.php');
if(!isset($_SESSION['token'])){
    header('Location: addUser.php');
    exit;
  }
  
  $client->setAccessToken($_SESSION['token']);
  
  if($client->isAccessTokenExpired()){
    header('Location: logout.php');
    exit;
  }
  $google_oauth = new Google\Service\Oauth2($client);
  $user_info = $google_oauth->userinfo->get();
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
              <a href="mainClient2.php" class="nav-link active">Accueil</a>
            </li>
            <li class="nav-item">
              <a href="proposClient2.php" class="nav-link "> Propos</a>
            </li>
            <li class="nav-item">
              <a href="EvenementClient2.php" class="nav-link">Evenement</a>
            </li>
            <li class="nav-item">
              <a href="PlanClient2.php" class="nav-link ">Plan</a>
            </li>
            <li class="nav-item">
              <a href="MedicinsClient2.php" class="nav-link ">Medicins</a>
            </li>
            <li class="nav-item">
              <a href="PharmacieClient2.php" class="nav-link ">Pharmacie</a>
            </li>
            <li class="nav-item">
              <a href="ArticlesClient2.php" class="nav-link">Articles</a>
            </li>
            <li class="nav-item">
              <a href="contactClient2.php" class="nav-link">Contact</a>
            </li>

          </ul>
          <ul class="navbar-nav ms-auto" style="padding:0px !important;">

            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding:0px !important;">
                <div class="d-flex align-items-center">
                  <div class="profile-photo me-2">
                    <img src="<?=$user_info['picture'];?>" alt="profile photo" class="rounded-circle" style="width: 35px;">
                  </div>
                  <div class="info d-flex flex-column text-start">
                    <p class="mb-0">Bonjour, <b><?=$user_info['givenName'];?></b></p>
                    <small class="text-muted">Utilisateur</small>
                  </div>
                </div>
              </a>

              <ul class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="profileDropdown">
                <li><a href="profile2.php" class="dropdown-item">Mon profil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a href="logout.php" class="dropdown-item">Se déconnecter</a></li>
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
        <div class="col col-lg-9 col-xl-7">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: grey; height:200px;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                <img src="<?=$user_info['picture'];?>"alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1"  >
                <!-- <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark" data-bs-toggle="modal" data-bs-target="#exampleModal" style="z-index: 1;">
                  Edit profile
                </button> -->
              </div>
              <div class="ms-3" style="margin-top: 130px;">
                <h5><?=$user_info['givenName'];?> <?=$user_info['familyName'];?></h5>
                <p><?=$user_info['email'];?></p>
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
              <div class="mb-5">
                <p class="lead fw-normal mb-1">About</p>
                <div class="p-4" style="background-color: #f8f9fa;">
                  <p class="font-italic mb-1">Vous ne pouvez pas utiliser 100% de nos fonctionalite qu'on creant un compte CALMINI!</p>
                  <p class="font-italic mb-1">Pour plus d'information n'hésitez pas a nous contacter!</p>
                </div>
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
          <form method="post" action="profile.php">
          <div class="mb-3">
              <label for="exampleInputFirstName1" class="form-label">First Name</label>
              <input type="text" name="firstName" class="form-control" id="exampleInputFirstName1" value="<?= $nomUser["FIRSTNAME"]?>">
            </div>
            <div class="mb-3">
              <label for="exampleInputLastName1" class="form-label">Last Name</label>
              <input type="text" name="lastName" class="form-control" id="exampleInputLastName1" value="<?= $nomUser["LASTNAME"]?>">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $nomUser["EMAIL"]?>">
              <div id="emailHelp" name="email" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Date of birth</label>
              <input type="date"  name="dob" class="form-control" id="exampleInputDOB1" value="<?= $nomUser["DOB"]?>">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1">
              <div id="passwordHelp" name="password" class="form-text">Enter password to confirm chnanges.</div>
            </div>
            <div class="modal-footer">
              <!-- <button type="submit" name="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
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