<?php
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($id);

include '../controller/ticketsC.php';
include '../controller/evenementC.php';
include '../controller/mail.php';
include '../vendor/autoload.php';

$error='';
$Id_event=$_GET["id"];
$ticketsC = new ticketsC();
$EvenementC = new EvenementC();
$listeticketss = $ticketsC->joinEvenement($Id_event);


  if(isset($_POST["type"]))
{
if($_POST["type"] == "search"){
    $listetickets = $ticketsC->afficherticRecherche($_POST["search"],$Id_event);
  }
  else if($_POST["type"] == "tri"){
    $listetickets = $ticketsC->affichertictri($Id_event);
  }
}
  else
  $listetickets = $ticketsC->joinEvenement($Id_event);
if (
    isset($_POST["prix_ticket"]) &&
    isset($_POST["disponibilite"])&&
    isset($_POST["idevent"])
   
) {
     $evn = $EvenementC->recupererEvent($_POST["idevent"]);
     if($evn['quantite'] > 0){
        if($evn['solde'] == 0){
        $tickets = new tickets(
            $Id_event,
            $_POST['prix_ticket'],
            $_POST['disponibilite']
        );
        $ticketsC->Ajoutertic($tickets,$Id_event);
        $email="hadilzgheb00@gmail.com";
    $Id_event = $_POST['idevent'];
    $prix_ticket = $_POST['prix_ticket'];
    $disponibilite = $_POST['disponibilite'];
    $email_content = array(
       'Subject' => 'Reservation bien ajouter',
       'body' => "Bonjour Mr/Mme Bienvenue chez CALMINI ,
       votre participation est confirmée : <br>
       Id_event : $Id_event <br>
       prix_ticket : $prix_ticket <br>
       disponibilite : $disponibilite <br>
       cordialement."
   );
   sendemail($email,$email_content);
        $quant = $evn['quantite'];
        $quant--;
        $EvenementC->updateQuantite($_POST["idevent"],$quant);
}
else if($evn['solde'] == 1){
    $price = ($_POST['prix_ticket']*0.8);
    $tickets = new tickets(
        $Id_event,
        $price,
        $_POST['disponibilite']
    );
    $ticketsC->Ajoutertic($tickets,$Id_event);
    $email="hadilzgheb00@gmail.com";
$Id_event = $_POST['idevent'];
$disponibilite = $_POST['disponibilite'];
$email_content = array(
   'Subject' => 'Reservation bien ajouter AVEC SOLDE 20% !',
   'body' => "Bonjour Mr/Mme Bienvenue chez CALMINI ,
   votre participation est confirmée : <br>
   Id_event : $Id_event <br>
   prix_ticket : $price <br>
   disponibilite : $disponibilite <br>
   cordialement."
);
sendemail($email,$email_content);
    $quant = $evn['quantite'];
    $quant--;
    $EvenementC->updateQuantite($_POST["idevent"],$quant); 
}
        header("Location: ticketadd.php?id=$Id_event");
    }
    else{
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Oops Ticket non disponible !')
        window.location.href='EvenementPanel.php';
    </SCRIPT>");
    }

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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.js"></script>

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
                <a href="PharamaciePanel.php"  >
                    <span class="material-symbols-sharp">
                        vaccines
                        </span>
                        <h3>Pharamacie</h3>
                </a>
                <a href="EvenementPanel.php" class="active">
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
                <h2>Add New Ticket</h2>
                <div class="form-group">
                  <label for="Title">Prix</label>
                  <input type="text" id="prix" name="prix_ticket" >
                  <span id="prixerror"></span>
                </div>
                <div class="form-group">
                <label for="Title">disponibilite</label>
                  <input type="text" id="dispo" name="disponibilite" >
                  <span id="dispoerror"></span>
                    <input type="text" name="idevent" value="<?php echo $Id_event; ?>" hidden>
                 
                </div>
                <button type="submit">Submit</button>
                <a href="EvenementPanel.php" style="background-color: #0275d8; color: #fff; border: none; padding: 12px 20px; font-size: 16px; font-weight: 600; border-radius: 10px; cursor: pointer; transition: all 0.3s ease; margin-top: 20px;">back</a>

              </form>

              <script>

let myForm = document.getElementById('myForm');


myForm.addEventListener('submit' , function(e){
    let myprix = document.getElementById('prix');
    let mydispo = document.getElementById('dispo');
    if(myprix.value =='')
  {
    let error = document.getElementById('prixerror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  
  if(mydispo.value =='')
  {
    let error = document.getElementById('dispoerror');
    error.innerHTML = "Le champs  est requis";
    error.style.color = 'red';
    e.preventDefault();
  }  })
  </script>      
 
              <section class="recent-articles">
                <h2>Recent Tickets</h2>
                <button id="download-button" onclick="convertToPDF()" class="pdf" >Download as PDF</button>
                <style>
                    .pdf{
                        background-color: #0275d8;
    color: #fff;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 20px;
                    }
                </style>
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
  
    foreach ($listetickets as $tickets) {
     ?>

    <li>

        <div class="article-info">
            <h3><?php echo $tickets['Id_ticket']; ?></h3>
            <div class="actions">
            <a href="deletetic.php?Id_ticket=<?php echo $tickets['Id_ticket']; ?>&Id_event=<?php echo $tickets['Id_event']; ?>" >  <i class="fas fa-trash ">    </i>
            </a>
            <a href="updatetic.php?Id_ticket=<?php echo $tickets['Id_ticket']; ?>&Id_event=<?php echo $tickets['Id_event']; ?>" >  <i class="fas fa-edit ">    </i> 
            </a>
            
  </div>
            <span class="article-date">Prix : <?php echo $tickets['prix_ticket']; ?></span>
            <span class="article-date">Disponibilite : <?php echo $tickets['disponibilite']; ?></span>
          </div>
        
 

    </li>
    <?php
    }?>
  </ul>
  <table id="table_id" class="table table-striped table-hover" hidden>
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id_ticket</th>
      <th scope="col">prix_ticket</th>
      <th scope="col">disponibilite</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listeticketss as $tickets) { ?>
      <tr>
        <td><?php echo $tickets['Id_ticket']; ?></td>
        <td><?php echo $tickets['prix_ticket']; ?></td>
        <td><?php echo $tickets['disponibilite']; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  function convertToPDF() {
    var doc = new jsPDF();
  doc.setFontSize(14);
  doc.text("Liste des tickets", 20, 20);
  var currentDate = new Date();
  var formattedDate = currentDate.getDate() + "-" + (currentDate.getMonth() + 1) + "-" + currentDate.getFullYear();
  doc.text("Date: " + formattedDate, 20, 30);

  doc.autoTable({
    html: '#table_id',
    startY: 40, 
    styles: {
      cellPadding: 1,
      fontSize: 12,
    }
  });
  doc.save("tickets.pdf");
  }
</script>
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