<?php
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

    <!--<script src="js/jquery.min.js"></script>-->
    <!-- Add jQuery library -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

    <!--main javascript-->
    <script type="text/javascript" src="/js/main.js"></script>
   
   <!-- <link href='https://fonts.googleapis.com/css?family=Metamorphous' rel='stylesheet' type='text/css'>   -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'> 
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="/images/sun.png">

     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
    <!--tinyMCE jQuery plugin-->
    <script type="text/javascript" src="/js/tinymce/jquery.tinymce.min.js"></script>
    <script type="text/javascript">
      tinyMCE.init({
        mode: 'textareas',
        selector: 'textarea',
        toolbar: 'image numlist bullist link',
        menubar: 'insert',
        plugins: 'image imagetools lists advlist link',
        file_browser_callback_types: 'file image media',
      });
     
    </script>

</head>

  
<body>
 
 <div >
    <a href="http://newtothepublic.com"><img class="header-image" id="header-image" src="images/logo17.jpg" alt="newtothepublic logo"tabindex="0"></a>
  </div>
 <div class="header">
    <ul class="top-nav">
      <li class=""><a href="http://newtothepublic.com"><h5>home</h5></a></li>
      <li class=""><a href="/about.php"><h5>about</h5></a></li>
       <!-- <li class=""><a href="/contact.php"><h5>contact</h5></a></li>-->
        <li class=""><a href="/blog.php"><h5>blog</h5></a></li>
    </ul>
    
</div><!--/header-->
