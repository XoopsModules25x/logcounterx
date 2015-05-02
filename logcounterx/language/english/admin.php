<?php
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

define('_LCX_ADM_CONFIG', ' Configuration ');
define('_LCX_ADM_GENCONF', 'General Configuration');
define('_LCX_ADM_LOGCONF', 'Advanced Configuration');
define('_LCX_ADM_REPCONF', 'Report Configuration');
define('_LCX_ADM_REBUILD', 'Re-calculate Log Data');
define('_LCX_ADM_IMGSLCT', 'Counter Image Selection');
define('_LCX_ADM_DBCHECK', 'Check Database');
define('_LCX_ADM_BLOCKSADMIN', 'My Blocks Admin');
define('_LCX_ADM_GENCONF_DESC', 'Counter Display');
define('_LCX_ADM_LOGCONF_DESC', 'Log Report General Configuration');
define('_LCX_ADM_REPCONF_DESC', 'Report Display');
define('_LCX_ADM_REBUILD_DESC', 'Re-calculate Log Data<br />It takes time...');
define('_LCX_ADM_IMGSLCT_DESC', 'Select Counter Image(s)');
define('_LCX_ADM_DBCHECK_DESC', 'Check and Optimize Database');
define('_LCX_ADM_BLOCKSADMIN_DESC', 'Blocks Admin. (Thanks to GIJOE.)');

define('_LCX_ADM_CUPBLK_SET', "Automatic Setting Up 'Count-Up Block'");
define('_LCX_ADM_CUPBLK_TITL', 'Count-Up Block Setting');
define('_LCX_ADM_CUPBLK_DESC', "Check and Modify Settings of 'Count-Up Block'");

define('_LCX_ADM_RESETCOUNT_TITLE', 'Counter Initial Value');
define('_LCX_ADM_LOGCOUNT_TITLE', '&lt;- Max Count Value in Log-database (For Your Information)');
define('_LCX_ADM_RESETCOUNT_DESC', 'Set initial value to start count');
define('_LCX_ADM_TIMEOFFSET_NAME', 'Time Offset (-12 .. +12)');
define('_LCX_ADM_TIMEOFFSET_DESC', 'Input Offset (Hours) to Adjust Server-Time to your Local-Time');
define('_LCX_ADM_TIMEOFFSET_SVTM', 'Server Time  F');
define('_LCX_ADM_TIMEOFFSET_ADTM', 'Adjusted TimeF');
define('_LCX_ADM_ADDIP_TITLE', 'Except Hostname');
define('_LCX_ADM_ADDIP_DESC', "Set Hostname not to be on Report<br />You can use ' % ' as wild-card");
define('_LCX_ADM_ADDREF_TITLE', 'Except Referer');
define('_LCX_ADM_ADDREF_DESC', 'Set Referer not to be on Report<br />Referer including this string are not to be reported.');
define('_LCX_ADM_YOURHOST_TITLE', 'Your Hostname');
define('_LCX_ADM_YOURHOST_ADD', "Set it to 'Except Hostname'");
define('_LCX_ADM_DELETEIP_TITLE', 'Excepted Hostname');
define('_LCX_ADM_DELETEIP_DESC', 'Delete Hostname from Execpting List<br />(Set Hostname to be on Report)');
define('_LCX_ADM_DELETEREF_TITLE', 'Excepted Referer');
define('_LCX_ADM_DELETEREF_DESC', 'Delete Referer from Execpting List<br />(Set Referer to be on Report)');

define('_LCX_ADM_REPORTING_TITLE', 'Reporting');
define('_LCX_ADM_REPORTING_DESC', 'Select User Type');
define('_LCX_ADM_REPORTING_ALL', 'All');
define('_LCX_ADM_REPORTING_WORBT', 'Except for Search ROBOT');
define('_LCX_ADM_REPORTING_ROBOT', 'Search ROBOT');

define('_LCX_ADM_BY_R2', 'by Referer (Summary)');
define('_LCX_ADM_BY_OS', 'by Client OS');
define('_LCX_ADM_BY_BR', 'by Client Browser List');
define('_LCX_ADM_BY_RC', 'Recent Days');
define('_LCX_ADM_BY_DR', 'by Day (Order by Count/Day)');
define('_LCX_ADM_BY_WD', 'by Day-Of-The-Week');
define('_LCX_ADM_BY_TM', 'by Time (Hour)');
define('_LCX_ADM_BY_HN', 'by Remote Host');
define('_LCX_ADM_BY_RF', 'by Referer (Recent Access)');
define('_LCX_ADM_BY_QW', 'by Search Word');
define('_LCX_ADM_BY_UN', 'by XOOPS User Name');
define('_LCX_ADM_BY_PI', 'by First Visited Page');
define('_LCX_ADM_REFLINK', 'Set Link to Referer');

define('_LCX_ADM_FOR_GUEST', 'GUEST : ');
define('_LCX_ADM_FOR_USERS', 'USERS : ');
define('_LCX_ADM_FOR_ADMIN', 'ADMIN : ');
define('_LCX_ADM_GUEST', 'All (include GUEST) ');
define('_LCX_ADM_USERS', 'Users Only ');
define('_LCX_ADM_ADMIN', 'Administrators ');
define('_LCX_ADM_NOONE', 'None ');

define('_LCX_ADM_ROWLIMIT', 'Limit or Report Rows (Top XX data)');

define('_LCX_ADM_IMGNOW', 'Current Images');
define('_LCX_ADM_STYLE', 'Font Style (SPAN-TAG)');

define('_LCX_ADM_DAY_NAME', 'Today : ');
define('_LCX_ADM_DAY_DESC', 'Count of Today');
define('_LCX_ADM_YDAY_NAME', 'Yesterday : ');
define('_LCX_ADM_YDAY_DESC', 'Count of Yesterday');
define('_LCX_ADM_WEEK_NAME', 'This Week : ');
define('_LCX_ADM_WEEK_DESC', 'Count of This Week (from Sunday)');
define('_LCX_ADM_MONTH_NAME', 'This Month : ');
define('_LCX_ADM_MONTH_DESC', 'Count of This Month');
define('_LCX_ADM_AVE_NAME', 'Average : ');
define('_LCX_ADM_AVE_DESC', 'Average of Daily Count (Since this Module Started)');
define('_LCX_ADM_IPIT_NAME', 'Count Interval');
define('_LCX_ADM_IPIT_DESC', 'Interval to Count Access from Same IP-Address (Sec.)');
define('_LCX_ADM_NOROBCNT_NAME', "Omit to Count ROBOT's access");
define('_LCX_ADM_NOROBCNT_DESC', 'Omit to Count Access by Search-ROBOT');
define('_LCX_ADM_NOHSTCNT_NAME', 'Omit to Count Excepted Host');
define('_LCX_ADM_NOHSTCNT_DESC', "Omit to Count Access from Report-Excepted Host<br />You Can Add or Delete Host on 'Report Display' Panel");
define('_LCX_ADM_MAXWIDTH_NAME', 'Max Width or Reporting Bar');
define('_LCX_ADM_MAXWIDTH_DESC', 'Input Maximum Size (Width) of Bar-Image on Reporting');

define('_LCX_ADM_LOGLIM_NAME', 'Limit of Log');
define('_LCX_ADM_LOGLIM_DESC', 'Limit of Log (Record Number)');
define('_LCX_ADM_USER_COOKIE_NAME', 'User by Cookies');
define('_LCX_ADM_USER_COOKIE_DESC', 'Detect User Only by Cookies');
define('_LCX_ADM_GETHOST_NAME', 'GetHostByAddress');
define('_LCX_ADM_GETHOST_DESC', "Use 'GetHostByAddress' Function on Reporting<br />It May Cause Slow Response");

define('_LCX_ADM_BROS_NAME', 'List of Browsers');
define('_LCX_ADM_BROS_DESC', 'List of All USER_AGENT');
define('_LCX_ADM_QWORDS_NAME', 'List of Query Words');
define('_LCX_ADM_QWORDS_DESC', 'List of All Search Query Words');

define('_LCX_ADM_USEIMG', 'Counter Display');
define('_LCX_ADM_IMG', 'by IMAGE');
define('_LCX_ADM_CHR', 'by CHARACTER');
define('_LCX_ADM_CHGIMG_NOTE', 'The images of the directory named same as the theme are used regardless of this setting.');

define('_LCX_ADM_CHKDB_NAME', 'Table Name');
define('_LCX_ADM_CHKDB_ROWS', 'Data Rows');
define('_LCX_ADM_CHKDB_DATA_LENGTH', 'Data Size');
define('_LCX_ADM_CHKDB_AVG_ROW_LENGTH', 'Size/Rows');
define('_LCX_ADM_CHKDB_DATA_FREE', 'Free Area');
define('_LCX_ADM_CHKDB_UPDATE_TIME', 'Updated');
define('_LCX_ADM_CHKDB_OPTIMIZE_DESC', 'Optimize Table');

// Blocks & Groups Admin
define('_AM_LATESTNEWS_TITLE', 'Title');
define('_AM_SIDE', 'Location');
define('_AM_LATESTNEWS_WEIGHT', 'Weight');
define('_AM_VISIBLEIN', 'Visible in');
define('_AM_BCACHETIME', 'Cache time');
define('_AM_LATESTNEWS_ACTION', 'Action');
define('_AM_ACTIVERIGHTS', 'Module administration rights');
define('_AM_ACCESSRIGHTS', 'Module access rights');
define('_AM_BADMIN', 'Blocks administration');
define('_AM_ADGS', 'Groups');

define('_AM_ALLMODULEPAGES', 'Groups');

define('_AM_SYSTEMLEVEL', '_AM_SYSTEMLEVEL');
define('_AM_ADMINBLOCK', '_AM_ADMINBLOCK');
define('_AM_TOPPAGE', '_AM_TOPPAGE');
define('_AM_ALLPAGES', '_AM_ALLPAGES');

define('_AM_TITLE', 'Title');
define('_AM_WEIGHT', 'Weight');
define('_AM_ACTION', 'Action');
define('_MD_AM_ADGS', 'Permissions');
