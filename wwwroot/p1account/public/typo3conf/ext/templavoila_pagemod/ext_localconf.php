<?php

if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

/** Initialize vars from extension conf */
$_EXTCONF = unserialize($_EXTCONF);    // unserializing the configuration so we can use it here:
$initVars = array('disable_listviewLink','dont_follow_shortcuts');
foreach($initVars as $var) {
  $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY][$var] = $_EXTCONF[$var] ? trim($_EXTCONF[$var]) : "";
}

$TYPO3_CONF_VARS['BE']['XCLASS']['ext/templavoila/mod1/index.php'] = t3lib_extMgm::extPath('templavoila_pagemod').'class.ux_tx_templavoila_module1.php';
#$TYPO3_CONF_VARS['BE']['XCLASS']['typo3/db_list.php'] = t3lib_extMgm::extPath('templavoila_pagemod').'class.ux_db_list.php'; // outcommented, not needed anyway

// Registers hook in TCEMain
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:templavoila_pagemod/class.tx_templavoilapagemod_tcemainprocdm.php:tx_templavoilapagemod_tcemainprocdm';

?>
