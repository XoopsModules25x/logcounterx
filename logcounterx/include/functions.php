<?php
if (!defined('XOOPS_ROOT_PATH')) { exit(); }

if (!defined('LCX_LIBRARY_LOADED')) {
	define('LCX_LIBRARY_LOADED',1);

// Load query conversion function file
include XOOPS_ROOT_PATH."/modules/logcounterx/include/query_word.php";

// Select OS according to USER_AGENT
function lcx_ua2os($agent = '') {
	if ($agent == '') { return 'undefined'; }

	if (eregi('Windows 95', $agent) || eregi('Win95', $agent)) { return 'Win95'; }
	if (eregi('Win 9x 4\.90', $agent)) { return 'WinME'; }
	if (eregi('Windows 98', $agent) || eregi('Win98', $agent)) { return 'Win98'; }
	if (eregi('Windows 2000', $agent) || eregi('Win2000', $agent)) { return 'Win2000'; }
	if (eregi('Windows NT 5\.0', $agent) || eregi('WinNT 5\.0', $agent)) { return 'Win2000'; }
	if (eregi('Windows NT 5\.1', $agent) || eregi('WinNT 5\.1', $agent)) { return 'WinXP'; }
	if (eregi('Windows NT 6\.0', $agent) || eregi('WinNT 6\.0', $agent)) { return 'WinVista'; }
	if (eregi('Windows NT 6\.1', $agent) || eregi('WinNT 6\.1', $agent)) { return 'Windows7'; }
	if (eregi('Windows NT', $agent) || eregi('WinNT', $agent)) { return 'WinNT'; }
	if (eregi('Windows XP', $agent) || eregi('WinXP', $agent)) { return 'WinXP'; }
	if (eregi('Borg', $agent) || eregi('Win32', $agent)) { return 'Win32'; }
	if (eregi('Windows CE', $agent) || eregi('WinCE', $agent)) { return 'WinCE'; }
	if (eregi('Mac', $agent)) { return 'Mac'; }
	if (eregi('OmniWeb', $agent) || eregi('iCab', $agent) || eregi('Safari', $agent)) { return 'Mac'; }
	if (eregi('Lindows', $agent)) { return 'Lindows'; }
	if (eregi('Linux', $agent) || eregi('Kondara', $agent) || eregi('Vine', $agent) || eregi('Debian', $agent)) { return 'Linux'; }
	if (eregi('Fedora', $agent) || eregi('Laser5', $agent)) { return 'Linux'; }
	if (eregi('BSD', $agent)) { return 'UNIX (BSD)'; }
	if (eregi('X11', $agent) || eregi('SunOS', $agent) || eregi('HP-UX', $agent)) { return 'UNIX'; }
	if (eregi('AIX', $agent) || eregi('IRIX', $agent) || eregi('OSF1', $agent)) { return 'UNIX'; }
	if (eregi('BTRON', $agent)) { return 'BTRON'; }
	if (eregi('DreamPassport', $agent)) { return 'Dreamcast'; }
	if (eregi('DoCoMo', $agent)) { return 'Docomo'; }
	if (eregi('UP\.Browser', $agent)) { return 'AU (KDDI)'; }
	if (eregi('Vodafone', $agent) || eregi('J-PHONE', $agent)) { return 'Vodafone'; }
	if (eregi('DDIPOCKET', $agent) || eregi('AH-K3001V', $agent)) { return 'WILLCOM'; }
	if (eregi('PalmOS', $agent)) { return 'PalmOS '; }
	if (eregi('PlayStation ', $agent)) { return 'PlayStation '; }

	return '(undefined)';

}

// Select BROWSER according to USER_AGENT
function lcx_ua2br($agent = '') {
	if ($agent == '') { return 'undefined'; }

	//	Proxy
	if (eregi('Google.*Proxy',$agent,$a)) { return str_replace('/', ' ', $a[0]); }

	//	Robots
	if (eregi('aaacafe',		$agent)) { return 'Robot (AAA!CAFE)'; }
	if (eregi('acoon\.de',	$agent))	 { return 'Robot (Acoon.de)'; }
	if (eregi('accoona',		$agent)) { return 'Robot (Accoona)'; }
	if (eregi('aggregator:MyRSS.jp',$agent)) { return 'Robot (MyRSS.jp)'; }
	if (eregi('ArchitextSpider',	$agent)) { return 'Robot (Excite)'; }
	if (eregi('Ask Jeeves',		$agent)) { return 'Robot (Ask Jeeves)'; }
	if (eregi('Baiduspider',	$agent)) { return 'Robot (Baidu)'; }
	if (eregi('BecomeJPBot',	$agent)) { return 'Robot (BecomeJP)'; }
	if (eregi('bingbot',		$agent)) { return 'Robot (Bing)'; }
	if (eregi('Cerberian',		$agent)) { return 'Robot (Cerberian)'; }
	if (eregi('Comaneci_bot',	$agent)) { return 'Robot (i-know.jp)'; }
	if (eregi('Cowbot',		$agent)) { return 'Robot (Naver)'; }
	if (eregi('Convera',		$agent)) { return 'Robot (Convera)'; }
	if (eregi('Twiceler',		$agent)) { return 'Robot (Cuill)'; }
	if (eregi('discobot',		$agent)) { return 'Robot (discovery engine)'; }
	if (eregi('Down Site Checker',	$agent)) { return 'Robot (Yahoo!)'; }
	if (eregi('Drecombot',		$agent)) { return 'Robot (Drecom)'; }
	if (eregi('emyuu_bot',		$agent)) { return 'Robot (Emyuu)'; }
	if (eregi('Ezooms',		$agent)) { return 'Robot (ezoom)'; }
	if (eregi('facebook',		$agent)) { return 'Robot (facebook)'; }
	if (eregi('FAST-WebCrawler',	$agent)) { return 'Robot (fast.no)'; }
	if (eregi('findlinks',		$agent)) { return 'Robot (findlinks)'; }
	if (eregi('Gaisbot',		$agent)) { return 'Robot (Openfind)'; }
	if (eregi('gazz',		$agent)) { return 'Robot (NTTR)'; }
	if (eregi('Gigabot',		$agent)) { return 'Robot (Gigabot)'; }
	if (eregi('Slurp\.so/Goo',	$agent)) { return 'Robot (goo)'; }
//	if (eregi('Google',		$agent)) { return 'Robot (Google)'; }
	if (eregi('Googlebot',		$agent)) { return 'Robot (Google)'; }
	if (eregi('grub-client',	$agent)) { return 'Robot (grub-client)'; }
	if (eregi('Hatena Antenna',	$agent)) { return 'Robot (Hatena)'; }
	if (eregi('ia_archiver',	$agent)) { return 'Robot (Archiver)'; }
	if (eregi('iaskspider',		$agent)) { return 'Robot (iAsk)'; }
	if (eregi('\.ibm\.com',		$agent)) { return 'Robot (IBM)'; }
	if (eregi('ichiro',		$agent)) { return 'Robot (NTTR)'; }
	if (eregi('indexpert',		$agent)) { return 'Robot (Fresheye)'; }
	if (eregi('Indy Library',	$agent)) { return 'Robot (Indy Library)'; }
	if (eregi('Infoseek',		$agent)) { return 'Robot (Infoseek)'; }
	if (eregi('Inktomi',		$agent)) { return 'Robot (Inktomi)'; }
	if (eregi('livedoorCheckers',	$agent)) { return 'Robot (LivedoorCheckers)'; }
	if (eregi('Looksmart',		$agent)) { return 'Robot (Looksmart)'; }
	if (eregi('Lycos_Spider',	$agent)) { return 'Robot (Lycos)'; }
	if (eregi('MarkAgent',		$agent)) { return 'Robot (MarkAgent)'; }
	if (eregi('MJ12bot',		$agent)) { return 'Robot (majestic12)'; }
	if (eregi('MLBot',		$agent)) { return 'Robot (Metadata Labs)'; }
	if (eregi('msnbot',		$agent)) { return 'Robot (MSN)'; }
	if (eregi('NaverRobot',		$agent)) { return 'Robot (Naver)'; }
	if (eregi('nyanyu',		$agent)) { return 'Robot (nyanyu)'; }
	if (eregi('ndl-japan',		$agent)) { return 'Robot (ndl-japan)'; }
	if (eregi('NPBot',		$agent)) { return 'Robot (NameProtect)'; }
	if (eregi('Nutch',		$agent)) { return 'Robot (Nutch)'; }
	if (eregi('Nutraspace',		$agent)) { return 'Robot (nutraspace)'; }
	if (eregi('OmniExplorer',	$agent)) { return 'Robot (OmniExplorer)'; }
	if (eregi('onet\.pl',		$agent)) { return 'Robot (onet.pl)'; }
	if (eregi('Pockey-GetHTML',	$agent)) { return 'Robot (GetHTML)'; }
	if (eregi('psbot',		$agent)) { return 'Robot (Picsearch)'; }
	if (eregi('SBIder',		$agent)) { return 'Robot (SiteSell)'; }
	if (eregi('Scooter',		$agent)) { return 'Robot (AltaVista)'; }
	if (eregi('search-hp',		$agent)) { return 'Robot (search-hp)'; }
	if (eregi('Sidewinder',		$agent)) { return 'Robot (Infoseek)'; }
	if (eregi('Sogou',		$agent)) { return 'Robot (Sogou)'; }
	if (eregi('sohu-search',	$agent)) { return 'Robot (Sohu)'; }
	if (eregi('StackRambler',	$agent)) { return 'Robot (Rambler)'; }
	if (eregi('Speedy Spider',	$agent)) { return 'Robot (entireweb)'; }
	if (eregi('Su-Jine',		$agent)) { return 'Robot (Su-Jine)'; }
	if (eregi('TOCC',		$agent)) { return 'Robot (TOCC)'; }
	if (eregi('Ultraseek',		$agent)) { return 'Robot (Ultraseek)'; }
	if (eregi('walhello',		$agent)) { return 'Robot (Walhello)'; }
	if (eregi('WebAlta',		$agent)) { return 'Robot (WebAlta)'; }
	if (eregi('WebCrawler',		$agent)) { return 'Robot (WebCrawler)'; }
	if (eregi('WISEbot',		$agent)) { return 'Robot (WISEbot)'; }
	if (eregi('Y!J-DSC',		$agent)) { return 'Robot (Yahoo!)'; }
	if (eregi('Y!J-BSC',		$agent)) { return 'Robot (Yahoo!)'; }
	if (eregi('Yahoo! ',		$agent)) { return 'Robot (Yahoo!)'; }
	if (eregi('Yeti',		$agent)) { return 'Robot (Naver)'; }
	if (eregi('YodaoBot',		$agent)) { return 'Robot (youdao)'; }
	if (eregi('ZyBorg',		$agent)) { return 'Robot (LYCOS)'; }

	//	Other Robots
	if (eregi('crawler',		$agent)) { return 'Robot (others)'; }
	if (eregi('robot',		$agent)) { return 'Robot (others)'; }
	if (eregi('spider'	,	$agent)) { return 'Robot (others)'; }
	if (eregi('WebBot'	,	$agent)) { return 'Robot (others)'; }
	//if (eregi('bot',		$agent)) { return 'Robot (others)'; }

	//	Automations
	if (eregi('Arachmo',		$agent)) { return 'Arachmo'; }
	if (eregi('aggregator:MyRSS',	$agent)) { return 'MyRSS.jp'; }
	if (eregi('bookmark\.ne\.jp',	$agent)) { return 'Bookmark'; }
	if (eregi('Curl',		$agent)) { return 'Curl'; }
	if (eregi('Hatena',		$agent)) { return 'Hatena'; }
	if (eregi('^Java[\d_\/\.]+$',	$agent)) { return 'Program (Java)'; }
	if (eregi('Java\(TM\).*Runtime',$agent)) { return 'Program (Java)'; }
	if (eregi('libwww-perl',	$agent)) { return 'Program (Perl)'; }
	if (eregi('Microsoft URL Control',$agent)) { return 'Program (Windows)'; }
	if (eregi('PerManSurfer',	$agent)) { return 'PerManSurfer'; }
	if (eregi('PHP',		$agent)) { return 'Program (PHP)'; }
	if (eregi('POE-Component',	$agent)) { return 'Program (Perl)'; }
	if (eregi('samidare',		$agent)) { return 'samidare'; }
	if (eregi('Snoopy',		$agent)) { return 'Robot (Program (Snoopy))'; }
	if (eregi('snoopy',		$agent)) { return 'Program (PHP)'; }
	if (eregi('Webdup',		$agent)) { return 'Webdup'; }
	if (eregi('WebAuto',		$agent)) { return 'WebAuto'; }
	if (eregi('WebFetch',		$agent)) { return 'WebFetch'; }
	if (eregi('WebWhacker',		$agent)) { return 'WebWhacker'; }
	if (eregi('Wget',		$agent)) { return 'Wget'; }

	//	Browsers (RSS Reader)
	if (eregi('RSS_READER',			$agent, $a)) { return 'RSS_READER'; }
	if (eregi('Headline-Reader',		$agent, $a)) { return 'Headline-Reader'; }

	//	Other Rorbots   (including Web URL and/or Mail Address)
	if (eregi('http:\/\/',		$agent)) { return 'Robot (others)'; }
	if (eregi('[a-z]+@[a-z\.]+',	$agent)) { return 'Robot (others)'; }

	//	Portable Devices
	if (eregi('Android.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('iPad', $agent))
	{  if (eregi('OS [0-9_]*',		$agent, $a))
		{ return 'iPad '.str_replace('_', '.', $a[0]); }
	}
	if (eregi('iPhone OS [0-9_]*',		$agent, $a)) { return str_replace('_', '.', $a[0]); }
	if (eregi('BlackBerry[0-9]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Airboard.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('(DDIPOCKET;)([A-Za-z]*)',	$agent, $a)) { return str_replace('/', ' ', $a[1]); }
	if (eregi('DoCoMo.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('DreamPassport.[0-9\.]*',	$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('J-PHONE.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('jig.browser.[0-9\.]*',	$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('NetFront.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('UP\.Browser.[0-9\.]*',	$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Vodafone.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }

	//	Browsers
	if (eregi('Camino.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Cuam.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('CubeBrowser.[0-9\.]*',	$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Donut.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Firebird.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Firefox.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
//	if (eregi('FunWebProducts',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Galeon.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Hotbar.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('HotJava.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('iCab.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Konqueror.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Lunascape.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Lynx.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
//	if (eregi('MathPlayer ',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Maxthon',			$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('NetFront.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Ninja.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('NSPlayer.[0-9]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('OmniWeb.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Opera.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('PageNest.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('PageNest Pro.[0-9\.]*',	$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Phoenix.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Safari.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
//	if (eregi('SeaMonkey',			$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Shiira.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Sleipnir',			$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('Sylera.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
//	if (eregi('toolbar',			$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('TulipChain.[0-9\.]*',	$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('w3m.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('WWWC.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }


	//	Browsers
	if (eregi('Chrome.[0-9]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('compatible;[\s]+(MSIE.[0-9\.]*)',$agent, $a)) { return str_replace('/', ' ', $a[1]); }
	if (eregi('^Mozilla', $agent) && eregi('(compatible; )([a-zA-Z \/]*[0-9\.]*)',$agent, $a))
						             { return str_replace('/', ' ', $a[2]); }
	if (eregi('^Mozilla.[0-9\.]*',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
	if (eregi('^([a-zA-Z\/]+.[0-9\.]*)$',	$agent, $a)) { return str_replace('/', ' ', $a[0]); }

	return '(undefined)';
}

function lcx_rhshort($rh) {
	if (preg_match('/^[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+$/', $rh)) { return ''; }
	if (eregi('(\.([^\.]*)){1,3}$', $rh, $r)) { $rh = $r[0]; }
	if (eregi('^([^\.]*)\.(.*)$', $rh, $r)) { return $r[2]; }
	return '';
}

function lcx_refshort($ref) {
	if (trim($ref == '')) { return ''; }
	if (!preg_match('/^(http:\/\/|https:\/\/|ftp:\/\/)/', trim($ref))) { return 'Irregular Expression'; }
	if (strpos('?', $ref) !== false) { list($ref, $query) = explode($ref, '?', 2); }
	if (preg_match('/^(.*?\/\/)([^\/]*\/)([^\/]*\/)([^\/]*\/?)/', $ref, $r)) {
		if	($r[3] = 'modules/')	{ return $r[1].$r[2]; }
		elseif	($r[4] = 'modules/')	{ return $r[1].$r[2].$r[3]; }
		else				{ return $r[0]; }
	}
	return '';
}

//	Data Conversion
function lcx_LogEval($OPTION = '') {
	global $xoopsDB;
	if (strstr($OPTION, ';') || strstr($OPTION, "\n")) { exit(); }
	$sql = "SELECT * FROM ".$xoopsDB->prefix("logcounterx_log").$OPTION;
	$result = $xoopsDB->query($sql);
	$RecCnt = 0;
	while ($dat = $xoopsDB->fetchArray($result)) {
		//	Short Remote Host
		$RHShort =	addslashes(lcx_rhshort($dat['remote_host']));
		//	Referer
		if ($dat['referer'] != '') {
			$RefShort =	addslashes(lcx_refshort($dat['referer']));
		} else { $RefShort = ''; }
		if (strpos($dat['referer'], '?') !== false) {
			list($RefURL, $Query) = explode('?', $dat['referer'], 2);
			$QWord =	addslashes(lcx_qu2qw($Query, $RefURL));
			$RefURL =	addslashes($RefURL);
		} else {
			$RefURL =	$dat['referer'];
			$Query =	'';
			$QWord =	'';
		}
		$Browser =	addslashes(lcx_ua2br($dat['user_agent']));
		$OS =		addslashes(lcx_ua2os($dat['user_agent']));
		$RecID =	intval($dat['recid']);
		$sql1 = "UPDATE " . $xoopsDB->prefix("logcounterx_log") . " SET " .
		        " ref_query = '$Query', rh_short = '$RHShort', ref_short = '$RefShort'," .
		        " agent = '$Browser', os = '$OS', qword = '$QWord' WHERE recid = $RecID";
		$res = $xoopsDB->queryF($sql1);
		$RecCnt++;
	}
	unset ($dat, $result);
	return $RecCnt;
}

}
?>