<?php
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

function xoops_module_uninstall_logcounterx(&$module)
{
    global $xoopsDB;
    if (defined('XOOPS_CACHE_PATH')) {
        $LogFile = XOOPS_CACHE_PATH . '/logcounterx_' . md5(XOOPS_URL . XOOPS_ROOT_PATH . $xoopsDB->prefix('')) . '.txt';
        if (file_exists($LogFile)) {
            @unlink($LogFile);
        }
    }

    return true;
}
