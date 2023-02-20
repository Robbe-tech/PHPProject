<?php
class User
{
    private $FirstName;
    private $LastName;
    private $Email;
    private $Phone;
    private $PostalCode;
    private $City;
    private $Street;
    private $Nr;
    private $BirthDate;
    private $Admin;

    public function __construct($cFirstName="", $cLastname="", $cEmail="", $cPhone=0, $cPostalCode=0, $cCity="", $cStreet="", $cNr=0, $cBirthDate="1-1-2000", $cAdmin=FALSE) {
        $this->FirstName=$cFirstName;
        $this->LastName=$cLastName;
        $this->Email=$cEmail;
        $this->Phone=$cPhone;
        $this->PostalCode=$cPostalCode;
        $this->City=$cCity;
        $this->Street=$cStreet;
        $this->Nr=$cNr;
        $this->BirthDate=date('y-m-d H:i:s', strtotime($cBirthDate));
        $this->Admin=$cAdmin;
    }

    public function __destruct() {}

    public function getFirstName() {
        return $this->FirstName;
    }
    public function setFirstName($xfirstName) {
        $this->FirstName = $xfirstName;
    }

    public function getLastName() {
        return $this->LastName;
    }
    public function setLastName($xlastName) {
        $this->LastName = $xlastName;
    }

    public function getEmail() {
        return $this->Email;
    }
    public function setEmail($xemail) {
        $this->Email = $xemail;
    }

    public function getPhone() {
        return $this->Phone;
    }
    public function setPhone($xphone) {
        $this->Phone = $xphone;
    }

    public function getPostalCode() {
        return $this->PostalCode;
    }
    public function setPostalCode($xpostalCode) {
        $this->PostalCode = $xpostalCode;
    }

    public function getCity() {
        return $this->City;
    }
    public function setCity($xcity) {
        $this->City = $xcity;
    }

    public function getStreet() {
        return $this->Street;
    }
    public function setStreet($xstreet) {
        $this->Street = $xstreet;
    }

    public function getNr() {
        return $this->Nr;
    }
    public function setNr($xnr) {
        $this->Nr = $xnr;
    }

    public function getBirthDate() {
        return $this->BirthDate;
    }
    public function setBirthDate($xbirthDate) {
        $this->BirthDate = $xbirthDate;
    }

    public function getAdmin() {
        return $this->Admin;
    }
    public function setAdmin($xadmin) {
        $this->Admin = $xadmin;
    }

    public function print() {
        $str = "<tr><td>".$this->FirstName;
        $str .=  " ".$this->LastName."</td>";
        $str .=  "<td>".$this->Email."</td>";
        $str .=  "<td>".$this->Phone."</td>";
        $str .=  "<td>".$this->PostalCode;
        $str .= " ".$this->City;
        $str .=  ", ".$this->Street;
        $str .=  " ".$this->Nr."</td>";
        $str .=  "<td>".$this->BirthDate."</td>";
        $str .=  "<td>".$this->Admin."</td></tr>";
        echo ($str);
    }
}
?>