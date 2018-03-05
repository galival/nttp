<?php
/*
blog post template
*/
 require_once("/../func.php");
 require_once('header.php');

foreach($results['entry'] as $entry){
 	$title = htmlspecialchars($entry->title);
 	$date = date('j F Y', $entry->created);
 	$images = $entry->images;

 	echo <<<EOF
 	<div class="main blogMain">
	 	<div class="pageTitle" id="blogTitle"><p><a href="/blog.php">blog</a></p></div>
	 	<div class="pageTitle" id="postTitle"><p>$title</p></div>
	 	<div class="blogPost">
	 		<div class="blogPostDate">$date</div>
	 		<div class="blogPostContent">$entry->content</div>
	 	</div>
	 </div>
EOF;
}

 require_once('footer.php');
?>  