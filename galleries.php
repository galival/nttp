
<?php
require_once 'header.php';
require_once 'conf.php';
require_once 'func.php';
require_once 'js/galleries.js';

?>

	<script language = "javascript" type = "text/javascript">
	
		function send_request(id){
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
                        alert("request not supported by this browser.");
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
        $conn = db_connect();


		if ($conn){
			$s = "GetGalleries";
			$q = sqlsrv_query($conn, $s);

				if ($q === false){
				  die(print_r(sqlsrv_errors(), true));
				}

				while($o = sqlsrv_fetch_object($q)){
				  echo '<li onclick = send_request(this.id) id="'.$o->gallery.'">
				  		<span class="gallery-selection">'.$o->gallery.'</span>
				  	</li>
				  ';
				  }

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