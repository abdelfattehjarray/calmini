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
   
    function supprimermed($numero){
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
    function Ajoutermed($Pharmacie,$id){

       $sql = "INSERT INTO pharmacie  ( nom_med, description , fabricant, ex_date, prix, dispo,img_med,Id_categorie) 
                 VALUES ( :nom_med, :descrp , :fabricant, :ex_date, :prix, :dispo,:img,:id_categorie)";
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
            'id_categorie'=>$id,


        ]);
        $_SESSION['error']="data add seccsesfuly";
} catch (Exception $e){
    $e->getMessage();
}

    }
function modifierpharmacie($id,$Pharmacie){
       try{
        $db = config::getConnexion();
$query = $db->prepare('UPDATE pharmacie SET numero = :numero, nom_med = :nom_med, description = :descrp, prix = :prix, ex_date = :date, img_med = :img, fabricant = :fabricant, Dispo = :dispo ,Id_categorie = :id_categorie WHERE numero = :numero');
$query->execute([
            'numero'=> $id,
            'nom_med'=> $Pharmacie->getnom_med(),
            'descrp'=> $Pharmacie->getdescription(),
            'fabricant'=> $Pharmacie->getfabricant(),
            'date'=> $Pharmacie->getdate(),
            'prix'=> $Pharmacie->getprix(),
            'dispo'=> $Pharmacie->getdispo(),
            'img'=>$Pharmacie->getimg_med(),
            'id_categorie'=>$Pharmacie->getId_categorie(),
]);
    } catch (Exception $e){
        $e->getMessage();
}}


function recuperermed($numero,$id_cat){
    $sql="SELECT * FROM pharmacie INNER JOIN categorie on pharmacie.Id_categorie = categorie.Id_categorie WHERE categorie.Id_categorie = $id_cat AND numero=$numero";
    $db = config::getConnexion();
try{
    $query = $db->prepare($sql);
$query->execute();
$Pharmacie=$query->fetch();
return $Pharmacie;
}catch (Exception $e){
    $e->getMessage();}
}

function affichermedtri($id_cat){
			
    $sql="SELECT * FROM pharmacie INNER JOIN categorie on pharmacie.Id_categorie = categorie.Id_categorie WHERE categorie.Id_categorie = $id_cat ORDER BY prix";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

function affichermedRecherche($rech,$id_cat){
			
    $sql="SELECT * FROM pharmacie INNER JOIN categorie on pharmacie.Id_categorie = categorie.Id_categorie WHERE categorie.Id_categorie = $id_cat AND nom_med like '%$rech%'";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

   
function joinCategorie($id_cat){
    $sql=("SELECT * FROM pharmacie INNER JOIN categorie on pharmacie.Id_categorie = categorie.Id_categorie WHERE categorie.Id_categorie = $id_cat");
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