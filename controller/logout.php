<?php
   if (!session_id()) session_start();
   
   if(session_destroy()) {
      header("Location: ../index.php");
   }

   if (!session_id()) session_start();

   $_SESSION['loggedin']=false;
?>