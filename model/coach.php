
<?php

class coach{
    private int $idCoach ;
    private string $nomCoach;
    private string $prenomCoach;
    private int $tel;
    private string $mail;
    private string $specialite;
    private int $experience;
   
    private string $details;
    private  $image;
    private  int $nbAvis;
    private   $codecoach;



    public function getidCoach (){
        return $this->idCoach;
    }
    public function getnomCoach (){
        return $this->nomCoach;
    }
    public function getprenomCoach (){
        return $this->prenomCoach;
    }
    public function gettel (){
        return $this->tel;
    }
    public function getexperience(){
        return $this->experience;
    }
    public function getspecialite (){
        return $this->specialite;
    }
    public function getmailCoach (){
        return $this->mail;
    }
    public function getdetails (){
        return $this->details;
    }
    public function getImage (){
        return $this->image;
    }
    public function getnbAvis (){
        return $this->nbAvis;
    }
    public function getcodecoach (){
        return $this->codecoach;
    }
    public function __construct(string $nomCoach='',string $prenomCoach='',int $tel=0,string $mail='',string $specialite='',int $experience=0,string $details='',$image,$codecoach){
        $this->nomCoach=$nomCoach;
        $this->prenomCoach=$prenomCoach;
        $this->tel=$tel;
        $this->mail=$mail;
        $this->specialite=$specialite;
       
        $this->experience=$experience;
        $this->details=$details;
        $this->image=$image;
        $this->nbAvis=0;
        $this->codecoach=$codecoach;
    }
}
