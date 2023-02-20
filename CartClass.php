<?php
class CartObject{
    private $ID;
    private $Ammount;

    public function __construct($cID, $cAmmount = 1){
        $this->ID=$cID;
        $this->Ammount=$cAmmount;
    }

    public function getID(){
        return $this->ID;
    }
    public function setID($xID){
        $this->ID = $xID;
    }

    public function getAmmount(){
        return $this->Ammount;
    }
    public function setAmmount($xAmmount){
        $this->Ammount = $xAmmount;
    }
}
?>