
<!--contact page for newtothepublic-->

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="newtothepublic website">
    <meta name="author" content="newtothepublic">

    <script src="js/jquery.min.js"></script>
   <!-- <script src="js/bootstrap.min.js"></script>-->
    <script src="js/handlebars-v3.0.3.js"></script>
   
    <link href='https://fonts.googleapis.com/css?family=Metamorphous' rel='stylesheet' type='text/css'>   
    <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'> 
    <link href="css/style.css" rel="stylesheet">

     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

  
<body>
 
 <div >
    <a href="#"><span><img class="header-image" src="images/logo8.jpg"></span></a>
  </div>
 <div class="header">
    <ul class="top-nav">
      <li class=""><a href="http://newtothepublic.com/index.php"><h5>home</h5></a></li>
      <li class="WIP"><a href="about.html"><h5>about</h5></a></li>
        <li class=""><a href="contact.html"><h5>contact</h5></a></li>
        <li class="WIP"><a href="blog.html"><h5>blog</h5></a></li>
    </ul>
      <!--<li id="site-name-link" class="left"><a href="#"><h2 class="site-name"></h2></a></li>-->
      <!--<li id="nav-links" class="top-nav-pos">
        <ul id="inner-top-nav" class="top-nav-pos">
          <li id="about" class="inner-top-nav-item wip"><a href="/about.html"><h2>about</h2></a></li>
          <li id="contact" class="inner-top-nav-item"><a href="contact.html"><h2>contact</h2></a></li>
         <!--<li id="blog" class="inner-top-nav-item wip"><a href="/blog.html"><h2>blog</h2></a></li>-->
      <!-- </ul>
      </li>
    </ul>-->
</div><!--/header-->



<div class="main-contact">

<div class="single-column contact">
<div class="block-header contact-header"><h4>get in touch</h4></div>
<fieldset>
<!--<legend><h2>get in touch</h2></legend>-->
<form id = "contactform" class="contact-form" action = "contactdat.php" method = "post"> <!--novalidate ignores all required attributes, for code testing-->
	<div>
	<label for="name">name</label>
	<input type = "text" id="name" name="name">
	</div>

	<div>
	<label for="email">email</label>
	<input type="email" id="email" name="email" placeholder="name1@thing.com" required>
	</div>

	<div>
	<label for="website">website</label>
	<input type="url" id="website" name="website">
	</div>

	<div>
	<label for="message">message</label>
	<textarea id="message" name="message" placeholder="type your message..."></textarea>
	</div>
	</form>

	<!--insert recaptcha-->
	<div class="touch">
	<span style="color:#469AB9;">[</span><button class="button" type="submit" form = "contactform" value="submit"><h4>touch</h4></button><span style="color:#5FD36E;">]</span>
	</div>
</fieldset>

</div><!--/single-column, /contact-form-->

<!--
<div class="body-block">
      <!--<div class="block-header" id="left-block-header"><h1>code</h1></div>
        <ul class="block-nav" id="block-nav-inline">
          <li><span class="new">new</span></li>
          <li><span class="fiction">fiction</span></li>
          <li><span class="nonfiction">nonfiction</span></li>
          <li><span class="art">art</span></li>
          <!--<li>novel</li>
          <li>novella</li>
          <li>short story</li>
          <li>poetry</li>
          <li><span class="magazine">magazine</span></li>
          <li><span class="organization"><u>organization</u><!--<div class="organization"></div></span></li>
          <li><span class="satire"><u><!--<div class="satire"></div>satire<u></span></li>
          <li><span class="surreal"><u><!--<div class="surreal"></div>surreal</u></span></li>
          <li><span class="wip">WIP</span></li>
          <li><span class="possibly">possibly</span></li>
        </ul>
  </div><!--left block, body-block-->
</div><!--/main-->


<div class="footer" id="footer">
  <div class="footer-content">
    <p>new to the public &copy; 2013 - <?php echo date("Y");?> Alina Grigorovitch</p>
  </div>


  <script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
  <script src="js/main.js"></script>
</div><!-- footer -->

</body>
</html>

