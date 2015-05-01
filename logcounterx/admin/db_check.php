<?php
include_once "admin_header.php";

$MyPrefix = $xoopsDB->prefix('');

if (isset($_POST['op']) && ($_POST['op'] == 'OPTIMIZE')) {
	foreach ($_POST as $key => $val) {
		if (preg_match('/^[a-zA-Z0-9_]+$/', $val) && preg_match('/^table[\d]+$/', $key)) {
			$xoopsDB->query("OPTIMIZE TABLE `$val`");
		}
	}
}

print	'<table width="100%">'.
	'<tr><th colspan="7"><form action="db_check.php" style="margin:0;" method="post">'._LCX_ADM_DBCHECK.'</th></tr>'.
	'<tr class="head"><td>&nbsp;</td><td>'._LCX_ADM_CHKDB_Name.'</td>'.
	'<td align="right">'._LCX_ADM_CHKDB_Rows.'</td>'.
	'<td align="right">'._LCX_ADM_CHKDB_Data_length.'</td>'.
	'<td align="right">'._LCX_ADM_CHKDB_Avg_row_length.'</td>'.
	'<td align="right">'._LCX_ADM_CHKDB_Data_free.'</td>'.
	'<td>'._LCX_ADM_CHKDB_Update_time.'</td></tr>';
$res = $xoopsDB->queryF('SHOW TABLE STATUS FROM '.XOOPS_DB_NAME);
$i = 0;
$C = '';
while ($t = $xoopsDB->fetchArray($res)) {
	$C = (($C == ' class="even"') ? ' class="odd"' : ' class="even"');
	if (preg_match('/^'.$MyPrefix.'_?(.*)$/', $t['Name'], $m)) { $t['MyName'] = $m[1];
		if (preg_match('/^logcounterx/', $t['MyName'])) {
			print	'<tr'.$C.'>'.
				'<td>'.
				'<input type="checkbox" name="table'.$i.'" value="'.$t['Name'].'" '.
				(($t['Data_free'] > 100000) ? 'style="background-color:#00FF00;" checked="checked" ' : '').' /></td>'.
				'<td nowrap="nowrap">'.$t['MyName'].'</td>'.
				'<td nowrap="nowrap" align="right">'.number_format($t['Rows']).'</td>'.
				'<td nowrap="nowrap" align="right">'.number_format($t['Data_length']).'</td>'.
				'<td nowrap="nowrap" align="right">'.number_format($t['Avg_row_length']).'</td>'.
				'<td nowrap="nowrap" align="right">'.number_format($t['Data_free']).'</td>'.
					'<td nowrap="nowrap">'.$t['Update_time'].'</td>'.
				'</tr>';
			$i++;
		}
	}
}
print	'<tr><td colspan="2"><input type="hidden" name="op" value="OPTIMIZE" /><input type="submit" value="OPTIMIZE" />'.
	'<td colspan="5">'._LCX_ADM_CHKDB_OPTIMIZE_DESC.'</form></td></tr>';
print	'</table>';

xoops_cp_footer();
?>