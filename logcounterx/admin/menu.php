<?php
$adminmenu[0]['title'] = _LCX_MI_GENCONF;
$adminmenu[0]['link']  = "admin/genadm.php";
$adminmenu[1]['title'] = _LCX_MI_LOGCONF;
$adminmenu[1]['link']  = "admin/logadm.php";
$adminmenu[2]['title'] = _LCX_MI_REPCONF;
$adminmenu[2]['link']  = "admin/repadm.php";
$adminmenu[3]['title'] = _LCX_MI_IMGSLCT;
$adminmenu[3]['link']  = "admin/imgslct.php";
$adminmenu[4]['title'] = _LCX_MI_REBUILD;
$adminmenu[4]['link']  = "admin/rebuild.php";
$adminmenu[5]['title'] = _LCX_MI_BROSERLIST;
$adminmenu[5]['link']  = "admin/uaos.php";
$adminmenu[6]['title'] = _LCX_MI_QWORDSLIST;
$adminmenu[6]['link']  = "admin/qwords.php";
$adminmenu[7]['title'] = _LCX_MI_DBCHECK;
$adminmenu[7]['link']  = "admin/db_check.php";
if (!defined('XOOPS_CUBE_LEGACY')) {
    $adminmenu[8]['title'] = _LCX_MI_BLOCKSADMIN;
    $adminmenu[8]['link']  = "admin/myblocksadmin.php";
}
