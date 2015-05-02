<?php
include_once "admin_header.php";

if (!defined('_CHARSET')) {
    define('_CHARSET', 'EUC-JP');
}

print '
<table class="outer" cellSpacing="1" width="100%">
<tr><th colspan="5">' . _LCX_ADM_QWORDS_NAME . '</th></tr>
';

$qword = array();
$qlong = array();
$sql   = "SELECT qword FROM " . $xoopsDB->prefix('logcounterx_log') . " WHERE qword <> ''";
$res   = $xoopsDB->query($sql);
while (list($d) = $xoopsDB->fetchRow($res)) {
    if ((0 < substr_count($d, ' ')) && (substr_count($d, ' ') < 4)) {
        $q_array = explode(' ', $d);
        foreach ($q_array as $q) {
            if (extension_loaded('mbstring')) {
                $q = mb_convert_kana($q, "asKV", _CHARSET);
                $q = mb_strtolower(trim($q), _CHARSET);            // Thx to kizumo
            } else {
                $q = strtolower(trim($q));
            }
            if (strlen($q) > 20) {
                if (!isset($qlong[$q])) {
                    $qlong[$q] = 1;
                } else {
                    $qlong[$q]++;
                }
            } elseif ($q != '') {
                if (!isset($qword[$q])) {
                    $qword[$q] = 1;
                } else {
                    $qword[$q]++;
                }
            }
        }
    } else {
        if (strlen($d) > 20) {
            if (!isset($qlong[$d])) {
                $qlong[$d] = 1;
            } else {
                $qlong[$d]++;
            }
        } elseif (trim($d) != '') {
            if (extension_loaded('mbstring')) {
                $d = mb_convert_kana($d, "aKV", _CHARSET);
                $d = mb_strtolower(trim($d), _CHARSET);            // Thx to kizumo
            } else {
                $d = strtolower(trim($d));
            }
            if (!isset($qword[$d])) {
                $qword[$d] = 1;
            } else {
                $qword[$d]++;
            }
        }
    }
}
unset($res);
ksort($qword);
arsort($qword, SORT_NUMERIC);
ksort($qlong);
arsort($qlong, SORT_NUMERIC);

print '<tr class="head"><td>Count</td><td>Word';
$PNum = 0;
$C    = ' class="even"';
foreach ($qword as $key => $val) {
    if ($PNum != $val) {
        print '</td></tr><tr' . $C . '><td align="right">' . $val . '</td><td>';
        $PNum = $val;
        $cnt  = 0;
        $C    = (($C == ' class="even"') ? ' class="odd"' : ' class="even"');
    } else {
        print ', ';
        if ($cnt++ > 6) {
            print '<br />';
            $cnt = 0;
        }
    }
    print htmlspecialchars($key, ENT_QUOTES);
}
print '</td></tr>';

print '<tr class="head"><td>Count</td><td>Long Text';
$PNum = 0;
$C    = ' class="even"';
foreach ($qlong as $key => $val) {
    if ($PNum != $val) {
        print '</td></tr><tr' . $C . '><td align="right">' . $val . '</td><td>';
        $PNum = $val;
        $C    = (($C == ' class="even"') ? ' class="odd"' : ' class="even"');
    } else {
        print '<br />';
    }
    print htmlspecialchars($key, ENT_QUOTES);
}
print '</td></tr>';

print '</table>';

include_once "admin_footer.php";
