<?php
session_start();

include "User.php";

if(!isset($_SESSION['sid']))
{
    $_SESSION['sid'] = session_id();
    $_SESSION['Login'] = FALSE;
    $_SESSION['User'] = New User();
    $_SESSION['Cart'] = array();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="Reset.css">
        <link rel="stylesheet" href="Project.css"/>
        <title>Bits and bolts</title>
    </head>
    <body>
        <div class="wrapper">
            <nav>
                <a href="Home.php">Home</a>
                <a href="Products.php">Products</a>
                <?php
                if ($_SESSION['Login']){
                    echo '<a href="Cart.php">cart</a>';
                }
                if ($_SESSION['Login'] && $_SESSION['User']->getAdmin() == 1){
                    echo '<a href="Users.php">Users</a>';
                }
                if ($_SESSION['Login'] && $_SESSION['User']->getAdmin() == 1){
                    echo '<a href="AddProduct.php">Add product</a>';
                }
                if ($_SESSION['Login']){
                    echo '<a href="LogOut.php">Log out</a>';
                }
                else{
                    echo '<a href="LogIn.php">Log in</a>';
                }
                ?>
            </nav>
            <header>
                <h1>
                    Welcome
                    <?php
                    if($_SESSION['Login'])
                    {
                        $str = " ".htmlspecialchars($_SESSION['User']->getFirstName);
                        echo $str;
                    }
                    ?>
                </h1>
            </header>
            <footer>
                <a href="www.thomasmore.be">&copy;Thomas More</a>
            </footer>
        </div>
    </body>
</html>