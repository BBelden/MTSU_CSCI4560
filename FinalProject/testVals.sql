insert into Schneider.PERSON (id,fname,lname) values
(1,'Tony','Thompson'),
(2,'Oliver','Olivier'),
(3,'Uma','Ulrich'),
(4,'Adam','Adamson');

insert into Schneider.USERNAME (name,userID,password,expires, Admin, OE, TagMbr, User) values
('tony',1,'pass','1111-11-11 11:11:11',0,0,1,0),
('oliver',2,'pass','1111-11-11 11:11:11',0,1,0,0),
('uma',3,'pass','1111-11-11 11:11:11',0,0,0,1),
('adam',4,'pass','1111-11-11 11:11:11',1,0,0,0);

insert into Schneider.COUNTRY (cname,cmult) values
('USA',1.0),('Canada',0.75),('Mexico',1.00);

insert into Schneider.HOURLY (EngPrice,LabPrice) values (74.28,62.24);

insert into Schneider.COMPLEXITY (complexID,value)values(1,'A'),(2,'B'),(3,'C'),(4,'D'),(5,'E'),(6,'F'),(7,'G');

insert into Schneider.PRODUCT (pname,pmult)values('HVL',12),('HVL/CC',12),('Metal Clad',12),('MVMCC',12);

insert into Schneider.SUB_CAT (catID,value) values (1,'AC Panel'),(2,'Arc Resistant'),(3,'Auto Xfer');

insert into Schneider.GROUPS (name) values ('Admin'),('OE'),('Tag Member'),('User');

insert into Schneider.TAGS values
(6001,0,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6001,1,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',0),
(6002,0,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6002,1,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6002,2,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',0),
(6003,0,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6003,1,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6003,2,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6003,3,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',0),
(6004,0,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6004,1,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6004,2,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6004,3,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',1),
(6004,4,1,'2014-11-25','none',0,'none',0,0,0,0,0,1,1,0,0,0,0,'2015-02-25','none',0);


insert into Schneider.QUOTES values
(6004,4,'USA','HVL',0,0,0,0,0),
(6004,4,'Canada','HVL',0,0,0,0,0),
(6004,4,'Mexico','HVL',0,0,0,0,0),
(6004,4,'USA','HVL/CC',0,0,0,0,0),
(6004,4,'Canada','HVL/CC',0,0,0,0,0),
(6004,4,'Mexico','HVL/CC',0,0,0,0,0),
(6004,4,'USA','Metal Clad',0,0,0,0,0),
(6004,4,'Canada','Metal Clad',0,0,0,0,0),
(6004,4,'Mexico','Metal Clad',0,0,0,0,0),
(6004,4,'USA','MVMCC',0,0,0,0,0),
(6004,4,'Canada','MVMCC',0,0,0,0,0),
(6004,4,'Mexico','MVMCC',0,0,0,0,0);


