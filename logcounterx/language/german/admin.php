<?php
if (!defined('XOOPS_ROOT_PATH')) { exit(); }

define("_LCX_ADM_CONFIG",	" Einstellungen ");
define("_LCX_ADM_GENCONF",	"Allgemeine Einstellungen");
define("_LCX_ADM_LOGCONF", 	"Erweiterte Einstellungen");
define("_LCX_ADM_REPCONF", 	"Berichtseinstellungen");
define("_LCX_ADM_REBUILD", 	"Protokoldaten neu berechnen");
define("_LCX_ADM_IMGSLCT", 	"Counter-Bild Auswahl");
define("_LCX_ADM_DBCHECK", 	"Datenbank &uuml,berpr&uuml;fen");
define("_LCX_ADM_BLOCKSADMIN", 	"Blockeinstellungen");
define("_LCX_ADM_GENCONF_DESC",	"Counter-Anzeige");
define("_LCX_ADM_LOGCONF_DESC", "Berichte Allgemeine Einstellungen");
define("_LCX_ADM_REPCONF_DESC", "Berichtsanzeige");
define("_LCX_ADM_REBUILD_DESC", "Protokoldaten neu berechnen<br />Dies nimmt viel Zeit in Anspruch.");
define("_LCX_ADM_IMGSLCT_DESC", "W&auml;hlen Sie das Counter-Bild (die Counterbilder) aus");
define("_LCX_ADM_DBCHECK_DESC", 	"Datenbank &uuml;berpr&uuml;fen und optimieren");
define("_LCX_ADM_BLOCKSADMIN_DESC", 	"Blockseinstellungen. (Dank an GIJOE.)");

define("_LCX_ADM_CUPBLK_SET",	"Automatische Einrichtung 'Count-Up Block'");
define("_LCX_ADM_CUPBLK_TITL",	"Count-Up Block Einstellungen");
define("_LCX_ADM_CUPBLK_DESC",	"Einstellungen des 'Count-Up Blocks' &uuml;berpr&uuml;fen und ver&auml;ndern");

define("_LCX_ADM_RESETCOUNT_TITLE",	"Counter-Startwert");
define("_LCX_ADM_LOGCOUNT_TITLE",	"&lt;- Max. Z&auml;hlerwert in der Datenbank (F&uuml;r Ihre Information)");
define("_LCX_ADM_RESETCOUNT_DESC",	"Setzen Sie den Startwert des Counters");
define("_LCX_ADM_TIMEOFFSET_NAME",	"Zeitversatz (-12 .. +12)");
define("_LCX_ADM_TIMEOFFSET_DESC",	"W&auml;hlen Sie den Zeitversatz (Stunden), um die Serverzeit an Ihre Zeitzone anzupassen");
define("_LCX_ADM_TIMEOFFSET_SVTM",	"Serverzeit  ÅF");
define("_LCX_ADM_TIMEOFFSET_ADTM",	"Angepasste Zeit ÅF");
define("_LCX_ADM_ADDIP_TITLE",		"Anbietername ausschlie&szlig;en");
define("_LCX_ADM_ADDIP_DESC",		"Setzen Sie den Anbieternamen, der nicht in die Statistiken aufgenommen werden soll<br />Sie K&ouml;nnen '%' als Platzhalter benutzen");
define("_LCX_ADM_ADDREF_TITLE",		"Referer ausschlie&szlig;en");
define("_LCX_ADM_ADDREF_DESC",		"Setzen Sie den Referer, der nicht in die Statistiken aufgenommen werden soll<br />Referer, die diese Zeichenfolge enthalten, werden nicht aufgenommen.");
define("_LCX_ADM_YOURHOST_TITLE",	"Ihr Anbieter");
define("_LCX_ADM_YOURHOST_ADD",		"Soll Ihr Anbieter von den Statistiken ausgeschlossen werden?");
define("_LCX_ADM_DELETEIP_TITLE",	"Anbieter ausschlie&szlig;en");
define("_LCX_ADM_DELETEIP_DESC",	"Anbieter aus Ausnahmeliste l&ouml;schen<br />(Anbietername in Statistiken aufnehmen)");
define("_LCX_ADM_DELETEREF_TITLE",	"Ausgeschlossene Referer");
define("_LCX_ADM_DELETEREF_DESC",	"Referer von Ausnahmeliste l&ouml;schen<br />(Referer in Statistiken aufnehmen)");

define("_LCX_ADM_REPORTING_TITLE",	"Auswertung");
define("_LCX_ADM_REPORTING_DESC",	"Benutzertyp ausw&auml;hlen");
define("_LCX_ADM_REPORTING_ALL",	"Alle");
define("_LCX_ADM_REPORTING_WORBT",	"Suchmaschinenrobot ausschlie&szlig;en");
define("_LCX_ADM_REPORTING_ROBOT",	"Suchmaschinenrobit");

define("_LCX_ADM_BY_R2",	"nach Referer (Zusammenfassung)");
define("_LCX_ADM_BY_OS",	"nach betriebssystem");
define("_LCX_ADM_BY_BR",	"nach Browser");
define("_LCX_ADM_BY_RC",	"Letzte Tage");
define("_LCX_ADM_BY_DR",	"nach Tag (Sortiert nach Zugriff/Tag)");
define("_LCX_ADM_BY_WD",	"nach Wochentag");
define("_LCX_ADM_BY_TM",	"nach Zeit (Stunde)");
define("_LCX_ADM_BY_HN",	"nach Remote Anbieter");
define("_LCX_ADM_BY_RF",	"nach Referer (Letzter Zugriff)");
define("_LCX_ADM_BY_QW",	"nach Suchwort");
define("_LCX_ADM_BY_UN",	"nach XOOPS-Username");
define("_LCX_ADM_BY_PI",	"nach Eingangsseite");
define("_LCX_ADM_REFLINK",	"Link auf Referer setzen");

define("_LCX_ADM_FOR_GUEST",	"GAST : ");
define("_LCX_ADM_FOR_USERS",	"USER : ");
define("_LCX_ADM_FOR_ADMIN",	"ADMIN : ");
define("_LCX_ADM_GUEST",	"Alle (inklusive GAST) ");
define("_LCX_ADM_USERS",	"Nur User ");
define("_LCX_ADM_ADMIN",	"Administratoren ");
define("_LCX_ADM_NOONE",	"Keiner ");

define("_LCX_ADM_ROWLIMIT",	"Bericht begrenzen (Top XX Daten)");

define("_LCX_ADM_IMGNOW",	"Aktuelle Bilder");
define("_LCX_ADM_STYLE",	"Font Style (SPAN-TAG)");

define("_LCX_ADM_DAY_NAME",	"Heute : ");
define("_LCX_ADM_DAY_DESC",	"Z&auml;hler von Heute");
define("_LCX_ADM_YDAY_NAME",	"Gestern : ");
define("_LCX_ADM_YDAY_DESC",	"Z&auml;hler von Gestern");
define("_LCX_ADM_WEEK_NAME",	"Diese Woche : ");
define("_LCX_ADM_WEEK_DESC",	"Z&auml;hler von dieser Woche (seit Sonntag)");
define("_LCX_ADM_MONTH_NAME",	"Dieser Monat : ");
define("_LCX_ADM_MONTH_DESC",	"Z&auml;hler von diesem Monat");
define("_LCX_ADM_AVE_NAME",	"Durchschnitt : ");
define("_LCX_ADM_AVE_DESC",	"T&auml;glicher Durchschnitt (Seit Modulinstallation)");
define("_LCX_ADM_IPIT_NAME",	"Z&auml;hlerinterval");
define("_LCX_ADM_IPIT_DESC",	"Besuchsinterval f&uuml;r gleiche IP-Adresse (Sekunden)");
define("_LCX_ADM_NOROBCNT_NAME","Robotzugriffe weglassen");
define("_LCX_ADM_NOROBCNT_DESC","Zugriffe von Suchmaschinen weglassen");
define("_LCX_ADM_NOHSTCNT_NAME","Ausgeschlossene Anbieter weglassen");
define("_LCX_ADM_NOHSTCNT_DESC","Zugriffe von ausgeschlossenen Anbietern weglassen<br />Sie k&ouml;nnen Anbieter &uuml;ber die 'Berichtsanzeige'-Einstellunge l&ouml;schen oder hinzu&uuml;gen");
define("_LCX_ADM_MAXWIDTH_NAME","Max. Breite des Berichts");
define("_LCX_ADM_MAXWIDTH_DESC","Geben Sie hier die maximale Breite f&uuml;r den Balken im Bericht an");

define("_LCX_ADM_LOGLIM_NAME",		"Beschr&auml;nkung des Berichts");
define("_LCX_ADM_LOGLIM_DESC",		"Beschr&auml;nkung des Berichts (Anzahl der Berichte)");
define("_LCX_ADM_USER_COOKIE_NAME",	"User nach Cookies");
define("_LCX_ADM_USER_COOKIE_DESC",	"Benutzer nur anhand von Cookies erkennen");
define("_LCX_ADM_GETHOST_NAME",		"GetHostByAddress");
define("_LCX_ADM_GETHOST_DESC",		"Benutzen Sie die 'GetHostByAddress'-Funktion im Bericht<br />Kann Reaktion verlangsamen");

define("_LCX_ADM_BROS_NAME",	"Liste der Browser");
define("_LCX_ADM_BROS_DESC",	"Liste aller Browser (User-Agents)");
define("_LCX_ADM_QWORDS_NAME",	"Liste der Suchw&ouml;rter");
define("_LCX_ADM_QWORDS_DESC",	"Liste aller eingegebener Suchw&ouml;rter");

define("_LCX_ADM_USEIMG",	"Counter-Anzeige");
define("_LCX_ADM_IMG",		"nach Bild");
define("_LCX_ADM_CHR",		"nach Zeichen");
define("_LCX_ADM_CHGIMG_NOTE",	"Unabh&auml;gig von dieser Einstellungen werden vorrangig die Bilder benutzt, die sich im Verzeichnis mit dem gleichen Namen wie das aktive Theme befinden.");

define ("_LCX_ADM_CHKDB_Name",		"Tabellenname");
define ("_LCX_ADM_CHKDB_Rows",		"Datenreihen");
define ("_LCX_ADM_CHKDB_Data_length",	"Datengr&ouml;&szlig;e");
define ("_LCX_ADM_CHKDB_Avg_row_length","Gr&ouml;&szlig;e/Reihen");
define ("_LCX_ADM_CHKDB_Data_free",	"Freier Platz");
define ("_LCX_ADM_CHKDB_Update_time",	"Update am");
define ("_LCX_ADM_CHKDB_OPTIMIZE_DESC",	"Tabelle optimieren");
?>