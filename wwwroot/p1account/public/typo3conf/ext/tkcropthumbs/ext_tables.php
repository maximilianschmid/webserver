<?php
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
?>