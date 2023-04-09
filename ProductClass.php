<?php
class Product
{
    private string $Image;
    private string $Name;
    private int $Price;
    private string $Description;
    
    public function __construct(string $cImage="Images/NoImage.png", string $cName="", int $cPrice=0, string $cDescription="") {
        $this->Image=$cImage;
        $this->Name=$cName;
        $this->Price=$cPrice;
        $this->Descryption=$cDescryption;
    }

    public function __destruct() {}

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