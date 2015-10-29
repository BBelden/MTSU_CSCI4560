<?php
    require_once("config.php");
    $con = mysql_connect($dbhost, $dbusername, $dbpassword);
    if(!$con)
        die('could not connect: ' . mysql_error());
    mysql_select_db($dbname, $con);

    $identifier = $_GET['insertid'];

    //quote = 0 :: fo = 1
    if(isset($_POST['type_quote'])){
    	$type = 0;
    }
    else{
    	$type = 1;
    }
    
    $query = "INSERT INTO Schneider.APPLIED_FO VALUES('".$_POST['fo']."', '".$_POST['tag']."', '".$type."', '".$_POST['notes']."')";
	$result = mysql_query($query);
	header("location:editTag.php?editid=".$identifier);

?>