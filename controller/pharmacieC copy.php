<?php
include_once('..\config.php');
include '..\model\pharmacie.php';
class PharmacieC {
    function afficherpharmacie(){
        $sql="SELECT * FROM pharmacie";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
   
    function supprimermodele($numero){
        $sql=" DELETE FROM pharmacie WHERE numero=:numero";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':numero' , $numero);
        try{
            $req->execute();
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
    function Ajoutermed($Pharmacie){

       $sql = "INSERT INTO pharmacie  ( nom_med, description , fabricant, ex_date, prix, dispo,img_med) 
                 VALUES ( :nom_med, :descrp , :fabricant, :ex_date, :prix, :dispo,:img)";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute([
            'nom_med'=> $Pharmacie->getnom_med(),
            'descrp'=> $Pharmacie->getdescription(),
            'fabricant'=> $Pharmacie->getfabricant(),
            'ex_date'=> $Pharmacie->getdate(),
            'prix'=> $Pharmacie->getprix(),
            'dispo'=> $Pharmacie->getdispo(),
            'img'=>$Pharmacie->getimg_med(),

        ]);
        $_SESSION['error']="data add seccsesfuly";
} catch (Exception $e){
    $e->getMessage();
}

    }
function modifierpharmacie($id,$Pharmacie){
       try{
        $db = config::getConnexion();
$query = $db->prepare('UPDATE pharmacie SET numero = :numero, nom_med = :nom_med, description = :descrp, prix = :prix, ex_date = :date, img_med = :img, fabricant = :fabricant, Dispo = :dispo WHERE numero = :numero');
$query->execute([
            'numero'=> $id,
            'nom_med'=> $Pharmacie->getnom_med(),
            'descrp'=> $Pharmacie->getdescription(),
            'fabricant'=> $Pharmacie->getfabricant(),
            'date'=> $Pharmacie->getdate(),
            'prix'=> $Pharmacie->getprix(),
            'dispo'=> $Pharmacie->getdispo(),
            'img'=>$Pharmacie->getimg_med(),
]);
    } catch (Exception $e){
        $e->getMessage();
}}


function recuperermed($numero){
    $sql="SELECT * from pharmacie where numero=$numero";
    $db = config::getConnexion();
try{
    $query = $db->prepare($sql);
$query->execute();
$Pharmacie=$query->fetch();
return $Pharmacie;
}catch (Exception $e){
    $e->getMessage();}
}

function affichermedtri(){
			
    $sql="SELECT * FROM pharmacie ORDER BY prix";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

function affichermedRecherche($rech){
			
    $sql="SELECT * FROM pharmacie where nom_med like '%$rech%'";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

      
}
?>