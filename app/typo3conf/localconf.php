<?php
include("ext/aio_detectmobilebrowsers/functions/user_isMobileBrowser.php");

//global settings
$TYPO3_CONF_VARS['BE']['installToolPassword'] = '9dbd23c0965520a05aa3927120d37f11';
$TYPO3_CONF_VARS['BE']['fileCreateMask']   = '0644';
$TYPO3_CONF_VARS['BE']['folderCreateMask'] = '0755';
$TYPO3_CONF_VARS['BE']['maxFileSize']      = '20480';
$TYPO3_CONF_VARS['BE']['forceCharset'] = 'utf-8';
//Mittwald TYPO3 Cheatsheet - Security settings
$TYPO3_CONF_VARS['BE']['fileDenyPattern'] = '\.php[3-6]?(\..*)?|^\.htaccess$';

# http://answerpot.com/showthread.php?1517118-Probleme+mit+Flashuploader+unter+4.4.3%3C%3D
# http://bugs.typo3.org/view.php?id=13659
$TYPO3_CONF_VARS['SYS']['cookieHttpOnly'] = '1';
if (TYPO3_MODE == 'BE') {
  $TYPO3_CONF_VARS['SYS']['cookieHttpOnly'] = '0';
}

#$TYPO3_CONF_VARS['SYS']['cookieSecure'] = '2';
$TYPO3_CONF_VARS['BE']['disable_exec_function'] = '0';

$TYPO3_CONF_VARS['SYS']['setDBinit'] = 'SET NAMES utf8';
# es werden Bilder mit Umlauten im Dateinamen nicht gerendert, wenn UTF8filesystem auf 1 ist
#$TYPO3_CONF_VARS['SYS']['UTF8filesystem'] = '1';
$typo_db_extTableDef_script = 'extTables.php';

$TYPO3_CONF_VARS['GFX']['gdlib_2']      = '1';
$TYPO3_CONF_VARS['GFX']['png_truecolor'] = '1';
$TYPO3_CONF_VARS['GFX']['thumbnails_png'] = '1';
$TYPO3_CONF_VARS['GFX']['jpg_quality'] = '90';
$TYPO3_CONF_VARS['GFX']['im_version_5'] = 'gm';
$TYPO3_CONF_VARS['GFX']['TTFdpi']       = '96';
$TYPO3_CONF_VARS['GFX']['gdlib_png'] 	= '1';
$TYPO3_CONF_VARS['GFX']['im_v5effects'] = '1';
$TYPO3_CONF_VARS['SYS']['t3lib_cs_convMethod'] = 'mbstring';
$TYPO3_CONF_VARS['SYS']['t3lib_cs_utils']      = 'mbstring';

//enable levelfields slide
$TYPO3_CONF_VARS['FE']['addRootLineFields'] = ',tx_realurl_pathsegment,tx_realurl_exclude,tx_templavoila_ds,tx_templavoila_to,tx_templavoila_next_ds,tx_templavoila_next_to,subtitle,tx_realurl_pathsegment,tx_realurl_exclude,tx_templavoila_ds,tx_templavoila_to,tx_templavoila_next_ds,tx_templavoila_next_to,media';	// Modified or inserted by TYPO3 Install Tool.

//customize
$TYPO3_CONF_VARS['SYS']['sitename'] = 'www.physiotherapie-huber.at';
$TYPO3_CONF_VARS['SYS']['encryptionKey'] = 'b83145cf666b1f127da327614dd48df30dedd3200b2a69ac5fffc792c81ec1f23359601d211d8713a8379a3aea2750ca';

#404-Handling Page (multilanguage solution - adopt substr() to your needs )
if (substr($_SERVER['REQUEST_URI'], 0, 4) == '/en/') {
	$TYPO3_CONF_VARS['FE']['pageNotFound_handling'] = '/en/404.html';
} else {
	$TYPO3_CONF_VARS['FE']['pageNotFound_handling'] = '/de/404.html';
}

//neccessary for feedit to work on pc/mobile subdomains as well
$server_name = explode(".", $_SERVER["SERVER_NAME"]);
# cookie domain FE/BE

#$TYPO3_CONF_VARS['FE']['cookieDomain'] = $server_name[count($server_name)-2].".".$server_name[count($server_name)-1];
#$TYPO3_CONF_VARS['BE']['cookieDomain'] = $server_name[count($server_name)-2].".".$server_name[count($server_name)-1];

$TYPO3_CONF_VARS['BE']['sessionTimeout'] = '36000'; // 10 Stunden

	//nicht gefunden - produktiv
	//Produktiv Server Settings Mittwald
	$typo_db_username = 'root';
	$typo_db_password = 'password';
	$typo_db_host = 'mysql-db';
	$typo_db = 'typo3_physiotherapiehuber';

	$TYPO3_CONF_VARS['GFX']['im_path']      = '/usr/bin/';
	$TYPO3_CONF_VARS['GFX']['im_path_lzw']  = '/usr/bin/';

	//disable logging
	$TYPO3_CONF_VARS['SYS']['systemLog'] ='';
	$TYPO3_CONF_VARS['SYS']['enable_DLOG'] ='0';
	$TYPO3_CONF_VARS['SYS']['enableDeprecationLog'] = '0';	//  Modified or inserted by TYPO3 Install Tool.

	//Mittwald TYPO3 Cheatsheet - Security settings
	$TYPO3_CONF_VARS['SYS']['displayErrors'] ='0';
	$TYPO3_CONF_VARS['SYS']['sqlDebug'] ='0';


//extensions
$TYPO3_CONF_VARS['EXT']['extConf']['realurl'] = 'a:5:{s:10:"configFile";s:26:"typo3conf/realurl_conf.php";s:14:"enableAutoConf";s:1:"0";s:14:"autoConfFormat";s:1:"1";s:12:"enableDevLog";s:1:"0";s:19:"enableChashUrlDebug";s:1:"0";}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['static_info_tables'] = 'a:2:{s:7:"charset";s:5:"utf-8";s:12:"usePatch1822";s:1:"0";}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['fdfx_be_image'] = 'a:8:{s:9:"MAX_WIDTH";s:3:"400";s:10:"MAX_HEIGHT";s:3:"400";s:9:"SAME_PATH";s:1:"1";s:11:"IS_ABSOLUTE";s:1:"0";s:8:"NEW_PATH";s:10:"fdfx_image";s:14:"RESIZE_COMMAND";s:6:"resize";s:10:"FIXED_SIZE";s:36:"640x480=VGA,800x600=WGA,1024x768=XGA";s:18:"FIXED_SIZE_DEFAULT";s:0:"";}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['rtehtmlarea'] = 'a:19:{s:21:"noSpellCheckLanguages";s:23:"ja,km,ko,lo,th,zh,b5,gb";s:15:"AspellDirectory";s:15:"/usr/bin/aspell";s:17:"defaultDictionary";s:2:"en";s:14:"dictionaryList";s:2:"en";s:20:"defaultConfiguration";s:120:"Minimal (Most features disabled. Administrator needs to enable them using TypoScript. For advanced administrators only.)";s:12:"enableImages";s:1:"1";s:20:"enableInlineElements";s:1:"1";s:24:"enableAccessibilityIcons";s:1:"0";s:16:"enableDAMBrowser";s:1:"0";s:18:"enableClickEnlarge";s:1:"1";s:22:"enableMozillaExtension";s:1:"0";s:14:"enableInOpera9";s:1:"1";s:16:"forceCommandMode";s:1:"0";s:15:"enableDebugMode";s:1:"0";s:23:"enableCompressedScripts";s:1:"1";s:20:"mozAllowClipboardURL";s:0:"";s:18:"plainImageMaxWidth";s:1:"0";s:19:"plainImageMaxHeight";s:1:"0";s:19:"allowStyleAttribute";s:1:"1";}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['templavoila'] = 'a:2:{s:7:"enable.";a:4:{s:13:"oldPageModule";s:1:"0";s:16:"selectDataSource";s:1:"0";s:15:"renderFCEHeader";s:1:"0";s:19:"selectDataStructure";s:1:"0";}s:9:"staticDS.";a:3:{s:6:"enable";s:1:"1";s:8:"path_fce";s:31:"fileadmin/app/templates/ds/fce/";s:9:"path_page";s:32:"fileadmin/app/templates/ds/page/";}}'; // Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['tt_address'] = 'a:2:{s:24:"disableCombinedNameField";s:1:"1";s:21:"backwardsCompatFormat";s:9:"%1$s %3$s";}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['direct_mail'] = 'a:16:{s:12:"sendPerCycle";s:2:"50";s:13:"cron_language";s:2:"en";s:14:"addRecipFields";s:0:"";s:10:"adminEmail";s:12:"ms@anorak.io";s:7:"cronInt";s:1:"5";s:15:"notificationJob";s:1:"1";s:12:"useDeferMode";s:1:"0";s:19:"enablePlainTextNews";s:1:"1";s:11:"SmtpEnabled";s:1:"0";s:8:"SmtpHost";s:9:"localhost";s:8:"SmtpPort";s:2:"25";s:8:"SmtpAuth";s:1:"0";s:8:"SmtpUser";s:0:"";s:12:"SmtpPassword";s:0:"";s:14:"SmtpPersistent";s:1:"0";s:14:"UseHttpToFetch";s:1:"0";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['sr_feuser_register'] = 'a:6:{s:12:"uploadFolder";s:27:"uploads/tx_srfeuserregister";s:10:"imageTypes";s:30:"png, jpg, jpeg, gif, tif, tiff";s:12:"imageMaxSize";s:3:"500";s:12:"useFlexforms";s:1:"1";s:14:"useMd5Password";s:1:"1";s:12:"usePatch1822";s:1:"0";}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['sr_email_subscribe'] = 'a:5:{s:12:"useFlexforms";s:1:"1";s:11:"imageFolder";s:27:"uploads/tx_sremailsubscribe";s:14:"useImageFolder";s:1:"0";s:12:"addressTable";s:10:"tt_address";s:12:"usePatch1822";s:1:"0";}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['rtehtmlarea'] = 'a:18:{s:21:"noSpellCheckLanguages";s:23:"ja,km,ko,lo,th,zh,b5,gb";s:15:"AspellDirectory";s:15:"/usr/bin/aspell";s:17:"defaultDictionary";s:2:"en";s:14:"dictionaryList";s:2:"en";s:20:"defaultConfiguration";s:120:"Minimal (Most features disabled. Administrator needs to enable them using TypoScript. For advanced administrators only.)";s:12:"enableImages";s:1:"1";s:20:"enableInlineElements";s:1:"1";s:24:"enableAccessibilityIcons";s:1:"0";s:16:"enableDAMBrowser";s:1:"0";s:18:"enableClickEnlarge";s:1:"1";s:22:"enableMozillaExtension";s:1:"0";s:14:"enableInOpera9";s:1:"1";s:16:"forceCommandMode";s:1:"0";s:15:"enableDebugMode";s:1:"0";s:23:"enableCompressedScripts";s:1:"1";s:20:"mozAllowClipboardURL";s:0:"";s:18:"plainImageMaxWidth";s:1:"0";s:19:"plainImageMaxHeight";s:1:"0";}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['templavoila_pagemod'] = 'a:2:{s:20:"disable_listviewLink";s:1:"1";s:21:"dont_follow_shortcuts";s:1:"0";}';	// Modified or inserted by TYPO3 Extension Manager.

#caching framework since 4.3
# http://www.bergercity.de/linux/typo3-mit-memcached-beschleunigen/
$TYPO3_CONF_VARS['SYS']['useCachingFramework'] = '1';

## INSTALL SCRIPT EDIT POINT TOKEN - all lines after this points may be changed by the install script!
$TYPO3_CONF_VARS['EXT']['extConf']['tt_news'] = 'a:22:{s:13:"useStoragePid";s:1:"1";s:17:"requireCategories";s:1:"1";s:18:"useInternalCaching";s:1:"1";s:11:"cachingMode";s:6:"normal";s:13:"cacheLifetime";s:1:"0";s:13:"cachingEngine";s:16:"cachingFramework";s:11:"treeOrderBy";s:3:"uid";s:13:"prependAtCopy";s:1:"1";s:5:"label";s:5:"title";s:9:"label_alt";s:0:"";s:10:"label_alt2";s:0:"";s:15:"label_alt_force";s:1:"0";s:21:"categorySelectedWidth";s:1:"0";s:17:"categoryTreeWidth";s:1:"0";s:25:"l10n_mode_prefixLangTitle";s:1:"1";s:22:"l10n_mode_imageExclude";s:1:"0";s:20:"hideNewLocalizations";s:1:"0";s:24:"writeCachingInfoToDevlog";s:10:"disabled|0";s:23:"writeParseTimesToDevlog";s:1:"0";s:18:"parsetimeThreshold";s:3:"0.1";s:13:"noTabDividers";s:1:"0";s:18:"categoryTreeHeigth";s:1:"5";}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extList'] = 'extbase,css_styled_content,tsconfig_help,context_help,extra_page_cm_options,impexp,sys_note,tstemplate,tstemplate_ceditor,tstemplate_info,tstemplate_objbrowser,tstemplate_analyzer,func_wizards,wizard_crpages,wizard_sortpages,lowlevel,install,belog,beuser,aboutmodules,setup,taskcenter,info_pagetsconfig,viewpage,indexed_search,macina_searchbox,kb_md5fepw,sr_language_menu,templavoila,felogin,weeaar_googlesitemap,kb_cleanfiles,sms_firephp,t3skin,recycler,reports,scheduler,version,tt_news,db_yamltv,realurl,static_info_tables,aio_loginskin,fdfx_be_image,ja_replacer,tt_address,direct_mail,css2inline,div2007,sr_feuser_register,sr_email_subscribe,fcecolumn,about,cshmanual,opendocs,t3editor,kickstarter,rtehtmlarea,info,perm,func,filelist,fluid,workspaces,tscobj,linkvalidator,templavoila_pagemod,aio_detectmobilebrowsers,feedit,aio_feedit,accessible_is_browse_results,tkcropthumbs,aio_maximagewidthintext';	// Modified or inserted by TYPO3 Extension Manager. Modified or inserted by TYPO3 Core Update Manager.
$TYPO3_CONF_VARS['EXT']['extList_FE'] = 'extbase,css_styled_content,install,indexed_search,macina_searchbox,kb_md5fepw,sr_language_menu,templavoila,felogin,weeaar_googlesitemap,kb_cleanfiles,sms_firephp,t3skin,version,tt_news,db_yamltv,realurl,static_info_tables,aio_loginskin,fdfx_be_image,ja_replacer,tt_address,direct_mail,css2inline,div2007,sr_feuser_register,sr_email_subscribe,fcecolumn,kickstarter,rtehtmlarea,fluid,workspaces,tscobj,linkvalidator,templavoila_pagemod,aio_detectmobilebrowsers,feedit,aio_feedit,accessible_is_browse_results,tkcropthumbs,aio_maximagewidthintext';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['INSTALL']['wizardDone']['tx_coreupdates_installsysexts'] = '1';	//  Modified or inserted by TYPO3 Upgrade Wizard.

$TYPO3_CONF_VARS['EXT']['extConf']['realurl'] = 'a:5:{s:10:"configFile";s:26:"typo3conf/realurl_conf.php";s:14:"enableAutoConf";s:1:"1";s:14:"autoConfFormat";s:1:"1";s:12:"enableDevLog";s:1:"0";s:19:"enableChashUrlDebug";s:1:"0";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['templavoila'] = 'a:2:{s:7:"enable.";a:4:{s:13:"oldPageModule";s:1:"0";s:16:"selectDataSource";s:1:"0";s:15:"renderFCEHeader";s:1:"0";s:19:"selectDataStructure";s:1:"0";}s:9:"staticDS.";a:3:{s:6:"enable";s:1:"1";s:8:"path_fce";s:31:"fileadmin/app/templates/ds/fce/";s:9:"path_page";s:32:"fileadmin/app/templates/ds/page/";}}';	// Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['templavoila_pagemod'] = 'a:2:{s:20:"disable_listviewLink";s:1:"1";s:21:"dont_follow_shortcuts";s:1:"0";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['css_styled_content'] = 'a:2:{s:15:"setPageTSconfig";s:1:"1";s:19:"removePositionTypes";s:1:"1";}';	//  Modified or inserted by TYPO3 Extension Manager.
// Updated by TYPO3 Extension Manager 23-11-11 15:46:12

$TYPO3_CONF_VARS['SYS']['compat_version'] = '4.5';
?>
