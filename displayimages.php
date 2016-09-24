<?php
/*displayimages.php 

calls db and displays images based on element passed
*/

//establish db connection
	$servername = 'localhost\sqlexpress;Initial';
	$connection_options = array('Database'=>'***', 'UID'=>'***', 'PWD'=>'***');
	$conn = sqlsrv_connect($hostname, $connection_options);


	if ($conn){}
	else {
		die (print_r(sqlsrv_errors(), true));
	}


//retrieve data sent
	$gallery = $_GET['gallery'];


//query db to get images
	$s = 'GetImages \''.$gallery.'\'';
    $q = sqlsrv_query($conn, $s);

    if ($q === false){
      die(print_r(sqlsrv_errors(), true));
    }


//declare result string
    $results = '';

//loop through data and append to results

    while($o = sqlsrv_fetch_object($q)){

    	$results .= '<div class="small-img"> ';
        $results .= '<a class="fancybox" rel="group" href="'.$o->filename.'" title="'.$o->description.'">';
    	$results .= '<img src="'.$o->filename.'" alt = "'.$o->alt.'">';
        $results .= '<br>';
    	$results .= '<h5>'.$o->title.'</h5>';
    	$results .= '</a>';
    	$results .= '</div> 

    	';
      }

    echo $results;

?>

