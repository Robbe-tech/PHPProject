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
    //Set Logged in user
    //$_SESSION['Login'] = TRUE;
    //Set Admin to 1
    //$_SESSION['User']->setAdmin(1);
}
?>
<html>
    <head>
    <meta charset="utf-8"/>
        <link rel="stylesheet" href="Reset.css">
        <link rel="stylesheet" href="Project.css"/>
        <title>Header</title>
    </head>
    <body>
        <div class="wrapper">
            <nav>
                <ul>
                    <a href="Home.php"><li>Home</li></a>
                    <a href="Products.php"><li>Products</li></a>
                    <?php
                    if ($_SESSION['Login'] && $_SESSION['User']->getAdmin() == 1){
                        echo '<a href="Users.php"><li>Users</li></a>';
                    }
                    if ($_SESSION['Login'] && $_SESSION['User']->getAdmin() == 1){
                        echo '<a href="AddProduct.php"><li>Add product</li></a>';
                    }
                    if ($_SESSION['Login']){
                        echo '<a href="LogOut.php"><li class="login">Log out</li></a>';
                    }
                    else{
                        echo '<a href="LogIn.php"><li class="login">Log in</li></a>';
                    }
                    if ($_SESSION['Login']){
                        echo '<a href="Cart.php"><li class="cart"><img src="Images/ShoppingCart.png" alt="Cart"></li></a>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </body>
</html>