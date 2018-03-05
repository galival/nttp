<?php 
/*
list entries
newtothepublic.com/admin/listEntries.php
*/
require_once("/../func.php");
include_once("header.php");

if (isset($results['errorMessage'])){
		$errorMessage = $results['errorMessage'];
	}

if (isset($results['statusMessage'])){
		$statusMessage = $results['statusMessage'];
	}

echo <<<EOF

	<div class="main">
		<div class="pageTitle"><h3>$results[pageTitle]</h3></div>
		<div class="byline">
			<span><p>$results[totalRows]
		</p></span>
			<span><a href="admin.php?action=newEntry">add new entry</a></span>
		</div>
		<div class="errorMessage">$errorMessage</div>
		<div class="statusMessage">$statusMessage</div>
EOF;

if ($results['entries']){
	echo <<<EOF
		<div class="entriesTable">
			<table>
				<tr>
					<th>published date</th>
					<th>entry</th>
				</tr>
EOF;


	foreach ($results['entries'] as $entry){
		$date = date('j M Y', $entry->created);
		$title = htmlspecialchars($entry->title);

		$item = "<tr onclick=\"location='admin.php?action=editEntry&amp;entry=$entry->id'\">";
		$item .= "<td>$date</td><td>$title</td></tr>";

		echo $item;
	}

	echo "</table></div></div>";
} else echo "no entries";

include_once("footer.php");
?>