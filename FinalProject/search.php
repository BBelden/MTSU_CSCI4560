<?php
  require_once('config.php');

 //DO I NEED ANY OF THIS HERE??
  $con = mysql_connect($dbhost, $dbusername, $dbpassword);
  if(!$con){
    die('could not connect:'.mysql_error());
  }

  mysql_select_db($dbname, $con);

//maybe try and add in some buttons for certain boxs below
//that make you chose from set values 
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



  <div class="hero-unit">
    <h2>Search Tags</h2>

    <hr style="background-color: #000000;">
    <div class="row">
    <div class="span11">
      <form class="form-inline" role="form" action="search_db.php" method="post" style="margin-left:20px;" >
        <label style="margin-left:0px;">Tag Number</label>
        <label style="margin-left:10px;">Rev#</label>
        <label style="margin-left:15px;">Date</label>
        <label style="margin-left:70px;">Subcategory</label>
        <label style="margin-left:50px;">Lead Time</label>
        <label style="margin-left:10px;">HVL</label>
        <label style="margin-left:10px;">HVL/CC</label>
        <label style="margin-left:10px;">Metal Clad</label>
        <label style="margin-left:10px;">MVMCC</label>
        <label style="margin-left:10px;">Obsolete</label>
        <br/>
        <input type="text" placeholder="" style="margin-left:0px; width:64px;"  name="tagNumber" value="">
        <input type="text" placeholder="" style="margin-left:10px; width:24px;" name="revision" value="">
        <input type="text" placeholder="" style="margin-left:10px; width:75px;"  name="date" value="">
        <select style="width:120px; margin-left:10px;" name="subcategory">
          <?php
            $query = "SELECT * FROM Schneider.SUB_CAT";
            $result = mysql_query($query);
            echo '<option value="none">---</option>';
            if($result){
              while($row = mysql_fetch_assoc($result))
                echo '<option value="' . $row['catID'] . '">' . $row['value'] . '</option>';
            }
          ?>
        </select>


        <input type="text" placeholder="" style="margin-left:10px; width:60px;" name="LeadTime" value="">
        <input type="checkbox" name="hvl" style="margin-left:15px;" id="HVL">
        <input type="checkbox" name="hvlcc" style="margin-left:35px;" id="HVLCC">
        <input type="checkbox" name="metal_clad" style="margin-left:55px;" id="Metal_Clad">
        <input type="checkbox" name="mvmcc" style="margin-left:55px;" id="MVMCC">
        <input type="checkbox" name="obsolete" style="margin-left:20px;" id="obsolete">

        <br>
        <label style="margin-left:0px;">TAG Description:</label><br>
        <textarea style="width:450px;" name="description" rows="1"></textarea>
        <br>
        <label style="margin-left:0px;">TAG Notes:</label><br>
        <textarea style="width:470px;" name="notes" rows="1"></textarea>
        <br>
        <label style="margin-left:0px;">Price Notes:</label><br>
        <textarea style="width:470px;" name="price_note" rows="1"></textarea>
        <br>

        <label style="margin-left:10px;">Install Cost:</label>
        <div class="input-prepend" style="margin-left:21px;">
        <span class="add-on" style="float:left;">$</span>
        <input type="text" id="Install" placeholder="" style="width:100px; float:right;" name="install_cost" value="">
        </div> 
        <br>
        <label class="pull-left" style="margin-left:10px;">Created By:</label>
        <div class="pull-left" style="margin-left:26px;">
        <span class="add-on" style="float:left;"></span>
        <input type="text" id="Person" placeholder="" style="width:127px; float:right;" name="created_by" value="">
        </div>
        <br>
        <br>




        <!--<div class="form-group">
          <label for="tagNumber">tag#</label>
          <label for="revision">revision</label>
          <label for="date">date</label>
          <label for="description">description</label>

        <br />

        <input type="text" name="tagNumber" placeholder="tag number">
        <input type="text" name="revision" placeholder="revision">
        <input type="text" name="date" placeholder="date">
        <input type="text" name="description" placeholder="description">

        <br />-->

        <!--<label for="subcategory">sub-category</label>
        <label for="complexity">complexity</label>
        <label for="hvl">hvl</label>
        <label for="hvl/cc">hvl/cc</label>
        <label for="metal_clad">metal clad</label>
        <label for="mvmcc">mvmcc</label>
        
        <br />
        
        <select style="width:120px;" name="subcategory">
          <?php/*
            $query = "SELECT * FROM Schneider.SUB_CAT";
            $result = mysql_query($query);
            echo '<option value="none">---</option>';
            if($result){
              while($row = mysql_fetch_assoc($result))
                echo '<option value="' . $row['catID'] . '">' . $row['value'] . '</option>';
            }*/
          ?>
        </select>

        <select style="width:75px; margin-left:20px;" name="complexity">
          <?php/*
            $query = "SELECT * FROM Schneider.COMPLEXITY";
            $result = mysql_query($query);
            if($result){
              echo '<option value="none">---</option>';
              while($row = mysql_fetch_assoc($result))
                echo '<option value="' . $row['complexID'] . '">' . $row['value'] . '</option>';
            }
          */?>
        </select>-->

        <!--<input type="checkbox" style="margin-left:10px;" name="hvl" placeholder="hvl">
        <input type="checkbox" style="margin-left:10px;" name="hvlcc" placeholder="hvl/cc">
        <input type="checkbox" style="margin-left:10px;" name="metal_clad" placeholder="metal clad">
        <input type="checkbox" style="margin-left:10px;" name="mvmcc" placeholder="mvmcc">    

        <br />

        <label for="special">special items</label>
        <label for="notes">notes</label>
        <label for="install_cost">install cost</label>
        <label for="price_note">price note</label>
        <label for="created_by">created by:</label>
        
        <br />
        
        <input type="text" name="special" placeholder="special items">
        <input type="text" name="notes" placeholder="notes">
        <input type="text" name="install_cost" placeholder="install cost">
        <input type="text" name="price_note" placeholder="price note">
        <input type="text" name="created_by" placeholder="created by">
      </div>-->

      <button type="submit">Search</button>
    </form>
</body>
</html>  