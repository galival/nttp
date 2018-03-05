<?php

require_once ("header.php");

echo <<<EOT
		<div class="main" id="blogMain">
            
		    <div class="pageTitle" id="blogTitle"><p>$results[pageTitle]</p></div>
            

		    <div class="mainEntries">
		        <ul id="entryList">
EOT;


if ($results['entries']){

	foreach($results['entries'] as $entry){
      $date = date('F j, Y', $entry->created);
      //$entryLinks = $entry->getLinks($entry->id);//add getLinks function to Entry class
      $title = htmlspecialchars($entry->title);

      echo <<<EOT
      <li>
            <div class="entryHeader">
                  <h4><span><a href="blog.php?action=viewEntry&entry=$entry->id">$title</a></span></h4>
                  	<span class="publicationDate">$date</span>
            </div>
            <div class="entryExtraMaterial">
            </div>
            <div class="summaryBody">
                  $entry->summary
            </div>
            <div class="bottomBorder"></div>
      </li>

EOT;
	}
} else echo "no blog entries yet...";

echo <<<EOT
            </ul>
      </div>
  </div>
EOT;

require_once ("footer.php");
?>
