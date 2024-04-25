<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=="BE")	{

  // unserializing the configuration so we can use it here:
  $_EXTCONF = unserialize($_EXTCONF);

  // fake conf, to make original templavoila page module shy
  $GLOBALS['TBE_MODULES']['_PATHS']['web_txtemplavoilaM1'] = t3lib_extMgm::extPath('templavoila_pagemod').'templavoila_fake_conf/';    
  
  t3lib_extMgm::addModule("web","txtemplavoilapagemodM1","top",t3lib_extMgm::extPath($_EXTKEY)."mod1/");
}
?>