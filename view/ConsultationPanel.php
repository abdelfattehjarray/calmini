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
<link rel="stylesheet" href="../css/test.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <a href="TableauPanel.php">
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
                <a href="ConsultationPanel.php" class="active" >
                    <span class="material-symbols-sharp">
                        meeting_room
                        </span>
                        <h3>Consultation</h3>
                </a>
                <a href="ordonnoncePanel.php">
                    <span class="material-symbols-sharp">
                        vaccines
                        </span>
                        <h3>ordonnonce</h3>
                </a>
                <a href="PharamaciePanel.php">
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
include_once ('../controller/rendez_vousC.php');
$clientC = new ClientC();
$list = $clientC->listrendezvous();

?>
  <style>
 .content-table {
  border-collapse: collapse;
  width: 100%;
  max-width: 500px;
  margin: 0 auto;
}

.content-table th,
.content-table td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

.content-table th {
  background-color: #6CB4EE;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.content-table td {
  font-size: 14px;
}

.active-row {
  background-color: #f7f7f7;
}

.active-row:hover {
  background-color: #6CB4EE;
}

.badge {
  display: inline-block;
  padding: 4px 8px;
  font-size: 12px;
  font-weight: bold;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  border-radius: 3px;
}

.badge-warning {
  background-color: #ffc107;
  color: #fff;
}

.badge-primary {
  background-color: #007bff;
  color: #fff;
}

.badge-info {
  background-color: #17a2b8;
  color: #fff;
}

.btn {
  display: inline-block;
  font-weight: 600;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  user-select: none;
  border: 1px solid transparent;
  padding: 8px 12px;
  font-size: 14px;
  line-height: 1.5;
  border-radius: 4px;
  transition: all 0.2s ease-in-out;
}

.btn-danger {
  color: #fff;
  background-color: #dc3545;
  border-color: #dc3545;
}

.btn-primary {
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
}

.make-appointment-btn {
  display: inline-block;
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

.make-appointment-btn:hover {
  background-color: #3d8b3d;
}
    
</style>

<input type="hidden" class="recherche" name="" id="myInput" placeholder="cherhcer" oninput="searchFun()"> 
<select id="stateSelect">
  <option value="">-- Select a state --</option>
  <option value="0">en attent</option>
  <option value="1">confirme</option>
  <option value="2">confirme par le docteur</option>
  <option value="3">termine</option>
</select>

        <table class="content-table" id="myTable">
  <thead>
    <tr>
      
      <th>patient_nom</th>
      <th>patient_prenom</th>
      <th>doctor_nom</th>
      <th>doctor_prenom</th>
      <th>calendrier</th>
      <th>specialite</th>
      <th>status</th>
      <th>etat de payment</th>
      <th></th>
      <th></th>
      <th></th>
      
      
    </tr>
  </thead>
  
  <tbody id="tableBody">
  
  <?php if (is_array($list))  ?>
  
                    <?php foreach ($list as $client): ?>
                      
      <tr class="active-row" data-state="<?php echo $client['etat']; ?>">
   
        <td><?php echo $client['patient_prenom']; ?></td>
        <td><?php echo $client['patient_nom']; ?></td>
        <td><?php echo $client['doctor_prenom']; ?></td>
        <td><?php echo $client['doctor_nom']; ?></td>
        <td><?php echo $client['calendrier']; ?></td>
        <td><?php echo $client['specialite']; ?></td>
        
        
        <td>
							<?php if($client['etat'] == 0): ?>
								<span class="badge badge-warning">en attent</span>
							<?php endif ?>
							<?php if($client['etat'] == 1): ?>
								<span class="badge badge-primary">confirme</span>
							<?php endif ?>
							<?php if($client['etat'] == 2): ?>
								<span class="badge badge-info">confirme par le docteur</span>
							<?php endif ?>
							<?php if($client['etat'] == 3): ?>
								<span class="badge badge-info">Done</span>
							<?php endif ?>
						</td>
            
            <td>
							<?php if($client['etatpayment'] == 0): ?>
								<span class="badge badge-warning">unpaid</span>
							<?php endif ?>
							<?php if($client['etatpayment'] == 1): ?>
								<span class="badge badge-primary">paid</span>
							<?php endif ?>
							
						</td>
            <td align="center">
            <form method="POST" action="updateClient.php">
            <input id="updateInput" type="submit" name="update" value="Update">
            <input type="hidden" name="id" value="<?= $client['id']; ?>">
           </form>
                    
                </td>

                <td>
                  
                <button type="button"  class="btn btn-danger" onclick="deleteClient(<?php echo $client['id']; ?>)">Delete</button>
                            </td>
                            <td>
	<?php if($client['specialite'] == 'Therapist' && $client['etat'] == 3): ?>
  
		<button name="appointment-btn" id="appointment-btn" class="make-appointment-btn" onclick="insertIdRdv(<?php echo $client['id']; ?>)">ordonnance</button>
	<?php endif; ?>
</td>
               
						</td>
            
      </tr>
      <script>function searchFun() {
  var input, filter, table, tr, stateSelect, stateValue, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  stateSelect = document.getElementById("stateSelect");
  stateValue = stateSelect.value;

  // Loop through all table rows, and hide those that don't match the search and state value
  for (i = 0; i < tr.length; i++) {
    // Hide the row by default
    tr[i].classList.add("hidden");

    // Check if the row contains the search query
    txtValue = tr[i].textContent || tr[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      // Check if the row state matches the selected state
      if (stateValue === "" || tr[i].getAttribute("data-state") === stateValue) {
        // Show the row if it matches the search and state value
        tr[i].classList.remove("hidden");
      }
    }
  }
}stateSelect.addEventListener("change", searchFun);</script>
      <script>
         function searchFun() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        // loop through all the td elements of the current row
        for (j = 0; j < tr[i].cells.length; j++) {
            td = tr[i].cells[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break; // exit the loop if a match is found
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}
function insertIdRdv(idRdv) {
  // Récupérer l'input avec l'ID unique
  var idRdvInput = document.getElementById("id_rendezvous");
  // Insérer l'ID du rendez-vous dans l'input
  idRdvInput.value = idRdv;
}
</script>
      <script>
function deleteClient(clientId) {
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
    xhttp.open("GET", "deleteClient.php?id=" + clientId, true);
    xhttp.send();
  }
}


</script>


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
    .hidden {
  display: none;
}
/* Style du select */
#stateSelect {
  font-size: 16px;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  background-color: #f2f2f2;
  color: #444;
}

/* Style des options */
#stateSelect option {
  font-size: 16px;
  background-color: #f2f2f2;
  color: #444;
}

/* Style des options hover */
#stateSelect option:hover {
  background-color: #ddd;
}

/* Style des options selectionnées */
#stateSelect option:checked {
  background-color: #007bff;
  color: #fff;
}
    </style>
<?php
// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=projetwb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}

// Récupération des données
$stmt = $pdo->prepare('SELECT COUNT(*) AS nombre_rendezvous, DATE_FORMAT(calendrier, "%Y-%m-%d") AS calendrier  FROM l_rendezvous GROUP BY DATE(calendrier)');
$stmt->execute();
$data = [];
$labels = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row['nombre_rendezvous'];
    $labels[] = $row['calendrier'];
}
?>

<canvas id="ventes"></canvas>
<script>
        var ctx = document.getElementById('ventes').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Nombre de rendez-vous selon la date',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 0.5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

<?php
include '../controller/ordonnanceC.php';
$error = '';

// Fonction pour récupérer la liste des docteurs depuis la table l_doctors
function getmed()
{
  $db = config::getConnexion();
  $sql = "SELECT numero as id_pharmacie, nom_med, Dispo FROM pharmacie ";
    // Exécution de la requête
  $req = $db->prepare($sql);
  try {
      $req->execute();
  } catch (Exception $e) {
      die('Error:' . $e->getMessage());
  }

  // Retourner les résultats de la requête
  return $req->fetchAll(PDO::FETCH_ASSOC);
}

$ordonnancee = new ordonnancee();
if (
    isset($_POST["id_pharmacie"]) &&
    isset($_POST["id_rendezvous"]) &&
    isset($_POST["nbrjour"]) &&
    isset($_POST["nbrfois"]) &&
    isset($_POST["date_creation"])
) {
    
    if (
        !empty($_POST["id_pharmacie"]) &&
        !empty($_POST["id_rendezvous"]) &&
        !empty($_POST["nbrjour"]) &&
        !empty($_POST["nbrfois"]) &&
        !empty($_POST["date_creation"])
    ) {
        $ordonnance = new ordonnance(
            null,
            $_POST['id_rendezvous'],
            $_POST['id_pharmacie'],
            $_POST['nbrjour'],
            $_POST['nbrfois'],
            new DateTime($_POST['date_creation'])
        );
        if($ordonnancee->addordonnance($ordonnance))
        {
          // Afficher un message de succès si l'ajout a réussi
          echo "Le rendez-vous a été ajouté avec succès !";
          
      } else {
          // Afficher un message d'erreur si l'ajout a échoué
          echo "Une erreur est survenue lors de l'ajout du rendez-vous.";
      }
        //header('Location:ListClients.php');
        exit();
    } else {
        $error = "Missing information";
    }
}
?>

  <div class="modal">
    <div class="modal-content">
      <span>Set Appointment with Your Doctor</span>

      <form id="myform" action="" method="POST">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="mb-3">
                
                <input type="hidden" id="id_rendezvous" name="id_rendezvous" value="">
              </div>
              <div class="mb-3">
                <label for="id_pharmacie" class="form-label">Médicament et disponibilité</label>
                <select class="form-control med-select" name="id_pharmacie" id="id_pharmacie">
                  <?php
                    // La boucle suivante est supposée récupérer des données à partir d'une fonction appelée "getmed()"
                    foreach (getmed() as $med) {
                      $selected = '';
                      if ($med['id_pharmacie'] == $_POST['id_pharmacie']) {
                        $selected = 'selected';
                      }
                      echo '<option value="' . $med['id_pharmacie'] . '" ' . $selected . '>' . $med['nom_med'] . ' ' . $med['Dispo'] . '</option>';
                    }
                  ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="nbrjour" class="form-label">Nombre de jours</label>
                <input type="number" class="form-control" name="nbrjour" id="nbrjour" maxlength="20">
              </div>
              <div class="mb-3">
                <label for="nbrfois" class="form-label">Nombre de fois</label>
                <input type="number" class="form-control" name="nbrfois" id="nbrfois">
              </div>
              <div class="mb-3">
   
    <input type="hidden" class="form-control" name="date_creation" id="date_creation" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
</div>
            </div>
          </div>
        </div>
        <input type="hidden" name="pharmacie_id" id="pharmacie_id" value="">
        <div class="d-grid">
        <button type="submit" name="ajouter" id="set-appointment-btn" onclick="handleAddAppointment()">Valider</button>
                  <button id="closeBtn">close</button>

        </div>
      </form>
    </div>
  </div>
<script>// Obtenez les éléments "nbrjour" et "nbrfois"
var nbrjourInput = document.getElementById("nbrjour");
var nbrfoisInput = document.getElementById("nbrfois");

// Ajoutez un événement de saisie à chaque champ
nbrjourInput.addEventListener("input", validateInputs);
nbrfoisInput.addEventListener("input", validateInputs);

function validateInputs() {
  // Obtenez les valeurs actuelles des champs
  var nbrjourValue = parseInt(nbrjourInput.value);
  var nbrfoisValue = parseInt(nbrfoisInput.value);

  // Vérifiez si les valeurs sont inférieures ou égales à 1
  if (nbrjourValue <= 0 || nbrfoisValue <= 0) {
    // Affichez un message d'erreur en dessous des champs
    var errorDiv = document.createElement("div");
    errorDiv.innerHTML = "Veuillez insérer des valeurs supérieures à 01";
    errorDiv.style.color = "red";
    nbrjourInput.parentNode.appendChild(errorDiv);
    nbrfoisInput.parentNode.appendChild(errorDiv.cloneNode(true));
  } else {
    // Supprimez le message d'erreur s'il existe
    var errorDivs = document.querySelectorAll(".error-message");
    errorDivs.forEach(function(div) {
      div.remove();
    });
  }
}</script>
 
 <script>
function updatePharmacieId() {
  var select = document.getElementById("id_pharmacie");
  var input = document.getElementById("pharmacie_id");
  input.value = select.value;
}


</script>

<script>
  ////////////////////////////////////////////////////////////////////// CONTROLE DE SAISIE NBRJOURS//////////////////////////////////////////////////////
  var nbrjourInput = document.getElementById("nbrjour");

  nbrjourInput.addEventListener("input", function(event) {
    var value = event.target.value;
    var isValid = /^([1-9]|[1-9][0-9]|[1-2][0-9][0-9]|3[0-5][0-9]|36[0-5])$/.test(value);

    if (!isValid) {
      nbrjourInput.setCustomValidity("Veuillez saisir un nombre entier positif compris entre 1 et 365.");
    } else {
      nbrjourInput.setCustomValidity("");
    }
  });
  ////////////////////////////////////////////////////////////////////// ECRIRE QUE DES CHIFFRE//////////////////////////////////////////////////////
// Récupération des éléments DOM pour les champs "nbrjour" et "nbrfois"
const nbrjourInput = document.getElementById('nbrjour');
const nbrfoisInput = document.getElementById('nbrfois');

// Ajout d'un événement "input" à chaque champ
nbrjourInput.addEventListener('input', function() {
  // Remplacement des caractères non numériques par une chaîne vide
  this.value = this.value.replace(/[^0-9]/g, '');
});

nbrfoisInput.addEventListener('input', function() {
  // Remplacement des caractères non numériques par une chaîne vide
  this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
<script>
   ////////////////////////////////////////////////////////////////////// CONTROLE DE SAISIE NBRFOIS//////////////////////////////////////////////////////
  var nbrfoisInput = document.getElementById("nbrfois");

  nbrfoisInput.addEventListener("input", function(event) {
    var value = event.target.value;
    var isValid = /^([1-9]|10)$/.test(value);

    if (!isValid) {
      nbrfoisInput.setCustomValidity("Veuillez saisir un nombre entier positif compris entre 1 et 10.");
    } else {
      nbrfoisInput.setCustomValidity("");
    }
  });
</script>

 <script>
    // FPNCTION POUR CAPTURE L'ID RENDEZ VOUS DU TABLEAU///////////////////////////////////////////////////////////////
  // Capture l'événement de clic sur le bouton de rendez-vous
  document.getElementById("appointment-btn").addEventListener("click", function() {
    // Récupère l'identifiant du rendez-vous
    const appointmentId = document.getElementById("id_rendezvous").value;
    // Affecte l'identifiant au champ caché du formulaire de rendez-vous
    document.getElementById("appointment-form").elements["appointment_id"].value = appointmentId;
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
  xhr.open('POST', 'addordo.php');
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
$(document).ready(function(){
  // recharger la page après la fermeture du modal
  $('#closeBtn, #set-appointment-btn').click(function(){
    location.reload(); // recharger la page
  });
});

</script>

<script>
   $(document).ready(function() {
        $('#id_pharmacie').on('change', function() {
            var pharmacieId = $(this).val();
            $('#pharmacie_id').val(pharmacieId);
        });
    });
    
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