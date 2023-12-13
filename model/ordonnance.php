<?php
class ordonnance 
{
    private ?int $id = null;
    private ?string $id_pharmacie = null;
    private ?string $id_rendezvous = null;

    private ?string $nbrjour = null;
    private ?string $nbrfois = null;

    private ?DateTime $date_creation = null;

    function __construct($id = null, $id_pharmacie,$id_rendezvous, $nbrjour, $nbrfois, $date_creation)
    {
        $this->id = $id;
      
        $this->id_pharmacie = $id_pharmacie;
        $this->id_rendezvous = $id_rendezvous;
        $this->nbrjour= $nbrjour;
        $this->nbrfois = $nbrfois;
        $this->date_creation = $date_creation;
    }
    function getid()
    {
        return $this->id;
    }
    function getid_rendezvous()
    {
        return $this->id_rendezvous;
    }
    function getid_pharmacie(){
        return $this->id_pharmacie;
    }
    function getnbrjour(){
        return $this->nbrjour;
    }
    function getnbrfois(){
        return $this->nbrfois;
    }
    function getdate_creation(){
        return $this->date_creation;
    }
}
