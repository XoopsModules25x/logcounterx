<?php
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

function xoops_module_install_logcounterx(&$module)
{
    global $xoopsDB;
    include_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';

    //	Initialize Counter
    $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix('logcounterx_count') . " (ymd, cnt) VALUES ('1111-11-11', 0)");

    //	Initialize Hour Counter
    for ($i = 0; $i < 24; $i++) {
        $hour = sprintf("%02d", $i);
        $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix('logcounterx_hours') . " (hour, cnt) VALUES ('$hour', 0)");
    }

    //	Initialize Configulation
    include XOOPS_ROOT_PATH . '/modules/logcounterx/admin/default_conf.php';
    $sqlstr = "INSERT INTO " . $xoopsDB->prefix('logcounterx_cfg') . " (cfgname, cfgvalue) VALUES ";
    foreach ($DefConf as $cfgname => $cfgvalue) {
        if (!preg_match('/^[A-Za-z0-9\-_]+$/', $cfgname)) {
            continue;
        }
        if (!preg_match('/^[A-Za-z0-9\-_\.\s]*$/', $cfgvalue)) {
            continue;
        }
        $xoopsDB->queryF($sqlstr . "('$cfgname', '$cfgvalue')");
    }

    //	Setup Count-up Block
    $mid      = (int)($module->getVar('mid'));
    $bid      = 0;
    $myblocks =& XoopsBlock::getByModule($mid, true);
    foreach ($myblocks as $block) {
        if ($block->getVar('func_file') == 'count_up.php') {
            $bid = (int)($block->getVar('bid'));
            $xoopsDB->queryF("UPDATE " . $xoopsDB->prefix('newblocks') . " SET visible = 1, bcachetime = 0, side = 0, weight = 0" .
                             " WHERE (mid = $mid) AND (bid = $bid)");
            $xoopsDB->queryF("DELETE FROM " . $xoopsDB->prefix('block_module_link') . " WHERE block_id = $bid");
            $xoopsDB->queryF("INSERT INTO " . $xoopsDB->prefix('block_module_link') . " (block_id, module_id) VALUES ($bid, 0)");
            $member_handler =& xoops_gethandler('member');
            $groups         =& $member_handler->getGroups();
            foreach ($groups as $group) {
                $gid = (int)($group->getVar('groupid'));
                $sql = "SELECT gperm_name FROM " . $xoopsDB->prefix('group_permission') .
                       " WHERE (gperm_itemid = $bid) AND (gperm_modid = 1) AND (gperm_groupid = $gid)";
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

    return true;
}
