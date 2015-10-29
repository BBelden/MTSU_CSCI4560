<?php
    require_once('config.php');

    $con = mysql_connect($dbhost, $dbusername, $dbpassword);
    if(!$con)
        die('could not connect: ' . mysql_error());
    mysql_select_db($dbname, $con);

    $id = $_SESSION['newuser']->id;
    $query = 'SELECT * from Schneider.PERSON WHERE id='.$id;
    $result = mysql_query($query);
    while ($row = mysql_fetch_assoc($result)){
        $fname = $row['fname'];
        $lname = $row['lname'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Schneider Electric</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="shortcut icon" href="./logo.ico">
    
    <script type="text/javascript">
        $(function()
        {
            $("#MatCost, #LabCost, #EngCost,#EngHours,#LabHours").change(function()
            {
                var engMult =
                    <?php
                        $query = "SELECT * from Schneider.HOURLY";
                        $result = mysql_query($query);
                        $row = mysql_fetch_assoc($result);
                        echo $row['EngPrice'];
                     ?>;
                var engTtl = parseFloat($("#EngHours").val()) * engMult;
                $("#EngCost").val(engTtl.toFixed(2));

                var labMult =
                    <?php
                        $query = "SELECT * from Schneider.HOURLY";
                        $result = mysql_query($query);
                        $row = mysql_fetch_assoc($result);
                        echo $row['LabPrice'];
                     ?>;
                var labTtl = parseFloat($("#LabHours").val()) * labMult;
                $("#LabCost").val(labTtl.toFixed(2));

                var mat = parseFloat($("#MatCost").val());
                $("#MatCost").val(mat.toFixed(2));

                var ttl = parseFloat($("#MatCost").val()) + parseFloat($("#LabCost").val()) + parseFloat($("#EngCost").val());
                $("#InstallCost").val(ttl.toFixed(2));
                var USA_X =
                    <?php
                        $query = "SELECT cmult FROM Schneider.COUNTRY WHERE cname='USA'";
                        $result = mysql_query($query); //or die("Query failed : " . mysql_error());
                        $row = mysql_fetch_assoc($result);
                        echo $row['cmult'];
                    ?>;
                var Can_X =
                    <?php
                        $query = "SELECT cmult FROM Schneider.COUNTRY WHERE cname='Canada'";
                        $result = mysql_query($query); //or die("Query failed : " . mysql_error());
                        $row = mysql_fetch_assoc($result);
                        echo $row['cmult'];
                    ?>;
                var Mex_X =
                    <?php
                        $query = "SELECT cmult FROM Schneider.COUNTRY WHERE cname='Mexico'";
                        $result = mysql_query($query); //or die("Query failed : " . mysql_error());
                        $row = mysql_fetch_assoc($result);
                        echo $row['cmult'];
                    ?>;
                var HVL_X =
                    <?php
                        $query = "SELECT pmult FROM Schneider.PRODUCT WHERE pname='HVL'";
                        $result = mysql_query($query);
                        $row = mysql_fetch_assoc($result);
                        echo $row['pmult'];
                    ?>;
                var HVLCC_X =
                    <?php
                        $query = "SELECT pmult FROM Schneider.PRODUCT WHERE pname='HVL/CC'";
                        $result = mysql_query($query);
                        $row = mysql_fetch_assoc($result);
                        echo $row['pmult'];
                     ?>;
                var MetalClad_X =
                    <?php
                        $query = "SELECT pmult FROM Schneider.PRODUCT WHERE pname='Metal Clad'";
                        $result = mysql_query($query);
                        $row = mysql_fetch_assoc($result);
                        echo $row['pmult'];
                    ?>;
                var MVMCC_X =
                    <?php
                        $query = "SELECT pmult FROM Schneider.PRODUCT WHERE pname='MVMCC'";
                        $result = mysql_query($query);
                        $row = mysql_fetch_assoc($result);
                        echo $row['pmult'];
                    ?>;
                var install = parseFloat($("#InstallCost").val()).toFixed(2);

                $("#HVL-USA").val((USA_X*HVL_X*install).toFixed(2));
                $("#HVL-CANADA").val((Can_X*HVL_X*install).toFixed(2));
                $("#HVL-MEXICO").val((Mex_X*HVL_X*install).toFixed(2));
                $("#HVLCC-USA").val((USA_X*HVLCC_X*install).toFixed(2));
                $("#HVLCC-CANADA").val((Can_X*HVLCC_X*install).toFixed(2));
                $("#HVLCC-MEXICO").val((Mex_X*HVLCC_X*install).toFixed(2));
                $("#METALCLAD-USA").val((USA_X*MetalClad_X*install).toFixed(2));
                $("#METALCLAD-CANADA").val((Can_X*MetalClad_X*install).toFixed(2));
                $("#METALCLAD-MEXICO").val((Mex_X*MetalClad_X*install).toFixed(2));
                $("#MVMCC-USA").val((USA_X*MVMCC_X*install).toFixed(2));
                $("#MVMCC-CANADA").val((Can_X*MVMCC_X*install).toFixed(2));
                $("#MVMCC-MEXICO").val((Mex_X*MVMCC_X*install).toFixed(2));
            });
        });
    </script>
    <style type="text/css">
        html
        {
            height: 100%;
        }

        body
        {
            height: 100%;
            /*background: url( "./images/low_contrast_linen.png") repeat scroll 0 0 transparent;*/
        }

        a:hover i
        {
            text-decoration: none;
        }

        .content
        {
            background-color: #FAFAFA;
            background-image: linear-gradient(to bottom, #FFFFFF, #F2F2F2);
            background-repeat: repeat-x;
            border: 1px solid #D4D4D4;
            border-radius: 4px;
            margin: 0px 0px 0px 0px;
            padding: 10px;
            box-shadow: 2px 2px 5px #888888;
        }
        .navbar .brand{
            padding-top: 8;
            padding-bottom: 0;
            padding-left: 8;
            padding-right: 8;
        }
    </style>
</head> 


<body>
<div class="navbar navbar-static-top">
  <div class="navbar-inner">
      <a class="brand">
        <img style="max-width:80px;" src="./schneider-nav-logo.png">
      </a>
      </a>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li><a href="./landing.php">Home</a></li>
          <?php
            echo '<li><a href="./search.php">Search TAGS</a></li>';
            if($_SESSION['newuser']->tagmbr == 1){
              echo '<li class="active"><a href="./insert.php">Insert TAGS</a></li>';
              //echo '<li><a href="./editTag.php">Edit TAGS</a></li>';
            }
            if($_SESSION['newuser']->admin == 1){
              echo '<li><a href="./editValues.php">Edit Predefined</a></li>';
              echo '<li><a href="./editUsersGroup.php">Edit Users/Groups</a></li>';
              echo '<li><a href="./security_db.php">Security Logs</a></li>';
            }
          ?>
        </ul>
        <div class="nav-collapse collapse pull-right">
          <ul class="nav">
            <li><a href="./logout.php">Logout</a></li>        
          </ul>
        </div>
      </div>
  </div>
</div>


<div class="hero-unit">
    <h2>Insert New TAG</h2>

    <?php


        $query = "SELECT MAX(TAGID) as tag FROM Schneider.TAGS";
        $result = mysql_query($query);
        if(!$result)
            echo mysql_error();
        else{
            $row = mysql_fetch_assoc($result);
            $nextTag = $row['tag']+1;
        }
        $query = "SELECT MAX(FOno) as FO FROM Schneider.APPLIED_FO";
        $result = mysql_query($query);
        if(!$result)
            echo mysql_error();
        else{
            $row = mysql_fetch_assoc($result);
            $nextFO = $row['FO']+1;
        }
        $query = "SELECT MAX(Quote) as quote FROM Schneider.QUOTES";
        $result = mysql_query($query);
        if(!$result)
            echo mysql_error();
        else{
            $row = mysql_fetch_assoc($result);
            $nextQuote = $row['quote']+1;
        }

    ?>
    <hr>
    <div class="row">
        <form class="form-inline" style="margin-left:20px;" action="process_tag.php?insert=1" method="post">
            <div class="row form-inline" style="margin-left:20px;">
                <label style="margin-left:0px;" >TAG Number</label>
                <label style="margin-left:5px;">Revision</label>
                <label style="margin-left:30px;">Date</label>
                <label style="margin-left:50px;">Subcategory</label>
                <label style="margin-left:25px;">Complexity</label>
                <label style="margin-left:10px;">Lead Time</label>
            </div>
            <div class="span10">
                <!-- add a value="" attribute for text in field -->
                <input type="text" placeholder="" style="width:85px;" name="TAGID" value="<?php echo $nextTag; ?>" readonly>
                <input type="text" placeholder="" style="width:65px;" name="RevNum" value="0" readonly="readonly">
                <input type="text" placeholder="" style="width:75px;" name="Date" value="<?php echo date("Y-m-d"); ?>" readonly="readonly">
                <select style="width:120px;" name="SubCatID">
                    <?php
                        $query = "SELECT * FROM Schneider.SUB_CAT";
                        $result = mysql_query($query) or die("Query failed : " . mysql_error());
                        while($row = mysql_fetch_assoc($result))
                        echo '<option value="' . $row['catID'] . '">' . $row['value'] . '</option>';
                    ?>
                </select>
                <select style="width:85px;" name="ComplexID">
                    <?php
                        $query = "SELECT * FROM Schneider.COMPLEXITY";
                        $result = mysql_query($query) or die("Query failed : " . mysql_error());
                        while($row = mysql_fetch_assoc($result))
                        echo '<option value="' . $row['complexID'] . '">' . $row['value'] . '</option>';
                    ?>
                </select>
                <input type="text" placeholder="#days" style="width:75px;" name="Lead_time"><br>
                <label style="margin-left:10px;">TAG Description:</label><br>
                <textarea style="width:530px;" name="TAG_Descr" rows="1"></textarea><br>
                <label style="margin-left:10px;">TAG Notes:</label><br>
                <textarea style="width:530px;" name="TAG_Notes" rows="1"></textarea><br>
                <label style="margin-left:10px;">Price Notes:</label><br>
                <textarea style="width:530px;" name="PriceNotes" rows="1"></textarea><br>
                <!--<label class="checkbox" style="margin-left:10px;"><input type="checkbox">
                    Click Box to Make TAG Permanently Obsolete</label>--><br>
                <label class="label" style="margin-left:10px;">Product Lines TAG May Be Applied To:</label><br>
                <label style="margin-left:125px;">USA$</label>
                <label style="margin-left:75px;">Canada$</label>
                <label style="margin-left:50px;">Mexico$</label><br>
                <label class="checkbox"><input type="checkbox" name="HVL" id="HVL"> HVL</label>
                <input type="text" id="HVL-USA" name="HVL-USA" value="0"  style="width:100px; margin-left:41px;" readonly>
                <input type="text" id="HVL-CANADA"  name="HVL-CANADA" value="0" style="width:100px;" readonly>
                <input type="text" id="HVL-MEXICO" name="HVL-MEXICO" value="0" style="width:100px;" readonly><br>
                <label class="checkbox"><input type="checkbox" name="HVLCC" id="HVLCC"> HVL/CC</label>
                <input type="text" id="HVLCC-USA" name="HVLCC-USA" value="0" style="width:100px;  margin-left:17px;" readonly>
                <input type="text" id="HVLCC-CANADA" name="HVLCC-CANADA" value="0" style="width:100px;" readonly>
                <input type="text" id="HVLCC-MEXICO" name="HVLCC-MEXICO" value="0" style="width:100px;" readonly><br>
                <label class="checkbox"><input type="checkbox" name="Metal_clad" id="Metal_clad"> Metal Clad</label>
                <input type="text" id="METALCLAD-USA" name="METALCLAD-USA" value="0" style="width:100px;" readonly>
                <input type="text" id="METALCLAD-CANADA" name="METALCLAD-CANADA" value="0" style="width:100px;" readonly>
                <input type="text" id="METALCLAD-MEXICO" name="METALCLAD-MEXICO" value="0" style="width:100px;" readonly><br>
                <label class="checkbox"><input type="checkbox" name="MVMCC" id="MVMCC"> MVMCC</label>
                <input type="text" id="MVMCC-USA" name="MVMCC-USA" value="0" style="width:100px; margin-left:16px;" readonly>
                <input type="text" id="MVMCC-CANADA" name="MVMCC-CANADA" value="0" style="width:100px;" readonly>
                <input type="text" id="MVMCC-MEXICO" name="MVMCC-MEXICO" value="0" style="width:100px;" readonly>
            </div>

            <div class="span4">
                <?php
                    $query = "SELECT * from Schneider.HOURLY";
                    $result = mysql_query($query);
                    $row = mysql_fetch_assoc($result);
                    $labPrice = $row['LabPrice'];
                    $engPrice = $row['EngPrice'];
                ?>
                <span class="label" style="margin-left:10px;">Pricing Information:</span><br>
                <label style="margin-left:10px;">Material:</label>
                <div class="input-prepend" style="float:right;">
                    <span class="add-on" style="float:left;">$</span>
                    <input type="text" id="MatCost" value="0" style="width:100px; float:right;" name="MatCost"
                           value="0" >
                </div>
                <br>
                <label style="margin-left:10px;">Labor Hours:</label>
                <div class="input-prepend" style="float:right;">
                    <span class="add-on" style="float:left;"></span>
                    <input type="text" id="LabHours"  style="width:100px; float:right;" name="LabHours" value="0" >
                </div>
                <br>
                <label style="margin-left:10px;">Labor Cost:</label>
                <div class="input-prepend" style="float:right;">
                    <span class="add-on" style="float:left;">$</span>
                    <input type='text' id='LabCost' value="0" style='width:100px;' name='LabCost' value=''readonly>
                </div>
                <br>
                <label style="margin-left:10px;">Engineering Hours:</label>
                <div class="input-prepend" style="float:right;">
                    <span class="add-on" style="float:left;"></span>
                    <input type="text" id="EngHours" placeholder="" style="width:100px; float:right;" name="EngHours" value="0" >
                </div>
                <br>
                <label style="margin-left:10px;">Engineering Cost:</label>
                <div class="input-prepend" style="float:right;">
                    <span class="add-on" style="float:left;">$</span>
                    <input type='text' id='EngCost' value="0" style='width:100px;' name='EngCost' value=''readonly>\
                </div>
                <hr style="color:black;">
                <label style="margin-left:10px;">Install Cost:</label>
                <div class="input-prepend" style="float:right;">
                    <span class="add-on" style="float:left;">$</span>
                    <input type="text" id="InstallCost" value="0" style="width:100px; float:right;"
                           name="InstallCost" readonly> <br>
                </div>
                <br><br><br>
                <input type="text" placeholder="" name="person" style="width:120px; float:right;"
                value="<?php echo $fname.' '.$lname; ?>" readonly>
                <label style="margin-left:10px; float:left;">TAG Member:</label> <br>
                <?php
                    $exp_date = date('Y-m-d', strtotime("+3 months"));
                ?>
                <input type="text" placeholder="" style="width:120px; float:right;" name="Expires" value="<?php echo $exp_date; ?>">
                <label style="margin-left:10px; float:left;">Price Expires:</label><br><br><br>
                
            </div>
        </div>
        <br>
        <!--<div class="label" style="margin-left:25px;">Applied FO:
        </div>
        <div class="row form-inline" style="margin-left:10px;">
            <label>TAG Number</label>
            <label>FO Number</label>
            <label style="margin-left:20px;">Notes to Next Engineer</label><br>
            <input type="text" style="width:60px;" name="TAGID" value="<?php// echo $nextTag; ?>" readonly>
            <input type="text" style="width:110px;" name="AppliedFO" value="" placeholder="">
            <textarea name="FONotes" rows="1"></textarea><br>
            <label class="checkbox">
            <input type="checkbox" name="isQuote">Quote
            </label>
            <label class="checkbox" style="margin-left:30px;">
            <input type="checkbox" name="isFO">Factory Order
            </label>
        </div>-->
        <button href class="pull-right" type="submit" name="revise">
                    Insert TAG</button><br>
        </form>
        <br>
    </div>
</div>
</body>
</html>    