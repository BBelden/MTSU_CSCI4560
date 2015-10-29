<?php
    require_once('config.php');
    $con = mysql_connect($dbhost, $dbusername, $dbpassword);
    if(!$con)
        die('could not connect: ' . mysql_error());
    mysql_select_db($dbname, $con);

    $identifier = $_GET['editid'];
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
            $("#MatCost, #LabCost, #EngCost").change(function()
            {
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

        function redirect() {
            window.location = 'https://www.cs.mtsu.edu/~dg3h/DBProj/editTag.php?editid=' + <?php echo $_GET['id']?>;
        }
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
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li><a href="./landing.php">Home</a></li>
          <?php
            echo '<li class="active"><a href="./search.php">Search TAGS</a></li>';
            if($_SESSION['newuser']->tagmbr == 1){
              echo '<li><a href="./insert.php">Insert TAGS</a></li>';
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
        <h2>View TAG</h2>
        <?php
            if(isset($_GET['insert'])){
        ?>
        <div class="alert alert-error" >An error occurred editing the TAG <br/>
        <span class="label label-important">NOTICE</span>
        Tag Number, labor cost, engineering cost, material cost, and lead time are all required fields </div>

        <?php
            }
            //$TAGID = $_GET['TAGID'];
            //$RevNum = $_GET['RevNum'];
            //$date='0000-00-00';
            //$TAGID = 6004;
            //$RevNum = 5;
            $TAGID = $_SESSION['tags'][$identifier]->TAGID;
            $RevNum = $_SESSION['tags'][$identifier]->RevNum;
            //$query = 'SELECT * FROM Schneider.TAGS JOIN Schneider.SUB_CAT ON Schneider.SUB_CAT.catID = Schneider.TAGS.SubCatID WHERE  '.$TAGID.' = Schneider.TAGS.TAGID AND '.$RevNum.' = Schneider.TAGS.RevNum';
            //$result = mysql_query($query) or die("Query failed : " . mysql_error());
            //if($row = mysql_fetch_assoc($result))
            //{
                //$date=$row['Date'];
                echo '<hr/>';
                echo '<div class="row">';
                echo '<form class="form-inline" style="margin-left:20px;" action="process_tag.php" method="post" >';
                echo '<label style="margin-left:22px;" >TAG Number</label>';
                echo '<label style="margin-left:5px;">Revision</label>';
                echo '<label style="margin-left:30px;">Date</label>';
                echo '<label style="margin-left:50px;">Subcategory</label>';
                echo '<label style="margin-left:25px;">Complexity</label>';
                echo '<label style="margin-left:10px;">Lead Time</label>';
                echo '<div class="span10">';
                echo '<input type="text" placeholder="" style="width:85px;" name="TAGID" readonly value="'. $_SESSION['tags'][$identifier]->TAGID  .' ">';
                //$temp = $row['RevNum']+1;
                echo '<input type="text" placeholder="" style="width:65px;" name="RevNum" readonly value="'. $_SESSION['tags'][$identifier]->RevNum  .' "> ';
                echo '<input type="text" placeholder="" style="width:85px;" name="Date" value="'.$_SESSION['tags'][$identifier]->Date.'" readonly>';
                echo '<input type="text" placeholder="" style="width:85px;" name="SubCatID" value="'.$_SESSION['tags'][$identifier]->SubCatID.'" readonly>';
                echo '<input type="text" placeholder="" style="width:85px;" name="ComplexID" value="'.$_SESSION['tags'][$identifier]->ComplexID.'" readonly>';
                echo '<input type="text" placeholder="" style="width:75px;" name="Lead_time" value="'.$_SESSION['tags'][$identifier]->Lead_Time.'" readonly>';
                echo '<br>';
                echo '<label style="margin-left:10px;">TAG Description:</label><br>';
                echo '<textarea style="width:535px;" name="TAG_Descr" rows="1" readonly> '.$_SESSION['tags'][$identifier]->TAG_Descr.' </textarea>';

                echo '<br>';
                echo '<label style="margin-left:10px;">TAG Notes:</label><br>';
                echo '<textarea style="width:535px;" name="TAG_Notes" rows="1" readonly> '.$_SESSION['tags'][$identifier]->TAG_Notes.' </textarea>';

                echo '<br>';
                echo '<label style="margin-left:10px;">Price Notes:</label><br>';
                echo '<textarea style="width:535px;" name="PriceNotes" rows="1" readonly> '.$_SESSION['tags'][$identifier]->Price_Notes.' </textarea>';
                echo '<br>';

                $HVL = '';
                $HVLCC = '';
                $MC = '';
                $MVMCC = '';

                $query = 'SELECT HVL FROM Schneider.TAGS WHERE TAGID='.$TAGID.' AND RevNum='.$RevNum;
                $result = mysql_query($query);
                while($row = mysql_fetch_assoc($result)){
                    if($row['HVL']==1){$HVL = 'checked="checked"' ;}}

                $query = 'SELECT HVLCC FROM Schneider.TAGS WHERE TAGID='.$TAGID.' AND RevNum='.$RevNum;
                $result = mysql_query($query);
                while($row = mysql_fetch_assoc($result)){
                    if($row['HVLCC']==1){$HVLCC = 'checked="checked"' ;}}

                $query = 'SELECT Metal_Clad FROM Schneider.TAGS WHERE TAGID='.$TAGID.' AND RevNum='.$RevNum;
                $result = mysql_query($query);
                while($row = mysql_fetch_assoc($result)){
                    if($row['Metal_Clad']==1){$MC = 'checked="checked"' ;}}

                $query = 'SELECT MVMCC FROM Schneider.TAGS WHERE TAGID='.$TAGID.' AND RevNum='.$RevNum;
                $result = mysql_query($query);
                while($row = mysql_fetch_assoc($result)){
                    if($row['MVMCC']==1){$MVMCC = 'checked="checked"' ;}}

                $queryUSA = 'SELECT * FROM Schneider.QUOTES WHERE TagNum='.$TAGID.' AND RevNum='.$RevNum.' AND Country="USA"';
                $resultUSA = mysql_query($queryUSA);
                $rowUSA = mysql_fetch_assoc($resultUSA);
                $MatCost = $rowUSA['MatCost'];
                $LabCost = $rowUSA['LabCost'];
                $EngCost = $rowUSA['EngCost'];
                $InstCost = $rowUSA['InstCost'];

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
            $inst = $_SESSION['tags'][$identifier]->Install_Cost;


                echo '<label class="checkbox" style="margin-left:10px;">';
                echo '<input type="checkbox" name="obs" id="obs"> Click Box to Make TAG Permanantly Obsolete';
                echo '</label>';
                echo '<br>';
                echo '<label class="label" style="margin-left:10px; background-color:#009530;">Product Lines Tag May Be Applied To:</label>';
                echo '<br>';
                echo '<label style="margin-left:125px;">USA$</label>';
                echo '<label style="margin-left:75px;">Canada$</label>';
                echo '<label style="margin-left:50px;">Mexico$</label>';
                echo '<br>';
                echo '<label class="checkbox">';
                echo '<input type="checkbox" name="HVL" id="HVL"'.$HVL.' disabled> HVL';
                echo '</label>';
                if($_SESSION['newuser']->tagmbr == 1){
                    echo '<input type="text" id="HVL-USA" name="HVL-USA" value="'.$inst * $USA_X * $HVL_X.'"  style="width:100px; margin-left:41px;" readonly>';
                    echo '<input type="text" id="HVL-CANADA"  name="HVL-CANADA" value="'.$inst * $Can_X * $HVL_X.'" style="width:100px;" readonly>';
                    echo '<input type="text" id="HVL-MEXICO" name="HVL-MEXICO" value="'.$inst * $Mex_X * $HVL_X.'" style="width:100px;" readonly>';
                }
                else{
                    echo '<input type="text" id="HVL-USA" name="HVL-USA" value=""  style="width:100px; margin-left:41px;" readonly>';
                    echo '<input type="text" id="HVL-CANADA"  name="HVL-CANADA" value="" style="width:100px;" readonly>';
                    echo '<input type="text" id="HVL-MEXICO" name="HVL-MEXICO" value="" style="width:100px;" readonly>';
                }
                echo '<br>';
                echo '<label class="checkbox">';
                echo '<input type="checkbox" name="HVLCC" id="HVLCC" '.$HVLCC.' disabled> HVL/CC';
                echo '</label>';
                if($_SESSION['newuser']->tagmbr == 1){
                    echo '<input type="text" id="HVLCC-USA" name="HVLCC-USA" value="'.$inst * $USA_X * $HVLCC_X.'" style="width:100px;  margin-left:17px;" readonly>';
                    echo '<input type="text" id="HVLCC-CANADA" name="HVLCC-CANADA" value="'.$inst * $Can_X * $HVLCC_X.'" style="width:100px;" readonly>';
                    echo '<input type="text" id="HVLCC-MEXICO" name="HVLCC-MEXICO" value="'.$inst * $Mex_X * $HVLCC_X.'" style="width:100px;" readonly>';
                }
                else{
                    echo '<input type="text" id="HVLCC-USA" name="HVLCC-USA" value="" style="width:100px;  margin-left:17px;" readonly>';
                    echo '<input type="text" id="HVLCC-CANADA" name="HVLCC-CANADA" value="" style="width:100px;" readonly>';
                    echo '<input type="text" id="HVLCC-MEXICO" name="HVLCC-MEXICO" value="" style="width:100px;" readonly>'; 
                }
                echo '<br>';
                echo '<label class="checkbox">';
                echo '<input type="checkbox" id="MetalClad" name="MetalClad" '.$MC.' disabled> Metal Clad';
                echo '</label>';
                if($_SESSION['newuser']->tagmbr == 1){
                    echo '<input type="text" id="METALCLAD-USA" name="METALCLAD-USA" value="'.$inst * $USA_X * $MC_X.'" style="width:100px;" readonly>';
                    echo '<input type="text" id="METALCLAD-CANADA" name="METALCLAD-CANADA" value="'.$inst * $Can_X * $MC_X.'" style="width:100px;" readonly>';
                    echo '<input type="text" id="METALCLAD-MEXICO" name="METALCLAD-MEXICO" value="'.$inst * $Mex_X * $MC_X.'" style="width:100px;" readonly>';
                }
                else{
                    echo '<input type="text" id="METALCLAD-USA" name="METALCLAD-USA" value="" style="width:100px;" readonly>';
                    echo '<input type="text" id="METALCLAD-CANADA" name="METALCLAD-CANADA" value="" style="width:100px;" readonly>';
                    echo '<input type="text" id="METALCLAD-MEXICO" name="METALCLAD-MEXICO" value="" style="width:100px;" readonly>';
                }
                echo '<br>';
                echo '<label class="checkbox">';
                echo '<input type="checkbox" id="MVMCC" name="MVMCC"'.$MVMCC.' disabled> MVMCC';
                echo '</label>';
                if($_SESSION['newuser']->tagmbr == 1){
                    echo '<input type="text" id="MVMCC-USA" name="MVMCC-USA" value="'.$inst * $USA_X * $MVMCC_X.'" style="width:100px; margin-left:16px;" readonly>';
                    echo '<input type="text" id="MVMCC-CANADA" name="MVMCC-CANADA" value="'.$inst * $Can_X * $MVMCC_X.'" style="width:100px;" readonly>';
                    echo '<input type="text" id="MVMCC-MEXICO" name="MVMCC-MEXICO" value="'.$inst * $Mex_X * $MVMCC_X.'" style="width:100px;" readonly>';
                }
                else{
                    echo '<input type="text" id="MVMCC-USA" name="MVMCC-USA" value="" style="width:100px; margin-left:16px;" readonly>';
                    echo '<input type="text" id="MVMCC-CANADA" name="MVMCC-CANADA" value="" style="width:100px;" readonly>';
                    echo '<input type="text" id="MVMCC-MEXICO" name="MVMCC-MEXICO" value="" style="width:100px;" readonly>';
                }
                echo '</div>';
                echo '<div class="span4">';
                echo '<span class="label" style="margin-left:10px; background-color:#009530;">Pricing Information:</span><br>';
                echo '<label style="margin-left:10px;">Material:</label>';
                echo '<div class="input-prepend" style="float:right;">';
                echo '<span class="add-on" style="float:left;">$</span>';
                if($_SESSION['newuser']->tagmbr == 1){
                    echo '<input type="text" id="MatCost" placeholder="" style="width:100px; float:right;" name="MatCost" value="'.$MatCost.'" readonly> ';
                }
                else{
                    echo '<input type="text" id="MatCost" placeholder="" style="width:100px; float:right;" name="MatCost" value="" readonly> ';
                }
                echo '</div> <br/>';
                echo '<label style="margin-left:10px;">Labor:</label> ';
                echo '<div class="input-prepend" style="float:right;">';
                echo '<span class="add-on" style="float:left;">$</span>';
                if($_SESSION['newuser']->tagmbr == 1){
                    echo '<input type="text" id="LabCost" placeholder="" style="width:100px;" name="LabCost" value="'.$LabCost.'" readonly>';
                }
                else{
                    echo '<input type="text" id="LabCost" placeholder="" style="width:100px;" name="LabCost" value="" readonly>';
                }
                echo '</div> <br/>';
                echo '<label style="margin-left:10px;">Engineering:</label>';
                echo '<div class="input-prepend" style="float:right;">';
                echo '<span class="add-on" style="float:left;">$</span>';
                if($_SESSION['newuser']->tagmbr == 1){
                    echo '<input type="text" id="EngCost" placeholder="" style="width:100px;" name="EngCost" value="'.$EngCost.'" readonly>';
                }
                else{
                    echo '<input type="text" id="EngCost" placeholder="" style="width:100px;" name="EngCost" value="" readonly>';
                }
                echo '</div>';
                echo '<hr style="color:black;">';
                echo '<label style="margin-left:10px;">Install Cost:</label>';
                echo '<div class="input-prepend" style="float:right;">';
                echo '<span class="add-on" style="float:left;">$</span>';
                if($_SESSION['newuser']->tagmbr == 1){
                    echo '<input type="text" id="InstallCost" placeholder="" style="width:100px; float:right;" name="InstallCost" readonly value="'.$InstCost.'"> <br>';
                }
                else{
                    echo '<input type="text" id="InstallCost" placeholder="" style="width:100px; float:right;" name="InstallCost" readonly value=""> <br>';
                }
                echo '</div>';
                echo '<br><br><br>';
            ?>

                    <input type="text" placeholder="" name="Person" style="width:120px; float:right;" value="<?php echo $_SESSION['tags'][$identifier]->Person_Name; ?>" readonly>
                    <label style="margin-left:10px; float:left;">TAG Member:</label> <br>
                    <input type="text" placeholder="" style="width:120px; float:right;" name="Expires" value="<?php echo $_SESSION['tags'][$identifier]->Price_Exp; ?>" readonly>
                    <label style="margin-left:10px; float:left;">Price Expires:</label><br><br><br>
                    </form>

                    <?php
                        echo 'Attachments:&nbsp&nbsp&nbsp&nbsp';
                        $query = "SELECT * FROM Schneider.ATTACHMENTS WHERE TagNum=".$_SESSION['tags'][$identifier]->TAGID;
                        $result = mysql_query($query);
                        if (mysql_num_rows($result) == 0) {
                            echo 'none';
                        }
                        else if (mysql_num_rows($result) != 0) {
                            while ($row = mysql_fetch_assoc($result))
                                echo '<a href="./showAttachment.php?filename='.$row['filename'].'" target="_new">'.$row['filename'].'</a>&nbsp&nbsp&nbsp&nbsp';
                        }
                    ?><br><br>
            
            </div>
        <br>
        <div class="row" style="margin-left:30px; margin-top:10px; float:left;">
            <div class="label" style="margin-left:25px; background-color:#009530;">Applied FO:</div><br>
                <table class="table table-condensed">
                    <tr><th>Tag Number</th><th>Applied FO Number</th><th>Notes to next engineer</th><th>Type</th></tr>
                    <?php
                        $revNum = $row['RevNum'];
                        $query = 'SELECT * FROM Schneider.APPLIED_FO WHERE TagNum='.$TAGID;
                        $result = mysql_query($query);

                        if(mysql_num_fields($result) > 0){
                            while($row = mysql_fetch_assoc($result)){
                                $fo = "";
                                $quote = "";
                                if($row['Type'] == 1)
                                    $fo = "checked";
                                else
                                    $quote = "checked";
                            
                                echo '<tr><td><input type="text" name="Tag" style="width:60px;" value='.$row['TagNum'].' readonly></td>';
                                echo '<td><input type="text" name="FO" readonly="" value="'.$row['FOno'].'"></td>';
                                echo '<td><textarea rows="1" style="width:300px;" name="Notes" readonly="">'.$row['Notes'].'</textarea></td>';
                                echo '<td><label class="checkbox"><input type="checkbox" name="TypeQuote"'.$quote.' disabled="disabled">Quote</label></td>';
                                echo '<td><label style="margin-left=0px;" class="checkbox"><input type="checkbox" name="TypeFO"'.$fo.' disabled="disabled">FO</label></td></tr>';
                            }
                        }
                    ?>
                 </table>
            </div>
        </div>

        <?php 
                //pulled 6 lines from here to put below in form
                echo '<button class="pull-right" style="margin-right:250px; margin-left:5px;" onclick="history.go(-1);">Back</button>';
                if($_SESSION['newuser']->tagmbr == 1){
                    if($_SESSION['tags'][$identifier]->Obsolete == 0){
                        echo '<form action="editTag.php?editid='.$identifier.'" method="post">';
                        echo '<button class="pull-right" type="submit">Edit Tag</button>';
                        echo '</form>';
                    }
                }
                echo '<form action="printTag.php?id='.$identifier.'" method="post" target="_new">';
                echo '<button class="pull-right" style="margin-right:5px;" type="submit">Print Tag</button>';
                echo '</form>';
                echo '</div>';
                echo '<br><br><br>';
        ?>
    </div> 
</body>
</html>

