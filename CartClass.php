<?php
include "ProductClass.php";
if(!class_exists('CartObject')){
    class CartObject{
        private Product $Product;
        private int $Ammount;

        public function __construct(int $cProduct, int $cAmmount = 1){
            $this->ID=$cID;
            $this->Ammount=$cAmmount;
        }

        public function getProduct(){
            return $this->Product;
        }
        public function setProduct(int $xProduct){
            $this->Product = $xProduct;
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