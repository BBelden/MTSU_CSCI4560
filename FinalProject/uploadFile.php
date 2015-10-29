<?php

require_once('config.php');
$con = mysql_connect($dbhost, $dbusername, $dbpassword);
if(!$con)
    die('could not connect: ' . mysql_error());
mysql_select_db($dbname, $con);
//echo '<pre>';
//print_r($_POST);
//print_r($_SESSION);
//print_r($_FILES);
//echo '</pre>';

if ($_FILES['file']['error'] > 0)
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
else
{
    $file = fopen($_FILES['file']['tmp_name'], 'rb');
    $fileData = fread($file, $_FILES['file']['size']);
    $fileData = mysql_real_escape_string($fileData);
}
$tag = $_POST['TAGID'];
$filename = $_FILES['file']['name'];
$size = intval($_FILES['file']['size']);
$type = $_FILES['file']['type'];
$query = "INSERT INTO Schneider.ATTACHMENTS VALUES (NULL,".$tag.", '".$_FILES['file']['name']."', '".$fileData."', ".$_FILES['file']['size'].", '".$_FILES['file']['type']."')";
//echo $tag.'<br>';
//echo $filename.'<br>';
//echo $fileData.'<br>';
//echo $size.'<br>';
//echo $type.'<br>';
//echo $query.'<br>';
$result = mysql_query($query);

if(!$result)
	//header('location:./editTag.php?editid='.$_GET['upid']);
  	header('Location:'.$_SERVER['HTTP_REFERER'].'?attach=fail');
else
	header('Location:'.$_SERVER['HTTP_REFERER']);
?>