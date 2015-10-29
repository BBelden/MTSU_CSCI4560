<?php
    require_once('config.php');
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
              echo '<li><a href="./editValues.php">Edit Predefined</a></li>';
              echo '<li class="active"><a href="./editUsersGroup.php">Edit Users/Groups</a></li>';
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
        <h2>User/Group Maintenance Page</h2>
        <hr style="height: 3px; border-width: 0; background-color: #000000;">
        <div class="alert alert-info"><h4 style="color:#000000;">Users</h4></div>
        <h4>Create A New User</h4>
        <form class="form-inline" action="addUser.php" method="post">
            <label>First Name</label>
            <input type="text" placeholder="" style="width:100px;" name="fname">
            <label>Last Name</label>
            <input type="text" placeholder="" style="width:100px;" name="lname">
            <label>User Name</label>
            <input type="text" placeholder="" style="width:100px;" name="name">
            <label>Password</label>
            <input type="password" placeholder="" style="width:100px;" name="password">
            <button  style="margin-left:10px" type="submit">Add User</button>
        </form>
        <h4>Add User to Group</h4>
        <form class="form-inline" action="changeUserGroup.php" method="post">
            <label>User ID</label>
            <?php
            $query= "Select name from Schneider.USERNAME";
            $result =  mysql_query($query);
            echo "<select name='name' id='name'>";
            while ($select_query_array=   mysql_fetch_array($result) )
                echo "<option>".htmlspecialchars($select_query_array["name"])."</option>";
                echo "</select>";
            ?>
            <label>Group Name</label>
            <?php
            $query= "Select name from Schneider.GROUPS";
            $result =  mysql_query($query);
            echo "<select name='group' id='group'>";
            while ($select_query_array=   mysql_fetch_array($result) )
                echo "<option>".htmlspecialchars($select_query_array["name"])."</option>";
                echo "</select>";
            ?>
            <button style="margin-left:10px" type="submit">Update User</button>
        </form>
        <h4>Delete User From Group</h4>
        <?php
        $query = "SELECT * FROM Schneider.USERNAME JOIN Schneider.PERSON on Schneider.USERNAME.userID = Schneider.PERSON.id";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        echo "<table class='table table-condensed'>
                <tr>
                    <th>User Name</th>
                    <th>Group</th>
                    <th>Delete</th>
                </tr>";
        $i = 1;
        while($row = mysql_fetch_array($result))
        {
            if ($row['Admin']==1)
            {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>Admin</td>";
                $admin = 'Admin';
                echo '<td><button><a href="changeUserGroup.php?request=delete&name='.$row['name'].'&group='.$admin.'"  style="color:black;" name="delete"><font color="black">Delete</font></a></button></td>';
                echo "</tr>";
                $i++;
            }
            if ($row['OE']==1)
            {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>OE</td>";
                $oe = 'OE';
                echo '<td><button><a href="changeUserGroup.php?request=delete&name='.$row['name'].'&group='.$oe.'"  style="color:black;" name="delete"><font color="black">Delete</font></a></button></td>';
                echo "</tr>";
                $i++;
            }
            if ($row['TagMbr']==1)
            {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>Tag Member</td>";
                $tagmbr = 'TagMbr';
                echo '<td><button><a href="changeUserGroup.php?request=delete&name='.$row['name'].'&group='.$tagmbr.'" style="color:black;" name="delete"><font color="black">Delete</font></a></button></td>';
                echo "</tr>";
                $i++;
            }
            if ($row['User']==1)
            {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>User</td>";
                $user = 'User';
                echo '<td><button><a href="changeUserGroup.php?request=delete&name='.$row['name'].'&group='.$user.'" style="color:black;" name="delete"><font color="black">Delete</font></a></button></td>';
                echo "</tr>";
                $i++;
            }
        }
        echo "</table>";
        ?>
        <hr style="height: 3px; border-width: 0; background-color: #000000;">
        <div class="alert alert-info"><h4 style="color:#000000;">Groups</h4></div>
        <h4>Create A New Group</h4>
        <form class="form-inline" action="changeGroup.php" method="post">
            <label>Group Name</label>
            <input type="text" placeholder="" style="width:100px;" name="groupName">
            <button style="margin-left:10px" type="submit">Add Group</button>
        </form>
        <h4>Delete A Group</h4>
        <?php
        $query = "SELECT * FROM Schneider.GROUPS";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        echo "<table class='table table-condensed'>
                <tr>
                    <th>Group Name</th>
                    <th>Delete</th>
                </tr>";
        $i = 1;
        while($row = mysql_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td><button><a href='changeGroup.php?request=delete&id=".$row['name']." name='delete'><font color='black'>Delete</font></a></button></td>";
            echo "</tr>";
            $i++;
        }
        echo "</table>";
        ?>
        <hr style="height: 3px; border-width: 0; background-color: #000000;">
    </div>
</body>
</html>
  