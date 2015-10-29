<?php
require_once('config.php');
$con = mysql_connect($dbhost, $dbusername, $dbpassword);
if(!$con)
  die('could not connect: ' . mysql_error());
mysql_select_db($dbname, $con);

if(isset($_GET['request'])) //Delete request
{
    $name = $_GET['name'];
    $group = $_GET['group'];
    if($group == "Tag Member")
        $group = "TagMbr";
    $query = 'UPDATE Schneider.USERNAME SET '.$group.' = 0 where name = "'.$name.'"';
    $result = mysql_query($query);

    header("location:editUsersGroup.php");
}
else //Insert request
{
	$name = $_POST['name'];
	$group = $_POST['group'];
    if($group == "Tag Member")
        $group = "TagMbr";
	$query = 'UPDATE Schneider.USERNAME SET '.$group.' = 1 where name= "'.$name.'"';
    $result = mysql_query($query);
    //echo $_POST['group'];
    header("location:editUsersGroup.php");
}

/*
$url = './editUsersGroup.php';
if ($result)
    redirect($url);

function redirect($url){
    if (headers_sent()){
        die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
    }else{
        header("location:editUsersGroup.php");
        die();
    }
}*/
?>