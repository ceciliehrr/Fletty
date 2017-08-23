<?php
   session_start();

   if(session_destroy()) {
      header("Location: ../../rutiner.php");
   }
      session_unset();
   session_destroy();
?>