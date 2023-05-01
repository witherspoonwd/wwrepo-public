<!DOCTYPE html>
<html>
<title>Extras - WILLWITHERSPOON.NET</title>

<link rel="stylesheet" href="site.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
  include "/var/wwrepo/off-site-modblocks/faviconcode.php";
?>

<script src="burger.js"></script>

<body>

    <?php
        include "/var/wwrepo/off-site-modblocks/logobox.php";
    ?>


    <div id="sublogobox">

        <div id="menuBar">
            <div id="menuBarSpacing"></div>

            <div id="menuBarButton">
                <a href="javascript:hideNavBox()"><img src="burgericon.png"></a>
            </div>
        </div>

        <?php
            include "/var/wwrepo/off-site-modblocks/navbox.php";
        ?>

        <div id="wholebodycontainer">

            <div id="titleBar">
                <h1>Extras</h1>
            </div>

            <div id="bodyboxcontainer">

                <div id="leftbodybox"></div>

                <div id="bodybox">


                    <div class="contentBox musicContainer">

                        <div class="cBoxLeft"></div>

                        <div class="cBoxCenter">

                            <table>
                                <thead>
                                <tr>
                                    <th class="table-header-date">Date</th>
                                    <th class="table-header-title">Title</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php

                                    require "/var/wwrepo/docs/php/dbhandler.php";
                                    $extrasIndex = new indexDBHandler("public_fragments");
                                    $extrasIndex->prepPublicFragmentsprint();

                                    if ($_GET["secretmode"] == 1){
                                    $extrasIndex->printHiddenIndex("/archive/fragments/");
                                    }
                                    else{
                                    $extrasIndex->printIndex("/archive/fragments/");
                                    }

                                ?>



                                </tbody>
                            </table>

                        </div>

                        <div class="cBoxRight"></div>

                    </div>

                </div>

                <div id="rightbodybox"></div>

            </div>

        </div>

    </div>



    <div id="footerbox">

        <div class="footerboxleft"></div>

        <div class="footerboxcenter footerboxtext">
            <div id="copyrightAndBingus">
                <p>
                    &copy; 2020 - <?php echo date("Y");?> Will Witherspoon. All rights reserved.
                </p>
            </div>

            <div id="bingusLink">
                <p>
                    <a href="/bingus/index.html">Click here for Bingus!</a>
                </p>
            </div>
        </div>

        <div class="footerboxright"></div>

    </div>
</body>

</html>
