<!DOCTYPE html>
<?php
include "User.php";
include "ProductClass.php";
include "CartClass.php";

session_start();

if(!isset($_SESSION['sid']))
{
    $_SESSION['sid'] = session_id();
    $_SESSION['Login'] = FALSE;
    $_SESSION['User'] = New User();
    $_SESSION['Cart'] = array();
}
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="Reset.css">
        <link rel="stylesheet" href="Project.css"/>
        <title>Bits and bolts</title>
    </head>
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
            <p class="loggedout">
                <?php
                session_start();

                if(isset($_SESSION['sid'])){
                    session_unset();
                    session_destroy();
                    echo "You are succesfully logged out! Bye.";
                }
                else{
                    header("Location: Oef 8.php");
                }
                ?>
            </p>
        </div>
    </body>
</html>