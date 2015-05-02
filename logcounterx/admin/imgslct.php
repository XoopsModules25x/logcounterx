<?php
include_once "./admin_header.php";
$myts =& MyTextSanitizer::getInstance();

header("Pragma: no-cache");

$imgdir0 = XOOPS_ROOT_PATH . '/modules/logcounterx/images';
$imgdir  = $imgdir0 . '/';
$imgurl  = XOOPS_URL . '/modules/logcounterx/images/';

if (isset($_POST['imgorchr'])) {
    $USE_IMGORCHR = (int)($_POST['imgorchr']);
    $sql          = "UPDATE " . $xoopsDB->prefix('logcounterx_cfg') .
                    " SET cfgvalue = '" . $USE_IMGORCHR . "' WHERE cfgname = 'USE_IMGORCHR'";
    $xoopsDB->query($sql);
}
$sql = "SELECT cfgvalue FROM " . $xoopsDB->prefix('logcounterx_cfg') . " WHERE cfgname = 'USE_IMGORCHR'";
list($USE_IMGORCHR) = $xoopsDB->fetchRow($xoopsDB->query($sql));

if (isset($_POST['imgdir']) && preg_match('/^[a-zA-Z0-9_\-]+$/', $_POST['imgdir'])) {
    $newdir    = $_POST['imgdir'];
    $imgdirchk = true;
    for ($i = 0; $i <= 9; $i++) {
        if (!file_exists($imgdir . $newdir . "/$i.gif")) {
            $imgdirchk = false;
            break;
        }
    }
    if ($imgdirchk) {
        $sql = "UPDATE " . $xoopsDB->prefix('logcounterx_cfg') . " SET cfgvalue = '$newdir' WHERE cfgname = 'IMG_DIR'";
        $xoopsDB->query($sql);
        $CONF['IMG_DIR'] = $newdir;
    }
}

if (isset($_POST['stylecode'])) {
    $sql = "UPDATE " . $xoopsDB->prefix('logcounterx_cfg') .
           " SET cfgvalue = '" . addslashes($myts->stripSlashesGPC($_POST['stylecode'])) . "' WHERE cfgname = 'USE_CHR_STYLE'";
    $res = $xoopsDB->query($sql);
}
$sql = "SELECT cfgvalue FROM " . $xoopsDB->prefix('logcounterx_cfg') . " WHERE cfgname = 'USE_CHR_STYLE'";
list($USE_CHR_STYLE) = $xoopsDB->fetchRow($xoopsDB->query($sql));

print    '<table class="outer" cellSpacing="1" width="100%">' .
         '<tr><th colspan="2">' . _LCX_ADM_IMGSLCT . '</th></tr>' .
         '<tr valign="top" align="left">' .
         '<td class="head">' . _LCX_ADM_USEIMG . '</td>' .
         '<td class="odd">' .
         '<form action="./imgslct.php" method="post" style="margin-bottom:0;">';

if ($USE_IMGORCHR == 1) {
    print '<input type="radio" name="imgorchr" value="0" /> ' . _LCX_ADM_IMG .
          '&nbsp;&nbsp;<input type="radio" name="imgorchr" value="1" style="background-color:#00FF00;" checked="checked" />' . _LCX_ADM_CHR;
} else {
    print '<input type="radio" name="imgorchr" value="0" style="background-color:#00FF00;" checked="checked" /> ' . _LCX_ADM_IMG .
          '&nbsp;&nbsp;<input type="radio" name="imgorchr" value="1" />' . _LCX_ADM_CHR;
}

print    '
&nbsp;&nbsp;<input type="submit" value="' . _SELECT . '">
</form>
</td></tr>
';

if ($USE_IMGORCHR == 1) {
    print    '<tr valign="top" align="left">' .
             '<td class="head">' . _LCX_ADM_STYLE . '</td>' .
             '<form action="imgslct.php" method="post" style="margin-bottom:0;">' .
             '<td class="odd"><span style="' . $USE_CHR_STYLE . '">0123456789</span><br />' .
             '&lt;SPAN style=&quot;<input type="text" name="stylecode" value="' . $USE_CHR_STYLE . '" size="60" />' .
             '&quot;&gt;<br />' .
             '<input type="submit" value="' . _SUBMIT . '" />' .
             '</form>' .
             '</td>' .
             '</tr>';
} else {
    print    '<tr valign="top" align="left"><td class="head">' . _LCX_ADM_IMGNOW . '</td><td class="even">';
    $newdir = '';
    $nam    = '';
    if (isset($CONF['IMG_DIR']) && ($CONF['IMG_DIR'] != '')) {
        $newdir = $CONF['IMG_DIR'] . '/';
    }
    for ($i = 0; $i <= 9; $i++) {
        print '<img src="' . $imgurl . $newdir . $i . '.gif" border="0" />';
    }
    print    '<br clear="all" />' . _LCX_ADM_CHGIMG_NOTE . '</td></tr>';
    if ($CONF['IMG_DIR'] = '') {
        $mystyle = ' style="background-color:#00FF00"';
    } else {
        $mystyle = '';
    }
    print    '<form action="imgslct.php" method="post" style="margin-bottom:0;">' .
             '<tr valign="top" align="left">' .
             '<td class="head">' .
             '<input type="submit" value="' . _SELECT . '"' . $mystyle . ' />&nbsp;' . $nam . '</td>' .
             '<td class="even">' .
             '<img src="' . $imgurl . '0.gif" border="0" alt="0" />' .
             '<img src="' . $imgurl . '1.gif" border="0" alt="1" />' .
             '<img src="' . $imgurl . '2.gif" border="0" alt="2" />' .
             '<img src="' . $imgurl . '3.gif" border="0" alt="3" />' .
             '<img src="' . $imgurl . '4.gif" border="0" alt="4" />' .
             '<img src="' . $imgurl . '5.gif" border="0" alt="5" />' .
             '<img src="' . $imgurl . '6.gif" border="0" alt="6" />' .
             '<img src="' . $imgurl . '7.gif" border="0" alt="7" />' .
             '<img src="' . $imgurl . '8.gif" border="0" alt="8" />' .
             '<img src="' . $imgurl . '9.gif" border="0" alt="9" />' .
             '<input type="hidden" name="imgdir" value="" />' .
             '</form>' .
             '</td>' .
             '</tr>';
    if ($dh = opendir($imgdir0)) {
        while ($nam = readdir($dh)) {
            if ((is_dir($imgdir . $nam)) && ($nam != '.') && ($nam != '..')) {
                if (file_exists($imgdir . $nam . '/0.gif')) {
                    if ($nam == $CONF['IMG_DIR']) {
                        $mystyle = ' style="background-color:#00FF00"';
                    } else {
                        $mystyle = '';
                    }
                    $imageattr = '';
                    if (function_exists('getimagesize')) {
                        list($width, $height, $type, $attr) = getimagesize($imgdir . $nam . '/0.gif');
                        for ($i = 1; $i < 10; $i++) {
                            list($width1, $height1, $type1, $attr1) = getimagesize($imgdir . $nam . '/' . $i . '.gif');
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
                    print    '<form action="imgslct.php" method="post" style="margin-bottom:0;">' .
                             '<tr valign="top" align="left">' .
                             '<td class="head">' .
                             '<input type="submit" value="' . _SELECT . '"' . $mystyle . ' />&nbsp;' . $nam . '</td>' .
                             '<td class="even">' .
                             '<img src="' . $imgurl . $nam . '/0.gif" border="0" alt="0"' . $imageattr . '/>' .
                             '<img src="' . $imgurl . $nam . '/1.gif" border="0" alt="1"' . $imageattr . '/>' .
                             '<img src="' . $imgurl . $nam . '/2.gif" border="0" alt="2"' . $imageattr . '/>' .
                             '<img src="' . $imgurl . $nam . '/3.gif" border="0" alt="3"' . $imageattr . '/>' .
                             '<img src="' . $imgurl . $nam . '/4.gif" border="0" alt="4"' . $imageattr . '/>' .
                             '<img src="' . $imgurl . $nam . '/5.gif" border="0" alt="5"' . $imageattr . '/>' .
                             '<img src="' . $imgurl . $nam . '/6.gif" border="0" alt="6"' . $imageattr . '/>' .
                             '<img src="' . $imgurl . $nam . '/7.gif" border="0" alt="7"' . $imageattr . '/>' .
                             '<img src="' . $imgurl . $nam . '/8.gif" border="0" alt="8"' . $imageattr . '/>' .
                             '<img src="' . $imgurl . $nam . '/9.gif" border="0" alt="9"' . $imageattr . '/>' .
                             '<input type="hidden" name="imgdir" value="' . $nam . '" />' .
                             '</form>' .
                             '</td>' .
                             '</tr>';
                }
            }
        }
        closedir($dh);
    }
}
print '</table>';

print '<br />Please, visit <b><a href="http://www.digitmania.holowww.com/" target="_blank">Digit Mania</a></b> : A collection of digit styles for use with HTML counters.';

include_once "admin_footer.php";
