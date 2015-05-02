<?php
include_once './admin_header.php';

$query   = (isset($_GET['query']) ? $_GET['query'] : '');
$query   = urldecode($query);
$escaped = htmlspecialchars($query);

$toutf = mb_convert_encoding($query, 'UTF-8', 'auto');
$toeuc = mb_convert_encoding($query, 'EUC-JP', 'auto');
$tosjs = mb_convert_encoding($query, 'SJIS', 'auto');

$frutf = mb_convert_encoding($query, _CHARSET, 'UTF-8');
$freuc = mb_convert_encoding($query, _CHARSET, 'EUC-JP');
$frsjs = mb_convert_encoding($query, _CHARSET, 'SJIS');

print    '<br />';

print    '<form action="./code_test.php" method="get">';
print    '<input type="text" name="query" value="' . $escaped . '" />';
print    '<input type="submit" />';
print    '</form>';

print    '<br />';

print    '<table><tr><th colspan="3">Converted to</th></tr>';
print    '<tr><td>UTF</td><td>' . htmlspecialchars($toutf) . '   </td><td>' . urlencode($toutf) . '</td></tr>';
print    '<tr><td>EUC</td><td>' . htmlspecialchars($toeuc) . '   </td><td>' . urlencode($toeuc) . '</td></tr>';
print    '<tr><td>SJIS</td><td>' . htmlspecialchars($tosjs) . '   </td><td>' . urlencode($tosjs) . '</td></tr>';
print    '</table>';

print    '<br />';

print    '<table><tr><th colspan="3">Converted from</th></tr>';
print    '<tr><td>UTF</td><td>' . htmlspecialchars($frutf) . '   </td><td>' . urlencode($frutf) . '</td></tr>';
print    '<tr><td>EUC</td><td>' . htmlspecialchars($freuc) . '   </td><td>' . urlencode($freuc) . '</td></tr>';
print    '<tr><td>SJIS</td><td>' . htmlspecialchars($frsjs) . '   </td><td>' . urlencode($frsjs) . '</td></tr>';
print    '</table>';

xoops_cp_footer();
