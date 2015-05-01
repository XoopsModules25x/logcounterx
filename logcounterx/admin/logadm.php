<?php
include_once "admin_header.php";
$myts =& MyTextSanitizer::getInstance();

//	Update Database
if (isset($_POST['command'])) {
	if ($_POST['command'] == 'RESETCOUNT') {
		$cnt = intval($_POST['count']);
		$sql = "SELECT cnt FROM ".$xoopsDB->prefix('logcounterx_count')." WHERE ymd = '1111-11-11'";
		$res = $xoopsDB->query($sql);
		if ($xoopsDB->getrowsNum($res) == 0) {
			$sql1 = "INSERT INTO ".$xoopsDB->prefix('logcounterx_count')." (ymd, cnt) VALUES ('1111-11-11', $cnt)";
			$res1 = $xoopsDB->query($sql1);
		} else {
			$sql1 = "UPDATE ".$xoopsDB->prefix("logcounterx_count")." SET cnt = $cnt WHERE ymd = '1111-11-11'";
			$res1 = $xoopsDB->query($sql1);
		}
	}
	if ($_POST['command'] == 'TIMEOFFSET') {
		if ($CONF['TIME_OFFSET'] != intval($_POST['TIME_OFFSET'])) {
			$CONF['TIME_OFFSET'] = intval($_POST['TIME_OFFSET']);
			$sql = "UPDATE " . $xoopsDB->prefix("logcounterx_cfg") .
			       " SET cfgvalue = '${CONF['TIME_OFFSET']}' WHERE cfgname = 'TIME_OFFSET'";
			$res = $xoopsDB->query($sql);
			$sql = "DELETE FROM ".$xoopsDB->prefix("logcounterx_ip");
			$res = $xoopsDB->query($sql);
		}
		$sql = "UPDATE ".$xoopsDB->prefix("logcounterx_hours")." SET cnt = 0, robot = 0";
		$res = $xoopsDB->query($sql);
	}
	if ($_POST['command'] == 'REPROBOT') {
		$CONF['REP_ROBOT'] = intval($_POST['REP_ROBOT']);
		$sql = "UPDATE ".$xoopsDB->prefix("logcounterx_cfg").
		       " SET cfgvalue = '${CONF['REP_ROBOT']}' WHERE cfgname = 'REP_ROBOT'";
		$res = $xoopsDB->query($sql);
	}
	if (($_POST['command'] == 'ADDIP') && ($_POST['addr'] != '')) {
		$sql = "SELECT cfgvalue FROM ". $xoopsDB->prefix("logcounterx_cfg").
		       " WHERE (cfgname = 'IGNORE_HOST') AND (cfgvalue = '".addslashes($myts->stripSlashesGPC($_POST['addr']))."')";
		if ($xoopsDB->getrowsNum($xoopsDB->query($sql)) == 0) {
			$sql1 = "INSERT INTO " . $xoopsDB->prefix("logcounterx_cfg").
			       " (cfgname, cfgvalue) VALUES ('IGNORE_HOST', '".addslashes($myts->stripSlashesGPC($_POST['addr']))."')";
			$res1 = $xoopsDB->query($sql1);
		}
	}
	if ($_POST['command'] == 'DELETEIP') {
		for ($i = 1; $i <= intval($_POST['count']); $i++) {
			if (isset($_POST['mark' . $i]) && ($_POST['mark' . $i] == 'on')) {
				$sql = "DELETE FROM " . $xoopsDB->prefix("logcounterx_cfg").
				       " WHERE recid = ".intval($_POST['id' . $i])." AND cfgname = 'IGNORE_HOST'";
				$res = $xoopsDB->query($sql);
			}
		}
	}
	if (($_POST['command'] == 'ADDREF') && ($_POST['referer'] != '')) {
		$sql = "SELECT cfgvalue FROM ". $xoopsDB->prefix("logcounterx_cfg").
		       " WHERE (cfgname = 'IGNORE_REFERER') AND (cfgvalue = '".addslashes($myts->stripSlashesGPC($_POST['referer']))."')";
		if ($xoopsDB->getrowsNum($xoopsDB->query($sql)) == 0) {
			$sql1 = "INSERT INTO " . $xoopsDB->prefix("logcounterx_cfg").
			       " (cfgname, cfgvalue) VALUES ('IGNORE_REFERER', '".addslashes($myts->stripSlashesGPC($_POST['referer']))."')";
			$res1 = $xoopsDB->query($sql1);
		}
	}
	if ($_POST['command'] == 'DELETEREF') {
		for ($i = 1; $i <= intval($_POST['count']); $i++) {
			if (isset($_POST['mark' . $i]) && ($_POST['mark' . $i] == 'on')) {
				$sql = "DELETE FROM " . $xoopsDB->prefix("logcounterx_cfg").
				       " WHERE recid = ".intval($_POST['id' . $i])." AND cfgname = 'IGNORE_REFERER'";
				$res = $xoopsDB->query($sql);
			}
		}
	}
	if ($_POST['command'] == 'LOGCFG') {
		foreach (array('NO_ROBOT_COUNT', 'NO_HOST_COUNT', 'USE_GET_HOST', 'USER_COOKIE') as $key) {
			if (isset($_POST[$key]) && ($_POST[$key] != $CONF[$key])) {
				$CONF[$key] = intval($_POST[$key]);
				$sql = "UPDATE ".$xoopsDB->prefix('logcounterx_cfg')." SET cfgvalue = '${CONF[$key]}'".
				       " WHERE cfgname = '$key'";
				$res = $xoopsDB->query($sql);
			}
		}
	}
}

//	Get Count
//	$sql = "SELECT cnt FROM " . $xoopsDB->prefix("logcounterx_count") . " WHERE ymd = '1111-11-11'";
//	list($cnt) = $xoopsDB->fetchRow($xoopsDB->query($sql));
$sql = "SELECT MAX(acccnt) FROM " . $xoopsDB->prefix("logcounterx_log");
list($AccCnt) = $xoopsDB->fetchRow($xoopsDB->query($sql));

//	form - Reset Total Count
print '
<table class="outer" cellSpacing="1" width="100%">
<tr><th colspan="2"><form name="form1" method="post" action="logadm.php" style="margin-bottom:0;">'._LCX_ADM_LOGCONF.'</th></tr>
<tr valign="top" align="left">
<td class="head">'._LCX_ADM_RESETCOUNT_TITLE.'<br /><br />
<span style="FONT-WEIGHT: normal">'._LCX_ADM_RESETCOUNT_DESC.'</span></td>
<td class="even">
<input type="text" size="12" name="count" value="'.$cnt.'" />
<input type="hidden" name="command" value="RESETCOUNT" />
<input type="submit" value="'._SUBMIT.'" name="save" /><br />
'.intval($AccCnt).'  '._LCX_ADM_LOGCOUNT_TITLE.'
</form>
</td>
</tr>';

//	form - Time Offset
print '
<tr><th colspan="2" height="3">
<form name="form11" method="post" action="logadm.php" style="margin-bottom:0;">
</th></tr>
<tr valign="top" align="left">
<td class="head">'._LCX_ADM_TIMEOFFSET_NAME.'<br /><br />
<span style="FONT-WEIGHT: normal">'._LCX_ADM_TIMEOFFSET_DESC.'</span></td>
<td class="even">
<input type="text" size="12" name="TIME_OFFSET" value="'.$CONF['TIME_OFFSET'].'" />
<input type="hidden" name="command" value="TIMEOFFSET" />
<input type="submit" value="'._SUBMIT.'" name="save" /><br />
'._LCX_ADM_TIMEOFFSET_SVTM.date('Y-m-d H:i:s', time()).'<br />
'._LCX_ADM_TIMEOFFSET_ADTM.date('Y-m-d H:i:s', time() + $CONF['TIME_OFFSET'] * 60 * 60).'
</form>
</td>
</tr>';

//	form - CountUp & GethostByAddr
print '
<tr><th colspan="2" height="3">
<form name="form2" method="post" action="logadm.php" style="margin-bottom:0;">
</th></tr>
';
print_input_area ('NO_ROBOT_COUNT',	$CONF['NO_ROBOT_COUNT'],_LCX_ADM_NOROBCNT_NAME,	_LCX_ADM_NOROBCNT_DESC,	'yesno');
print_input_area ('NO_HOST_COUNT',	$CONF['NO_HOST_COUNT'],	_LCX_ADM_NOHSTCNT_NAME,	_LCX_ADM_NOHSTCNT_DESC,	'yesno');
// print_input_area ('USER_COOKIE',	$CONF['USER_COOKIE'],	_LCX_ADM_USER_COOKIE_NAME,	_LCX_ADM_USER_COOKIE_DESC,	'yesno');
print_input_area ('USE_GET_HOST',	$CONF['USE_GET_HOST'],	_LCX_ADM_GETHOST_NAME,	_LCX_ADM_GETHOST_DESC,	'yesno');
print '
<tr><td class="head"></td>
<td class="even">
<input type="hidden" name="command" value="LOGCFG" />
<input type="submit" value="'._SUBMIT.'" name="save" /><br />
</td>
</tr>
</form>';

//	form - Report ROBOT
print '
<tr><th colspan="2" height="3">
<form name="form2" method="post" action="logadm.php" style="margin-bottom:0;">
</th></tr>
<tr valign="top" align="left">
<td class="head">'._LCX_ADM_REPORTING_TITLE.'<br /><br />
<span style="FONT-WEIGHT: normal">'._LCX_ADM_REPORTING_DESC.'</span></td>
<td class="even">
<input type="radio" name="REP_ROBOT" value="0"'.(($CONF['REP_ROBOT'] == 0) ? ' style="background-color:#00FF00;" checked="checked"' : '').' />'._LCX_ADM_REPORTING_ALL.'
<input type="radio" name="REP_ROBOT" value="1"'.(($CONF['REP_ROBOT'] == 1) ? ' style="background-color:#00FF00;" checked="checked"' : '').' />'._LCX_ADM_REPORTING_WORBT.'
<input type="radio" name="REP_ROBOT" value="2"'.(($CONF['REP_ROBOT'] == 2) ? ' style="background-color:#00FF00;" checked="checked"' : '').' />'._LCX_ADM_REPORTING_ROBOT.'
<input type="hidden" name="command" value="REPROBOT" /><br /><br />
<input type="submit" value="'._SUBMIT.'" name="save" />
</form>
</td>
</tr>';

//	form - Add Igonre Host
print '
<tr><th colspan="2" height="3">
<form name="form2" method="post" action="logadm.php" style="margin-bottom:0;">
</th></tr>
<tr valign="top" align="left">
<td class="head">'._LCX_ADM_ADDIP_TITLE.'<br /><br />
<span style="font-weight: normal">'._LCX_ADM_ADDIP_DESC.'</span></td>
<td class="even">
<input type="text" size="60" name="addr" />
<input type="hidden" name="command" value="ADDIP" />
<input type="submit" value="'._ADD.'" name="save" />
</form>
</td>
</tr>';

//	form - Your Host & Put it into Igonore Host List ?
if (!isset($_SERVER['REMOTE_HOST'])) { $_SERVER['REMOTE_HOST'] = $_SERVER['REMOTE_ADDR']; }
print	'<tr valign="top" align="left"><td class="head">'._LCX_ADM_YOURHOST_TITLE.'</td>';
$YourHost = addslashes($myts->stripSlashesGPC($_SERVER['REMOTE_HOST']));
$sql = "SELECT cfgvalue FROM ".$xoopsDB->prefix("logcounterx_cfg").
       " WHERE (cfgname = 'IGNORE_HOST') AND ('$YourHost' like cfgvalue)";
if ($xoopsDB->getrowsNum($xoopsDB->query($sql)) == 0) {
	print	'<form method="post" action="logadm.php">'.
		'<td class="even">'.htmlspecialchars($_SERVER['REMOTE_HOST']).'&nbsp;&nbsp;&nbsp;'.
		'<input type="hidden" name="addr" value="'.htmlspecialchars($_SERVER['REMOTE_HOST']).'">'.
		'<input type="hidden" name="command" value="ADDIP">'.
		'<input type="submit" value="'._LCX_ADM_YOURHOST_ADD.'">'.
		'</td>'.
		'</form>';
} else {
	print '<td class="even">'.htmlspecialchars($_SERVER['REMOTE_HOST']).'</td>';
}
print '</tr>';

//	form - Ignore Hosts List & Delete them ?
$i = 0;
$sql = "SELECT recid, cfgvalue FROM ".$xoopsDB->prefix("logcounterx_cfg").
       " WHERE (cfgname = 'IGNORE_HOST') ORDER BY cfgvalue";
$res = $xoopsDB->query($sql);
if (($xoopsDB->getrowsNum($res)) > 0) {
	print	'<tr valign="top" align="left"><td class="head">'.
		'<form name="form3" method="post" action="logadm.php" style="margin-bottom:0;">'.
		_LCX_ADM_DELETEIP_TITLE.'<br /><br />'.
		'<span style="font-weight: normal">'._LCX_ADM_DELETEIP_DESC.'</span></td>'.
		'<td class="even"><table cellpadding="3">';
	while (list($RecID, $IgHost) = $xoopsDB->fetchRow($res)) {
		$i++; $RecID = intval($RecID); $IgHost = $IgHost;
		print	'<tr><td><input type="checkbox" name="mark'.$i.'" value="on"></td>'.
			'<td><input type="hidden" name="id'.$i.'" value="'.$RecID.'" />'.htmlspecialchars($IgHost)."</td></tr>";
	}
	print	'</table>'.
		'<input type="hidden" name="count" value="'.$i.'" />'.
		'<input type="hidden" name="command" value="DELETEIP" />'.
		'<input type="submit" name="save" value="'._DELETE.'" />'.
		'</form></td></tr>';
}

//	form - Add Igonre Referer
print '
<tr><th colspan="2" height="3">
<form name="form2" method="post" action="logadm.php" style="margin-bottom:0;">
</th></tr>
<tr valign="top" align="left">
<td class="head">'._LCX_ADM_ADDREF_TITLE.'<br /><br />
<span style="font-weight: normal">'._LCX_ADM_ADDREF_DESC.'</span></td>
<td class="even">
<input type="text" size="60" name="referer" />
<input type="hidden" name="command" value="ADDREF" />
<input type="submit" value="'._ADD.'" name="save" />
</form>
</td>
</tr>';


//	form - Ignore Referers List & Delete them ?
$i = 0;
$sql = "SELECT recid, cfgvalue FROM ".$xoopsDB->prefix("logcounterx_cfg").
       " WHERE (cfgname = 'IGNORE_REFERER') ORDER BY cfgvalue";
$res = $xoopsDB->query($sql);
if (($xoopsDB->getrowsNum($res)) > 0) {
	print	'<tr valign="top" align="left"><td class="head">'.
		'<form name="form3" method="post" action="logadm.php" style="margin-bottom:0;">'.
		_LCX_ADM_DELETEREF_TITLE.'<br /><br />'.
		'<span style="font-weight: normal">'._LCX_ADM_DELETEREF_DESC.'</span></td>'.
		'<td class="even"><table cellpadding="3">';
	while (list($RecID, $IgReferer) = $xoopsDB->fetchRow($res)) {
		$i++; $RecID = intval($RecID); $IgHost = $IgReferer;
		print	'<tr><td><input type="checkbox" name="mark'.$i.'" value="on"></td>'.
			'<td><input type="hidden" name="id'.$i.'" value="'.$RecID.'" />'.htmlspecialchars($IgReferer)."</td></tr>";
	}
	print	'</table>'.
		'<input type="hidden" name="count" value="'.$i.'" />'.
		'<input type="hidden" name="command" value="DELETEREF" />'.
		'<input type="submit" name="save" value="'._DELETE.'" />'.
		'</form></td></tr>';
}

print '</table>';

include_once "admin_footer.php";

function print_input_area($nam, $val, $ttl, $dsc, $typ) {
	print	'<tr valign="top" align="left"><td class="head">'.$ttl.'<br /><br />'.
			'<span style="font-weight: normal;">'.$dsc.'</span></td><td class="even">';
	if ($typ == 'yesno') {
		if ($val) {
			print	'<input type="radio" name="'.$nam.'" value="1" style="background-color:#00FF00;" checked="checked" />'._YES;
			print	'<input type="radio" name="'.$nam.'" value="0" />'._NO;
		} else {
			print	'<input type="radio" name="'.$nam.'" value="1" />'._YES;
			print	'<input type="radio" name="'.$nam.'" value="0" style="background-color:#00FF00;" checked="checked" />'._NO;
		}
	} else {
		print	'<input type="text" size="12" name="'.$nam.'" value="'.$val.'" />';
	}
	print	'</td></tr>';
	return 1;
}
?>