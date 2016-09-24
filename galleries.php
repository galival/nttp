
<?php
/*
include 'header.php';
include 'functions.php';
*/
?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="newtothepublic website">
    <meta name="author" content="newtothepublic">
    <title>new to the public</title>


   <!-- <script src="js/jquery.min.js"></script>-->
   	<!--jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   
    <!--fonts I'm not using anymore
    <link href='https://fonts.googleapis.com/css?family=Metamorphous' rel='stylesheet' type='text/css'>  
    -->

    <!--fonts in use--> 
    <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'> 

    <!--main style sheet-->
    <link href="css/style.css" rel="stylesheet">

    <!--fancybox for galleries-->
    <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

	<!--onload function for fancybox-->
	<script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox();
		});
	</script>


     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<head>

</head>

<body>
	<script language = "javascript" type = "text/javascript">
	
	//ajax call
		function send_request(id){

	//attempt request
			var ajax_request;
               
               try {
                  // Opera 8.0+, Firefox, Safari
                  ajax_request = new XMLHttpRequest();
               }

               catch (e) {
                  // Internet Explorer Browsers
                  try {
                     ajax_request = new ActiveXObject("Msxml2.XMLHTTP");
                  }
                  catch (e) {
                     try{
                        ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
                     }
                     catch (e){
                        // Something went wrong
                        alert("use a common browser");
                        return false;
                     }
                  }
				}

			ajax_request.onreadystatechange = function(){
              if(ajax_request.readyState == 4){
                 var data_display = document.getElementById('images');
                 data_display.innerHTML = ajax_request.responseText;
              }
            }

    //get .innerHTML from li clicked

    		var gallery = '';
    		gallery = id;
    		//var gallery = this.id;

           /*
           jQuery:

            var gallery = "";

			$("#gallery-menu li").on("click", function(){
				gallery = $(this).attr('id');
			});
			*/

    //send request		
           var query_string = "?gallery="+gallery;

            ajax_request.open("GET", "displayimages.php" + query_string, true);
            ajax_request.send(null); 

		}
	</script>

	<!--site header-->
	
	<div >
	    <a href="#"><span><img class="header-image" src="images/logo8.jpg"></span></a>
	  </div>
	 <div class="header">
	    <ul class="top-nav">
	      <li class=""><a href="http://newtothepublic.com/index.php"><h5>home</h5></a></li>
	      <li class="WIP"><a href="about.html"><h5>about</h5></a></li>
	        <li class=""><a href="contact.php"><h5>contact</h5></a></li>
	        <li class="WIP"><a href="blog.html"><h5>blog</h5></a></li>
	    </ul>
	 </div>

<!-- old header
	<header>
		<div class="header">

			<img> //background header image, width 100%

			<a href="#"><img class="nttp-logo"></a> //nttp loto, sitename, and link to home, left aligned
			<ul class="header-navigation"> // right aligned
				<li>about</li>
				<li>blog</li>
			</ul>
		</div>
	</header>
-->

<div class="main">

<div class="codes menu-border" id="galleries">
	<ul class="code-list" id="gallery-menu">
	<?php
		$servername = 'localhost\sqlexpress;Initial';
		$connection_options = array('Database'=>'newtothepublic', 'UID'=>'alina', 'PWD'=>'Dusminguet7!');
		$conn = sqlsrv_connect($hostname, $connection_options);


		if ($conn){}
		else {
		  die (print_r(sqlsrv_errors(), true));
		}


		/*get galleries*/
		$s = "GetGalleries";
		$q = sqlsrv_query($conn, $s);

		if ($q === false){
		  die(print_r(sqlsrv_errors(), true));
		}


		//loop through data

		while($o = sqlsrv_fetch_object($q)){
		  echo '<li onclick = send_request(this.id) id="'.$o->gallery.'">
		  		<span>'.$o->gallery.'</span>
		  	</li>
		  ';
		  }


		 //release for next call
		 sqlsrv_free_stmt($q);
	?>

	</ul>
	</div>
	
	<div class="body-content-lg" id="images">
	
		<h2>select a gallery</h2>

	</div>


</div> <!--/main-->


	<footer>
	    <div class="footer">
	       <p>new to the public &copy; 2013 - <?php echo date("Y");?> Alina Grigorovitch</p>
	    </div>

	    <!--
	      <script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
	      <script src="js/main.js"></script>
	    -->
	</footer>


	<script type="text/javascript">
		//get clicked gallery ID

		$("#gallery-menu").on("click", "li", function(){
			var galleryID = $(this).attr('id');
		});
			//pass galleryID to PHP
	</script>

</body>
</html>

