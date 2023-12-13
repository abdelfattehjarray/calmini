<?php 
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNom($id);

?>
<?php

include_once ('../controller/ordonnanceC.php');




$error = "";

$db=config::getConnexion();
if(isset($_SESSION['idUser'])){
   $idclient = $_SESSION['idUser'];
}else{
   $idclient = '';
};
$ordonnancee = new ordonnancee();
$list = $ordonnancee->listrordonnance();
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


    <!-- Search Start -->
 
    <!-- Search Result End -->
    <style>
    .content-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.content-table thead tr {
    background-color: #0086de;
    color: #ffffff;
    text-align: left;
}
.content-table th,
.content-table td {
    padding: 30px 50px;
}
.content-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
    background-color: #0086de;
}

.content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.content-table tbody tr.active-row {
    font-weight: bold;
    color: #0086de;
}
.badge {
    transition: none;
  }
}
a.badge:hover, a.badge:focus {
  text-decoration: none;
}

.badge:empty {
  display: none;
}

.btn .badge {
  position: relative;
  top: -1px;
}

.badge-pill {
  padding-right: 0.6em;
  padding-left: 0.6em;
  border-radius: 10rem;
}

.badge-primary {
  color: #fff;
  background-color: #f4623a;
}
a.badge-primary:hover, a.badge-primary:focus {
  color: #fff;
  background-color: #ee3e0d;
}
a.badge-primary:focus, a.badge-primary.focus {
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(244, 98, 58, 0.5);
}

.badge-secondary {
  color: #fff;
  background-color: #6c757d;
}
a.badge-secondary:hover, a.badge-secondary:focus {
  color: #fff;
  background-color: #545b62;
}
a.badge-secondary:focus, a.badge-secondary.focus {
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.5);
}

.badge-success {
  color: #fff;
  background-color: #28a745;
}
a.badge-success:hover, a.badge-success:focus {
  color: #fff;
  background-color: #1e7e34;
}
a.badge-success:focus, a.badge-success.focus {
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5);
}

.badge-info {
  color: #fff;
  background-color: #17a2b8;
}
a.badge-info:hover, a.badge-info:focus {
  color: #fff;
  background-color: #117a8b;
}
a.badge-info:focus, a.badge-info.focus {
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.5);
}

.badge-warning {
  color: #212529;
  background-color: #ffc107;
}
a.badge-warning:hover, a.badge-warning:focus {
  color: #212529;
  background-color: #d39e00;
}
a.badge-warning:focus, a.badge-warning.focus {
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.5);
}

.badge-danger {
  color: #fff;
  background-color: #dc3545;
}
a.badge-danger:hover, a.badge-danger:focus {
  color: #fff;
  background-color: #bd2130;
}
a.badge-danger:focus, a.badge-danger.focus {
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
}

.badge-light {
  color: #212529;
  background-color: #f8f9fa;
}
a.badge-light:hover, a.badge-light:focus {
  color: #212529;
  background-color: #dae0e5;
}
a.badge-light:focus, a.badge-light.focus {
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(248, 249, 250, 0.5);
}

.badge-dark {
  color: #fff;
  background-color: #343a40;
}
a.badge-dark:hover, a.badge-dark:focus {
  color: #fff;
  background-color: #1d2124;
}
a.badge-dark:focus, a.badge-dark.focus {
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(52, 58, 64, 0.5);
}
table {
        border-collapse: collapse;
        width: 70%;
        height: 10%;
        margin: 1rem auto;
    }
    
    th, td {
    padding: 0.5rem;
    text-align: left;
    border:...
}
    
    th {
        background-color: #0086de;
        color: white;
    }
    #updateInput[type="submit"] {
  background-color: red;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 10px; /* Ajoute un espacement à droite */
}

#formU img {
  vertical-align: middle; /* Aligne l'image verticalement */
}
</style>


    <!-- Appointment Start -->
    <?php
    
    $id=$_SESSION["iduser"];
  $db = config::getConnexion();
  $sql = "SELECT user.firstName AS patient_prenom, user.lastName AS patient_nom, user.EMAIL AS email, coach.prenomcoach AS doctor_prenom,coach.idcoach AS id_doc, coach.nomcoach AS doctor_nom, coach.specialite AS doctor_specialite, l_rendezvous.calendrier as rendezvousc, l_rendezvous.id, l_rendezvous.etat, ordonnance.id_rendezvous, ordonnance.nbrjour, ordonnance.nbrfois, ordonnance.id as idordo ,ordonnance.date_creation as dates
  FROM l_rendezvous
  INNER JOIN user ON l_rendezvous.id_user = user.id
  INNER JOIN coach ON l_rendezvous.id_doc = coach.idcoach
  INNER JOIN ordonnance ON l_rendezvous.id = ordonnance.id_rendezvous
  WHERE user.id = $id";
  $result = $db->query($sql);
  $list = $result->fetchAll();
?>

<table border="1" width="70%">
  <thead>
    <tr>
      <th>patient_nom</th>
      <th>patient_prenom</th>
      
      <th>doctor_specialite</th>
      <th>rendezvousc</th>
      <th>nbrjour</th>
      <th>nbrfois</th>
      <th>dcotor</th>
      <th></th>
      <th>action</th>
    </tr>
  </thead>
  <tbody>
    <?php if (is_array($list)): ?>
      <?php foreach ($list as $client): ?>
        <tr class="active-row">
          <td><?php echo $client['patient_nom']; ?></td>
          <td><?php echo $client['patient_prenom']; ?></td>
        
          <td><?php echo $client['doctor_specialite']; ?></td>
          <td><?php echo $client['rendezvousc']; ?></td>
          <td><?php echo $client['nbrjour']; ?></td>
          <td><?php echo $client['nbrfois']; ?></td>
          <td>
            <?php
              $doctorId = $client['id_doc'];
              $sql = "SELECT prenomcoach, nomcoach FROM coach WHERE idcoach = $doctorId";
              $result = $db->query($sql);
              if ($result->rowCount() > 0) {
                $row = $result->fetch();
                echo 'Dr. ' . $row['nomcoach'] . ' ' . $row['prenomcoach'];
              }
            ?>
          </td>
          <td><td align="center">
                   <form id="formU"method="POST" action="ordopdf.php">
                    <input id="updateInput" type="submit" name="update" value="PDF">
  <input type="hidden" name="id" value="<?= $client['idordo']; ?>">
  <img src="../View/pdf.png" alt="Logo PDF" style="width: 20px; height: 20px; margin-right: 5px;">

          </form></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>


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