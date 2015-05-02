<?php
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

function b_logcounterx_show_counter($options)
{
    global $xoopsDB, $xoopsConfig;
    //	Get Configuration
    $CONF = array();
    $sql  = "SELECT cfgname, cfgvalue FROM " . $xoopsDB->prefix("logcounterx_cfg");
    $res  = $xoopsDB->query($sql);
    while (list($nam, $val) = $xoopsDB->fetchRow($res)) {
        $CONF[$nam] = $val;
    }

    if (!isset($CONF['USE_IMGORCHR'])) {
        $CONF['USE_IMGORCHR'] = 0;
    }
    if (!isset($CONF['USE_CHR_STYLE'])) {
        $CONF['USE_CHR_STYLE'] = '';
    }
    $block = array('use_char' => $CONF['USE_IMGORCHR'], 'style' => htmlspecialchars($CONF['USE_CHR_STYLE']));

    if (!isset($CONF['TIME_OFFSET'])) {
        $CONF['TIME_OFFSET'] = 0;
    }
    $nowtime   = time() + $CONF['TIME_OFFSET'] * 60 * 60;
    $dayofweek = date('w', $nowtime);
    $todayymd  = date('Y-m-d', $nowtime);
    $yesterday = date('Y-m-d', $nowtime - 86400);
    $thisweek  = date('Y-m-d', $nowtime - 86400 * (int)($dayofweek));
    $todayym1  = date('Y-m-%', $nowtime);
    $todayym2  = date('Y/m/%', $nowtime);
    $todayy    = date('Y%', $nowtime);

    //	TODAY
    if ($CONF['SHOW_DAY']) {
        $sql = "SELECT cnt FROM " . $xoopsDB->prefix("logcounterx_count") . " WHERE ymd = '$todayymd'";
        list($cnt) = $xoopsDB->fetchRow($xoopsDB->query($sql));
        $block['counts'][] = array('count' => $cnt, 'title' => _LCX_BLK_DAY, 'digits' => b_logcounterx_sub($cnt));
    }

    //	YESTERDAY
    if ($CONF['SHOW_YESTERDAY']) {
        $sql = "SELECT cnt FROM " . $xoopsDB->prefix("logcounterx_count") . " WHERE ymd = '$yesterday'";
        list($cnt) = $xoopsDB->fetchRow($xoopsDB->query($sql));
        $block['counts'][] = array('count' => $cnt, 'title' => _LCX_BLK_YESTERDAY, 'digits' => b_logcounterx_sub($cnt));
    }

    //	WEEK
    if ($CONF['SHOW_WEEK']) {
        $sql = "SELECT sum(cnt) as CNT FROM " . $xoopsDB->prefix("logcounterx_count") . " WHERE ymd >= '$thisweek'";
        list($cnt) = $xoopsDB->fetchRow($xoopsDB->query($sql));
        $block['counts'][] = array('count' => $cnt, 'title' => _LCX_BLK_WEEK, 'digits' => b_logcounterx_sub($cnt));
    }

    //	MONTH
    if ($CONF['SHOW_MONTH']) {
        $sql = "SELECT sum(cnt) as CNT FROM " . $xoopsDB->prefix("logcounterx_count") . " WHERE (ymd like '$todayym1') OR (ymd like '$todayym2')";
        list($cnt) = $xoopsDB->fetchRow($xoopsDB->query($sql));
        $block['counts'][] = array('count' => $cnt, 'title' => _LCX_BLK_MONTH, 'digits' => b_logcounterx_sub($cnt));
    }

    //	TOTAL
    $sql = "SELECT cnt FROM " . $xoopsDB->prefix("logcounterx_count") . " WHERE (ymd = '1111-11-11') OR (ymd = '1111/11/11')";
    list($cnt) = $xoopsDB->fetchRow($xoopsDB->query($sql));
    $block['counts'][] = array('count' => $cnt, 'title' => _LCX_BLK_TOTAL, 'digits' => b_logcounterx_sub($cnt));

    //	AVERAGE
    if ($CONF['SHOW_AVE']) {
        $sql = "SELECT count(ymd) AS DAYS, sum(cnt) as CNT FROM " . $xoopsDB->prefix("logcounterx_count") .
               " WHERE ymd > '1111-11-11'";
        list($days, $cnt) = $xoopsDB->fetchRow($xoopsDB->query($sql));
        if (($days != 0) && ($cnt != 0)) {
            $cnt               = ceil($cnt / $days);
            $block['counts'][] = array('count' => $cnt, 'title' => _LCX_BLK_AVE, 'digits' => b_logcounterx_sub($cnt));
        }
    }

    //	Image Directory & Attribute (width & height)
    $imagedir = '';
    if (!isset($CONF['IMG_DIR']) || !preg_match('/^[a-zA-Z_\-]*$/', $CONF['IMG_DIR'])) {
        $CONF['IMG_DIR'] = '';
    }
    if (($CONF['IMG_DIR'] != '') && file_exists(XOOPS_ROOT_PATH . '/modules/logcounterx/images/' . $CONF['IMG_DIR'] . '/0.gif')) {
        $imagedir = $CONF['IMG_DIR'] . '/';
    }
    if (file_exists(XOOPS_ROOT_PATH . '/modules/logcounterx/images/' . $xoopsConfig['theme_set'] . '/0.gif')) {
        $imagedir = $xoopsConfig['theme_set'] . '/';
    }
    $block['imagedir'] = $imagedir;
    $width             = 0;
    $height            = 0;
    $imageattr         = '';
    if (function_exists('getimagesize')) {
        list($width, $height, $type, $attr) = getimagesize(XOOPS_ROOT_PATH . '/modules/logcounterx/images/' . $imagedir . '0.gif');
        for ($i = 1; $i < 10; $i++) {
            list($width1, $height1, $type1, $attr1) = getimagesize(XOOPS_ROOT_PATH . '/modules/logcounterx/images/' . $imagedir . $i . '.gif');
            if ($width != $width1) {
                $width = 0;
            }
            if ($height != $height1) {
                $width = 0;
            }
        }
        if ($width != 0) {
            $imageattr .= ' width="' . $width . '" ';
        }
        if ($height != 0) {
            $imageattr .= ' height="' . $height . '" ';
        }
    }
    $block['imageattr'] = $imageattr;

    return $block;
}

function b_logcounterx_sub($cnt)
{
    global $imagesize;
    $ret = array();
    for ($i = 0; $i < strlen($cnt); $i++) {
        //	$ret['digit'][$i] = substr($cnt, $i, 1);
        $s = substr($cnt, $i, 1);
        if ($s != ',') {
            $ret[$i] = $s;
        }
    }
    if (empty($ret)) {
        return array('0');
    }

    return $ret;
}
