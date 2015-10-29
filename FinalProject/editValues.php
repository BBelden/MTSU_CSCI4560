<?php
    require_once("config.php");
    $con = mysql_connect($dbhost, $dbusername, $dbpassword);
    if(!$con)
        die('could not connect: ' . mysql_error());
    mysql_select_db($dbname, $con);
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
    <style type="text/css">
        html
        {
            height: 100%;
        }
        body
        {
            height: 100%;
        }
        a:link, a:visited, a:active
        {
            color: black;
        }

        a:hover
        {
            text-decoration: none;
            color: black;
        }
        .content
        {
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
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
              echo '<li class="active"><a href="./editValues.php">Edit Predefined</a></li>';
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
    <h2>Edit predefined values</h2>
    <?php
        if(isset($_GET['request']))
        {
            if($_GET['request']=='fail')
            {
                echo "<div class='alert alert-error'><h4>An error occurred with the request</h4>";
                echo "<span class='label label-important'>NOTICE</span> Ensure none of the fields were left empty</span></div>";
            }
            else if($_GET['request']=='success')
            {
                echo "<div class='alert alert-success'><h4>The change was successfully made</h4></div>";
            }
        }
    ?>
    <hr style="height: 3px; border-width: 0; background-color: #000000;">
    <div class="row">
    <div class="span3">
        <div class="alert alert-info"><h4 style="color:#000000">Complexity</h4></div>
            <table class="table table-condensed">
                <tr><th>Value</th><th></th><th>Update</th><th>Delete</th></tr>
                <?php
                    $query = 'SELECT * FROM Schneider.COMPLEXITY';
                    $result = mysql_query($query) or die("Query failed : " . mysql_error());
                    while($row = mysql_fetch_array($result))
                    {
                        echo "<form action='changeComplexity.php' method='post'><tr>";
                            echo "<td><input type='text' name='update' style='width:30px' value='".$row['value']."' ></td>";
                            echo "<td><input type='hidden' name='complexID' value='".$row['complexID']."'></td>";
                            echo "<td><button type='submit'>Update</a></td>";
                            echo "<td><button ><a href='changeComplexity.php?request=delete&complexID=".$row['complexID']." name='delete'>Delete</a></button></td>";
                        echo "</tr></form>";
                    }
                ?>
                <form action="changeComplexity.php" method="post">
                    <tr><td><input type='text' style="width:30px" name='insert'></td><td></td><td><button href type="submit">Add</button></td></tr>
                </form>
            </table>
        </div>
    <div class="span5">
    <div class="alert alert-info"><h4 style="color:#000000">Product Type and Multiplier</h4></div>
        <table class="table table-condensed">
            <tr><th>Product</th><th>Multiplier</th><th></th><th>Update</th><th>Delete</th></tr>
            <?php
                $query = 'SELECT * FROM Schneider.PRODUCT';
                $result = mysql_query($query);
                while($row = mysql_fetch_array($result))
                {
                    echo "<form action='changeProduct.php' method='post'><tr>";
                        echo "<td><input type='text' name='update' style='width:100px' value='".$row['pname']."' ></td>";
                        echo "<td><input type='text' name='pmult' style='width:60px' value='".$row['pmult']."'></td>";
                        echo "<td><input type='hidden' name='pname' value='".$row['pname']."'></td>";
                        echo "<td><button type='submit'>Update</a></td>";
                        echo "<td><button ><a href='changeProduct.php?request=delete&pname=".$row['pname']."' name='delete'>Delete</a></button></td>";
                    echo "</tr></form>";
                }
            ?>
            <form action="changeProduct.php" method="post">
                <tr><td><input type="text" name="insert" style="width:100px"></td><td><input type="text" name="pmult" style="width:60px"></td><td></td><td><button href type="submit">Add</button></td></tr>
            </form>
        </table>
    </div>
    <div class="span4">
        <div class="alert alert-info"><h4 style="color:#000000">Subcategory</h4></div>
            <table class="table table-condensed">
                <tr><th>Subcategory</th><th></th><th>Update</th><th>Delete</th></tr>
                <?php
                    $query = 'SELECT * FROM Schneider.SUB_CAT';
                    $result = mysql_query($query);
                    while($row = mysql_fetch_array($result))
                    {
                        echo "<form action='changeSubcat.php' method='post'><tr>";
                            echo "<td><input type='text' name='update' style='width:100px' value='".$row['value']."' ></td>";
                            echo "<td><input type='hidden' name='catID' value='".$row['catID']."'></td>";
                            echo "<td><button type='submit'>Update</a></td>";
                            echo "<td><button><a href='changeSubcat.php?request=delete&catID=".$row['catID']."' name='delete'>Delete</a></button></td>";
                        echo "</tr></form>";
                    }
                ?>
                <form action="changeSubcat.php" method="post">
                    <tr><td><input type="text" name="insert" style="width:100px"></td><td></td><td><button href type="submit">Add</button></td></tr>
                </form>
            </table>
        </div>
    </div>
    <div class="row">
        <?php
            $query = 'SELECT * FROM Schneider.HOURLY';
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
        ?>
        <hr style="height: 3px; border-width: 0; background-color: #000000;">
        <div class="span5">
        <div class="alert alert-info"><h4 style="color:#000000">Per Hour Charge</h4></div>
            <div class="row">
                <form action="changeHourly.php" method="post" class="form-inline">
                    <label style="margin-left:20px">Labor</label>
                    <div class="input-prepend" >
                        <span class="add-on" style="float:left;">$</span>
                        <input type="text" name="LabPrice" style="width:50px;" value="<?php echo $row['LabPrice']; ?>">
                    </div>
                    <label>Engineering</label>
                    <div class="input-prepend">
                        <span class="add-on" style="float:left;">$</span>
                        <input type="text" name="EngPrice" style="width:50px;" value="<?php echo $row['EngPrice']; ?>">
                    </div>
                    <button type="submit" >Update</button>
                </form>
            </div>
        </div>

        <?php
            $query = 'SELECT * FROM Schneider.COUNTRY WHERE cname="USA"';
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            $usa = $row['cmult'];
            $query = 'SELECT * FROM Schneider.COUNTRY WHERE cname="Canada"';
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            $canada = $row['cmult'];
            $query = 'SELECT * FROM Schneider.COUNTRY WHERE cname="Mexico"';
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            $mexico = $row['cmult'];
        ?>
        <div class="span6">
            <div class="alert alert-info"><h4 style="color:#000000">Multiplier by Country</h4></div>
                <div class="row">
                    <form action="changeCountry.php" method="post" class="form-inline">
                        <label style="margin-left:20px;">USA</label>
                        <input type="text" name="USA" style="width:50px; " value="<?php echo $usa; ?>">
                        <label >Canada</label>
                        <input type="text" name="Canada" style="width:50px;" value="<?php echo $canada; ?>">
                        <label >Mexico</label>
                        <input type="text" name="Mexico" style="width:50px;" value="<?php echo $mexico; ?>">
                        <button type="submit" >Update</button>
                    </form>
                </div>
            </div>
        </div>
        <hr style="height: 3px; border-width: 0; background-color: #000000;">
    </div>

</body>
</html>

