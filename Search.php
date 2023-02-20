<?php
$host = "localhost";
$user = "Webgebruiker";
$passw = "Lab2021";
$databank = "RobbeGeusens";

include "ProductClass.php";

$prevwhere = FALSE;
$prev = FALSE;
$price = FALSE;
$weight = FALSE;
$type = FALSE;
$diameter = FALSE;
$kit = FALSE;
$resizable = FALSE;
$electrical = FALSE;
$head = FALSE;

$name = $_POST['name'];

$manufacturer = $_POST['manufacturer'];

$lowprice = $_POST['lowprice'];
$highprice = $_POST['highprice'];

$minweight = $_POST['minweight'];
$maxweight = $_POST['maxweight'];

$bolt = $_POST['bolt'];
$nut = $_POST['nut'];
$wrench = $_POST['wrench'];
$screw = $_POST['screw'];
$screwdriver = $_POST['screwdriver'];
$spike = $_POST['spike'];
$hammer = $_POST['hammer'];
$drill = $_POST['drill'];
$drillbit = $_POST['drillbit'];

$mindiameter = $_POST['mindiameter'];
$maxdiameter = $_POST['maxdiameter'];

$iskit = $_POST['iskit'];
$notkit = $_POST['notkit'];

$isresizable = $_POST['isresizable'];
$notresizable = $_POST['notresizable'];

$iselectrical = $_POST['iselectrical'];
$notelectrical = $_POST['notelectrical'];

$slottedhead = $_POST['slottedhead'];
$phillipshead = $_POST['phillipshead'];
$mixedhead = $_POST['mixedhead'];
$triwinghead = $_POST['triwinghead'];
$allensechead = $_POST['allensechead'];
$torxsechead = $_POST['torxsechead'];
$squarehead = $_POST['squarehead'];
$pozidrivhead = $_POST['pozidrivhead'];
$allenhead = $_POST['allenhead'];
$clutchhead = $_POST['clutchhead'];
$torxhead = $_POST['torxhead'];
$spannerhead = $_POST['spannerhead'];
$schraderhead = $_POST['schraderhead'];

$filter = $_POST['filter'];

$link = mysqli_connect($host, $user, $passw) or die("Server not available");
mysqli_select_db($link, $databank) or die("Database not available");

$query = "SELECT k.KitID AS ID, i.Link AS Link, k.KitName AS KitName, k.KitPrice AS Price, k.Descript AS Descript, MIN(FLOOR(p.Stock / kp.Quantity)) AS Stock";
$query .= " FROM Heads AS h JOIN Products AS p ON h.ProductID = p.ProductID JOIN KitProducts AS kp ON p.ProductID = kp.ProductID";
$query .= " JOIN Kits AS k ON kp.KitID = k.KitID JOIN Images AS i ON k.KitID = i.KitID";

if (isset($lowprice) && !empty($lowprice)) {
    $query .= " WHERE (k.KitPrice >= ".$lowprice;
    $prevwhere = TRUE;
    $price = TRUE;
}

if (isset($highprice) && !empty($highprice)) {
    if ($prevwhere) {
        if ($price) {
            $query .= " OR k.KitPrice <= ".$highprice;
        }
        else {
            $query .= " AND (k.KitPrice <= ".$highprice;
            $price = TRUE;
        }
    }
    else {
        $query .= " WHERE (k.KitPrice <= ".$highprice;
        $prevwhere = TRUE;
        $price = TRUE;
    }
}

if ($price) {
    $query .= ")";
}

if (isset($iskit)) {
    if($prevwhere){
        $query .= " AND (k.IsKit = 1";
        $kit = TRUE;
    }
    else {
        $query .= " WHERE (k.IsKit = 1";
        $prevwhere = TRUE;
        $kit = TRUE;
    }
}

if (isset($notkit)) {
    if($prevwhere){
        if ($kit) {
            $query .= " OR k.IsKit = 0";
        }
        else {
            $query .= " AND (k.IsKit = 0";
            $kit = TRUE;
        }
    }
    else {
        $query .= " WHERE (k.IsKit = 0";
        $prevwhere = TRUE;
        $kit = TRUE;
    }
}

if ($kit) {
    $query .= ")";
}

$query .= " GROUP BY k.KitID";

if(isset($name) && !empty($name)) {
    $search = mysqli_real_escape_string($link, htmlspecialchars($name));
    $query .= " HAVING (k.Name LIKE '%".$search."%' OR p.Name LIKE '%".$search."%')";
    $prev = TRUE;
}

if(isset($manufacturer) && !empty($manufacturer)) {
    if ($prev) {
        $search = mysqli_real_escape_string($link, htmlspecialchars($manufacturer));
        $query .= " AND h.manufacturer LIKE '%".$search."%'";
    }
    else {
        $search = mysqli_real_escape_string($link, htmlspecialchars($manufacturer));
        $query .= " HAVING h.manufacturer LIKE '%".$search."%'";
        $prev = TRUE;
    }
}

if (isset($minweight) && !empty($minweight)) {
    if($prev){
        $query .= " AND (p.weight >= ".$minweight;
        $weight = TRUE;
    }
    else {
        $query .= " HAVING (p.weight >= ".$minweight;
        $prev = TRUE;
        $weight = TRUE;
    }
}

if (isset($maxweight) && !empty($maxweight)) {
    if($prev){
        if ($weight) {
            $query .= " OR p.weight <= ".$maxweight;
        }
        else {
            $query .= " AND (p.weight <= ".$maxweight;
            $weight = TRUE;
        }
    }
    else {
        $query .= " HAVING (p.weight <= ".$maxweight;
        $prev = TRUE;
        $weight = TRUE;
    }
}

if ($weight) {
    $query .= ")";
}

if(isset($bolt)) {
    if($prev) {
        $query .= " AND (h.ProductType = 'b'";
        $type = TRUE;
    }
    else {
        $query .= " HAVING (h.ProductType = 'b'";
        $prev = TRUE;
        $type = TRUE;
    }
}

if(isset($nut)) {
    if($prev) {
        if ($type) {
            $query .= " OR h.ProductType = 'n'";
        }
        else {
            $query .= " AND (h.ProductType = 'n'";
            $type = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.ProductType = 'n'";
        $prev = TRUE;
        $type = TRUE;
    }
}

if(isset($wrench)) {
    if($prev) {
        if ($type) {
            $query .= " OR h.ProductType = 'w'";
        }
        else {
            $query .= " AND (h.ProductType = 'w'";
            $type = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.ProductType = 'w'";
        $prev = TRUE;
        $type = TRUE;
    }
}

if(isset($screw)) {
    if($prev) {
        if ($type) {
            $query .= " OR h.ProductType = 's'";
        }
        else {
            $query .= " AND (h.ProductType = 's'";
            $type = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.ProductType = 's'";
        $prev = TRUE;
        $type = TRUE;
    }
}


if(isset($screwdriver)) {
    if($prev) {
        if ($type) {
            $query .= " OR h.ProductType = 'c'";
        }
        else {
            $query .= " AND (h.ProductType = 'c'";
            $type = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.ProductType = 'c'";
        $prev = TRUE;
        $type = TRUE;
    }
}

if(isset($spike)) {
    if($prev) {
        if ($type) {
            $query .= " OR h.ProductType 'p'";
        }
        else {
            $query .= " AND (h.ProductType = 'p'";
            $type = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.ProductType = 'p'";
        $prev = TRUE;
        $type = TRUE;
    }
}

if(isset($hammer)) {
    if($prev) {
        if ($type) {
            $query .= " OR h.ProductType = 'h'";
        }
        else {
            $query .= " AND (h.ProductType = 'h'";
            $type = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.ProductType = 'h'";
        $prev = TRUE;
        $type = TRUE;
    }
}

if(isset($drill)) {
    if($prev) {
        if ($type) {
            $query .= " OR h.ProductType = 'd'";
        }
        else {
            $query .= " AND (h.ProductType = 'd'";
            $type = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.ProductType = 'd'";
        $prev = TRUE;
        $type = TRUE;
    }
}

if(isset($drillbit)) {
    if($prev) {
        if ($type) {
            $query .= " OR h.ProductType = 'r'";
        }
        else {
            $query .= " AND (h.ProductType = 'r'";
            $type = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.ProductType = 'r'";
        $prev = TRUE;
        $type = TRUE;
    }
}

if ($type) {
    $query .= ")";
}

if (isset($mindiameter) && !empty($mindiameter)) {
    if($prev){
        $query .= " AND (h.Diameter >= ".$mindiameter;
        $diameter = TRUE;
    }
    else {
        $query .= " HAVING (h.Diameter >= ".$mindiameter;
        $prev = TRUE;
        $diameter = TRUE;
    }
}

if (isset($maxdiameter) && !empty($maxdiameter)) {
    if($prev){
        if ($diameter) {
            $query .= " OR h.Diameter <= ".$maxdiameter;
        }
        else {
            $query .= " AND (h.Diameter <= ".$maxdiameter;
            $diameter = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.Diameter <= ".$maxdiameter;
        $prev = TRUE;
        $diameter = TRUE;
    }
}

if ($diameter) {
    $query .= ")";
}

if (isset($isresizable)) {
    if($prev){
        $query .= " AND (p.Resizable = 1";
        $resizable = TRUE;
    }
    else {
        $query .= " HAVING (p.Resizable = 1";
        $prev = TRUE;
        $resizable = TRUE;
    }
}

if (isset($notresizable)) {
    if($prev){
        if ($resizable) {
            $query .= " OR p.Resizable = 0";
        }
        else {
            $query .= " AND (p.Resizable = 0";
            $resizable = TRUE;
        }
    }
    else {
        $query .= " HAVING (p.Resizable = 0";
        $prev = TRUE;
        $resizable = TRUE;
    }
}

if ($resizable) {
    $query .= ")";
}

if (isset($iselectrical)) {
    if($prev){
        $query .= " AND (p.Electrical = 1";
        $electrical = TRUE;
    }
    else {
        $query .= " HAVING (p.Electrical = 1";
        $prev = TRUE;
        $electrical = TRUE;
    }
}

if (isset($notelectrical)) {
    if($prev){
        if ($electrical) {
            $query .= " OR p.Electrical = 0";
        }
        else {
            $query .= " AND (p.Electrical = 0";
            $electrical = TRUE;
        }
    }
    else {
        $query .= " HAVING (p.Electrical = 0";
        $prev = TRUE;
        $electrical = TRUE;
    }
}

if ($electrical) {
    $query .= ")";
}

if(isset($slottedhead)) {
    if($prev) {
        $query .= " AND (h.HeadType = 's'";
        $head = TRUE;
    }
    else {
        $query .= " HAVING (h.HeadType = 's'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($phillipshead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'p'";
        }
        else {
            $query .= " AND (h.HeadType = 'p'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'p'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($mixedhead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'm'";
        }
        else {
            $query .= " AND (h.HeadType = 'm'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'm'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($triwinghead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 't'";
        }
        else {
            $query .= " AND (h.HeadType = 't'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 't'";
        $prev = TRUE;
        $head = TRUE;
    }
}


if(isset($allensechead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'a'";
        }
        else {
            $query .= " AND (h.HeadType = 'a'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'a'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($torxsechead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'o'";
        }
        else {
            $query .= " AND (h.HeadType = 'o'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'o'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($squarehead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'q'";
        }
        else {
            $query .= " AND (h.HeadType = 'q'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'q'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($pozidrivhead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'z'";
        }
        else {
            $query .= " AND (h.HeadType = 'z'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'z'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($allenhead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.headtyp = 'l'";
        }
        else {
            $query .= " AND (h.HeadType = 'l'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'l'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($clutchhead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'c'";
        }
        else {
            $query .= " AND (h.HeadType = 'c'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'c'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($torxhead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'r'";
        }
        else {
            $query .= " AND (h.HeadType = 'r'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'r'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($spannerhead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'n'";
        }
        else {
            $query .= " AND (h.HeadType = 'n'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'n'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if(isset($schraderhead)) {
    if($prev) {
        if ($head) {
            $query .= " OR h.HeadType = 'h'";
        }
        else {
            $query .= " AND (h.HeadType = 'h'";
            $head = TRUE;
        }
    }
    else {
        $query .= " HAVING (h.HeadType = 'h'";
        $prev = TRUE;
        $head = TRUE;
    }
}

if ($head) {
    $query .= " OR h.Headtype = NULL)";
}

if (!(strcmp($order, "default") == 0)) {
    if (strcmp($order, "a-z") == 0) {
        $query .= " ORDER BY k.KitName ASCENDING";
    }
    if (strcmp($order, "z-a") == 0) {
        $query .= " ORDER BY k.KitName DESCENDING";
    }
    if (strcmp($order, "low-high") == 0) {
        $query .= " ORDER BY k.KitPrice ASCENDING";
    }
    if (strcmp($order, "high-low") == 0) {
        $query .= " ORDER BY k.KitPrice DESCENDING";
    }
}

$result = mysqli_query($link, $query) or die("A mistake happened executing the query \"$query\"");

while ($row = mysqli_fetch_array($result)){
    $product = new Product($row['Link'], $row['KitName'], $row['KitPrice'], $row['Descript']);
    echo "<a href=\"Product.php?id=".$row['ID'].">\">div class=\"product\">";
    $product->print();
    $str = "<p class=\"warning\" id=\"few\">This product only has ".$row['Stock']." left</p>";
    $str .= "<p class=\"warning\" id=\"out\">This product is currently out of stock</p>";
    $str .= "<p class=\"warning\" id=\"large\">You have entered a larger ammount than is currently in our stock. Currently left:".$row['Stock']."</p>";
    $str .= "<form method=\"post\">";
    $str .= "<input type=\"button\" value=\"-\" id=\"minus\" onclick=\"minus()\"/>";
    $str .= "<input type=\"number\" value=\"0\" name=\"ammount\" id=\"ammount\" min=\"0\" max=\"".$row['Stock']."\"/>";
    $str .= "<input type=\"button\" value=\"+\" id=\"plus\"/>";
    $str .= "<button id=\"addcart\" onclick=\"addtocart(".$row['ID'].", ".$row['Stock'].")\">Add to kart <img src=\"Images/ShoppingCart.png\"/></button>";
    $str .= "</form>";
    $str .= "</div></a>";
}
?>