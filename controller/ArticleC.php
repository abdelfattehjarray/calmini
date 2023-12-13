<?php
include '../model/Article.php';

class ArticleC{


    function listArticle($id){
        $sql="SELECT * FROM article where (user!=$id)";
        $db=config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }}
        function listallArticle(){
            $sql="SELECT * FROM article";
            $db=config::getConnexion();
            try{
                $liste=$db->query($sql);
                return $liste;
            }catch (Exception $e) {
                die('Error:' . $e->getMessage());
            }
        
            }
            function listmonArticle($id){
                $sql="SELECT * FROM article where (user=$id)";
                $db=config::getConnexion();
                try{
                    $liste=$db->query($sql);
                    return $liste;
                }catch (Exception $e) {
                    die('Error:' . $e->getMessage());
                }
                
                    }
    function deleteArticle ($IdArticle){
        $sql="DELETE FROM article WHERE IdArticle =:IdArticle";
$db=config::getConnexion();
$req = $db->prepare($sql);
$req->bindValue(':IdArticle', $IdArticle);

try {
    $req->execute();
} catch (Exception $e) {
    die('Error:' . $e->getMessage());
}

    }
    function addArticle($Article){
        $sql="INSERT INTO article (Title,Content,user,time,image_data,image_type) VALUES (:Title,:Content,:user,:time,:imageData,:imageType)";
        $db=config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                'Title' => $Article->getTitle(),
                'Content' => $Article->getContent(),
                'user' => $Article->getUser(),
                'time' => $Article->getTime(),
                'imageData' => $Article->getImageData(),
                'imageType' => $Article->getImageType()
            ]);
        }catch(Exception $e){
            echo "error=:".$e->getMessage();
        }
    }
     function updateArticle($Article,$IdArticle){
        try {
            $sql = "UPDATE article SET Title=:Title,Content=:Content,user=:user,time=:time,image_data=:imageData,image_type=:imageType WHERE IdArticle=:IdArticle";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute([
                'IdArticle' => $IdArticle,
                'Title' => $Article->getTitle(),
                'Content' => $Article->getContent(),
                'user' => $Article->getUser(),
                'time' => $Article->getTime(),
                'imageData' => $Article->getImageData(),
                'imageType' => $Article->getImageType()
            ]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
         
         
   
         function afficherArtRech($rech){
			
            $sql="SELECT * FROM article where Title like '%$rech%'";
            $db = config::getConnexion();
            try{
                $liste = $db->query($sql);
                return $liste;
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }	
        }
        function afficherArttri(){
			
            $sql="SELECT * FROM article ORDER BY Title";
            $db = config::getConnexion();
            try{
                $liste = $db->query($sql);
                return $liste;
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }	
        }
        
        function recupererArticle($IdArticle){
            $sql="SELECT * from article where IdArticle=$IdArticle";
            $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
        $query->execute();
        $Article = $query->fetch();
        return $Article;
        }catch (Exception $e){
            $e->getMessage();}
        }
        function countArticlesAddedOnDay($day) {
            $db = config::getConnexion();
            $sql = "SELECT COUNT(*) AS count FROM article WHERE DATE(time) = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$day]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        }
         }



?>