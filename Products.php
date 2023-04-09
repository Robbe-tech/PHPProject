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
            $page = 1;
            var prevscrollpos = window.pageYOffset;

            $(document).ready(function(){
                $(window).scroll(function() {
                    if (prevscrollpos > window.pageYOffset){
                        $("nav").css("top", "0");
                    }
                    else {
                        $("nav").css("top", "-50px");
                    }

                    prevscrollpos = window.pageYOffset;
                });
                $("form").change(function(){
                    ajax();
                });
                $("#filter").change(function(){
                    ajax();
                });

                $("#priceslider").slider({
                    min: 0,
                    max: 200,
                    range: true,
                    slide: function(event, ui) {
                        for (var i = 0; i < ui.values.length; i++) {
                            $("input.priceValue[data-index=" + i + "]").val(ui.values[i]);
                        }
                    }
                });​

                $("input.priceValue").change(function() {
                    var $this = $(this);
                    $("#priceslider").slider("values", $this.data("index"), $this.val());
                });

                $("#weightslider").slider({
                    min: 0,
                    max: 200,
                    range: true,
                    slide: function(event, ui) {
                        for (var i = 0; i < ui.values.length; i++) {
                            $("input.weightValue[data-index=" + i + "]").val(ui.values[i]);
                        }
                    }
                });​

                $("input.weightValue").change(function() {
                    var $this = $(this);
                    $("#weightslider").slider("values", $this.data("index"), $this.val());
                });

                $("#diameterslider").slider({
                    min: 0,
                    max: 200,
                    range: true,
                    slide: function(event, ui) {
                        for (var i = 0; i < ui.values.length; i++) {
                            $("input.diameterValue[data-index=" + i + "]").val(ui.values[i]);
                        }
                    }
                });​

                $("input.diameterValue").change(function() {
                    var $this = $(this);
                    $("#diameterslider").slider("values", $this.data("index"), $this.val());
                });
            });

            function ajax(){
                $name = $("#name").val();
                $manufacturer = $("#manufacturer").val();

                $lowprice = $("#lowprice").val();
                $highprice = $("#highprice").val();

                $minweight = $("#minweight").val();
                $maxweight = $("#maxweight").val();

                $bolt = $("#bolt").is(":checked");
                $nut = $("#nut").is(":checked");
                $wrench = $("#wrench").is(":checked");
                $screw = $("#screw").is(":checked");
                $screwdriver = $("#screwdriver").is(":checked");
                $spike = $("#spike").is(":checked");
                $hammer = $("#hammer").is(":checked");
                $drill = $("#drill").is(":checked");
                $drillbit = $("#drillbit").is(":checked");

                $mindiameter = $("#mindiameter").val();
                $maxdiameter = $("#maxdiameter").val();

                $iskit = $("#iskit").is(":checked");
                $notkit = $("#notkit").is(":checked");

                $isresizable = $("#isresizable").is(":checked");
                $notresizable = $("#notresizable").is(":checked");

                $iselectrical = $("#iselectrical").is(":checked");
                $notelectrical = $("#notelectrical").is(":checked");

                $slottedhead = $("#slottedhead").is(":checked");
                $phillipshead = $("#phillipshead").is(":checked");
                $mixedhead = $("#mixedhead").is(":checked");
                $triwinghead = $("#triwinghead").is(":checked");
                $allensechead = $("#allensechead").is(":checked");
                $torxsechead = $("#torxsechead").is(":checked");
                $squarehead = $("#squarehead").is(":checked");
                $pozidrivhead = $("#pozidrivhead").is(":checked");
                $allenhead = $("#allenhead").is(":checked");
                $clutchhead = $("#clutchhead").is(":checked");
                $torxhead = $("#torxhead").is(":checked");
                $spannerhead = $("#spannerhead").is(":checked");
                $schraderhead = $("#schraderhead").is(":checked");

                $filter = $('#filter').find(":selected").val();

                $request = $.ajax({
                    method:"POST",
                    url:"Search.php",
                    data: { page: $page, name: $name, manufacturer: $manufacturer, lowprice: $lowprice, highprice: $highprice,
                        minweight: $minweight, maxweight: $maxweight, bolt: $bolt, nut: $nut, wrench: $wrench, screw: $screw,
                        screwdriver: $screwdriver, spike: $spike, hammer: $hammer, drill: $drill, drillbit: $drillbit,
                        mindiameter: $mindiameter, maxdiameter: $maxdiameter, iskit: $iskit, notkit: $notkit,
                        isresizable: $isresizable, notresizable: $notresizable, iselectrical: $iselectrical,
                        notelectrical: $notelectrical, slottedhead: $slottedhead, phillipshead: $phillipshead, mixedhead: $mixedhead,
                        triwinghead: $triwinghead, allensechead: $allensechead, torxsechead: $torxsechead, squarehead: $squarehead,
                        pozidrivhead: $pozidrivhead, allenhead: $allenhead, clutchhead: $clutchhead, torxhead: $torxhead,
                        spannerhead: $spannerhead, schraderhead: $schraderhead, fliter: $filter }
                });

                $request.done(function(msg){
                    $("#products").html(msg);    
                });

                $request.fail(function(jqXHR, textstatus){
                    $("#products").html("Request failed: ".textstatus)
                });
            }

            function minus(){
                var ammount = parseInt($(this).closest("#ammount").val());
                if(ammount != 0) {
                    var newammount = ammount - 1;
                    $(this).closest("#ammount").val(newammount.toString());
                    if(parseInt($(this).closest("#ammount").val()) === 0){
                        $(this).prop('disabled', true);
                    }
                    $(this).closest("#plus").prop('disabled', false);
                }
            }

            function ammount(stock){
                var ammount = parseInt($(this).closest("#ammount").val());
                if(ammount >= 0 && ammount <= stock) {
                    if(parseInt($(this).closest("#ammount").val()) === 0){
                        $(this).closest("#minus").prop('disabled', true);
                    }
                    else{
                        $(this).closest("#minus").prop('disabled', false);
                    }
                    if(parseInt($(this).closest("#ammount").val()) === stock){
                        $(this).closest("#plus").prop('disabled', true);
                    }
                    else{
                        $(this).closest("#plus").prop('disabled', false);
                    }
                }
            }

            function plus(stock){
                ammount = parseInt($(this).closest("#ammount").val());
                if(ammount != stock) {
                    var newammount = ammount + 1;
                    $(this).closest("#ammount").val(newammount.toString());
                    if(parseInt($(this).closest("#ammount").val()) === stock){
                        $(this).prop('disabled', true);
                    }
                    $(this).closest("minus").prop('disabled', false);
                }
            }

            function addtocart(id, stock){
                ammount = parseInt($(this).closest("#ammount").val());
                occured = FALSE;
                if(ammount != 0){
                    for( cart of $_SESSION['Cart']){
                        if(cart->getID() === id){
                            if((cart->getAmmount() + ammount) > stock){
                                $(this).closest("#large").show().delay(5000).fadeOut();
                            }
                            else{
                                cart->setAmmount(cart->getAmmount() + ammount);
                            }
                        }
                        occured = TRUE;
                    }

                    if(!occured){
                        $_SESSION['Cart'].push(new CartObject(id, ammount));
                    }
                }
            }
        </script>
    </head>
    <body>
        <div class="wrapper">
            <nav>
                <a href="Home.php">Home<</a>
                <a href="Products.php">Products</a>
                <?php
                if ($_SESSION['Login'] && $_SESSION['User']->getAdmin() == 1){
                    echo '<a href="Users.php">Users</a>';
                }
                if ($_SESSION['Login'] && $_SESSION['User']->getAdmin() == 1){
                    echo '<a href="AddProduct.php">Add product</a>';
                }
                if ($_SESSION['Login']){
                    echo '<a href="Cart.php">cart</a>';
                }
                if ($_SESSION['Login']){
                    echo '<a href="LogOut.php">Log out</a>';
                }
                else{
                    echo '<a href="LogIn.php">Log in</a>';
                }
                ?>
            </nav>
            <div class="content">
                <div class="searchbar">
                    <form method="post">
                        <label for="name">Name: </label>
                        <input type="text" id="name" name="name">
                        <div class="filter">
                            <label for="filter">Filter: </label>
                            <select name="filter" id="filter">
                                <option value="default">None</option>
                                <option value="low-high">Low-High</option>
                                <option value="high-low">High-Low</option>
                                <option value="a-z">A-Z</option>
                                <option value="z-a">Z-A</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="filters">
                    <form method="post">
                        <label for="manufacturer">Manufacturer:</label><br/>
                        <input type="text" id="manufacturer" name="manufacturer">

                        <label for="lowprice">Price:</label><br/>
                        <div class="slider">
                            <input type="number" class="priceValue" id="lowprice" data-index="0"/>
                            <div id="priceslider"></div>
                            <input type="number" class="priceValue" id="highprice" data-index="1"/>
                        </div>

                        <label for="minweight">Weight:</label><br/>
                        <div class="slider">
                            <input type="number" class="weightValue" id="minweight" data-index="0"/>
                            <div id="weightslider"></div>
                            <input type="number" class="weightValue" id="maxweight" data-index="1"/>
                        </div>

                        <label>Type:</label><br/>

                        <label for="bolt" class="checkbox">Bolt</label>
                        <input type="checkbox" name="bolt" id="bolt"><br/>

                        <label for="nut" class="checkbox">Nut</label>
                        <input type="checkbox" name="nut" id="nut"><br/>

                        <label for="wrench" class="checkbox">Wrench</label>
                        <input type="checkbox" name="wrench" id="wrench"><br/>

                        <label for="screw" class="checkbox">Screw</label>
                        <input type="checkbox" name="screw" id="screw"><br/>

                        <label for="screwdriver" class="checkbox">ScrewDriver</label>
                        <input type="checkbox" name="screwdriver" id="screwdriver"><br/>

                        <label for="spike" class="checkbox">Spike</label>
                        <input type="checkbox" name="spike" id="spike"><br/>

                        <label for="hammer" class="checkbox">Hammer</label>
                        <input type="checkbox" name="hammer" id="hammer"><br/>

                        <label for="drill" class="checkbox">Drill</label>
                        <input type="checkbox" name="drill" id="drill"><br/>

                        <label for="drillbit" class="checkbox">Drillbit</label>
                        <input type="checkbox" name="drillbit" id="drillbit"><br/>

                        <label for="mindiameter">Diameter:</label><br/>
                        <div class="slider">
                            <input type="number" class="diameterValue" id="mindiameter" data-index="0"/>
                            <div id="diameterslider"></div>
                            <input type="number" class="diameterValue" id="maxdiameter" data-index="1"/>
                        </div>

                        <label>Kit:</label><br/>

                        <label for="iskit" class="checkbox">Is a kit/set</label>
                        <input type="checkbox" name="iskit" id="iskit"><br/>

                        <label for="notkit" class="checkbox">Is not a kit/set</label>
                        <input type="checkbox" name="notkit" id="notkit"><br/>

                        <label>Resizable:</label><br/>

                        <label for="iresizable" class="checkbox">Is resizable</label>
                        <input type="checkbox" name="iresizable" id="iresizable"><br/>

                        <label for="notresizable" class="checkbox">Is not resizable</label>
                        <input type="checkbox" name="notresizable" id="notresizable"><br/>

                        <label>Electrical:</label><br/>

                        <label for="iselectrical" class="checkbox">Is electrical</label>
                        <input type="checkbox" name="iselectrical" id="iselectrical"><br/>

                        <label for="notelectrical" class="checkbox">Is not electrical</label>
                        <input type="checkbox" name="notelectrical" id="notelectrical"><br/>

                        <label>Head type:</label><br/>

                        <label for="slottedhead" class="checkbox">Slotted</label>
                        <input type="checkbox" name="slottedhead" id="slottedhead"><br/>

                        <label for="phillipshead" class="checkbox">Phillips/Cross</label>
                        <input type="checkbox" name="phillipshead" id="phillipshead"><br/>

                        <label for="mixedhead" class="checkbox">Mixed</label>
                        <input type="checkbox" name="mixedhead" id="mixedhead"><br/>

                        <label for="triwinghead" class="checkbox">Triwing</label>
                        <input type="checkbox" name="triwinghead" id="triwinghead"><br/>

                        <label for="allensechead" class="checkbox">Allen security</label>
                        <input type="checkbox" name="allensechead" id="allensechead"><br/>

                        <label for="torxsechead" class="checkbox">Torx security</label>
                        <input type="checkbox" name="torxsechead" id="torxsechead"><br/>

                        <label for="squarehead" class="checkbox">Squere</label>
                        <input type="checkbox" name="squarehead" id="squarehead"><br/>

                        <label for="pozidriv" class="checkbox">Pozidriv</label>
                        <input type="checkbox" name="pozidriv" id="pozidriv"><br/>

                        <label for="allen" class="checkbox">Allen</label>
                        <input type="checkbox" name="allen" id="allen"><br/>

                        <label for="clutchhead" class="checkbox">Clutch</label>
                        <input type="checkbox" name="clutchhead" id="clutchhead"><br/>

                        <label for="torxhead" class="checkbox">Torx</label>
                        <input type="checkbox" name="torxhead" id="torxhead"><br/>

                        <label for="spannerhead" class="checkbox">Spanner</label>
                        <input type="checkbox" name="spannerhead" id="spannerhead"><br/>

                        <label for="schraderhead" class="checkbox">Schrader</label>
                        <input type="checkbox" name="schraderhead" id="schraderhead"><br/>
                    </form>
                </div>
                <div>
                    <div id="products"></div>
                </div>
            </div>
            <footer>
                <a href="www.thomasmore.be">&copy;Thomas More</a>
            </footer>
        </div>
    </body>
</html>