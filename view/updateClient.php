<?php
include '../controller/rendez_vousC.php';

$error = "";
session_start();
$id= $_POST['id'];


if (isset($_POST['modifier'])) {
    
    // Validate the input values
  
   $status=$_POST['etat'];
    // Check if the ID is a positive integer
    if (!ctype_digit($id) || $id <= 0) {
        $_SESSION['error'] = "Invalid ID value";
        header("Location: updateClient.php");
        exit();
    }

    // Check if the status value is valid
    if ($status != "0" && $status != "1" && $status != "2" && $status != "3") {
        $_SESSION['error'] = "Invalid status value";
        header("Location: updateClient.php?id=$id");
        exit();
    }

    // Create a new RendezvousC object and call its updateRendezvous method
    $rdvC = new ClientC();
    $rdvC->updateRendezvous($id, $status);

    // Redirect to the list of rendezvous after the update is done
    header("Location: ConsultationPanel.php");
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
   
    

    <div id="error">
        <?php echo $error; ?>
    </div>

    <div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
        <form   id="modal-form" action="" method="POST">
       
           
              
             

            
            
            <input type="hidden" name="id" value="<?= $id; ?>">
     


     
      <label>etat:</label>
      
      <select name="etat" required onchange="document.getElementById('etat').value = this.value">
    <option value="0" <?php echo isset($status) && $status == 0 ? "selected" : '' ; ?>>for verification</option>
    <option value="1" <?php echo isset($status) && $status == 1 ? "selected" : '' ; ?>>Confirmed</option>
    <option value="2" <?php echo isset($status) && $status == 2 ? "selected" : '' ; ?>>Rescheduled</option>
    <option value="3" <?php echo isset($status) && $status == 3 ? "selected" : '' ; ?>>Done</option>
</select>
<input type="hidden" name="etat" id="etat" value="<?php echo isset($status) ? $status : '' ; ?>">


  
                   <input type="submit" name = "modifier" value="Update">
                 

                  <a class="ac" href="ConsultaionPanel.php" >Cancel</a>


            
        </form>
        </div>
</div>








<script>
    // Get the modal
var modal = document.getElementById("myModal");

// Get the input that triggers the modal
var input = document.getElementById("updateInput");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the input, open the modal and load the form into it
input.onclick = function() {
  // Make an AJAX request to load the form
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'updateClient.php?id=<?= $id ?>', true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Load the form into the modal
      document.getElementById('modal-form').innerHTML = xhr.responseText;
      // Show the modal
      modal.style.display = "block";
    }
  };
  xhr.send();
};

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

</script>
<style>
select {
      font-size: 16px;
      padding: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      width: 200px;
      margin: 10px 0;
    }

    option {
      font-size: 14px;
      padding: 5px;
    }

    option:checked {
      background-color: #007bff;
      color: #fff;
    }

.ac{
color: #007bff; text-decoration: none; font-weight: bold;

}
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

    input[type="submit"]{
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

    input[type="submit"]:hover, input[type="reset"]:hover {
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
