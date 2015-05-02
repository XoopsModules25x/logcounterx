<?php
include_once '../../../include/cp_header.php';
include_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';

//	Referer check
$ref = xoops_getenv('HTTP_REFERER');
if (strpos($ref, XOOPS_URL . '/modules/logcounterx/admin/') !== 0) {
    redirect_header(XOOPS_URL . '/modules/logcounterx/admin/', 0, 'ERROR! (Referer check)');
}

//	Setup Count-up Block
$mid      = $xoopsModule->getVar('mid');
$bid      = 0;
$myblocks =& XoopsBlock::getByModule($mid, true);
foreach ($myblocks as $block) {
    if ($block->getVar('func_file') == 'count_up.php') {
        $bid = $block->getVar('bid');
        $xoopsDB->queryF("UPDATE " . $xoopsDB->prefix('newblocks') . " SET visible = 1, bcachetime = 0, side = 0, weight = 0" .
                         " WHERE (mid = $mid) AND (bid = $bid)");
        $xoopsDB->queryF("DELETE FROM " . $xoopsDB->prefix('block_module_link') . " WHERE block_id = $bid");
        $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix('block_module_link') . " (block_id, module_id) VALUES ($bid, 0)");
        $member_handler =& xoops_gethandler('member');
        $groups         =& $member_handler->getGroups();
        foreach ($groups as $group) {
            $gid = $group->getVar('groupid');
            $sql = "SELECT gperm_name FROM " . $xoopsDB->prefix('group_permission') .
                   " WHERE (gperm_itemid = $bid) AND (gperm_modid = 1) AND (gperm_groupid = $groupid)";
            $res = $xoopsDB->query($sql);
            if ($xoopsDB->getrowsNum($res) == 0) {
                $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix('group_permission') .
                                 " (gperm_groupid, gperm_itemid, gperm_modid, gperm_name) VALUES " .
                                 " ($gid, $bid, 1, 'block_read')");
            }
        }
        break;
    }
}

if (file_exists(XOOPS_ROOT_PATH . "/modules/system/language/" . $xoopsConfig['language'] . "/admin.php")) {
    include XOOPS_ROOT_PATH . "/modules/system/language/" . $xoopsConfig['language'] . "/admin.php";
} else {
    include XOOPS_ROOT_PATH . "/modules/system/language/english/admin.php";
}

redirect_header("./myblocksadmin.php", 1, _MD_AM_DBUPDATED);
exit;
