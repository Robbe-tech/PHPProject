<?php
include "ProductClass.php";
if(!class_exists('CartObject')){
    class CartObject extends Product{
        private int $Ammount;

        public function __construct(int $cID, string $cImage, string $cKitName, int $cKitPrice, string $cDescript, int $cAmmount = 1){
            parent::__construct($cID, $cImage, $cKitName, $cKitPrice, $cDescript);
            $this->setAmmount($cAmmount);
        }

        public function getAmmount(){
            return $this->Ammount;
        }
        public function setAmmount(int $xAmmount){
            $this->Ammount = $xAmmount;
        }

        public function print(){
            echo "<div id=\"product\">";
            parent::print();
            echo("<h3>Ammount: ".$this->getAmmount()."</h3>");
            echo "</div>";
        }
    }
}
?>