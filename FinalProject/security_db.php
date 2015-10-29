<?php
  require_once('config.php');
  $con = mysql_connect($dbhost, $dbusername, $dbpassword);
  if(!$con){
    die('could not connect: '.mysql_error());
  }
  mysql_select_db($dbname, $con);

  $cnt = -1;
  $_SESSION['sec_count'] = $cnt;
  $_SESSION['sec'] = array();

  $query = "SELECT * FROM Schneider.SECURITY ORDER BY datetime DESC";
  $result = mysql_query($query);
  if(!$result){
    //header("location:search_results.php");
  }
  else{
      $cnt = 0;
      while($row = mysql_fetch_assoc($result)){
        $sec = new SECURITY();
        $sec->user = $row['user'];
        $sec->dateTime = $row['datetime'];
        $sec->ip = $row['IP'];
        $sec->machineName = $row['machine_name'];

        $_SESSION['sec'][$cnt] = $sec;
        $cnt = $cnt+1;
      }
      $_SESSION['tags_count'] = $cnt-1;
      header("location:sec_logs.php");
  }
?>