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
        window.document.location = $(this).attr("href") + '?editid=' + $(this).attr("id");
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

        .table-striped tbody tr:nth-child(odd):hover td {
          background-color: #87D300;
        }
        .table-striped tbody tr:nth-child(even):hover td {
          background-color: #87D300;
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
            echo '<li class="active"><a href="./search.php">Search TAGS</a></li>';
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


  <h3 style="margin-left:25px;">Search Results</h3>

  <table class="table table-striped table-hover" id="table1">
    <thead>
      <tr>
        <th>Tag #</th>
        <th>Rev #</th>
        <th>Date</th>
        <th>Sub Category</th>
        <th>HVL</th>
        <th>HVL/CC</th>
        <th>Metal Clad</th>
        <th>MVMCC</th>
        <th>Notes</th>
        <th>Install Cost</th>
        <th>Price Notes</th>
        <th>Created By:</th>
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
          echo '<tr class="clickablerow table-hover" id="'.$rowID.'" href="https://cs.mtsu.edu/~dg3h/DBProj/search_view.php">';
          echo '<td>' . $_SESSION['tags'][$cnt]->TAGID . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->RevNum . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->Date . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->SubCatID . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->HVL . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->HVLCC . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->Metal_Clad . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->MVMCC . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->TAG_Notes . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->Install_Cost . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->Price_Notes . '</td>';
          echo '<td>' . $_SESSION['tags'][$cnt]->Person_Name . '</td>';
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>
</body>
</html>