
<?php

require 'header.php';
require 'functions.php';


//print beginning of main
echo '<div class="main">

        <div class="codes"> <!--id="left-block"-->
        <!--<div class="block-header" id="left-block-header"><h1>code</h1></div>-->
        <ul class="code-list">';

        //connect to db 
        $conn = db_connect();


        if ($conn){

        //do all the stuff:

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


        //print left header
        echo '</ul>
        </div><!--left block, body-block-->


        <div class="body-block" id="left-block">
            <div class="block-header" id="left-block-header"><h1>writing</h1></div>
              <!--<ul class="code-list">-->
              <ul class="block-nav" id="left-block-nav">';



        //get data under left header:

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

      
      //print middle header      
        echo '</ul>
          </div><!--left block, body-block-->


          <div class="body-block" id="center-block">
              <div class="block-header" id="center-block-header"><h1>art</h1></div>
              <ul class="block-nav" id="center-block-nav">';

        //get middle header data

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


        //print right header
       echo'</ul>
          </div><!--center-block-->

          <div class="body-block" id="right-block">
          <div class="block-header" id="right-block-header"><h1>miscellany</h1></div>
          <ul class="block-nav" id="right-block-nav">';

        
        //get right header data

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

    
    //print remainder
      echo'</ul>
        </div><!--right-block-->
        </div><!--main-->';

   } //end if

    else {
      die (print_r(sqlsrv_errors(), true));

      //hardcode some data in case of connection failure

    }


include 'footer.php';

?>


