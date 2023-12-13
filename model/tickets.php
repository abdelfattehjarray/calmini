<?php

class tickets {
    private int $Id_event;
    private float $prix_ticket;
    private  $disponibilite;
    
    


    public function __construct( $Id_event, $prix_ticket, $disponibilite){
       
        $this->Id_event=$Id_event;
        $this->prix_ticket=$prix_ticket;
        $this->disponibilite=$disponibilite;
        
    }

 
    public function getId_event(){
        return $this->Id_event;
    }
    public function getprix_ticket(){
        return $this->prix_ticket;
    }
    public function getdisponibilite(){
        return $this->disponibilite;
    }
    


    public function setId_event($id){
        $this->Id_event=$id;
    }
    public function setprix_ticket( $prix_ticket){
        $this->prix_ticket=$prix_ticket;
    }
    public function setdisponibilite( $disponibilite){
        $this->disponibilite=$disponibilite;
    }
   
    

}
?>