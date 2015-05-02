<?php
include_once("../../mainfile.php");
include_once("./include/functions.php");

//	Parameters
define("Lcx_ShortLength", 64);
if (!defined('_CHARSET')) {
    define('_CHARSET', 'EUC-JP');
}

//	Initialize
define("Lcx_Log_DB", $xoopsDB->prefix("logcounterx_log"));
define("Lcx_Cfg_DB", $xoopsDB->prefix("logcounterx_cfg"));
define("Lcx_Cnt_DB", $xoopsDB->prefix("logcounterx_count"));
define("Lcx_Hrs_DB", $xoopsDB->prefix("logcounterx_hours"));

//	Get Configuration
$CONF          = array();
$IgnoreHost    = array();
$IgnoreReferer = array();
$res           = $xoopsDB->query("SELECT cfgname, cfgvalue FROM " . Lcx_Cfg_DB);
while (list($nam, $val) = $xoopsDB->fetchRow($res)) {
    if ($nam == 'IGNORE_HOST') {
        $IgnoreHost[] = $val;
    } elseif ($nam == 'IGNORE_REFERER') {
        $IgnoreReferer[] = $val;
    } else {
        $CONF[$nam] = $val;
    }
}

//	Recent Data Conversion
$MaxRecID = 0;
$res      = $xoopsDB->query("SELECT MAX(recid) FROM " . Lcx_Log_DB);
list($MaxRecID) = $xoopsDB->fetchRow($res);
$RecCnt = lcx_LogEval(" WHERE ((agent IS NULL) OR (agent = '') OR (os IS NULL) OR (os = ''))");
$res    = $xoopsDB->queryF("UPDATE " . Lcx_Cfg_DB . " SET cfgvalue = '$MaxRecID' WHERE cfgname = 'LAST_REPORT_RECID'");

//	Who Is It ?
if (is_object($xoopsUser)) {
    if ($xoopsUser->IsAdmin()) {
        $usr                = 2;
        $CONF['DATA_LIMIT'] = $CONF['REP_ROWLIMIT_ADM'];
    } else {
        $usr                = 1;
        $CONF['DATA_LIMIT'] = $CONF['REP_ROWLIMIT_USR'];
    }
} else {
    $usr                = 0;
    $CONF['DATA_LIMIT'] = $CONF['REP_ROWLIMIT'];
}
$CONF['MyUserType'] = $usr;

//	Re-set Ignore Flag
$sql = "UPDATE " . Lcx_Log_DB . " SET igflag = 0";
$res = $xoopsDB->queryF($sql);
foreach ($IgnoreHost as $hostname) {
    $xoopsDB->queryF("UPDATE " . Lcx_Log_DB . " SET igflag = 1 WHERE remote_host like '" . addslashes($hostname) . "'");
}
foreach ($IgnoreReferer as $referer) {
    if ($referer != '') {
        $xoopsDB->queryF("UPDATE " . Lcx_Log_DB . " SET igflag = 1 WHERE referer like '%" . addslashes($referer) . "%'");
    }
}

//	Set Ignore ROBOT
if ($CONF['REP_ROBOT'] == 1) {
    $xoopsDB->queryF("UPDATE " . Lcx_Log_DB . " SET igflag = 1 WHERE agent LIKE 'Robot%'");
} elseif ($CONF['REP_ROBOT'] == 2) {
    $xoopsDB->queryF("UPDATE " . Lcx_Log_DB . " SET igflag = 1 WHERE agent NOT LIKE 'Robot%'");
}

//	Delete Old Data
$res = $xoopsDB->query("SELECT COUNT(recid) FROM " . Lcx_Log_DB);
list($log_count) = $xoopsDB->fetchRow($res);
$limit = (int)($CONF['LOG_LIMIT']);
if ((0 < $limit) && ($limit < (int)($log_count))) {
    $res = $xoopsDB->query("SELECT MAX(recid) AS MAXC FROM " . Lcx_Log_DB);
    list($id_max) = $xoopsDB->fetchRow($res);
    $xoopsDB->queryF("DELETE FROM " . Lcx_Log_DB . " WHERE recid <= " . ($id_max - $limit));
}

//	Header
include("../../header.php");
$xoopsOption['template_main'] = "report.html";
$xoopsTpl->assign('cfg', $CONF);

//	Report Header
$res = $xoopsDB->query("SELECT COUNT(recid) FROM " . Lcx_Log_DB);
list($log_count) = $xoopsDB->fetchRow($res);
$xoopsTpl->assign('log_count', $log_count);
$sql = "SELECT MAX(accday) AS LDAY, MIN(accday) AS SDAY FROM " . Lcx_Log_DB . "  WHERE igflag = 0";
$res = $xoopsDB->query($sql);
list($lastday, $strtday) = $xoopsDB->fetchRow($res);
$xoopsTpl->assign('lastday', $lastday);
$xoopsTpl->assign('strtday', $strtday);

//	Referer (Short)
if ($usr >= $CONF['REP_R2']) {
    $sql    = "SELECT ref_short AS NAM, COUNT(recid) AS CNT, MAX(recid) AS REC FROM " . Lcx_Log_DB .
              " WHERE ((igflag = 0) AND (ref_short <> '') AND (ref_short IS NOT NULL))" .
              " GROUP BY NAM ORDER BY CNT DESC, REC DESC";
    $MyData = set_log_data($sql, $CONF['DATA_LIMIT'], $CONF['MAX_WIDTH']);
    $xoopsTpl->assign('ref_short', array('Title' => _LCX_BY_R2, 'Data' => $MyData));
}

//	Query Words
if ($usr >= $CONF['REP_QW']) {
    $sql    = "SELECT qword AS NAM, COUNT(recid) AS CNT, MAX(recid) AS REC FROM " . Lcx_Log_DB .
              " WHERE ((igflag = 0) AND (qword <> '') AND (qword IS NOT NULL))" .
              " GROUP BY NAM ORDER BY CNT DESC, REC DESC";
    $MyData = set_log_data($sql, $CONF['DATA_LIMIT'], $CONF['MAX_WIDTH']);
    $xoopsTpl->assign('qword', array('Title' => _LCX_BY_QW, 'Data' => $MyData));
}

//	OS
if ($usr >= $CONF['REP_OS']) {
    $sql    = "SELECT os AS NAM, COUNT(recid) AS CNT, MAX(recid) AS REC FROM " . Lcx_Log_DB .
              " WHERE ((igflag = 0) AND (os <> '') AND (os IS NOT NULL))" .
              " GROUP BY NAM ORDER BY CNT DESC, REC DESC";
    $MyData = set_log_data($sql, $CONF['DATA_LIMIT'], $CONF['MAX_WIDTH']);
    $xoopsTpl->assign('os', array('Title' => _LCX_BY_OS, 'Data' => $MyData));
}

//	Browser
if ($usr >= $CONF['REP_BR']) {
    $sql    = "SELECT agent AS NAM, COUNT(recid) AS CNT, MAX(recid) AS REC FROM " . Lcx_Log_DB .
              " WHERE ((igflag = 0) AND (agent <> '') AND (agent IS NOT NULL))" .
              " GROUP BY NAM ORDER BY CNT DESC, REC DESC";
    $MyData = set_log_data($sql, $CONF['DATA_LIMIT'], $CONF['MAX_WIDTH']);
    $xoopsTpl->assign('browser', array('Title' => _LCX_BY_BR, 'Data' => $MyData));
}

if (($usr >= $CONF['REP_RC']) || ($usr >= $CONF['REP_DR'])) {
    $res = $xoopsDB->query("SELECT MAX(cnt) FROM " . Lcx_Cnt_DB . " WHERE ymd like '20%'");
    list($MaxDayCount) = $xoopsDB->fetchRow($res);
    $MaxDayCount = (int)($MaxDayCount);
}

//	Recent Days
if (($MaxDayCount > 0) && ($usr >= $CONF['REP_RC'])) {
    $MyData   = array();
    $RecCount = 0;
    $sql      = "SELECT ymd, cnt, robot FROM " . Lcx_Cnt_DB . " WHERE ymd like '20%' ORDER BY ymd DESC";
    $res      = $xoopsDB->query($sql, $CONF['DATA_LIMIT']);
    while (list($MyName, $MyCount, $MyRobot) = $xoopsDB->fetchRow($res)) {
        $MyCount             = (int)($MyCount);
        $MyRobot             = (int)($MyRobot);
        $MyDisplayName       = htmlspecialchars($MyName);
        $MyData[$RecCount++] = array(
            'Name'         => $MyDisplayName, 'Count' => $MyCount, 'FormattedCount' => number_format($MyCount),
            'Robot'        => $MyRobot, 'NoRobot' => ($MyCount - $MyRobot),
            'Width'        => ceil($CONF['MAX_WIDTH'] * $MyCount / $MaxDayCount),
            'RobotWidth'   => ceil($CONF['MAX_WIDTH'] * $MyRobot / $MaxDayCount),
            'NoRobotWidth' => ceil($CONF['MAX_WIDTH'] * ($MyCount - $MyRobot) / $MaxDayCount)
        );
    }
    $xoopsTpl->assign('recent', array('Title' => _LCX_BY_RC, 'Data' => $MyData));
}

//	Record Days
if (($MaxDayCount > 0) && ($usr >= $CONF['REP_DR'])) {
    $MyData   = array();
    $RecCount = 0;
    $sql      = "SELECT ymd, cnt, robot FROM " . Lcx_Cnt_DB . " WHERE ymd like '20%' ORDER BY cnt DESC, ymd DESC";
    $res      = $xoopsDB->query($sql, $CONF['DATA_LIMIT']);
    while (list($MyName, $MyCount, $MyRobot) = $xoopsDB->fetchRow($res)) {
        $MyCount             = (int)($MyCount);
        $MyRobot             = (int)($MyRobot);
        $MyDisplayName       = htmlspecialchars($MyName);
        $MyData[$RecCount++] = array(
            'Name'         => $MyDisplayName, 'Count' => $MyCount, 'FormattedCount' => number_format($MyCount),
            'Robot'        => $MyRobot, 'NoRobot' => ($MyCount - $MyRobot),
            'Width'        => ceil($CONF['MAX_WIDTH'] * $MyCount / $MaxDayCount),
            'RobotWidth'   => ceil($CONF['MAX_WIDTH'] * $MyRobot / $MaxDayCount),
            'NoRobotWidth' => ceil($CONF['MAX_WIDTH'] * ($MyCount - $MyRobot) / $MaxDayCount)
        );
    }
    $xoopsTpl->assign('record', array('Title' => _LCX_BY_DR, 'Data' => $MyData));
}

//	Day of the Week
if ($usr >= $CONF['REP_WD']) {
    $sql        = "SELECT (DAYOFWEEK(ymd) - 1) AS W, SUM(cnt) as C, 1 AS DUMMY FROM " . Lcx_Cnt_DB . " WHERE ymd like '20%' GROUP BY W ORDER BY W";
    $MyTempData = set_log_data($sql, 7);
    $MyData     = array();
    for ($i = 0; $i < 7; ++$i) {
        $MyData[$i] = array('Width' => 0, 'Count' => 0, 'Percent' => 0);
        for ($j = 0; $j < 7; $j++) {
            if (isset($MyTempData[$j]['Name']) && ($MyTempData[$j]['Name'] == (string) ($i))) {
                $MyData[$i] = $MyTempData[$j];
            }
        }
    }
    $MyData[0]['Name'] = _LCX_Sun;
    $MyData[1]['Name'] = _LCX_Mon;
    $MyData[2]['Name'] = _LCX_Tue;
    $MyData[3]['Name'] = _LCX_Wed;
    $MyData[4]['Name'] = _LCX_Thu;
    $MyData[5]['Name'] = _LCX_Fri;
    $MyData[6]['Name'] = _LCX_Sat;
    $xoopsTpl->assign('weekday', array('Title' => _LCX_BY_WD, 'Data' => $MyData));
}

//	Time
if ($usr >= $CONF['REP_TM']) {
    $MyData = array();
    for ($i = 0; $i < 24; ++$i) {
        $MyData[$i] = array('Name' => sprintf('%02d', $i), 'Count' => 0, 'FormattedCount' => 0, 'Robot' => 0, 'NoRobot' => 0);
    }
    $SumCount    = 0;
    $MaxDayCount = 0;
    $sql         = "SELECT hour AS H, cnt AS C, robot AS R, 1 AS DUMMY FROM " . Lcx_Hrs_DB . " ORDER BY hour";
    $res         = $xoopsDB->query($sql);
    while (list($MyName, $MyCount, $MyRobot, $Dummy) = $xoopsDB->fetchRow($res)) {
        $i = (int)($MyName);
        if (($i < 0) || (23 < $i)) {
            continue;
        }
        $MyCount                      = (int)($MyCount);
        $MyRobot                      = (int)($MyRobot);
        $MyData[$i]['Count']          = $MyCount;
        $MyData[$i]['FormattedCount'] = number_format($MyCount);
        $MyData[$i]['Robot']          = $MyRobot;
        $MyData[$i]['NoRobot']        = $MyCount - $MyRobot;
        $SumCount += $MyCount;
        if ($MaxDayCount < $MyCount) {
            $MaxDayCount = $MyCount;
        }
    }
    if ($SumCount == 0) {
        $SumCount = 1;
    }
    if ($MaxDayCount == 0) {
        $MaxDayCount = 1;
    }
    for ($i = 0; $i < 24; ++$i) {
        $MyData[$i]['Percent']      = round($MyData[$i]['Count'] * 100 / $SumCount);
        $MyData[$i]['Width']        = ceil($CONF['MAX_WIDTH'] * $MyData[$i]['Count'] / $MaxDayCount);
        $MyData[$i]['RobotWidth']   = ceil($CONF['MAX_WIDTH'] * $MyData[$i]['Count'] / $MaxDayCount);
        $MyData[$i]['NoRobotWidth'] = ceil($CONF['MAX_WIDTH'] * ($MyData[$i]['Count'] - $MyData[$i]['Robot']) / $MaxDayCount);
    }
    $xoopsTpl->assign('hours', array('Title' => _LCX_BY_TM, 'Data' => $MyData));
}
/*
if ($usr >= $CONF['REP_TM']) {
    $sql =	"SELECT hour AS H, cnt AS C, 1 AS DUMMY FROM ".Lcx_Hrs_DB." ORDER BY hour";
    $MyTempData = set_log_data($sql, 24, $CONF['MAX_WIDTH']);
    $MyData = array();
    for ($i = 0; $i < 24; ++$i) {
        if (isset($MyTempData[(string) ($i)])) { $MyData[$i] = $MyTempData[(string) ($i)]; }
        else { $MyData[$i] = array('Width' => 0, 'Count' => 0, 'Percent' => 0); }
        $MyData[$i]['Name'] = sprintf('%02d', $i);
    }
    $xoopsTpl->assign('hours', array('Title' => _LCX_BY_TM, 'Data' => $MyData));
}
*/
//	Remote Host
if ($usr >= $CONF['REP_HN']) {
    $sql    = "SELECT rh_short AS NAM, COUNT(recid) AS CNT, MAX(recid) AS REC FROM " . Lcx_Log_DB .
              " WHERE ((igflag = 0) AND (rh_short <> '') AND (rh_short IS NOT NULL))" .
              " GROUP BY NAM ORDER BY CNT DESC, REC DESC";
    $MyData = set_log_data($sql, $CONF['DATA_LIMIT'], $CONF['MAX_WIDTH']);
    $xoopsTpl->assign('host', array('Title' => _LCX_BY_HN, 'Data' => $MyData));
}

//	User
if ($usr >= $CONF['REP_UN']) {
    $sql    = "SELECT uname AS NAM, COUNT(recid) AS CNT, MAX(recid) AS REC FROM " . Lcx_Log_DB .
              " WHERE ((igflag = 0) AND (uname <> '') AND (uname IS NOT NULL))" .
              " GROUP BY NAM ORDER BY CNT DESC, REC DESC";
    $MyData = set_log_data($sql, $CONF['DATA_LIMIT'], $CONF['MAX_WIDTH']);
    $xoopsTpl->assign('uname', array('Title' => _LCX_BY_UN, 'Data' => $MyData));
}

//	Referer
if ($usr >= $CONF['REP_RF']) {
    $sql        = "SELECT referer AS NAM, COUNT(recid) AS CNT, 1 AS DUMMY" .
                  " FROM " . Lcx_Log_DB . " WHERE (igflag = 0) AND (referer like 'http%') GROUP BY NAM ORDER BY acccnt DESC";
    $MyTempData = set_log_data($sql, $CONF['DATA_LIMIT'], $CONF['MAX_WIDTH'] / 5);
    $MyData     = array();
    foreach ($MyTempData as $Data) {
        if (($Data['RowName'] == 'unknown') || preg_match('/\+\+\+\+\+\+\+\+\+\+/', $Data['RowName'])) {
            continue;
        }
        $MyName = $Data['RowName'];
        if (extension_loaded('mbstring')) {
            if (mb_detect_encoding($MyName, 'auto') != '') {
                $MyName = mb_convert_encoding($MyName, _CHARSET, 'auto');
            }
            $MyShortName = $MyName;
            if (mb_strwidth($MyName) > Lcx_ShortLength) {
                $MyShortName = mb_strimwidth($MyName, 0, Lcx_ShortLength - 3, ' ..');
            }
        } else {
            $MyShortName = $MyName;
            if (strlen($MyName) > Lcx_ShortLength) {
                $MyShortName = substr($MyName, 0, Lcx_ShortLength - 3) . ' ..';
            }
        }
        $MyData[] = array('Name' => htmlspecialchars($MyName), 'Link' => $Data['Link'], 'Count' => $Data['Count'], 'FormattedCount' => $Data['FormattedCount'], 'ShortName' => htmlspecialchars($MyShortName), 'Width' => $CONF['MAX_WIDTH']);
    }
    $xoopsTpl->assign('referer', array('Title' => _LCX_BY_RF, 'Data' => $MyData));
}

//	Referer2 (No Robots)
if ($usr >= $CONF['REP_RF']) {
    $sql        = "SELECT referer AS NAM, COUNT(recid) AS CNT, 1 AS DUMMY" .
                  " FROM " . Lcx_Log_DB . " WHERE (igflag = 0) AND (referer like 'http%')" .
                  " AND (agent NOT LIKE 'Robot%') AND (qword = '') GROUP BY NAM ORDER BY acccnt DESC";
    $MyTempData = set_log_data($sql, $CONF['DATA_LIMIT'], $CONF['MAX_WIDTH'] / 5);
    $MyData2    = array();
    foreach ($MyTempData as $Data) {
        if (($Data['RowName'] == 'unknown') || preg_match('/\+\+\+\+\+\+\+\+\+\+/', $Data['RowName'])) {
            continue;
        }
        $MyName = $Data['RowName'];
        if (extension_loaded('mbstring')) {
            if (mb_detect_encoding($MyName, 'auto') != '') {
                $MyName = mb_convert_encoding($MyName, _CHARSET, 'auto');
            }
            $MyShortName = $MyName;
            if (mb_strwidth($MyName) > Lcx_ShortLength) {
                $MyShortName = mb_strimwidth($MyName, 0, Lcx_ShortLength - 3, ' ..');
            }
        } else {
            $MyShortName = $MyName;
            if (strlen($MyName) > Lcx_ShortLength) {
                $MyShortName = substr($MyName, 0, Lcx_ShortLength - 3) . ' ..';
            }
        }
        $MyData2[] = array('Name' => htmlspecialchars($MyName), 'Link' => $Data['Link'], 'Count' => $Data['Count'], 'FormattedCount' => $Data['FormattedCount'], 'ShortName' => htmlspecialchars($MyShortName), 'Width' => $CONF['MAX_WIDTH']);
    }
    $xoopsTpl->assign('referer2', array('Title' => _LCX_BY_RF, 'Data' => $MyData2));
}

//	Path Info
if ($usr >= $CONF['REP_PI']) {
    $sql    = "SELECT path_info AS NAM, COUNT(recid) AS CNT, MAX(recid) AS REC FROM " . Lcx_Log_DB .
              " WHERE ((igflag = 0) AND (path_info <> '') AND (path_info IS NOT NULL))" .
              " GROUP BY NAM ORDER BY CNT DESC, REC DESC";
    $MyData = set_log_data($sql, $CONF['DATA_LIMIT'], $CONF['MAX_WIDTH'] / 5);
    $xoopsTpl->assign('pathinfo', array('Title' => _LCX_BY_PI, 'Data' => $MyData));
}

include_once("../../footer.php");

/**
 * @param     $sql
 * @param int $limit
 * @param int $imgw
 * @return array
 */
function set_log_data($sql, $limit = 24, $imgw = 0)
{
    global $xoopsDB, $CONF;
    $MyData   = array();
    $RecCount = 0;
    $MaxCount = 0;
    $SumCount = 0;
    if ($limit == 0) {
        $limit = $CONF['DATA_LIMIT'];
    }
    if ($imgw == 0) {
        $imgw = $CONF['MAX_WIDTH'];
    }
    $res = $xoopsDB->query($sql, $limit);
    while (list($MyName, $MyCount, $dummy) = $xoopsDB->fetchRow($res)) {
        $MyCount = (int)($MyCount);
        $MyLink  = '';
        if ($CONF['REP_LINK'] <= $CONF['MyUserType']) {
            if (preg_match('/^(http:\/\/|https:\/\/)([^\?]+)/', $MyName, $matches1)) {
                if (!preg_match('/^(10\.[\d\.]*|172\.[\d\.]*|127\.[\d\.]*|192\.168\.[\d\.]*|169\.254\.[\d\.]*|[^\.\/]*)\//i', $matches1[2])) {
                    $MyLink = $matches1[1] . $matches1[2];
                    if (preg_match('/^([^\?]+)(\?)(.+)$/', $MyName, $matches2)) {
                        $qstr = $matches2[3];
                        if (strstr($qstr, '=')) {
                            $myqstr = '';
                            $sep    = '';
                            foreach (explode('&', $qstr) as $pair) {
                                list($key, $val) = explode('=', $pair);
                                $myqstr .= $sep . htmlspecialchars($key) . '=' . urlencode($val);
                                $sep = '&amp;';
                            }
                        } else {
                            $myqstr = urlencode($qstr);
                        }
                        $MyLink = $MyLink . '?' . $myqstr;
                    }
                }
            }
        }
        $SumCount += $MyCount;
        if ($MyCount > $MaxCount) {
            $MaxCount = $MyCount;
        }
        $MyRowName = $MyName;
        if (extension_loaded('mbstring')) {
            if (mb_strwidth($MyName) > Lcx_ShortLength) {
                $MyShortName = htmlspecialchars(mb_strimwidth($MyName, 0, Lcx_ShortLength - 3, ' ..'), ENT_QUOTES);
            } else {
                $MyShortName = htmlspecialchars($MyName, ENT_QUOTES);
            }
        } else {
            if (strlen($MyName) > Lcx_ShortLength) {
                $MyShortName = htmlspecialchars(substr($MyName, 0, Lcx_ShortLength - 3)) . ' ..';
            } else {
                $MyShortName = htmlspecialchars($MyName);
            }
        }
        $MyDisplayName       = htmlspecialchars($MyName);
        $MyData[$RecCount++] = array('Name' => $MyDisplayName, 'RowName' => $MyRowName, 'ShortName' => $MyShortName, 'Link' => $MyLink, 'Count' => $MyCount, 'FormattedCount' => number_format($MyCount));
    }
    if ($MaxCount > 0) {
        for ($i = 0; $i < $RecCount; ++$i) {
            $MyData[$i]['Width']   = ceil($imgw * $MyData[$i]['Count'] / $MaxCount);
            $MyData[$i]['Percent'] = round($MyData[$i]['Count'] * 100 / $SumCount);
        }
    }

    return $MyData;
}
