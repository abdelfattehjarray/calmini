<?php
include_once('..\config.php');
include '..\model\Categorie.php';
class CategorieC {
    function afficherCategorie(){
        $sql="SELECT * FROM Categorie";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
   
    function supprimercategorie($id){
        $sql=" DELETE FROM Categorie WHERE Id_categorie=:id";
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
    function AjouterCategorie($Categorie){

       $sql = "INSERT INTO Categorie  ( Nom_categorie, Description ,Img_categorie) 
                 VALUES (  :Nom_categorie,  :descrp, :Img_categorie )";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute([
            ':Img_categorie'=> $Categorie->getImg_categorie(),
            'descrp'=> $Categorie->getDescription(),
            'Nom_categorie'=> $Categorie->getNom_categorie(),
            
        ]);
        $_SESSION['error']="data add seccsesfuly";
} catch (Exception $e){
    $e->getMessage();
}

    }
function modifierCategorie($id,$Categorie){
       try{
        $db = config::getConnexion();
$query = $db->prepare("UPDATE categorie SET Id_categorie  = $id , Nom_categorie = :nom_categorie , Description = :descrp , Img_categorie = :Img_categorie WHERE Id_categorie =$id ");
$query->execute([
          
            'nom_categorie'=> $Categorie->getNom_categorie(),
            'descrp'=> $Categorie->getDescription(),
            ':Img_categorie'=> $Categorie->getImg_categorie()
]);
    } catch (Exception $e){
        $e->getMessage();
}}


function recupererCAtegorie($id){
    $sql="SELECT * from Categorie where Id_categorie=$id";
    $db = config::getConnexion();
try{
    $query = $db->prepare($sql);
$query->execute();
$Categorie=$query->fetch();
return $Categorie;
}catch (Exception $e){
    $e->getMessage();}
}

function afficherCategorietri(){
			
    $sql="SELECT * FROM Categorie ORDER BY Nom_categorie";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

function afficherCategorieRecherche($rech){
			
    $sql="SELECT * FROM Categorie where Nom_categorie like '%$rech%'";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }	
}

public function paginationLIMIT($sql)
    {
            $db = config::getConnexion();
            try {
                $liste = $db->query($sql);
                return $liste;
            } catch (Exception $e) {
                die('Error:' . $e->getMessage());
            }
    }  

    public function paginationCOUNTER($sql)
    {
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $row=$liste->fetch(PDO::FETCH_NUM);
            $total=$row[0];
            return $total;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    } 
      
}
?>