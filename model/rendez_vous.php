<?php
class rendezvous
{
    private ?int $id = null;
    private ?string $id_doc = null;
    private ?string $id_user = null;
    private  $calendrie = null;
    private ?string $etat = null;
    private $date_creation = null;
    private $etatpayment = null;
    private $title = null;
    private $note = null;

    function __construct($calendrie,$date_creation)
    {
        
       
       
        $this->calendrie = $calendrie;
    
        $this->date_creation = $date_creation;
    }
    function getid()
    {
        return $this->id;
    }
   
    function getid_doc(){
        return $this->id_doc;
    }
    function getid_user(){
        return $this->id_user;
    }
    function getcalendrie(){
        return $this->calendrie;
    }
    function getetat(){
        return $this->etat;
    }
    function getdate_creation(){
        return $this->date_creation;
    }
    function getetatpayment(){
        return $this->etatpayment;
    }
}
