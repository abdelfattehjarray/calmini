<?php

include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($id);

include '../controller/pharmacieC.php';
$error='';
$pharmacieC = new PharmacieC();
$IdCategorie=$_GET["id"];
  if(isset($_POST["type"]))
{
if($_POST["type"] == "search"){
    $listepharmacie = $pharmacieC->affichermedRecherche($_POST["search"],$IdCategorie);
  }
  else if($_POST["type"] == "tri"){
    $listepharmacie = $pharmacieC->afficherMedtri($IdCategorie);
  }
}
  else
  $listepharmacie = $pharmacieC->joinCategorie($IdCategorie);
if (
    isset($_POST["nom"]) &&
    isset($_POST["Description"]) &&
    isset($_POST["Fabricant"])&&
    isset($_POST["date"]) &&
    isset($_POST["prix"])&&
    isset($_POST["dispo"])&&
    isset($_POST["image"])
) {
    
        $pharmacie = new Pharmacie(
            $_POST['nom'],
            $_POST['Description'],
            $_POST['Fabricant'],
            $_POST['date'],
            $_POST['prix'],
            $_POST['dispo'],
            $_POST['image'],
            $IdCategorie

        );
        $pharmacieC->Ajoutermed($pharmacie,$IdCategorie);
        header("Location: pharmacieAdd.php?id=$IdCategorie");

}

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
<link rel="stylesheet" href="../css/styleJarray.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

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
                <a href="TableauPanel.php" >
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
                <a href="PharamaciePanel.php"  class="active">
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
                </a> <a href="AdminPanel.php">
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
        <main class="mai">
            <form  class="forum" action="" method="POST" id="myForm">
                <h2>Add New Medicament</h2>
                <div class="form-group">
                  <label for="Title">Nom de Medicament</label>
                  <input type="text" id="nom" name="nom" >
                  <span id="nomerror"></span>
                </div>
                <div class="form-group">
                  <label for="content">Description</label>
                  <textarea id="description" name="Description" ></textarea>
                  <span id="deserror"></span>
                </div>
                <div class="form-group">
                  <label for="Title">Fabricant</label>
                  <input type="text" id="fabricant" name="Fabricant" >
                  <span id="faberror"></span>
                </div>
                <div class="form-group">
                  <label for="Title">Date</label>
                  <input type="date" id="date" name="date" >
                  <span id="dateerror"></span>
                </div>
                <div class="form-group">
                  <label for="Title">prix</label>
                  <input type="text" id="prix" name="prix" >
                  <span id="prixerror"></span>
                </div>
                <div class="form-group">
                  <label for="Title">disponibilite</label>
                  <input type="text" id="dispo" name="dispo" >
                  <span id="dispoerror"></span>
                </div>
                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" id="image" name="image">
                  <span id="imageerror"></span>
                </div>
                <button type="submit">Submit</button>
                <a href="PharamaciePanel.php" style="background-color: #0275d8; color: #fff; border: none; padding: 12px 20px; font-size: 16px; font-weight: 600; border-radius: 10px; cursor: pointer; transition: all 0.3s ease; margin-top: 20px;">back</a>

              </form>
              <script>

let myForm = document.getElementById('myForm');

myForm.addEventListener('submit' , function(e){
    let mynom = document.getElementById('nom');

  if(mynom.value =='')
  {
    let error = document.getElementById('nomerror');
    error.innerHTML = "Le champs nom est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
  let mydesc = document.getElementById('description');

  if(mydesc.value =='')
  {
    let error = document.getElementById('deserror');
    error.innerHTML = "Le champs nom est requis";
    error.style.color = 'red';
    e.preventDefault();
  } 
  let myfab = document.getElementById('fabricant');

  if(myfab.value =='')
  {
    let error = document.getElementById('faberror');
    error.innerHTML = "Le champs nom est requis";
    error.style.color = 'red';
    e.preventDefault();
  }   
  let mydate = document.getElementById('date');

if(mydate.value =='')
{
  let error = document.getElementById('dateerror');
  error.innerHTML = "Le champs nom est requis";
  error.style.color = 'red';
  e.preventDefault();
}   
let myprix = document.getElementById('prix');

if(myprix.value =='')
{
  let error = document.getElementById('prixerror');
  error.innerHTML = "Le champs nom est requis";
  error.style.color = 'red';
  e.preventDefault();
}  
let mydispo = document.getElementById('dispo');

if(mydispo.value =='')
{
  let error = document.getElementById('dispoerror');
  error.innerHTML = "Le champs nom est requis";
  error.style.color = 'red';
  e.preventDefault();
}   
let myimg = document.getElementById('image');

if(myimg.value =='')
{
  let error = document.getElementById('imageerror');
  error.innerHTML = "Le champs nom est requis";
  error.style.color = 'red';
  e.preventDefault();
}   


 

})

      </script>
              <section class="recent-articles">
                <h2>Recent Medecament</h2>
                <form action="" method="POST">
             
    <input type="text" id="search-field" placeholder="Search..." name="search">
    <button type="submit" name="type" value="search">
search
                    </button>     
                     <button type="submit" name="type" value="tri">
tri
                    </button>  

</form>
  <ul class="article-list">
  <?php
  
    foreach ($listepharmacie as $Pharmacie) {
     ?>

    <li>

        <div class="article-info">
            <h3><?php echo $Pharmacie['nom_med']; ?></h3>
            <div class="actions">
            <a href="deletemedecament.php?num=<?php echo $Pharmacie['numero']; ?>&id=<?php echo $Pharmacie['Id_categorie']; ?>" >  <i class="fas fa-trash ">    </i>
            </a>
            <a href="updatemedecament.php?num=<?php echo $Pharmacie['numero']; ?>&id=<?php echo $Pharmacie['Id_categorie']; ?>" >  <i class="fas fa-edit ">    </i> 
            </a>
  </div>
            <span class="article-date">Prix : <?php echo $Pharmacie['prix']; ?></span>
            <span class="article-date">Date : <?php echo $Pharmacie['ex_date']; ?></span>
            <span class="article-date">Disponibilite : <?php echo $Pharmacie['Dispo']; ?></span>
          </div>
        <div class="article-image">
          <img src="../img/<?php echo $Pharmacie['img_med']; ?>" alt="Article 1">
        </div>
 

    </li>
    <?php
    }?>
  </ul>
              </section>
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
                    <img  src="data:image/png;base64,<?php echo base64_encode($nomUser["PICTURE"]); ?>">
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