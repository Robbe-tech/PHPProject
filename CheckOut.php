<!DOCTYPE html>
<?php
include "Session.php";
?>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="Reset.css">
        <link rel="stylesheet" href="Project.css"/>
        <title>Header</title><script src="jquery-ui-1.13.0.custom/external/jquery/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".fill").hide();
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
            <form action="CheckOut.php" method="post">
                <fieldset>
                    <legend>Address</legend>
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
                    <p class="fill">All fields except appartment need to be filled.</p>
                    <input type="submit" value="Buy" name="buy">
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
                if (isset($_POST['country']) && isset($_POST['postalcode']) && isset($_POST['city']) && isset($_POST['street']) && isset($_POST['number']) && !empty($_POST['country']) && !empty($_POST['postalcode']) && !empty($_POST['city']) && !empty($_POST['street']) && !empty($_POST['number'])){
                    include("Connect.php");

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

                    $query = "INSERT INTO Orders(UserID, Discount, PlacementDate, DeliveryDate, PlacedShop, DeliveryAddress) VALUES (?, 0, ?, NULL, NULL, ?)";
                    $stmt = $link->prepare($query);
                    $stmt->bind_param("isi", $_SESSION['User']->getID(), date('Y-m-d', strtotime(str_replace('-', '/', time()))), $aid);
                    $stmt->execute();
                    
                    $query = "SELECT OrderID FROM Orders WHERE UserID = ? ORDER BY OrderID DESC";
                    $stmt = $link->prepare($query);
                    $stmt->bind_param("i", $_SESSION['User']->getID());
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $orderID = $row["OrderID"];

                    foreach ($_SESSION['Cart'] as $product){
                        $kitID = $product->getProduct()->getID();
                        $ammount = $product->getAmmount();
                        $query = "INSERT INTO OrderedKits(OrderID, KitID, Quantity) VALUES (?, ?, ?)";
                        $stmt = $link->prepare($query);
                        $stmt->bind_param("iii", $orderID, $kitID, $ammount);
                        $stmt->execute();

                        $query = "SELECT productID, Quantity FROM KitProducts WHERE kitID = ?";
                        $stmt = $link->prepare($query);
                        $stmt->bind_param("i", $kitID);
                        $stmt->execute();
                        while($row = $result->fetch_assoc()){
                            $quantity = $row["Quantity"] * $ammount;
                            $productID = $row['productID'];
                            $query = "UPDATE products SET Stock = Stock - ? WHERE productID = ?";
                            $stmt = $link->prepare($query);
                            $stmt->bind_param("ii", $quantity, $productID);
                            $stmt->execute();
                        }
                    }

                    header("ThankYou.php");
                }
            }
            else{
                $str = "<script>$(document).ready(function(){";
                $str .= "$(\".fill\").show();});</script>";
                echo $str;
            }
            ?>
        </div>
    </body>
</html>