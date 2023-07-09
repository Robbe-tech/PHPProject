<?php
if(!class_exists('Product')){
    class Product
    {
        private int $ID;
        private string $Image;
        private string $Name;
        private int $Price;
        private string $Description;
        
        public function __construct(int $cID, string $cImage="Images/NoImage.png", string $cName="", int $cPrice=0, string $cDescription="") {
            $this->ID=$cID;
            $this->Image=$cImage;
            $this->Name=$cName;
            $this->Price=$cPrice;
            $this->Description=$cDescription;
        }

        public function __destruct() {}

        public function getID() {
            return $this->ID;
        }
        public function setID(string $xID) {
            $this->ID = $xID;
        }

        public function getImage() {
            return $this->Image;
        }
        public function setImage(string $xImage) {
            $this->Image = $xImage;
        }

        public function getName() {
            return $this->Name;
        }
        public function setName(string $xName) {
            $this->Name = $xName;
        }

        public function getPrice() {
            return $this->Price;
        }
        public function setPrice(int $xPrice) {
            $this->Price = $xPrice;
        }

        public function getDescription() {
            return $this->Description;
        }
        public function setDescription(string $xDescription) {
            $this->Description = $xDescription;
        }

        public function print() {
            $str = "<a href=\"Product.php?id=".$this->ID."\"><div class=\"image\">";
            $str .= "<img src=\"".$this->Image."\" alt=\"Image not found\"/>";
            $str .= "</div></a>";
            $str .= "<a href=\"Product.php?id=".$this->ID."\"><h1>".$this->Name."</h1></a>";
            $str .= "<h2>&euro;".bcdiv($this->Price, 100, 2)."</h2>";
            $str .= "<p class=\"description\">".$this->Description."</p>";
            echo ($str);
        }
    }
}
?>