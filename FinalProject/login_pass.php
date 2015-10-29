<?php
  require_once('config.php');
  $con = mysql_connect($dbhost, $dbusername, $dbpassword);
  if(!$con){
    die('could not connect: ' . mysql_error());
  }

  mysql_select_db($dbname, $con);

  $uname = "'" . $_SESSION['user'] . "'";
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
    //need to add permisions
  
    if($_POST['passwordIN'] == $row['password']){
      $var = date("Y-m-d H:i:s", strtotime("+3 months"));
      $query1 = "INSERT INTO Schneider.SECURITY VALUES ($uname, '$today', '$ip', '$host')";
      $result = mysql_query($query1);
      $query = "UPDATE Schneider.USERNAME SET expires = '$var' where name = $uname";
      $result = mysql_query($query);
      header("location:landing.php");
    }
    else{
      header("location:luname.php");
    }
  }
  else{
    header("location:index.php");
  }
?>