<!DOCTYPE html>
<?php
include "Session.php";
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
            <form action="Register.php" method="post" class="form">
                <fieldset>
                    <legend>Register</legend>
                    <br/><label for="firstname">First Name:</label>
                    <input type="text" name="firstname" id="firstname">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname"><br/><br/>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="someone@example.com"><br/><br/>
                    <label for="phone">Phone:</label>
                    <input type="tel" name="phone" id="phone" placeholder="0412-34-56-78" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}-[0-9]{2}"><br/><br/>
                    <label for="birthdate">Birth date:</label>
                    <input type="date" name="birthdate" id="birthdate"><br/><br/>
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country"><br/><br/>
                    <label for="postalcode">Postal code:</label>
                    <input type="number" name="postalcode" id="postalcode"><br/><br/>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city"><br/><br/>
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street"><br/><br/>
                    <label for="number">Number:</label>
                    <input type="number" name="number" id="number"><br/><br/>
                    <label for="appartment">Appartment:</label>
                    <input type="text" name="appartment" id="appartment"><br/><br/>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password"><br/><br/>
                    <label for="vpassword">Password verification:</label>
                    <input type="password" name="vpassword" id="vpassword"><br/>
                    <p class="fill">All fields except appartment need to be filled.</p>
                    <p class="exists">The user already exists.</p>
                    <p class="passverification">Password and password verification need to be the same.</p><br/><br/>
                    <input type="submit" value="Register" name="register" class="regissubmit">
                </fieldset>
            </form>
            <?php
            function searchaddress(&$afound, $link, $appartment){
                $aid = NULL;

                if ($appartment === NULL){
                    $query = "SELECT AddressID FROM Addresses WHERE Country = ? AND PostalCode = ? AND City = ? AND Street = ? AND Nr = ?";
                    $stmt = $link->prepare($query);
                    $stmt->bind_param('sissi', $_POST['country'], $_POST['postalcode'], $_POST['city'], $_POST['street'], $_POST['number']);
                }
                else{
                    $query = "SELECT AddressID FROM Addresses WHERE Country = ? AND PostalCode = ? AND City = ? AND Street = ? AND Nr = ? AND Appartment = ?";
                    $stmt = $link->prepare($query);
                    $stmt->bind_param('sissis', $_POST['country'], $_POST['postalcode'], $_POST['city'], $_POST['street'], $_POST['number'], $appartment);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0){
                    $afound = TRUE;
                    $row = $result->fetch_assoc();
                    $aid = $row['AddressID'];
                }

                return $aid;
            }

            if (isset($_POST['register'])){
                if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['birthdate']) && isset($_POST['country']) && isset($_POST['postalcode']) && isset($_POST['city']) && isset($_POST['street']) && isset($_POST['number']) && isset($_POST['password']) && isset($_POST['vpassword']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['birthdate']) && !empty($_POST['country']) && !empty($_POST['postalcode']) && !empty($_POST['city']) && !empty($_POST['street']) && !empty($_POST['number']) && !empty($_POST['password']) && !empty($_POST['vpassword'])){
                    if($_POST['password'] == $_POST['vpassword']){
                        include("Connect.php");

                        $email = $_POST['email'];
                        $found = FALSE;

                        $query = "SELECT Email FROM Users WHERE Email = ?";
                        $stmt = $link->prepare($query);
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0){
                            $found = TRUE;
                        }

                        if($found){
                            $str = "<script>$(document).ready(function(){";
                            $str .= "$(\".passverification\").hide();";
                            $str .= "$(\".fill\").hide();";
                            $str .= "$(\".exists\").show();});</script>";
                            echo $str;
                        }
                        else{
                            $aid;
                            $afound = FALSE;

                            $appartment = NULL;
                            if(isset($_POST['appartment']) && !empty($_POST['appartment'])){
                                $appartment = $_POST['appartment'];
                            }

                            $aid = searchaddress($afound, $link, $appartment);

                            if(!$afound){
                                $query = "INSERT INTO Addresses(Country, PostalCode, City, Street, Nr, Appartment) VALUES (?, ?, ?, ?, ?, ?)";
                                $stmt = $link->prepare($query);
                                $stmt->bind_param("sissis", $_POST['country'], $_POST['postalcode'], $_POST['city'], $_POST['street'], $_POST['number'], $appartment);
                                $stmt->execute();

                                $aid = searchaddress($afound, $link, $appartment);
                            }

                            $query = "INSERT INTO Users(FirstName, LastName, Email, Passwd, Phone, AddressID, BirthDate, Administrator) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt = $link->prepare($query);
                            $hashedpass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            $phone = intval(preg_replace('/[^0-9]/', '', '604-619-5135'));
                            $admin = 0;
                            $stmt->bind_param("ssssiisi", $_POST['firstname'], $_POST['lastname'], $_POST['email'], $hashedpass, $phone, $aid, $_POST['birthdate'], $admin);
                            $stmt->execute();

                            header("Location: Home.php");
                        }
                    }
                    else{
                        $str = "<script>$(document).ready(function(){";
                        $str .= "$(\".passverification\").show();";
                        $str .= "$(\".fill\").hide();";
                        $str .= "$(\".exists\").hide();});</script>";
                        echo $str;
                    }
                }
                else{
                    $str = "<script>$(document).ready(function(){";
                    $str .= "$(\".passverification\").hide();";
                    $str .= "$(\".fill\").show();";
                    $str .= "$(\".exists\").hide();});</script>";
                    echo $str;
                }
            }
            ?>
            <footer>
                <a href="https://www.thomasmore.be/">&copy;Thomas More</a>
            </footer>
        </div>
    </body>
</html>