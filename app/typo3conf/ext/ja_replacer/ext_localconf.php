<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if(TYPO3_MODE=='FE') {
	require_once(t3lib_extMgm::extPath('ja_replacer').'class.tx_jareplacer.php');
	$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['pageIndexing'][] = 'tx_jareplacer';
}

?>