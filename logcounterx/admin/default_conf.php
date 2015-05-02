<?php
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

$DefConf                      = array();
$DefConf['IGNORE_HOST']       = '127.0.0.1';
$DefConf['IGNORE_REFERER']    = 'Irregular Expression';
$DefConf['REP_R2']            = '0';
$DefConf['REP_QW']            = '0';
$DefConf['REP_OS']            = '1';
$DefConf['REP_BR']            = '1';
$DefConf['REP_RC']            = '1';
$DefConf['REP_DR']            = '2';
$DefConf['REP_WD']            = '0';
$DefConf['REP_TM']            = '0';
$DefConf['REP_UN']            = '2';
$DefConf['REP_HN']            = '2';
$DefConf['REP_RF']            = '2';
$DefConf['REP_PI']            = '3';
$DefConf['REP_LINK']          = '1';
$DefConf['REP_ROBOT']         = '0';
$DefConf['REP_ROWLIMIT_ADM']  = '50';
$DefConf['REP_ROWLIMIT_USR']  = '30';
$DefConf['REP_ROWLIMIT']      = '30';
$DefConf['SHOW_DAY']          = '1';
$DefConf['SHOW_YESTERDAY']    = '1';
$DefConf['SHOW_WEEK']         = '0';
$DefConf['SHOW_MONTH']        = '0';
$DefConf['SHOW_AVE']          = '0';
$DefConf['IP_INTERVAL']       = '600';
$DefConf['LOG_LIMIT']         = '3000';
$DefConf['TIME_OFFSET']       = '0';
$DefConf['USE_GET_HOST']      = '0';
$DefConf['NO_ROBOT_COUNT']    = '0';
$DefConf['NO_HOST_COUNT']     = '0';
$DefConf['USE_IMGORCHR']      = '0';
$DefConf['USE_CHR_STYLE']     = '';
$DefConf['COUNT_BLOCK_SETUP'] = '0';
$DefConf['LAST_REPORT_RECID'] = '0';
$DefConf['USER_COOKIE']       = '1';
$DefConf['MAX_WIDTH']         = '240';
$DefConf['IMG_DIR']           = '';

foreach ($DefConf as $key => $val) {
    if (!preg_match('/^[A-Za-z0-9\-_]+$/', $key)) {
        exit();
    }
    if (!preg_match('/^[A-Za-z0-9\-_\.\s]*$/', $val)) {
        exit();
    }
}
