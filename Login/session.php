<?php
   session_start();

   $bruker = $_SESSION['login_user'];
   
   if(!isset($_SESSION['login_user'])){
      header("location: ../rutiner.php");
   }

?>