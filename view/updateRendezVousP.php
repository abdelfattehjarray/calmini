<?php
include_once ('../controller/rendez_vousC.php');

$error = "";
session_start();

$id = $_POST['id'];

if (isset($_POST['modifier'])) {
    // Validate the input values
  
    $LaDate = $_POST['calendrier'];
    $LaDatec = $_POST['date_creation'];
    // Check if the ID is a positive integer
    if (!ctype_digit($id) || $id <= 0) {
        $_SESSION['error'] = "Invalid ID value";
        header("Location: updateRendezVousP.php");
        exit();
    }

   

    // Create a new ClientC object and call its updateDate method
    $rdvC = new ClientC();
    $rdvC->updateDate($id, $LaDate, $LaDatec);

    // Redirect to the list of rendezvous after the update is done
    header("Location: mesrendezvous.php");
    exit();
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous Display</title>
</head>
<body>
   
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

  
        <form  id ="myform" action="" method="POST">
                        <input type="hidden" name="id" value="<?= $id; ?>">
     


            <label>Date de rendez vous a modfier:</label>
            <input type="datetime-local" name="calendrier" id="calendrier">
            
            
            <td> <input type="hidden" class="form-control" name="date_creation" id="date_creation" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly></td>    
    


  
                   <input type="submit" name = "modifier" value="Update">
                 

                    <button type="button" onclick="window.location.href='ViewMyAPP.php';">Cancel</button>
            
        </form>
        <script>
  const calendrierInput = document.getElementById("calendrier");
  const form = document.getElementById("myform");

  form.addEventListener("submit", function(event) {
    const selectedDate = new Date(calendrierInput.value);
    const currentDate = new Date();

    if (selectedDate <= currentDate) {
      event.preventDefault();
      const errorMessage = document.createElement("p");
      errorMessage.style.color = "red";
      errorMessage.textContent = "La date sélectionnée doit être supérieure à la date et heure actuelles.";
      calendrierInput.insertAdjacentElement("afterend", errorMessage);
    }
  });
</script>
        <style>

#myform {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f1f1f1;
  border: 1px solid #ccc;
  border-radius: 5px;
}



    form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
    }

    table {
        border-collapse: collapse;
        width: 50%;
    }

    th, td {
        padding: 0.5rem;
        text-align: left;
        border: 1px solid #ddd;
    }

    input[type="text"], input[type="datetime-local"] {
        padding: 0.5rem;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    input[type="submit"], button {
        background-color:#4CAF50;
        color: white;
        border: none;
        padding: 0.5rem;
        cursor: pointer;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 1rem;
        margin-right: 1rem;
    }

    input[type="submit"]:hover, button:hover {
        background-color: #3e8e41;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold;
    }
</style>

</body>
</html>
