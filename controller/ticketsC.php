<?php
include_once('..\config.php');
include '..\model\tickets.php';
class ticketsC {
    function affichertic(){
        $sql="SELECT * FROM tickets";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
   
    function supprimertic($Id_ticket){
        $sql=" DELETE FROM tickets WHERE Id_ticket=:Id_ticket";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':Id_ticket' , $Id_ticket);
        try{
            $req->execute();
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
    function Ajoutertic($tickets,$id){

       $sql = "INSERT INTO tickets  ( Id_event, prix_ticket, disponibilite ) 
                 VALUES ( :Id_event, :prix_ticket , :disponibilite)";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute([
            'Id_event'=>$id,
            'prix_ticket'=> $tickets->getprix_ticket(),
            'disponibilite'=> $tickets->getdisponibilite(),
            
            


        ]);
        $_SESSION['error']="data add seccsesfuly";
} catch (Exception $e){
    $e->getMessage();
}

    }
function modifiertic($id,$tickets){
       try{
        $db = config::getConnexion();
$query = $db->prepare("UPDATE tickets SET Id_ticket = $id, Id_event = :Id_event, prix_ticket = :prix_ticket, disponibilite = :disponibilite WHERE Id_ticket = $id");
$query->execute([
            'Id_event'=>$tickets->getId_event(),
            
            'prix_ticket'=> $tickets->getprix_ticket(),
            'disponibilite'=> $tickets->getdisponibilite(),
            
            
]);
    } catch (Exception $e){
        $e->getMessage();
}}


function recuperertic($Id_ticket,$Id_event){
    $sql="SELECT * FROM tickets INNER JOIN evenement on tickets.Id_event = evenement.Id_event WHERE evenement.Id_event = $Id_event AND Id_ticket=$Id_ticket";
    $db = config::getConnexion();
try{
    $query = $db->prepare($sql);
$query->execute();
$tickets=$query->fetch();
return $tickets;
}catch (Exception $e){
    $e->getMessage();}
}

function affichertictri($Id_event){
			
    $sql="SELECT * FROM tickets INNER JOIN evenement on tickets.Id_event = evenement.Id_event WHERE evenement.Id_event = $Id_event ORDER BY prix_ticket";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

function afficherticRecherche($rech,$Id_event){
			
    $sql="SELECT * FROM tickets INNER JOIN evenement on tickets.Id_event = evenement.Id_event WHERE evenement.Id_event = $Id_event AND Id_ticket like '%$rech%'";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

   
function joinEvenement($Id_event){
    $sql=("SELECT * FROM tickets INNER JOIN evenement on tickets.Id_event = evenement.Id_event WHERE evenement.Id_event = $Id_event");
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
        die('Erreur:' . $e->getMessage());
    }
}

}
?>