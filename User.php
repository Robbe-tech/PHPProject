<?php
if(!class_exists('User')){
    class User
    {
        private int $ID;
        private string $FirstName;
        private string $LastName;
        private string $Email;
        private int $Phone;
        private string $Country;
        private int $PostalCode;
        private string $City;
        private string $Street;
        private int $Nr;
        private ? string $Appartment;
        private string $BirthDate;
        private bool $Admin;

        public function __construct(int $cID = 0, string $cFirstName="", string $cLastName="", string $cEmail="", int $cPhone=0, $cCountry="", $cPostalCode=0, string $cCity="", string $cStreet="", int $cNr=0, string $cAppartment = "", string $cBirthDate="1-1-2000", bool $cAdmin=FALSE) {
            $this->setID($cID);
            $this->setFirstName($cFirstName);
            $this->setLastName($cLastName);
            $this->setEmail($cEmail);
            $this->setPhone($cPhone);
            $this->setCountry($cCountry);
            $this->setPostalCode($cPostalCode);
            $this->setCity($cCity);
            $this->setStreet($cStreet);
            $this->setNr($cNr);
            $this->setAppartment($cAppartment);
            $this->setBirthDate($cBirthDate);
            $this->setAdmin($cAdmin);
        }

        public function __destruct() {}

        public function getID() {
            return $this->ID;
        }

        public function setID($xID){
            $this->ID = $xID;
        }

        public function getFirstName() {
            return $this->FirstName;
        }
        public function setFirstName(string $xFirstName) {
            $this->FirstName = $xFirstName;
        }

        public function getLastName() {
            return $this->LastName;
        }
        public function setLastName(string $xLastName) {
            $this->LastName = $xLastName;
        }

        public function getEmail() {
            return $this->Email;
        }
        public function setEmail(string $xEmail) {
            $this->Email = $xEmail;
        }

        public function getPhone() {
            return $this->Phone;
        }
        public function setPhone(int $xPhone) {
            $this->Phone = $xPhone;
        }

        public function getCountry() {
            return $this->Country;
        }
        public function setCountry(string $xCountry) {
            $this->Country = $xCountry;
        }

        public function getPostalCode() {
            return $this->PostalCode;
        }
        public function setPostalCode(int $xPostalCode) {
            $this->PostalCode = $xPostalCode;
        }

        public function getCity() {
            return $this->City;
        }
        public function setCity(string $xCity) {
            $this->City = $xCity;
        }

        public function getStreet() {
            return $this->Street;
        }
        public function setStreet(string $xStreet) {
            $this->Street = $xStreet;
        }

        public function getNr() {
            return $this->Nr;
        }
        public function setNr(int $xNr) {
            $this->Nr = $xNr;
        }

        public function getAppartment() {
            return $this->Appartment;
        }
        public function setAppartment(string $xAppartment) {
            $this->Appartment = $xAppartment;
        }

        public function getBirthDate() {
            return $this->BirthDate;
        }
        public function setBirthDate(string $xBirthDate) {
            $this->BirthDate = $xBirthDate;
        }

        public function getAdmin() {
            return $this->Admin;
        }
        public function setAdmin(bool $xAdmin) {
            $this->Admin = $xAdmin;
        }

        public function print() {
            $str = "<tr><td>".$this->FirstName;
            $str .= " ".$this->LastName."</td>";
            $str .= "<td>".$this->Email."</td>";
            $str .= "<td>".$this->Phone."</td>";
            $str .= "<td>".$this->Country."</td>";
            $str .= "<td>".$this->PostalCode;
            $str .= " ".$this->City;
            $str .= ", ".$this->Street;
            $str .= " ".$this->Nr;
            if (!empty($this->Appartment) && strlen($this->Appartment) != 0) {
                $str .= ", ".$this->Appartment;
            }
            $str .= "</td><td>".$this->BirthDate."</td>";
            $str .= "<td>".$this->Admin."</td></tr>";
            echo ($str);
        }
    }
}
?>