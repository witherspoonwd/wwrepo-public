<?php

$blogpostdivider = <<< EOT
<div class="postseperator">
        <!-- placeholder -->
      </div>
EOT;

$blogpostdivopener = "<div class=\"blogpost\" id=\"$currentpostid\">";


$blogpostheader = <<< EOT
<div class="postheader">
<h2>$currentposttitle
</h2>
<h2>$currentpostdate
</h2>
</div>
EOT;

//////////////////////NEWBLOG////////////////////////////////////

$contentBoxOpener = <<< EOT
<div class="contentBox blogPreviewContainer" id="$currentpostid">
<div class="cBoxLeft"></div>
<div class="cBoxCenter">

EOT;

$blogpostPreTitle = <<< EOT
<div class="blogPostContainer">
<div class="blogPostHeader">
<h1 class="blogPostTitle">
EOT;

$blogpostPreDate = <<< EOT
</h1>
<h1>
EOT;

$blogpostPreContent = <<< EOT
</h1>
</div>
<div class="blogPostContent">
EOT;

$blogpostFinalCloser = <<< EOT
</div>
</div>
</div>
<div class="cBoxRight"></div>
</div>
EOT;

$blogpostFinalParagraphTag = <<< OBAMA
<p class="blogPostFinalParagraph">
OBAMA;

$pcloser = "</p>";

$divcloser = "</div>";

?>