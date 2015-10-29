<?php
  require_once('config.php');
  $con = mysql_connect($dbhost, $dbusername, $dbpassword);
  if(!$con){
    die('could not connect: '.mysql_error());
  }
  mysql_select_db($dbname, $con);

  $cnt = -1;
  $_SESSION['tags_count'] = $cnt;
  $_SESSION['tags'] = array();

  $stag = $_POST['tagNumber'];
  $srev = $_POST['revision'];
  $sdate = $_POST['date'];
  $sdescript = $_POST['description'];
  $ssubcat = $_POST['subcategory'];
  if(isset($_POST['hvl'])){
    if($_POST['hvl'] == 'on')
      $shval = 1;
  }
  else 
    $shval = 0;
  if(isset($_POST['hvlcc'])){
    if($_POST['hvlcc'] == 'on')
      $shvlcc = 1;
  }
  else 
    $shvlcc = 0;
  if(isset($_POST['metal_clad'])){
    if($_POST['metal_clad'] == 'on')
      $smetal = 1;
  }
  else 
    $smetal = 0;
  if(isset($_POST['mvmcc'])){
    if($_POST['mvmcc'] == 'on')
      $smvmcc = 1;
  }
  else 
    $smvmcc = 0;
  $snotes = $_POST['notes'];
  $sinstall = $_POST['install_cost'];
  $sprice_note = $_POST['price_note'];

  if($_POST['created_by'] != ''){
    $userQ = "SELECT userID FROM Schneider.USERNAME WHERE name LIKE '" . $_POST['created_by'] . "' ";
    $userR = mysql_query($userQ);
    if($userRow = mysql_fetch_assoc($userR)){
      $screated = $userRow['userID'];
    }
  }  
  
  $search = "SELECT * FROM Schneider.TAGS WHERE 1=1 AND ";

  if($stag != ''){
    $search = $search . "TAGID = " . $stag . " AND ";
  }
  if($srev != ''){
    $search = $search . "RevNum = " . $srev . " AND ";
  }
  if($sdate != ''){
    $search = $search . "Date = " . $sdate . " AND ";
  }
  //DEG::TODO -- still need to add wildcard functionality fo this specific search and 
                // any other string searching 
  if($sdescript != ''){
    $search = $search . "TAG_Desc LIKE '" . $sdescript . "' AND ";
  }
  
  if($ssubcat != 'none' && $ssubcat != ''){
    $search = $search . "SubCatID = " . $ssubcat . " AND ";
  }
  if($shval != ''){
    $search = $search . "HVL = " . $shval . " AND ";
  }
  if($shvlcc != ''){
    $search = $search . "HVL/CC = " . $hvlcc . " AND ";
  }
  if($smetal != ''){
    $search = $search . "Metal_Clad = " . $smetal . " AND ";
  }
  if($smvmcc != ''){
    $search = $search . "MVMCC = " . $smvmcc . " AND ";
  }
  if($snotes != ''){
    $search = $search . "TAG_Notes LIKE '" .  $snotes . "' AND ";
  }
  if($sinstall != ''){
    $search = $search . "InstallCost = " . $sinstall . " AND ";
  }
  if($sprice_note != ''){
    $search = $search . "PriceNotes LIKE '" . $sprice_note . "' AND ";
  }
  if($screated != ''){
    $search = $search . "PersonID = " . $screated . " AND ";
  }
  if(isset($_POST['obsolete'])){
    $search = $search ."Obsolete = 1 AND ";
  }

  $search = $search." 1=1 ORDER BY TAGID DESC, RevNum DESC";
  $result = mysql_query($search);

  echo $search;

  //adding the actual complexity values from the specific
  //complexity table
  $complexQ = "SELECT * FROM Schneider.COMPLEXITY";
  $complexR = mysql_query($complexQ);
  $complex_array = array();
  $complex_count = 1;
  while($compRow = mysql_fetch_assoc($complexR)){
    $complex_array[$complex_count] = $compRow['value'];
    $complex_count = $complex_count + 1;
  }
  $complex_count = $complex_count - 1;

  //adding the actual subcategory values from the specific
  //subcategory table
  $subcatQ = "SELECT * FROM Schneider.SUB_CAT";
  $subcatR = mysql_query($subcatQ);
  $subcat_array = array();
  $subcat_count = 1;
  while($subcatRow = mysql_fetch_assoc($subcatR)){
    $subcat_array[$subcat_count] = $subcatRow['value'];
    $subcat_count = $subcat_count + 1;
  }
  $subcat_count = $subcat_count - 1;
  
  //adding the actual persons name the person table
  $personQ = "SELECT * FROM Schneider.PERSON";
  $personR = mysql_query($personQ);
  $person_array = array();
  $person_count = 1;
  while($personRow = mysql_fetch_assoc($personR)){
    $person_array[$person_count] = $personRow['fname'] . " " . $personRow['lname'];
    $person_count = $person_count + 1;
  }
  $person_count = $person_count - 1;

  $yn_array = array();
  $yn_array[0] = "No";
  $yn_array[1] = "Yes";


  if(!$result){
    header("location:search_results.php");
  }
  else{
      $cnt = 0;
      while($row = mysql_fetch_assoc($result)){
        $tag = new TAG();
        $tag->TAGID = $row['TAGID'];
        $tag->RevNum = $row['RevNum'];
        $tag->PersonID = $row['PersonID'];
        $tag->Person_Name = $person_array[$row['PersonID']];
        $tag->Date = $row['Date'];
        $tag->TAG_Descr = $row['TAG_Descr'];
        $tag->Lead_Time = $row['Lead_Time'];
        $tag->TAG_Notes = $row['TAG_Notes'];
        $tag->Attachments = $row['Attachments'];
        $tag->HVL = $yn_array[$row['HVL']];
        $tag->HVLCC = $yn_array[$row['HVLCC']];
        $tag->Metal_Clad = $yn_array[$row['Metal_Clad']];
        $tag->MVMCC = $yn_array[$row['MVMCC']];
        $tag->ComplexID = $complex_array[$row['ComplexID']];
        $tag->SubCatID = $subcat_array[$row['SubCatID']];
        $tag->Mat_Cost = $row['MatCost'];
        $tag->Eng_Cost = $row['EngCost'];
        $tag->Labor_Cost = $row['LaborCost'];
        $tag->Install_Cost = $row['InstallCost'];
        $tag->Price_Exp = $row['PriceExp'];
        $tag->Price_Notes = $row['PriceNotes'];
        $tag->Obsolete = $row['Obsolete'];

        $_SESSION['tags'][$cnt] = $tag;
        $cnt = $cnt+1;
      }
      $_SESSION['tags_count'] = $cnt-1;
      header("location:search_results.php");
  }
?>