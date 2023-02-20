<?php
class Product
{
    private $Image;
    private $Name;
    private $Price;
    private $Description;
    
    public function __construct($cImage="Images/NoImage.png", $cName="", $cPrice=0, $cDescription="") {
        $this->Image=$cImage;
        $this->Name=$cName;
        $this->Price=$cPrice;
        $this->Descryption=$cDescryption;
    }

    public function __destruct() {}

    public function getImage() {
        return $this->Image;
    }
    public function setImage($ximage) {
        $this->Image = $ximage;
    }

    public function getName() {
        return $this->Name;
    }
    public function setName($xname) {
        $this->Name = $xname;
    }

    public function getPrice() {
        return $this->Price;
    }
    public function setPrice($xprice) {
        $this->Price = $xprice;
    }

    public function getDescription() {
        return $this->Description;
    }
    public function setDescription($xdescription) {
        $this->Description = $xdescription;
    }

    public function print() {
        $str = "<div class=\"image\">";
        $str .= "<img src=\"".$this->Image."\" alt=\"Image not found\"/>";
        $str .= "</div>";
        $str .=  "<h1>".$this->Name."</h1>";
        $str .=  "<h2>&euro;".bcdiv($this->Price, 100, 2)."</h2>";
        $str .=  "<p class=\"description\">".$this->Description."</p>";
        echo ($str);
    }
}
?>