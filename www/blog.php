<!DOCTYPE html>
<html>
<title>Blog - WILLWITHERSPOON.NET</title>

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
                <h1>Blog</h1>
            </div>

            <div id="bodyboxcontainer">

                <div id="leftbodybox"></div>

                <div id="bodybox">

                    <?php

                        function nl2p($string)
                        {
                            $paragraphs = '';

                            foreach (explode("\n", $string) as $line) {
                                if (trim($line)) {
                                    $paragraphs .= '<p>' . $line . '</p>';
                                }
                            }

                            return $paragraphs;
                        }

                        require "/var/wwrepo/docs/php/databaseconnector.php";

                        $stmt = $pdo->prepare("SELECT postTitle FROM blog_posts WHERE isViewable=1 ORDER BY postDateTime DESC");
                        $stmt->execute();
                        $titleArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        unset($stmt);

                        $stmt = $pdo->prepare("SELECT postDateTime FROM blog_posts WHERE isViewable=1 ORDER BY postDateTime DESC");
                        $stmt->execute();
                        $datesArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        unset($stmt);

                        $stmt = $pdo->prepare("SELECT postContent FROM blog_posts WHERE isViewable=1 ORDER BY postDateTime DESC");
                        $stmt->execute();
                        $contentArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        unset($stmt);

                        $stmt = $pdo->prepare("SELECT postID FROM blog_posts WHERE isViewable=1 ORDER BY postDateTime DESC");
                        $stmt->execute();
                        $idArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        $postCount = count($titleArray);

                        for ($i = 0; $i < $postCount; $i++){
                        $daca = strtotime($datesArray[$i]);
                        $dacaTWO = date("m.d.y", $daca);
                        $datesArray[$i] = $dacaTWO;
                        }


                        for ($i = 0; $i < $postCount; $i++){
                            $currentposttitle = $titleArray[$i];
                            $currentpostdate = $datesArray[$i];
                            $currentpostid = $idArray[$i];
                            $currentpostcontent = $contentArray[$i];

                            //check if le content needs tags
                            if (substr($currentpostcontent, 0,1) != "<") {
                                $needsTags = 1; //if no tags present, let program know tags need to be substituted
                            }

                            else {
                                $needsTags = 0;
                            }

                            include "/var/wwrepo/off-site-scripts/loadblogvariables.php";

                            echo $contentBoxOpener;
                            echo $blogpostPreTitle;
                            echo $currentposttitle;

                            echo $blogpostPreDate;
                            echo $currentpostdate;

                            echo $blogpostPreContent;

                            if ($needsTags == 1){
                                $currentpostcontent = nl2p($currentpostcontent);

                                $lasttag = strrpos($currentpostcontent, "<p>");

                                $currentpostcontent = substr_replace($currentpostcontent, "<p class=\"blogPostFinalParagraph\">", $lasttag, 3);

                                echo $currentpostcontent;

                            }

                            else {
                                echo $currentpostcontent;
                            }

                            echo $blogpostFinalCloser;
                        }

                    ?>

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
