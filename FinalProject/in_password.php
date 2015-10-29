<?php
  require_once('config.php');
  $con = mysql_connect($dbhost, $dbusername, $dbpassword);
  if (!$con){
    die('could not connect: ' . mysql_error());
  }
  $user = $_SESSION['user'];
  mysql_select_db($dbname, $con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <title>Schneider Electric</title>
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./bootstrap/css/custom.css" rel="stylesheet">
  <script src="./js/jquery.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/font-awesome.min.css">
  <link rel="shortcut icon" href="./logo.ico">
  <style type="text/css">
    .pass-input{
      margin: 20px;
    }
    input.pass-in {
      font-size: 17.5px;
      padding: 11px 19px;
    }
    .btn-success{
      background-color: #009530;
    }
    
    .container{
      margin-left: 32%;
      margin-top: 22%;
    }
  </style>
</head>
<body>
<div class="container">
<div class="login-password">
    <form class="form-horizontal" action="login_pass.php" method="post">
        <div class="form-group">
            <label for="username" class="control-label col-xs-2">username</label>
            <div class="col-lg-2">
              <p class="form-control-static"><?php echo $user;?></p>
        	  </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">password</label>
            <div class="col-xs-2">
                <input type="password" class="form-control pass-in" name="passwordIN" placeholder="password" autofocus>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" class="btn btn-success">login</button>
            </div>
        </div>
    </form>
</div>
</div>
</body>
</html>