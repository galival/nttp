
<?php 
require 'header.php';
?>


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
</div><!--/main-->


  <script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
  <script src="js/main.js"></script>
</div><!-- footer -->

<?php
include 'footer.php';
?>

