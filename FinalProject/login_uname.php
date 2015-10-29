<?php
  require_once('config.php');
  $con = mysql_connect($dbhost, $dbusername, $dbpassword);
  if(!$con){
    die('could not connect: ' . mysql_error());
  }

  mysql_select_db($dbname, $con);

  $uname = "'" . $_POST['username'] . "'";
  $today = date("Y-m-d H:i:s");
  $ip = $_SERVER['REMOTE_ADDR'];
  $host = gethostbyaddr($ip);

  $query = "SELECT * FROM Schneider.USERNAME WHERE name = $uname";
  $result = mysql_query($query);

  if (!$result){
    header("location:index.php");
  }
  else if($row = mysql_fetch_assoc($result)) {
    
    $_SESSION['user'] = $row['name'];
  
    if($today < $row['expires']){
      $query = "INSERT INTO Schneider.SECURITY VALUES ($uname, '$today', '$ip', '$host')";
      $result = mysql_query($query);
      header("location:landing.php");
    }
    else{
      header("location:in_password.php");
    }

  }
  else{
    header("location:index.php");
  }
?>