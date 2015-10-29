<?php 
  require_once('config.php');
  $con = mysql_connect($dbhost, $dbusername, $dbpassword);
  if (!$con){
  	die('could not connect: '.mysql_error());
  }
  mysql_select_db($dbname, $con);

  $uquery = "SELECT * FROM Schneider.USERNAME JOIN Schneider.PERSON ON Schneider.USERNAME.userID = Schneider.PERSON.id WHERE name = '".$_SESSION['user']."'";
  $result = mysql_query($uquery);
  if($row = mysql_fetch_assoc($result)){
   $newUser = new USER();
   $newUser->id = $row['id'];
   $newUser->fname = $row['fname'];
   $newUser->lname = $row['lname'];
   $newUser->admin = $row['Admin'];
   $newUser->oe = $row['OE'];
   $newUser->tagmbr = $row['TagMbr'];
   $newUser->user = $row['User'];

   $_SESSION['newuser'] = $newUser;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <title>Schneider Electric</title>
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="./js/jquery.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/font-awesome.min.css">
  <link rel="shortcut icon" href="./logo.ico">
  <style type="text/css">
  html,
  body {
  /*css for full size background image*/
    background: url(http://i.ytimg.com/vi/IXGp0zMioJ4/maxresdefault.jpg) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  
    height: 100%;
    background-color: #060;
    color: #fff;
    text-align: center;
    text-shadow: 0 1px 3px rgba(0,0,0,.5);
  }
  .site-wrapper {
    display: table;
    width: 100%;
    height: 100%; /* For at least Firefox */
    min-height: 100%;
    -webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
            box-shadow: inset 0 0 100px rgba(0,0,0,.5);
  }
  .cover-container {
    margin-right: auto;
    margin-left: auto;
  }
  .cover {
    padding: 0 20px;
  }
  .navbar .brand{
    padding-top: 8;
    padding-bottom: 0;
    padding-left: 8;
    padding-right: 8;
  }
  @media (min-width: 768px) {
    /* Start the vertical centering */
    .site-wrapper-inner {
      vertical-align: middle;
    }
    /* Handle the widths */
    .cover-container {
      width: 100%; /* Must be percentage or pixels for horizontal alignment */
    }
  }

  @media (min-width: 992px) {
    .cover-container {
      width: 700px;
    }
  }

  </style>
</head>
<body>
<div class="navbar navbar-static-top">
  <div class="navbar-inner">
      <a class="brand">
        <img style="max-width:80px;" src="./schneider-nav-logo.png">
      </a>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li class="active"><a href="./landing.php">Home</a></li>
          <?php
            echo '<li><a href="./search.php">Search TAGS</a></li>';
            if($_SESSION['newuser']->tagmbr == 1){
              echo '<li><a href="./insert.php">Insert TAGS</a></li>';
              //echo '<li><a href="./editTag.php">Edit TAGS</a></li>';
            }
            if($_SESSION['newuser']->admin == 1){
              echo '<li><a href="./editValues.php">Edit Predefined</a></li>';
              echo '<li><a href="./editUsersGroup.php">Edit Users/Groups</a></li>';
              echo '<li><a href="./security_db.php">Security Logs</a></li>';
            }
          ?>
        </ul>
        <div class="nav-collapse collapse pull-right">
          <ul class="nav">
            <li><a href="./logout.php">Logout</a></li>        
          </ul>
        </div>
      </div>
  </div>
</div>







<!--
<nav role="navigation" class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="./landing.php">Home</a></li>
                <?php/*
                  echo '<li><a href="./search.php" style="color:white;">Search TAGS</a></li>';
                  if($_SESSION['newuser']->tagmbr == 1){
                    echo '<li><a href="./insert.php" style="color:white;">Insert TAGS</a></li>';
                    echo '<li><a href="./editTag.php" style="color:white;">Edit TAGS</a></li>';
                  }
                  else if($_SESSION['newuser']->admin == 1){
                    echo '<li><a href="./editValues.php" style="color:white;">Edit Predefined</a></li>';
                    echo '<li><a href="./editUsersGroup.php" style="color:white;">Edit Users/Groups</a></li>';
                    echo '<li><a href="./security_db.php" style="color:white;">Security Logs</a></li>';
                  }*/
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="right"><a href="./logout.php" style="color:white; margin-right:0 auto;">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>-->

<div class="site-wrapper">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="inner cover">
      </div>
    </div>
</div>
</div>
</body>
</html>