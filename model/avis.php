<?php
class avis{
    private int $idAvis ;
    private string $commentaire;
    private \DateTime $dateAvis ;
    private string $evaluation;
    private int $idCoach;
   
   

    public function getidAvis (){
        return $this->idAvis;
    }
    public function getcommentaire (){
        return $this->commentaire;
    }
    public function getdateAvis (){
        return $this->dateAvis;
    }
    public function getevaluation (){
        return $this->evaluation;
    }   
    public function getidCoach(){
        return $this->idCoach;
    }
  
    public function __construct(string $commentaire='',\DateTime $dateAvis=new DateTime("now"),string $evaluation="",int $idCoach=0){
        $this->commentaire=$commentaire;
        $this->dateAvis=$dateAvis;
        $this->evaluation=$evaluation;
        $this->idCoach=$idCoach;
       
    }
}
