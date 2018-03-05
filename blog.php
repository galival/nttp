<?php
/*
blogmain.php 
--------------
main relay station for the blog.
*/

//require(CLASS_PATH . "/entry.php");
//require($CLASS_PATH . "/entry.php");
require ("/classes/entry.php");
require_once ("header.php");


$results = array();
$action = isset($_GET['action']) ? $_GET['action'] : "";

 
switch ($action){
    case 'archive':
        viewArchives();
        break;
    case 'viewEntry':
        viewEntry();
        break;
    default:
        blogHome();
}

 
function viewArchives(){
    $data = Entry::getEntryList();
    $results['entries'] = $data['entries'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "blog archive";

    require_once ("/blog/archives.php"); 
    //require_once(TEMPLATE_DIR . "/archives.php");
}

 

function viewEntry(){

      if (!isset($_GET['entry']) || !$_GET['entry']){
        blogHome();
        return;

      } else {
      	$data = Entry::getEntryById((int)$_GET['entry']);
        $results['entry'] = $data['entry'];
        $results['error'] = $data['error'];

        require_once ("/blog/post.php");
        //require_once(TEMPLATE_DIR . "/post.php");
      }
}
 
function blogHome(){
      $data = Entry::getEntryList();
      //$data = Entry::getNextPageEntryList();
      $results['entries'] = $data['entries'];
      $results['totalRows'] = $data['totalRows'];
      $results['pageTitle'] = "blog";

      require_once ("/blog/main.php");
      //require_once(TEMPLATE_DIR . "/main.php");
}

require_once ('footer.php');

?>