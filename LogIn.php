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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="Reset.css">
        <link rel="stylesheet" href="Project.css"/>
        <title>Bits and bolts</title>
        <script src="jquery-ui-1.13.0.custom/external/jquery/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".fill").hide();
                $(".attempts").hide();
            });
        </script>
    </head>
    <body>
        <div class="wrapper">
            <nav>
                <a href="Home.php">Home<</a>
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
            <div class="login">
                <h1>Log in</h1>

                <form action="LogIn.php" method="post">
                    <label for="email">Email:</label><br/>
                    <input type="email" name="email" id="email"><br/>
                    <label for="password">Password:</label><br/>
                    <input type="password" name="password" id="password"><br/>
                    <p class="fill">Both fields need to be filled</p>
                    <p class="attempts">The user name or password was incorrect, you have 3 attempts left</p>
                    <input type="submit" value="Log in" name="submit">
                </form>
                <?php
                $attempts = 4;

                function login(){
                    $found = FALSE;
                    if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']) && attempts > 0){
                        $host = "localhost";
                        $user = "Webgebruiker";
                        $passw = "Lab2021";
                        $databank = "RobbeGeusens";

                        $email = $_POST['email'];
                        $passw = $_POST['email'];

                        $link = mysqli_connect($host, $user, $passw) or die("Server not available");
                        mysqli_select_db($link, $databank) or die("Database not available");

                        $query = "SELECT u.FirstName, u.LastName, u.Email, u.Passwd, u.BirthDate, u.Administrator, a.PostalCode, a.City, a.Street, a.Nr";
                        $query .=  "FROM Users AS u JOIN Addresses AS a ON u.AddressID = a.AddressID";

                        $result = mysqli_query($link, $query) or die("A mistake happened executing the query \"$query\"");

                        while ($row = mysqli_fetch_array($result)){
                            if (strcmp($row['Email'], $email) == 0 && strcmp($row['Passwd'], $passw) == 0){
                                $_SESSION['User']->setFirstName($row['FirstName']);
                                $_SESSION['User']->setLastName($row['LastName']);
                                $_SESSION['User']->setEmail($row['Email']);
                                $_SESSION['User']->setPhone($row['Phone']);
                                $_SESSION['User']->setPostalCode($row['PostalCode']);
                                $_SESSION['User']->setCity($row['City']);
                                $_SESSION['User']->setStreet($row['Street']);
                                $_SESSION['User']->setNr($row['Nr']);
                                $_SESSION['User']->setBirthDate($row['BirthDate']);
                                $_SESSION['User']->setAdmin($row['Admin']);
                                $found = TRUE;
                                header('Location: Home.php');
                            }
                        }

                        if(!found){
                            $attempts = $attempts - 1;
                            $str .= "<script>$(\".attempts\").text(\"The user name or password was incorrect, you have \"".$attempts."\" attempts left\")";
                            $str .= "$(\".attempts\").show();</script>";
                            echo $str;
                        }
                        echo "<script>$(\".fill\").hide();</script>";
                    }
                    else{
                        echo "<script>$(\".fill\").show();</script>";
                    }
                }

                if (isset($_POST['submit'])){
                    login();
                }
                ?>

                <a href="Register.php">Regiser</a>
            </div>
            <footer>
                <a href="www.thomasmore.be">&copy;Thomas More</a>
            </footer>
        </div>
    </body>
</html>