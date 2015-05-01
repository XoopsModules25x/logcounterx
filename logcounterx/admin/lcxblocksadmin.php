<?php
// ------------------------------------------------------------------------- //
//                            myblocksadmin.php                              //
//                - XOOPS block admin for each modules -                     //
//                          GIJOE <http://www.peak.ne.jp/>                   //
// ------------------------------------------------------------------------- //

//include_once( '../../../include/cp_header.php' ) ;
//include_once ('./admin_header.php');

include_once( 'mygrouppermform.php' ) ;
include_once( XOOPS_ROOT_PATH.'/class/xoopsblock.php' ) ;
include_once "../include/gtickets.php" ;// GIJ

$xoops_system_path = XOOPS_ROOT_PATH . '/modules/system' ;
$xcube_legacy_path = XOOPS_ROOT_PATH . '/modules/legacy' ;
$xcube_user_path = XOOPS_ROOT_PATH . '/modules/user' ;

// language files
$language = $xoopsConfig['language'] ;
if( ! file_exists( "$xcube_legacy_path/language/$language/admin/admin.php") ) $language = 'english' ;

// to prevent from notice that constants already defined
$error_reporting_level = error_reporting( 0 ) ;
include_once( "$xcube_legacy_path/include/xoops2_system_constants.inc.php" ) ;
include_once( "$xcube_legacy_path/language/$language/admin.php" ) ;
include_once( "$xcube_legacy_path/language/$language/admin/admin.php" ) ;
include_once( "$xcube_user_path/language/$language/admin.php" ) ;
error_reporting( $error_reporting_level ) ;

//$group_defs = file( "$xoops_system_path/language/$language/admin/groups.php" ) ;
//foreach( $group_defs as $def ) {
//	if( strstr( $def , '_AM_ACCESSRIGHTS' ) || strstr( $def , '_AM_ACTIVERIGHTS' ) ) eval( $def ) ;
//}

//
define ('_AM_TITLE', _AD_LEGACY_LANG_TITLE);
define ('_AM_SIDE', _AD_LEGACY_LANG_SIDE);
define ('_AM_WEIGHT', _AD_LEGACY_LANG_WEIGHT);
define ('_AM_VISIBLEIN', _AD_LEGACY_LANG_TARGET_MODULES);
define ('_AM_BCACHETIME', _AD_LEGACY_LANG_BCACHETIME);
define ('_AM_ACTION', _AD_LEGACY_LANG_CONTROL);
define ('_AM_TOPPAGE', _AD_LEGACY_LANG_TOPPAGE);
define ('_AM_ALLPAGES', _AD_LEGACY_LANG_ALL_MODULES);

define ('_MD_AM_ADGS', _AD_USER_LANG_PERM_MODULE_ACCESS);
define ('_AM_ACTIVERIGHTS', _AD_USER_LANG_PERM_ADMIN);
define ('_AM_ACCESSRIGHTS', _AD_USER_LANG_PERM_ACCESS);





// check $xoopsModule
if( ! is_object( $xoopsModule ) ) redirect_header( XOOPS_URL.'/user.php' , 1 , _NOPERM ) ;

// set target_module if specified by $_GET['dirname']
$module_handler =& xoops_gethandler('module');
if( ! empty( $_GET['dirname'] ) ) {
	$target_module =& $module_handler->getByDirname($_GET['dirname']);
}/* else if( ! empty( $_GET['mid'] ) ) {
	$target_module =& $module_handler->get( intval( $_GET['mid'] ) );
}*/

if( ! empty( $target_module ) && is_object( $target_module ) ) {
	// specified by dirname
	$target_mid = $target_module->getVar( 'mid' ) ;
	$target_mname = $target_module->getVar( 'name' ) . "&nbsp;" . sprintf( "(%2.2f)" , $target_module->getVar('version') / 100.0 ) ;
	$query4redirect = '?dirname='.urlencode(strip_tags($_GET['dirname'])) ;
} else if( isset( $_GET['mid'] ) && $_GET['mid'] == 0 || $xoopsModule->getVar('dirname') == 'blocksadmin' ) {
	$target_mid = 0 ;
	$target_mname = '' ;
	$query4redirect = '?mid=0' ;
} else {
	$target_mid = $xoopsModule->getVar( 'mid' ) ;
	$target_mname = $xoopsModule->getVar( 'name' ) ;
	$query4redirect = '' ;
}

// check access right (needs system_admin of BLOCK)
$sysperm_handler =& xoops_gethandler('groupperm');
if (!$sysperm_handler->checkRight('system_admin', XOOPS_SYSTEM_BLOCK, $xoopsUser->getGroups())) redirect_header( XOOPS_URL.'/user.php' , 1 , _NOPERM ) ;

// get blocks owned by the module (Imported from xoopsblock.php then modified)
//$block_arr =& XoopsBlock::getByModule( $target_mid ) ;
$db =& Database::getInstance();
$sql = "SELECT * FROM ".$db->prefix("newblocks")." WHERE mid='$target_mid' ORDER BY visible DESC,side,weight";
$result = $db->query($sql);
$block_arr = array();
while( $myrow = $db->fetchArray($result) ) {
	$block_arr[] = new XoopsBlock($myrow);
}

if( ! empty( $_POST['submit'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'myblocksadmin' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	include( "mygroupperm.php" ) ;
	redirect_header( XOOPS_URL."/modules/".$xoopsModule->dirname()."/admin/myblocksadmin.php$query4redirect" , 1 , _MD_AM_DBUPDATED );
}

//xoops_cp_header() ;
if( file_exists( './mymenu.php' ) ) include( './mymenu.php' ) ;

// echo "<h3 style='text-align:left;'>$target_mname</h3>\n" ;

if( ! empty( $block_arr ) ) {
	// echo "<h4 style='text-align:left;'>"._AM_BADMIN."</h4>\n" ;
	echo "<table width=\"100%\"><tr><th>"._LCX_ADM_BLOCKSADMIN."</th></tr></table>\n" ;
	list_blocks() ;
}

list_groups() ;
//xoops_cp_footer() ;
include_once './admin_footer.php';

?>