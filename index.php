
<?php
/*
include '/../src/header.php';
include '/../src/functions.php';
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


    <script src="js/jquery.min.js"></script>
    <!--<script src="js/handlebars-v3.0.3.js"></script>-->
   
    <link href='https://fonts.googleapis.com/css?family=Metamorphous' rel='stylesheet' type='text/css'>   
    <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'> 
    <link href="css/style.css" rel="stylesheet">

     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

  
<body>
 
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

    <!--old list layout-->

      <!--<li id="site-name-link" class="left"><a href="#"><h2 class="site-name"></h2></a></li>-->
      <!--<li id="nav-links" class="top-nav-pos">
        <ul id="inner-top-nav" class="top-nav-pos">
          <li id="about" class="inner-top-nav-item wip"><a href="/about.html"><h2>about</h2></a></li>
          <li id="contact" class="inner-top-nav-item"><a href="contact.html"><h2>contact</h2></a></li>
         <!--<li id="blog" class="inner-top-nav-item wip"><a href="/blog.html"><h2>blog</h2></a></li>-->
      <!-- </ul>
      </li>
    </ul>-->

</div><!--/header-->


<!--

original site layout
--test to implement including image
-->

<div class="main">

        <div class="codes"> <!--id="left-block"-->
        <!--<div class="block-header" id="left-block-header"><h1>code</h1></div>-->
        <ul class="code-list">

        <?php 

        //establish connection
        $servername = 'localhost\sqlexpress;Initial';
        $connection_options = array('Database'=>'***', 'UID'=>'***', 'PWD'=>'***!');
        $conn = sqlsrv_connect($hostname, $connection_options);


        if ($conn){}
        else {
          die (print_r(sqlsrv_errors(), true));
        }

        //retrieve codes

        $s = "GetCodes";
        $q = sqlsrv_query($conn, $s);

        if ($q === false){
          die(print_r(sqlsrv_errors(), true));
        }


        //loop through data

        while($o = sqlsrv_fetch_object($q)){
          echo '<li><span class="'.$o->code_name.'"><u>'.$o->code_name.'</u></span></li>';
          }


        //unbind

        sqlsrv_free_stmt($q);

          ?>
          
</ul>
  </div><!--left block, body-block-->


  <div class="body-block" id="left-block">
      <div class="block-header" id="left-block-header"><h1>writing</h1></div>
        <!--<ul class="code-list">-->
        <ul class="block-nav" id="left-block-nav">

<?php


    $s = 'GetProjects writing';
    //$p = 'writing';
    //$params = array(&$p);
    /*
      ^ specify param type to append to sqlsrv_prepare. see sqlsrv documentation for specifics.
    */

    $q = sqlsrv_prepare($conn, $s);

    if( $q === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($q))
    {
      while($o = sqlsrv_fetch_object($q)){
          echo '<li>
            <span class="'.$o->codes.'">
              <u><a display="block" href="'.$o->project_link.'">'.$o->project_name.'<div class="element-2" display="block" width="100%"><img src="'.$o->image.'" alt="'.$o->alt.'" width="200px" max-height="50px">
                </div>
              </a></u>
            </span>
          </li>';
        }

    }
    else{
      die( print_r( sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($q);

    echo '</ul>
  </div><!--left block, body-block-->


  <div class="body-block" id="center-block">
      <div class="block-header" id="center-block-header"><h1>art</h1></div>
      <ul class="block-nav" id="center-block-nav">';

    //get art projects

    $s = 'GetProjects art';
    $q = sqlsrv_prepare($conn, $s);

    if( $q === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($q))
    {
      while($o = sqlsrv_fetch_object($q)){
          echo '<li>
            <span class="'.$o->codes.'">
              <u><a display="block" href="'.$o->project_link.'">'.$o->project_name.'<div class="element-2" display="block" width="100%"><img src="'.$o->image.'" alt="'.$o->alt.'" width="200px" max-height="50px">
                </div>
              </a></u>
            </span>
          </li>';
        }

    }
    else{
      die( print_r( sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($q);

       echo'</ul>
          </div><!--center-block-->

          <div class="body-block" id="right-block">
          <div class="block-header" id="right-block-header"><h1>miscellany</h1></div>
          <ul class="block-nav" id="right-block-nav">';

    
    //get misc projects

    $s = 'GetProjects';
    $q = sqlsrv_prepare($conn, $s);

    if( $q === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($q))
    {
      while($o = sqlsrv_fetch_object($q)){
          echo '<li>
            <span class="'.$o->codes.'">
              <u><a display="block" href="'.$o->project_link.'">'.$o->project_name.'<div class="element-2" display="block" width="100%"><img src="'.$o->image.'" alt="'.$o->alt.'" width="200px" max-height="50px">
                </div>
              </a></u>
            </span>
          </li>';
        }

    }
    else{
      die( print_r( sqlsrv_errors(), true));
    }


    sqlsrv_free_stmt($q);


    //close connection

    sqlsrv_close($conn);

    echo'</ul>
      </div><!--right-block-->
      </div><!--main-->';

  ?>


  <div class="footer" id="footer">
    <div class="footer-content">
      <p>new to the public &copy; 2013 - <?php echo date("Y");?> Alina Grigorovitch</p>
    </div>
  </div><!-- footer -->
  
</body>
</html>


<?php
/*
include '/../src/footer.php';
*/
?>


