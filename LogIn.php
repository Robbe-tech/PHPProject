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
    $_SESSION['Attempts'] = 4;
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
                <form action="LogIn.php" method="post" class="form">
                    <fieldset>
                        <legend>Log in</legend>
                        <br/><label for="email">Email:</label>
                        <input type="email" name="email" id="email"><br/><br/>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password"><br/>
                        <p class="fill">Both fields need to be filled</p>
                        <p class="attempts">The user name or password was incorrect, you have 4 attempts left</p><br>
                        <br/><input type="submit" value="Log in" name="submit"><br/><br/>
                        <a href="Register.php" id="register">Register</a>
                    </fieldset>
                </form>
                <?php
                function login(){
                    if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']) && $_SESSION['Attempts'] > 0){
                        $host = "localhost";
                        $user = "Webgebruiker";
                        $passw = "Lab2022";
                        $databank = "RobbeGeusens";

                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $link = mysqli_connect($host, $user, $passw) or die("Server not available");
                        mysqli_select_db($link, $databank) or die("Database not available");

                        $query = "SELECT u.FirstName, u.LastName, u.Email, u.Passwd, u.Phone, u.BirthDate, u.Administrator, a.Country, a.PostalCode, a.City, a.Street, a.Nr, a.Apartment";
                        $query .=  "FROM Users AS u JOIN Addresses AS a ON u.AddressID = a.AddressID WHERE u.Email = ?";

                        $stmt = $link->prepare($query);
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()){
                            if (strcmp($row['Email'], $email) == 0 && password_verify($row['Passwd'], $password)){
                                $_SESSION['User']->setFirstName($row['FirstName']);
                                $_SESSION['User']->setLastName($row['LastName']);
                                $_SESSION['User']->setEmail($row['Email']);
                                $_SESSION['User']->setPhone($row['Phone']);
                                $_SESSION['User']->setCountry($row['Country']);
                                $_SESSION['User']->setPostalCode($row['PostalCode']);
                                $_SESSION['User']->setCity($row['City']);
                                $_SESSION['User']->setStreet($row['Street']);
                                $_SESSION['User']->setNr($row['Nr']);
                                $_SESSION['User']->setAppartment($row['Appartment']);
                                $_SESSION['User']->setBirthDate($row['BirthDate']);
                                $_SESSION['User']->setAdmin($row['Admin']);
                                $_SESSION['Login'] = TRUE;
                                header('Location: Home.php');
                            }
                        }
                        
                        $_SESSION['Attempts'] -= 1;
                        $str .= "<script>$(\".left\").text(\"The user name or password was incorrect, you have ".$_SESSION['Attempts']."\" attempts left);";
                        $str .= "$(\".attempts\").show();</script>";
                        $str .= "<script>$(\".fill\").hide();</script>";
                        echo $str;
                    }
                    else{
                        $str .= "$(\".fill\").show();</script>";
                        $str .= "<script>$(\".attempts\").hide();</script>";
                        echo $str;
                    }
                }

                if (isset($_POST['submit'])){
                    login();
                }
                ?>
            <footer>
                <a href="https://www.thomasmore.be/">&copy;Thomas More</a>
            </footer>
        </div>
    </body>
</html>