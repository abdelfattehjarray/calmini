<?php
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNom($id);


include '..\controller\pharmacieC.php';
$error='';
$idcat=$_GET["id"];
$pharmacieC = new PharmacieC();
//$listePharmacie = $pharmacieC->joinCategorie($idcat);
  if(isset($_POST["type"]))
{
if($_POST["type"] == "search"){
    $listePharmacie = $pharmacieC->affichermedRecherche($_POST["search"],$idcat);
  }
  else if($_POST["type"] == "tri"){
    $listePharmacie = $pharmacieC->affichermedtri($idcat);
  }
}
  else
  $listePharmacie = $pharmacieC->joinCategorie($idcat);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>
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
                                    <a href="mesrendezvous.php" class="nav-link ">Rendez vous</a>
                </li>
                <li class="nav-item">
                  <a href="mesordo.php" class="nav-link ">Ordonnonce</a>
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
   
    <!-- Navbar End -->


    <!-- main -->
   
 
    <div class="container-fluid py-5"><a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" href="PharmacieClient.php"><i  class='bi bi-arrow-left'></i></a>
    <form class="mx-auto" style="width: 100%; max-width: 600px;" action="" method="POST">
                <div class="input-group mb-4">
                    <input type="text" class="form-control border-primary w-50" placeholder="Search..." name="search">
                    <button class="btn btn-dark border-0 w-25" type="submit" name="type" value="search">Recherche</button>
                    <button class="btn btn-dark border-0 w-25" type="submit" name="type" value="tri">Tri</button>
                </div>
</form>    
    
<div class="container">
  <div class="row justify-content-center align-items-center">

    <?php

      foreach ($listePharmacie as $Pharmacie) {

    ?>
    <div class="col-lg-4 team-item mb-4">
      <div class="row g-0 bg-light rounded overflow-hidden ">
        <div class="col-12 col-sm-5 h-100">
          <img class="img-fluid h-100" src="../img/<?php echo $Pharmacie['img_med']; ?>" style="object-fit: cover;">
        </div>
        <div class="col-12 col-sm-7 h-100 d-flex flex-column">
          <div class="mt-auto p-4">
            <h3>Nom du Medicament</h3> 
            <h6 class="fw-normal fst-italic text-primary mb-4" id="nom_med"><?php echo $Pharmacie['nom_med']; ?></h6>
            <p class="m-0" id="desc">Description: <?php echo $Pharmacie['description']; ?></p>
            <p class="m-0" id="price">Prix: <?php echo $Pharmacie['prix']; ?> DT</p>
          </div>
          <div class="d-flex mt-auto border-top p-4">
            <button class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" name="buybtn" onclick="addToCart('<?php echo $Pharmacie['nom_med']; ?>', <?php echo $Pharmacie['prix']; ?>)"><span class='bi bi-bag-dash-fill'></span></button>
          </div>
        </div>
      </div>
    </div>
    <?php
      }
    ?>
  </div>
</div>

      </div>


 <div class="mt-5">
        <h3>Panier</h3>
        <table id="carttable" class="table table-striped" >
            <thead>
                <tr>
                    <th scope="col">Nom du medicament</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col">Quantite</th>
                    <th scope="col">Prix total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="cartTable">
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <td id="totalPrice">0</td>
                    <td></td>
                </tr>
                
            </tfoot>
            
        </table>
        <style>
        .pdf-button {
    background: #2196f3;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    border: none;
    padding: 12px 32px 12px 16px;
    cursor: pointer;
  }
  
  .pdf-button i {
    margin-left: 8px;
    font-size: 20px;
  }
  </style>
        <button id="generatePdfButton" class="pdf-button">Download PDF <i class="fa fa-file-pdf-o"></i></button>


<script>
   
   document.getElementById('generatePdfButton').addEventListener('click', function() {
      var rows = document.querySelectorAll('#cartTable tr');
      var data = [];
      for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var columns = row.getElementsByTagName('td');
        var name = columns[0].textContent;
        var price = columns[1].textContent;
        var quantity = Math.floor(Math.random() * 9) + 1;
        data.push({ name: name, price: price, quantity: quantity });
      }


      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'generatepdf.php');
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.onload = function() {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            alert(response.message);
          } else {
            alert('Failed to generate PDF');
          }
        }
      };
      xhr.send(JSON.stringify(data));
    });
  </script>
       <style>
    #sendmail-button {
        display: block;
        margin: 0 auto;
        width: 100px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border-radius: 25px;
        text-decoration: none;
    }
    .g-recaptcha {
      display: flex;
      justify-content: center;
    }

  
</style>
<span id="payerror" style="display: flex;justify-content: center;"></span>
<div class="g-recaptcha" data-sitekey="6LdeFM4lAAAAAKD9StLLjrcgQopYA9zxOyQnsinW"> </div>
<span id="capchaerror" style="display: flex;justify-content: center;"></span>

<a class="" id="sendmail-button"><span class="bi bi-credit-card"></span>Buy</a> 


                    
              
    </div>
</div>
<script>
    let cart = [];

    function addToCart(nom_med, prix) {
        let quantity = parseInt(prompt("Entrez la quantité désirée:"));
        if (isNaN(quantity) || quantity <= 0) {
            alert("La quantité doit être un nombre positif.");
            return;
        }

        let totalPrice = quantity * prix;

        let item = { nom_med: nom_med, prix: prix, quantity: quantity, totalPrice: totalPrice };
        cart.push(item);

        updateCartTable();
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        updateCartTable();
    }

    function updateCartTable() {
  let cartTable = document.getElementById("cartTable");
  let totalPriceElement = document.getElementById("totalPrice");
  let sendmailButton = document.getElementById("sendmail-button");


  cartTable.innerHTML = "";
  let total = 0;
  for (let i = 0; i < cart.length; i++) {
    let item = cart[i];
    let row = document.createElement("tr");
    let nom_medCell = document.createElement("td");
    nom_medCell.innerText = item.nom_med;
    row.appendChild(nom_medCell);
    let prixCell = document.createElement("td");
    prixCell.innerText = item.prix + " DT";
    row.appendChild(prixCell);
    let quantityCell = document.createElement("td");
    let quantityInput = document.createElement("input");
    quantityInput.type = "number";
    quantityInput.min = 1;
    quantityInput.value = item.quantity;
    quantityInput.id = "qinput"; 
    quantityInput.addEventListener("input", function() {
      item.quantity = quantityInput.value;
      updateCartTable();
    });
    quantityCell.appendChild(quantityInput);
    row.appendChild(quantityCell);
    let deleteCell = document.createElement("td");
    let deleteButton = document.createElement("button");
    deleteButton.innerText = "Delete";
    deleteButton.classList.add("btn", "btn-danger");
    deleteButton.addEventListener("click", function() {
      cart.splice(i, 1);
      updateCartTable();
    });
    deleteCell.appendChild(deleteButton);
    row.appendChild(deleteCell);
    cartTable.appendChild(row);
    total += item.prix * item.quantity;
  }
  totalPriceElement.innerText = total + " DT";
 


   return total;
}

 let sendmailButton = document.getElementById("sendmail-button");
    sendmailButton.addEventListener('click', function() {
      let prix=updateCartTable();
        var grecaptcha = window.grecaptcha;
        var response = grecaptcha.getResponse();

        if (response != 0 ) {
          if(prix!=0){
            sendmailButton.href = `sendmail.php?id=<?php echo $idcat ?>&prix=${prix}`;
            return true;}
            else{
               let error = document.getElementById('payerror');
            error.innerHTML = "panier vide";
            error.style.color = 'red';

            }
        } else {
            let error = document.getElementById('capchaerror');
            error.innerHTML = "Please verify you are not a Robot";
            error.style.color = 'red';
          
            return false;
        }
    });
            




</script>



                    <!-- main -->
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
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
            integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        ></script>
    
    
</body>

</html>

