<?php
if (!defined('XOOPS_ROOT_PATH')) { exit(); }

define("_LCX_ADM_CONFIG",	"設定 ");
define("_LCX_ADM_GENCONF",	"一般設定");
define("_LCX_ADM_LOGCONF", 	"詳細設定");
define("_LCX_ADM_REPCONF", 	"レポート設定");
define("_LCX_ADM_REBUILD", 	"ログの再構築");
define("_LCX_ADM_IMGSLCT", 	"画像選択");
define("_LCX_ADM_DBCHECK", 	"ＤＢチェック");
define("_LCX_ADM_BLOCKSADMIN", 	"ブロック管理");
define("_LCX_ADM_GENCONF_DESC",	"表示するカウンタの内容等を設定します");
define("_LCX_ADM_LOGCONF_DESC",	"カウント初期値やレポート対象外ホスト等を設定します");
define("_LCX_ADM_REPCONF_DESC",	"レポートの表示内容を設定します");
define("_LCX_ADM_REBUILD_DESC",	"ログ内の検索語やＯＳタイプ等を再判定します　（多少時間がかかります）<br />Protectorモジュール使用の場合は、F5アタックと誤認される危険性があります");
define("_LCX_ADM_IMGSLCT_DESC",	"カウンタ表示に使う画像を選択します　（サーバの設定によっては機能しません）");
define("_LCX_ADM_DBCHECK_DESC", 	"データベースのチェックと最適化を行います");
define("_LCX_ADM_BLOCKSADMIN_DESC", 	"ブロック管理を行います (Thanks to GIJOE.)");

define("_LCX_ADM_CUPBLK_SET",	"カウントブロックを自動でセットアップ");
define("_LCX_ADM_CUPBLK_TITL",	"カウントブロック管理");
define("_LCX_ADM_CUPBLK_DESC",	"カウントブロックの管理画面を確認します");

define("_LCX_ADM_RESETCOUNT_TITLE",	"カウント初期値");
define("_LCX_ADM_LOGCOUNT_TITLE",	"← ログデータ中の最大カウント(参考)");
define("_LCX_ADM_RESETCOUNT_DESC",	"現在のカウントを任意の値に変更します");
define("_LCX_ADM_TIMEOFFSET_NAME",	"日時オフセット (-12 〜 +12)");
define("_LCX_ADM_TIMEOFFSET_DESC",	"海外にサーバがある場合等、サーバ日時とレポート用日時の差分を時間単位で入力してください<br />下の「補正後日時」があなたの時計と合っていれば何もしないでください");
define("_LCX_ADM_TIMEOFFSET_SVTM",	"サーバ日時：");
define("_LCX_ADM_TIMEOFFSET_ADTM",	"補正後日時：");
define("_LCX_ADM_ADDIP_TITLE",		"レポート対象外ホスト追加");
define("_LCX_ADM_ADDIP_DESC",		"レポート出力時に無視するホストを追加します<br />%がワイルドカードとして使えます<br />(例：%.googlebot.com)");
define("_LCX_ADM_ADDREF_TITLE",		"レポート対象外リファラ追加");
define("_LCX_ADM_ADDREF_DESC",		"レポート出力時に無視するリファラ（リンク元）文字列を追加します<br />指定した文字列が含まれるリファラ（リンク元）が対象外になります");
define("_LCX_ADM_YOURHOST_TITLE",	"あなたのアクセス元");
define("_LCX_ADM_YOURHOST_ADD",		"レポート対象外にする");
define("_LCX_ADM_DELETEIP_TITLE",	"対象外ホスト削除");
define("_LCX_ADM_DELETEIP_DESC",	"レポート出力時に無視するホストを削除します");
define("_LCX_ADM_DELETEREF_TITLE",	"対象外リファラ削除");
define("_LCX_ADM_DELETEREF_DESC",	"レポート出力時に無視するリファラ（リンク元）文字列を削除します");

define("_LCX_ADM_REPORTING_TITLE",	"レポート対象");
define("_LCX_ADM_REPORTING_DESC",	"レポート対象とするアクセス者を設定します");
define("_LCX_ADM_REPORTING_ALL",	"全部");
define("_LCX_ADM_REPORTING_WORBT",	"ロボットを除く");
define("_LCX_ADM_REPORTING_ROBOT",	"ロボットのみ");

define("_LCX_ADM_BY_R2",	"参照元ＵＲＬ別（サマリー）表示");
define("_LCX_ADM_BY_OS",	"クライアントＯＳ別表示");
define("_LCX_ADM_BY_BR",	"ブラウザ別表示");
define("_LCX_ADM_BY_RC",	"最近の日別表示");
define("_LCX_ADM_BY_DR",	"日別（アクセスの多い順）表示");
define("_LCX_ADM_BY_WD",	"曜日別表示");
define("_LCX_ADM_BY_TM",	"時間帯別表示");
define("_LCX_ADM_BY_HN",	"アクセス元ドメイン別表示");
define("_LCX_ADM_BY_RF",	"参照元ＵＲＬ（最近）表示");
define("_LCX_ADM_BY_QW",	"検索ワード別表示");
define("_LCX_ADM_BY_UN",	"XOOPSユーザ名別表示");
define("_LCX_ADM_BY_PI",	"当サイト内訪問先別表示");
define("_LCX_ADM_REFLINK",	"ＵＲＬをリンクにする");

define("_LCX_ADM_FOR_GUEST",	"ゲスト用表示：");
define("_LCX_ADM_FOR_USERS",	"登録者用表示：");
define("_LCX_ADM_FOR_ADMIN",	"管理者用表示：");
define("_LCX_ADM_GUEST",	"訪問者全員　");
define("_LCX_ADM_USERS",	"登録者全員　");
define("_LCX_ADM_ADMIN",	"管理者のみ　");
define("_LCX_ADM_NOONE",	"表示しない　");

define("_LCX_ADM_ROWLIMIT",	"表示件数");

define("_LCX_ADM_IMGNOW",	"現在の画像");
define("_LCX_ADM_STYLE",	"文字表示スタイル (SPANタグ)");

define("_LCX_ADM_DAY_NAME",	"本日：");
define("_LCX_ADM_DAY_DESC",	"本日のカウント数を表示しますか");
define("_LCX_ADM_YDAY_NAME",	"昨日：");
define("_LCX_ADM_YDAY_DESC",	"昨日のカウント数を表示しますか");
define("_LCX_ADM_WEEK_NAME",	"今週：");
define("_LCX_ADM_WEEK_DESC",	"今週のカウント数を表示しますか");
define("_LCX_ADM_MONTH_NAME",	"今月：");
define("_LCX_ADM_MONTH_DESC",	"今月のカウント数を表示しますか");
define("_LCX_ADM_AVE_NAME",	"平均：");
define("_LCX_ADM_AVE_DESC",	"平均カウント数を表示しますか（当モジュール動作開始以来の平均です）");
define("_LCX_ADM_IPIT_NAME",	"アクセス間隔");
define("_LCX_ADM_IPIT_DESC",	"同一IPアドレスからのアクセスをカウントしない時間（秒数）");
define("_LCX_ADM_NOROBCNT_NAME","ロボットをカウントしない");
define("_LCX_ADM_NOROBCNT_DESC","サーチロボットからのアクセスではカウントアップを行わない");
define("_LCX_ADM_NOHSTCNT_NAME","レポート対象外ホストをカウントしない");
define("_LCX_ADM_NOHSTCNT_DESC","レポート対象外からのアクセスではカウントアップを行わない<br />ホストの設定は、レポート対象外ホスト追加で行います");
define("_LCX_ADM_MAXWIDTH_NAME","レポートバーの最大幅");
define("_LCX_ADM_MAXWIDTH_DESC","レポート画面の横バーの最大幅をピクセル値で指定します");

define("_LCX_ADM_LOGLIM_NAME",		"ログ最大保存数");
define("_LCX_ADM_LOGLIM_DESC",		"データベースに保存するレコード数上限");
define("_LCX_ADM_USER_COOKIE_NAME",	"ユーザをCookieで判定");
define("_LCX_ADM_USER_COOKIE_DESC",	"ユーザ判定にCookieのみを使用しますか");
define("_LCX_ADM_GETHOST_NAME",		"ホスト参照");
define("_LCX_ADM_GETHOST_DESC",		"レポートにホスト参照関数(GetHostByAddress)を使いますか<br />使う場合にはレスポンスが遅くなることがあります");

define("_LCX_ADM_BROS_NAME",	"ブラウザリスト");
define("_LCX_ADM_BROS_DESC",	"アクセスがあったブラウザ(USER_AGENT)を一覧表示します");
define("_LCX_ADM_QWORDS_NAME",	"検索語リスト");
define("_LCX_ADM_QWORDS_DESC",	"全検索語をリストアップ表示します");

define("_LCX_ADM_USEIMG",	"カウンタ表示");
define("_LCX_ADM_IMG",		"画像を使う");
define("_LCX_ADM_CHR",		"文字を使う");
define("_LCX_ADM_CHGIMG_NOTE",	"※テーマ名と同じディレクトリの画像が、この設定より優先して表示されます");

define ("_LCX_ADM_CHKDB_Name",		"テーブル名");
define ("_LCX_ADM_CHKDB_Rows",		"データ数");
define ("_LCX_ADM_CHKDB_Data_length",	"サイズ");
define ("_LCX_ADM_CHKDB_Avg_row_length","平均サイズ");
define ("_LCX_ADM_CHKDB_Data_free",	"空領域");
define ("_LCX_ADM_CHKDB_Update_time",	"更新日時");
define ("_LCX_ADM_CHKDB_OPTIMIZE_DESC",	"空領域が大きい場合、OPTIMIZEを実行してください。<br />ただし、処理には時間がかかることがあり、その間テーブルへのアクセスができません。");
?>