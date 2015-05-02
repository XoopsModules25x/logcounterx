<?php
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

include_once XOOPS_ROOT_PATH . "/modules/logcounterx/include/functions.php";

/**
 * @return string
 */
function b_logcounterx_inc_counter()
{
    global $xoopsDB, $xoopsUser;

    //	Attack Checker
    if (isset($_SERVER['QUERY_STRING']) && ($_SERVER['QUERY_STRING'] != '')) {
        $query = urldecode($_SERVER['QUERY_STRING']);
        if (preg_match('/(<script|javascript:|vbscript:|about:| xoops_")/i', str_replace(chr(0), '', $query))) {
            $LogFile = XOOPS_CACHE_PATH . '/logcounterx_' . md5(XOOPS_URL . XOOPS_ROOT_PATH . $xoopsDB->prefix('')) . '.txt';
            $OldLog  = '';
            if (file_exists($LogFile)) {
                if ($fp = fopen($LogFile, 'r')) {
                    while (!feof($fp)) {
                        $OldLog .= fgets($fp, 4096);
                    }
                    fclose($fp);
                }
            }
            $LogText = "" . date('Y-m-d H:i:s', time()) . "\t" . $_SERVER['HTTP_REFERER'] . "\t" . $_SERVER['REMOTE_HOST'] . "\t" . $_SERVER['PATH_INFO'] . '?' . $_SERVER['QUERY_STRING'] . "\n";
            if ($fp = fopen($LogFile, 'w')) {
                fwrite($fp, $LogText . $OldLog);
                fclose($fp);
            }
        }
    }

    //	Check If Theme was changed
    if (isset($_POST['xoops_theme_select']) && function_exists('glob')) {
        $blockcachefiles = glob(XOOPS_CACHE_PATH . '/blk_*lcx_block_display.html');
        if (!empty($blockcachefiles)) {
            foreach ($blockcachefiles as $f) {
                @unlink($f);
            }
        }
    }

    //	Check If Jump From Inner Page
    if (isset($_SERVER['HTTP_REFERER']) && preg_match('/^' . str_replace('/', '\/', XOOPS_URL) . '/', $_SERVER['HTTP_REFERER'])) {
        return '';
    }

    //	Get Environmental Values 1
    $HttpReferer = (isset($_SERVER['HTTP_REFERER']) ? urldecode($_SERVER['HTTP_REFERER']) : '');
    $RemoteAddr  = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
    $RemoteHost  = (isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : '');
    if ($RemoteHost == '') {
        $RemoteHost = $RemoteAddr;
    }
    $slashedRH = addslashes($RemoteHost);
    //	$PathInfo = (isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '');
    //	$PathInfo = (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '');
    //	$PathInfo = (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '');
    $PathInfo  = (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
    $UserAgent = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');

    //	Get Configuration
    $CONF = array();
    $res  = $xoopsDB->query("SELECT cfgname, cfgvalue FROM " . $xoopsDB->prefix("logcounterx_cfg"));
    while (list($key, $val) = $xoopsDB->fetchRow($res)) {
        $CONF[$key] = $val;
    }

    //	Get Environmental Values 2
    if (!isset($CONF['TIME_OFFSET'])) {
        $CONF['TIME_OFFSET'] = 0;
    }
    $NowTime = time() + $CONF['TIME_OFFSET'] * 60 * 60;
    $NowYMD  = date('Y-m-d', $NowTime);
    $NowHMS  = date('H:i:s', $NowTime);
    $NowHour = date('H', $NowTime);
    $NowWDay = date('w', $NowTime);
    $NowDate = date('Y/m/d', $NowTime);

    //	Initialize Parameters
    $CountUp = 1;

    //	Delete Old Access Data
    $xoopsDB->queryF("DELETE FROM " . $xoopsDB->prefix("logcounterx_ip") . " WHERE acctime < " . ($NowTime - $CONF['IP_INTERVAL']));

    //	Check If Count-Up or not
    $sql = "SELECT accip FROM " . $xoopsDB->prefix("logcounterx_ip") . " WHERE accip = '$slashedRH'";
    if ($xoopsDB->getRowsNum($xoopsDB->query($sql)) != 0) {
        //	Is It User's Access ?
        //if (($CONF['USER_COOKIE'] == 0) && ($HttpReferer == '') && is_object($xoopsUser)) {
        if (($HttpReferer == '') && is_object($xoopsUser)) {
            $sql = "SELECT recid, uname FROM " . $xoopsDB->prefix("logcounterx_log") .
                   " WHERE remote_host = '$slashedRH' ORDER BY accday DESC, acctime DESC LIMIT 1";
            list($recid, $uname) = $xoopsDB->fetchRow($xoopsDB->query($sql));
            if ($uname == '') {
                $UserName = addslashes($xoopsUser->uname());
                $sql      = "UPDATE " . $xoopsDB->prefix("logcounterx_log") . " SET uname='$UserName' WHERE recid = $recid";
                $res      = $xoopsDB->queryF($sql);
            }
        }
        $sql = "UPDATE " . $xoopsDB->prefix("logcounterx_ip") . " SET acctime = $NowTime WHERE accip = '$slashedRH'";
        $res = $xoopsDB->queryF($sql);

        return '';
    }

    //	Check If Host Ignored
    if (($CONF['NO_HOST_COUNT']) && isset($CONF['IGNORE_HOST'])) {
        $sql = "SELECT cfgvalue FROM " . $xoopsDB->prefix("logcounterx_cfg") . " WHERE (cfgname = 'IGNORE_HOST') AND ('$slashedRH' LIKE cfgvalue)";
        if ($xoopsDB->getRowsNum($xoopsDB->query($sql)) != 0) {
            $CountUp = 0;
        }
    }

    //	Check If ROBOT Access
    if (preg_match('/Robot/i', lcx_ua2br($UserAgent))) {
        $RobotCount = 1;
        if (($CountUp != 0) && $CONF['NO_ROBOT_COUNT']) {
            $CountUp = 0;
        }
    } else {
        $RobotCount = 0;
    }

    //	Access Data
    $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix("logcounterx_ip") . " (accip, acctime) VALUES ('$slashedRH', $NowTime)");

    //	Count Up
    if ($CountUp != 0) {
        if (function_exists('glob')) {
            $blockcachefiles = glob(XOOPS_CACHE_PATH . '/blk_*lcx_block_display.html');
            if (!empty($blockcachefiles)) {
                foreach ($blockcachefiles as $f) {
                    @unlink($f);
                }
            }
        }
        $xoopsDB->queryF("UPDATE " . $xoopsDB->prefix("logcounterx_count") . " SET cnt = (cnt + $CountUp), robot = (robot + $RobotCount) WHERE ymd = '1111-11-11'");
        $res = $xoopsDB->query("SELECT cnt FROM " . $xoopsDB->prefix("logcounterx_count") . " WHERE ymd = '$NowDate'");
        if ($xoopsDB->getRowsNum($res) == 0) {
            $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix("logcounterx_count") . " (ymd, cnt, robot) VALUES ('$NowDate', $CountUp, $RobotCount)");
        } else {
            $xoopsDB->queryF("UPDATE " . $xoopsDB->prefix("logcounterx_count") . " SET cnt = (cnt + $CountUp), robot = (robot + $RobotCount) WHERE ymd = '$NowDate'");
        }
        $xoopsDB->queryF("UPDATE " . $xoopsDB->prefix("logcounterx_hours") . " SET cnt = (cnt + $CountUp), robot = (robot + $RobotCount) WHERE hour = '$NowHour'");
    }
    $sql   = "SELECT cnt FROM " . $xoopsDB->prefix("logcounterx_count") . " WHERE ymd = '1111-11-11'";
    $total = 0;
    list($total) = $xoopsDB->fetchRow($xoopsDB->query($sql));

    //	Insert Data To Log
    if (($RemoteAddr == $RemoteHost) && ($CONF['USE_GET_HOST'])) {
        $RemoteHost = gethostbyaddr($RemoteAddr);
        $slashedRH  = addslashes($RemoteHost);
    } else {
        $slashedRH = '';
    }
    if ((trim($HttpReferer) != '') && !preg_match('/^(http:\/\/|https:\/\/|ftp:\/\/)/', trim($HttpReferer))) {
        $HttpReferer = '!' . trim($HttpReferer) . '!';
    }
    $UserName = '';
    if (is_object($xoopsUser)) {
        $UserName = $xoopsUser->getVar('uname');
    }
    // elseif (isset($_COOKIE['xoops_user'])) { $UserName = $_COOKIE['xoops_user']; }
    else {
        $UserName = '';
    }
    $sql = "INSERT INTO " . $xoopsDB->prefix("logcounterx_log") .
           " (remote_host, user_agent, path_info, referer, acccnt, uname, accday, acctime, accwday)" .
           "  VALUES " .
           " ('$slashedRH', '" . addslashes($UserAgent) . "', '" . addslashes($PathInfo) . "'," .
           " '" . addslashes($HttpReferer) . "', $total, '" . addslashes($UserName) . "', '$NowYMD', '$NowHMS', '$NowWDay')";
    $res = $xoopsDB->queryF($sql);

    $sql = "SELECT MAX(acccnt), COUNT(recid) FROM " . $xoopsDB->prefix("logcounterx_log");
    $res = $xoopsDB->query($sql);
    list($Max, $CNT) = $xoopsDB->fetchRow($res);
    if ($CNT > ($CONF['LOG_LIMIT'] * 1.1)) {
        $sql = "DELETE FROM " . $xoopsDB->prefix("logcounterx_log") . " WHERE acccnt < " . ($Max - $CONF['LOG_LIMIT']);
        $res = $xoopsDB->queryF($sql);
    }

    return '';
}
