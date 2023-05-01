<?php
    require "/var/wwrepo/docs/php/databaseconnector.php";

    //set the variables that are used to make the blocks!
    $opener = "<div class=\"videoPreviewContainer\"><a href=\"";
    $altOpener = "<div class=\"videoPreviewContainer lastVPC\"><a href=\"";
    //$CurrentVideoLink here
    $firstfollow = "\"><div class=\"linkHolder\"><div class=\"videoPreviewImgBox\"><img src=\"http://img.youtube.com/vi/";
    //$videoimgcode here
    $secondfollow = "/mqdefault.jpg\"></div><span class=\"videoPreviewTitle\"><p>";
    //$videotitle here
    $thirdfollow = "</p></span></div></a><p>";
    //$videoreleasedate here
    $finalfollow = "</p></div>";

    $stmt = $pdo->prepare("SELECT videoID FROM public_videos WHERE isViewable=1 ORDER BY dateCreated DESC");
    $stmt->execute();
    $IDArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

    unset($stmt);

    $stmt = $pdo->prepare("SELECT embedCode FROM public_videos WHERE isViewable=1 ORDER BY dateCreated DESC");
    $stmt->execute();
    $embedArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

    unset($stmt);

    $stmt = $pdo->prepare("SELECT videoTitle FROM public_videos WHERE isViewable=1 ORDER BY dateCreated DESC");
    $stmt->execute();
    $titleArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

    unset($stmt);

    $stmt = $pdo->prepare("SELECT dateCreated FROM public_videos WHERE isViewable=1 ORDER BY dateCreated DESC");
    $stmt->execute();
    $datesArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

    unset($stmt);

    $postCount = count($titleArray);

    for ($i = 0; $i < $postCount; $i++){
        $daca = strtotime($datesArray[$i]);
        $dacaTWO = date("m.d.y", $daca);
        $datesArray[$i] = $dacaTWO;
    }

    for ($i = 0; $i < $postCount; $i++){
        echo $opener;
        echo "https://www.youtube.com/watch?v=" . $embedArray[$i];
        echo $firstfollow;
        echo $embedArray[$i];
        echo $secondfollow;
        echo $titleArray[$i];
        echo $thirdfollow;
        echo $datesArray[$i];
        echo $finalfollow;
    }

?>
