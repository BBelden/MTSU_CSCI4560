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
if(isset($_POST['LabPrice']) && isset($_POST['EngPrice']))
{
    $LabPrice = $_POST['LabPrice'];
    $EngPrice = $_POST['EngPrice'];
    $query = 'UPDATE Schneider.HOURLY SET EngPrice="'.$EngPrice.'" ,LabPrice="'.$LabPrice.'"';
    $result = mysql_query($query);
    //echo 'update<br>';
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