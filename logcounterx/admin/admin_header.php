<?php
include_once '../../../include/cp_header.php';

if (file_exists("../language/{$xoopsConfig['language']}/modinfo.php")) {
	include_once "../language/{$xoopsConfig['language']}/modinfo.php";
} else {
	include_once "../language/english/modinfo.php";
}

//	Get Configulation Data from Database
$CONF = array();
// $xoopsDB->queryF("DELETE FROM ".$xoopsDB->prefix('logcounterx_cfg')." WHERE cfgvalue = ''");
$sql = "SELECT cfgname, cfgvalue FROM ".$xoopsDB->prefix('logcounterx_cfg');
$res = $xoopsDB->query($sql);
while (list($key, $val) = $xoopsDB->fetchRow($res)) { $CONF[$key] = $val; }

//	Get Count from Database
$sql1 = "SELECT cnt FROM ".$xoopsDB->prefix('logcounterx_count')." WHERE ymd = '1111-11-11'";
$res1 = $xoopsDB->query($sql1);
list($cnt) = $xoopsDB->fetchRow($res1);
$cnt = intval($cnt);

//	Unlink (Delete) Block Cache
if (function_exists('glob')) {
	$blockcachefiles = glob(XOOPS_CACHE_PATH.'/blk_*lcx_block_display.html');
	if (!empty($blockcachefiles)) { foreach ($blockcachefiles as $f) { @unlink($f); } }
}

xoops_cp_header();

if (is_object($xoopsModule)) {
	$MyModVer = sprintf('%0.2f', $xoopsModule->getVar('version') / 100);
	$MyModName = $xoopsModule->getVar('name');
}

//	Display Header Menu
print	'<h4><a href="./">'.$MyModName._LCX_ADM_CONFIG.'</a> &nbsp;(LogCounterX ver.'.$MyModVer.')</h4>';
print	'<span style="float:right; margin-bottom:16px;">&nbsp;|&nbsp;';
include './menu.php';
foreach ($adminmenu as $eachmenu) {
	print '<a href="'.XOOPS_URL.'/modules/logcounterx/'.$eachmenu['link'].'">'.$eachmenu['title'].'</a>&nbsp;|&nbsp;';
}
print	'</span><br /><br />';
?>