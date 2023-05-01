<?php 
      
      require "/var/wwrepo/docs/php/databaseconnector.php"; // get database connection
      require "/var/wwrepo/off-site-scripts/stringtruncation.php"; // get string trunicator function
      
      
      // get all required information to display the posts.

      $stmt = $pdo->prepare("SELECT postTitle FROM blog_posts WHERE isViewable=1 ORDER BY postDateTime DESC LIMIT 1");
      $stmt->execute();
      $titleArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
      $previewTitle = $titleArray[0];

      unset($stmt);

      $stmt = $pdo->prepare("SELECT postDateTime FROM blog_posts WHERE isViewable=1 ORDER BY postDateTime DESC LIMIT 1");
      $stmt->execute();
      $datesArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
      $daca = strtotime($datesArray[0]);
      $dacaTWO = date("m.d.y", $daca);
      $datesArray[0] = $dacaTWO;
      $previewDate = $datesArray[0];
      
      unset($stmt);
      
      $stmt = $pdo->prepare("SELECT postContent FROM blog_posts WHERE isViewable=1 ORDER BY postDateTime DESC LIMIT 1");
      $stmt->execute();
      $contentArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
      $tempContent = $contentArray[0];
      $text = strip_tags($tempContent);

      ////// delete new lines from the preview (pulled from stack overflow) //////
      // we don't want new lines in our preview
      $text_only_spaces = preg_replace('/\s+/', ' ', $text);
      // truncates the text
      $text_truncated = mb_substr($text_only_spaces, 0, mb_strpos($text_only_spaces, " ", 225));
      // prevents last word truncation
      $preview = trim(mb_substr($text_truncated, 0, mb_strrpos($text_truncated, " ")));
      //////////////////////////////////

      $previewContent = $preview . "...";
      
      unset($stmt);
      
      $stmt = $pdo->prepare("SELECT postID FROM blog_posts WHERE isViewable=1 ORDER BY postDateTime DESC LIMIT 1");
      $stmt->execute();
      $idArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
      $previewID = $idArray[0];
      
  ?>

<div class="contentBox blogPreviewContainer lastContentBox">
    <div class="cBoxLeft"></div>

    <div class="cBoxCenter">

        <div class="contentTitleHeader">
            <h1>Latest Blog Post:</h1>
        </div>

        <div class="blogPostContainer">
            <div class="blogPostHeader">
                <h1 class="blogPostTitle"><?php echo $previewTitle; ?></h1>
                <h1><?php echo $previewDate; ?></h1>
            </div>

            <div class="blogPostContent">
            <p>
                <?php echo $previewContent; ?>
            </p>
            <p class="blogPostFinalParagraph">
                <span class="nonColoredLink">
                    <a href="blog.php#<?php echo $previewID;?>">
                    Click here to see full post
                    </a>
                </span> 
            </p>
            </div>
        </div>

    </div>

    <div class="cBoxRight"></div>
</div>