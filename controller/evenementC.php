<?php
include_once('..\config.php');
include '..\model\evenement.php';
class EvenementC {
    function afficherEvent(){
        $sql="SELECT * FROM evenement";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
   
    function supprimerEvenement($id){
        $sql=" DELETE FROM evenement WHERE Id_event=:id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id' , $id);
        try{
            $req->execute();
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
    function AjouterEvenement($Evenement){

       $sql = "INSERT INTO evenement  (	 Title , date_deb, date_fin, Adresse, Organisateurs,cout,Tags,Image,quantite) 
                 VALUES ( :Tilte, :date_deb , :date_fin, :Adresse, :organisateurs, :cout,:tags, :img, :quantite)";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute([
            'Tilte'=> $Evenement->getTitle(),
            'date_deb'=> $Evenement->getdate_deb(),
            'date_fin'=> $Evenement->getdate_fin(),
            'Adresse'=> $Evenement->getAdresse(),
            'organisateurs'=> $Evenement->getorganisateurs(),
            'cout'=> $Evenement->getcout(),
            'tags'=>$Evenement->gettags(),
            'img'=>$Evenement->getImage(),
            'quantite'=>$Evenement->getquantite()

        ]);
        $_SESSION['error']="data add seccsesfuly";
} catch (Exception $e){
    $e->getMessage();
}

    }
function modifierevent($id,$Evenement){
       try{
        $db = config::getConnexion();
$query = $db->prepare('UPDATE evenement SET Id_event = :Id_event, Title = :Title, date_deb = :date_deb, date_fin = :date_fin, Adresse = :Adresse, Organisateurs = :org, cout = :cout, Tags = :tags ,Image = :img, quantite = :quantite WHERE Id_event = :Id_event');
$query->execute([
            'Id_event'=> $id,
            'Title'=> $Evenement->getTitle(),
            'date_deb'=> $Evenement->getdate_deb(),
            'date_fin'=> $Evenement->getdate_fin(),
            'Adresse'=> $Evenement->getAdresse(),
            'org'=>$Evenement->getorganisateurs(),
            'cout'=> $Evenement->getcout(),
            'tags'=> $Evenement->gettags(),
            'img'=>$Evenement->getImage(),
            'quantite'=>$Evenement->getquantite()
]);
    } catch (Exception $e){
        $e->getMessage();
}}


function recupererEvent($id){
    $sql="SELECT * from evenement where ID_event=$id";
    $db = config::getConnexion();
try{
    $query = $db->prepare($sql);
$query->execute();
$Evenement=$query->fetch();
return $Evenement;
}catch (Exception $e){
    $e->getMessage();}
}

function affichereventtri(){
			
    $sql="SELECT * FROM evenement ORDER BY cout";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

function afficherEventRecherche($rech){
			
    $sql="SELECT * FROM evenement where Title like '%$rech%'";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

function updateQuantite($id_event,$quantite)
{
    try{
        $db = config::getConnexion();
$query = $db->prepare('UPDATE evenement SET quantite = :quantite WHERE Id_event = :Id_event');
$query->execute([
            'Id_event'=> $id_event,
            'quantite'=> $quantite
]);
    } catch (Exception $e){
        $e->getMessage();
    }  
}

function setSolde($id,$solde)
{
    try{
        $db = config::getConnexion();
$query = $db->prepare('UPDATE evenement SET solde = :solde WHERE Id_event = :Id_event');
$query->execute([
            'Id_event'=> $id,
            'solde'=> $solde
]);
    } catch (Exception $e){
        $e->getMessage();
    }
}
      
}
?>