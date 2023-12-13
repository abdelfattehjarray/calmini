<?php
include '../controller/rendez_vousC.php';
$error='';
$clientC = new ClientC();
if (
    isset($_POST["id_doc"]) &&
    isset($_POST["id_patient"]) &&
    isset($_POST["calendrie"]) &&
    isset($_POST["etat"]) &&
    isset($_POST["date_creation"])
) {
    if (
        !empty($_POST['id_doc']) &&
        !empty($_POST["id_patient"]) &&
        !empty($_POST["calendrie"]) &&
        !empty($_POST["etat"]) &&
        !empty($_POST["date_creation"])
    ) {
        $rendez_vous = new rendezvous(
            null,
            $_POST['id_doc'],
            $_POST['id_patient'],
            new DateTime($_POST['calendrie']),
            $_POST['etat'],
            new DateTime($_POST['date_creation'])
        );
        $clientC->addClient($rendez_vous);
        //header('Location:ListClients.php');
    } else
        $error = "Missing information";
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
                    <label for="id_doc" class="form-label">ID Doc</label>
                    <input type="text" class="form-control" name="id_doc" id="id_doc" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="id_patient" class="form-label">ID Patient</label>
                    <input type="text" class="form-control" name="id_patient" id="id_patient" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="calendrie" class="form-label">Calendrier</label>
                    <input type="date" class="form-control" name="calendrie" id="calendrie">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="etat" class="form-label">Etat</label>
                    <input type="text" class="form-control" name="etat" id="etat">
                </div>
                <div class="mb-3">
                    <label for="date_creation" class="form-label">Date de création</label>
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







