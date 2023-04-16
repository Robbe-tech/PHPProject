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
    $_SESSION['Attempts'] = 4;
}
?>
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
                $(".exists").hide();
                $(".passverification").hide();
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
            <div class="register">
                <h1>Register</h1>

                <form action="Register.php" method="post">
                    <label for="firstname">First Name:</label><br/>
                    <input type="text" name="firstname" id="firstname"><br/>
                    <label for="lastname">Last Name:</label><br/>
                    <input type="text" name="lastname" id="lastname"><br/>
                    <label for="email">Email:</label><br/>
                    <input type="email" name="email" id="email"><br/>
                    <label for="phone">Phone:</label><br/>
                    <input type="tel" name="phone" id="phone" placeholder="0412-34-56-78" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}-[0-9]{2}"><br/>
                    <label for="birthdate">Birth date:</label><br/>
                    <input type="date" name="birthdate" id="birthdate"><br/>
                    <label for="country">Country:</label><br/>
                    <input type="text" name="country" id="country"><br/>
                    <label for="postalcode">Postal code:</label><br/>
                    <input type="number" name="postalcode" id="postalcode"><br/>
                    <label for="street">Street:</label><br/>
                    <input type="street" name="street" id="street"><br/>
                    <label for="number">Number:</label><br/>
                    <input type="number" name="number" id="number"><br/>
                    <label for="appartment">Appartment:</label><br/>
                    <input type="text" name="appartment" id="appartment"><br/>
                    <label for="password">Password:</label><br/>
                    <input type="password" name="password" id="password"><br/>
                    <label for="vpassword">Password verification:</label><br/>
                    <input type="password" name="vpassword" id="vpassword"><br/>
                    <p class="fill">All fields except appartment need to be filled.</p>
                    <p class="exists">The user already exists.</p>
                    <p class="passverification">Password and password verification need to be the same.</p>
                    <input type="submit" value="Log in" name="submit">
                </form>
                <?php
                function register(){
                    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['birthdate']) && isset($_POST['country']) && isset($_POST['postalcode']) && isset($_POST['street']) && isset($_POST['number']) && isset($_POST['appartment']) && isset($_POST['password']) && isset($_POST['vpassword']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['birthdate']) && !empty($_POST['country']) && !empty($_POST['postalcode']) && !empty($_POST['street']) && !empty($_POST['number']) && !empty($_POST['appartment']) && !empty($_POST['password']) && !empty($_POST['vpassword'])){
                        if($_POST['password'] == $_POST['vpassword']){
                            $host = "localhost";
                            $user = "Webgebruiker";
                            $passw = "Lab2022";
                            $databank = "RobbeGeusens";

                            $email = $_POST['email'];
                            $found = FALSE;

                            $link = mysqli_connect($host, $user, $passw) or die("Server not available");
                            mysqli_select_db($link, $databank) or die("Database not available");

                            $query = "SELECT Email FROM Users";
                            $result = mysqli_query($link, $query) or die("A mistake happened executing the query \"$query\"");

                            while ($row = mysqli_fetch_array($result) && !$found){
                                if (strcmp($row['Email'], $email) == 0){
                                    $found = TRUE;
                                }
                            }

                            if($found){
                                $str = "<script>$(\".passverification\").hide();";
                                $str .= "$(\".fill\").hide()";
                                $str .= "$(\".exists\").show();</script>";
                                echo $str;
                            }
                            else{
                                $aid;
                                $afound = FALSE;

                                $query = "SELECT * FROM Addresses";
                                $result = mysqli_query($link, $query) or die("A mistake happened executing the query \"$query\"");

                                while ($row = mysqli_fetch_array($result) && !$afound){
                                    if (strcmp($row['Country'], $_POST['country']) == 0 && $row['PostalCode'] == $_POST['postalcode'] && strcmp($row['City'], $_POST['city']) == 0 && strcmp($row['Street'], $_POST['street']) == 0 && $row['Nr'] == $_POST['number']){
                                        $afound = TRUE;
                                        $aid = $row['AddressID'];
                                    }
                                }

                                if(!$afound){
                                    $appartment = NULL;
                                    if(isset($_POST['appartment']) && !empty($_POST['appartment'])){
                                        $appartment = $_POST['appartment'];
                                    }
                                    $query = "INSERT INTO Addresses(Country, PostalCode, City, Street, Nr, Appartment) VALUES (?, ?, ?, ?, ?, ?)";
                                    $stmt = $link->prepare($query);
                                    $stmt->bind_param("sissis", $_POST['country'], $_POST['postalcode'], $_POST['city'], $_POST['street'], $_POST['number'], $appartment);
                                    $stmt->execute();

                                    $query = "SELECT AddressID FROM Addresses WHERE Country = ?, PostalCode = ?, City = ?, Street = ?, Nr = ?, Appartment = ?";
                                    $stmt = $link->prepare($query);
                                    $stmt->bind_param("sissis", $_POST['country'], $_POST['postalcode'], $_POST['city'], $_POST['street'], $_POST['number'], $appartment);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    $aid = $row['AddressID'];
                                }

                                $query = "INSERT INTO Users(FirstName, LastName, Email, Passwd, Phone, AddressID, BirthDate, Administrator) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                                $stmt = $link->prepare($query);
                                $stmt->bind_param("ssssiisi", $_POST['firstname'], $_POST['lastname'], $_POST['email'], password_hash($_POST['passwd'], PASSWORD_DEFAULT), $aid, $_POST['birthdate'], 0);
                                $stmt->execute();

                                header("Location: Home.php");
                            }
                        }
                        else{
                            $str = "<script>$(\".passverification\").show();";
                            $str .= "$(\".fill\").hide()";
                            $str .= "$(\".exists\").hide();</script>";
                            echo $str;
                        }
                    }
                    else{
                        $str = "<script>$(\".passverification\").hide();";
                        $str .= "$(\".fill\").show()";
                        $str .= "$(\".exists\").hide();</script>";
                        echo $str;
                    }
                }

                if (isset($_POST['submit'])){
                    register();
                }
                ?>
            </div>
            <footer>
                <a href="www.thomasmore.be">&copy;Thomas More</a>
            </footer>
        </div>
    </body>
</html>