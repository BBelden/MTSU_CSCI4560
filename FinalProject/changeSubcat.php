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
    $catID = $_GET['catID'];
    $query = 'DELETE FROM Schneider.SUB_CAT WHERE catID="'.$catID.'"';
    $result = mysql_query($query);
    //echo 'delete<br>';
}
else if(isset($_POST['update']))
{
    $catID = $_POST['catID'];
    $value = $_POST['update'];
    $query = 'UPDATE Schneider.SUB_CAT SET value="'.$value.'" WHERE catID='.$catID;
    $result = mysql_query($query);
    //echo 'update<br>';
}
else
{
    $value = $_POST['insert'];
    $query = 'INSERT INTO Schneider.SUB_CAT (catID,value) VALUES (NULL,"'.$value.'")';
    $result = mysql_query($query);
    echo 'insert<br>';
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