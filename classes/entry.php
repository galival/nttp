<?php
/*blog entry class*/

class Entry {
	public $id;
	public $created;
	public $title;
	public $tags;
	public $summary;
	public $content;
	public $images;
	//public $links;

	//called when pulled from db
	public function __construct($data = array()){
		$this->id = $data->id;
		$this->created = $data->created;
		$this->title = $data->title;
		$this->summary = $data->summary;
		$this->content = $data->content;
		$this->tags = $data->tags;
		$this->images = $data->images;
	}

	
	//called when entry created from admin
	public function storeEntryValues($data){
		//$this->__construct($data);
		$this->title = $data['title'];
		$this->summary = $data['summary'];
		$this->content = $data['content'];
		$this->tags = $data['tags'];
		$this->images = $data['images'];

		$date = new DateTime($data['created']);
		$timestamp = $date->getTimestamp();
		$this->created = $timestamp;
		
		/* old method to convert date to unix timestamp
		if ($created){
			$created = explode('-', $created);
		}

		//convert m-d-y date to unix timestamp
		if (count($created) == 3){
			list($y, $m, $d) = $created;
			$this->created = mktime(0,0,0, $m, $d, $y);
		}
		*/
	}


	/*
	for displaying entries
	*/

	public static function getEntryById($id){
		$results = array();

		$servername = 'localhost\sqlexpress;Initial';
		$connection_options = array('Database'=>'database', 'UID'=>'uid', 'PWD'=>'pwd');
		
		$conn = sqlsrv_connect($hostname, $connection_options);

		if ($conn){
			
			$sql = "SELECT * FROM entries WHERE id = $id";
			$query = sqlsrv_query($conn, $sql);

			if( $query === false ) {
            	die( print_r( sqlsrv_errors(), true));
        	}

        	while ($row = sqlsrv_fetch_object($query)){
        		$entry = new Entry($row);
        		$results['entry'][] = $entry;
        	}
      		
      		if (!count($results) == 1)
      			$results['error'] = "There is no entry here...";
      	}

      	sqlsrv_free_stmt($query);
      	sqlsrv_close($conn);

      	return $results;
	}


	public static function getEntryByTitle($title){
		$selectedId = "";
		$title = htmlspecialchars($title);

		if ($title){
			$selectedId = getIdFromTitle($title);	
		} else {
			$results['errorMessage'] = "No entry with this title: " . $title;
		}

		$results['entry'] = getEntryById($selectedId); 

		return $results;
	}

	public static function getNextPageEntryList($page=1, $limit=10, $orderBy = "created DESC"){
		$count = 0;
		$list = array();
		$conn = db_connect(); //from functions.php
		$offset = 10*($page-1); 

		$sql = "SELECT *, DATEDIFF(s, '1970-01-01 00:00:00', created) FROM entries ORDER BY $orderBy OFFSET $offset FETCH NEXT $limit ROWS ONLY";
		$query = sqlsrv_query($conn, $sql);

		if( $query === false ) {
            die( print_r( sqlsrv_errors(), true));
        } else {
        	$count = sqlsrv_num_rows($query);
        }

      	if ($count){
        	while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
        		$entry = new Entry($row);
        		$list[] = $entry;
        	}
      	}

      	return array('entries' => $list, 'totalRows' => $count);

	}

	public static function getEntryList($orderBy = "id DESC"){
		$result = array();

		$conn = db_connect();

		if ($conn){

			$sql = "SELECT * FROM entries ORDER BY $orderBy";
			$query = sqlsrv_query($conn, $sql);

			if( $query === false ) {
	            die( print_r( sqlsrv_errors(), true));
	        }
	      	
	        while ($row = sqlsrv_fetch_object($query)){
	        	$entry = new Entry($row);
	        	$result['entries'][] = $entry;
	        }
	      	
	    } 

	    $result['totalRows'] = sqlsrv_num_rows($query);

      	sqlsrv_free_stmt($query);
      	sqlsrv_close($conn);

      	return $result;
	}

	/*
	for admin usage only
	*/

	public function insert(){
		//if entry already has id
		/*
		if (!($this->$id)){
			trigger_error("Entry::insert(): attempting to insert entry object that already has id set to " . $this->id, E_USER_ERROR);
		}*/

		//insert
		$conn = db_connect();

		if ($conn){
			$sql = "INSERT INTO entries (created, title, summary, content, images, tags) VALUES (?, ?, ?, ?, ?, ?)";
			$params = array($this->created, $this->title, $this->summary, $this->content, $this->images, $this->tags);

			if (!sqlsrv_query($conn, $sql, $params)) {
				die (print_r( sqlsrv_errors(), true));
			}
		}

		sqlsrv_free_stmt($query);
		sqlsrv_close($conn);


	}

	public function update(){

		//if entry does not have id
		/*
		if (!($this->$id)){
			trigger_error("Entry::update(): attempting to update entry object that does not have id property set", E_USER_ERROR);
		}
		*/

		//update
		$conn = db_connect();

		/*
		if ($conn){

			$sql = "UPDATE entries SET ";

			if ($this->created){$sql .= "created = ". $this->created . ", ";}
			if ($this->title){$sql .= "title = '" . $this->title . "', ";}
			if ($this->summary){$sql .= "summary = '" . $this->summary . "', ";}
			if ($this->content){$sql .= "content = '" . $this->content . "', ";}
			if ($this->images){$sql .= "images = " . $this->images . ", ";}
			if ($this->tags){$sql .= "tags = '" . $this->tags . "', ";}
			
			$sql = rtrim($sql, ", ");

			$sql .= " WHERE id = " . $_GET['entry'];

			if (!sqlsrv_query($conn, $sql/*, $params*//*)){
				die (print_r( sqlsrv_errors() . $sql, true));
			}
		}
		*/

		if ($conn){

			$sql = "UPDATE entries SET created = ?, title = ?, summary = ?, content = ?, images = ?, tags = ?  WHERE id = " . $_GET['entry'];


			$created = $this->created;
			$title = $this->title;
			$summary = $this->summary;
			$content = $this->content;
			$images = $this->images;
			$tags = $this->tags;
			
			$stmt = sqlsrv_prepare($conn, $sql, array(&$created, &$title, &$summary, &$content, &$images, &$tags));

			if (!$stmt){
				die(print_r(sqlsrv_errors(), true));
			}

			if (sqlsrv_execute($stmt) === false){
				die(print_r(sqlsrv_errors(), true));
			}
		}

		sqlsrv_free_stmt($query);
		sqlsrv_close($conn);
	}

	public static function delete($id){
		//if entry does not have id
		/*
		if (!($this->$id)){
			trigger_error("Entry::delete(): attempting to delete entry object that does not have id property set", E_USER_ERROR);
		}
		*/

		//delete
		$conn = db_connect();

		if ($conn){
			$sql = "DELETE FROM entries WHERE id = ".$id;
			$query = sqlsrv_query($conn, $sql);

			if (!sqlsrv_query($conn, $sql)){
				die (print_r( sqlsrv_errors(), true));
			}
		}

		sqlsrv_free_stmt($query);
		sqlsrv_close($conn);		
	}


//helper functions

	public function getEntryByDate($date){
		$count = 0;
		$conn = db_connect(); //from functions.php
		$dateNum = "";

		if ($date){
			$dateNum = (getTimestamp($date)) ? getTimestamp($date) : $date;
		} else {
			$dateNum = date_timestamp_get(); //correct function?
		}

		$sql = "SELECT * FROM entries WHERE created = " . $date;
		$query = sqlsrv_query($conn, $sql);

		if( $query === false ) {
            die( print_r( sqlsrv_errors(), true));
        } else {
        	$count = sqlsrv_num_rows($query);
        }

      	if ($count == 1){
        	while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
        		sqlsrv_close($conn);
        		return new Entry($row);
        	}
      	}

	}

	public static function getIdFromTitle($title){
		$count = 0;
		$conn = db_connect(); //from functions.php

		$sql = "SELECT id FROM entries WHERE title = " . stripslashes($title);
		$query = sqlsrv_query($conn, $sql);

		if( $query === false ) {
            die( print_r( sqlsrv_errors(), true));
        } else {
        	$count = sqlsrv_num_rows($query);
        }

	    if ($count == 1){
	        while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
	        	sqlsrv_close($conn);
	        	return $row['id'];
	        }
	    } else {
	    	return null;
	    }
		
	}

	public static function getTimestamp($date){
		$oldDate = explode('-', $date);

		if (count($oldDate) == 3){
			list($y, $m, $d) = $oldDate;
			$newDate = mktime(0,0,0, $m, $d, $y);
			return $newDate;
		} else {
			return null;
		}
	}

}


?>
