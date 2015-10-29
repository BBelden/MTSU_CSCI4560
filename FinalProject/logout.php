<?php
  require('config.php');
  
  session_destroy();
  //session_unset();
  header("Location: index.php");
  die("Redirecting to: index.php");
?>
