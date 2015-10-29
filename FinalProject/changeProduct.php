<?php
require_once('config.php');
$con = mysql_connect($dbhost, $dbusername, $dbpassword);
if(!$con)
    die('could not connect: ' . mysql_error());
mysql_select_db($dbname, $con);
//echo '<pre>';
//print_r($_GET);
//print_r($_POST);
//echo '</pre>';
if(isset($_GET['request']))
{
	$pname = $_GET['pname'];
	$query = 'DELETE FROM Schneider.PRODUCT WHERE pname="'.$pname.'"';
	$result = mysql_query($query);
    //echo 'delete<br>';
}
else if(isset($_POST['update']))
{
	$pname = $_POST['update'];
	$pmult = $_POST['pmult'];
	$oldname = $_POST['pname'];
	$query = 'UPDATE Schneider.PRODUCT SET pname="'.$pname.'", pmult='.$pmult.' WHERE pname="'.$oldname.'"';
	$result = mysql_query($query);
    //echo 'update<br>';
}
else
{
	$pname = $_POST['insert'];
	$pmult = $_POST['pmult'];
	$query = 'INSERT INTO Schneider.PRODUCT VALUES("'.$pname.'",'.$pmult.')';
    $result = mysql_query($query);
    //echo 'insert<br>';
}

$url = './editValues.php';
if ($result)
    redirect($url);

function redirect($url){
    if (headers_sent()){
        die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
    }else{
        header('Location: ' . $url);
        die();
    }
}
?>