<?php
include_once "admin_header.php";

print	'
<table width="100%" border="0" cellspacing="1" cellpadding="8" class="outer">
<tr><td class="head" style="padding:8pt;"><a href="genadm.php">'._LCX_ADM_GENCONF.'</a></td>
<td class="odd">'._LCX_ADM_GENCONF_DESC.'</td></tr>
<tr><td class="head" style="padding:8pt;"><a href="logadm.php">'._LCX_ADM_LOGCONF.'</a></td>
<td class="odd">'._LCX_ADM_LOGCONF_DESC.'</td></tr>
<tr><td class="head" style="padding:8pt;"><a href="repadm.php">'._LCX_ADM_REPCONF.'</a></td>
<td class="odd">'._LCX_ADM_REPCONF_DESC.'</td></tr>
<tr><td class="head" style="padding:8pt;"><a href="imgslct.php">'._LCX_ADM_IMGSLCT.'</a></td>
<td class="odd">'._LCX_ADM_IMGSLCT_DESC.'</td></tr>
<tr><td class="head" style="padding:8pt;"><a href="rebuild.php">'._LCX_ADM_REBUILD.'</a></td>
<td class="odd">'._LCX_ADM_REBUILD_DESC.'</td></tr>
<tr><td class="head" style="padding:8pt;"><a href="uaos.php">'._LCX_ADM_BROS_NAME.'</a></td>
<td class="odd">'._LCX_ADM_BROS_DESC.'</td></tr>
<tr><td class="head" style="padding:8pt;"><a href="qwords.php">'._LCX_ADM_QWORDS_NAME.'</a></td>
<td class="odd">'._LCX_ADM_QWORDS_DESC.'</td></tr>
<tr><td class="head" style="padding:8pt;"><a href="db_check.php">'._LCX_ADM_DBCHECK.'</a></td>
<td class="odd">'._LCX_ADM_DBCHECK_DESC.'</td></tr>';
if (!defined('XOOPS_CUBE_LEGACY')) {
print	'
<tr><td class="head" style="padding:8pt;"><a href="myblocksadmin.php">'._LCX_ADM_BLOCKSADMIN.'</a></td>
<td class="odd">'._LCX_ADM_BLOCKSADMIN_DESC.'</td></tr>';
}
print '
</table>
';

//	Attack Checker Log
$LogFile = XOOPS_CACHE_PATH.'/logcounterx_'.md5(XOOPS_URL.XOOPS_ROOT_PATH.$xoopsDB->prefix('')).'.txt';
if (isset($_POST['op']) && ($_POST['op'] == 'DelAtkLog')) { @unlink($LogFile); }
$OldLog = '';
if (file_exists($LogFile)) {
	if ($fp = fopen($LogFile, 'r')) {
		while(!feof($fp)) { $OldLog .= fgets($fp, 4096); }
		fclose($fp);
	}
	print '<br /><table class="outer"><tr><th colspan="4">XSS Attack Checker Log</th></tr>';
	print '<tr class="head"><td>TIME</td><td>REFERER</td><td>REMOTE HOST</td><td>REQUEST</td></tr>';
	$C = ' class="odd"';
	foreach (explode("\n", $OldLog) as $Log) {
		if (trim($Log) == '') { continue; }
		$LogData = explode("\t", $Log);
		print '<tr'.$C.'><td>'.mysanitize($LogData[0]).'</td><td>'.mysanitize($LogData[1]).'</td><td>'.mysanitize($LogData[2]).'</td><td>'.mysanitize($LogData[3]).'</td></tr>';
		$C = (($C == ' class="odd"') ? ' class="even"' : ' class="odd"');
	}
	print '<tr><td colspan="4" align="right">';
	print '<form action="./index.php" method="post" style="margin:0;">';
	print '<input type="hidden" name="filename" value="'.$LogFile.'" />';
	print '<input type="hidden" name="op" value="DelAtkLog" />';
	print '<input type="submit" value="Delete Attack Check Log File" /></form>';
	print '</td></tr></table>';
}

include_once "admin_footer.php";

function mysanitize($str = '') {
	return htmlspecialchars($str);
}
?>