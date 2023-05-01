<?php

  require "/var/wwrepo/docs/php/databaseconnector.php"; // get database connection

  // get embed code
  $stmt = $pdo->prepare("SELECT embedCode FROM public_videos WHERE isViewable=1 ORDER BY dateCreated DESC LIMIT 1");
  $stmt->execute();
  $embedArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
  $latestVideoEmbed = $embedArray[0];

  unset($stmt);

 ?>

<div class="contentBox videoContainer">

    <div class="cBoxLeft"></div>

    <div class="cBoxCenter">

        <div class="contentTitleHeader">
            <h1>Latest Video:</h1>
        </div>

        <div class="iframeWrapper">
            <iframe src="https://www.youtube.com/embed/<?php echo $latestVideoEmbed; ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

    <div class="cBoxRight"></div>

</div>
