<?php
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

// Convert HTTP_QUERY to query word according to USER_AGENT
/**
 * @param string $query
 * @param string $refhost
 * @return mixed|string
 */
function lcx_qu2qw($query = '', $refhost = '')
{
    if ($query == '') {
        return '';
    }

    if (extension_loaded('mbstring') && (defined('_CHARSET'))) {
        $query = mb_ereg_replace('&amp;', '&', $query);
    } else {
        $query = preg_replace('/&amp;/', '&', $query);
    }
    $q       = array();
    $q_count = 0;
    foreach (explode('&', $query) as $myq) {
        if (strpos($myq, '=')) {
            list($key, $val) = explode('=', $myq, 2);
            $q[$key] = urldecode($val);
            ++$q_count;
        }
    }
    if ($q_count == 0) {
        return '';
    }

    $qwkey = 'q';
    $mbdo  = 'UTF-8';
    if (isset($q['ie'])) {
        $mbdo = $q['ie'];
    }

    //	Japanese
    if (strstr($refhost, '.yahoo.co.jp')) {
        $qwkey = 'p';
        $mbdo  = (isset($q['ei']) ? $q['ei'] : 'EUC-JP');
    } elseif (strstr($refhost, '.msn.co.jp')) {
        $qwkey = 'q';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.excite.co.jp')) {
        $qwkey = 'search';
        $mbdo  = 'SJIS';
    } elseif (strstr($refhost, '.infoseek.co.jp')) {
        $qwkey = 'qt';
        $mbdo  = 'EUC-JP';
    } elseif (strstr($refhost, '.nifty.ne.jp')) {
        $qwkey = 'Text';
        $mbdo  = 'EUC-JP';
    } elseif (strstr($refhost, '.biglobe.ne.jp')) {
        $qwkey = 'q';
        $mbdo  = 'EUC-JP,SJIS';
    } elseif (strstr($refhost, '.fresheye.co.jp')) {
        $qwkey = 'kw';
        $mbdo  = 'EUC-JP';
    } elseif (strstr($refhost, '.aaacafe.ne.jp')) {
        $qwkey = 'q';
        $mbdo  = 'EUC-JP';
    } elseif (strstr($refhost, '.livedoor.com')) {
        $qwkey = 'q';
        $mbdo  = 'EUC-JP';
    } elseif (strstr($refhost, '.goo.ne.jp')) {
        $qwkey = 'MT';
        $mbdo  = 'EUC-JP';
    } elseif (strstr($refhost, '.allabout.co.jp')) {
        $qwkey = 'qs';
        $mbdo  = 'SJIS';
    } elseif (strstr($refhost, '.csj.co.jp')) {
        $qwkey = 'query';
        $mbdo  = 'SJIS';
    }

    //	Chinese
    elseif (strstr($refhost, 'tw.yahoo.com')) {
        $qwkey = 'p';
        $mbdo  = (isset($q['ei']) ? $q['ei'] : 'UTF-8');
    } elseif (strstr($refhost, '.hinet.net')) {
        $qwkey = 'k';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.pchome.com.tw')) {
        $qwkey = 'q';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.baidu.com')) {
        $qwkey = 'wd';
        $mbdo  = (isset($q['ie']) ? $q['ie'] : 'EUC-CN');
    } elseif (strstr($refhost, '.sogou.com')) {
        $qwkey = 'query';
        $mbdo  = 'EUC-CN';
    } elseif (strstr($refhost, '.iask.com')) {
        $qwkey = 'k';
        $mbdo  = 'EUC-CN';
    } elseif (strstr($refhost, '.sina.com.cn')) {
        $qwkey = 'title';
        $mbdo  = 'EUC-CN';
    } elseif (strstr($refhost, '.163.com')) {
        $qwkey = 'q';
        $mbdo  = 'EUC-CN';
    } elseif (strstr($refhost, '.baigoo.com')) {
        $qwkey = 'q';
        $mbdo  = 'EUC-CN';
    } elseif (strstr($refhost, '.openfind.com.tw')) {
        $qwkey = 'query';
        $mbdo  = 'BIG-5';
    } elseif (strstr($refhost, '.yam.com')) {
        $qwkey = 'k';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.sina.com.tx')) {
        $qwkey = 'word';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.yodao.com')) {
        $qwkey = 'q';
        $mbdo  = (isset($q['ue']) ? $q['ue'] : 'EUC-CN');
    }

    //	Korean
    elseif (strstr($refhost, 'kr.seach.yahoo.com')) {
        $qwkey = 'p';
        $mbdo  = 'EUC-KR';
    } elseif (strstr($refhost, '.naver.com')) {
        $qwkey = 'query';
        $mbdo  = 'EUC-KR';
    } elseif (strstr($refhost, '.chol.com')) {
        $qwkey = 'q';
        $mbdo  = 'EUC-KR';
    } elseif (strstr($refhost, '.empas.com')) {
        $qwkey = 'q';
        $mbdo  = 'EUC-KR';
    }

    //	Global & English
    elseif (strstr($refhost, '.live.com')) {
        $qwkey = 'q';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.google.')) {
        $qwkey = 'q';
        $mbdo  = (isset($q['ie']) ? $q['ie'] : 'UTF-8');
    } elseif (strstr($refhost, '.yahoo.')) {
        $qwkey = 'p';
        $mbdo  = (isset($q['ei']) ? $q['ei'] : 'UTF-8');
    } elseif (strstr($refhost, '.yahoofs.')) {
        $qwkey = 'p';
        $mbdo  = (isset($q['ei']) ? $q['ei'] : 'UTF-8');
    } elseif (strstr($refhost, '.dmoz.')) {
        $qwkey = 'search';
        $mbdo  = (isset($q['cs']) ? $q['cs'] : 'UTF-8');
    } elseif (strstr($refhost, '.allabout.')) {
        $qwkey = 'sSearch';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.lycos.')) {
        $qwkey = 'query';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.aol.')) {
        $qwkey = 'query';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.clusty.')) {
        $qwkey = 'query';
        $mbdo  = 'UTF-8';
    } elseif (strstr($refhost, '.entireweb.com')) {
        $qwkey = 'q';
        $mbdo  = 'UTF-8';
    }
    //elseif (strstr($refhost, '.a9.'))		{ $qwkey = '';  	$mbdo = 'UTF-8'; }
    //elseif (strstr($refhost, '.excite.'))		{ $qwkey = '';  	$mbdo = 'UTF-8'; }
    //elseif (strstr($refhost, '.teoma.'))		{ $qwkey = 'q';		$mbdo = 'UTF-8'; }
    //elseif (strstr($refhost, '.msn.'))		{ $qwkey = 'q';		$mbdo = 'UTF-8'; }
    //elseif (strstr($refhost, '.wisenut.'))	{ $qwkey = 'q';		$mbdo = 'UTF-8'; }
    //elseif (strstr($refhost, '.altavista.'))	{ $qwkey = 'q';		$mbdo = 'UTF-8'; }
    //elseif (strstr($refhost, '.gigablast.'))	{ $qwkey = 'q';		$mbdo = 'UTF-8'; }

    //	Tuning
    if (strstr($refhost, '.yahoo.co.jp') && ($mbdo == 'eucJP-win')) {
        $mbdo = 'UTF-8';
    }
    if ($mbdo == 'Shift_JIS') {
        $mbdo = 'SJIS';
    }
    if ($mbdo == 'utf8') {
        $mbdo = 'UTF-8';
    }
    if ($mbdo == '') {
        $mbdo = 'UTF-8';
    }
    $mbdo = strtoupper($mbdo);

    //	Converting
    $qw = '';
    if (($qwkey != '') && isset($q[$qwkey])) {
        $qw = $q[$qwkey];
    }
    if ($qw == '') {
        return '';
    }
    $qw = preg_replace('/cache:[\S]*[\s]?/', '', $qw);
    $qw = trim(str_replace('"', '', $qw));
    $qw = trim(str_replace("'", "", $qw));
    $qw = trim(str_replace("\0", "", $qw));
    $qw = preg_replace("/[\\0-\\31]/", "", $qw);
    if (extension_loaded('mbstring') && (defined('_CHARSET'))) {
        //$mbdoarray = array($mbdo, mb_detect_order());
        $myEncoding = mb_detect_encoding($qw, $mbdo);
        //if ($myEncoding == mb_detect_encoding($qw, $mbdo)) {
        if ($myEncoding != _CHARSET) {
            $qw = mb_convert_encoding($qw, _CHARSET, $myEncoding);
        }
        // $qw = mb_convert_encoding($qw, _CHARSET, 'auto');
        //}
        if (function_exists('mb_convert_kana')) {
            $qw = mb_convert_kana($qw, 'asKV', _CHARSET);
        }
    }
    $qw = preg_replace('/[\s]+/', ' ', trim($qw));
    if ((0 < substr_count($qw, ' ')) && (substr_count($qw, ' ') < 4)) {
        $q_array = explode(' ', $qw);
        sort($q_array, SORT_STRING);
        $qw = trim(implode(' ', $q_array));
    }

    //	Notice : Return value not encoded / sanitized
    return $qw;
}
