<?php
  require_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Schneider Electric</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="shortcut icon" href="./logo.ico">
    <script>
    jQuery(document).ready(function($){
      $(".clickablerow").click(function(){
        window.document.location = $(this).attr("href") + '?id=' + $(this).attr("id");
      });
    });
    </script>

    <style type="text/css">
        html{
        height: 100%;
        }
        body{
        height: 100%;
        /*background: url( "./images/low_contrast_linen.png") repeat scroll 0 0 transparent;*/
        }
        a:hover i{
        text-decoration: none;
        }
        .content{
        background-color: #FAFAFA;
        background-image: linear-gradient(to bottom, #FFFFFF, #F2F2F2);
        background-repeat: repeat-x;
        border: 1px solid #D4D4D4;
        border-radius: 4px;
        margin: 0px 0px 0px 0px;
        padding: 10px;
        box-shadow: 2px 2px 5px #888888;
        }
        .navbar .brand{
          padding-top: 8;
          padding-bottom: 0;
          padding-left: 8;
          padding-right: 8;
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
          <li><a href="./landing.php">Home</a></li>
          <?php
            echo '<li><a href="./search.php">Search TAGS</a></li>';
            if($_SESSION['newuser']->tagmbr == 1){
              echo '<li><a href="./insert.php">Insert TAGS</a></li>';
              //echo '<li><a href="./editTag.php">Edit TAGS</a></li>';
            }
            if($_SESSION['newuser']->admin == 1){
              echo '<li><a href="./editValues.php">Edit Predefined</a></li>';
              echo '<li><a href="./editUsersGroup.php">Edit Users/Groups</a></li>';
              echo '<li class="active"><a href="./security_db.php">Security Logs</a></li>';
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


  <h3 style="margin-left:25px;">Security Logs</h3>

  <table class="table table-striped table-hover" id="table1">
    <thead>
      <tr>
        <th>User Name</th>
        <th>Login Date</th>
        <th>IP</th>
        <th>Machine Name</th>
      </tr>
    </thead>

    <tbody>
      <?php
        if($_SESSION['tags_count'] == -1){
          echo '<div class="alert">';
          echo '<button type="button" class="close" data-dismiss="alert"></button>';
          echo '<strong>Warning!</strong> Best check yo self, youre not looking too good.</div>';
        }

        for($cnt = 0; $cnt <= $_SESSION['tags_count']; $cnt++){
          $rowID = $cnt;
          echo '<td>' . $_SESSION['sec'][$cnt]->user . '</td>';
          echo '<td>' . $_SESSION['sec'][$cnt]->dateTime . '</td>';
          echo '<td>' . $_SESSION['sec'][$cnt]->ip . '</td>';
          echo '<td>' . $_SESSION['sec'][$cnt]->machineName . '</td>';
          echo '<tr>';
        }
      ?>
    </tbody>
  </table>
</body>
</html>