<?php
//  ------------------------------------------------------------------------ //
//                      LogCounterX - XOOPS Module                           //
//                   Copyright (c) 2005 taquino.net                          //
//                     <http://xoops.taquino.net/>                           //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //

$modversion['name']		= _LCX_MI_NAME;
$modversion['version']		= '2.74';
$modversion['description']	= _LCX_MI_DESC;
$modversion['credits']		= "Taquino";
$modversion['author']		= "http://xoops.taquino.net/";
$modversion['help'] 		= '';
$modversion['license']		= "GPL";
$modversion['official']		= 0;
$modversion['image']		= "images/logo.png";
$modversion['dirname']		= "logcounterx";
$modversion['onInstall']	= 'admin/lcx_install.php';
$modversion['onUninstall']	= 'admin/lcx_uninstall.php';
$modversion['onUpdate']		= 'admin/lcx_update.php';

$modversion['templates'][1]['file']		= 'report.html';
$modversion['templates'][1]['description']	= 'Log Report';

$modversion['sqlfile']['mysql']		= "sql/mysql.sql";
$modversion['tables'][0] 		= "logcounterx_ip";
$modversion['tables'][1] 		= "logcounterx_count";
$modversion['tables'][2] 		= "logcounterx_log";
$modversion['tables'][3] 		= "logcounterx_cfg";
$modversion['tables'][4] 		= "logcounterx_hours";

$modversion['hasAdmin']		= 1;
$modversion['adminindex']	= "admin/index.php";
$modversion['adminmenu']	= "admin/menu.php";

$modversion['hasMain']		= 1;

$modversion['blocks'][1]['file']	= "display.php";
$modversion['blocks'][1]['name']	= _LCX_MI_CTR_NAME;
$modversion['blocks'][1]['description']	= _LCX_MI_CTR_DESC;
$modversion['blocks'][1]['show_func']	= "b_logcounterx_show_counter";
$modversion['blocks'][1]['template']	= 'lcx_block_display.html';
$modversion['blocks'][1]['options']	= '';

$modversion['blocks'][2]['file']	= "count_up.php";
$modversion['blocks'][2]['name']	= _LCX_MI_INC_NAME;
$modversion['blocks'][2]['description']	= _LCX_MI_INC_DESC;
$modversion['blocks'][2]['show_func']	= "b_logcounterx_inc_counter";
$modversion['blocks'][2]['options']	= '';

// keeping block's options when module is updated
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	include dirname( __FILE__ ) . "/include/onupdate.inc.php" ;
}
?>