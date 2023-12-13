<?php
include_once("../config.php");
include_once("../model/rendez_vous.php");
class ClientC{
    //****************************fonction afficher
    function listrendezvous(){
        $sql = "SELECT user.firstName AS patient_prenom, user.lastName AS patient_nom,coach.prenomcoach AS doctor_prenom,coach.nomcoach AS doctor_nom,coach.specialite AS specialite ,l_rendezvous.calendrier,l_rendezvous.id ,l_rendezvous.etat,l_rendezvous.etatpayment 
        FROM l_rendezvous
        INNER JOIN user ON l_rendezvous.id_user= user.id
        INNER JOIN coach ON l_rendezvous.id_doc = coach.idcoach";
        
    
        // Exécution de la requête
        $db=config::getConnexion();
        $req = $db->prepare($sql);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    
        // Retourner les résultats de la requête
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    
    //*****************************fonction supprimer
    function deleterendezvous ($id) {
$sql="DELETE FROM l_rendezvous WHERE id =:id";
$db=config::getConnexion();
$req = $db->prepare($sql);
$req->bindValue(':id', $id);

try {
    $req->execute();
} catch (Exception $e) {
    die('Error:' . $e->getMessage());
}


    }
//***********************************fonction ajouter
function addRendezvous($rdv,$doctorId) {
    $sql = "INSERT INTO l_rendezvous ( id_doc, id_user, calendrier, etat, date_creation,etatpayment) 
            VALUES (:id_doc, :id_user, :calendrie, :etat, :date_creation,:etatpayment)";
    $db = config::getConnexion();

    try {
        $conn = $db->prepare($sql);
        $conn->bindValue(":calendrie", $rdv->getcalendrie());
        $conn->bindValue(":id_user", $_SESSION['iduser']);
        $conn->bindValue(":etat", 0); // set status to 0 by default
        $conn->bindValue(":date_creation", $rdv->getdate_creation());
        
        $conn->bindValue(":id_doc", $doctorId);
        $conn->bindValue(":etatpayment", 0); // set status to 0 by default
        
       
        
       

        $conn->execute();
        return true;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}
//***********************************fonction Modifier
function updateRendezvous($id,$status)
        {
            // Define the SQL query with named parameters
            $sql = "UPDATE l_rendezvous SET etat =:etat WHERE id = :id";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
        
            // Bind named parameters to their corresponding values
            $req->bindParam(':id', $id, PDO::PARAM_INT);
        
            // Bind the status parameter directly using the value of $status
            $req->bindParam(':etat', $status, PDO::PARAM_STR);
        
            // Execute the prepared query
            try {
                $req->execute();
            } catch (PDOException $e) {
                die('Error:' . $e->getMessage());
            }
        }


function updateDate($id, $LaDate, $LaDatec)
{
    // Define the SQL query with named parameters
    $sql = "UPDATE l_rendezvous SET calendrier = :calendrier, date_creation = :date_creation WHERE id = :id";
    $db = config::getConnexion();
    $req = $db->prepare($sql);

    // Bind named parameters to their corresponding values
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->bindParam(':calendrier', $LaDate, PDO::PARAM_STR);
    $req->bindParam(':date_creation', $LaDatec, PDO::PARAM_STR);

    // Execute the prepared query
    try {
        $req->execute();
    } catch (PDOException $e) {
        die('Error:' . $e->getMessage());
    }
}
function showClient($id)
{
    $sql = "SELECT * from l_rendezvous where id = $id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();

        $client = $query->fetch();
        return $client;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
}







?>