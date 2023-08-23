<?php
include "Session.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="Reset.css">
        <link rel="stylesheet" href="Project.css"/>
        <title>Bits and bolts</title>
    </head>
    <body>
        <div class="wrapper">
            <nav>
                <ul>
                    <li><a href="Home.php" class="home">Home</a></li>
                    <li><a href="Products.php">Products</a></li>
                    <?php
                    if ($_SESSION['Login'] && $_SESSION['User']->getAdmin() == 1){
                        echo '<li><a href="Users.php">Users</a></li>';
                    }
                    if ($_SESSION['Login'] && $_SESSION['User']->getAdmin() == 1){
                        echo '<li><a href="AddProduct.php">Add product</a></li>';
                    }
                    if ($_SESSION['Login']){
                        echo '<li><a href="LogOut.php" class="login">Log out</a></li>';
                    }
                    else{
                        echo '<li><a href="LogIn.php" class="login">Log in</a></li>';
                    }
                    if ($_SESSION['Login']){
                        echo '<li><a href="Cart.php" class="cart"><img src="Images/ShoppingCart.png" alt="Cart"></a></li>';
                    }
                    ?>
                </ul>
            </nav>
            <div style="height:50px;"></div>
            <form action="CheckOut.php" method="post">
                <fieldset>
                    <legend>Cart</legend>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['Cart'] as $product){
                        $product->print();
                        $total += $product->getAmmount() * $product->getPrice();
                    }
                    $total /= 100;
                    echo("<h1 id='total'>Total: ".number_format(floatval($total), 2, '.', '')."&euro;</h1>");
                    ?>
                    <input type="submit" value="Proceed to checkout" name="submit" id='buy' name='checkout'>
                </fieldset>
            </form>
        </div>
    </body>
</html>