<?php 
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($id);

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
                <a href="ordonnoncePanel.php" class="active">
                    <span class="material-symbols-sharp">
                        vaccines
                        </span>
                        <h3>ordonnonce</h3>
                </a>
                <a href="PharamaciePanel.php"  >
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
        <main>
        <?php
include_once ('../controller/ordonnanceC.php');
$ordonnancee = new ordonnancee();
$list = $ordonnancee->listrordonnance();

?>
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
    background-color: #009879;
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
    background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.content-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
.badge {
    transition: none;
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
    .btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}
    
</style>

<table class="content-table">
  <thead>
    <tr>
    <th>iduser</th>
    <th>idordo</th>
      <th>patient_nom</th>
      <th>patient_prenom</th>
      <th>doctor_nom</th>
      <th>doctor_prenom</th>
      <th>doctor_specialite</th>
      <th>rendezvousc</th>
      <th>nbrjour</th>
      <th>nbrjois</th>
      <th>statut</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody  id="tableBody">
    <?php if (is_array($list)) ?>
      <?php foreach ($list as $client): ?>
        <tr class="active-row">
        <td><?php echo $client['id1']; ?></td>
        <td><?php echo $client['idordo']; ?></td>
          <td><?php echo $client['patient_nom']; ?></td>
          <td><?php echo $client['patient_prenom']; ?></td>
          <td><?php echo $client['doctor_nom']; ?></td>
          <td><?php echo $client['doctor_prenom']; ?></td>
          <td><?php echo $client['doctor_specialite']; ?></td>
          <td><?php echo $client['rendezvousc']; ?></td>
          <td><?php echo $client['nbrjour']; ?></td>
          <td><?php echo $client['nbrfois']; ?></td>
          <td>
            <?php if($client['etat'] == 0): ?>
              <span class="badge badge-warning">Pending Request</span>
            <?php elseif($client['etat'] == 1): ?>
              <span class="badge badge-primary">Confirmed</span>
            <?php elseif($client['etat'] == 2): ?>
              <span class="badge badge-info">Rescheduled</span>
            <?php elseif($client['etat'] == 3): ?>
              <span class="badge badge-info">Done</span>
            <?php endif; ?>
          </td><td align="center">
                    <form method="POST" action="updateordo.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $client['idordo']; ?> name="id">
                    </form>
                    </form>
                </td>
         
          <td>
            <button type="button" onclick="deleteordo(<?php echo $client['idordo']; ?>)">Delete</button>
          </td>
         
        </tr>
        <?php endforeach; ?>  
  </tbody>
  
</table>
<div id="pagination"></div>

<script>function displayRows(pageNumber) {
  var rows = document.querySelectorAll('#tableBody tr');
  var rowsPerPage = 3;
  var startIndex = (pageNumber - 1) * rowsPerPage;
  var endIndex = startIndex + rowsPerPage;
  var paginatedRows = Array.prototype.slice.call(rows, startIndex, endIndex);

  // hide all rows
  rows.forEach(function(row) {
    row.style.display = 'none';
  });

  // display the paginated rows
  paginatedRows.forEach(function(row) {
    row.style.display = '';
  });

  // create the pagination links
  var pagination = document.getElementById('pagination');
  var totalPages = Math.ceil(rows.length / rowsPerPage);

  pagination.innerHTML = '';
  for (var i = 1; i <= totalPages; i++) {
    var link = document.createElement('a');
    link.href = '#';
    link.textContent = i;
    link.addEventListener('click', function() {
      displayRows(parseInt(this.textContent));
    });
    pagination.appendChild(link);
  }
}

// display the first page by default
displayRows(1);
var searchInput = document.getElementById('myInput');
searchInput.addEventListener('input', function() {
  var searchTerm = this.value.toLowerCase();

  // filter the rows based on the search term
  var rows = document.querySelectorAll('#tableBody tr');
  var filteredRows = Array.prototype.filter.call(rows, function(row) {
    return row.textContent.toLowerCase().indexOf(searchTerm) > -1;
  });

  // display the filtered rows
  displayRows(1);

  // update the pagination links based on the filtered rows
  var paginationLinks = document.querySelectorAll('#pagination a');
  paginationLinks.forEach(function(link, index) {
    if (index < filteredRows.length / 3) {
      link.style.display = '';
    } else {
      link.style.display = 'none';
    }
  });
});
</script>
<style>#pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    #pagination a,
    #pagination span {
        display: inline-block;
        padding: 5px 10px;
        border: 1px solid #ccc;
        margin: 0 5px;
        text-decoration: none;
        color: green;
    }

    #pagination a:hover {
        background-color: #ccc;
    }

    #pagination .current {
        background-color: green;
        color: #fff;
        border-color: #333;
    }
    </style>


      <script>

</script>
<script>
  function deleteordo(clientId) {
  if (confirm("Are you sure you want to delete this client?")) {
    // Send an AJAX request to delete the client
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Update the page after the client is deleted
        var response = this.responseText;
        if (response == "success") {
          // Remove the client from the table
          var row = document.getElementById("client_" + clientId);
          row.parentNode.removeChild(row);
        } 
        
      }
    };
    xhttp.open("GET", "deleteordo.php?idordo=" + clientId, true);
    xhttp.send();
  }
}
    
 

</script>
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