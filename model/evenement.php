<?php

class Evenement {
 
    private string $Title;
    private  $date_deb;
    private  $date_fin;
    private string $Adresse;
    private   string $organisateurs;
    private string $cout;
    private string $tags;
    private string $Image;
    private int $quantite;
    private int $solde;


    public function __construct( $Title, $date_deb, $date_fin,$Adresse,$organisateurs,$cout,$tags,$Image,$quantite){
       
        $this->Title=$Title;
        $this->date_deb=$date_deb;
        $this->date_fin=$date_fin;
        $this->Adresse=$Adresse;
        $this->organisateurs=$organisateurs;
        $this->cout=$cout;
        $this->tags=$tags;
        $this->Image=$Image;
        $this->quantite=$quantite;
    }




    
   
    public function getTitle(){
        return $this->Title;
    }
    public function getdate_fin(){
        return $this->date_fin;
    }
    public function getdate_deb(){
        return $this->date_deb;
    }
    public function getAdresse(){
        return $this->Adresse;
    }
    public function getorganisateurs(){
        return $this->organisateurs;
    }
    public function getcout(){
        return $this->cout;
    }

    public function gettags(){
        return $this->tags;
    }
    public function getImage(){
        return $this->Image;
    }
    public function getquantite(){
        return $this->quantite;
    }
    public function getsolde(){
        return $this->solde;
    }




 
    
    public function setnomTitle( $title){
        $this->Title=$title;
    }
    public function setdate_fin( $date_fin){
        $this->date_fin=new DateTime($date_fin);
    }
    public function setdate_deb( $date_deb){
        $this->date_deb=new DateTime($date_deb);
    }
    public function setAdresse( $Adresse){
        $this->Adresse=$Adresse;
    }
    public function setorganisateurs( $org){
        $this->organisateurs =$org;
    }
    public function setcout( $cout){
        $this->cout=$cout;
    }
    public function settags( $tags){
        $this->tags=$tags;
    }
    public function setimage( $img){
        $this->Image=$img;
    }

}
?>