<?php
require_once('config.php');
$con = mysql_connect($dbhost, $dbusername, $dbpassword);
if(!$con)
  die('could not connect: ' . mysql_error());
mysql_select_db($dbname, $con);

if(isset($_GET['request']))//Delete request
{
	$name = $_GET['name'];
	$query = 'DELETE FROM Schneider.GROUPS WHERE name="'.$name.'"';
	$result = mysql_query($query);
}
else
{
	$query = 'INSERT INTO GROUPS VALUES("'.$_POST['name'].'")';
	$result = mysql_query($query);	
}

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
}
?>