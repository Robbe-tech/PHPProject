<?php
include "Session.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="Reset.css">
        <link rel="stylesheet" href="Project.css"/>
        <title>Bits and bolts</title>
        <script src="jquery-ui-1.13.0.custom/external/jquery/jquery.js"></script>
        <script>
            $page = 1;
            var prevscrollpos = window.pageYOffset;

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
                        spannerhead: $spannerhead, schraderhead: $schraderhead, filter: $filter }
                });

                $request.done(function(msg){
                    $("#products").html(msg);    
                });

                $request.fail(function(jqXHR, textstatus){
                    $("#products").html("Request failed: ".textstatus)
                });
            }

            function minus(id){
                var ammount = $('#ammount' + id).val();
                var newammount = parseInt(ammount) - 1;
                $('#ammount' + id).val(newammount);
                if(newammount === 0){
                    $('#minus' + id).prop('disabled', true);
                }
                $('#plus' + id).prop('disabled', false);
            }

            function plus(id, stock){
                var ammount = $('#ammount' + id).val();
                var newammount = parseInt(ammount) + 1;
                if(ammount < stock){
                    $('#ammount' + id).val(newammount);
                    if(newammount >= stock){
                        $('#plus' + id).prop('disabled', true);
                    }
                    $('#minus' + id).prop('disabled', false);
                }
            }

            function addtocart($id, $Link, $KitName, $KitPrice, $Descript, $stock){
                $ammount = $("#ammount" + $id).val()
                if($ammount > 0){
                    if($ammount > $stock){
                        $("#large" + $id).show().delay(5000).fadeOut("slow");
                    }
                    else{
                        $request2 = $.ajax({
                            method:"POST",
                            url:"AddToCart.php",
                            data: { id: $id, link:$Link, name:$KitName, price:$KitPrice, descript:$Descript, stock:$stock, ammount: $ammount }
                        });

                        $request2.done(function(msg){
                            alert(msg);
                        });

                        $request2.fail(function(jqXHR, textstatus){
                            alert("Request failed: ".textstatus);
                        });
                    }
                }
            }

            $(document).ready(function(){
                $("input[type = \"number\"], input[type = \"text\"]").on("keyup", function(){
                    ajax();
                });
                $("input[type = \"checkbox\"], #filter").change(function(){
                    ajax();
                });

                ajax();
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
            <div class="content">
                <form method="post">
                    <div class="searchbar">
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
                    </div>
                </form>
                <div class="flex">
                    <form>
                        <div class="filters">
                            <br/><label for="manufacturer">Manufacturer:</label><br/>
                            <input type="text" id="manufacturer" name="manufacturer"><br/><br/>

                            <label for="lowprice">Price:</label><br/>
                            <input type="number" class="priceValue" id="lowprice" data-index="0" step="1"/>&euro;
                            <input type="number" class="priceValue" id="highprice" data-index="1" step="1" aria-labelledBy="highprice"/>&euro;<br/>

                            <label for="minweight">Weight:</label><br/>
                            <input type="number" class="weightValue" id="minweight" data-index="0" step="10"/>g
                            <input type="number" class="weightValue" id="maxweight" data-index="1" step="10" aria-labelledBy="maxweight"/>g<br/>

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
                            <input type="checkbox" name="drillbit" id="drillbit"><br/><br/>

                            <label for="mindiameter">Diameter:</label><br/>
                            <input type="number" class="diameterValue" id="mindiameter" data-index="0" step="1"/>mm
                            <input type="number" class="diameterValue" id="maxdiameter" data-index="1" step="1" aria-labelledBy="maxdiameter"/>mm<br/>

                            <label>Kit:</label><br/>

                            <label for="iskit" class="checkbox">Is a kit/set</label>
                            <input type="checkbox" name="iskit" id="iskit"><br/>

                            <label for="notkit" class="checkbox">Not a kit/set</label>
                            <input type="checkbox" name="notkit" id="notkit"><br/><br/>

                            <label>Resizable:</label><br/>

                            <label for="isresizable" class="checkbox">Is resizable</label>
                            <input type="checkbox" name="isresizable" id="isresizable"><br/>

                            <label for="notresizable" class="checkbox">Not resizable</label>
                            <input type="checkbox" name="notresizable" id="notresizable"><br/><br/>

                            <label>Electrical:</label><br/>

                            <label for="iselectrical" class="checkbox">Is electrical</label>
                            <input type="checkbox" name="iselectrical" id="iselectrical"><br/>

                            <label for="notelectrical" class="checkbox">Not electrical</label>
                            <input type="checkbox" name="notelectrical" id="notelectrical"><br/><br/>

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

                            <label for="squarehead" class="checkbox">Square</label>
                            <input type="checkbox" name="squarehead" id="squarehead"><br/>

                            <label for="pozidrivhead" class="checkbox">Pozidriv</label>
                            <input type="checkbox" name="pozidrivhead" id="pozidrivhead"><br/>

                            <label for="allenhead" class="checkbox">Allen</label>
                            <input type="checkbox" name="allenhead" id="allenhead"><br/>

                            <label for="clutchhead" class="checkbox">Clutch</label>
                            <input type="checkbox" name="clutchhead" id="clutchhead"><br/>

                            <label for="torxhead" class="checkbox">Torx</label>
                            <input type="checkbox" name="torxhead" id="torxhead"><br/>

                            <label for="spannerhead" class="checkbox">Spanner</label>
                            <input type="checkbox" name="spannerhead" id="spannerhead"><br/>

                            <label for="schraderhead" class="checkbox">Schrader</label>
                            <input type="checkbox" name="schraderhead" id="schraderhead"><br/>
                        </div>
                    </form>
                    <div id="products"></div>
                </div>
            </div>
            <footer>
                <a href="www.thomasmore.be">&copy;Thomas More</a>
            </footer>
        </div>
    </body>
</html>