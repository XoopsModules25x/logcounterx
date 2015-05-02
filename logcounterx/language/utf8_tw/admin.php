<?php
define("_LCX_ADM_CONFIG", "LOG計數器設定 (LogCounterX)");
define("_LCX_ADM_GENCONF", "基本設定");
define("_LCX_ADM_LOGCONF", "詳細設定");
define("_LCX_ADM_REPCONF", "報表設定");
define("_LCX_ADM_REBUILD", "重新建立LOG");
define("_LCX_ADM_IMGSLCT", "圖檔選擇");
define("_LCX_ADM_DBCHECK", "資料庫測定");
define("_LCX_ADM_BLOCKSADMIN", "區塊管理");
define("_LCX_ADM_GENCONF_DESC", "要顯示的計數器內容設定");
define("_LCX_ADM_LOGCONF_DESC", "計數初期值以及報表對象外等設定");
define("_LCX_ADM_REPCONF_DESC", "報表的顯示內容設定");
define("_LCX_ADM_REBUILD_DESC", "將紀錄的LOG再重新判定一次（依紀錄之多寡可能時間會比較久）");
define("_LCX_ADM_IMGSLCT_DESC", "選擇計數器要使用的圖檔　（由於伺服器的設定有些並無法使用）");
define("_LCX_ADM_DBCHECK_DESC", "偵測資料庫定將資料庫最佳化");
define("_LCX_ADM_BLOCKSADMIN_DESC", "執行區塊管理 (Thx to Mr.GIJOE.)");

define("_LCX_ADM_CUPBLK_SET", "計數區塊自動安裝");
define("_LCX_ADM_CUPBLK_TITL", "計數區塊管理");
define("_LCX_ADM_CUPBLK_DESC", "確認計數區塊的管理畫面");

define("_LCX_ADM_RESETCOUNT_TITLE", "計數初期值");
define("_LCX_ADM_LOGCOUNT_TITLE", "← LOG資料的紀錄數量(參考)");
define("_LCX_ADM_RESETCOUNT_DESC", "可以任意變更目前的計數值");
define("_LCX_ADM_TIMEOFFSET_NAME", "時區 (-12 ～ +12)");
define("_LCX_ADM_TIMEOFFSET_DESC", "如果您的伺服器是在海外可以利用這項功能設定時區的時數差<br />以下的「修正後時間」如果跟您目前的時間是吻合的就不需設定");
define("_LCX_ADM_TIMEOFFSET_SVTM", "伺服器時間：");
define("_LCX_ADM_TIMEOFFSET_ADTM", "修正後時間：");
define("_LCX_ADM_ADDIP_TITLE", "設定排除於報表紀錄內的HOST");
define("_LCX_ADM_ADDIP_DESC", "展示報表時可以忽略不做紀錄的HOST<br />%符號可以當作所有來使用<br />(例如：%.googlebot.com)");
define("_LCX_ADM_YOURHOST_TITLE", "您的HOST所在");
define("_LCX_ADM_ADDREF_TITLE", "排除在外的Referer");
//define("_LCX_ADM_ADDREF_TITLE",		"Except Referer");
define("_LCX_ADM_ADDREF_DESC", "將報表被設定忽略的Referer排除<br />下列的Referer將不被列於報表上");
//define("_LCX_ADM_ADDREF_DESC",		"Set Referer not to be on Report<br />Referer including this string are not to be reported.");
define("_LCX_ADM_DELETEREF_TITLE", "排除在外的Referer");
//define("_LCX_ADM_DELETEREF_TITLE",	"Excepted Referer");
define("_LCX_ADM_DELETEREF_DESC", "將報表被忽略的Referer從名單上刪除<br />(Referer將出現於報表上)");
//define("_LCX_ADM_DELETEREF_DESC",	"Delete Referer from Execpting List<br />(Set Referer to be on Report)");
define("_LCX_ADM_YOURHOST_ADD", "設定為報表資料外");
define("_LCX_ADM_DELETEIP_TITLE", "排除對象的HOST");
define("_LCX_ADM_DELETEIP_DESC", "將報表被設定忽略的HOST排除");

define("_LCX_ADM_REPORTING_TITLE", "報表對象");
define("_LCX_ADM_REPORTING_DESC", "設定報表對象的指定");
define("_LCX_ADM_REPORTING_ALL", "全部");
define("_LCX_ADM_REPORTING_WORBT", "除了機器人以外");
define("_LCX_ADM_REPORTING_ROBOT", "只紀錄機器人");

define("_LCX_ADM_BY_R2", "顯示參照網址");
define("_LCX_ADM_BY_OS", "系統分析");
define("_LCX_ADM_BY_BR", "瀏覽器分析");
define("_LCX_ADM_BY_RC", "近日終的資料");
define("_LCX_ADM_BY_DR", "顯示日別（連結多的順序）");
define("_LCX_ADM_BY_WD", "顯示星期別");
define("_LCX_ADM_BY_TM", "顯示時間別");
define("_LCX_ADM_BY_HN", "顯示連結來的網址");
define("_LCX_ADM_BY_RF", "顯示參照網址（近日）");
define("_LCX_ADM_BY_QW", "搜尋關鍵字別的顯示");
define("_LCX_ADM_BY_UN", "XOOPS會員別的顯示");
define("_LCX_ADM_BY_PI", "站內頁面分析");
define("_LCX_ADM_REFLINK", "將網址自動連結");

define("_LCX_ADM_FOR_GUEST", "訪客觀看顯示：");
define("_LCX_ADM_FOR_USERS", "會員觀看顯示：");
define("_LCX_ADM_FOR_ADMIN", "管理員觀看顯示：");
define("_LCX_ADM_GUEST", "所有來訪者　");
define("_LCX_ADM_USERS", "所有的會員　");
define("_LCX_ADM_ADMIN", "只限管理員　");
define("_LCX_ADM_NOONE", "不顯示　");

define("_LCX_ADM_ROWLIMIT", "顯示件數");

define("_LCX_ADM_IMGNOW", "目前的圖檔");
define("_LCX_ADM_STYLE", "以文字模式 (使用SPAN標籤)");

define("_LCX_ADM_DAY_NAME", "今日：");
define("_LCX_ADM_DAY_DESC", "要顯示今天的計數嗎？");
define("_LCX_ADM_YDAY_NAME", "昨天：");
define("_LCX_ADM_YDAY_DESC", "要顯示昨天的計數嗎？");
define("_LCX_ADM_WEEK_NAME", "本週：");
define("_LCX_ADM_WEEK_DESC", "要顯示本週的計數嗎？");
define("_LCX_ADM_MONTH_NAME", "本月：");
define("_LCX_ADM_MONTH_DESC", "要顯示本月份的計數嗎？");
define("_LCX_ADM_AVE_NAME", "平均：");
define("_LCX_ADM_AVE_DESC", "要顯示平均人數嗎？（這裡計算本模組成功安裝以來的平均）");
define("_LCX_ADM_IPIT_NAME", "連結時間間隔");
define("_LCX_ADM_IPIT_DESC", "相同IP的連結不重複計數的間隔時間設定（秒數）");
define("_LCX_ADM_NOROBCNT_NAME", "不紀錄機器人");
define("_LCX_ADM_NOROBCNT_DESC", "由搜尋引擎所送發來的機器人不執行計數的紀錄");
define("_LCX_ADM_NOHSTCNT_NAME", "不紀錄排外的HOST計數");
define("_LCX_ADM_NOHSTCNT_DESC", "在報表中設定排外的HOST所連結而來將不做計數<br />HOST的設定請設定於排除對象的HOST裡");
define("_LCX_ADM_MAXWIDTH_NAME", "條狀圖最大寬度");
//define("_LCX_ADM_MAXWIDTH_NAME","Max Width or Reporting Bar");
define("_LCX_ADM_MAXWIDTH_DESC", "輸入報表上的條狀圖最大數值 (寬度)");
//define("_LCX_ADM_MAXWIDTH_DESC","Input Maximum Size (Width) of Bar-Image on Reporting");

define("_LCX_ADM_LOGLIM_NAME", "LOG最大保存數");
define("_LCX_ADM_LOGLIM_DESC", "保存於資料庫裡的LOG數上限");
define("_LCX_ADM_USER_COOKIE_NAME", "用 Cookies 偵測");
//define("_LCX_ADM_USER_COOKIE_NAME",	"User by Cookies");
define("_LCX_ADM_USER_COOKIE_DESC", "只用 Cookies 來偵測使用者");
//define("_LCX_ADM_USER_COOKIE_DESC",	"Detect User Only by Cookies");
define("_LCX_ADM_GETHOST_NAME", "對照HOST");
define("_LCX_ADM_GETHOST_DESC", "是否於報表內使用對照的函數(GetHostByAddress)？<br />如果使用將會多少影響速度");

define("_LCX_ADM_BROS_NAME", "瀏灠器一覽");
define("_LCX_ADM_BROS_DESC", "是否要顯示訪問者所使用的瀏覽器一覽(USER_AGENT)？");
define("_LCX_ADM_QWORDS_NAME", "搜尋關鍵字表");
define("_LCX_ADM_QWORDS_DESC", "是否顯示所有搜尋關鍵字一覽表？");

define("_LCX_ADM_USEIMG", "顯示計數器");
define("_LCX_ADM_IMG", "使用圖形");
define("_LCX_ADM_CHR", "使用文字");

define("_LCX_ADM_CHKDB_NAME", "資料庫名稱");
define("_LCX_ADM_CHKDB_ROWS", "資料數量");
define("_LCX_ADM_CHKDB_DATA_LENGTH", "大小");
define("_LCX_ADM_CHKDB_AVG_ROW_LENGTH", "平均大小");
define("_LCX_ADM_CHKDB_DATA_FREE", "剩餘領域");
define("_LCX_ADM_CHKDB_UPDATE_TIME", "更新日期");
define("_LCX_ADM_CHKDB_OPTIMIZE_DESC", "如果剩餘領域充足的話請執行OPTIMIZE。<br />但是在處理時間上可能會比較長，並且在執行過程中不可另外連結資料庫。");
