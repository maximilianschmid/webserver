<?php
/***************************************************************
*  Copyright notice
*  
*  (c) 2005 Kraft Bernhard (kraftb@gmx.net)
*  All rights reserved
*	Copyright of original script:
*  (c) 2002-2004 Kasper Skårhøj (kasper@typo3.com)
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is 
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
* 
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
* 
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/** 
 * Extending the Better login box with supercallenge mechanism (using
 * the same md5.js as the BE)
 *
 * $Id$
 *
 * @author	Kraft Bernhard (kraftb@gmx.net)
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */
require_once(t3lib_extMgm::extPath('kb_md5fepw').'class.tx_kbmd5fepw_funcs.php');
require_once(PATH_tslib.'class.tslib_pibase.php');
class tx_kbmd5fepw_newloginbox extends tslib_pibase {

	function forgotPassword(&$params, &$ref) {
		$this->conf = $ref->conf;
		$this->pi_setPiVarDefaults();
		$this->scriptRelPath = 'pi1/class.tx_kbmd5fepw_newloginbox.php';
		$this->extKey = 'kb_md5fepw';
		$this->pi_loadLL(1);		// Loading the LOCAL_LANG values
		$d=$GLOBALS['TSFE']->getStorageSiterootPids();
		
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, username, password', 'fe_users', 'email='.$GLOBALS['TYPO3_DB']->fullQuoteStr(trim($ref->piVars['DATA']['forgot_email']), 'fe_users').' AND pid='.intval($d['_STORAGE_PID']).' '.$GLOBALS['TSFE']->cObj->enableFields('fe_users'));
		if ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))	{
			$new_password = tx_kbmd5fepw_funcs::generatePassword(intval($GLOBALS['TSFE']->config['plugin.']['tx_newloginbox_pi1.']['defaultPasswordLength'])?intval($GLOBALS['TSFE']->config['plugin.']['tx_newloginbox_pi1.']['defaultPasswordLength']):5);
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery('fe_users', 'uid='.$row['uid'], array('password' => md5($new_password)));
			$msg=sprintf($this->pi_getLL('forgot_password_pswmsg','',1),trim($this->piVars['DATA']['forgot_email']),$row['username'],$new_password);
		} else {
			$msg=sprintf($this->pi_getLL('forgot_password_no_pswmsg','',1),trim($this->piVars['DATA']['forgot_email']));
		}
		$params['msg'] = $msg;
		return true;
	}
	function loginFormOnSubmit(&$params, &$ref) {
		$js = '
	function superchallenge_pass(form) {
		var pass = form.pass.value;
		if (pass) {
			var enc_pass = MD5(pass);
			var str = form.user.value+":"+enc_pass+":"+form.challenge.value;
			form.pass.value = MD5(str);
			return true;
		} else {
			return false;
		}
	}
';
		$GLOBALS['TSFE']->JSCode .= $js;
		$GLOBALS['TSFE']->additionalHeaderData['tx_kbmd5fepw_newloginbox'] = '<script language="JavaScript" type="text/javascript" src="typo3/md5.js"></script>';
		$chal_val = md5(time().getmypid());
		$res = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_kbmd5fepw_challenge', array('challenge' => $chal_val, 'tstamp' => time()));
		$onSubmit =	'superchallenge_pass(this)';
		$hidden = '<input type="hidden" name="challenge" value="'.$chal_val.'">';
		return array($onSubmit, $hidden);
	}

}


?>
