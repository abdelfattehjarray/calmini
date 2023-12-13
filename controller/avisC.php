<?php
require_once "coachC.php";
class avisC{
    public function addAvis($avis){
        try {
            $sql = "INSERT INTO avis (commentaire, dateAvis, evaluation, idCoach) VALUES (:commentaire, :dateAvis, :evaluation, :idCoach)";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindValue('commentaire', $avis->getcommentaire());
            $query->bindValue('dateAvis', $avis->getdateAvis()->format('Y-m-d H:i:s'));
            $query->bindValue('evaluation', $avis->getevaluation());
            $query->bindValue('idCoach', $avis->getidCoach());
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    function nbreavis($idCoach,$avis)
    {
        $sql = "INSERT INTO avis (commentaire, dateAvis, evaluation,idCoach) VALUES (:commentaire, :dateAvis, :evaluation,:idCoach)";


        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue('commentaire', $avis->getcommentaire());
            $query->bindValue('dateAvis', $avis->getdateAvis()->format('Y-m-d H:i:s'));
            $query->bindValue('evaluation', $avis->getevaluation());
            $query->bindValue('idCoach', $avis->getidCoach());
             $query->execute();
             $coachC = new coachC();
             $coach = $coachC->getcoachById($idCoach);
             $nbAvis = $coach['nbAvis'] + 1;
     
             $sql = 'UPDATE coach SET nbAvis=:nbAvis WHERE idCoach = :idCoach';
             $query = $db->prepare($sql);
             $query->bindValue('nbAvis', $nbAvis);
             $query->bindValue('idCoach', $idCoach);
             $query->execute();
     
             echo "Successfully updated nbAvis to $nbAvis for coach with idCoach $idCoach";
          
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function deleteAvis_decrement($idCoach,int $idAvis){
        try { 
            $coachC = new coachC();
            $coach = $coachC->getcoachById($idCoach);
            if($coach['nbAvis'] !=0){
            $sql = "DELETE from avis where idAvis = ?";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idAvis);
            $query->execute();

             $nbAvis = $coach['nbAvis'] - 1;
             $sql = 'UPDATE coach SET nbAvis=:nbAvis WHERE idCoach = :idCoach';
             $query = $db->prepare($sql);
             $query->bindValue('nbAvis', $nbAvis);
             $query->bindValue('idCoach', $idCoach);
             $query->execute();
            }
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function displayAvis(){
        try {
            $sql = "SELECT * from avis";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function displayAvis_de_chacun($id){
        try {
            $sql = "SELECT * from avis where idCoach = $id";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteAvis(int $idAvis){
        try {
            $sql = "DELETE from avis where idAvis = ?";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idAvis);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function getAvisById($idAvis){
        try {
            $sql = "SELECT * from avis where idAvis=?";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idAvis);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updateAvis($idAvis, $avis){
        try {
            $sql = "UPDATE avis SET commentaire = :commentaire, dateAvis = :dateAvis,evaluation = :evaluation ,idCoach= :idCoach WHERE idAvis = :idAvis";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindValue('commentaire', $avis->getcommentaire());
            $query->bindValue('dateAvis', $avis->getdateAvis()->format('Y-m-d H:i:s'));
            $query->bindValue('evaluation', $avis->getevaluation());
            $query->bindValue('idCoach', $avis->getidCoach());
            $query->bindValue(':idAvis', $idAvis);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
 
}
