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
if(isset($_POST['USA']) && isset($_POST['Canada']) && isset($_POST['Mexico'])) //Update request
{
	$usaMult = $_POST['USA'];
	$canMult = $_POST['Canada'];
	$mexMult = $_POST['Mexico'];
	$query = 'UPDATE Schneider.COUNTRY SET cmult='.$usaMult.' WHERE cname="USA"';
	$result = mysql_query($query);
    $query = 'UPDATE Schneider.COUNTRY SET cmult='.$canMult.' WHERE cname="Canada"';
	$result = mysql_query($query);
    $query = 'UPDATE Schneider.COUNTRY SET cmult='.$mexMult.' WHERE cname="Mexico"';
	$result = mysql_query($query);
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