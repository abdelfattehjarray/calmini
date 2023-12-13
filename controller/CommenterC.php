<?php
include '../model/Commenter.php';

class CommenterC{


    function listCommenter($IdArticle){
        $sql="SELECT * FROM commenter  join article on commenter.IdArticle=article.IdArticle where commenter.IdArticle=$IdArticle ";
        $db=config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
        
            }
    function deleteCommenter ($IdCommenter){
        $sql="DELETE FROM commenter WHERE IdCommenter =:IdCommenter";
$db=config::getConnexion();
$req = $db->prepare($sql);
$req->bindValue(':IdCommenter', $IdCommenter);

try {
    $req->execute();
} catch (Exception $e) {
    die('Error:' . $e->getMessage());
}

    }
    function addCommenter($Commenter){
        $sql="INSERT INTO commenter (user,comment,time,IdArticle)VALUES(:user,:comment,:time,:IdArticle)";
        $db=config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                'comment' => $Commenter->getcomment(),
                'user' => $Commenter->getUser(),
                'time' => $Commenter->getTime(),
                'IdArticle' => $Commenter->getIdArticle()
                
            ]);
        
        }catch(Exception $e){
            echo "error=:".$e->getMessage();
        
        
        }
        }
        function updateCommenter($Commenter,$IdCommenter){
            try{
         
           
             $sql="UPDATE commenter SET user=:user,comment=:comment,time=:time,IdArticle=:IdArticle  where IdCommenter=:IdCommenter";
         
             $db=config::getConnexion(); 
             $query = $db->prepare($sql);
             $query->execute([
                'IdCommenter'=> $IdCommenter,
                'comment' => $Commenter->getcomment(),
                'user' => $Commenter->getUser(),
                'time' => $Commenter->getTime(),
                'IdArticle' => $Commenter->getIdArticle()
             ]);
         
         }catch(Exception $e){
             echo "error=:".$e->getMessage();
         }
         }
         
         
         
   
        //  function afficherArtRech($rech){
			
        //     $sql="SELECT * FROM article where Title like '%$rech%'";
        //     $db = config::getConnexion();
        //     try{
        //         $liste = $db->query($sql);
        //         return $liste;
        //     }
        //     catch (Exception $e){
        //         die('Erreur: '.$e->getMessage());
        //     }	
        // }
        // function afficherArttri(){
			
        //     $sql="SELECT * FROM article ORDER BY Title";
        //     $db = config::getConnexion();
        //     try{
        //         $liste = $db->query($sql);
        //         return $liste;
        //     }
        //     catch (Exception $e){
        //         die('Erreur: '.$e->getMessage());
        //     }	
        // }
        
        function recupererCommenter($IdCommenter){
            $sql="SELECT * from commenter where IdCommenter=$IdCommenter";
            $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
        $query->execute();
        $Commenter = $query->fetch();
        return $Commenter;
        }catch (Exception $e){
            $e->getMessage();}
        }
         
         function CountCommenter($IdArticle){
            $sql="SELECT count(IdCommenter) FROM commenter  join article on commenter.IdArticle=article.IdArticle where commenter.IdArticle=$IdArticle ";
            $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
        $query->execute();
        $nb = $query->fetchColumn();
        return $nb;
        }catch (Exception $e){
            $e->getMessage();}
        }
         
    }


?>