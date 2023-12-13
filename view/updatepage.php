<?php
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($id);

include '../controller/evenementC.php';
$Evenementc = new Evenementc();
$idevent=$_GET["Id_ticket"];

if (
    isset($_POST["Title"]) &&
    isset($_POST["date_deb"]) &&
    isset($_POST["date_fin"])&&
    isset($_POST["Adresse"]) &&
    isset($_POST["Organisateurs"])&&
    isset($_POST["cout"])&&
    isset($_POST["Tags"])&&
    isset($_POST["Image"])
) {
    
        $Evenement = new Evenement(
            $_POST['Title'],
            $_POST['date_deb'],
            $_POST['date_fin'],
            $_POST['Adresse'],
            $_POST['Organisateurs'],
            $_POST['cout'],
            $_POST['Tags'],
            $_POST['Image'],1
        );
        $Evenementc->modifierevent($idevent,$Evenement);
        header('Location: EvenementPanel.php');

}
$Evenement = $Evenementc->recupererevent($idevent);

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
            <form  class="forum" action="" method="POST" >
                <h2>Add New Medicament</h2>
                <div class="form-group">
                  <label for="Title">titre de evenement</label>
                  <input type="text" id="Title" name="Title" value="<?php echo $Evenement['Title']; ?>">
                </div>
                <div class="form-group">
                  <label for="content">date debut</label>
                  <input type="date" id="Title" name="date_deb" value="<?php echo $Evenement['date_deb']; ?>">
                </div>
                <div class="form-group">
                  <label for="content">date fin</label>
                  <input type="date" id="Title" name="date_fin" value="<?php echo $Evenement['date_fin']; ?>">
                </div>
                <div class="form-group">
                  <label for="Title">adresse</label>
                  <input type="text" id="Title" name="Adresse" value="<?php echo $Evenement['Adresse']; ?>">
                </div>
                <div class="form-group">
                  <label for="Title">organisateurs</label>
                  <input type="text" id="Title" name="Organisateurs" value="<?php echo $Evenement['Organisateurs']; ?>">
                </div>
                <div class="form-group">
                  <label for="Title">cout</label>
                  <input type="text" id="Title" name="cout" value="<?php echo $Evenement['cout']; ?>">
                </div>
                <div class="form-group">
                  <label for="Title">tags</label>
                  <input type="text" id="Title" name="Tags" value="<?php echo $Evenement['Tags']; ?>">
                </div>
                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="text" id="image" name="Image" value="<?php echo $Evenement['Image']; ?>">
                </div>
                <button type="submit">Submit</button>
              </form>
              <section class="recent-articles">
                <h2>Recent Articles</h2>
                <form action="" method="POST">
             
    <input type="text" id="search-field" placeholder="Search..." name="search">
    <button type="submit" name="type" value="tria">
Submit
                    </button>     
                     <button type="submit" name="type" value="tria">
tri
                    </button>  

</form>
  
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