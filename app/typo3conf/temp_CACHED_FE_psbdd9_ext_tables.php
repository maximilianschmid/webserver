<?php

###########################
## EXTENSION: cms
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/cms/ext_tables.php
###########################

$_EXTKEY = 'cms';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


# TYPO3 SVN ID: $Id$
if (!defined ('TYPO3_MODE'))	die ('Access denied.');


if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModule('web','layout','top',t3lib_extMgm::extPath($_EXTKEY).'layout/');
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_layout','EXT:cms/locallang_csh_weblayout.xml');
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_info','EXT:cms/locallang_csh_webinfo.xml');

	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_cms_webinfo_page',
		t3lib_extMgm::extPath($_EXTKEY).'web_info/class.tx_cms_webinfo.php',
		'LLL:EXT:cms/locallang_tca.xml:mod_tx_cms_webinfo_page'
	);
	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_cms_webinfo_lang',
		t3lib_extMgm::extPath($_EXTKEY).'web_info/class.tx_cms_webinfo_lang.php',
		'LLL:EXT:cms/locallang_tca.xml:mod_tx_cms_webinfo_lang'
	);
}


	// Add allowed records to pages:
t3lib_extMgm::allowTableOnStandardPages('pages_language_overlay,tt_content,sys_template,sys_domain,backend_layout');


// ******************************************************************
// This is the standard TypoScript content table, tt_content
// ******************************************************************
$TCA['tt_content'] = array (
	'ctrl' => array (
		'label' => 'header',
		'label_alt' => 'subheader,bodytext',
		'sortby' => 'sorting',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'title' => 'LLL:EXT:cms/locallang_tca.xml:tt_content',
		'delete' => 'deleted',
		'versioningWS' => 2,
		'versioning_followPages' => true,
		'origUid' => 't3_origuid',
		'type' => 'CType',
		'hideAtCopy' => true,
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' => 'colPos,sys_language_uid',
		'useColumnsForDefaultValues' => 'colPos,sys_language_uid',
		'shadowColumnsForNewPlaceholders' => 'colPos',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'typeicon_column' => 'CType',
		'typeicon_classes' => array(
			'header' => 'mimetypes-x-content-header',
			'textpic' => 'mimetypes-x-content-text-picture',
			'image' => 'mimetypes-x-content-image',
			'bullets' => 'mimetypes-x-content-list-bullets',
			'table' => 'mimetypes-x-content-table',
			'splash' => 'mimetypes-x-content-splash',
			'uploads' => 'mimetypes-x-content-list-files',
			'multimedia' => 'mimetypes-x-content-multimedia',
			'media' => 'mimetypes-x-content-multimedia',
			'menu' => 'mimetypes-x-content-menu',
			'list' => 'mimetypes-x-content-plugin',
			'mailform' => 'mimetypes-x-content-form',
			'search' => 'mimetypes-x-content-form-search',
			'login' => 'mimetypes-x-content-login',
			'shortcut' => 'mimetypes-x-content-link',
			'script' => 'mimetypes-x-content-script',
			'div' => 'mimetypes-x-content-divider',
			'html' => 'mimetypes-x-content-html',
			'text' => 'mimetypes-x-content-text',
			'default' => 'mimetypes-x-content-text',
		),
		'typeicons' => array (
			'header' => 'tt_content_header.gif',
			'textpic' => 'tt_content_textpic.gif',
			'image' => 'tt_content_image.gif',
			'bullets' => 'tt_content_bullets.gif',
			'table' => 'tt_content_table.gif',
			'splash' => 'tt_content_news.gif',
			'uploads' => 'tt_content_uploads.gif',
			'multimedia' => 'tt_content_mm.gif',
			'media' => 'tt_content_mm.gif',
			'menu' => 'tt_content_menu.gif',
			'list' => 'tt_content_list.gif',
			'mailform' => 'tt_content_form.gif',
			'search' => 'tt_content_search.gif',
			'login' => 'tt_content_login.gif',
			'shortcut' => 'tt_content_shortcut.gif',
			'script' => 'tt_content_script.gif',
			'div' => 'tt_content_div.gif',
			'html' => 'tt_content_html.gif'
		),
		'thumbnail' => 'image',
		'requestUpdate' => 'list_type,rte_enabled,menu_type',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_tt_content.php',
		'dividers2tabs' => 1
	)
);

// ******************************************************************
// fe_users
// ******************************************************************
$TCA['fe_users'] = array (
	'ctrl' => array (
		'label' => 'username',
		'default_sortby' => 'ORDER BY username',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'fe_cruser_id' => 'fe_cruser_id',
		'title' => 'LLL:EXT:cms/locallang_tca.xml:fe_users',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'disable',
			'starttime' => 'starttime',
			'endtime' => 'endtime'
		),
		'typeicon_classes' => array(
			'default' => 'status-user-frontend',
		),
		'useColumnsForDefaultValues' => 'usergroup,lockToDomain,disable,starttime,endtime',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php',
		'dividers2tabs' => 1
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'username,password,usergroup,name,address,telephone,fax,email,title,zip,city,country,www,company',
	)
);

// ******************************************************************
// fe_groups
// ******************************************************************
$TCA['fe_groups'] = array (
	'ctrl' => array (
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'delete' => 'deleted',
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'enablecolumns' => array (
			'disabled' => 'hidden'
		),
		'title' => 'LLL:EXT:cms/locallang_tca.xml:fe_groups',
		'typeicon_classes' => array(
			'default' => 'status-user-group-frontend',
		),
		'useColumnsForDefaultValues' => 'lockToDomain',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php',
		'dividers2tabs' => 1
	)
);

// ******************************************************************
// sys_domain
// ******************************************************************
$TCA['sys_domain'] = array (
	'ctrl' => array (
		'label' => 'domainName',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'title' => 'LLL:EXT:cms/locallang_tca.xml:sys_domain',
		'iconfile' => 'domain.gif',
		'enablecolumns' => array (
			'disabled' => 'hidden'
		),
		'typeicon_classes' => array(
			'default' => 'mimetypes-x-content-domain',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php'
	)
);

// ******************************************************************
// pages_language_overlay
// ******************************************************************
$TCA['pages_language_overlay'] = array (
	'ctrl' => array (
		'label'                           => 'title',
		'tstamp'                          => 'tstamp',
		'title'                           => 'LLL:EXT:cms/locallang_tca.xml:pages_language_overlay',
		'versioningWS'                    => true,
		'versioning_followPages'          => true,
		'origUid'                         => 't3_origuid',
		'crdate'                          => 'crdate',
		'cruser_id'                       => 'cruser_id',
		'delete'                          => 'deleted',
		'enablecolumns'                   => array (
			'disabled'  => 'hidden',
			'starttime' => 'starttime',
			'endtime'   => 'endtime'
		),
		'transOrigPointerField'           => 'pid',
		'transOrigPointerTable'           => 'pages',
		'transOrigDiffSourceField'        => 'l18n_diffsource',
		'shadowColumnsForNewPlaceholders' => 'title',
		'languageField'                   => 'sys_language_uid',
		'mainpalette'                     => 1,
		'dynamicConfigFile'               => t3lib_extMgm::extPath($_EXTKEY) . 'tbl_cms.php',
		'type'                            => 'doktype',
		'typeicon_classes' => array(
			'default' => 'mimetypes-x-content-page-language-overlay',
		),

		'dividers2tabs'                   => true
	)
);


// ******************************************************************
// sys_template
// ******************************************************************
$TCA['sys_template'] = array (
	'ctrl' => array (
		'label' => 'title',
		'tstamp' => 'tstamp',
		'sortby' => 'sorting',
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'title' => 'LLL:EXT:cms/locallang_tca.xml:sys_template',
		'versioningWS' => true,
		'origUid' => 't3_origuid',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'delete' => 'deleted',
		'adminOnly' => 1,	// Only admin, if any
		'iconfile' => 'template.gif',
		'thumbnail' => 'resources',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime'
		),
		'typeicon_column' => 'root',
		'typeicon_classes' => array(
			'default' => 'mimetypes-x-content-template-extension',
			'1' => 'mimetypes-x-content-template',
		),
		'typeicons' => array (
			'0' => 'template_add.gif'
		),
		'dividers2tabs' => 1,
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php'
	)
);


// ******************************************************************
// layouts
// ******************************************************************
$TCA['backend_layout'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:cms/locallang_tca.xml:backend_layout',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php',
		'iconfile' => 'backend_layout.gif',
		'selicon_field' => 'icon',
		'selicon_field_path' => 'uploads/media',
		'thumbnail' => 'resources',
	)
);


###########################
## EXTENSION: sv
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/sv/ext_tables.php
###########################

$_EXTKEY = 'sv';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE == 'BE') {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['sv']['services'] = array(
		'title'       => 'LLL:EXT:sv/reports/locallang.xml:report_title',
		'description' => 'LLL:EXT:sv/reports/locallang.xml:report_description',
		'icon'		  => 'EXT:sv/reports/tx_sv_report.png',
		'report'      => 'tx_sv_reports_ServicesList'
	);
}

###########################
## EXTENSION: em
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/em/ext_tables.php
###########################

$_EXTKEY = 'em';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	t3lib_extMgm::addModule('tools', 'em', '', t3lib_extMgm::extPath($_EXTKEY) . 'classes/');

		// register Ext.Direct
	t3lib_extMgm::registerExtDirectComponent(
		'TYPO3.EM.ExtDirect',
		t3lib_extMgm::extPath($_EXTKEY) . 'classes/connection/class.tx_em_connection_extdirectserver.php:tx_em_Connection_ExtDirectServer',
		'tools_em',
		'admin'
	);

	t3lib_extMgm::registerExtDirectComponent(
		'TYPO3.EMSOAP.ExtDirect',
		t3lib_extMgm::extPath($_EXTKEY) . 'classes/connection/class.tx_em_connection_extdirectsoap.php:tx_em_Connection_ExtDirectSoap',
		'tools_em',
		'admin'
	);

		// register reports check
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['Extension Manager'][] = 'tx_em_reports_ExtensionStatus';

	$icons = array(
		'extension-required' => t3lib_extMgm::extRelPath('em') . 'res/icons/extension-required.png'
 	);
 	t3lib_SpriteManager::addSingleIcons($icons, 'em');
}

###########################
## EXTENSION: recordlist
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/recordlist/ext_tables.php
###########################

$_EXTKEY = 'recordlist';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	t3lib_extMgm::addModulePath('web_list', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
	t3lib_extMgm::addModule('web', 'list', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}

###########################
## EXTENSION: extbase
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/extbase/ext_tables.php
###########################

$_EXTKEY = 'extbase';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) die ('Access denied.');

if (TYPO3_MODE == 'BE') {

	// register the cache in BE so it will be cleared with "clear all caches"
	try {
		t3lib_cache::initializeCachingFramework();
			// Reflection cache
		if (!$GLOBALS['typo3CacheManager']->hasCache('tx_extbase_cache_reflection')) {
			$GLOBALS['typo3CacheFactory']->create(
				'tx_extbase_cache_reflection',
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_extbase_reflection']['frontend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_extbase_reflection']['backend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_extbase_reflection']['options']
			);
		}
			// Object container cache
		if (!$GLOBALS['typo3CacheManager']->hasCache('tx_extbase_cache_object')) {
			$GLOBALS['typo3CacheFactory']->create(
				'tx_extbase_cache_object',
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_extbase_object']['frontend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_extbase_object']['backend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_extbase_object']['options']
			);
		}
	} catch(t3lib_cache_exception_NoSuchCache $exception) {

	}

	$TBE_MODULES['_dispatcher'][] = 'Tx_Extbase_Core_Bootstrap';

}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['extbase'][] = 'tx_extbase_utility_extbaserequirementscheck';

t3lib_div::loadTCA('fe_users');
if (!isset($TCA['fe_users']['ctrl']['type'])) {
	$tempColumns = array(
		'tx_extbase_type' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:extbase/Resources/Private/Language/locallang_db.xml:fe_users.tx_extbase_type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:extbase/Resources/Private/Language/locallang_db.xml:fe_users.tx_extbase_type.0', '0'),
					array('LLL:EXT:extbase/Resources/Private/Language/locallang_db.xml:fe_users.tx_extbase_type.Tx_Extbase_Domain_Model_FrontendUser', 'Tx_Extbase_Domain_Model_FrontendUser')
				),
				'size' => 1,
				'maxitems' => 1,
				'default' => '0'
			)
		)
	);
	t3lib_extMgm::addTCAcolumns('fe_users', $tempColumns, 1);
	t3lib_extMgm::addToAllTCAtypes('fe_users', 'tx_extbase_type');
	$TCA['fe_users']['ctrl']['type'] = 'tx_extbase_type';
}
$TCA['fe_users']['types']['Tx_Extbase_Domain_Model_FrontendUser'] = $TCA['fe_users']['types']['0'];

t3lib_div::loadTCA('fe_groups');
if (!isset($TCA['fe_groups']['ctrl']['type'])) {
	$tempColumns = array(
		'tx_extbase_type' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:extbase/Resources/Private/Language/locallang_db.xml:fe_groups.tx_extbase_type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:extbase/Resources/Private/Language/locallang_db.xml:fe_groups.tx_extbase_type.0', '0'),
					array('LLL:EXT:extbase/Resources/Private/Language/locallang_db.xml:fe_groups.tx_extbase_type.Tx_Extbase_Domain_Model_FrontendUserGroup', 'Tx_Extbase_Domain_Model_FrontendUserGroup')
				),
				'size' => 1,
				'maxitems' => 1,
				'default' => '0'
			)
		)
	);
	t3lib_extMgm::addTCAcolumns('fe_groups', $tempColumns, 1);
	t3lib_extMgm::addToAllTCAtypes('fe_groups', 'tx_extbase_type');
	$TCA['fe_groups']['ctrl']['type'] = 'tx_extbase_type';
}
$TCA['fe_groups']['types']['Tx_Extbase_Domain_Model_FrontendUserGroup'] = $TCA['fe_groups']['types']['0'];


###########################
## EXTENSION: css_styled_content
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/css_styled_content/ext_tables.php
###########################

$_EXTKEY = 'css_styled_content';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


# TYPO3 SVN ID: $Id$
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

	// add flexform
t3lib_extMgm::addPiFlexFormValue('*', 'FILE:EXT:css_styled_content/flexform_ds.xml','table');
$TCA['tt_content']['types']['table']['showitem']='CType;;4;;1-1-1, hidden, header;;3;;2-2-2, linkToTop;;;;4-4-4,
			--div--;LLL:EXT:cms/locallang_ttc.xml:CType.I.5, layout;;10;;3-3-3, cols, bodytext;;9;nowrap:wizards[table], text_properties, pi_flexform,
			--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access, starttime, endtime, fe_group';

t3lib_extMgm::addStaticFile($_EXTKEY, 'static/', 'CSS Styled Content');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v3.8/', 'CSS Styled Content TYPO3 v3.8');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v3.9/', 'CSS Styled Content TYPO3 v3.9');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v4.2/', 'CSS Styled Content TYPO3 v4.2');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v4.3/', 'CSS Styled Content TYPO3 v4.3');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v4.4/', 'CSS Styled Content TYPO3 v4.4');

$TCA['tt_content']['columns']['section_frame']['config']['items'][0] = array('LLL:EXT:css_styled_content/locallang_db.php:tt_content.tx_cssstyledcontent_section_frame.I.0', '0');
$TCA['tt_content']['columns']['section_frame']['config']['items'][9] = array('LLL:EXT:css_styled_content/locallang_db.php:tt_content.tx_cssstyledcontent_section_frame.I.9', '66');


###########################
## EXTENSION: install
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/install/ext_tables.php
###########################

$_EXTKEY = 'install';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE') {
	t3lib_extMgm::addModule('tools', 'install', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod/');

	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['typo3'][] = 'tx_install_report_InstallStatus';
}


###########################
## EXTENSION: indexed_search
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/indexed_search/ext_tables.php
###########################

$_EXTKEY = 'indexed_search';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addPlugin(Array('LLL:EXT:indexed_search/locallang.php:mod_indexed_search', $_EXTKEY));

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY] = 'layout,select_key,pages';

if (TYPO3_MODE=='BE')    {
	t3lib_extMgm::addModule('tools','isearch','after:log',t3lib_extMgm::extPath($_EXTKEY).'mod/');

	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_indexedsearch_modfunc1',
		t3lib_extMgm::extPath($_EXTKEY).'modfunc1/class.tx_indexedsearch_modfunc1.php',
		'LLL:EXT:indexed_search/locallang.php:mod_indexed_search'
	);
	t3lib_extMgm::insertModuleFunction(
		"web_info",
		"tx_indexedsearch_modfunc2",
		t3lib_extMgm::extPath($_EXTKEY)."modfunc2/class.tx_indexedsearch_modfunc2.php",
		"LLL:EXT:indexed_search/locallang.php:mod2_indexed_search"
	);
}

t3lib_extMgm::allowTableOnStandardPages('index_config');
t3lib_extMgm::addLLrefForTCAdescr('index_config','EXT:indexed_search/locallang_csh_indexcfg.xml');

if (t3lib_extMgm::isLoaded('crawler'))	{
	$TCA['index_config'] = Array (
		'ctrl' => Array (
			'title' => 'LLL:EXT:indexed_search/locallang_db.php:index_config',
			'label' => 'title',
			'tstamp' => 'tstamp',
			'crdate' => 'crdate',
			'cruser_id' => 'cruser_id',
			'type' => 'type',
			'default_sortby' => 'ORDER BY crdate',
			'enablecolumns' => Array (
				'disabled' => 'hidden',
				'starttime' => 'starttime',
			),
			'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
			'iconfile' => 'default.gif',
		),
		'feInterface' => Array (
			'fe_admin_fieldList' => 'hidden, starttime, title, description, type, depth, table2index, alternative_source_pid, get_params, chashcalc, filepath, extensions',
		)
	);
}


	// Example of crawlerhook (see also ext_localconf.php!)
/*
	t3lib_div::loadTCA('index_config');
	$TCA['index_config']['columns']['type']['config']['items'][] =  Array('My Crawler hook!', 'tx_myext_example1');
	$TCA['index_config']['types']['tx_myext_example1'] = $TCA['index_config']['types']['0'];
*/


###########################
## EXTENSION: macina_searchbox
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/macina_searchbox/ext_tables.php
###########################

$_EXTKEY = 'macina_searchbox';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

t3lib_div::loadTCA("tt_content");
$TCA["tt_content"]["types"]["list"]["subtypes_excludelist"][$_EXTKEY."_pi1"]="layout,select_key";


t3lib_extMgm::addPlugin(Array("LLL:EXT:macina_searchbox/locallang_db.php:tt_content.list_type", $_EXTKEY."_pi1"),"list_type");


if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_macinasearchbox_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY)."pi1/class.tx_macinasearchbox_pi1_wizicon.php";

###########################
## EXTENSION: kb_md5fepw
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/kb_md5fepw/ext_tables.php
###########################

$_EXTKEY = 'kb_md5fepw';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

t3lib_div::loadTCA('fe_users');
$TCA['fe_users']['columns']['password']['config']['eval'] .= ',md5,password';


###########################
## EXTENSION: sr_language_menu
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/sr_language_menu/ext_tables.php
###########################

$_EXTKEY = 'sr_language_menu';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$tempColumns = Array (
	'tx_srlanguagemenu_languages' => Array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:sr_language_menu/locallang_db.xml:tt_content.tx_srlanguagemenu_languages',		
		'config' => Array (
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'sys_language',
			'size' => '5',
			'maxitems' => 50,
			'minitems' => 1,
			'show_thumbs' => 1,
		)
	),
	'tx_srlanguagemenu_type' => Array (        
		'exclude' => 0,        
		'label' => 'LLL:EXT:sr_language_menu/locallang_db.xml:tt_content.tx_srlanguagemenu_type',        
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('LLL:EXT:sr_language_menu/locallang_db.xml:tt_content.tx_srlanguagemenu_type.I.0', '0'),
				Array('LLL:EXT:sr_language_menu/locallang_db.xml:tt_content.tx_srlanguagemenu_type.I.1', '1'),
				Array('LLL:EXT:sr_language_menu/locallang_db.xml:tt_content.tx_srlanguagemenu_type.I.2', '2'),
			),
		),
	),
);

t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content',$tempColumns,1);

$TCA['tt_content']['types'][$_EXTKEY.'_pi1']['showitem'] = 'CType;;4;button;1-1-1, header;;3;;2-2-2, tx_srlanguagemenu_type;;;;3-3-3,tx_srlanguagemenu_languages';
$TCA['tt_content']['ctrl']['typeicons'][$_EXTKEY.'_pi1'] = t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif';

t3lib_extMgm::addPlugin(Array('LLL:EXT:sr_language_menu/locallang_db.xml:tt_content.CType', $_EXTKEY.'_pi1'),'CType');

if (TYPO3_MODE=='BE')	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_srlanguagemenu_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_srlanguagemenu_pi1_wizicon.php';


###########################
## EXTENSION: templavoila
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/templavoila/ext_tables.php
###########################

$_EXTKEY = 'templavoila';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


# TYPO3 CVS ID: $Id$
if (!defined ('TYPO3_MODE'))  die ('Access denied.');

// unserializing the configuration so we can use it here:
$_EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['templavoila']);

if (TYPO3_MODE=='BE') {

		// Adding click menu item:
	$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][] = array(
		'name' => 'tx_templavoila_cm1',
		'path' => t3lib_extMgm::extPath($_EXTKEY).'class.tx_templavoila_cm1.php'
	);
	include_once(t3lib_extMgm::extPath('templavoila').'class.tx_templavoila_handlestaticdatastructures.php');

		// Adding backend modules:
	t3lib_extMgm::addModule('web','txtemplavoilaM1','top',t3lib_extMgm::extPath($_EXTKEY).'mod1/');
	t3lib_extMgm::addModule('web','txtemplavoilaM2','',t3lib_extMgm::extPath($_EXTKEY).'mod2/');

		// Remove default Page module (layout) manually if wanted:
	if (!$_EXTCONF['enable.']['oldPageModule']) {
		$tmp = $GLOBALS['TBE_MODULES']['web'];
		$GLOBALS['TBE_MODULES']['web'] = str_replace (',,',',',str_replace ('layout','',$tmp));
		unset ($GLOBALS['TBE_MODULES']['_PATHS']['web_layout']);
	}

		// Registering CSH:
	t3lib_extMgm::addLLrefForTCAdescr('be_groups','EXT:templavoila/locallang_csh_begr.xml');
	t3lib_extMgm::addLLrefForTCAdescr('pages','EXT:templavoila/locallang_csh_pages.xml');
	t3lib_extMgm::addLLrefForTCAdescr('tt_content','EXT:templavoila/locallang_csh_ttc.xml');
	t3lib_extMgm::addLLrefForTCAdescr('tx_templavoila_datastructure','EXT:templavoila/locallang_csh_ds.xml');
	t3lib_extMgm::addLLrefForTCAdescr('tx_templavoila_tmplobj','EXT:templavoila/locallang_csh_to.xml');
	t3lib_extMgm::addLLrefForTCAdescr('xMOD_tx_templavoila','EXT:templavoila/locallang_csh_module.xml');
	t3lib_extMgm::addLLrefForTCAdescr('xEXT_templavoila','EXT:templavoila/locallang_csh_intro.xml');
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_txtemplavoilaM1','EXT:templavoila/locallang_csh_pm.xml');


	t3lib_extMgm::insertModuleFunction(
		'tools_txextdevevalM1',
		'tx_templavoila_extdeveval',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_templavoila_extdeveval.php',
		'TemplaVoila L10N Mode Conversion Tool'
	);
}

	// Adding tables:
$TCA['tx_templavoila_tmplobj'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:templavoila/locallang_db.xml:tx_templavoila_tmplobj',
		'label' => 'title',
		'label_userFunc' => 'EXT:templavoila/classes/class.tx_templavoila_label.php:&tx_templavoila_label->getLabel',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_to.gif',
		'selicon_field' => 'previewicon',
		'selicon_field_path' => 'uploads/tx_templavoila',
		'type' => 'parent',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'shadowColumnsForNewPlaceholders' => 'title,datastructure,rendertype,sys_language_uid,parent,rendertype_ref',
	)
);
$TCA['tx_templavoila_datastructure'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:templavoila/locallang_db.xml:tx_templavoila_datastructure',
		'label' => 'title',
		'label_userFunc' => 'EXT:templavoila/classes/class.tx_templavoila_label.php:&tx_templavoila_label->getLabel',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_ds.gif',
		'selicon_field' => 'previewicon',
		'selicon_field_path' => 'uploads/tx_templavoila',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'shadowColumnsForNewPlaceholders' => 'scope,title',
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_templavoila_datastructure');
t3lib_extMgm::allowTableOnStandardPages('tx_templavoila_tmplobj');


	// Adding access list to be_groups
t3lib_div::loadTCA('be_groups');
$tempColumns = array (
	'tx_templavoila_access' => array(
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:be_groups.tx_templavoila_access',
		'config' => Array (
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'tx_templavoila_datastructure,tx_templavoila_tmplobj',
			'prepend_tname' => 1,
			'size' => 5,
			'autoSizeMax' => 15,
			'multiple' => 1,
			'minitems' => 0,
			'maxitems' => 1000,
			'show_thumbs'=> 1,
		),
	)
);
t3lib_extMgm::addTCAcolumns('be_groups', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('be_groups','tx_templavoila_access;;;;1-1-1', '1');

	// Adding the new content element, "Flexible Content":
t3lib_div::loadTCA('tt_content');
$tempColumns = array(
	'tx_templavoila_ds' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:tt_content.tx_templavoila_ds',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('',0),
			),
			'allowNonIdValues' => 1,
			'itemsProcFunc' => 'tx_templavoila_handleStaticdatastructures->dataSourceItemsProcFunc',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'selicon_cols' => 10,
		)
	),
	'tx_templavoila_to' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:tt_content.tx_templavoila_to',
		'displayCond' => 'FIELD:CType:=:' . $_EXTKEY . '_pi1',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('',0),
			),
			'itemsProcFunc' => 'tx_templavoila_handleStaticdatastructures->templateObjectItemsProcFunc',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'selicon_cols' => 10,
		)
	),
	'tx_templavoila_flex' => Array (
		'l10n_cat' => 'text',
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:tt_content.tx_templavoila_flex',
		'displayCond' => 'FIELD:tx_templavoila_ds:REQ:true',
		'config' => Array (
			'type' => 'flex',
			'ds_pointerField' => 'tx_templavoila_ds',
			'ds_tableField' => 'tx_templavoila_datastructure:dataprot',
		)
	),
	'tx_templavoila_pito' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:tt_content.tx_templavoila_pito',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('',0),
			),
			'itemsProcFunc' => 'tx_templavoila_handleStaticdatastructures->pi_templates',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'selicon_cols' => 10,
		)
	),
);
t3lib_extMgm::addTCAcolumns('tt_content', $tempColumns, 1);

$TCA['tt_content']['ctrl']['typeicons'][$_EXTKEY . '_pi1'] = t3lib_extMgm::extRelPath($_EXTKEY) . '/icon_fce_ce.png';
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$_EXTKEY . '_pi1'] =  'extensions-templavoila-type-fce';
t3lib_extMgm::addPlugin(array('LLL:EXT:templavoila/locallang_db.xml:tt_content.CType_pi1', $_EXTKEY . '_pi1', 'EXT:' . $_EXTKEY . '/icon_fce_ce.png'), 'CType');

if ($_EXTCONF['enable.']['selectDataStructure']) {
	if ($TCA['tt_content']['ctrl']['requestUpdate'] != '') {
		$TCA['tt_content']['ctrl']['requestUpdate'] .= ',';
	}
	$TCA['tt_content']['ctrl']['requestUpdate'] .= 'tx_templavoila_ds';
}


if(tx_templavoila_div::convertVersionNumberToInteger(TYPO3_version) >= 4005000) {

		$TCA['tt_content']['types'][$_EXTKEY . '_pi1']['showitem'] =
					'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.general;general,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.headers;headers,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.appearance,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.frames;frames,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.extended';
		if ($_EXTCONF['enable.']['selectDataStructure']) {
			t3lib_extMgm::addToAllTCAtypes('tt_content', 'tx_templavoila_ds;;;;1-1-1,tx_templavoila_to', $_EXTKEY . '_pi1', 'after:layout');
		} else {
			t3lib_extMgm::addToAllTCAtypes('tt_content', 'tx_templavoila_to', $_EXTKEY . '_pi1', 'after:layout');
		}
		t3lib_extMgm::addToAllTCAtypes('tt_content', 'tx_templavoila_flex;;;;1-1-1', $_EXTKEY . '_pi1', 'after:subheader');

} else {
	$TCA['tt_content']['types'][$_EXTKEY . '_pi1']['showitem'] =
		'CType;;4;;1-1-1, hidden, header;;' . (($_EXTCONF['enable.']['renderFCEHeader']) ? '3' : '' ) . ';;2-2-2, linkToTop;;;;3-3-3,
		--div--;LLL:EXT:templavoila/locallang_db.xml:tt_content.CType_pi1,' . (($_EXTCONF['enable.']['selectDataStructure']) ? 'tx_templavoila_ds,' : '') . 'tx_templavoila_to,tx_templavoila_flex;;;;2-2-2,
		--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access, starttime, endtime, fe_group';
}


	// For pages:
$tempColumns = array (
	'tx_templavoila_ds' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:pages.tx_templavoila_ds',
		'config' => array (
			'type' => 'select',
			'items' => Array (
				array('',0),
			),
			'allowNonIdValues' => 1,
			'itemsProcFunc' => 'tx_templavoila_handleStaticdatastructures->dataSourceItemsProcFunc',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'suppress_icons' => 'ONLY_SELECTED',
			'selicon_cols' => 10,
		)
	),
	'tx_templavoila_to' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:pages.tx_templavoila_to',
		'displayCond' => 'FIELD:tx_templavoila_ds:REQ:true',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('',0),
			),
			'itemsProcFunc' => 'tx_templavoila_handleStaticdatastructures->templateObjectItemsProcFunc',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'suppress_icons' => 'ONLY_SELECTED',
			'selicon_cols' => 10,
		)
	),
	'tx_templavoila_next_ds' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:pages.tx_templavoila_next_ds',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('',0),
			),
			'allowNonIdValues' => 1,
			'itemsProcFunc' => 'tx_templavoila_handleStaticdatastructures->dataSourceItemsProcFunc',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'suppress_icons' => 'ONLY_SELECTED',
			'selicon_cols' => 10,
		)
	),
	'tx_templavoila_next_to' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:pages.tx_templavoila_next_to',
		'displayCond' => 'FIELD:tx_templavoila_next_ds:REQ:true',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('',0),
			),
			'itemsProcFunc' => 'tx_templavoila_handleStaticdatastructures->templateObjectItemsProcFunc',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'suppress_icons' => 'ONLY_SELECTED',
			'selicon_cols' => 10,
		)
	),
	'tx_templavoila_flex' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila/locallang_db.xml:pages.tx_templavoila_flex',
		'config' => Array (
			'type' => 'flex',
			'ds_pointerField' => 'tx_templavoila_ds',
			'ds_pointerField_searchParent' => 'pid',
			'ds_pointerField_searchParent_subField' => 'tx_templavoila_next_ds',
			'ds_tableField' => 'tx_templavoila_datastructure:dataprot',
		)
	),
);
t3lib_extMgm::addTCAcolumns('pages', $tempColumns, 1);
if ($_EXTCONF['enable.']['selectDataStructure']) {

	if(tx_templavoila_div::convertVersionNumberToInteger(TYPO3_version) >= 4005000) {
		t3lib_extMgm::addToAllTCAtypes('pages', 'tx_templavoila_ds;;;;1-1-1,tx_templavoila_to', '', 'replace:backend_layout');
		t3lib_extMgm::addToAllTCAtypes('pages', 'tx_templavoila_next_ds;;;;1-1-1,tx_templavoila_next_to', '', 'replace:backend_layout_next_level');
		t3lib_extMgm::addToAllTCAtypes('pages', 'tx_templavoila_flex;;;;1-1-1', '', 'after:title');
	} else {
		t3lib_extMgm::addToAllTCAtypes('pages','tx_templavoila_ds;;;;1-1-1,tx_templavoila_to,tx_templavoila_next_ds;;;;1-1-1,tx_templavoila_next_to,tx_templavoila_flex;;;;1-1-1');
	}

	if ($TCA['pages']['ctrl']['requestUpdate'] != '') {
		$TCA['pages']['ctrl']['requestUpdate'] .= ',';
	}
	$TCA['pages']['ctrl']['requestUpdate'] .= 'tx_templavoila_ds,tx_templavoila_next_ds';

} else {
	if(tx_templavoila_div::convertVersionNumberToInteger(TYPO3_version) >= 4005000) {
		if (!$_EXTCONF['enable.']['oldPageModule']) {
			t3lib_extMgm::addToAllTCAtypes('pages', 'tx_templavoila_to;;;;1-1-1', '', 'replace:backend_layout');
			t3lib_extMgm::addToAllTCAtypes('pages', 'tx_templavoila_next_to;;;;1-1-1', '', 'replace:backend_layout_next_level');
			t3lib_extMgm::addToAllTCAtypes('pages', 'tx_templavoila_flex;;;;1-1-1', '', 'after:title');
		} else {
			t3lib_extMgm::addFieldsToPalette('pages', 'layout', '--linebreak--, tx_templavoila_to;;;;1-1-1, tx_templavoila_next_to;;;;1-1-1', 'after:backend_layout_next_level');
			t3lib_extMgm::addToAllTCAtypes('pages', 'tx_templavoila_flex;;;;1-1-1', '', 'after:title');
		}
	} else {
		t3lib_extMgm::addToAllTCAtypes('pages','tx_templavoila_to;;;;1-1-1,tx_templavoila_next_to;;;;1-1-1,tx_templavoila_flex;;;;1-1-1');
	}

	unset($TCA['pages']['columns']['tx_templavoila_to']['displayCond']);
	unset($TCA['pages']['columns']['tx_templavoila_next_to']['displayCond']);
}

	// Configure the referencing wizard to be used in the web_func module:
if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::insertModuleFunction(
		'web_func',
		'tx_templavoila_referenceElementsWizard',
		t3lib_extMgm::extPath($_EXTKEY).'func_wizards/class.tx_templavoila_referenceelementswizard.php',
		'LLL:EXT:templavoila/locallang.xml:wiz_refElements',
		'wiz'
	);
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_func','EXT:wizard_crpages/locallang_csh.xml');
}
	// complex condition to make sure the icons are available during frontend editing...
if (TYPO3_MODE == 'BE' ||
	(TYPO3_MODE == 'FE' && isset($GLOBALS['BE_USER']) && method_exists($GLOBALS['BE_USER'], 'isFrontendEditingActive')  && $GLOBALS['BE_USER']->isFrontendEditingActive())
) {
	$icons = array(
		'paste' => t3lib_extMgm::extRelPath('templavoila') . 'mod1/clip_pasteafter.gif',
		'pasteSubRef' => t3lib_extMgm::extRelPath('templavoila') . 'mod1/clip_pastesubref.gif',
		'makelocalcopy' => t3lib_extMgm::extRelPath('templavoila') . 'mod1/makelocalcopy.gif',
		'clip_ref' => t3lib_extMgm::extRelPath('templavoila') . 'mod1/clip_ref.gif',
		'clip_ref-release' => t3lib_extMgm::extRelPath('templavoila') . 'mod1/clip_ref_h.gif',
		'unlink' => t3lib_extMgm::extRelPath('templavoila') . 'mod1/unlink.png',
		'htmlvalidate' => t3lib_extMgm::extRelPath('templavoila') . 'resources/icons/html_go.png',
		'type-fce' => t3lib_extMgm::extRelPath('templavoila') . 'icon_fce_ce.png'
	);
	t3lib_SpriteManager::addSingleIcons($icons, $_EXTKEY);
}

###########################
## EXTENSION: felogin
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/felogin/ext_tables.php
###########################

$_EXTKEY = 'felogin';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$_EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['felogin']);

t3lib_div::loadTCA('tt_content');

if(t3lib_div::int_from_ver(TYPO3_version) >= 4002000)
	t3lib_extMgm::addPiFlexFormValue('*','FILE:EXT:'.$_EXTKEY.'/flexform.xml','login');
else
	t3lib_extMgm::addPiFlexFormValue('default','FILE:EXT:'.$_EXTKEY.'/flexform.xml');



	#replace login
$TCA['tt_content']['types']['login']['showitem'] = '--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.general;general,
													--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.header;header,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.plugin,
													pi_flexform;;;;1-1-1,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
													--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility,
													--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.appearance,
													--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.frames;frames,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.behaviour,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.extended';

	// Adds the redirect field to the fe_groups table
$tempColumns = array(
	'felogin_redirectPid' => array(
		'exclude' => 1,
		'label'  => 'LLL:EXT:felogin/locallang_db.xml:felogin_redirectPid',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
		)
	),
);

t3lib_div::loadTCA('fe_groups');
t3lib_extMgm::addTCAcolumns('fe_groups', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('fe_groups', 'felogin_redirectPid;;;;1-1-1');

	// Adds the redirect field and the forgotHash field to the fe_users-table
$tempColumns = array (
	"felogin_redirectPid" => array (
		"exclude" => 1,
		"label" => "LLL:EXT:felogin/locallang_db.xml:felogin_redirectPid",
		"config" => array (
			"type" => "group",
			"internal_type" => "db",
			"allowed" => "pages",
			"size" => 1,
			"minitems" => 0,
			"maxitems" => 1,
		)
	),
	'felogin_forgotHash' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:felogin/locallang_db.xml:felogin_forgotHash',
		'config' => array (
			'type' => 'passthrough',
		)
	),
);

t3lib_div::loadTCA("fe_users");
t3lib_extMgm::addTCAcolumns("fe_users",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("fe_users","felogin_redirectPid;;;;1-1-1");


###########################
## EXTENSION: weeaar_googlesitemap
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/weeaar_googlesitemap/ext_tables.php
###########################

$_EXTKEY = 'weeaar_googlesitemap';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=="BE")	{
		
	t3lib_extMgm::addModule("web","txweeaargooglesitemapM1","",t3lib_extMgm::extPath($_EXTKEY)."mod1/");
}

###########################
## EXTENSION: kb_cleanfiles
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/kb_cleanfiles/ext_tables.php
###########################

$_EXTKEY = 'kb_cleanfiles';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
		
	t3lib_extMgm::addModule('tools','txkbcleanfilesM1','',t3lib_extMgm::extPath($_EXTKEY).'mod1/');
}

###########################
## EXTENSION: t3skin
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/t3skin/ext_tables.php
###########################

$_EXTKEY = 't3skin';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE == 'BE' || (TYPO3_MODE == 'FE' && isset($GLOBALS['BE_USER']))) {
	global $TBE_STYLES;

		// register as a skin
	$TBE_STYLES['skins'][$_EXTKEY] = array(
		'name' => 't3skin',
	);

		// Support for other extensions to add own icons...
	$presetSkinImgs = is_array($TBE_STYLES['skinImg']) ?
		$TBE_STYLES['skinImg'] :
		array();

	$TBE_STYLES['skins'][$_EXTKEY]['stylesheetDirectories']['sprites'] = 'EXT:t3skin/stylesheets/sprites/';

	/**
	 * Setting up backend styles and colors
	 */
	$TBE_STYLES['mainColors'] = array(	// Always use #xxxxxx color definitions!
		'bgColor'    => '#FFFFFF',		// Light background color
		'bgColor2'   => '#FEFEFE',		// Steel-blue
		'bgColor3'   => '#F1F3F5',		// dok.color
		'bgColor4'   => '#E6E9EB',		// light tablerow background, brownish
		'bgColor5'   => '#F8F9FB',		// light tablerow background, greenish
		'bgColor6'   => '#E6E9EB',		// light tablerow background, yellowish, for section headers. Light.
		'hoverColor' => '#FF0000',
		'navFrameHL' => '#F8F9FB'
	);

	$TBE_STYLES['colorschemes'][0] = '-|class-main1,-|class-main2,-|class-main3,-|class-main4,-|class-main5';
	$TBE_STYLES['colorschemes'][1] = '-|class-main11,-|class-main12,-|class-main13,-|class-main14,-|class-main15';
	$TBE_STYLES['colorschemes'][2] = '-|class-main21,-|class-main22,-|class-main23,-|class-main24,-|class-main25';
	$TBE_STYLES['colorschemes'][3] = '-|class-main31,-|class-main32,-|class-main33,-|class-main34,-|class-main35';
	$TBE_STYLES['colorschemes'][4] = '-|class-main41,-|class-main42,-|class-main43,-|class-main44,-|class-main45';
	$TBE_STYLES['colorschemes'][5] = '-|class-main51,-|class-main52,-|class-main53,-|class-main54,-|class-main55';

	$TBE_STYLES['styleschemes'][0]['all'] = 'CLASS: formField';
	$TBE_STYLES['styleschemes'][1]['all'] = 'CLASS: formField1';
	$TBE_STYLES['styleschemes'][2]['all'] = 'CLASS: formField2';
	$TBE_STYLES['styleschemes'][3]['all'] = 'CLASS: formField3';
	$TBE_STYLES['styleschemes'][4]['all'] = 'CLASS: formField4';
	$TBE_STYLES['styleschemes'][5]['all'] = 'CLASS: formField5';

	$TBE_STYLES['styleschemes'][0]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][1]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][2]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][3]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][4]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][5]['check'] = 'CLASS: checkbox';

	$TBE_STYLES['styleschemes'][0]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][1]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][2]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][3]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][4]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][5]['radio'] = 'CLASS: radio';

	$TBE_STYLES['styleschemes'][0]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][1]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][2]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][3]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][4]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][5]['select'] = 'CLASS: select';

	$TBE_STYLES['borderschemes'][0] = array('', '', '', 'wrapperTable');
	$TBE_STYLES['borderschemes'][1] = array('', '', '', 'wrapperTable1');
	$TBE_STYLES['borderschemes'][2] = array('', '', '', 'wrapperTable2');
	$TBE_STYLES['borderschemes'][3] = array('', '', '', 'wrapperTable3');
	$TBE_STYLES['borderschemes'][4] = array('', '', '', 'wrapperTable4');
	$TBE_STYLES['borderschemes'][5] = array('', '', '', 'wrapperTable5');



		// Setting the relative path to the extension in temp. variable:
	$temp_eP = t3lib_extMgm::extRelPath($_EXTKEY);

		// Alternative dimensions for frameset sizes:
	$TBE_STYLES['dims']['leftMenuFrameW'] = 190;		// Left menu frame width
	$TBE_STYLES['dims']['topFrameH']      = 42;			// Top frame height
	$TBE_STYLES['dims']['navFrameWidth']  = 280;		// Default navigation frame width

		// Setting roll-over background color for click menus:
		// Notice, this line uses the the 'scriptIDindex' feature to override another value in this array (namely $TBE_STYLES['mainColors']['bgColor5']), for a specific script "typo3/alt_clickmenu.php"
	$TBE_STYLES['scriptIDindex']['typo3/alt_clickmenu.php']['mainColors']['bgColor5'] = '#dedede';

		// Setting up auto detection of alternative icons:
	$TBE_STYLES['skinImgAutoCfg'] = array(
		'absDir'             => t3lib_extMgm::extPath($_EXTKEY).'icons/',
		'relDir'             => t3lib_extMgm::extRelPath($_EXTKEY).'icons/',
		'forceFileExtension' => 'gif',	// Force to look for PNG alternatives...
#		'scaleFactor'        => 2/3,	// Scaling factor, default is 1
		'iconSizeWidth'      => 16,
		'iconSizeHeight'     => 16,
	);

		// Changing icon for filemounts, needs to be done here as overwriting the original icon would also change the filelist tree's root icon
	$TCA['sys_filemounts']['ctrl']['iconfile'] = '_icon_ftp_2.gif';

		// Adding flags to sys_language
	t3lib_div::loadTCA('sys_language');
	$TCA['sys_language']['ctrl']['typeicon_column'] = 'flag';
	$TCA['sys_language']['ctrl']['typeicon_classes'] = array(
		'default' => 'mimetypes-x-sys_language',
		'mask'	=> 'flags-###TYPE###'
	);
	$flagNames = array(
		'multiple', 'ad', 'ae', 'af', 'ag', 'ai', 'al', 'am', 'an', 'ao', 'ar', 'as', 'at', 'au', 'aw', 'ax', 'az',
		'ba', 'bb', 'bd', 'be', 'bf', 'bg', 'bh', 'bi', 'bj', 'bm', 'bn', 'bo', 'br', 'bs', 'bt', 'bv', 'bw', 'by', 'bz',
		'ca', 'catalonia', 'cc', 'cd', 'cf', 'cg', 'ch', 'ci', 'ck', 'cl', 'cm', 'cn', 'co', 'cr', 'cs', 'cu', 'cv', 'cx', 'cy', 'cz',
		'de', 'dj', 'dk', 'dm', 'do', 'dz',
		'ec', 'ee', 'eg', 'eh', 'england', 'er', 'es', 'et', 'europeanunion',
		'fam', 'fi', 'fj', 'fk', 'fm', 'fo', 'fr',
		'ga', 'gb', 'gd', 'ge', 'gf', 'gh', 'gi', 'gl', 'gm', 'gn', 'gp', 'gq', 'gr', 'gs', 'gt', 'gu', 'gw', 'gy',
		'hk', 'hm', 'hn', 'hr', 'ht', 'hu',
		'id', 'ie', 'il', 'in', 'io', 'iq', 'ir', 'is', 'it',
		'jm', 'jo', 'jp',
		'ke', 'kg', 'kh', 'ki', 'km', 'kn', 'kp', 'kr', 'kw', 'ky', 'kz',
		'la', 'lb', 'lc', 'li', 'lk', 'lr', 'ls', 'lt', 'lu', 'lv', 'ly',
		'ma', 'mc', 'md', 'me', 'mg', 'mh', 'mk', 'ml', 'mm', 'mn', 'mo', 'mp', 'mq', 'mr', 'ms', 'mt', 'mu', 'mv', 'mw', 'mx', 'my', 'mz',
		'na', 'nc', 'ne', 'nf', 'ng', 'ni', 'nl', 'no', 'np', 'nr', 'nu', 'nz',
		'om',
		'pa', 'pe', 'pf', 'pg', 'ph', 'pk', 'pl', 'pm', 'pn', 'pr', 'ps', 'pt', 'pw', 'py',
		'qa', 'qc',
		're', 'ro', 'rs', 'ru', 'rw',
		'sa', 'sb', 'sc', 'scotland', 'sd', 'se', 'sg', 'sh', 'si', 'sj', 'sk', 'sl', 'sm', 'sn', 'so', 'sr', 'st', 'sv', 'sy', 'sz',
		'tc', 'td', 'tf', 'tg', 'th', 'tj', 'tk', 'tl', 'tm', 'tn', 'to', 'tr', 'tt', 'tv', 'tw', 'tz',
		'ua', 'ug', 'um', 'us', 'uy', 'uz',
		'va', 'vc', 've', 'vg', 'vi', 'vn', 'vu',
		'wales', 'wf', 'ws',
		'ye', 'yt',
		'za', 'zm', 'zw'
	);
	foreach ($flagNames as $flagName) {
		$TCA['sys_language']['columns']['flag']['config']['items'][] = array($flagName, $flagName, 'EXT:t3skin/images/flags/'. $flagName . '.png');
	}

		// Manual setting up of alternative icons. This is mainly for module icons which has a special prefix:
	$TBE_STYLES['skinImg'] = array_merge($presetSkinImgs, array (
		'gfx/ol/blank.gif'                         => array('clear.gif','width="18" height="16"'),
		'MOD:web/website.gif'                      => array($temp_eP.'icons/module_web.gif','width="24" height="24"'),
		'MOD:web_layout/layout.gif'                => array($temp_eP.'icons/module_web_layout.gif','width="24" height="24"'),
		'MOD:web_view/view.gif'                    => array($temp_eP.'icons/module_web_view.png','width="24" height="24"'),
		'MOD:web_list/list.gif'                    => array($temp_eP.'icons/module_web_list.gif','width="24" height="24"'),
		'MOD:web_info/info.gif'                    => array($temp_eP.'icons/module_web_info.png','width="24" height="24"'),
		'MOD:web_perm/perm.gif'                    => array($temp_eP.'icons/module_web_perms.png','width="24" height="24"'),
		'MOD:web_func/func.gif'                    => array($temp_eP.'icons/module_web_func.png','width="24" height="24"'),
		'MOD:web_ts/ts1.gif'                       => array($temp_eP.'icons/module_web_ts.gif','width="24" height="24"'),
		'MOD:web_modules/modules.gif'              => array($temp_eP.'icons/module_web_modules.gif','width="24" height="24"'),
		'MOD:web_txversionM1/cm_icon.gif'          => array($temp_eP.'icons/module_web_version.gif','width="24" height="24"'),
		'MOD:file/file.gif'                        => array($temp_eP.'icons/module_file.gif','width="22" height="24"'),
		'MOD:file_list/list.gif'                   => array($temp_eP.'icons/module_file_list.gif','width="22" height="24"'),
		'MOD:file_images/images.gif'               => array($temp_eP.'icons/module_file_images.gif','width="22" height="22"'),
		'MOD:user/user.gif'                        => array($temp_eP.'icons/module_user.gif','width="22" height="22"'),
		'MOD:user_task/task.gif'                   => array($temp_eP.'icons/module_user_taskcenter.gif','width="22" height="22"'),
		'MOD:user_setup/setup.gif'                 => array($temp_eP.'icons/module_user_setup.gif','width="22" height="22"'),
		'MOD:user_doc/document.gif'                => array($temp_eP.'icons/module_doc.gif','width="22" height="22"'),
		'MOD:user_ws/sys_workspace.gif'            => array($temp_eP.'icons/module_user_ws.gif','width="22" height="22"'),
		'MOD:tools/tool.gif'                       => array($temp_eP.'icons/module_tools.gif','width="25" height="24"'),
		'MOD:tools_beuser/beuser.gif'              => array($temp_eP.'icons/module_tools_user.gif','width="24" height="24"'),
		'MOD:tools_em/em.gif'                      => array($temp_eP.'icons/module_tools_em.png','width="24" height="24"'),
		'MOD:tools_em/install.gif'                 => array($temp_eP.'icons/module_tools_em.gif','width="24" height="24"'),
		'MOD:tools_dbint/db.gif'                   => array($temp_eP.'icons/module_tools_dbint.gif','width="25" height="24"'),
		'MOD:tools_config/config.gif'              => array($temp_eP.'icons/module_tools_config.gif','width="24" height="24"'),
		'MOD:tools_install/install.gif'            => array($temp_eP.'icons/module_tools_install.gif','width="24" height="24"'),
		'MOD:tools_log/log.gif'                    => array($temp_eP.'icons/module_tools_log.gif','width="24" height="24"'),
		'MOD:tools_txphpmyadmin/thirdparty_db.gif' => array($temp_eP.'icons/module_tools_phpmyadmin.gif','width="24" height="24"'),
		'MOD:tools_isearch/isearch.gif'            => array($temp_eP.'icons/module_tools_isearch.gif','width="24" height="24"'),
		'MOD:help/help.gif'                        => array($temp_eP.'icons/module_help.gif','width="23" height="24"'),
		'MOD:help_about/info.gif'                  => array($temp_eP.'icons/module_help_about.gif','width="25" height="24"'),
		'MOD:help_aboutmodules/aboutmodules.gif'   => array($temp_eP.'icons/module_help_aboutmodules.gif','width="24" height="24"'),
		'MOD:help_cshmanual/about.gif'         => array($temp_eP.'icons/module_help_cshmanual.gif','width="25" height="24"'),
		'MOD:help_txtsconfighelpM1/moduleicon.gif' => array($temp_eP.'icons/module_help_ts.gif','width="25" height="24"'),
	));

		// Logo at login screen
	$TBE_STYLES['logo_login'] = $temp_eP . 'images/login/typo3logo-white-greyback.gif';

		// extJS theme
	$TBE_STYLES['extJS']['theme'] =  $temp_eP . 'extjs/xtheme-t3skin.css';

	// Adding HTML template for login screen
	$TBE_STYLES['htmlTemplates']['templates/login.html'] = 'sysext/t3skin/templates/login.html';

	$GLOBALS['TYPO3_CONF_VARS']['typo3/backend.php']['additionalBackendItems'][] = t3lib_extMgm::extPath('t3skin').'registerIe6Stylesheet.php';

	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['preHeaderRenderHook'][] = t3lib_extMgm::extPath('t3skin').'pngfix/class.tx_templatehook.php:tx_templatehook->registerPngFix';

	$GLOBALS['TBE_STYLES']['stylesheets']['admPanel'] = t3lib_extMgm::siteRelPath('t3skin') . 'stylesheets/standalone/admin_panel.css';

	foreach ($flagNames as $flagName) {
		t3lib_SpriteManager::addIconSprite(
			array(
				'flags-' . $flagName,
				'flags-' . $flagName . '-overlay',
			)
		);
	}
	unset($flagNames, $flagName);

}


###########################
## EXTENSION: version
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/version/ext_tables.php
###########################

$_EXTKEY = 'version';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE=='BE')	{
	if (!t3lib_extMgm::isLoaded('workspaces')) {
		$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][]=array(
			'name' => 'tx_version_cm1',
			'path' => t3lib_extMgm::extPath($_EXTKEY).'class.tx_version_cm1.php'
		);

		t3lib_extMgm::addModule('web', 'txversionM1', '', t3lib_extMgm::extPath($_EXTKEY) . 'cm1/');
	}
}

###########################
## EXTENSION: tt_news
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/tt_news/ext_tables.php
###########################

$_EXTKEY = 'tt_news';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


/**
 * $Id: ext_tables.php 44687 2011-03-06 15:21:07Z rupi $
 */

if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
	// get extension configuration
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['tt_news']);





$TCA['tt_news'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:tt_news/locallang_tca.xml:tt_news',
		'label' => ($confArr['label']) ? $confArr['label'] : 'title',
		'label_alt' => $confArr['label_alt'] . ($confArr['label_alt2'] ? ',' . $confArr['label_alt2'] : ''),
		'label_alt_force' => $confArr['label_alt_force'],
		'default_sortby' => 'ORDER BY datetime DESC',
		'prependAtCopy' => $confArr['prependAtCopy'] ? 'LLL:EXT:lang/locallang_general.php:LGL.prependAtCopy' : '',
 		'versioningWS' => TRUE,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'shadowColumnsForNewPlaceholders' => 'sys_language_uid,l18n_parent,starttime,endtime,fe_group',

		'dividers2tabs' => TRUE,
		'useColumnsForDefaultValues' => 'type',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'crdate' => 'crdate',
		'tstamp' => 'tstamp',
		'delete' => 'deleted',
		'type' => 'type',
		'cruser_id' => 'cruser_id',
		'editlock' => 'editlock',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'typeicon_column' => 'type',
		'typeicons' => array (
			'1' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/tt_news_article.gif',
			'2' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/tt_news_exturl.gif',
		),
//		'mainpalette' => '10',
		'thumbnail' => 'image',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/ext_icon.gif',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php'
	)
);


#$category_OrderBy = $confArr['category_OrderBy'];
$TCA['tt_news_cat'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:tt_news/locallang_tca.xml:tt_news_cat',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'delete' => 'deleted',
		'default_sortby' => 'ORDER BY uid',
		'treeParentField' => 'parent_category',
		'dividers2tabs' => TRUE,
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
// 		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.php:LGL.prependAtCopy',
		'hideAtCopy' => true,
		'mainpalette' => '2,10',
		'crdate' => 'crdate',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/tt_news_cat.gif',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php'
	)
);

	// load tt_content to $TCA array
t3lib_div::loadTCA('tt_content');
	// remove some fields from the tt_content content element
$TCA['tt_content']['types']['list']['subtypes_excludelist'][9] = 'layout,select_key,pages,recursive';
	// add FlexForm field to tt_content
$TCA['tt_content']['types']['list']['subtypes_addlist'][9] = 'pi_flexform';
	// add tt_news to the "insert plugin" content element (list_type = 9)
t3lib_extMgm::addPlugin(array('LLL:EXT:tt_news/locallang_tca.xml:tt_news', 9));

t3lib_extMgm::addTypoScriptSetup('
  includeLibs.ts_news = EXT:tt_news/pi/class.tx_ttnews.php
  plugin.tt_news = USER
  plugin.tt_news {
    userFunc = tx_ttnews->main_news

    # validate some configuration values and display a message if errors have been found
    enableConfigValidation = 1
  }
');

	// initialize static extension templates
t3lib_extMgm::addStaticFile($_EXTKEY,'pi/static/ts_new/','News settings');
t3lib_extMgm::addStaticFile($_EXTKEY,'pi/static/css/','News CSS-styles');
//t3lib_extMgm::addStaticFile($_EXTKEY,'pi/static/ts_old/','table-based tmpl');
t3lib_extMgm::addStaticFile($_EXTKEY,'pi/static/rss_feed/','News feeds (RSS,RDF,ATOM)');

	// allow news and news-category records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tt_news_cat');
t3lib_extMgm::allowTableOnStandardPages('tt_news');
	// add the tt_news record to the insert records content element
t3lib_extMgm::addToInsertRecords('tt_news');

	// switch the XML files for the FlexForm depending on if "use StoragePid"(general record Storage Page) is set or not.
if ($confArr['useStoragePid']) {
	t3lib_extMgm::addPiFlexFormValue(9, 'FILE:EXT:tt_news/flexform_ds.xml');
} else {
	t3lib_extMgm::addPiFlexFormValue(9, 'FILE:EXT:tt_news/flexform_ds_no_sPID.xml');
}


t3lib_extMgm::addPageTSConfig('
	# RTE mode in table "tt_news"
	RTE.config.tt_news.bodytext.proc.overruleMode = ts_css

	TCEFORM.tt_news.bodytext.RTEfullScreenWidth = 100%



mod.web_txttnewsM1 {
	catmenu {
		expandFirst = 1

		show {
			cb_showEditIcons = 1
			cb_expandAll = 1
			cb_showHiddenCategories = 1

			btn_newCategory = 1
		}
	}
	list {
		limit = 15
		pidForNewArticles =
		fList = pid,uid,title,datetime,archivedate,tstamp,category;author
		icon = 1

		# configures the behavior of the record-title link. Possible values:
		# edit: link editform, view: link FE singleView, any other value: no link
		clickTitleMode = edit

		noListWithoutCatSelection = 1

		show {
			cb_showOnlyEditable = 1
			cb_showThumbs = 1
			search = 1

		}
		imageSize = 50

	}
	defaultLanguageLabel =
}



');




	// initalize "context sensitive help" (csh)
t3lib_extMgm::addLLrefForTCAdescr('tt_news','EXT:tt_news/csh/locallang_csh_ttnews.php');
t3lib_extMgm::addLLrefForTCAdescr('tt_news_cat','EXT:tt_news/csh/locallang_csh_ttnewscat.php');
t3lib_extMgm::addLLrefForTCAdescr('xEXT_tt_news','EXT:tt_news/csh/locallang_csh_manual.xml');
t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_txttnewsM1','EXT:tt_news/csh/locallang_csh_mod_newsadmin.xml');

//TODO how to insert CSH to the be_users table ???

	// adds processing for extra "codes" that have been added to the "what to display" selector in the content element by other extensions
include_once(t3lib_extMgm::extPath($_EXTKEY).'lib/class.tx_ttnews_itemsProcFunc.php');
	// class for displaying the category tree in BE forms.
include_once(t3lib_extMgm::extPath($_EXTKEY).'lib/class.tx_ttnews_TCAform_selectTree.php');
	// class that uses hooks in class.t3lib_tcemain.php (processDatamapClass and processCmdmapClass)
	// to prevent not allowed "commands" (copy,delete,...) for a certain BE usergroup
include_once(t3lib_extMgm::extPath($_EXTKEY).'lib/class.tx_ttnews_tcemain.php');





$tempColumns = array (
		'tt_news_categorymounts' => array (
			'exclude' => 1,
		#	'l10n_mode' => 'exclude', // the localizalion mode will be handled by the userfunction
			'label' => 'LLL:EXT:tt_news/locallang_tca.xml:tt_news.categorymounts',
			'config' => array (


				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_ttnews_TCAform_selectTree->renderCategoryFields',
				'treeView' => 1,
				'foreign_table' => 'tt_news_cat',
				#'foreign_table_where' => $fTableWhere.'ORDER BY tt_news_cat.'.$confArr['category_OrderBy'],
				'size' => 3,
				'minitems' => 0,
				'maxitems' => 500,
// 				'MM' => 'tt_news_cat_mm',

			)
		),
// 		'tt_news_cmounts_usesubcats' => array (
// 			'exclude' => 1,
// 			'label' => 'LLL:EXT:tt_news/locallang_tca.xml:tt_news.cmounts_usesubcats',
// 			'config' => array (
// 				'type' => 'check'
// 			)
// 		),
);


t3lib_div::loadTCA('be_groups');
t3lib_extMgm::addTCAcolumns('be_groups',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('be_groups','tt_news_categorymounts;;;;1-1-1');

$tempColumns['tt_news_categorymounts']['displayCond'] = 'FIELD:admin:=:0';
// $tempColumns['tt_news_cmounts_usesubcats']['displayCond'] = 'FIELD:admin:=:0';


t3lib_div::loadTCA('be_users');
t3lib_extMgm::addTCAcolumns('be_users',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('be_users','tt_news_categorymounts;;;;1-1-1');


if (TYPO3_MODE == 'BE')	{
	if (t3lib_div::int_from_ver(TYPO3_version) >= 4000000) {
		if (t3lib_div::int_from_ver(TYPO3_version) >= 4002000) {
			t3lib_extMgm::addModule('web','txttnewsM1','',t3lib_extMgm::extPath($_EXTKEY).'mod1/');

			$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables'][$_EXTKEY][0]['fList'] = 'uid,title,author,category,datetime,archivedate,tstamp';
			$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables'][$_EXTKEY][0]['icon'] = TRUE;


		} else {
			/**
			 * @deprecated
			 * this module will be removed completely in future versions
			 */
			t3lib_extMgm::insertModuleFunction(
				'web_info',
				'tx_ttnewscatmanager_modfunc1',
				t3lib_extMgm::extPath($_EXTKEY).'modfunc1/class.tx_ttnewscatmanager_modfunc1.php',
				'LLL:EXT:tt_news/modfunc1/locallang.xml:moduleFunction.tx_ttnews_modfunc1'
			);
		}
		// register contextmenu for the tt_news category manager
		$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][] = array(
			'name' => 'tx_ttnewscatmanager_cm1',
			'path' => t3lib_extMgm::extPath($_EXTKEY).'cm1/class.tx_ttnewscatmanager_cm1.php'
		);
	}
		// Adds a tt_news wizard icon to the content element wizard.
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_ttnews_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi/class.tx_ttnews_wizicon.php';

		// add folder icon
	if (t3lib_div::int_from_ver(TYPO3_version) < 4004000) {
		$ICON_TYPES['news'] = array('icon' => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/gfx/ext_icon_ttnews_folder.gif');
	} else {
		t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-news', t3lib_extMgm::extRelPath($_EXTKEY) . 'res/gfx/ext_icon_ttnews_folder.gif');
	}

	if (TYPO3_UseCachingFramework) {
		// register the cache in BE so it will be cleared with "clear all caches"
		try {
			$GLOBALS['typo3CacheFactory']->create(
				'tt_news_cache',
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tt_news_cache']['frontend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tt_news_cache']['backend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tt_news_cache']['options']);
		} catch (t3lib_cache_exception_DuplicateIdentifier $e) {
			// do nothing, a tt_news_cache cache already exists
		}
	}

}

	// register HTML template for the tt_news BackEnd Module
$GLOBALS['TBE_STYLES']['htmlTemplates']['mod_ttnews_admin.html'] = t3lib_extMgm::extRelPath('tt_news').'mod1/mod_ttnews_admin.html';





###########################
## EXTENSION: db_yamltv
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/db_yamltv/ext_tables.php
###########################

$_EXTKEY = 'db_yamltv';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key';
//Rename backend columns to avoid naming annoyances in page-module with "oldStyleColumns"
$TCA['tt_content']['columns']['colPos']['config']['items']['0']['0'] = 'TV-SP-0';
$TCA['tt_content']['columns']['colPos']['config']['items']['0']['1'] = 0;
$TCA['tt_content']['columns']['colPos']['config']['items']['1']['0'] = 'TV-SP-1';
$TCA['tt_content']['columns']['colPos']['config']['items']['1']['1'] = 1;
$TCA['tt_content']['columns']['colPos']['config']['items']['2']['0'] = 'TV-SP-2';
$TCA['tt_content']['columns']['colPos']['config']['items']['2']['1'] = 2;
$TCA['tt_content']['columns']['colPos']['config']['items']['3']['0'] = 'TV-SP-3';
$TCA['tt_content']['columns']['colPos']['config']['items']['3']['1'] = 3;
//Additonal backend columns to avoid errors in page-module with "oldStyleColumns"
$TCA['tt_content']['columns']['colPos']['config']['items']['4']['0'] = 'TV-SP-4';
$TCA['tt_content']['columns']['colPos']['config']['items']['4']['1'] = 4;
$TCA['tt_content']['columns']['colPos']['config']['items']['5']['0'] = 'TV-SP-5';
$TCA['tt_content']['columns']['colPos']['config']['items']['5']['1'] = 5;
$TCA['tt_content']['columns']['colPos']['config']['items']['6']['0'] = 'TV-SP-6';
$TCA['tt_content']['columns']['colPos']['config']['items']['6']['1'] = 6;
$TCA['tt_content']['columns']['colPos']['config']['items']['7']['0'] = 'TV-SP-7';
$TCA['tt_content']['columns']['colPos']['config']['items']['7']['1'] = 7;
//Show "media" on pages of type shortcut
t3lib_div::loadTCA('pages');
// show "files" on pages of type 'shortcut'
// not needed for TYPO3 4.2. Uncomment if you are using older TYPO3 versions.
// $TCA['pages']['types']['4']['showitem'] = 'hidden;;;;1-1-1, doktype, title;;3;;2-2-2, subtitle, nav_hide, media;;;;4-4-4, shortcut;;;;3-3-3, shortcut_mode, TSconfig;;6;nowrap;5-5-5, storage_pid;;7, l18n_cfg, tx_templavoila_ds;;;;1-1-1, tx_templavoila_to, tx_templavoila_next_ds, tx_templavoila_next_to, tx_templavoila_flex;;;;1-1-1';

t3lib_extMgm::addPlugin(array('LLL:EXT:db_yamltv/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');

t3lib_extMgm::addStaticFile($_EXTKEY,"pi1/static/","YAML for TemplaVoila");

###########################
## EXTENSION: realurl
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/realurl/ext_tables.php
###########################

$_EXTKEY = 'realurl';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
//	t3lib_extMgm::addModule('tools','txrealurlM1','',t3lib_extMgm::extPath($_EXTKEY).'mod1/');

	// Add Web>Info module:
	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_realurl_modfunc1',
		t3lib_extMgm::extPath($_EXTKEY) . 'modfunc1/class.tx_realurl_modfunc1.php',
		'LLL:EXT:realurl/locallang_db.xml:moduleFunction.tx_realurl_modfunc1',
		'function',
		'online'
	);
}

$TCA['pages']['columns'] += array(
	'tx_realurl_pathsegment' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_pathsegment',
		'displayCond' => 'FIELD:tx_realurl_exclude:!=:1',
		'exclude' => 1,
		'config' => array (
			'type' => 'input',
			'max' => 255,
			'eval' => 'trim,nospace,lower'
		),
	),
	'tx_realurl_pathoverride' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_path_override',
		'exclude' => 1,
		'config' => array (
			'type' => 'check',
			'items' => array(
				array('', '')
			)
		)
	),
	'tx_realurl_exclude' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_exclude',
		'exclude' => 1,
		'config' => array (
			'type' => 'check',
			'items' => array(
				array('', '')
			)
		)
	),
	'tx_realurl_nocache' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_nocache',
		'exclude' => 1,
		'config' => array (
			'type' => 'check',
			'items' => array(
				array('', ''),
			),
		),
	)
);

$TCA['pages']['ctrl']['requestUpdate'] .= ',tx_realurl_exclude';

$TCA['pages']['palettes']['137'] = array(
	'showitem' => 'tx_realurl_pathoverride'
);

if (t3lib_div::compat_version('4.3')) {
	t3lib_extMgm::addFieldsToPalette('pages', '3', 'tx_realurl_nocache', 'after:cache_timeout');
}
if (t3lib_div::compat_version('4.2')) {
	// For 4.2 or new add fields to advanced page only
	t3lib_extMgm::addToAllTCAtypes('pages', 'tx_realurl_pathsegment;;137;;,tx_realurl_exclude', '1', 'after:nav_title');
	t3lib_extMgm::addToAllTCAtypes('pages', 'tx_realurl_pathsegment;;137;;,tx_realurl_exclude', '4,199,254', 'after:title');
}
else {
	// Put it for standard page
	t3lib_extMgm::addToAllTCAtypes('pages', 'tx_realurl_pathsegment;;137;;,tx_realurl_exclude', '2', 'after:nav_title');
	t3lib_extMgm::addToAllTCAtypes('pages', 'tx_realurl_pathsegment;;137;;,tx_realurl_exclude', '1,5,4,199,254', 'after:title');
}

t3lib_extMgm::addLLrefForTCAdescr('pages','EXT:realurl/locallang_csh.xml');

$TCA['pages_language_overlay']['columns'] += array(
	'tx_realurl_pathsegment' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_pathsegment',
		'exclude' => 1,
		'config' => array (
			'type' => 'input',
			'max' => 255,
			'eval' => 'trim,nospace,lower'
		),
	),
);

t3lib_extMgm::addToAllTCAtypes('pages_language_overlay', 'tx_realurl_pathsegment', '', 'after:nav_title');


###########################
## EXTENSION: static_info_tables
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/static_info_tables/ext_tables.php
###########################

$_EXTKEY = 'static_info_tables';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addStaticFile(STATIC_INFO_TABLES_EXTkey, 'static/static_info_tables/', 'Static Info tables');

$TCA['static_territories'] = array(
	'ctrl' => array(
		'label' => 'tr_name_en',
		'label_alt' => 'tr_name_en,tr_iso_nr',
		'readOnly' => 1,	// This should always be true, as it prevents the static data from being altered
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY tr_name_en',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_territories.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_territories.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'tr_name_en,tr_iso_nr'
	)
);

// Country reference data from ISO 3166-1
$TCA['static_countries'] = array(
	'ctrl' => array(
		'label' => 'cn_short_en',
		'label_alt' => 'cn_short_en,cn_iso_2',
		'readOnly' => 1,	// This should always be true, as it prevents the static data from being altered
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY cn_short_en',
		'delete' => 'deleted',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_countries.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_countries.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'cn_iso_2,cn_iso_3,cn_iso_nr,cn_official_name_local,cn_official_name_en,cn_capital,cn_tldomain,cn_currency_iso_3,cn_currency_iso_nr,cn_phone,cn_uno_member,cn_eu_member,cn_address_format,cn_short_en'
	)
);

// Country subdivision reference data from ISO 3166-2
$TCA['static_country_zones'] = array(
	'ctrl' => array(
		'label' => 'zn_name_local',
		'label_alt' => 'zn_name_local,zn_code',
		'readOnly' => 1,
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY zn_name_local',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_country_zones.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_countries.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'zn_country_iso_nr,zn_country_iso_3,zn_code,zn_name_local,zn_name_en'
	)
);

// Language reference data from ISO 639-1
$TCA['static_languages'] = array(
	'ctrl' => array(
		'label' => 'lg_name_en',
		'label_alt' => 'lg_name_en,lg_iso_2',
		'readOnly' => 1,
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY lg_name_en',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_languages.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_languages.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'lg_name_local,lg_name_en,lg_iso_2,lg_typo3,lg_country_iso_2,lg_collate_locale,lg_sacred,lg_constructed'
	)
);

// Currency reference data from ISO 4217
$TCA['static_currencies'] = array(
	'ctrl' => array(
		'label' => 'cu_name_en',
		'label_alt' => 'cu_name_en,cu_iso_3',
		'readOnly' => 1,
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY cu_name_en',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_currencies.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_currencies.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'cu_iso_3,cu_iso_nr,cu_name_en,cu_symbol_left,cu_symbol_right,cu_thousands_point,cu_decimal_point,cu_decimal_digits,cu_sub_name_en,cu_sub_divisor,cu_sub_symbol_left,cu_sub_symbol_right'
	)
);

$TCA['static_countries']['ctrl']['readOnly'] = 0;
$TCA['static_languages']['ctrl']['readOnly'] = 0;
$TCA['static_country_zones']['ctrl']['readOnly'] = 0;
$TCA['static_currencies']['ctrl']['readOnly'] = 0;
$TCA['static_territories']['ctrl']['readOnly'] = 0;


// ******************************************************************
// sys_language
// ******************************************************************

t3lib_div::loadTCA('sys_language');
$TCA['sys_language']['columns']['static_lang_isocode']['config'] = array(
	'type' => 'select',
	'items' => array(
		array('',0),
	),
	#'foreign_table' => 'static_languages',
	#'foreign_table_where' => 'AND static_languages.pid=0 ORDER BY static_languages.lg_name_en',
	'itemsProcFunc' => 'tx_staticinfotables_div->selectItemsTCA',
	'itemsProcFunc_config' => array(
		'table' => 'static_languages',
		'indexField' => 'uid',
		// I think that will make more sense in the future
		// 'indexField' => 'lg_iso_2',
		'prependHotlist' => 1,
		//	defaults:
		//'hotlistLimit' => 8,
		//'hotlistSort' => 1,
		//'hotlistOnly' => 0,
		//'hotlistApp' => TYPO3_MODE,
	),
	'size' => 1,
	'minitems' => 0,
	'maxitems' => 1,
);

$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:'.STATIC_INFO_TABLES_EXTkey.'/class.tx_staticinfotables_syslanguage.php:&tx_staticinfotables_syslanguage';


###########################
## EXTENSION: aio_loginskin
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/aio_loginskin/ext_tables.php
###########################

$_EXTKEY = 'aio_loginskin';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


$GLOBALS['TBE_STYLES']['htmlTemplates']['templates/login.html'] = 'EXT:aio_loginskin/res/login.html';

###########################
## EXTENSION: fdfx_be_image
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/fdfx_be_image/ext_tables.php
###########################

$_EXTKEY = 'fdfx_be_image';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined('TYPO3_MODE'))	die('Access denied.');
if (TYPO3_MODE === 'BE') {
	$_EXTPATH = t3lib_extMgm::extPath($_EXTKEY);
	// add DAM support
	if (t3lib_extMgm::isLoaded('dam'))
	{
		t3lib_extMgm::insertModuleFunction(
			'txdamM1_cmd',
			'tx_fdfxbeimage_modcrop',
			$_EXTPATH . 'cm1/class.tx_fdfxbeimage_modcrop.php',
			'LLL:EXT:fdfx_be_image/cm1/locallang.xml:tx_fdfxbeimage_function1'
		);
		t3lib_extMgm::insertModuleFunction(
			'txdamM1_cmd',
			'tx_fdfxbeimage_modrotate',
			$_EXTPATH . 'cm1/class.tx_fdfxbeimage_modrotate.php',
			$_EXTPATH . 'cm1/locallang.xml:tx_fdfxbeimage_function2'
		);
		tx_dam::register_action ('tx_fdfxbeimage_rotateFile',
			$_EXTPATH . 'lib/action/class.tx_fdfxbeimage_rotateFile.php:&tx_fdfxbeimage_rotateFile'
			,'top'
			);
		tx_dam::register_action ('tx_fdfxbeimage_cropFile',
			$_EXTPATH . 'lib/action/class.tx_fdfxbeimage_cropFile.php:&tx_fdfxbeimage_cropFile'
			,'top'
			);
		if (t3lib_extMgm::isLoaded('dam_ttcontent')) {
			$TCA['tt_content']['columns']['tx_damttcontent_files']['config']['wizards'] = array(
				'_PADDING' => 1,
				'_VERTICAL' => 1,
					'crop' => array(
						'type' => 'popup',
						'title' => 'Crop image',
						'script' => 'EXT:fdfx_be_image/cm1/wizard_crop.php',
						'icon' => 'EXT:fdfx_be_image/res/cm_icon_crop.png',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=350,status=0,menubar=0,scrollbars=1',
					),
			);
			$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] =  
				'EXT:fdfx_be_image/lib/hook/class.tx_fdfxbeimage_hook_tcemain.php:&tx_fdfxbeimage_hook_tcemain';		
		}
	}
	else
	{
		$GLOBALS["TBE_MODULES_EXT"]["xMOD_alt_clickmenu"]["extendCMclasses"][] = array (
			"name" => 'tx_fdfxbeimage_cm1',
			"path" =>  $_EXTPATH = t3lib_extMgm::extPath($_EXTKEY) . 'cm1/class.tx_fdfxbeimage_cm1.php'
			);
	}
	
}
t3lib_extMgm::addStaticFile($_EXTKEY,'res/static/dam_ttcontent/', 'fdfx_be_image:dam');

###########################
## EXTENSION: tt_address
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/tt_address/ext_tables.php
###########################

$_EXTKEY = 'tt_address';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

define('TT_ADDRESS_MAX_IMAGES', 6);

$TCA['tt_address'] = array (
	'ctrl' => array (
		'label'             => 'name',
		'label_alt'         => 'email',
		'default_sortby'    => 'ORDER BY name',
		'tstamp'            => 'tstamp',
		'prependAtCopy'     => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'delete'            => 'deleted',
		'title'             => 'LLL:EXT:tt_address/locallang_tca.xml:tt_address',
		'thumbnail'         => 'image',
		'enablecolumns'     => array (
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif'
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'pid,hidden,gender,name,title,address,building,room,birthday,phone,fax,mobile,www,email,city,zip,company,region,country,image,description'
	)
);

$TCA['tt_address_group'] = array(
	'ctrl' => array(
		'title'                    => 'LLL:EXT:tt_address/locallang_tca.xml:tt_address_group',
		'label'                    => 'title',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
		'cruser_id'                => 'cruser_id',
		'sortby'                   => 'sorting',
		'delete'                   => 'deleted',
		'treeParentField'          => 'parent_group',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField'            => 'sys_language_uid',
		'enablecolumns'            => array(
			'disabled' => 'hidden',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile'        => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'                 => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tt_address_group.gif',
	),
	'feInterface' => array(
		'fe_admin_fieldList' => 'hidden, fe_group, title, parent_group, description',
	)
);


t3lib_extMgm::addPlugin(
	array(
		'LLL:EXT:tt_address/locallang_tca.xml:pi_tt_address',
		$_EXTKEY.'_pi1'
	)
);
t3lib_extMgm::allowTableOnStandardPages('tt_address');
t3lib_extMgm::addToInsertRecords('tt_address');

t3lib_extMgm::addLLrefForTCAdescr('tt_address','EXT:tt_address/locallang_csh_ttaddress.xml');


// add flexform to pi1
t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] = 'pi_flexform';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages,recursive';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY .'_pi1', 'FILE:EXT:tt_address/pi1/flexform.xml');

t3lib_extMgm::addStaticFile($_EXTKEY, 'static/pi1/', 'Addresses');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/old/', 'Addresses (!!!old, only use if you need to!!!)');

if (TYPO3_MODE=='BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_ttaddress_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_ttaddress_pi1_wizicon.php';

			// classes for displaying the group tree and manipulating flexforms
	include_once(t3lib_extMgm::extPath($_EXTKEY).'class.tx_ttaddress_tcefunc_selecttreeview.php');
	include_once(t3lib_extMgm::extPath($_EXTKEY).'class.tx_ttaddress_treeview.php');
	include_once(t3lib_extMgm::extPath($_EXTKEY).'class.tx_ttaddress_addfilestosel.php');
	include_once(t3lib_extMgm::extPath($_EXTKEY).'class.tx_ttaddress_addfieldstosel.php');

}




###########################
## EXTENSION: direct_mail
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/direct_mail/ext_tables.php
###########################

$_EXTKEY = 'direct_mail';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


/**
 *
 * @package TYPO3
 * @subpackage tx_directmail
 * @version $Id: ext_tables.php 39718 2010-10-31 14:08:20Z ivankartolo $
 */

if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addStaticFile($_EXTKEY,'static/boundaries/','Direct Mail Content Boundaries');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/plaintext/', 'Direct Mail Plain text');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/tt_news_plaintext/', 'Direct Mail News Plain text');

	// Category field disabled by default in backend forms.
t3lib_extMgm::addPageTSConfig('TCEFORM.tt_content.module_sys_dmail_category.disabled = 1
TCEFORM.tt_address.module_sys_dmail_category.disabled = 1
TCEFORM.fe_users.module_sys_dmail_category.disabled = 1
TCEFORM.sys_dmail_group.select_categories.disabled = 1');

require_once(t3lib_extMgm::extPath($_EXTKEY).'/res/scripts/class.tx_directmail_select_categories.php');

/**
 * Setting up the direct mail module
 */

 	// pages modified
t3lib_div::loadTCA('pages');
$TCA['pages']['columns']['module']['config']['items'][] = Array('LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:pages.module.I.5', 'dmail');

 	// tt_content modified
t3lib_div::loadTCA('tt_content');
$tt_content_cols = Array(
	'module_sys_dmail_category' => Array(
		'label' => 'LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:sys_dmail_category.category',
		'exclude' => '1',
		'l10n_mode' => 'exclude',
		'config' => Array (
			'type' => 'select',
			'foreign_table' => 'sys_dmail_category',
			'foreign_table_where' => 'AND sys_dmail_category.l18n_parent=0 AND sys_dmail_category.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY sys_dmail_category.uid',
			'itemsProcFunc' => 'tx_directmail_select_categories->get_localized_categories',
			'itemsProcFunc_config' => array (
				'table' => 'sys_dmail_category',
				'indexField' => 'uid',
			),
			'size' => 5,
			'minitems' => 0,
			'maxitems' => 60,
			'renderMode' => 'checkbox',
			'MM' => 'sys_dmail_ttcontent_category_mm',
		)
	),
);
t3lib_extMgm::addTCAcolumns('tt_content',$tt_content_cols);
t3lib_extMgm::addToAllTCATypes('tt_content','module_sys_dmail_category;;;;1-1-1');

	// tt_address modified
$tempCols = Array(
	'module_sys_dmail_category' => Array(
		'label' => 'LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:module_sys_dmail_group.category',
		'exclude' => '1',
		'config' => Array (
			'type' => 'select',
			'foreign_table' => 'sys_dmail_category',
			'foreign_table_where' => 'AND sys_dmail_category.l18n_parent=0 AND sys_dmail_category.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY sys_dmail_category.uid',
			'itemsProcFunc' => 'tx_directmail_select_categories->get_localized_categories',
			'itemsProcFunc_config' => array (
				'table' => 'sys_dmail_category',
				'indexField' => 'uid',
			),
			'size' => 5,
			'minitems' => 0,
			'maxitems' => 60,
			'renderMode' => 'checkbox',
			'MM' => 'sys_dmail_ttaddress_category_mm',
		)
	),
	'module_sys_dmail_html' => Array(
		'label'=>'LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:module_sys_dmail_group.htmlemail',
		'exclude' => '1',
		'config'=>Array(
			'type'=>'check'
			)
		)
	);

t3lib_div::loadTCA('tt_address');
t3lib_extMgm::addTCAcolumns('tt_address',$tempCols);
t3lib_extMgm::addToAllTCATypes('tt_address','--div--;Direct mail,module_sys_dmail_category;;;;1-1-1,module_sys_dmail_html');
$TCA['tt_address']['feInterface']['fe_admin_fieldList'].=',module_sys_dmail_category,module_sys_dmail_html';

	// fe_users modified
$tempCols = Array(
	'module_sys_dmail_newsletter' => Array(
		'label'=>'LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:module_sys_dmail_group.newsletter',
		'exclude' => '1',
		'config'=>Array(
			'type'=>'check'
			)
		),
	'module_sys_dmail_category' => Array(
		'label' => 'LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:module_sys_dmail_group.category',
		'exclude' => '1',
		'config' => Array (
			'type' => 'select',
			'foreign_table' => 'sys_dmail_category',
			'foreign_table_where' => 'AND sys_dmail_category.l18n_parent=0 AND sys_dmail_category.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY sys_dmail_category.uid',
			'itemsProcFunc' => 'tx_directmail_select_categories->get_localized_categories',
			'itemsProcFunc_config' => array (
				'table' => 'sys_dmail_category',
				'indexField' => 'uid',
			),
			'size' => 5,
			'minitems' => 0,
			'maxitems' => 60,
			'renderMode' => 'checkbox',
			'MM' => 'sys_dmail_feuser_category_mm',
		)
	),
	'module_sys_dmail_html' => Array(
		'label'=>'LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:module_sys_dmail_group.htmlemail',
		'exclude' => '1',
		'config'=>Array(
			'type'=>'check'
		)
	)
);

t3lib_div::loadTCA('fe_users');
t3lib_extMgm::addTCAcolumns('fe_users',$tempCols);
$TCA['fe_users']['feInterface']['fe_admin_fieldList'].=',module_sys_dmail_newsletter,module_sys_dmail_category,module_sys_dmail_html';
t3lib_extMgm::addToAllTCATypes('fe_users','--div--;Direct mail,module_sys_dmail_newsletter;;;;1-1-1,module_sys_dmail_category,module_sys_dmail_html');

// ******************************************************************
// sys_dmail
// ******************************************************************
$TCA['sys_dmail'] = Array (
	'ctrl' => Array (
		'label' => 'subject',
		'default_sortby' => 'ORDER BY tstamp DESC',
		'tstamp' => 'tstamp',
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'title' => 'LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:sys_dmail',
		'delete' => 'deleted',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/mail.gif',
		'type' => 'type',
		'useColumnsForDefaultValues' => 'from_email,from_name,replyto_email,replyto_name,organisation,priority,encoding,charset,sendOptions,type',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
	)
);

// ******************************************************************
// Categories
// ******************************************************************
$TCA['sys_dmail_category'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:sys_dmail_category',
		'label' => 'category',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/icon_tx_directmail_category.gif',
		)
);

// ******************************************************************
// sys_dmail_group
// ******************************************************************
$TCA['sys_dmail_group'] = Array (
	'ctrl' => Array (
		'label' => 'title',
		'default_sortby' => 'ORDER BY title',
		'tstamp' => 'tstamp',
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'title' => 'LLL:EXT:'.$_EXTKEY.'/locallang_tca.xml:sys_dmail_group',
		'delete' => 'deleted',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/mailgroup.gif',
		'type' => 'type',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
	)
);

t3lib_extMgm::addLLrefForTCAdescr('sys_dmail','EXT:'.$_EXTKEY.'/locallang/locallang_csh_sysdmail.xml');
t3lib_extMgm::addLLrefForTCAdescr('sys_dmail_group','EXT:'.$_EXTKEY.'/locallang/locallang_csh_sysdmailg.xml');
t3lib_extMgm::addLLrefForTCAdescr('sys_dmail_category','EXT:'.$_EXTKEY.'/locallang/locallang_csh_sysdmailcat.xml');
t3lib_extMgm::addLLrefForTCAdescr('_MOD_txdirectmailM1_txdirectmailM2','EXT:'.$_EXTKEY.'/locallang/locallang_csh_txdirectmailM2.xml');
t3lib_extMgm::addLLrefForTCAdescr('_MOD_txdirectmailM1_txdirectmailM3','EXT:'.$_EXTKEY.'/locallang/locallang_csh_txdirectmailM3.xml');
t3lib_extMgm::addLLrefForTCAdescr('_MOD_txdirectmailM1_txdirectmailM4','EXT:'.$_EXTKEY.'/locallang/locallang_csh_txdirectmailM4.xml');
t3lib_extMgm::addLLrefForTCAdescr('_MOD_txdirectmailM1_txdirectmailM5','EXT:'.$_EXTKEY.'/locallang/locallang_csh_txdirectmailM5.xml');
t3lib_extMgm::addLLrefForTCAdescr('_MOD_txdirectmailM1_txdirectmailM6','EXT:'.$_EXTKEY.'/locallang/locallang_csh_txdirectmailM6.xml');
//old
t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_txdirectmailM','EXT:'.$_EXTKEY.'/locallang/locallang_csh_web_txdirectmail.xml');


if (TYPO3_MODE=='BE')   {
	$extPath = t3lib_extMgm::extPath($_EXTKEY);
	
		// add module before 'Help'
	if (!isset($TBE_MODULES['txdirectmailM1']))	{
		$temp_TBE_MODULES = array();
		foreach($TBE_MODULES as $key => $val) {
			if ($key == 'help') {
				$temp_TBE_MODULES['txdirectmailM1'] = '';
				$temp_TBE_MODULES[$key] = $val;
			} else {
				$temp_TBE_MODULES[$key] = $val;
			}
		}

		$TBE_MODULES = $temp_TBE_MODULES;
	}
	t3lib_extMgm::addModule('txdirectmailM1', '', '', $extPath.'mod1/');
	t3lib_extMgm::addModule('txdirectmailM1', 'txdirectmailM2', 'bottom', $extPath.'mod2/');
	t3lib_extMgm::addModule('txdirectmailM1', 'txdirectmailM3', 'bottom', $extPath.'mod3/');
	t3lib_extMgm::addModule('txdirectmailM1', 'txdirectmailM4', 'bottom', $extPath.'mod4/');
	t3lib_extMgm::addModule('txdirectmailM1', 'txdirectmailM5', 'bottom', $extPath.'mod5/');
	t3lib_extMgm::addModule('txdirectmailM1', 'txdirectmailM6', 'bottom', $extPath.'mod6/');
	
	//t3lib_extMgm::addModule('web','txdirectmailM2','',t3lib_extMgm::extPath($_EXTKEY).'mod1/');
	
	//use SpriteManager if TYPO3 4.4.0
	if (t3lib_div::compat_version("4.4")) {
		t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-dmail', '../typo3conf/ext/direct_mail/res/gfx/ext_icon_dmail_folder.gif');
	} else {
		$ICON_TYPES['dmail'] = array('icon' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/ext_icon_dmail_folder.gif');
	}
}


###########################
## EXTENSION: sr_feuser_register
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/sr_feuser_register/ext_tables.php
###########################

$_EXTKEY = 'sr_feuser_register';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addStaticFile(SR_FEUSER_REGISTER_EXTkey, 'static/css_styled/', 'FE User Registration CSS-styled');
// t3lib_extMgm::addStaticFile(SR_FEUSER_REGISTER_EXTkey, 'static/old_style/', 'FE User Registration Old Style');

t3lib_div::loadTCA('tt_content');

if (
	!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_FEUSER_REGISTER_EXTkey]['useFlexforms']) ||
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_FEUSER_REGISTER_EXTkey]['useFlexforms'] == 1
) {
	$TCA['tt_content']['types']['list']['subtypes_excludelist'][SR_FEUSER_REGISTER_EXTkey.'_pi1']='layout,select_key';
	$TCA['tt_content']['types']['list']['subtypes_addlist'][SR_FEUSER_REGISTER_EXTkey.'_pi1']='pi_flexform';
	t3lib_extMgm::addPiFlexFormValue(SR_FEUSER_REGISTER_EXTkey.'_pi1', 'FILE:EXT:'.SR_FEUSER_REGISTER_EXTkey.'/pi1/flexform_ds_pi1.xml');
} else {
	$TCA['tt_content']['types']['list']['subtypes_excludelist'][SR_FEUSER_REGISTER_EXTkey.'_pi1'] = 'layout';
}

t3lib_extMgm::addPlugin(Array('LLL:EXT:'.SR_FEUSER_REGISTER_EXTkey.'/locallang_db.xml:tt_content.list_type', SR_FEUSER_REGISTER_EXTkey.'_pi1'),'list_type');

/**
 * Setting up country, country subdivision, preferred language, first_name and last_name in fe_users table
 * Adjusting some maximum lengths to conform to specifications of payment gateways (ref.: Authorize.net)
 */
t3lib_div::loadTCA('fe_users');

$TCA['fe_users']['columns']['username']['config']['eval'] = 'nospace,uniqueInPid,required';

if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_FEUSER_REGISTER_EXTkey]['useMd5Password'] && strstr($TCA['fe_users']['columns']['password']['config']['eval'], 'md5')) {
	$TCA['fe_users']['columns']['password']['config']['eval'] = 'nospace,required,md5,password';
} else {
	$TCA['fe_users']['columns']['password']['config']['eval'] = 'nospace,required';
}

$TCA['fe_users']['columns']['name']['config']['max'] = '100';
$TCA['fe_users']['columns']['company']['config']['max'] = '50';
$TCA['fe_users']['columns']['city']['config']['max'] = '40';
$TCA['fe_users']['columns']['country']['config']['max'] = '60';
$TCA['fe_users']['columns']['zip']['config']['size'] = '15';
$TCA['fe_users']['columns']['zip']['config']['max'] = '20';
$TCA['fe_users']['columns']['email']['config']['max'] = '255';
$TCA['fe_users']['columns']['telephone']['config']['max'] = '25';
$TCA['fe_users']['columns']['fax']['config']['max'] = '25';


$TCA['fe_users']['columns']['image']['config']['uploadfolder'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_FEUSER_REGISTER_EXTkey]['uploadfolder'];
$TCA['fe_users']['columns']['image']['config']['max_size'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_FEUSER_REGISTER_EXTkey]['imageMaxSize'];
$TCA['fe_users']['columns']['image']['config']['allowed'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_FEUSER_REGISTER_EXTkey]['imageTypes'];

t3lib_extMgm::addTCAcolumns('fe_users', Array(
	'cnum' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.cnum',
		'config' => Array (
			'type' => 'input',
			'size' => '20',
			'max' => '50',
			'eval' => 'trim',
			'default' => ''
		)
	),
	'static_info_country' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.static_info_country',
		'config' => Array (
			'type' => 'input',
			'size' => '5',
			'max' => '3',
			'eval' => '',
			'default' => ''
		)
	),
	'zone' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.zone',
		'config' => Array (
			'type' => 'input',
			'size' => '20',
			'max' => '40',
			'eval' => 'trim',
			'default' => ''
		)
	),
	'language' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.language',
		'config' => Array (
			'type' => 'input',
			'size' => '4',
			'max' => '2',
			'eval' => '',
			'default' => ''
		)
	),
	'first_name' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.first_name',
		'config' => Array (
			'type' => 'input',
			'size' => '20',
			'max' => '50',
			'eval' => 'trim',
			'default' => ''
		)
	),
	'last_name' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.last_name',
		'config' => Array (
			'type' => 'input',
			'size' => '20',
			'max' => '50',
			'eval' => 'trim',
			'default' => ''
		)
	),
	'date_of_birth' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.date_of_birth',
		'config' => Array (
			'type' => 'input',
			'size' => '10',
			'max' => '20',
			'eval' => 'date',
			'checkbox' => '0',
			'default' => ''
		)
	),
	'gender' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.gender',
		'config' => Array (
			'type' => 'radio',
			'items' => Array (
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.gender.I.0', '0'),
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.gender.I.1', '1')
			),
		)
	),
	'status' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.status',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.status.I.0', '0'),
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.status.I.1', '1'),
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.status.I.2', '2'),
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.status.I.3', '3'),
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.status.I.4', '4'),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'comments' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.comments',
		'config' => Array (
			'type' => 'text',
			'rows' => '5',
			'cols' => '48'
		)
	),
	'by_invitation' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.by_invitation',
		'config' => Array (
			'type' => 'check',
			'default' => '0'
		)
	),
/*	'confirmation_emails' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.confirmation_emails',
		'config' => Array (
			'type' => 'check',
			'items' => Array (
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.confirmation_emails.I.0', '0'),
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.confirmation_emails.I.1', '1'),
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.confirmation_emails.I.2', '2'),
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.confirmation_emails.I.3', '3'),
				Array('LLL:EXT:sr_feuser_register/locallang_db.xml:fe_users.confirmation_emails.I.4', '4'),
			),
			'cols' => '3',
		)
	),*/
));

$TCA['fe_users']['interface']['showRecordFieldList'] = str_replace(',country', ',zone,static_info_country,country,language', $TCA['fe_users']['interface']['showRecordFieldList']);
$TCA['fe_users']['interface']['showRecordFieldList'] = str_replace('title,', 'gender,first_name,last_name,status,date_of_birth,title,', $TCA['fe_users']['interface']['showRecordFieldList']);

$TCA['fe_users']['feInterface']['fe_admin_fieldList'] = str_replace(',country', ',zone,static_info_country,country,language,comments', $TCA['fe_users']['feInterface']['fe_admin_fieldList']);
$TCA['fe_users']['feInterface']['fe_admin_fieldList'] = str_replace(',title', ',gender,first_name,last_name,cnum,status,title', $TCA['fe_users']['feInterface']['fe_admin_fieldList']);
$TCA['fe_users']['feInterface']['fe_admin_fieldList'] .= ',image,disable,date_of_birth,by_invitation';

$TCA['fe_users']['types']['0']['showitem'] = str_replace(', country', ', zone, static_info_country, country,language', $TCA['fe_users']['types']['0']['showitem']);

$TCA['fe_users']['types']['0']['showitem'] = str_replace(', address', ', status, date_of_birth, address', $TCA['fe_users']['types']['0']['showitem']);

$TCA['fe_users']['types']['0']['showitem'] = str_replace(', www', ', www, comments, by_invitation', $TCA['fe_users']['types']['0']['showitem']);

$lastPalette = 0;
for ($i=0; $i<10; $i++)	{
	if (isset($TCA['fe_users']['palettes'][$i]) && is_array($TCA['fe_users']['palettes'][$i]))	{
		$lastPalette = $i;
	}
}

$TCA['fe_users']['palettes'][$lastPalette+1]['showitem'] = 'gender,first_name';
$TCA['fe_users']['types']['0']['showitem'] = str_replace(', name', ',cnum,last_name;;'.($lastPalette+1).';;1-1-1, name', $TCA['fe_users']['types']['0']['showitem']);

$TCA['fe_users']['ctrl']['thumbnail'] = 'image';

	// fe_users modified
if (!t3lib_extMgm::isLoaded('direct_mail')) {
	$tempCols = Array(
		'module_sys_dmail_html' => Array(
			'label'=>'LLL:EXT:'.$_EXTKEY.'/locallang_db.xml:fe_users.module_sys_dmail_html',
			'exclude' => '1',
			'config'=>Array(
				'type'=>'check'
				)
			)
	);
	t3lib_extMgm::addTCAcolumns('fe_users',$tempCols);
	$TCA['fe_users']['feInterface']['fe_admin_fieldList'].=',module_sys_dmail_html';
	t3lib_extMgm::addToAllTCATypes('fe_users','--div--;Direct mail,module_sys_dmail_html;;;;1-1-1');
}

$TCA['fe_groups_language_overlay'] = Array (
	'ctrl' => Array (
 	'title' => 'LLL:EXT:' . SR_FEUSER_REGISTER_EXTkey . '/locallang_db.xml:fe_groups_language_overlay',
		'label' => 'title',
		'default_sortby' => 'ORDER BY fe_groups_uid',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden'
		),
 		'dynamicConfigFile' => t3lib_extMgm::extPath(SR_FEUSER_REGISTER_EXTkey).'tca.php',
		'iconfile' => 'gfx/i/fe_groups.gif',
		)
);
t3lib_extMgm::allowTableOnStandardPages('fe_groups_language_overlay');
t3lib_extMgm::addToInsertRecords('fe_groups_language_overlay');


###########################
## EXTENSION: sr_email_subscribe
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/sr_email_subscribe/ext_tables.php
###########################

$_EXTKEY = 'sr_email_subscribe';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];



if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addStaticFile(SR_EMAIL_SUBSCRIBE_EXTkey, 'static/css_styled/', 'Email Address Subscription CSS-styled');
t3lib_extMgm::addStaticFile(SR_EMAIL_SUBSCRIBE_EXTkey, 'static/old_style/', 'Email Address Subscription Old Style');

t3lib_div::loadTCA('tt_content');

if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_EMAIL_SUBSCRIBE_EXTkey]['useFlexforms']=='1') {
	$TCA['tt_content']['types']['list']['subtypes_excludelist'][SR_EMAIL_SUBSCRIBE_EXTkey.'_pi1']='layout,select_key';
	$TCA['tt_content']['types']['list']['subtypes_addlist'][SR_EMAIL_SUBSCRIBE_EXTkey.'_pi1']='pi_flexform';
	t3lib_extMgm::addPiFlexFormValue(SR_EMAIL_SUBSCRIBE_EXTkey.'_pi1', 'FILE:EXT:'.SR_EMAIL_SUBSCRIBE_EXTkey.'/pi1/flexform_ds_pi1.xml');
} else {
	$TCA['tt_content']['types']['list']['subtypes_excludelist'][SR_EMAIL_SUBSCRIBE_EXTkey.'_pi1'] = 'layout';
}
t3lib_extMgm::addPlugin(Array('LLL:EXT:'.SR_EMAIL_SUBSCRIBE_EXTkey.'/locallang_db.xml:tt_content.email_subscribe', SR_EMAIL_SUBSCRIBE_EXTkey.'_pi1'),'list_type');

$addressTable = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_EMAIL_SUBSCRIBE_EXTkey]['addressTable'];

if ($addressTable == 'tt_address')	{

	/**
	* Setting up country, country subdivision, preferred language, first_name and last_name in tt_address table
	* Adjusting some maximum lengths to the values as corresponding fields in fe_users as set by extension sr_feuser_register
	*/


	t3lib_div::loadTCA('tt_address');

	if (
		$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_EMAIL_SUBSCRIBE_EXTkey]['useImageFolder'] &&
		$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_EMAIL_SUBSCRIBE_EXTkey]['imageFolder'] != '')	{
		$TCA['tt_address']['columns']['image']['config']['uploadfolder'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_EMAIL_SUBSCRIBE_EXTkey]['imageFolder'];
	}


	t3lib_extMgm::addTCAcolumns('tt_address', Array(
		'static_info_country' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:sr_email_subscribe/locallang_db.xml:tt_address.static_info_country',
			'config' => Array (
				'type' => 'input',
				'size' => '5',
				'max' => '3',
				'eval' => '',
				'default' => ''
			)
		),
		'zone' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:sr_email_subscribe/locallang_db.xml:tt_address.zone',
			'config' => Array (
				'type' => 'input',
				'size' => '20',
				'max' => '40',
				'eval' => 'trim',
				'default' => ''
			)
		),
		'language' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:sr_email_subscribe/locallang_db.xml:tt_address.language',
			'config' => Array (
				'type' => 'input',
				'size' => '4',
				'max' => '2',
				'eval' => '',
				'default' => ''
			)
		),
		'date_of_birth' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:sr_email_subscribe/locallang_db.xml:tt_address.date_of_birth',
			'config' => Array (
				'type' => 'input',
				"size" => "10",
				"max" => "20",
				"eval" => "date",
				"checkbox" => "0",
				"default" => ''
			)
		),
		'comments' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:sr_email_subscribe/locallang_db.xml:tt_address.comments',
			'config' => Array (
				'type' => 'text',
				'rows' => '5',
				'cols' => '48'
			)
		),
	));

	$TCA['tt_address']['interface']['showRecordFieldList'] = str_replace('country', 'country,zone,static_info_country,language', $TCA['tt_address']['interface']['showRecordFieldList']);

	$TCA['tt_address']['interface']['showRecordFieldList'] = str_replace('title', 'date_of_birth,title', $TCA['tt_address']['interface']['showRecordFieldList']);
	$TCA['tt_address']['interface']['showRecordFieldList'] = str_replace('www', 'www,comments', $TCA['tt_address']['interface']['showRecordFieldList']);

	$TCA['tt_address']['feInterface']['fe_admin_fieldList'] = str_replace('country', 'zone,static_info_country,country,language,comments', $TCA['tt_address']['feInterface']['fe_admin_fieldList']);
	$TCA['tt_address']['feInterface']['fe_admin_fieldList'] .= ',date_of_birth';

	if (strstr($TCA['tt_address']['feInterface']['fe_admin_fieldList'], 'image') === FALSE)	{
		$TCA['tt_address']['feInterface']['fe_admin_fieldList'] .= ',image';
	}

	t3lib_extMgm::addToAllTCAtypes('tt_address', 'comments');
	$TCA['tt_address']['palettes']['3']['showitem'] = str_replace('country', 'zone,static_info_country,country,language', $TCA['tt_address']['palettes']['3']['showitem']);

		// tt_address modified
	if (!t3lib_extMgm::isLoaded('direct_mail')) {
		$tempCols = Array(
			'module_sys_dmail_html' => Array(
				'label'=>'LLL:EXT:'.$_EXTKEY.'/locallang_db.xml:tt_address.module_sys_dmail_html',
				'exclude' => '1',
				'config'=>Array(
					'type'=>'check'
					)
				)
		);
		t3lib_extMgm::addTCAcolumns('tt_address',$tempCols);
		t3lib_extMgm::addToAllTCATypes('tt_address','--div--;Direct mail,module_sys_dmail_html;;;;1-1-1');
		$TCA['tt_address']['feInterface']['fe_admin_fieldList'].=',module_sys_dmail_html';
	}
}


###########################
## EXTENSION: kickstarter
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/kickstarter/ext_tables.php
###########################

$_EXTKEY = 'kickstarter';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

if (TYPO3_MODE=="BE")	{
	t3lib_extMgm::insertModuleFunction(
		"tools_em",
		"tx_kickstarter_modfunc1",
		t3lib_extMgm::extPath($_EXTKEY)."modfunc1/class.tx_kickstarter_modfunc1.php",
		"LLL:EXT:kickstarter/locallang_db.xml:moduleFunction.tx_kickstarter_modfunc1"
	);
	t3lib_extMgm::insertModuleFunction(
		"tools_em",
		"tx_kickstarter_modfunc2",
		t3lib_extMgm::extPath($_EXTKEY)."modfunc1/class.tx_kickstarter_modfunc1.php",
		"LLL:EXT:kickstarter/locallang_db.xml:moduleFunction.tx_kickstarter_modfunc2",
		'singleDetails'
	);
}

###########################
## EXTENSION: rtehtmlarea
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/rtehtmlarea/ext_tables.php
###########################

$_EXTKEY = 'rtehtmlarea';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

		// Add static template for Click-enlarge rendering
	t3lib_extMgm::addStaticFile($_EXTKEY,'static/clickenlarge/','Clickenlarge Rendering');

		// Add acronyms table
	$TCA['tx_rtehtmlarea_acronym'] = Array (
		'ctrl' => Array (
			'title' => 'LLL:EXT:rtehtmlarea/locallang_db.xml:tx_rtehtmlarea_acronym',
			'label' => 'term',
			'default_sortby' => 'ORDER BY term',
			'sortby' => 'sorting',
			'delete' => 'deleted',
			'enablecolumns' => Array (
				'disabled' => 'hidden',
				'starttime' => 'starttime',
				'endtime' => 'endtime',
			),
			'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
			'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'extensions/Acronym/skin/images/acronym.gif',
		),
	);
	t3lib_extMgm::allowTableOnStandardPages('tx_rtehtmlarea_acronym');
	t3lib_extMgm::addLLrefForTCAdescr('tx_rtehtmlarea_acronym','EXT:' . $_EXTKEY . '/locallang_csh_abbreviation.xml');

		// Add contextual help files
	$htmlAreaRteContextHelpFiles = array(
		'General' => 'EXT:' . $_EXTKEY . '/locallang_csh.xml',
		'Acronym' => 'EXT:' . $_EXTKEY . '/extensions/Acronym/locallang_csh.xml',
		'EditElement' => 'EXT:' . $_EXTKEY . '/extensions/EditElement/locallang_csh.xml',
		'Language' => 'EXT:' . $_EXTKEY . '/extensions/Language/locallang_csh.xml',
		'PlainText' => 'EXT:' . $_EXTKEY . '/extensions/PlainText/locallang_csh.xml',
		'RemoveFormat' => 'EXT:' . $_EXTKEY . '/extensions/RemoveFormat/locallang_csh.xml',
	);
	foreach ($htmlAreaRteContextHelpFiles as $key => $file) {
		t3lib_extMgm::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_' . $key, $file);
	}
	unset($htmlAreaRteContextHelpFiles);

		// Extend TYPO3 User Settings Configuration
if (TYPO3_MODE === 'BE' && t3lib_extMgm::isLoaded('setup') && is_array($GLOBALS['TYPO3_USER_SETTINGS'])) {
	$GLOBALS['TYPO3_USER_SETTINGS']['columns'] = array_merge(
		$GLOBALS['TYPO3_USER_SETTINGS']['columns'],
		array(
			'rteWidth' => array(
				'type' => 'text',
				'label' => 'LLL:EXT:rtehtmlarea/locallang.xml:rteWidth',
				'csh' => 'xEXT_rtehtmlarea_General:rteWidth',
			),
			'rteHeight' => array(
				'type' => 'text',
				'label' => 'LLL:EXT:rtehtmlarea/locallang.xml:rteHeight',
				'csh' => 'xEXT_rtehtmlarea_General:rteHeight',
			),
			'rteResize' => array(
				'type' => 'check',
				'label' => 'LLL:EXT:rtehtmlarea/locallang.xml:rteResize',
				'csh' => 'xEXT_rtehtmlarea_General:rteResize',
			),
			'rteMaxHeight' => array(
				'type' => 'text',
				'label' => 'LLL:EXT:rtehtmlarea/locallang.xml:rteMaxHeight',
				'csh' => 'xEXT_rtehtmlarea_General:rteMaxHeight',
			),
			'rteCleanPasteBehaviour' => array(
				'type' => 'select',
				'label' => 'LLL:EXT:rtehtmlarea/htmlarea/plugins/PlainText/locallang.xml:rteCleanPasteBehaviour',
				'items' => array(
					'plainText' => 'LLL:EXT:rtehtmlarea/htmlarea/plugins/PlainText/locallang.xml:plainText',
					'pasteStructure' => 'LLL:EXT:rtehtmlarea/htmlarea/plugins/PlainText/locallang.xml:pasteStructure',
					'pasteFormat' => 'LLL:EXT:rtehtmlarea/htmlarea/plugins/PlainText/locallang.xml:pasteFormat',
				),
				'csh' => 'xEXT_rtehtmlarea_PlainText:behaviour',
			),
		)
	);
	$GLOBALS['TYPO3_USER_SETTINGS']['showitem'] .= ',--div--;LLL:EXT:rtehtmlarea/locallang.xml:rteSettings,rteWidth,rteHeight,rteResize,rteMaxHeight,rteCleanPasteBehaviour';

	$icons = array(
		'clearcachemenu' => t3lib_extMgm::extRelPath('rtehtmlarea') . 'hooks/clearrtecache/clearrtecache.png'
	);
	t3lib_SpriteManager::addSingleIcons($icons, 'rtehtmlarea');
}

###########################
## EXTENSION: fluid
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/fluid/ext_tables.php
###########################

$_EXTKEY = 'fluid';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) die ('Access denied.');

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Fluid: Default Ajax Configuration');

###########################
## EXTENSION: workspaces
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/workspaces/ext_tables.php
###########################

$_EXTKEY = 'workspaces';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
	// avoid that this block is loaded in the frontend or within the upgrade-wizards
if (TYPO3_MODE == 'BE' && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {
	/**
	* Registers a Backend Module
	*/
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'web',	// Make module a submodule of 'web'
		'workspaces',	// Submodule key
		'before:info', // Position
		array(
				// An array holding the controller-action-combinations that are accessible
			'Review'		=> 'index,fullIndex,singleIndex',
			'Preview'		=> 'index,newPage'
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:workspaces/Resources/Public/Images/moduleicon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
			'navigationComponentId' => 'typo3-pagetree',
		)
	);

		// register ExtDirect
	t3lib_extMgm::registerExtDirectComponent(
		'TYPO3.Workspaces.ExtDirect',
		t3lib_extMgm::extPath($_EXTKEY) . 'Classes/ExtDirect/Server.php:tx_Workspaces_ExtDirect_Server',
		'web_WorkspacesWorkspaces',
		'user,group'
	);

	t3lib_extMgm::registerExtDirectComponent(
		'TYPO3.Workspaces.ExtDirectActions',
		t3lib_extMgm::extPath($_EXTKEY) . 'Classes/ExtDirect/ActionHandler.php:tx_Workspaces_ExtDirect_ActionHandler',
		'web_WorkspacesWorkspaces',
		'user,group'
	);

	t3lib_extMgm::registerExtDirectComponent(
		'TYPO3.Workspaces.ExtDirectMassActions',
		t3lib_extMgm::extPath($_EXTKEY) . 'Classes/ExtDirect/MassActionHandler.php:tx_Workspaces_ExtDirect_MassActionHandler',
		'web_WorkspacesWorkspaces',
		'user,group'
	);

	t3lib_extMgm::registerExtDirectComponent(
		'TYPO3.Ajax.ExtDirect.ToolbarMenu',
		t3lib_extMgm::extPath($_EXTKEY) . 'Classes/ExtDirect/ToolbarMenu.php:tx_Workspaces_ExtDirect_ToolbarMenu'
	);

		// register the reports statusprovider
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['configuration'][] = 'Tx_Workspaces_Reports_StatusProvider';


}

/**
 * Table "sys_workspace":
 */
$TCA['sys_workspace'] = array(
	'ctrl' => array(
		'label' => 'title',
		'tstamp' => 'tstamp',
		'title' => 'LLL:EXT:lang/locallang_tca.xml:sys_workspace',
		'adminOnly' => 1,
		'rootLevel' => 1,
		'delete' => 'deleted',
		'iconfile' => 'sys_workspace.png',
		'typeicon_classes' => array(
			'default' => 'mimetypes-x-sys_workspace'
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'versioningWS_alwaysAllowLiveEdit' => true,
		'dividers2tabs' => true
	)
);

/**
 * Table "sys_workspace_stage":
 * Defines single custom stages which are related to sys_workspace table to create complex working processes
 * This is only the 'header' part (ctrl). The full configuration is found in t3lib/stddb/tbl_be.php
 */
$TCA['sys_workspace_stage'] = array(
	'ctrl' => array(
		'label' => 'title',
		'tstamp' => 'tstamp',
		'sortby' => 'sorting',
		'title' => 'LLL:EXT:workspaces/Resources/Private/Language/locallang_db.xml:sys_workspace_stage',
		'adminOnly' => 1,
		'rootLevel' => 1,
		'hideTable' => TRUE,
		'delete' => 'deleted',
		'iconfile' => 'sys_workspace.png',
		'typeicon_classes' => array(
			'default' => 'mimetypes-x-sys_workspace'
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'versioningWS_alwaysAllowLiveEdit' => true,
	)
);
	// todo move icons to Core sprite or keep them here and remove the todo note ;)
$icons = array(
	'sendtonextstage' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Images/version-workspace-sendtonextstage.png',
	'sendtoprevstage' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Images/version-workspace-sendtoprevstage.png',
	'generatepreviewlink' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Images/generate-ws-preview-link.png',
);
t3lib_SpriteManager::addSingleIcons($icons, $_EXTKEY);
t3lib_extMgm::addLLrefForTCAdescr('sys_workspace_stage','EXT:workspaces/Resources/Private/Language/locallang_csh_sysws_stage.xml');



###########################
## EXTENSION: tscobj
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/tscobj/ext_tables.php
###########################

$_EXTKEY = 'tscobj';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


	if (!defined ('TYPO3_MODE')) {
		die ('Access denied.');
	}
	
	// Load content TCA
	t3lib_div::loadTCA('tt_content');
	
	// Plugin options
	$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages,recursive';
	
	// Add flexform fields to plugin options
	$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform';
	
	// Add flexform DataStructures
	t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:' . $_EXTKEY . '/flexform_ds_pi1.xml');
	
	// Add plugins
	t3lib_extMgm::addPlugin(Array('LLL:EXT:tscobj/locallang_db.php:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');
	
	// Wizard icons
	if (TYPO3_MODE=='BE') {
		$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_tscobj_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_tscobj_pi1_wizicon.php';
	}

###########################
## EXTENSION: linkvalidator
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3/sysext/linkvalidator/ext_tables.php
###########################

$_EXTKEY = 'linkvalidator';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {
		// add module
	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_linkvalidator_ModFuncReport',
		t3lib_extMgm::extPath('linkvalidator') . 'modfuncreport/class.tx_linkvalidator_modfuncreport.php',
		'LLL:EXT:linkvalidator/locallang.xml:mod_linkvalidator'
	);
}

	// Initialize Context Sensitive Help (CSH)
t3lib_extMgm::addLLrefForTCAdescr('linkvalidator', 'EXT:linkvalidator/modfuncreport/locallang_csh.xml');


###########################
## EXTENSION: templavoila_pagemod
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/templavoila_pagemod/ext_tables.php
###########################

$_EXTKEY = 'templavoila_pagemod';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=="BE")	{

  // unserializing the configuration so we can use it here:
  $_EXTCONF = unserialize($_EXTCONF);

  // fake conf, to make original templavoila page module shy
  $GLOBALS['TBE_MODULES']['_PATHS']['web_txtemplavoilaM1'] = t3lib_extMgm::extPath('templavoila_pagemod').'templavoila_fake_conf/';    
  
  t3lib_extMgm::addModule("web","txtemplavoilapagemodM1","top",t3lib_extMgm::extPath($_EXTKEY)."mod1/");
}

###########################
## EXTENSION: aio_feedit
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/aio_feedit/ext_tables.php
###########################

$_EXTKEY = 'aio_feedit';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
t3lib_extMgm::addStaticFile($_EXTKEY,'static/aio_fe-edit/', 'aio FE-Edit');

###########################
## EXTENSION: tkcropthumbs
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/tkcropthumbs/ext_tables.php
###########################

$_EXTKEY = 'tkcropthumbs';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('tkcropthumbs_crop',t3lib_extMgm::extPath($_EXTKEY).'mod1/');
}

$tempColumns = array (
		'tx_tkcropthumbs_aspectratio' => array (
				'exclude' => 0,
				'label' => 'LLL:EXT:tkcropthumbs/locallang_db.xml:tt_content.tx_tkcropthumbs_aspectratio',
				'config' => array (
						'type' => 'select',
						'items' => array (
								array('-:-', ''),
								array('1:1', '1:1'),
								array('4:3', '4:3'),
								array('3:1', '3:1'),
								array('16:9', '16:9'),
						),
						'minitems'=>1,
						'maxitems'=>1,
				)
		)
);


t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content',$tempColumns,tx_tkcroptumbs);


$GLOBALS['TCA']['tt_content']['palettes']['image_settings']['showitem'] .= ', tx_tkcropthumbs_aspectratio';

###########################
## EXTENSION: aio_maximagewidthintext
## FILE:      /extendedbrain/wwwroot/physiotherapie-huber/typo3conf/ext/aio_maximagewidthintext/ext_tables.php
###########################

$_EXTKEY = 'aio_maximagewidthintext';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_aiomaximagewidthintext_maximagewidthintextratio' => array (		
		'exclude' => 1,		
		'label' => 'LLL:EXT:aio_maximagewidthintext/locallang_db.xml:tt_content.tx_aiomaximagewidthintext_maximagewidthintextratio',		
		'config' => array (
			'type' => 'check',
		)
	),
);


t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content',$tempColumns,1);

//add field to image settings (copied from tkcropthumbs extension)
$GLOBALS['TCA']['tt_content']['palettes']['image_settings']['showitem'] .= ', tx_aiomaximagewidthintext_maximagewidthintextratio';


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:aio_maximagewidthintext/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');
?>
