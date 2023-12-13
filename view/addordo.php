
<?php
include '../controller/ordonnanceC.php';
$error = '';
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
       if ($ordonnancee->addordonnance($ordonnance))
       {
        // Afficher un message de succès si l'ajout a réussi
        echo "Le rendez-vous a été ajouté avec succès !";
    } else {
        // Afficher un message d'erreur si l'ajout a échoué
        echo "Une erreur est survenue lors de l'ajout du rendez-vous.";
    }
        header('Location:ListClients.php');
        exit();
    } else {
        $error = "Missing information";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <a href="ListClients.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="id_pharmacie" class="form-label">id_pharmacie</label>
                        <input type="text" class="form-control" name="id_pharmacie" id="id_pharmacie">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_rendezvous" class="form-label">id_rendezvous</label>
                        <input type="text" class="form-control" name="id_rendezvous" id="id_rendezvous">
                    </div>
                    <div class="mb-3">
                        <label for="nbrjour" class="form-label">nbrjour</label>
                        <input type="text" class="form-control" name="nbrjour" id="nbrjour">
                    </div>
                    <div class="mb-3">
                        <label for="nbrfois" class="form-label">nbrfois</label>
                        <input type="text" class="form-control" name="nbrfois" id="nbrfois">
                    </div>
                    <div class="mb-3">
                        <label for="date_creation" class="form-label">date_creation</label>
                        <input type="date" class="form-control" name="date_creation" id="date_creation">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</html>
