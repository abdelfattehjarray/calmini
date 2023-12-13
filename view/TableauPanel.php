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
                <a href="TableauPanel.php"  class="active" >
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
<h1>Tableau de bord</h1>
<div class="date">
    <input type="date">
</div>
<div class="insights">
    <div class="sales">
        <span class="material-symbols-sharp">
            analytics
            </span>
            <div class="middle">
                <div class="left">
<h3>Ventes totales</h3>
                <h1>$25,024</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx='38' cy='38' r='36'></circle>
                    </svg>
                    <div class="number">
                        <p>81%</p>
                    </div>
                </div>
            </div>
            <small class="text-muted">Dernières 24 heures</small>
    </div>
            <!----- end of sales -->
            <div class="expenses">
                <span class="material-symbols-sharp">
                    bar_chart
                    </span>
                    <div class="middle">
                        <div class="left">
        <h3>Dépenses totales</h3>
                        <h1>$14,160</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>62%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Dernières 24 heures</small>
            </div>
                    <!----- end of expenses -->
                    <div class="income">
                        <span class="material-symbols-sharp">
                            stacked_line_chart
                            </span>
                            <div class="middle">
                                <div class="left">
                <h3>Revenu total</h3>
                                <h1>$10,864</h1>
                                </div>
                                <div class="progress">
                                    <svg>
                                        <circle cx='38' cy='38' r='36'></circle>
                                    </svg>
                                    <div class="number">
                                        <p>44%</p>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Dernières 24 heures</small>
                    </div>
                            <!----- end of income -->

</div>
                            <!----- end of insights -->
                            <div class="recent-orders">
                                <h2>
                                    Dernières commandes</h2>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Nom du produit</th>
                                                <th>Numéro de produit</th>
                                                <th>Payment</th>
                                                <th>Statut</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Foldable Mini Drone</td>
                                                <td>85631</td>
                                                <td>Due</td>
                                                <td class="warning">Pending</td>
                                                <td class="primary">Details</td>
                                            </tr>
                                            <tr>
                                                <td>Foldable Mini Drone</td>
                                                <td>85631</td>
                                                <td>Due</td>
                                                <td class="warning">Pending</td>
                                                <td class="primary">Details</td>
                                            </tr>
                                            <tr>
                                                <td>Foldable Mini Drone</td>
                                                <td>85631</td>
                                                <td>Due</td>
                                                <td class="warning">Pending</td>
                                                <td class="primary">Details</td>
                                            </tr>
                                            <tr>
                                                <td>Foldable Mini Drone</td>
                                                <td>85631</td>
                                                <td>Due</td>
                                                <td class="warning">Pending</td>
                                                <td class="primary">Details</td>
                                            </tr>
                                            <tr>
                                                <td>Foldable Mini Drone</td>
                                                <td>85631</td>
                                                <td>Due</td>
                                                <td class="warning">Pending</td>
                                                <td class="primary">Details</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <a href="#">Show All</a>
                            </div>

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