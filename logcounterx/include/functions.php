<?php
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

if (!defined('LCX_LIBRARY_LOADED')) {
    define('LCX_LIBRARY_LOADED', 1);

    // Load query conversion function file
    include XOOPS_ROOT_PATH . "/modules/logcounterx/include/query_word.php";

    // Select OS according to USER_AGENT
    /**
     * @param string $agent
     * @return string
     */
    function lcx_ua2os($agent = '')
    {
        if ($agent == '') {
            return 'undefined';
        }

        if (preg_match('/Windows 95/i', $agent) || preg_match('/Win95/i', $agent)) {
            return 'Win95';
        }
        if (preg_match('/Win 9x 4\.90/i', $agent)) {
            return 'WinME';
        }
        if (preg_match('/Windows 98/i', $agent) || preg_match('/Win98/i', $agent)) {
            return 'Win98';
        }
        if (preg_match('/Windows 2000/i', $agent) || preg_match('/Win2000/i', $agent)) {
            return 'Win2000';
        }
        if (preg_match('/Windows NT 5\.0/i', $agent) || preg_match('/WinNT 5\.0/i', $agent)) {
            return 'Win2000';
        }
        if (preg_match('/Windows NT 5\.1/i', $agent) || preg_match('/WinNT 5\.1/i', $agent)) {
            return 'WinXP';
        }
        if (preg_match('/Windows NT 6\.0/i', $agent) || preg_match('/WinNT 6\.0/i', $agent)) {
            return 'WinVista';
        }
        if (preg_match('/Windows NT 6\.1/i', $agent) || preg_match('/WinNT 6\.1/i', $agent)) {
            return 'Windows7';
        }
        if (preg_match('/Windows NT/i', $agent) || preg_match('/WinNT/i', $agent)) {
            return 'WinNT';
        }
        if (preg_match('/Windows XP/i', $agent) || preg_match('/WinXP/i', $agent)) {
            return 'WinXP';
        }
        if (preg_match('/Borg/i', $agent) || preg_match('/Win32/i', $agent)) {
            return 'Win32';
        }
        if (preg_match('/Windows CE/i', $agent) || preg_match('/WinCE/i', $agent)) {
            return 'WinCE';
        }
        if (preg_match('/Mac/i', $agent)) {
            return 'Mac';
        }
        if (preg_match('/OmniWeb/i', $agent) || preg_match('/iCab/i', $agent) || preg_match('/Safari/i', $agent)) {
            return 'Mac';
        }
        if (preg_match('/Lindows/i', $agent)) {
            return 'Lindows';
        }
        if (preg_match('/Linux/i', $agent) || preg_match('/Kondara/i', $agent) || preg_match('/Vine/i', $agent) || preg_match('/Debian/i', $agent)) {
            return 'Linux';
        }
        if (preg_match('/Fedora/i', $agent) || preg_match('/Laser5/i', $agent)) {
            return 'Linux';
        }
        if (preg_match('/BSD/i', $agent)) {
            return 'UNIX (BSD)';
        }
        if (preg_match('/X11/i', $agent) || preg_match('/SunOS/i', $agent) || preg_match('/HP-UX/i', $agent)) {
            return 'UNIX';
        }
        if (preg_match('/AIX/i', $agent) || preg_match('/IRIX/i', $agent) || preg_match('/OSF1/i', $agent)) {
            return 'UNIX';
        }
        if (preg_match('/BTRON/i', $agent)) {
            return 'BTRON';
        }
        if (preg_match('/DreamPassport/i', $agent)) {
            return 'Dreamcast';
        }
        if (preg_match('/DoCoMo/i', $agent)) {
            return 'Docomo';
        }
        if (preg_match('/UP\.Browser/i', $agent)) {
            return 'AU (KDDI)';
        }
        if (preg_match('/Vodafone/i', $agent) || preg_match('/J-PHONE/i', $agent)) {
            return 'Vodafone';
        }
        if (preg_match('/DDIPOCKET/i', $agent) || preg_match('/AH-K3001V/i', $agent)) {
            return 'WILLCOM';
        }
        if (preg_match('/PalmOS/i', $agent)) {
            return 'PalmOS ';
        }
        if (preg_match('/PlayStation /i', $agent)) {
            return 'PlayStation ';
        }

        return '(undefined)';
    }

    // Select BROWSER according to USER_AGENT
    /**
     * @param string $agent
     * @return mixed|string
     */
    function lcx_ua2br($agent = '')
    {
        if ($agent == '') {
            return 'undefined';
        }

        //	Proxy
        if (preg_match('/Google.*Proxy/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }

        //	Robots
        if (preg_match('/aaacafe/i', $agent)) {
            return 'Robot (AAA!CAFE)';
        }
        if (preg_match('/acoon\.de/i', $agent)) {
            return 'Robot (Acoon.de)';
        }
        if (preg_match('/accoona/i', $agent)) {
            return 'Robot (Accoona)';
        }
        if (preg_match('/aggregator:MyRSS.jp/i', $agent)) {
            return 'Robot (MyRSS.jp)';
        }
        if (preg_match('/ArchitextSpider/i', $agent)) {
            return 'Robot (Excite)';
        }
        if (preg_match('/Ask Jeeves/i', $agent)) {
            return 'Robot (Ask Jeeves)';
        }
        if (preg_match('/Baiduspider/i', $agent)) {
            return 'Robot (Baidu)';
        }
        if (preg_match('/BecomeJPBot/i', $agent)) {
            return 'Robot (BecomeJP)';
        }
        if (preg_match('/bingbot/i', $agent)) {
            return 'Robot (Bing)';
        }
        if (preg_match('/Cerberian/i', $agent)) {
            return 'Robot (Cerberian)';
        }
        if (preg_match('/Comaneci_bot/i', $agent)) {
            return 'Robot (i-know.jp)';
        }
        if (preg_match('/Cowbot/i', $agent)) {
            return 'Robot (Naver)';
        }
        if (preg_match('/Convera/i', $agent)) {
            return 'Robot (Convera)';
        }
        if (preg_match('/Twiceler/i', $agent)) {
            return 'Robot (Cuill)';
        }
        if (preg_match('/discobot/i', $agent)) {
            return 'Robot (discovery engine)';
        }
        if (preg_match('/Down Site Checker/i', $agent)) {
            return 'Robot (Yahoo!)';
        }
        if (preg_match('/Drecombot/i', $agent)) {
            return 'Robot (Drecom)';
        }
        if (preg_match('/emyuu_bot/i', $agent)) {
            return 'Robot (Emyuu)';
        }
        if (preg_match('/Ezooms/i', $agent)) {
            return 'Robot (ezoom)';
        }
        if (preg_match('/facebook/i', $agent)) {
            return 'Robot (facebook)';
        }
        if (preg_match('/FAST-WebCrawler/i', $agent)) {
            return 'Robot (fast.no)';
        }
        if (preg_match('/findlinks/i', $agent)) {
            return 'Robot (findlinks)';
        }
        if (preg_match('/Gaisbot/i', $agent)) {
            return 'Robot (Openfind)';
        }
        if (preg_match('/gazz/i', $agent)) {
            return 'Robot (NTTR)';
        }
        if (preg_match('/Gigabot/i', $agent)) {
            return 'Robot (Gigabot)';
        }
        if (preg_match('/Slurp\.so/Goo/i', $agent)) {
            return 'Robot (goo)';
        }
        //	if (preg_match('/Google/i',		$agent)) { return 'Robot (Google)'; }
        if (preg_match('/Googlebot/i', $agent)) {
            return 'Robot (Google)';
        }
        if (preg_match('/grub-client/i', $agent)) {
            return 'Robot (grub-client)';
        }
        if (preg_match('/Hatena Antenna/i', $agent)) {
            return 'Robot (Hatena)';
        }
        if (preg_match('/ia_archiver/i', $agent)) {
            return 'Robot (Archiver)';
        }
        if (preg_match('/iaskspider/i', $agent)) {
            return 'Robot (iAsk)';
        }
        if (preg_match('/\.ibm\.com/i', $agent)) {
            return 'Robot (IBM)';
        }
        if (preg_match('/ichiro/i', $agent)) {
            return 'Robot (NTTR)';
        }
        if (preg_match('/indexpert/i', $agent)) {
            return 'Robot (Fresheye)';
        }
        if (preg_match('/Indy Library/i', $agent)) {
            return 'Robot (Indy Library)';
        }
        if (preg_match('/Infoseek/i', $agent)) {
            return 'Robot (Infoseek)';
        }
        if (preg_match('/Inktomi/i', $agent)) {
            return 'Robot (Inktomi)';
        }
        if (preg_match('/livedoorCheckers/i', $agent)) {
            return 'Robot (LivedoorCheckers)';
        }
        if (preg_match('/Looksmart/i', $agent)) {
            return 'Robot (Looksmart)';
        }
        if (preg_match('/Lycos_Spider/i', $agent)) {
            return 'Robot (Lycos)';
        }
        if (preg_match('/MarkAgent/i', $agent)) {
            return 'Robot (MarkAgent)';
        }
        if (preg_match('/MJ12bot/i', $agent)) {
            return 'Robot (majestic12)';
        }
        if (preg_match('/MLBot/i', $agent)) {
            return 'Robot (Metadata Labs)';
        }
        if (preg_match('/msnbot/i', $agent)) {
            return 'Robot (MSN)';
        }
        if (preg_match('/NaverRobot/i', $agent)) {
            return 'Robot (Naver)';
        }
        if (preg_match('/nyanyu/i', $agent)) {
            return 'Robot (nyanyu)';
        }
        if (preg_match('/ndl-japan/i', $agent)) {
            return 'Robot (ndl-japan)';
        }
        if (preg_match('/NPBot/i', $agent)) {
            return 'Robot (NameProtect)';
        }
        if (preg_match('/Nutch/i', $agent)) {
            return 'Robot (Nutch)';
        }
        if (preg_match('/Nutraspace/i', $agent)) {
            return 'Robot (nutraspace)';
        }
        if (preg_match('/OmniExplorer/i', $agent)) {
            return 'Robot (OmniExplorer)';
        }
        if (preg_match('/onet\.pl/i', $agent)) {
            return 'Robot (onet.pl)';
        }
        if (preg_match('/Pockey-GetHTML/i', $agent)) {
            return 'Robot (GetHTML)';
        }
        if (preg_match('/psbot/i', $agent)) {
            return 'Robot (Picsearch)';
        }
        if (preg_match('/SBIder/i', $agent)) {
            return 'Robot (SiteSell)';
        }
        if (preg_match('/Scooter/i', $agent)) {
            return 'Robot (AltaVista)';
        }
        if (preg_match('/search-hp/i', $agent)) {
            return 'Robot (search-hp)';
        }
        if (preg_match('/Sidewinder/i', $agent)) {
            return 'Robot (Infoseek)';
        }
        if (preg_match('/Sogou/i', $agent)) {
            return 'Robot (Sogou)';
        }
        if (preg_match('/sohu-search/i', $agent)) {
            return 'Robot (Sohu)';
        }
        if (preg_match('/StackRambler/i', $agent)) {
            return 'Robot (Rambler)';
        }
        if (preg_match('/Speedy Spider/i', $agent)) {
            return 'Robot (entireweb)';
        }
        if (preg_match('/Su-Jine/i', $agent)) {
            return 'Robot (Su-Jine)';
        }
        if (preg_match('/TOCC/i', $agent)) {
            return 'Robot (TOCC)';
        }
        if (preg_match('/Ultraseek/i', $agent)) {
            return 'Robot (Ultraseek)';
        }
        if (preg_match('/walhello/i', $agent)) {
            return 'Robot (Walhello)';
        }
        if (preg_match('/WebAlta/i', $agent)) {
            return 'Robot (WebAlta)';
        }
        if (preg_match('/WebCrawler/i', $agent)) {
            return 'Robot (WebCrawler)';
        }
        if (preg_match('/WISEbot/i', $agent)) {
            return 'Robot (WISEbot)';
        }
        if (preg_match('/Y!J-DSC/i', $agent)) {
            return 'Robot (Yahoo!)';
        }
        if (preg_match('/Y!J-BSC/i', $agent)) {
            return 'Robot (Yahoo!)';
        }
        if (preg_match('/Yahoo! /i', $agent)) {
            return 'Robot (Yahoo!)';
        }
        if (preg_match('/Yeti/i', $agent)) {
            return 'Robot (Naver)';
        }
        if (preg_match('/YodaoBot/i', $agent)) {
            return 'Robot (youdao)';
        }
        if (preg_match('/ZyBorg/i', $agent)) {
            return 'Robot (LYCOS)';
        }

        //	Other Robots
        if (preg_match('/crawler/i', $agent)) {
            return 'Robot (others)';
        }
        if (preg_match('/robot/i', $agent)) {
            return 'Robot (others)';
        }
        if (preg_match('/spider/i', $agent)) {
            return 'Robot (others)';
        }
        if (preg_match('/WebBot/i', $agent)) {
            return 'Robot (others)';
        }
        //if (preg_match('/bot/i',		$agent)) { return 'Robot (others)'; }

        //	Automations
        if (preg_match('/Arachmo/i', $agent)) {
            return 'Arachmo';
        }
        if (preg_match('/aggregator:MyRSS/i', $agent)) {
            return 'MyRSS.jp';
        }
        if (preg_match('/bookmark\.ne\.jp/i', $agent)) {
            return 'Bookmark';
        }
        if (preg_match('/Curl/i', $agent)) {
            return 'Curl';
        }
        if (preg_match('/Hatena/i', $agent)) {
            return 'Hatena';
        }
        if (preg_match('/^Java[\d_\/\.]+$/i', $agent)) {
            return 'Program (Java)';
        }
        if (preg_match('/Java\(TM\).*Runtime/i', $agent)) {
            return 'Program (Java)';
        }
        if (preg_match('/libwww-perl/i', $agent)) {
            return 'Program (Perl)';
        }
        if (preg_match('/Microsoft URL Control/i', $agent)) {
            return 'Program (Windows)';
        }
        if (preg_match('/PerManSurfer/i', $agent)) {
            return 'PerManSurfer';
        }
        if (preg_match('/PHP/i', $agent)) {
            return 'Program (PHP)';
        }
        if (preg_match('/POE-Component/i', $agent)) {
            return 'Program (Perl)';
        }
        if (preg_match('/samidare/i', $agent)) {
            return 'samidare';
        }
        if (preg_match('/Snoopy/i', $agent)) {
            return 'Robot (Program (Snoopy))';
        }
        if (preg_match('/snoopy/i', $agent)) {
            return 'Program (PHP)';
        }
        if (preg_match('/Webdup/i', $agent)) {
            return 'Webdup';
        }
        if (preg_match('/WebAuto/i', $agent)) {
            return 'WebAuto';
        }
        if (preg_match('/WebFetch/i', $agent)) {
            return 'WebFetch';
        }
        if (preg_match('/WebWhacker/i', $agent)) {
            return 'WebWhacker';
        }
        if (preg_match('/Wget/i', $agent)) {
            return 'Wget';
        }

        //	Browsers (RSS Reader)
        if (preg_match('/RSS_READER/i', $agent, $a)) {
            return 'RSS_READER';
        }
        if (preg_match('/Headline-Reader/i', $agent, $a)) {
            return 'Headline-Reader';
        }

        //	Other Rorbots   (including Web URL and/or Mail Address)
        if (preg_match('#http:\/\/#i', $agent)) {
            return 'Robot (others)';
        }
        if (preg_match('/[a-z]+@[a-z\.]+/i', $agent)) {
            return 'Robot (others)';
        }

        //	Portable Devices
        if (preg_match('/Android.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/iPad/i', $agent)) {
            if (preg_match('/OS [0-9_]*/i', $agent, $a)) {
                return 'iPad ' . str_replace('_', '.', $a[0]);
            }
        }
        if (preg_match('/iPhone OS [0-9_]*/i', $agent, $a)) {
            return str_replace('_', '.', $a[0]);
        }
        if (preg_match('/BlackBerry[0-9]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Airboard.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/(DDIPOCKET;)([A-Za-z]*)/i', $agent, $a)) {
            return str_replace('/', ' ', $a[1]);
        }
        if (preg_match('/DoCoMo.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/DreamPassport.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/J-PHONE.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/jig.browser.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/NetFront.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/UP\.Browser.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Vodafone.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }

        //	Browsers
        if (preg_match('/Camino.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Cuam.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/CubeBrowser.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Donut.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Firebird.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Firefox.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        //	if (preg_match('/FunWebProducts/i',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
        if (preg_match('/Galeon.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Hotbar.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' /i', $a[0]);
        }
        if (preg_match('/HotJava.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' /i', $a[0]);
        }
        if (preg_match('/iCab.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Konqueror.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Lunascape.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' /i', $a[0]);
        }
        if (preg_match('/Lynx.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        //	if (preg_match('/MathPlayer /i',		$agent, $a)) { return str_replace('/', ' ', $a[0]); }
        if (preg_match('/Maxthon/i', $agent, $a)) {
            return str_replace('/', ' /i', $a[0]);
        }
        if (preg_match('/NetFront.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Ninja.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/NSPlayer.[0-9]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/OmniWeb.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Opera.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/PageNest.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' /i', $a[0]);
        }
        if (preg_match('/PageNest Pro.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Phoenix.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' /i', $a[0]);
        }
        if (preg_match('/Safari.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' /i', $a[0]);
        }
        //	if (preg_match('/SeaMonkey/i',			$agent, $a)) { return str_replace('/', ' /i', $a[0]); }
        if (preg_match('/Shiira.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Sleipnir/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/Sylera.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        //	if (preg_match('/toolbar/i',			$agent, $a)) { return str_replace('/', ' ', $a[0]); }
        if (preg_match('/TulipChain.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/w3m.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/WWWC.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }

        //	Browsers
        if (preg_match('/Chrome.[0-9]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/compatible;[\s]+(MSIE.[0-9\.]*)/i', $agent, $a)) {
            return str_replace('/', ' ', $a[1]);
        }
        if (preg_match('/^Mozilla/i', $agent) && preg_match('/(compatible; )([a-zA-Z \/]*[0-9\.]*)/i', $agent, $a)) {
            return str_replace('/', ' ', $a[2]);
        }
        if (preg_match('/^Mozilla.[0-9\.]*/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }
        if (preg_match('/^([a-zA-Z\/]+.[0-9\.]*)$/i', $agent, $a)) {
            return str_replace('/', ' ', $a[0]);
        }

        return '(undefined)';
    }

    /**
     * @param $rh
     * @return string
     */
    function lcx_rhshort($rh)
    {
        if (preg_match('/^[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+$/', $rh)) {
            return '';
        }
        if (preg_match('(/\.([^\.]*)){1,3}$/i', $rh, $r)) {
            $rh = $r[0];
        }
        if (preg_match('/^([^\.]*)\.(.*)$/i', $rh, $r)) {
            return $r[2];
        }

        return '';
    }

    /**
     * @param $ref
     * @return string
     */
    function lcx_refshort($ref)
    {
        if (trim($ref == '')) {
            return '';
        }
        if (!preg_match('/^(http:\/\/|https:\/\/|ftp:\/\/)/', trim($ref))) {
            return 'Irregular Expression';
        }
        if (strpos('?', $ref) !== false) {
            list($ref, $query) = explode($ref, '?', 2);
        }
        if (preg_match('/^(.*?\/\/)([^\/]*\/)([^\/]*\/)([^\/]*\/?)/', $ref, $r)) {
            if ($r[3] = 'modules/') {
                return $r[1] . $r[2];
            } elseif ($r[4] = 'modules/') {
                return $r[1] . $r[2] . $r[3];
            } else {
                return $r[0];
            }
        }

        return '';
    }

    //	Data Conversion
    /**
     * @param string $OPTION
     * @return int
     */
    function lcx_LogEval($OPTION = '')
    {
        global $xoopsDB;
        if (strstr($OPTION, ';') || strstr($OPTION, "\n")) {
            exit();
        }
        $sql    = "SELECT * FROM " . $xoopsDB->prefix("logcounterx_log") . $OPTION;
        $result = $xoopsDB->query($sql);
        $RecCnt = 0;
        while ($dat = $xoopsDB->fetchArray($result)) {
            //	Short Remote Host
            $RHShort = addslashes(lcx_rhshort($dat['remote_host']));
            //	Referer
            $RefShort = '';
            if ($dat['referer'] != '') {
                $RefShort = addslashes(lcx_refshort($dat['referer']));
            }
            if (strpos($dat['referer'], '?') !== false) {
                list($RefURL, $Query) = explode('?', $dat['referer'], 2);
                $QWord  = addslashes(lcx_qu2qw($Query, $RefURL));
                $RefURL = addslashes($RefURL);
            } else {
                $RefURL = $dat['referer'];
                $Query  = '';
                $QWord  = '';
            }
            $Browser = addslashes(lcx_ua2br($dat['user_agent']));
            $OS      = addslashes(lcx_ua2os($dat['user_agent']));
            $RecID   = (int)($dat['recid']);
            $sql1    = "UPDATE " . $xoopsDB->prefix("logcounterx_log") . " SET " .
                       " ref_query = '$Query', rh_short = '$RHShort', ref_short = '$RefShort'," .
                       " agent = '$Browser', os = '$OS', qword = '$QWord' WHERE recid = $RecID";
            $res     = $xoopsDB->queryF($sql1);
            ++$RecCnt;
        }
        unset($dat, $result);

        return $RecCnt;
    }
}
