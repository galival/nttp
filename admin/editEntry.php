<?php 
/*
template to add or edit entries

newtothepublic.com/admin/editEntry.php
*/
require_once("/../func.php");
include_once("header.php");

if (isset($results['errorMessage'])){
		$errorMessage = $results['errorMessage'];
	}

if (isset($results['statusMessage'])){
		$statusMessage = $results['statusMessage'];
	}	

if (count($results['entry']) == 1){

	$entry = current($results['entry']);

	$title = htmlspecialchars($entry->title);
	$summary = htmlspecialchars($entry->summary);
	$content = $entry->content;
	$date = date('j M Y', $entry->created);
	$id = $entry->id;

	echo <<<EOF

		<div class="main">
			<div class="pageTitle"><h3>$results[pageTitle] $title</h3></div>
			<div class="errorMessage">$errorMessage</div>
			<div class="statusMessage">$statusMessage</div>

			<form id="entryForm" action="admin.php?action=$results[formAction]&entry=$id" method="post">
				<input type="hidden" name="entry" id="entry" value="$id" >

				<label class="formLabel" for="title">Title </label>
				<input style="width:75%" type="text" name="title" id="title" placeholder="$title" required autofocus maxlength="255" value="$title" >
				</br>
		
				<label class="formLabel" for="summary">Summary </label>
				<textarea style="width:75%" name="summary" id="summary" maxlength="1000" cols="8" wrap="soft">$summary</textarea>
				</br>
		
				<label class="formLabel" for="content">Content </label>
				<textarea style="width:75%" name="content" id="content" maxlength="255" cols="25"  wrap="soft">$content</textarea>
				</br>

				<label class="images" for="tags">Tags </label>
				<input style="75%" type="text" name="tags" id="tags" placeholder="$tags" maxlength="255" value=$tags>
				</br>
		
				<label class="formLabel" for="created">Date Created </label>
				<input type="datetime" name="created" id="created" placeholder="$date" required maxlength="10" value="$date" >
				</br>

				<div class="formButtons">
					<input type="submit" name="saveChanges" value="Save Changes" >
					<input type="submit" formnovalidate name="cancel" value="Cancel" >
				</div>
			</form>
		</div>
EOF;

	if ($entry->id){
		echo '<div class="deleteEntryButton"><a href="admin.php?action=deleteEntry&amp;entry=' . $id .'" onclick=\"return confirm(\"Delete this entry?\")\">Delete Entry</a></div>';
	}

}



include_once("footer.php");

?>