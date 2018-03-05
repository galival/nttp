<?php

//connect to db

function db_connect() {
	$servername = 'localhost\sqlexpress;Initial';
	$connection_options = array('Database'=>'database', 'UID'=>'uid', 'PWD'=>'pwd');

	/*
	//config variables
	$servername = DB_DSN;
	$connection_options = array(
		'Database' => DB_NAME,
		'UID' => DB_UID,
		'PWD' => DB_PW
	);
	*/
	
	
	$conn = sqlsrv_connect($hostname, $connection_options);

	
	if ($conn){
		return $conn;
	}
	else {
		die (print_r(sqlsrv_errors(), true));
	}
}


//open file
function open_file($f){

	$file = fopen($f, "r") or die("Unable to open file");
	
	//read by bytesize = size of input file
	echo fread($file,filesize($f));

	//loop through lines while not at end of file
	while(!foef($file)){

		$line = fgets($file);
		$char = fgetc($file);
		//more processing
	}

	fclose($file);
}

	//loop through XML data
	//$data = //db query as xml

	function display_images ($data){
		foreach($data->children() as $image) {
	    //display data using html template
	    echo $books->title . ", ";
	    echo $books->author . ", ";
	    echo $books->year . ", ";
	    echo $books->price . "<br>";
	}
	

} 


function allowed_get_params($allowed_params=array()){
	$allowed = array();
	foreach ($allowed_params as $param){
		if (isset($_GET['param'])){
			$allowed[$param] = $_GET[$param];
		} else {
			$allowed[$param] = null;
		}
	}
	return $allowed;
}
?> 

