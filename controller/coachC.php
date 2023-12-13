<?php
//require_once "../coach.php";
class coachC{
    public function addcoach($coach){
        try {
            $sql = "INSERT INTO coach (nomCoach, prenomCoach,tel,mail,specialite,experience,details,image,codecoach) VALUES (:nomCoach, :prenomCoach,:tel,:mail,:specialite,:experience,:details,:image,:codecoach)";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindValue('nomCoach', $coach->getnomCoach());
            $query->bindValue('prenomCoach', $coach->getprenomCoach());
            $query->bindValue('tel', $coach->gettel());
            $query->bindValue('mail', $coach->getmailCoach());
            $query->bindValue('specialite', $coach->getspecialite());
            $query->bindValue('experience', $coach->getexperience());
            $query->bindValue('details', $coach->getdetails());
            $query->bindValue('image', $coach->getImage());
            $query->bindValue('codecoach', $coach->getcodecoach());
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function displaycoachs(){
        try {
            $sql = "SELECT * from coach";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deletecoach(int $idcoach){
        try {
            $sql = "DELETE from coach where idcoach = ?";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idcoach);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function getcoachById($idcoach){
        try {
            $sql = "SELECT * from coach where idcoach=?";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idcoach);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updatecoach($idcoach, $coach){
        try {
            $sql = "UPDATE coach SET  nomCoach = :nomCoach,prenomCoach = :prenomCoach,tel = :tel, mail = :mail,specialite = :specialite , experience=:experience , details=:details ,image=:image,codecoach=:codecoach WHERE idcoach = :idcoach";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindValue('nomCoach', $coach->getnomCoach());
            $query->bindValue('prenomCoach', $coach->getprenomCoach());
            $query->bindValue('tel', $coach->gettel());
            $query->bindValue('mail', $coach->getmailCoach());
            $query->bindValue('specialite', $coach->getspecialite());
            $query->bindValue('experience', $coach->getexperience());
            $query->bindValue('details', $coach->getdetails());
            $query->bindValue('image', $coach->getImage());
            $query->bindValue('codecoach', $coach->getcodecoach());
            $query->bindValue(':idcoach', $idcoach);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function sortcoachs($sort_column){
        $sort_column='nomCoach';
        try {
            $sql = "SELECT * FROM  coach ORDER BY $sort_column asc";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }

        
        

    }

    function trisCoach($w){
        if($w==""){
            $sql = "SELECT * from coach";
        }else{
            $sql = "SELECT * FROM coach ORDER BY $w"; 
        }
        $db = config::getConnexion();
        
            $query=$db->prepare($sql);
            $query->execute();

            $type=  $query->fetchAll(PDO::FETCH_ASSOC);
            return $type;
    
    }

}
