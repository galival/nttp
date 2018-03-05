
<?php

require_once ('header.php');
require_once ('conf.php');
require_once ('func.php');


echo '<div class="main">
    <!--<div class="pageTitle" id="indexTitle"><p>portfolio of Alina Grigorovitch</p></div>-->

        <div class="codes"> <!--id="left-block"-->
        <!--<div class="block-header" id="left-block-header"><h1>code</h1></div>-->
        <ul class="code-list">
          <!--<li><b>code...   </b></li>-->';
 
        $conn = db_connect();


        if ($conn){

          $s = "GetCodes";
          $q = sqlsrv_query($conn, $s);

          if ($q === false){
            die(print_r(sqlsrv_errors(), true));
        }


        while($code = sqlsrv_fetch_object($q)){
          echo '<li><span class="'.$code->code_name.'"><u>'.$code->code_name.'</u></span></li>';
          }


        sqlsrv_free_stmt($q);


        echo '</ul>
        </div>


        <div class="body-block" id="center-block">
              <ul class="block-nav" id="center-block-nav">';


        $s = 'GetAllProjects';
        
        $q = sqlsrv_prepare($conn, $s);

        if( $q === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($q))
        {
          while($o = sqlsrv_fetch_object($q)){
              /*
              echo '<li>
                <span class="'.$o->codes.'">
                  <u><a display="block" href="'.$o->project_link.'">'.$o->project_name.'<div class="element-2" display="block"><img src="'.$o->image.'" alt="'.$o->alt.'" width="200px" max-height="50px"/>
                    </div>
                  </a></u>
                </span>
              </li>';
              */

              echo '<li>
                  <div display="block" class="project ' . $o->codes . '">
                    <a href="' . $o->project_link . '">
                    <img src="' . $o->image . '" alt="' . $o->alt . '" width="200px" height="250px" style="object-fit: cover;"/>
                    </a>
                  </div>  
                </li>';
            }

        }
        else{
          die( print_r( sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($q);


        //close 

        sqlsrv_close($conn);

    
    //print remainder
      echo'</ul>
        </div><!--center-block-->
        </div><!--main-->';

   } //end if

    else {
      die (print_r(sqlsrv_errors(), true));

      echo'<p>There was an unexpected connection failure.</p>';

    }


include 'footer.php';

?>


