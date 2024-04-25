<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

if (t3lib_extMgm::isLoaded('newloginbox') && (TYPO3_MODE == 'FE')) {
	$GLOBALS ['TYPO3_CONF_VARS']['EXTCONF']['newloginbox']['forgotEmail'][] = 'tx_kbmd5fepw_newloginbox->forgotPassword';
	$GLOBALS ['TYPO3_CONF_VARS']['EXTCONF']['newloginbox']['loginFormOnSubmitFuncs'][] = 'tx_kbmd5fepw_newloginbox->loginFormOnSubmit';
	require_once(t3lib_extMgm::extPath('kb_md5fepw').'pi1/class.tx_kbmd5fepw_newloginbox.php');
} elseif (TYPO3_MODE == 'FE') {
	$TYPO3_CONF_VARS['FE']['XCLASS']['tslib/class.tslib_content.php'] = t3lib_extMgm::extPath($_EXTKEY).'class.ux_tslib_content.php';
	require_once(t3lib_extMgm::extPath('kb_md5fepw').'class.tx_kbmd5fepw_procout.php');
	$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 'tx_kbmd5fepw_procout->contentPostProc_output';
}

if ($GLOBALS['TYPO3_LOADED_EXT']['feuser_admin']) {
	$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['media/scripts/fe_adminLib.inc'] = t3lib_extMgm::extPath($_EXTKEY).'ux_feadminLib.php';
}

t3lib_extMgm::addService($_EXTKEY,  'auth' /* sv type */,  'tx_kbssignon_auth' /* sv key */,
    array(

      'title' => 'FE MD5 authentication',
      'description' => 'Performs the server side part of the challenge response authentication.',

      'subtype' => 'authUserFE',

      'available' => true,
      'priority' => 90,
      'quality' => 50,

      'os' => '',
      'exec' => '',

      'classFile' => t3lib_extMgm::extPath($_EXTKEY).'sv1/class.tx_kbmd5fepw_sv1.php',
      'className' => 'tx_kbmd5fepw_sv1',
    )
  );


?>
