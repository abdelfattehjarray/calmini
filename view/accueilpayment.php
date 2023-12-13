<?php 
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNom($id);

?>
<?php 

include_once ('../controller/rendez_vousC.php');
$db = config::getConnexion();

if (isset($_SESSION['idUser'])) {
    $idclient = $_SESSION['idUser'];
} else {
    $idclient = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if ($_POST['radio'] === 'radio5') { // Check if "paiement sur place" option is selected
        $update_rendezvous = $db->prepare("UPDATE l_rendezvous SET etat = 1 WHERE id_user = ?");
        $update_rendezvous->execute([$id]);
        
        header("Location: mesrendezvous.php"); // Redirect to "mesrendezvous.php"
        exit();
    }
    else  
    {
        echo "<script>alert('Vous avez choisi de payer sur place lors de votre rendez-vous.');</script>";
        header("Location: payment.php");
    }
}

$select_profile = $db->prepare("SELECT * FROM `user` WHERE id = ?");
$select_profile->execute([$id]);

if ($select_profile->rowCount() > 0) {
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    $email = $fetch_profile['EMAIL'];
    $name = $fetch_profile['FIRSTNAME'];
} else {
    echo "ghalet";
}

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
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>+012 345 6789</a>
                        <span class="text-body">|</span>
                        <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>info@example.com</a>
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
                  <a href="mainClient.php" class="nav-link ">Accueil</a>
                </li>
                <li class="nav-item">
                  <a href="proposClient.php" class="nav-link"> Propos</a>
                </li>
                <li class="nav-item">
                    <a href="EvenementClient.php" class="nav-link">Evenement</a>
                </li>
                <li class="nav-item">
                  <a href="mesrendezvous.php" class="nav-link ">mes rendez vous</a>
                </li>
                <li class="nav-item">
                  <a href="mesordo.php" class="nav-link active">mes ordonnonce</a>
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
        <img src="data:image/png;base64,<?php echo base64_encode($nomUser["PICTURE"]); ?>" alt="profile photo" class="rounded-circle" style="width: 35px;">
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
    <section class="radio-section">
    <form method="POST">
        <div class="radio-list">
            <div class="radio-item">
                <input type="radio" name="radio" id="radio1">
                <label for="radio1">
                    Paiement par carte bancaire
                    <img src="../View/images/mastercard.png" alt="Carte Bancaire" style="width: 50px; height: 30px;">
                    <img src="../View/images/visa.png" alt="Carte Bancaire" style="width: 50px; height: 30px;">
                    <img src="../View/images/amex.png" alt="Carte Bancaire" style="width: 50px; height: 30px;">
                </label>
            </div>
            <div class="radio-item">
                <input type="radio" name="radio" id="radio5" value="radio5">
                <label for="radio5"> paiement sur place</label>
            </div>
        </div>
        <button type="submit" name="submit">Valider</button>
    </form>
</section>

    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

a {
    text-decoration: none;
}
ul {
    list-style-type: none;
}
body {
    font-family: "Poppins", sans-serif;
    background: #141432;
    color: #ffffff;
}
.radio-section{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}
.radio-item [type="radio"]{
    display: none;
}

.radio-item + .radio-item{
    margin-top: 15px;
}
.radio-item label{
    display: block;
    padding: 20px 60px;
    background: #1d1d42;
    border:2px solid rgba(255,255,255,0.1);
    border-radius: 6px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 400;
    min-width: 250px;
    white-space: nowrap;
    position: relative;
}
.radio-item label:after,
.radio-item label:before{
    content: "";
    position: absolute;
    border-radius: 50%;
}

.radio-item label:after{
    height: 20px;
    width: 20px;
    border:2px solid #ffffff;
    left: 20px;
    top: calc(50% - 12px);
}
.radio-item label:before{
    background: #524eee;
    height: 10px;
    width: 10px;
    left: 27px;
    top: calc(50% - 5px);
    transform: scale(5);
    transition: .4s ease-in-out 0s;
    opacity: 0;
    visibility: hidden;
}
.radio-item [type="radio"]:checked ~ label{
    border-color: #524eee;
}

.radio-item [type="radio"]:checked ~ label:before{
    opacity: 1;
    visibility: visible;
    transform: scale(1);
}
button[type="submit"] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin-top: 20px;
  cursor: pointer;
  border-radius: 4px;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}
    </style>

    <!-- Search Start -->
  
    <!-- Search Result End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Entrer en contact</h4>
                    <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Cite ElGhazala, Ariana, Tunisie</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>CALMINI@gmail.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+216 53 273 182</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Liens rapides</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Accueil</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>À propos de nous</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Nos Evenement</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Rencontrer l'équipe</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Dernier article</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contactez-nous</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Liens rapides</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Accueil</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>À propos de nous</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Nos Evenement</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Rencontrer l'équipe</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Dernier article</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contactez-nous</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Bulletin</h4>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">
                            <button class="btn btn-primary">S'inscrire</button>
                        </div>
                    </form>
                    <h6 class="text-primary text-uppercase mt-4 mb-3">Suivez-nous</h6>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://freewebsitecode.com/"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://facebook.com/freewebsitecode/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://freewebsitecode.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="https://youtube.com/freewebsitecode/"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-primary" href="#">Calmini</a>. Tous les droits sont réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-primary" href="https://freewebsitecode.com">Free Website Code</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="vlib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../jsClient/main.js"></script>
</body>

</html>