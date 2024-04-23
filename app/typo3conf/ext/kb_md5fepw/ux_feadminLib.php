<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005 Kraft Bernhard (kraftb@gmx.net)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * Modifying the feadminLib.inc file so the md5 JS gets included
 *
 * $Id$
 *
 * @author	Kraft Bernhard <kraftb@gmx.net>
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */

require_once(t3lib_extMgm::extPath('kb_md5fepw').'class.tx_kbmd5fepw_funcs.php');

class ux_user_feAdmin extends user_feAdmin	{
	function init($content,$conf)	{
		$ret = parent::init($content, $conf);
		if (($this->cmd == 'edit') || ($this->cmd == 'create')) {
			$GLOBALS['TSFE']->additionalHeaderData['MD5_script'] = '<script type="text/javascript" src="typo3/md5.js"></script>';
		}
		return $ret;
	}	

	/**
	 * Sends info mail to user
	 *
	 * @return	string		HTML content message
	 * @see init(),compileMail(), sendMail()
	 */
	function sendInfoMail()	{
		if ($this->conf['infomail'] && $this->conf['email.']['field'])	{
			$fetch = t3lib_div::_GP('fetch');
			if ($fetch)	{
					// Getting infomail config.
				$key= trim(t3lib_div::_GP('key'));
				if (is_array($this->conf['infomail.'][$key.'.']))		{
					$config = $this->conf['infomail.'][$key.'.'];
				} else {
					$config = $this->conf['infomail.']['default.'];
				}
				$pidLock='';
				if (!$config['dontLockPid'])	{
					$pidLock='AND pid IN ('.$this->thePid.') ';
				}

					// Getting records
				if (t3lib_div::testInt($fetch))	{
					$DBrows = $GLOBALS['TSFE']->sys_page->getRecordsByField($this->theTable,'uid',$fetch,$pidLock,'','','1');
				} elseif ($fetch) {	// $this->conf['email.']['field'] must be a valid field in the table!
					$DBrows = $GLOBALS['TSFE']->sys_page->getRecordsByField($this->theTable,$this->conf['email.']['field'],$fetch,$pidLock,'','','100');
				}

					// Processing records
				if (is_array($DBrows))	{
					$GLOBALS['TSFE']->includeTCA();
					t3lib_div::loadTCA($this->theTable);
					$recipient = $DBrows[0][$this->conf['email.']['field']];
					foreach ($DBrows as $key => $row)	{
						if ($DBrows[$key]['password'])	{
							$new_pw = tx_kbmd5fepw_funcs::generatePassword(intval($this->conf['defaultPasswordLength']));
							$DBrows[$key]['password'] = $new_pw;
							$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->theTable, 'uid='.$row['uid'], array('password' => md5($new_pw)));
						}
					}
					$this->compileMail($config['label'], $DBrows, $recipient, $this->conf['setfixed.']);
				} elseif ($this->cObj->checkEmail($fetch)) {
					$this->sendMail($fetch, '', trim($this->cObj->getSubpart($this->templateCode, '###'.$this->emailMarkPrefix.'NORECORD###')));
				}

				$content = $this->getPlainTemplate('###TEMPLATE_INFOMAIL_SENT###');
			} else {
				$content = $this->getPlainTemplate('###TEMPLATE_INFOMAIL###');
			}
		} else $content='Error: infomail option is not available or emailField is not setup in TypoScript';
		return $content;
	}

}

?>
