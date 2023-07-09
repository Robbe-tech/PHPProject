<?php
include("ProductClass.php");
include("Connect.php");

$prevwhere = FALSE;
$type = FALSE;
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

$bolt = $_POST['bolt'] === "true"? true: false;
$nut = $_POST['nut'] === "true"? true: false;
$wrench = $_POST['wrench'] === "true"? true: false;
$screw = $_POST['screw'] === "true"? true: false;
$screwdriver = $_POST['screwdriver'] === "true"? true: false;
$spike = $_POST['spike'] === "true"? true: false;
$hammer = $_POST['hammer'] === "true"? true: false;
$drill = $_POST['drill'] === "true"? true: false;
$drillbit = $_POST['drillbit'] === "true"? true: false;

$mindiameter = $_POST['mindiameter'];
$maxdiameter = $_POST['maxdiameter'];

$iskit = $_POST['iskit'] === "true"? true: false;
$notkit = $_POST['notkit'] === "true"? true: false;

$isresizable = $_POST['isresizable'] === "true"? true: false;
$notresizable = $_POST['notresizable'] === "true"? true: false;

$iselectrical = $_POST['iselectrical'] === "true"? true: false;
$notelectrical = $_POST['notelectrical'] === "true"? true: false;

$slottedhead = $_POST['slottedhead'] === "true"? true: false;
$phillipshead = $_POST['phillipshead'] === "true"? true: false;
$mixedhead = $_POST['mixedhead'] === "true"? true: false;
$triwinghead = $_POST['triwinghead'] === "true"? true: false;
$allensechead = $_POST['allensechead'] === "true"? true: false;
$torxsechead = $_POST['torxsechead'] === "true"? true: false;
$squarehead = $_POST['squarehead'] === "true"? true: false;
$pozidrivhead = $_POST['pozidrivhead'] === "true"? true: false;
$allenhead = $_POST['allenhead'] === "true"? true: false;
$clutchhead = $_POST['clutchhead'] === "true"? true: false;
$torxhead = $_POST['torxhead'] === "true"? true: false;
$spannerhead = $_POST['spannerhead'] === "true"? true: false;
$schraderhead = $_POST['schraderhead'] === "true"? true: false;

$filter = $_POST['filter'];

$prep = "";
$extraprep = "";
$values = [];
$extravalues = [];

$query = "SELECT k.KitID AS ID, i.Link AS Link, k.KitName AS KitName, k.KitPrice AS KitPrice, k.Descript AS Descript, MIN(FLOOR(p.Stock / kp.Quantity)) AS Stock";
$query .= " FROM Heads h JOIN Products p ON h.ProductID = p.ProductID JOIN KitProducts kp ON p.ProductID = kp.ProductID";
$query .= " JOIN Kits k ON kp.KitID = k.KitID JOIN Images i ON k.KitID = i.KitID";

$where = "";
$extrawhere = "";

if(isset($name) && !empty($name)) {
    $name = "%".$name."%";
    $where .= " WHERE (k.KitName LIKE ? OR p.ProductName LIKE ?)";
    $prevwhere= TRUE;
    $prep .= "ss";
    array_push($values, $name, $name);
}

if(isset($manufacturer) && !empty($manufacturer)) {
    if ($prevwhere) {
        $manufacturer = "%".$manufacturer."%";
        $where .= " AND p.Manufacturer LIKE ?";
    }
    else {
        $manufacturer = "%".$manufacturer."%";
        $where .= " WHERE p.Manufacturer LIKE ?";
        $prevwhere = TRUE;
    }
    $prep .= "s";
    array_push($values, $manufacturer);
}

if($bolt) {
    if($prevwhere) {
        $where .= " AND (p.ProductType = 'b'";
    }
    else {
        $where .= " WHERE (p.ProductType = 'b'";
        $prevwhere = TRUE;
    }
    $type = TRUE;
}

if($nut) {
    if($prevwhere) {
        if ($type) {
            $where .= " OR p.ProductType = 'n'";
        }
        else {
            $where .= " AND (p.ProductType = 'n'";
        }
    }
    else {
        $where .= " WHERE (p.ProductType = 'n'";
        $prevwhere = TRUE;
    }
    $type = TRUE;
}

if($wrench) {
    if($prevwhere) {
        if ($type) {
            $where .= " OR p.ProductType = 'w'";
        }
        else {
            $where .= " AND (p.ProductType = 'w'";
        }
    }
    else {
        $where .= " WHERE (p.ProductType = 'w'";
        $prevwhere = TRUE;
    }
    $type = TRUE;
}

if($screw) {
    if($prevwhere) {
        if ($type) {
            $where .= " OR p.ProductType = 's'";
        }
        else {
            $where .= " AND (p.ProductType = 's'";
        }
    }
    else {
        $where .= " WHERE (p.ProductType = 's'";
        $prevwhere = TRUE;
    }
    $type = TRUE;
}


if($screwdriver) {
    if($prevwhere) {
        if ($type) {
            $where .= " OR p.ProductType = 'c'";
        }
        else {
            $where .= " AND (p.ProductType = 'c'";
        }
    }
    else {
        $where .= " WHERE (p.ProductType = 'c'";
        $prevwhere = TRUE;
    }
    $type = TRUE;
}

if($spike) {
    if($prevwhere) {
        if ($type) {
            $where .= " OR p.ProductType = 'p'";
        }
        else {
            $where .= " AND (p.ProductType = 'p'";
        }
    }
    else {
        $where .= " WHERE (p.ProductType = 'p'";
        $prevwhere = TRUE;
    }
    $type = TRUE;
}

if($hammer) {
    if($prevwhere) {
        if ($type) {
            $where .= " OR p.ProductType = 'h'";
        }
        else {
            $where .= " AND (p.ProductType = 'h'";
        }
    }
    else {
        $where .= " WHERE (p.ProductType = 'h'";
        $prevwhere = TRUE;
    }
    $type = TRUE;
}

if($drill) {
    if($prevwhere) {
        if ($type) {
            $where .= " OR p.ProductType = 'd'";
        }
        else {
            $where .= " AND (p.ProductType = 'd'";
        }
    }
    else {
        $where .= " WHERE (p.ProductType = 'd'";
        $prevwhere = TRUE;
    }
    $type = TRUE;
}

if($drillbit) {
    if($prevwhere) {
        if ($type) {
            $where .= " OR p.ProductType = 'r'";
        }
        else {
            $where .= " AND (p.ProductType = 'r'";
        }
    }
    else {
        $where .= " WHERE (p.ProductType = 'r'";
        $prevwhere = TRUE;
    }
    $type = TRUE;
}

if ($type) {
    $where .= ")";
}

if ($isresizable) {
    if($prevwhere){
        $where .= " AND (p.Resizable = 1";
    }
    else {
        $where .= " WHERE (p.Resizable = 1";
        $prevwhere = TRUE;
    }
    $resizable = TRUE;
}

if ($notresizable) {
    if($prevwhere){
        if ($resizable) {
            $where .= " OR p.Resizable = 0";
        }
        else {
            $where .= " AND (p.Resizable = 0";
        }
    }
    else {
        $where .= " WHERE (p.Resizable = 0";
        $prevwhere = TRUE;
    }
    $resizable = TRUE;
}

if ($resizable) {
    $where .= ")";
}

if ($iselectrical) {
    if($prevwhere){
        $where .= " AND (p.Electrical = 1";
    }
    else {
        $where .= " WHERE (p.Electrical = 1";
        $prevwhere = TRUE;
    }
    $electrical = TRUE;
}

if ($notelectrical) {
    if($prevwhere){
        if ($electrical) {
            $where .= " OR p.Electrical = 0";
        }
        else {
            $where .= " AND (p.Electrical = 0";
        }
    }
    else {
        $where .= " WHERE (p.Electrical = 0";
        $prevwhere = TRUE;
    }
    $electrical = TRUE;
}

if ($electrical) {
    $where .= ")";
}

if($slottedhead) {
    if($prevwhere) {
        $where .= " AND (h.HeadType = 's'";
    }
    else {
        $where .= " WHERE (h.HeadType = 's'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($phillipshead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'p'";
        }
        else {
            $where .= " AND (h.HeadType = 'p'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'p'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($mixedhead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'm'";
        }
        else {
            $where .= " AND (h.HeadType = 'm'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'm'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($triwinghead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 't'";
        }
        else {
            $where .= " AND (h.HeadType = 't'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 't'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}


if($allensechead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'a'";
        }
        else {
            $where .= " AND (h.HeadType = 'a'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'a'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($torxsechead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'o'";
        }
        else {
            $where .= " AND (h.HeadType = 'o'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'o'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($squarehead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'q'";
        }
        else {
            $where .= " AND (h.HeadType = 'q'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'q'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($pozidrivhead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'z'";
        }
        else {
            $where .= " AND (h.HeadType = 'z'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'z'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($allenhead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'l'";
        }
        else {
            $where .= " AND (h.HeadType = 'l'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'l'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($clutchhead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'c'";
        }
        else {
            $where .= " AND (h.HeadType = 'c'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'c'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($torxhead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'r'";
        }
        else {
            $where .= " AND (h.HeadType = 'r'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'r'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($spannerhead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'n'";
        }
        else {
            $where .= " AND (h.HeadType = 'n'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'n'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

if($schraderhead) {
    if($prevwhere) {
        if ($head) {
            $where .= " OR h.HeadType = 'h'";
        }
        else {
            $where .= " AND (h.HeadType = 'h'";
        }
    }
    else {
        $where .= " WHERE (h.HeadType = 'h'";
        $prevwhere = TRUE;
    }
    $head = TRUE;
}

#if you don't have a head
if ($head) {
    $where .= " OR h.HeadType = NULL)";
}

if ($iskit) {
    if($prevwhere){
        $where .= " AND (k.IsKit = 1";
    }
    else {
        $where .= " WHERE (k.IsKit = 1";
        $prevwhere = TRUE;
    }
    $kit = TRUE;
}

if ($notkit) {
    if($prevwhere){
        if ($kit) {
            $where .= " OR k.IsKit = 0";
        }
        else {
            $where .= " AND (k.IsKit = 0";
        }
    }
    else {
        $where .= " WHERE (k.IsKit = 0";
        $prevwhere = TRUE;
    }
    $kit = TRUE;
}

if ($kit) {
    $where .= ")";
}

#extra so it won't affect extremes
if (isset($lowprice) && !empty($lowprice)) {
    if ($prevwhere){
        $extrawhere .= " AND k.KitPrice >= ?";
    }
    else{
        $extrawhere .= " WHERE k.KitPrice >= ?";
        $prevwhere = TRUE;
    }
    $extraprep .= "i";
    array_push($extravalues, $lowprice);
}

if (isset($highprice) && !empty($highprice)) {
    if ($prevwhere) {
        $extrawhere .= " AND k.KitPrice <= ?";
    }
    else {
        $extrawhere .= " WHERE k.KitPrice <= ?";
        $prevwhere = TRUE;
    }
    $extraprep .= "i";
    array_push($extravalues, $highprice);
}

if (isset($minweight) && !empty($minweight)) {
    if($prevwhere){
        $extrawhere .= " AND k.WeightG >= ?";
    }
    else {
        $extrawhere .= " WHERE k.WeightG >= ?";
        $prevwhere = TRUE;
    }
    $weight = TRUE;
    $extraprep .= "i";
    array_push($extravalues, $minweight);
}

if (isset($maxweight) && !empty($maxweight)) {
    if($prevwhere){
        $extrawhere .= " AND k.WeightG <= ?";
    }
    else {
        $extrawhere .= " WHERE k.WeightG <= ?";
        $prevwhere = TRUE;
    }
    $weight = TRUE;
    $extraprep .= "i";
    array_push($extravalues, $maxweight);
}

if (isset($mindiameter) && !empty($mindiameter)) {
    if($prevwhere){
        $extrawhere .= " AND h.Diameter >= ".$mindiameter;
    }
    else {
        $extrawhere .= " WHERE h.Diameter >= ".$mindiameter;
        $prevwhere = TRUE;
    }
    $extraprep .= "i";
    array_push($extravalues, $mindiameter);
}

if (isset($maxdiameter) && !empty($maxdiameter)) {
    if($prevwhere){
        $extrawhere .= " AND h.Diameter <= ".$maxdiameter;
    }
    else {
        $extrawhere .= " WHERE h.Diameter <= ".$maxdiameter;
        $prevwhere = TRUE;
    }
    $extraprep .= "i";
    array_push($extravalues, $maxdiameter);
}

$query .= $where.$extrawhere." GROUP BY k.KitID";

if ($filter !== "default") {
    if ($filter === "a-z") {
        $query .= " ORDER BY k.KitName ASC";
    }
    if ($filter === "z-a") {
        $query .= " ORDER BY k.KitName DESC";
    }
    if ($filter === "low-high") {
        $query .= " ORDER BY k.KitPrice ASC";
    }
    if ($filter === "high-low") {
        $query .= " ORDER BY k.KitPrice DESC";
    }
}
$query.=";";

$extremes = "SELECT MIN(k.KitPrice) AS MinPrice, MAX(k.KitPrice) AS MaxPrice, MIN(k.WeightG) AS MinWeight, MAX(k.WeightG) AS MaxWeight, MIN(h.Diameter) AS MinDia, MAX(h.Diameter) AS MaxDia";
$extremes .= " FROM Heads h JOIN Products p ON h.ProductID = p.ProductID JOIN KitProducts kp ON p.ProductID = kp.ProductID";
$extremes .= " JOIN Kits k ON kp.KitID = k.KitID JOIN Images i ON k.KitID = i.KitID".$where.";";

$stmt = $link->prepare($extremes);
if(strlen($prep) > 0){
    $stmt->bind_param($prep, ...$values);
}
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$str = "<script>";
    $str .= "$(document).ready(function(){";
        $str .= "$(\".priceValue\").attr({";
            $str .= "\"max\": ".$row['MinPrice'].",";
            $str .= "\"min\": ".$row['MaxPrice'];
        $str .= "});";
        $str .= "$(\".weightValue\").attr({";
            $str .= "\"max\": ".$row['MinWeight'].",";
            $str .= "\"min\": ".$row['MaxWeight'];
        $str .= "});";
        $str .= "$(\".diameterValue\").attr({";
            $str .= "\"max\": ".$row['MinDia'].",";
            $str .= "\"min\": ".$row['MaxDia'];
        $str .= "});";
    $str .= "});";
$str .= "</script>";
echo $str;

$prep .= $extraprep;
$values = array_merge($values, $extravalues);

#get products
$stmt = $link->prepare($query);
if(strlen($prep) > 0){
    $stmt->bind_param($prep, ...$values);
}
$stmt->execute();
$result = $stmt->get_result();

#show products
while ($row = $result->fetch_assoc()){
    $product = new Product($row['ID'], $row['Link'], $row['KitName'], $row['KitPrice'], $row['Descript']);
    $id = $row['ID'];
    $stock = $row['Stock'];
    echo "<div id=\"product\">";
    $product->print();
    $str = "<p class=\"warning\" id=\"few".$id."\">This product only has ".$stock." left</p>";
    $str .= "<p class=\"warning\" id=\"out".$id."\">This product is currently out of stock</p>";
    $str .= "<p class=\"warning\" id=\"large".$id."\">You have entered a larger ammount than is currently in our stock. Currently left:".$stock."</p>";
    $str .= "<form>";
    $str .= "<input type=\"button\" value=\"-\" id=\"minus".$id."\" onclick=\"minus(".$id.")\"/>";
    $str .= "<input type=\"number\" value=\"0\" name=\"ammount".$id."\" id=\"ammount".$id."\" min=\"0\" max=\"".$stock."\"/>";
    $str .= "<input type=\"button\" value=\"+\" id=\"plus".$id."\" onclick=\"plus(".$id.", ".$stock.")\"/>";
    $str .= "<button class=\"addcart\" id=\"addcart".$id."\" onclick=\"addtocart(".$id.", ".$stock.")\">Add to cart <img src=\"Images/ShoppingCart.png\"/></button>";
    $str .= "</form>";
    $str .= "</div>";
    $str .= "<script>";
        $str .= "$(document).ready(function(){";
            $str .= "$(\"#minus".$id."\").attr(\"disabled\", true);";
            $str .= "$(\"#large".$id."\").css(\"bottom\", \"75px\");";
        if ($stock === 0){
            $str .= "$(\"#out".$id."\").show();";
            $str .= "$(\"#plus".$id."\").attr(\"disabled\", true);";
            $str .= "$(\"#addcart".$id."\").attr(\"disabled\", true);";
        }
        else{
            if ($stock <= 10){
                $str .= "$(\"#few".$id."\").show();";
            }
        }
        $str .= "});";
    $str .= "</script>";
    echo $str;
}
?>