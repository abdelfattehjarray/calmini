<?php 
include_once('../controller/UserC.php');
require "../controller/coachC.php";
require "../model/coach.php";
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNom($id);
$coachC = new coachC();
$listCoachs= $coachC->displaycoachs();
?>
<?php

include_once ('../controller/rendez_vousC.php');;



$error = "";


var_dump($_POST);

$db=config::getConnexion();
if(isset($_SESSION['idUser'])){
   $id = $_SESSION['idUser'];
}else{
   $id = '';
};



if(isset($_POST['ajouter']) )
{
    $doctorId = $_POST['id_doc'];
   
    $LaDate = $_POST['calendrie'];
    $LaDatec = $_POST['date_creation'];
    if (!empty($LaDate))
    {
        $rdv = new rendezvous($LaDate, $LaDatec);
        $rdvC = new ClientC();
        
        if ($rdvC->addRendezvous($rdv,$doctorId)) {
            // Afficher un message de succès si l'ajout a réussi
            echo "Le rendez-vous a été ajouté avec succès !";
        } else {
            // Afficher un message d'erreur si l'ajout a échoué
            echo "Une erreur est survenue lors de l'ajout du rendez-vous.";
        }
     
    
 
  }
  else 
        // Afficher un message d'erreur si l'un des champs est vide
        echo "Veuillez remplir tous les champs.";
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
                  <a href="mesordo.php" class="nav-link ">mes ordonnonce</a>
                </li>
                <li class="nav-item">
                  <a href="MedicinsClient.php" class="nav-link active">Medicins</a>
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
  
    <!-- Search End -->


    <!-- Search Result Start -->
    <?php
$db = config::getConnexion();
$sql = "SELECT idcoach,nomcoach, prenomcoach,specialite,tel,mail,experience,image FROM coach ";
$result = $db->query($sql);
?>  
    <!-- Search End -->
    <div>
    <?php while ($row = $result->fetch()) { 
        $doctorId = $row['idcoach'];
        $doctorNom = $row['nomcoach'] . ' ' . $row['prenomcoach'];

        $doctorspecialite = $row['specialite'];
        $doctortel = $row["tel"];
        $doctormail= $row["mail"];
        $doctorexperience= $row["experience"];
        $doctorimage= $row["image"]
        
    ?>
        <div>
            <table>
                <td class="doctor-name">
                <img src="../img/<?php echo $doctorimage; ?>" alt="<?php echo $doctorNom; ?>">
                    <h3>Dr. <?php echo $doctorNom; ?></h3>
                    <p><?php echo $doctortel; ?></p>
                    <p><?php echo $doctorspecialite; ?></p>
                    <p><?php echo $doctorexperience; ?></p>
                    <button name="appointment-btn" id="appointment-btn" class="make-appointment-btn" data-doctor-id="<?php echo $doctorId; ?>" data-doctor-name="<?php echo $doctorNom; ?>" onclick="addDoctorId(<?php echo $doctorId; ?>)">Set Appointment</button>
                   <br> <?php
// Requête SQL pour calculer la moyenne des notes
$stmt = $db->prepare("SELECT AVG(note) AS moyenne FROM l_rendezvous WHERE id_doc = :doctorId AND note > 0");
$stmt->bindParam(':doctorId', $doctorId);
$stmt->execute();
$row = $stmt->fetch();
$moyenne = round($row['moyenne'], 1); // Arrondir la moyenne à une décimale
// Afficher la moyenne sous forme d'étoiles
echo "<p class='star-rating'>Avis  : ";
if ($moyenne > 0) {
    for ($i = 1; $i <= 5; $i++) {
        if ($moyenne >= $i) {
            echo "<i class='fa fa-star'></i>"; // Étoile pleine
        } elseif ($moyenne >= $i - 0.5) {
            echo "<i class='fa fa-star-half-o'></i>"; // Demi-étoile
        } else {
            echo "<i class='fa fa-star-o'></i>"; // Étoile vide
        }
    }
} else {
    echo "Pas encore de notes."; // Si aucune note n'a été donnée
}
echo "</p>";
?>
                </td>
                <a href="crud_avis.php?idCoach=<?php  echo $doctorId; ?>" >Donner un avis</a>
            </table>
        </div>
    <?php } ?>
    
    <style>


.schedule-appointment-btn {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px;
}

.schedule-appointment-btn:hover {
  background-color: #3e8e41;
}




  #appointment-btn {
    background-color:#008374;
    border: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }

  #appointment-btn:hover {
    background-color:#88e0d5; 
  }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 2rem;
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 1rem;
    }

    table {
    border-collapse: collapse;
    width: 90%; /* Largeur de 90% pour occuper plus d'espace sur la page */
    margin: 0 auto;
    table-layout: fixed;
}

th, td {
    padding: 1rem; /* Un peu plus d'espace pour le texte */
    text-align: center;
    border: 1px solid #ddd;
    width: auto; /* ou utilisez une valeur de largeur spécifique */
}

th {
    background-color: #8BC34A; /* Couleur verte pour les en-têtes de colonne */
    color: white; /* Texte en blanc pour contraster avec la couleur de fond */
}



    input[type="text"], input[type="datetime-local"] {
        padding: 0.5rem;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 1rem;
        width: 70%;
        margin-bottom: 1rem;
    }

    input[type="submit"], input[type="reset"] {
        background-color: #4CAF50;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 1rem;
        font-size: 1rem;
    }

    input[type="reset"] {
        background-color: #f44336;
    }

    /* Styles pour la fenêtre modale */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5);
}

.modal-content {
  background-color: white;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 40%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}



#LaDate {
  padding: 0.5rem;
  font-size: 1rem;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

#LaDate:focus {
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
  outline: none;
}
.star-rating {
    font-size: 24px;
    display: inline-block;
    margin-left: 10px;
    color: #f5c33b;
}

.star-rating .fa {
    font-size: inherit;
    color: inherit;
}

.star-rating .fa-star {
    color: #f5c33b;
}

</style>







<div>
  
  <div class="modal">
    <div class="modal-content">
    <span id="set-appointment-text">Set Appointment with Your Doctor</span>

    
    <!-- Formulaire pour prendre un rendez-vous -->
    <form id="myform" method="POST" action="">
        <table border="1" align="center">
            <input type="hidden" name="id_doc" id="id_doc" value="">
            <tr>
                <td><label>Date et le temps de rendez vous:</label></td>
                <td><input type="datetime-local" name="calendrie" id="calendrie"></td>
            </tr>
            <tr>
                
                <td> <input type="hidden" class="form-control" name="date_creation" id="date_creation" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly></td>
            </tr>
            <tr align="center">
                <td><button type="submit" name="ajouter" id="set-appointment-btn">Valider</button></td>
                <td><button id="closeBtn">Close</button></td>
            </tr>
        </table>
    </form>
</div>
<script>
  const calendrierInput = document.getElementById("calendrie");
  const form = document.getElementById("myform");

  form.addEventListener("submit", function(event) {
    const selectedDate = new Date(calendrierInput.value);
    const currentDate = new Date();

    if (selectedDate <= currentDate) {
      event.preventDefault();
      const errorMessage = document.createElement("p");
      errorMessage.style.color = "red";
      errorMessage.textContent = "La date sélectionnée doit être supérieure à la date et heure actuelles.";
      calendrierInput.insertAdjacentElement("afterend", errorMessage);
    }
  });
</script>
<script>
// Récupérer les éléments nécessaires du DOM
const makeAppointmentBtns = document.querySelectorAll('.make-appointment-btn');
const modal = document.querySelector('.modal');
const modalContent = document.querySelector('.modal-content');
const setAppointmentBtn = document.getElementById('#set-appointment-btn');
const closeBtn = document.getElementById('#closeBtn');


// Fonction pour afficher la fenêtre modale
function showModal() {
  modal.style.display = 'block';
}

// Fonction pour masquer la fenêtre modale
function hideModal() {
  modal.style.display = 'none';
}

// Ajouter un écouteur d'événement au bouton pour afficher la fenêtre modale
makeAppointmentBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    showModal();
  });
});

// Ajouter un écouteur d'événement au bouton de validation pour enregistrer les données et masquer la fenêtre modale
setAppointmentBtn.addEventListener('click', (event) => {
  event.preventDefault();
  const formData = new FormData(document.getElementById('myform'));
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'MedicinsClient.php');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Faire quelque chose avec la réponse
      console.log(xhr.responseText);
    } else {
      // Gérer l'erreur
      console.log('Une erreur s\'est produite: ' + xhr.status);
    }
    hideModal();
  };
  xhr.send(formData);
});

// Ajouter un écouteur d'événement au bouton de fermeture pour masquer la fenêtre modale

closeBtn.addEventListener('click', () => {
  hideModal();

});

// Ajouter un écouteur d'événement à la fenêtre modale pour la masquer si l'utilisateur clique à l'extérieur de la fenêtre
// Ajouter un écouteur d'événement à la fenêtre modale pour la masquer si l'utilisateur clique à l'extérieur de la fenêtre
modal.addEventListener('click', (event) => {
  if (event.target === modal) {
    hideModal();  
  }
});


</script>
<script>
    // Fonction pour ajouter l'ID du médecin sélectionné dans le champ caché
    function addDoctorId(doctorId) {
        document.getElementById("id_doc").value = doctorId;
    }
</script>
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