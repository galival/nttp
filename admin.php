<?php

//admin.php, wwwroot/admin.php
require("/classes/entry.php");

if (!isset($_SESSION['username'])){
      session_start();
}
$action = isset($_GET['action']) ? $_GET['action'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
if ($action != "login" && $action != "logout" && !$username){login(); //display login page
      exit();
}

switch ($action){
      case 'login':
            login();
            break;
      case 'logout':
            logout();
            break;
      case 'newEntry':
            newEntry();
            break;
      case 'editEntry':
            editEntry();
            break;
      case 'deleteEntry':
            deleteEntry();
            break;
      default:
            listEntries();
}


function login(){

      $results = array();
      $results['pageTitle'] = "Admin Login";

      if (isset($_POST['login'])){ //login form sent
            //if ($_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD){
            if ($_POST['username'] == 'username' && $_POST['password'] == 'password'){
                  //login successful. redirect to admin page.
                  $_SESSION['username'] = $_POST['username'];
                  //$_SESSION['username'] = ADMIN_USERNAME;
                  $_SESSION['username'] = 'avg';
                  header("Location: admin.php");
            } else {
                  //login unsuccessful. retry.
                  $results['errorMessage'] = "wrong username or password";
                  //require (TEMPLATE_PATH . "/admin/login.php");
                  //header("Location: admin.php?action=login");  
                  require("/admin/login.php");          }
      } else {
            //no login attempt yet made
            //require (TEMPLATE_PATH . "/admin/login.php");
            //header("Location: admin.php?action=login");
            require("/admin/login.php");
      }
}


function logout(){
      unset($_SESSION['username']);
      header("Location: admin.php");
}

function newEntry(){
      $results = array();
      $results['pageTitle'] = "new blog entry";
      $results['formAction'] = "newEntry";

      if (isset($_POST['saveChanges'])){
            //save new article
            $newEntry = new Entry;
            $newEntry->storeEntryValues($_POST);
            //$newEntry->storeEntryValues($_POST['formData']);
            
            $newEntry->insert();
            header("Location: admin.php?status=changesSaved");
      } elseif (isset($_POST['cancel'])){
            //cancel new entry
            header("Location: admin.php");
      } else {
            //no post, initially display creation form
            $results['entry'] = new Entry; //nothing in editEntry.php will be populated
            //require(TEMPLATE_PATH . "/admin/editEntry.php");
            require_once ("admin/editEntry.php");
            //unset($_GET['entry']);
      }
}

function editEntry(){
      $results = array();
      $results['pageTitle'] = "edit blog entry: ";
      $results['formAction'] = "editEntry";

      if (isset($_POST['saveChanges'])){
            /*
            $entry = Entry::getEntryById((int)$_POST['entry']);   
            if (!$entry){
                  header("Location: admin.php?error=entryNotFound");
                  return;
            }
            */
            $data = Entry::getEntryById($_GET['entry']);
            $entry = new Entry($data);
            $entry->storeEntryValues($_POST);
            $entry->update();
            header("Location: admin.php?status=changesSaved");
      } elseif (isset($_POST['cancel'])){
            header("Location: admin.php");
      } else {
            $data = Entry::getEntryById($_GET['entry']);
            if (!$results['entry']){
                  $results['entry'] =  $data['entry'];//object
                  $results['error'] = $data['error'];
            }
            //require(TEMPLATE_PATH . "/admin/editEntry.php");
            unset ($_GET['entry']);
            require ("admin/editEntry.php");
      }
}

function deleteEntry(){
      //$data = Entry::getEntryById((int)$_GET['entry']);
     Entry::delete($_GET['entry']);

     /*
     if (!$entry = new Entry($data->id)){
      header("Location: admin.php?error=entryNotFound");
     } else {
            $entry->delete();
      }      
      //require ("admin.php");
      */
      listEntries();
}

 

function listEntries(){
      $results = array();
      $data = Entry::getEntryList();
      $results['entries'] = $data['entries'];
      $results['totalRows'] = $data['totalRows'];
      $results['pageTitle'] = "all blog entries";

      if(isset($_GET['error'])){
            if ($_GET['error'] == "entryNotFound"){
                  $results['errorMessage'] = "Error: entry not found";
            } else {
                  $results['errorMessage'] = "Unknown error";
            }
      }

      if(isset($_GET['status'])){
            if($_GET['status'] == "changesSaved"){
                  $results['statusMessage'] = "changes to entry saved.";
            }
            if ($_GET['status'] == "entryDeleted"){
                  $ersults['statusMessage'] = "entry deleted.";
            }
      }
      //require(TEMPLATE_PATH . "/admin/listEntries.php");
      unset($_GET['action']);
      require("admin/listEntries.php");
}
?>