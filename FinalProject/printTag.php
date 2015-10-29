<?php
require_once('config.php');
$con = mysql_connect($dbhost, $dbusername, $dbpassword);
if(!$con)
    die('could not connect: ' . mysql_error());
mysql_select_db($dbname, $con);

$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Schneider Electric</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="./js/jquery.js"></script>
    <link rel="shortcut icon" href="./logo.ico">
    <style type="text/css">
        html{
            height: 100%;
        }
        body{
            height: 100%;
        }
    </style>
</head>
<body>
<?php

    $query = "SELECT cmult FROM Schneider.COUNTRY WHERE cname='USA'";
    $result = mysql_query($query); //or die("Query failed : " . mysql_error());
    $row = mysql_fetch_assoc($result);
    $USA_X = $row['cmult'];
    $query = "SELECT cmult FROM Schneider.COUNTRY WHERE cname='Canada'";
    $result = mysql_query($query); //or die("Query failed : " . mysql_error());
    $row = mysql_fetch_assoc($result);
    $Can_X = $row['cmult'];
    $query = "SELECT cmult FROM Schneider.COUNTRY WHERE cname='Mexico'";
    $result = mysql_query($query); //or die("Query failed : " . mysql_error());
    $row = mysql_fetch_assoc($result);
    $Mex_X = $row['cmult'];
    $query = "SELECT pmult FROM Schneider.PRODUCT WHERE pname='HVL'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);
    $HVL_X = $row['pmult'];
    $query = "SELECT pmult FROM Schneider.PRODUCT WHERE pname='HVL/CC'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);
    $HVLCC_X = $row['pmult'];
    $query = "SELECT pmult FROM Schneider.PRODUCT WHERE pname='Metal Clad'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);
    $MC_X = $row['pmult'];
    $query = "SELECT pmult FROM Schneider.PRODUCT WHERE pname='MVMCC'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);
    $MVMCC_X = $row['pmult'];
    $inst = $_SESSION['tags'][$id]->Install_Cost;

    echo '<img src="logo-schneider.png" alt="logo" title="logo" height="81" width="153"/>';
    echo '<h2>TAG DATA</h2>';
    date_default_timezone_set('America/Chicago');
    echo '<h4>Printed on '.date('m/d/Y h:i:sa').'<br>by '.$_SESSION['newuser']->fname.' '.$_SESSION['newuser']->lname.'</h4>';
    $tag = $_SESSION['tags'][$id]->TAGID;
    $rev = $_SESSION['tags'][$id]->RevNum;
    echo '<hr><br>';
    echo '<label style="margin-left:0px;">Tag Number: '.$_SESSION[''][$id]->TAGID.'</label><br>';
    echo '<label style="margin-left:0px;">Revision Number: '.$_SESSION['tags'][$id]->RevNum.'</label><br>';
    echo '<label style="margin-left:0px;">Date Created: '.$_SESSION['tags'][$id]->Date.'</label><br>';
    echo '<label style="margin-left:0px;">Subcategory: '.$_SESSION['tags'][$id]->SubCatID.'</label><br>';
    echo '<label style="margin-left:0px;">Complexity: '.$_SESSION['tags'][$id]->ComplexID.'</label><br>';
    echo '<label style="margin-left:0px;">Lead Time: '.$_SESSION['tags'][$id]->Lead_Time.'</label><br>';
    echo '<label style="margin-left:0px;">TAG Description: '.$_SESSION['tags'][$id]->TAG_Descr.'</label><br>';
    echo '<label style="margin-left:0px;">TAG Notes: '.$_SESSION['tags'][$id]->TAG_Notes.'</label><br>';
    echo '<label style="margin-left:0px;">Price Notes: '.$_SESSION['tags'][$id]->Price_Notes.'</label><br><br>';
    echo '<span class="label" style="margin-left:10px;">Pricing Information:</span><br>';
    echo '<label style="margin-left:0px;">Material: '.$_SESSION['tags'][$id]->Mat_Cost.'</label><br>';
    echo '<label style="margin-left:0px;">Labor: '.$_SESSION['tags'][$id]->Labor_Cost.'</label><br> ';
    echo '<label style="margin-left:0px;">Engineering: '.$_SESSION['tags'][$id]->Eng_Cost.'</label><br>';
    echo '<label style="margin-left:0px;">Install Cost: '.$inst.'</label><br>';


    echo '<table><col width="100"><col width="100"><col width="100"><col width="100">';
    echo '<tr><th>Product</th><th>USA</th><th>Canada</th><th>Mexico</th></tr>';

    if($_SESSION['tags'][$id]->HVL == "Yes")
    {
        echo '<tr><td align="center">HVL</td><td align="center">'.$inst * $USA_X * $HVL_X.'</td><td align="center">';
        echo $inst * $Can_X * $HVL_X.'</td><td align="center">'.$inst * $Mex_X * $HVL_X.'</td></tr><br>';
    }
    if($_SESSION['tags'][$id]->HVLCC == "Yes")
    {
        echo '<tr><td align="center">HVL/CC</td><td align="center">'.$inst * $USA_X * $HVLCC_X.'</td><td align="center">';
        echo $inst * $Can_X * $HVLCC_X.'</td><td align="center">'.$inst * $Mex_X * $HVLCC_X.'</td></tr><br>';
    }
    if($_SESSION['tags'][$id]->Metal_Clad == "Yes")
    {
        echo '<tr><td align="center">Metal Clad</td><td align="center">'.$inst * $USA_X * $MC_X.'</td><td align="center">';
        echo $inst * $Can_X * $MC_X.'</td><td align="center">'.$inst * $Mex_X * $MC_X.'</td></tr><br>';
    }
    if($_SESSION['tags'][$id]->MVMCC == "Yes")
    {
        echo '<tr><td align="center">MVMCC</td><td align="center">'.$inst * $USA_X * $MVMCC_X.'</td><td align="center">';
        echo $inst * $Can_X * $MVMCC_X.'</td><td align="center">'.$inst * $Mex_X * $MVMCC_X.'</td></tr><br>';
    }
    echo '</table><br><br>';

    echo '<label style="margin-left:0px;">Price Expires: '.$_SESSION['tags'][$id]->Price_Exp.'</label><br><br>';
    echo '<label style="margin-left:0px;">TAG Created By: '.$_SESSION['tags'][$id]->Person_Name.'</label><br><br>';