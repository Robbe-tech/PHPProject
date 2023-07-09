<?php
if(!class_exists('CartObject')){
    class CartObject{
        private int $ID;
        private int $Ammount;

        public function __construct(int $cID, int $cAmmount = 1){
            $this->ID=$cID;
            $this->Ammount=$cAmmount;
        }

        public function getID(){
            return $this->ID;
        }
        public function setID(int $xID){
            $this->ID = $xID;
        }

        public function getAmmount(){
            return $this->Ammount;
        }
        public function setAmmount(int $xAmmount){
            $this->Ammount = $xAmmount;
        }
    }
}
?>