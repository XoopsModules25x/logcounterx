<?php
include_once("../../../mainfile.php");
include_once(XOOPS_ROOT_PATH . "/class/xoopsmodule.php");
include_once("../include/functions.php");

//	Check Permission
if ($xoopsUser) {
    $xoopsModule = XoopsModule::getByDirname("logcounterx");
    if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
        redirect_header(XOOPS_URL . "/", 3, _NOPERM);
        exit();
    }
} else {
    redirect_header(XOOPS_URL . "/", 3, _NOPERM);
    exit();
}

//	Initial Values
$StepRecNum  = 500;
$RecID       = (isset($_GET['rec']) ? (int)($_GET['rec']) : 0);
$MaxRecID    = (isset($_GET['max']) ? (int)($_GET['max']) : 0);
$TotalRecNum = (isset($_GET['ttl']) ? (int)($_GET['ttl']) : 0);
$PageNum     = (isset($_GET['page']) ? (int)($_GET['page']) + 1 : 0);

//	First Step
if (($RecID == 0) || ($PageNum == 0)) {
    $sql = "SELECT MIN(recid), MAX(recid), COUNT(recid) FROM " . $xoopsDB->prefix("logcounterx_log");
    $res = $xoopsDB->query($sql);
    list($MinRecID, $MaxRecID, $TotalRecNum) = $xoopsDB->fetchRow($res);
    if ($TotalRecNum == 0) {
        redirect_header(XOOPS_URL . "/modules/logcounterx/admin/index.php", 3, 'End Of Job');
        exit();
    }
    $sql = "UPDATE " . $xoopsDB->prefix("logcounterx_log") . " SET agent = '', os = '', qword = ''";
    $res = $xoopsDB->queryF($sql);
    DisplayProcessing(0, $MinRecID, $TotalRecNum, $MaxRecID, $StepRecNum);
    exit();
}

//	Check Parameters
if (($MaxRecID == 0) || ($TotalRecNum == 0)) {
    redirect_header(XOOPS_URL . "/modules/logcounterx/admin/index.php", 3, 'Error!  --- Invalid Parameter');
    exit();
}

//	Last Step
if ($RecID + $StepRecNum > $MaxRecID) {
    $RecCnt = lcx_LogEval(" WHERE ($RecID <= recid) AND (recid <= $MaxRecID)");
    $sql    = "UPDATE " . $xoopsDB->prefix("logcounterx_cfg") . " SET cfgvalue = '$MaxRecID' WHERE cfgname = 'LAST_REPORT_RECID'";
    $res    = $xoopsDB->queryF($sql);
    redirect_header(XOOPS_URL . "/modules/logcounterx/admin/index.php", 1, 'End Of Job');
    exit();
}

$RecCnt = lcx_LogEval(" WHERE ($RecID <= recid) AND (recid < " . ($RecID + $StepRecNum) . ")");
DisplayProcessing($PageNum, $RecID + $StepRecNum, $TotalRecNum, $MaxRecID, $StepRecNum);
exit();

function DisplayProcessing($PageNum, $NextRecID, $TotalRecNum, $MaxRecID, $StepRecNum)
{
    header('Content-Type:text/html; charset=EUC-JP');
    header('Pragma: no-cache');
    print '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<meta http-equiv="content-type" content="text/html;charset=EUC-JP">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<style type="text/css">
body {background-color : #fcfcfc; font-size: 12px; font-family: Trebuchet MS,Verdana, Arial, Helvetica, sans-serif; margin: 0px;}
.redirect {width: 70%; margin: 110px; text-align: center; padding: 15px; border: #e0e0e0 1px solid; color: #666666; background-color: #f6f6f6;}
.redirect a:link {color: #666666; text-decoration: none; font-weight: bold;}
.redirect a:visited {color: #666666; text-decoration: none; font-weight: bold;}
.redirect a:hover {color: #999999; text-decoration: underline; font-weight: bold;}
</style>
<title>LogCounterX  ---  UPDATING DATA..</title>
</head>
<body onLoad="window.location=\'' . XOOPS_URL . '/modules/logcounterx/admin/rebuild.php?page=' . $PageNum . '&rec=' . $NextRecID . '&ttl=' . $TotalRecNum . '&max=' . $MaxRecID . '\'">
<div align="center">
<div class="redirect">
	<span style="font-size: 16px; font-weight: bold;">LogCounterX</span>
	<hr style="height: 3px; border: 3px #E18A00 solid; width: 95%;" />
	<p>Updating Database...  Wait a while. (' . ($PageNum * $StepRecNum + 1) . ' - ' . min((($PageNum + 1) * $StepRecNum), $TotalRecNum) . ' / ' . $TotalRecNum . ')</p>
</div>
</div>
</body>
</html>
';

    return;
}
