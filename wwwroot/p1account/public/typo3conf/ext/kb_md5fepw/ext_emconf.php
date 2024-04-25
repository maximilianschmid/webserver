<?php

########################################################################
# Extension Manager/Repository config file for ext: "kb_md5fepw"
#
# Auto generated 03-06-2008 22:41
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'MD5 FE Password',
	'description' => 'Sets the FE Password type to password,md5. Extends the user authentification library so "superchallenged" md5 passwords are used for login (Works with native Login box and "newloginbox" extension). Also enables md5 hashed password for registration using "feadmin_user"',
	'category' => 'plugin',
	'shy' => 0,
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author' => 'Bernhard Kraft',
	'author_email' => 'kraftb@kraftb.at',
	'author_company' => 'think-open',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'version' => '0.4.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '3.5.4-3.8.4',
			'php' => '4.0.4-5.0.9',
			'cms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:17:{s:28:"class.tx_kbmd5fepw_funcs.php";s:4:"3de6";s:30:"class.tx_kbmd5fepw_procout.php";s:4:"7648";s:26:"class.ux_tslib_content.php";s:4:"6ae5";s:12:"ext_icon.gif";s:4:"5a9a";s:17:"ext_localconf.php";s:4:"68c3";s:14:"ext_tables.php";s:4:"9854";s:14:"ext_tables.sql";s:4:"449f";s:28:"ext_typoscript_constants.txt";s:4:"1930";s:24:"ext_typoscript_setup.txt";s:4:"18af";s:19:"user_kb_md5fepw.php";s:4:"24de";s:17:"ux_feadminLib.php";s:4:"45c3";s:14:"doc/manual.sxw";s:4:"55c4";s:38:"pi1/class.tx_kbmd5fepw_newloginbox.php";s:4:"825c";s:17:"pi1/locallang.php";s:4:"aab6";s:26:"res/fe_admin_fe_users.tmpl";s:4:"8732";s:26:"res/jsfunc.validateform.js";s:4:"539a";s:30:"sv1/class.tx_kbmd5fepw_sv1.php";s:4:"f1e9";}',
);

?>