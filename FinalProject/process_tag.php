<?php
  require_once('config.php');

  $con = mysql_connect($dbhost, $dbusername, $dbpassword);
  if(!$con)
    die('could not connect: ' . mysql_error());
  mysql_select_db($dbname, $con);

  if(isset($_POST['HVL'])) {
    if($_POST['HVL'] == 'on')
      $hvl = 1;
  }
  else
    $hvl = 0;
  if(isset($_POST['HVLCC'])){
    if($_POST['HVLCC'] == 'on')
      $hvlcc = 1;
  }
  else
    $hvlcc = 0;
  if(isset($_POST['Metal_clad'])){
    if($_POST['Metal_clad'] == 'on')
      $mc = 1;
  }
  else
    $mc = 0;
  if(isset($_POST['MVMCC'])){
    if($_POST['MVMCC'] == 'on')
      $mvmcc = 1;
  }
  else
    $mvmcc = 0;
  if($_POST['TAG_Descr'] != '')
    $tag_desc = $_POST['TAG_Descr'];
  else
    $tag_desc = "NONE";
  if($_POST['TAG_Notes'] != '')
    $tag_notes = $_POST['TAG_Notes'];
  else
    $tag_notes = "NONE";
  if($_POST['Lead_time'] != '')
    $lead_time = $_POST['Lead_time'];
  else
    $lead_time = 0;
  if($_POST['PriceNotes'] != '')
    $price_notes = $_POST['PriceNotes'];
  else
    $price_notes = "NONE";
  if($_POST['InstallCost'] != '')
    $install_cost = $_POST['InstallCost'];
  else
    $install_cost = 0;
  if(isset($_POST['obs'])){
    $obs = $_POST['obs'];
  }
  else{
    $obs = 0;
  }

  //add attachments
  $att = 0;

  if(isset($_GET['insert'])){
    $sub_cat = $_POST['SubCatID'];
    $complexity = $_POST['ComplexID'];
  }
  else{
    $subcatQ = "SELECT * FROM Schneider.SUB_CAT";
    $subcatR = mysql_query($subcatQ);
    $subcat_array = array();
    $subcat_count = 1;
    while($subcatRow = mysql_fetch_assoc($subcatR)){
      if($_POST['SubCatID'] == $subcatRow['value'])
        $sub_cat = $subcat_count;
      $subcat_count = $subcat_count + 1;
    }

    $complexQ = "SELECT * FROM Schneider.COMPLEXITY";
    $complexR = mysql_query($complexQ);
    $complex_array = array();
    $complex_count = 1;
    while($compRow = mysql_fetch_assoc($complexR)){
      if($_POST['ComplexID'] == $compRow['value'])
        $complexity = $complex_count;
      $complex_count = $complex_count + 1;
    }
  }

  $query = "INSERT INTO Schneider.TAGS VALUES(
    '".$_POST['TAGID']."',
    '".$_POST['RevNum']."',
    '".$_SESSION['newuser']->id."',
    '".$_POST['Date']."',
    '".$tag_desc."',
    '".$lead_time."',
    '".$tag_notes."',
    '".$att."',
    '".$hvl."',
    '".$hvlcc."',
    '".$mc."',
    '".$mvmcc."',
    '".$complexity."',
    '".$sub_cat."',
    '".$_POST['MatCost']."',
    '".$_POST['EngCost']."',
    '".$_POST['LabCost']."',
    '".$install_cost."',
    '".$_POST['Expires']."',
    '".$_POST['PriceNotes']."',
    '".$obs."')";
    


    //'".$price_notes."')";
    /*echo "hello";
    echo $_POST['PriceNotes'];
    echo "goodbye";
    var_dump($_POST['PriceNotes']);*/

    $result1 = mysql_query($query);

    $query = 'INSERT INTO Schneider.QUOTES (TagNum,RevNum,Country,Product,MatCost,LabCost,EngCost,InstCost,Quote) VALUES ('.$_POST['TAGID'].','.$_POST['RevNum'].',"USA", "HVL",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"Canada", "HVL",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"Mexico", "HVL",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"USA", "HVLCC",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"Canada", "HVLCC",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"Mexico", "HVLCC",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"USA", "Metal Clad",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"Canada", "Metal Clad",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"Mexico", "Metal Clad",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"USA", "MVMCC",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"USA", "MVMCC",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
    $query = 'INSERT INTO Schneider.QUOTES VALUES('.$_POST['TAGID'].','.$_POST['RevNum'].',"USA", "MVMCC",'.$_POST['MatCost'].','.$_POST['LabCost'].','.$_POST['EngCost'].','.$_POST['InstallCost'].','.$_POST['HVL-USA'].')';
    $result = mysql_query($query);
	
  if($_POST['RevNum'] > 0){
    $i = $_POST['RevNum'];
    $i = $i - 1;
    $query = "UPDATE Schneider.TAGS SET Obsolete = 1 WHERE TAGID =".$_POST['TAGID']." AND RevNum =".$i;
    $result = mysql_query($query);
  }

  if(isset($_POST['AppliedFO']))
	{
		$query = "INSERT INTO Schneider.APPLIED_FO VALUES('".$_POST['AppliedFO']."','".$_POST['TAGID']."','".$_POST['RevNum']."','".$_POST['FONotes']."')";
		$result = mysql_query($query);
	}

  if($result1){
    header("location:./landing.php");
  }
  else{
    header("location:./landing.php");
  }


/*$url = './landing.php';
redirect($url);

function redirect($url){
    if (headers_sent()){
        die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
    }else{
        header('Location: ' . $url);
        die();
    }
}
*/
