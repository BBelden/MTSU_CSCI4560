<?php
require_once('config.php');
$con = mysql_connect($dbhost, $dbusername, $dbpassword);
if(!$con)
    die('could not connect: ' . mysql_error());

mysql_select_db($dbname, $con);

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$query = 'INSERT INTO Schneider.PERSON values (NULL,"'.$fname.'","'.$lname.'")';
$result = mysql_query($query);

$query = 'SELECT id from Schneider.PERSON where fname ="'.$fname.'" and lname="'.$lname.'"';
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$id = $row['id'];

$user = $_POST['name'];
$password = $_POST['password'];
$query = 'INSERT INTO Schneider.USERNAME values ("'.$user.'",'.$id.',"'.$password.'",0000-00-00,0,0,0,0)';
$result = mysql_query($query);

$url = './editUsersGroup.php';

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