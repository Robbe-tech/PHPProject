<?php
include "User.php";
include "ProductClass.php";
include "CartClass.php";

session_start();

if(!isset($_SESSION['Login'])){
    $_SESSION['Login'] = FALSE;
}
if(!isset($_SESSION['User'])){
    $_SESSION['User'] = New User();
}
if(!isset($_SESSION['Cart'])){
    $_SESSION['Cart'] = array();
}
if(!isset($_SESSION['Attempts'])){
    $_SESSION['Attempts'] = 4;
}
?>