<?php

  class USER {
	 public $id;
	 public $fname;
   public $lname;
   public $admin;
   public $oe;
   public $tagmbr;
   public $usr;
	 public $expires;
  }

  class TAG {
    public $TAGID;
    public $RevNum;
    public $PersonID;
    public $Person_Name;
    public $Date;
    public $TAG_Descr;
    public $Lead_Time;
    public $TAG_Notes;
    public $Attachments;
    public $HVL;
    public $HVLCC;
    public $Metal_Clad;
    public $MVMCC;
    public $ComplexID;
    public $SubCatID;
    public $Mat_Cost;
    public $Eng_Cost;
    public $Labor_Cost;
    public $Install_Cost;
    public $Price_Exp;
    public $Price_Notes;
    public $Obsolete;
  }

  class SECURITY{
    public $user;
    public $dateTime;
    public $ip;
    public $machineName;
  }
?>