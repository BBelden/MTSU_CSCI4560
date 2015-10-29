<?php
  require_once('config.php');
 
//DO I NEED ANY OF THIS HERE??
  $con = mysql_connect($dbhost, $dbusername, $dbpassword);
  if (!$con){ 
    die('could not connect: ' . mysql_error());
  }

  mysql_select_db($dbname, $con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <link rel="shortcut icon" href="./logo.ico">
  <title>Schneider Electric</title>
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./bootstrap/css/custom.css" rel="stylesheet">
  <script src="./js/jquery.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/font-awesome.min.css">
  

  <style>
  .form-inline{
    text-align: center;
    margin-right: 0 auto;
    margin-left: 0 auto;
    margin-top: 25%;
  }
  .btn-success{
    background-color: #009530;
  }
  </style>
</head>
<body>
  <form class="form-inline" role="form" action="login_uname.php" method="post">
    <div class="form-group">
        <label class="uname-label" for="inputUserName">username</label>
        <input type="username" class="form-control" name="username" placeholder="username" autofocus>
        <button type="submit" class="btn btn-success">login</button>
    </div>
  </form>
</body>
</html>