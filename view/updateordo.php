<?php
include '../controller/ordonnanceC.php';
$error = "";

// create client
$ordonnance = null;

// create an instance of the controller
$ordonnancee = new ordonnancee();
if (
  isset($_POST["id"]) &&
    isset($_POST["id_pharmacie"]) &&
    isset($_POST["id_rendezvous"]) &&
    isset($_POST["nbrjour"]) &&
    isset($_POST["nbrfois"]) &&
    isset($_POST["date_creation"])
) {
    
    if (
        !empty($_POST["id"]) &&
        !empty($_POST["id_pharmacie"]) &&
        !empty($_POST["id_rendezvous"]) &&
        !empty($_POST["nbrjour"]) &&
        !empty($_POST["nbrfois"]) &&
        !empty($_POST["date_creation"])
    ) {
        $ordonnance = new ordonnance(
          $_POST['id'],   
            $_POST['id_pharmacie'],
            $_POST['id_rendezvous'],
            $_POST['nbrjour'],
            $_POST['nbrfois'],
            new DateTime($_POST['date_creation'])
        );
        $ordonnancee->updateordonnance($ordonnance, $_POST["id"]);
    } else {
        $error = "Missing information";
    }
}


?>

    <html lang="en">
    </head>
<body>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
    <style>
        .content-table {
            border-collapse: collapse;
            margin: 100px 0;
            font-size: 1em;
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
    </style>
     <button><a href="Consultation.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
     if (isset($_POST['id'])) {
        $ordonnance = $ordonnancee->showordonnance($_POST['id']);
    ?>

 <form  action="" method="POST">
        <table class="content-table">
        <tr class="active-row">
        
                <td>
                    <label for="id">Id :</label>
                </td>
                <td>
                    <input type="text" name="id" id="id" value="<?php echo $ordonnance['id']; ?>" maxlength="20">
                </td>
            </tr>
            <tr class="active-row">
                <td>
                    <label for="id_pharmacie">id_pharmacie:</label>
                </td>
                <td>
                    <input type="text" name="id_pharmacie" id="id_pharmacie" value="<?php echo $ordonnance['id_pharmacie']; ?>" maxlength="20">
                </td>
            </tr>
            <tr class="active-row">
                <td>
                    <label for="id_rendezvous">id_rendezvous:</label>
                </td>
                <td>
                    <input type="text" name="id_rendezvous" id="id_rendezvous" value="<?php echo $ordonnance['id_rendezvous']; ?>" maxlength="20">
                </td>
            </tr>
            <tr class="active-row">
                <td>
                    <label for="nbrjour"> nbrjour:</label>
                </td>
                <td>
                    <input type="text" name="nbrjour" id="nbrjour" value="<?php echo $ordonnance['nbrjour']; ?>" maxlength="20">
                </td>
            </tr>
            <tr class="active-row">
                <td>
                    <label for="nbrfois">nbrfois</label>
                </td>
                <td>
                    <input type="text" name="nbrfois" id="nbrfois" value="<?php echo $ordonnance['nbrfois']; ?>" required>
                </td>
            </tr>
            <tr class="active-row">
                <td>
                    <label for="date_creation">Status:</label>
                </td>
                <td>
                <input type="datetime-local" name="date_creation" id="date_creation" value="<?php echo $ordonnance['date_creation']; ?>" maxlength="20">
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" value="Update">
                </td>
            </tr>
        </table>
    </form>
 
    <?php
}
?>
</body>
</html>
