<?php 

    require "/var/wwrepo/docs/php/databaseconnector.php"; // get database connection

    // pull all required info from database.
    $stmt = $pdo->prepare("SELECT songTitle FROM public_songs WHERE isViewable=1 ORDER BY dateCreated DESC LIMIT 1");
    $stmt->execute();
    $titleArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $songTitle = $titleArray[0];

    unset($stmt);

    $stmt = $pdo->prepare("SELECT dateCreated FROM public_songs WHERE isViewable=1 ORDER BY dateCreated DESC LIMIT 1");
    $stmt->execute();
    $datesArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $daca = strtotime($datesArray[0]);
    $dacaTWO = date("m.d.y", $daca);
    $datesArray[0] = $dacaTWO;
    $songDate = $datesArray[0];
    
    unset($stmt);

    $stmt = $pdo->prepare("SELECT htmlPath FROM public_songs WHERE isViewable=1 ORDER BY dateCreated DESC LIMIT 1");
    $stmt->execute();
    $pathArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $songPath = $pathArray[0];

    unset($stmt); 



?>
<div class="contentBox musicContainer">
    <div class="cBoxLeft"></div>

    <div class="cBoxCenter">
        
        <div class="contentTitleHeader">
            <h1>Latest Song:</h1>
        </div>

        <div class="audiowrapper">

            <audio controls>
            <source src="/archive/content/musicfiles/<?php echo $songPath;?>" type="audio/mpeg">
                Epic fail bro! It doesn't work!!!!
            </audio>
        </div>

        <div class="contentSubtitleHeader">
            <p><?php echo $songTitle;?> - <?php echo $songDate;?></p>
        </div>

    </div>

    <div class="cBoxRight"></div>
</div>