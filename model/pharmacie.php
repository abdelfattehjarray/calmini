<?php

class Pharmacie {
 
    private string $nom_med;
    private string $description;
    private string $fabricant;
    private float $prix;
    private   $date;
    private string $dispo;
    private string $img_med;
    private int $id_categorie;


    public function __construct( $nom_med, $description, $fabricant,  $date,$prix,$dispo,$img,$id_categorie){
       
        $this->nom_med=$nom_med;
        $this->description=$description;
        $this->prix=$prix;
        $this->date=$date;
        $this->fabricant=$fabricant;
        $this->dispo=$dispo;
    $this->img_med=$img;
    $this->id_categorie=$id_categorie;
    }




    
   
    public function getnom_med(){
        return $this->nom_med;
    }
    public function getfabricant(){
        return $this->fabricant;
    }
    public function getdescription(){
        return $this->description;
    }
    public function getprix(){
        return $this->prix;
    }
    public function getdate(){
        return $this->date;
    }
    public function getdispo(){
        return $this->dispo;
    }

    public function getimg_med(){
        return $this->img_med;
    }
    public function getId_categorie(){
        return $this->id_categorie;
    }





 
    
    public function setnomnom_med( $nom_med){
        $this->nom_med=$nom_med;
    }
    public function setfabricant( $fabricant){
        $this->fabricant=$fabricant;
    }
    public function setdescription( $description){
        $this->description=$description;
    }
    public function setprix( $prix){
        $this->prix=$prix;
    }
    public function setdate( $dateString){
        $this->date = new DateTime($dateString);
    }
    public function setdispo( $dispo){
        $this->dispo=$dispo;
    }
    public function setimg_med( $img){
        $this->img_med=$img;
    }
    public function setId_categorie( $id){
        $this->id_categorie=$id;
    }


}
?>