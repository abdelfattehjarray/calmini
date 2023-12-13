<?php
include_once("../config.php");
include_once("../model/ordonnance.php");
class ordonnancee{
    //****************************fonction afficher----------------------------------------------
    function listrordonnance() {
        $sql = "SELECT user.firstName AS patient_prenom, user.lastName AS patient_nom, user.id as id1, coach.prenomcoach AS doctor_prenom, coach.nomcoach AS doctor_nom, coach.specialite AS doctor_specialite, l_rendezvous.calendrier as rendezvousc, l_rendezvous.id, l_rendezvous.etat, ordonnance.id_rendezvous, ordonnance.nbrjour, ordonnance.nbrfois,ordonnance.id as idordo
                FROM l_rendezvous
                INNER JOIN user ON l_rendezvous.id_user = user.id
                INNER JOIN coach ON l_rendezvous.id_doc = coach.idcoach
                INNER JOIN ordonnance ON l_rendezvous.id = ordonnance.id_rendezvous"; // Ajout de la table ordonnance à la requête JOIN
    
        $db = config::getConnexion();
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
    function deleteordo ($id) {
$sql="DELETE FROM ordonnance WHERE id =:id";
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
function addordonnance($ordonnance){
    $sql="INSERT INTO ordonnance(id_rendezvous, id_pharmacie, nbrjour, nbrfois, date_creation) VALUES(:id_pharmacie, :id_rendezvous, :nbrjour, :nbrfois, :date_creation)";
    $db=config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute([
            'id_pharmacie' => $ordonnance->getid_pharmacie(),
            'id_rendezvous' => $ordonnance->getid_rendezvous(),
            'nbrjour' => $ordonnance->getnbrjour(),
            'nbrfois' => $ordonnance->getnbrfois(),
            'date_creation' => $ordonnance->getdate_creation()->format('Y-m-d')
        ]);
    }catch(Exception $e){
        echo "error=:".$e->getMessage();
    }
}

//***********************************fonction Modifier
function updateordonnance($client,$id){
   try{

  
    $sql="UPDATE ordonnance SET id_pharmacie=:id_pharmacie,id_rendezvous=:id_rendezvous,nbrjour=:nbrjour,nbrfois=:nbrfois,date_creation=:date_creation where id=:id";

    $db=config::getConnexion(); 
    $query = $db->prepare($sql);
    $query->execute([
        'id' => $id,
        'id_pharmacie' => $client->getid_pharmacie(),
        'id_rendezvous' => $client->getid_rendezvous(),
        'nbrjour' => $client->getnbrjour(),
        'nbrjour' => $client->getnbrjour(),
        'nbrfois' => $client->getnbrfois(),
        'date_creation' => $client->getdate_creation()->format('Y/m/d')
    ]);
    echo $query->rowCount() . " records UPDATED successfully <br>";;

}catch(Exception $e){
    echo "error=:".$e->getMessage();
}
}



function showordonnance($id)
{
    $sql = "SELECT * from ordonnance where id = $id";
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





?>