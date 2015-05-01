<?php
include_once "./admin_header.php";

$sql = "SELECT COUNT(recid) as cnt FROM ".$xoopsDB->prefix('logcounterx_log');
list($Total) = $xoopsDB->fetchRow($xoopsDB->query($sql));

print '
<table class="outer" cellSpacing="1" width="100%">
<tr><th colspan="5">'._LCX_ADM_BROS_NAME.'</th></tr>
';

$sql = "SELECT user_agent, agent, os, MAX(accday) as last, COUNT(recid) as cnt".
       " FROM ".$xoopsDB->prefix('logcounterx_log').
       " GROUP BY user_agent ORDER BY cnt DESC";
$res = $xoopsDB->query($sql);

print '<tr class="head"><td>Count</td><td>Latest</td><td>USER_AGENT</td><td>Browser</td><td>OS</td></tr>';

$C = ' class="even"';
while ($d = $xoopsDB->fetchArray($res)) {
	$A = (($d['agent'] == 'undefined') ? ' style="color:RED;"' : '');
	$O = (($d['os']    == 'undefined') ? ' style="color:RED;"' : '');
	if (($d['agent'] == 'unknown') && ($d['os']    == 'unknown')) {
		$U = ' style="color:RED;"';
	} else { $U = ''; }
	$A = (eregi('Robot', $d['agent']) ? ' style="color:ORANGE;"' : '');
	print '<tr'.$C.'>'.
	      '<td align="RIGHT">'.$d['cnt'].'</td>'.
	      '<td nowrap="nowrap" style="font-size:x-small;">'.$d['last'].'</td>'.
	      '<td'.$U.'>'.htmlspecialchars($d['user_agent']).'</td>'.
	      '<td'.$A.'>'.htmlspecialchars($d['agent']).'</td>'.
	      '<td'.$O.'>'.htmlspecialchars($d['os']).'</td>'.
	      '</tr>';
	$C = (($C == ' class="even"') ? ' class="odd"' : ' class="even"');
}

print '</table>';

include_once "./admin_footer.php";
?>