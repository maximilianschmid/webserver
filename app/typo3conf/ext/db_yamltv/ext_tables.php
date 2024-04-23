<?php
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
?>