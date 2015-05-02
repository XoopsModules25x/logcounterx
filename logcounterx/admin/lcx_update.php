<?php
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

/**
 * @param $module
 * @param $prev_version
 * @return bool
 */
function xoops_module_update_logcounterx(&$module, $prev_version)
{
    global $xoopsDB;
    if ($prev_version < 230) {
        //	Get Count from Database And Update it if Need (for Version Up)
        $res1 = $xoopsDB->query("SELECT cnt FROM " . $xoopsDB->prefix('logcounterx_count') . " WHERE ymd = '1111-11-11'");
        if ($xoopsDB->getRowsNum($res1) == 0) {
            $res2 = $xoopsDB->query("SELECT cnt FROM " . $xoopsDB->prefix('logcounterx_count') . " WHERE ymd = '0001-01-01'");
            if ($xoopsDB->getRowsNum($res2) == 0) {
                $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix('logcounterx_count') . " (ymd, cnt) VALUES ('1111-11-11', 0)");
            } else {
                $xoopsDB->queryF("UPDATE " . $xoopsDB->prefix('logcounterx_count') . " SET ymd = '1111-11-11' WHERE ymd = '0001-01-01'");
            }
        }
    }

    if ($prev_version < 260) {
        $sql1 = "SELECT cnt FROM " . $xoopsDB->prefix('logcounterx_count') . " WHERE ymd = '1111-11-11'";
        $res1 = $xoopsDB->query($sql1);
        if ($xoopsDB->getRowsNum($res1) == 0) {
            $sql2 = "SELECT cnt FROM " . $xoopsDB->prefix('logcounterx_count') . " WHERE ymd = '0001-01-01'";
            $res2 = $xoopsDB->query($sql2);
            if ($xoopsDB->getRowsNum($res2) == 0) {
                $sql3 = "INSERT INTO " . $xoopsDB->prefix('logcounterx_count') . " (ymd, cnt) VALUES ('1111-11-11', 0)";
                $res3 = $xoopsDB->queryF($sql3);
            } else {
                $sql3 = "UPDATE " . $xoopsDB->prefix('logcounterx_count') . " SET ymd = '1111-11-11' WHERE ymd = '0001-01-01'";
                $res3 = $xoopsDB->queryF($sql3);
            }
        }
        $sql = "CREATE TABLE " . $xoopsDB->prefix('logcounterx_hours') .
               "(hour char(2) NOT NULL, cnt int unsigned NOT NULL default 0, PRIMARY KEY (hour)) TYPE = MyISAM";
        $xoopsDB->queryF($sql);
    }

    if ($prev_version < 270) {
        $sql = "ALTER TABLE " . $xoopsDB->prefix('logcounterx_count') . " ADD robot int unsigned NOT NULL default 0";
        $xoopsDB->queryF($sql);
        $sql = "ALTER TABLE " . $xoopsDB->prefix('logcounterx_hours') . " ADD robot int unsigned NOT NULL default 0";
        $xoopsDB->queryF($sql);
    }

    //	Set up hours database
    $res = $xoopsDB->query("SELECT * FROM " . $xoopsDB->prefix('logcounterx_hours'));
    if ($xoopsDB->getRowsNum($res) != 24) {
        $HData = array();
        $sql   = "SELECT HOUR(acctime) AS H, COUNT(recid) FROM " . $xoopsDB->prefix('logcounterx_log') . " GROUP BY H";
        $res1  = $xoopsDB->query($sql);
        while (list($H, $C) = $xoopsDB->fetchRow($res1)) {
            $HData[(int)($H)] = (int)($C);
        }
        for ($i = 0; $i < 24; ++$i) {
            $hour = sprintf("%02d", $i);
            if (isset($HData[$i])) {
                $j = $HData[$i];
            } else {
                $j = 0;
            }
            $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix('logcounterx_hours') . " (hour, cnt) VALUES ('$hour', $j)");
        }
    }

    //	Add New Configulations
    $xoopsDB->queryF("DELETE FROM " . $xoopsDB->prefix('logcounterx_cfg') . " WHERE cfgvalue = ''");
    $CONF = array();
    $res  = $xoopsDB->query("SELECT cfgname, cfgvalue FROM " . $xoopsDB->prefix('logcounterx_cfg'));
    while (list($key, $val) = $xoopsDB->fetchRow($res)) {
        $CONF[$key] = $val;
    }
    include XOOPS_ROOT_PATH . '/modules/logcounterx/admin/default_conf.php';
    foreach ($DefConf as $cfgname => $cfgvalue) {
        if (!isset($CONF[$cfgname])) {
            if (!preg_match('/^[A-Za-z0-9\-_]+$/', $cfgname)) {
                continue;
            }
            if (!preg_match('/^[A-Za-z0-9\-_\s\.]*$/', $cfgvalue)) {
                continue;
            }
            $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix('logcounterx_cfg') . " (cfgname, cfgvalue) VALUES ('$cfgname', '$cfgvalue')");
        }
    }
    if (function_exists('glob')) {
        $blockcachefiles = glob(XOOPS_CACHE_PATH . '/blk_*lcx_block_display.html');
        foreach ($blockcachefiles as $f) {
            @unlink($f);
        }
    }

    return true;
}
