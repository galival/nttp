<?php
/*
archives.php
-- URL: newtothepublic.com/blog/archives.php
*/

	$s = ($results['totalRows'] == 1) ? 'entries' : 'entry';

	echo <<<EOT
		<div class="main">
			<div class="pageTitle"><h3>$results[pageTitle]</h3></div>
			<div class="byline"><p>
				$results[totalRows] 
			</p></div>
			<div class="buttons">
				<ul class="buttonsList">
					<li><a href="./">home</a></li>	
				</ul>
			</div>
				<ul id="headlines" class="archiveList">
EOT;

foreach ($results['entries'] as $entry){

	$date = date('j F', $entry->created);
    $title = htmlspecialchars($entry->title);

	echo <<<EOT
		<li>
			<div class="entryInfo">
				<h4><span class="publicationDate">$date</span>
					<span><a href="blog.php?action=viewEntry&entry=$entry->id">$title</a></span></h4>
			</div>
		</li>
EOT;
}

?>