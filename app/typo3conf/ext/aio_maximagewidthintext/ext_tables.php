<?php
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