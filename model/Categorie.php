<?php

class Categorie {
 
    private string $Img_categorie;
    private string $Nom_categorie;
    private string $Description;
  

    public function __construct( $Nom_categorie, $Description ,$Img_categorie ){
        $this->Img_categorie=$Img_categorie;
        $this->Nom_categorie=$Nom_categorie;
        $this->Description=$Description;
       
    }




    
   
    public function getImg_categorie(){
        return $this->Img_categorie;
    }
    public function getNom_categorie(){
        return $this->Nom_categorie;
    }
    public function getDescription(){
        return $this->Description;
    }
 
 


 
    
    public function setId_categorie( $Img_categorie){
        $this->Img_categorie=$Img_categorie;
    }
    public function setNom_categorie( $Nom_categorie){
        $this->Nom_categorie=$Nom_categorie;
    }
    public function setDescription( $Description){
        $this->Description=$Description;
    }



}
?>