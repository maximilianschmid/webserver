<?php
  if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

  $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['templavoila']['db_new_content_el']['wizardItemsHook'][] = t3lib_extMgm::extPath($_EXTKEY).'hook/class.newContentElement_hook.php:&tx_fcecolumn_newContentElement_hook'; 
  
  ?>
