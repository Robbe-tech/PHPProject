<?php
include "Session.php";
if($_SESSION['Login']){
    include "CartClass.php";

    $id = intval($_POST['id']);
    $stock = intval($_POST['stock']);
    $ammount = intval($_POST['ammount']);

    $found = FALSE;
    $more = FALSE;
    foreach($_SESSION['Cart'] as $product){
        if ($id == $product->getID()){
            $found = TRUE;
            $newammount = $ammount + $product->getAmmount();
            if ($newammount > $stock){
                $more = TRUE;
            }
            else{
                $product->setAmmount($newammount);
            }
        }
    }
    if(!$found){
        array_push($_SESSION['Cart'], new CartObject($id, $ammount));
    }
    if($more){
        echo "You can not add more products then are in our stock of ".$stock.".";
    }
    else{
        echo "Succesfully added ".$ammount." items to cart.";
    }
}
else{
    echo "You need to be logged in to add items to cart.";
}
?>