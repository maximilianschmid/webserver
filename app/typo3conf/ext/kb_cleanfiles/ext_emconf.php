<?php

########################################################################
# Extension Manager/Repository config file for ext: "kb_cleanfiles"
#
# Auto generated 20-05-2009 13:47
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'KB Clean Files',
	'description' => 'Cleans upload folders from unused files',
	'category' => 'module',
	'shy' => 0,
	'version' => '0.4.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => 'mod1',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Bernhard Kraft',
	'author_email' => 'kraftb@kraftb.at',
	'author_company' => 'think-open',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '3.8.0-0.0.0',
			'php' => '3.0.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:12:{s:12:"ext_icon.gif";s:4:"3744";s:15:"ext_php_api.dat";s:4:"e8d2";s:14:"ext_tables.php";s:4:"079c";s:14:"doc/manual.sxw";s:4:"16bf";s:19:"doc/wizard_form.dat";s:4:"4510";s:20:"doc/wizard_form.html";s:4:"bbca";s:14:"mod1/clear.gif";s:4:"cc11";s:13:"mod1/conf.php";s:4:"253a";s:14:"mod1/index.php";s:4:"be90";s:18:"mod1/locallang.xml";s:4:"2147";s:22:"mod1/locallang_mod.xml";s:4:"922d";s:19:"mod1/moduleicon.gif";s:4:"3744";}',
);

?>