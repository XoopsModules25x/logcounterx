#
# Data for checking
#
CREATE TABLE logcounterx_ip (
	accip		varchar(255)		NOT NULL,
	acctime		int(10) unsigned 	NOT NULL,
	PRIMARY KEY  (accip)
) ENGINE = MyISAM;

#
# Main Count Data
#
CREATE TABLE logcounterx_count (
	ymd		date		NOT NULL,
	cnt		int unsigned	NOT NULL default 0,
	robot		int unsigned	NOT NULL default 0,
	PRIMARY KEY  (ymd)
) ENGINE = MyISAM;

#
# Main Count Data
#
CREATE TABLE logcounterx_hours (
	hour		char(2)		NOT NULL,
	cnt		int unsigned	NOT NULL default 0,
	robot		int unsigned	NOT NULL default 0,
	PRIMARY KEY  (hour)
) ENGINE = MyISAM;

#
# Log Data
#
CREATE TABLE logcounterx_log (
	recid		int unsigned		NOT NULL auto_increment,
	igflag		tinyint unsigned	NOT NULL default 0,
	user_agent	varchar(150)		NOT NULL default '',
	remote_host	varchar(150)		NOT NULL default '',
	rh_short	varchar(150)		NOT NULL default '',
	path_info	varchar(80)		NOT NULL default '',
	referer		varchar(254)		NOT NULL default '',
	ref_short	varchar(150)		NOT NULL default '',
	ref_query	varchar(150)		NOT NULL default '',
	acccnt		mediumint(8) unsigned	NOT NULL default 0,
	uname		varchar(25)		NULL,
	agent		varchar(20)		NULL,
	os		varchar(20)		NULL,
	qword		varchar(254)		NULL,
	accday		date			NOT NULL,
	acctime		time			NOT NULL,
	accwday		tinyint unsigned	NOT NULL,
	PRIMARY KEY  (recid)
) ENGINE = MyISAM;

#
# Config Data
#
CREATE TABLE logcounterx_cfg (
	recid		smallint unsigned	NOT NULL auto_increment,
	cfgname		varchar(32)		NOT NULL default '',
	cfgvalue	varchar(254)		NOT NULL default '',
	PRIMARY KEY  (recid)
) ENGINE = MyISAM;
