
<?php
require 'header.php';
require 'functions.php';

?>

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

<div class="main">

<div class="codes menu-border" id="galleries">
	<ul class="code-list" id="gallery-menu">

	
	<?php
		//connect to db 
        $conn = db_connect();


		if ($conn){

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
				}

		else {
		  die (print_r(sqlsrv_errors(), true));
		}


		
	?>

	</ul>
	</div>
	
	<div class="body-content-lg" id="images">
	
		<h2>select a gallery</h2>

	</div>


</div> <!--/main-->

	<script type="text/javascript">
		//get clicked gallery ID

		$("#gallery-menu").on("click", "li", function(){
			var galleryID = $(this).attr('id');
		});
			//pass galleryID to PHP
	</script>


<?php 
include 'footer.php';
?>