<?php
/**
 *
 * @package TYPO3
 * @subpackage tx_directmail
 * @version $Id: tca.php 34990 2010-06-28 12:23:27Z ivankartolo $
 */

if (!defined ('TYPO3_MODE'))     die ('Access denied.');

// ******************************************************************
// sys_dmail
// ******************************************************************
$TCA['sys_dmail'] = Array (
	'ctrl' => $TCA['sys_dmail']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'type,plainParams,HTMLParams,subject,from_name,from_email,replyto_name,replyto_email,return_path,organisation,attachment,priority,encoding,charset,sendOptions,includeMedia,flowedFormat,issent,renderedsize,use_domain,use_rdct,long_link_mode,authcode_fieldList'
	),
	'columns' => Array (
		'subject' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.subject',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '120',
				'eval' => 'trim,required'
			)
		),
		'page' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.page',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'pages',
				'size' => '1',
				'maxitems' => 1,
				'minitems' => 0
			)
		),
		'from_email' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.from_email',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '80',
				'eval' => 'trim,required'
			)
		),
		'from_name' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.from_name',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
				'max' => '80'
			)
		),
		'replyto_email' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.replyto_email',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
				'max' => '80'
			)
		),
		'replyto_name' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.replyto_name',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
				'max' => '80'
			)
		),
		'return_path' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.return_path',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
				'max' => '80'
			)
		),
		'organisation' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.organisation',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
				'max' => '80'
			)
		),
		'encoding' => Array (
			'label' =>  'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.transfer_encoding',
			'config' => Array(
				'type' => 'select',
				'items' => Array(
					Array('quoted-printable','quoted-printable'),
					Array('base64','base64'),
					Array('8bit','8bit'),
					),
				'default' => 'quoted-printable'
			)
		),
		'charset' => Array (
			'label' =>  'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.charset',
			'config' => Array(
				'type' => 'input',
				'size' => '15',
				'max' => '20',
				'eval' => 'trim',
				'default' => 'iso-8859-1'
			)
		),
		'priority' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.priority',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.priority.I.0', '5'),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.priority.I.1', '3'),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.priority.I.2', '1')
				),
				'default' => '3'
			)
		),
		'sendOptions' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.sendOptions',
			'config' => Array (
				'type' => 'check',
				'items' => Array (
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.sendOptions.I.0', ''),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.sendOptions.I.1', '')
				),
				'cols' => '2',
				'default' => '3'
			)
		),
		'includeMedia' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.includeMedia',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'flowedFormat' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.flowedFormat',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'HTMLParams' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.HTMLParams',
			'config' => Array (
				'type' => 'input',
				'size' => '15',
				'max' => '80',
				'eval' => 'trim',
				'default' => ''
			)
		),
		'plainParams' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.plainParams',
			'config' => Array (
				'type' => 'input',
				'size' => '15',
				'max' => '80',
				'eval' => 'trim',
				'default' => '&type=99'
			)
		),
		'issent' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.issent',
			'exclude' => '1',
			'config' => Array (
				'type' => 'none'
			)
		),
		'scheduled' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.scheduled',
			'exclude' => '1',
			'config' => Array (
				'type' => 'none',
				'cols' => '30',
				'format' => 'datetime',
				'default' => 0
			)
		),
		'scheduled_begin' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.scheduled_begin',
			'config' => Array (
				'type' => 'none',
				'cols' => '15',
				'format' => 'datetime',
				'default' => 0
			)
		),
		'scheduled_end' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.scheduled_end',
			'config' => Array (
				'type' => 'none',
				'cols' => '15',
				'format' => 'datetime',
				'default' => 0
			)
		),
		'use_domain' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.use_domain',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'sys_domain',
				'size' => '1',
				'maxitems' => 1,
				'minitems' => 0
			)
		),
		'use_rdct' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.use_rdct',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'long_link_rdct_url' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.long_link_rdct_url',
			'config' => Array (
				'type' => 'input',
				'size' => '15',
				'max' => '80',
				'eval' => 'trim',
				'default' => ''
			)
		),
		'long_link_mode' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.long_link_mode',
			'config' => Array (
				'type' => 'check'
			)
		),
		'authcode_fieldList' => Array(
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.authcode_fieldList',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
				'max' => '80',
				'default' => 'uid,name,email,password'
			)
		),
		'renderedsize' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.renderedsize',
			'exclude' => '1',
			'config' => Array (
				'type' => 'none'
			)
		),
		'attachment' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.attachment',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => '',	// Must be empty for disallowed to work.
				'disallowed' => 'php,php3',
				'max_size' => '10000',
				'uploadfolder' => 'uploads/tx_directmail',
				'show_thumbs' => '0',
				'size' => '3',
				'maxitems' => '5',
				'minitems' => '0'
			)
		),
		'type' => Array (
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.type',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.type.I.0', '0'),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.type.I.1', '1')
				),
				'default' => '0'
			)
		)
	),
	'types' => Array (
		'0' => Array('showitem' => 'type;;;;1-1-1, page, plainParams, HTMLParams, --div--, subject;;;;3-3-3, from_email, from_name, replyto_email, replyto_name, return_path, organisation, attachment;;;;4-4-4, priority;;;;5-5-5,encoding, sendOptions, includeMedia, flowedFormat, use_domain, use_rdct, long_link_mode, authcode_fieldList, scheduled;;1;;5-5-5'),
		'1' => Array('showitem' => 'type;;;;1-1-1,
			plainParams;LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.plainParams.ALT.1,
			HTMLParams;LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail.HTMLParams.ALT.1,
			--div--, subject;;;;3-3-3, from_email, from_name, replyto_email, replyto_name, return_path, organisation, attachment;;;;4-4-4, priority;;;;5-5-5, encoding, sendOptions, includeMedia, flowedFormat, use_rdct, long_link_mode, authcode_fieldList')
	),
	'palettes' => Array (
		'1' => Array ('showitem' => 'scheduled_begin,scheduled_end'),
	)
);

// ******************************************************************
// Categories
// ******************************************************************
$TCA['sys_dmail_category'] = Array (
	'ctrl' => $TCA['sys_dmail_category']['ctrl'],
	'interface' => Array (
        	'showRecordFieldList' => 'hidden,category'
	),
	'feInterface' => $TCA['sys_dmail_category']['feInterface'],
	'columns' => Array (
		'sys_language_uid' => Array (
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => Array (
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => Array(
					Array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages',-1),
					Array('LLL:EXT:lang/locallang_general.xml:LGL.default_value',0)
				)
			)
	    	),
		'l18n_parent' => Array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('', 0),
				),
				'foreign_table' => 'sys_dmail_category',
				'foreign_table_where' => 'AND sys_dmail_category.pid=###CURRENT_PID### AND sys_dmail_category.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => Array (
			'config' => Array (
	    			'type' => 'passthrough'
			)
	    	),
		'hidden' => Array (
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'category' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_category.category',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
			)
		),
		'old_cat_number' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_category.old_cat_number',
			'l10n_mode' => 'exclude',
			'config' => Array (
				'type' => 'input',
				'size' => '2',
				'eval' => 'trim',
				'max' => '2',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource,hidden;;1;;1-1-1, category')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);

// ******************************************************************
// sys_dmail_group
// ******************************************************************
$TCA['sys_dmail_group'] = Array (
	'ctrl' => $TCA['sys_dmail_group']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'type,title,description'
	),
	'columns' => Array (
		'title' => Array (
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.title',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '120',
				'eval' => 'trim,required'
			)
		),
		'description' => Array (
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.description',
			'config' => Array (
				'type' => 'text',
				'cols' => '40',
				'rows' => '3'
			)
		),
		'type' => Array (
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.type',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.type.I.0', '0'),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.type.I.1', '1'),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.type.I.2', '2'),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.type.I.3', '3'),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.type.I.4', '4')
				),
				'default' => '0'
			)
		),
		'static_list' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.static_list',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tt_address,fe_users,fe_groups',
				'MM' => 'sys_dmail_group_mm',
				'size' => '20',
				'maxitems' => '100000',
				'minitems' => '0',
				'show_thumbs' => '1'
			)
		),
		'pages' => Array (
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.startingpoint',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'db',
					'allowed' => 'pages',
				'size' => '3',
				'maxitems' => '22',
				'minitems' => '0',
				'show_thumbs' => '1'
			)
		),
		'mail_groups' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.mail_groups',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'db',
					'allowed' => 'sys_dmail_group',
				'size' => '3',
				'maxitems' => '22',
				'minitems' => '0',
				'show_thumbs' => '1'
			)
		),
		'recursive' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.recursive',
			'config' => Array (
				'type' => 'check'
			)
		),
		'whichtables' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.whichtables',
			'config' => Array (
				'type' => 'check',
				'items' => Array (
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.whichtables.I.0', ''),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.whichtables.I.1', ''),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.whichtables.I.2', ''),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.whichtables.I.3', ''),
				),
				'cols' => 2,
				'default' => 1
			)
		),
		'list' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.list',
			'config' => Array (
				'type' => 'text',
				'cols' => '48',
				'rows' => '10'
			)
		),
		'csv' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.csv',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.csv.I.0', '0'),
					Array('LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.csv.I.1', '1')
				),
				'default' => '0'
			)
		),
		'select_categories' => Array (
			'label' => 'LLL:EXT:direct_mail/locallang_tca.xml:sys_dmail_group.select_categories',
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
				'MM' => 'sys_dmail_group_category_mm',
			)
		)

	),
	'types' => Array (
		'0' => Array('showitem' => 'type;;;;1-1-1, title;;;;3-3-3, description, --div--,pages;;;;5-5-5,recursive,whichtables,select_categories'),
		'1' => Array('showitem' => 'type;;;;1-1-1, title;;;;3-3-3, description, --div--,list;;;;5-5-5,csv'),
		'2' => Array('showitem' => 'type;;;;1-1-1, title;;;;3-3-3, description, --div--,static_list;;;;5-5-5'),
		'3' => Array('showitem' => 'type;;;;1-1-1, title;;;;3-3-3, description'),
		'4' => Array('showitem' => 'type;;;;1-1-1, title;;;;3-3-3, description, --div--,mail_groups;;;;5-5-5')
	)
);

?>
