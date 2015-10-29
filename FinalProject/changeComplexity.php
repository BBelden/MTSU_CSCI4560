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
    $complexID = $_GET['complexID'];
    $query = 'DELETE FROM Schneider.COMPLEXITY WHERE complexID="'.$complexID.'"';
    $result = mysql_query($query);
    //echo 'delete<br>';
}
else if(isset($_POST['update']))
{
    $value = $_POST['update'];
    $complexID = $_POST['complexID'];
    $query = 'UPDATE Schneider.COMPLEXITY SET value="'.$value.'" WHERE complexID='.$complexID;
    $result = mysql_query($query);
    //echo 'update<br>';
}
else
{
    $value = $_POST['insert'];
    $query = 'INSERT INTO Schneider.COMPLEXITY (value) VALUES ("'.$value.'")';
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