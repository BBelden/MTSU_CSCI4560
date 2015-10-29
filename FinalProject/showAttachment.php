<?php

require_once('config.php');
$con = mysql_connect($dbhost, $dbusername, $dbpassword);
if(!$con)
    die('could not connect: ' . mysql_error());
mysql_select_db($dbname, $con);

$filename = $_GET['filename'];
$query = 'SELECT file, size, type FROM Schneider.ATTACHMENTS WHERE filename="'.$filename.'"';
$result = mysql_query($query);
list($file, $size, $type, $filename) = mysql_fetch_array($result);
header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: filename=$filename");
print $file;
?>