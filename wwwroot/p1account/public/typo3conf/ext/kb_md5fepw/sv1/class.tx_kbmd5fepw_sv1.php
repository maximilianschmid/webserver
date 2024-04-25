<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005 Kraft Bernhard (kraftb@gmx.net)
*  All rights reserved
*
*  Based on ext/sv/class.tx_sv_auth.php:
*  (c) 2004-2005 René Fritz <r.fritz@colorcube.de>
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
 * Service class which performs challenge response.
 *
 * $Id$
 *
 * @author	Kraft Bernhard <kraftb@kraftb.at>
 * @author	René Fritz <r.fritz@colorcube.de>
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */


class tx_kbmd5fepw_sv1 extends tx_sv_authbase	{
	
	/**
	 * Authenticate a user (Check various conditions for the user that might invalidate its authentication, eg. password match, domain, IP, etc.)
	 *
	 * @param	array		Data of user.
	 * @return	boolean
	 */
	function authUser($user)	{
		$OK = 100;

		if ($this->login['uident'] && $this->login['uname'])	{

				// Checking password match for user:
			$OK = $this->compareUident($user, $this->login, 'superchallenged');

			$F_chalvalue = $this->login['chalvalue'];
			if (strlen($F_chalvalue)) {
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('count(*) as count', 'tx_kbmd5fepw_challenge', 'challenge='.$GLOBALS['TYPO3_DB']->fullQuoteStr($F_chalvalue, 'tx_kbmd5fepw_challenge'));
				$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				$cnt = $row['count'];
				// If we don't find this challenge in the database it's invalid
				if (!$cnt) {
					$OK = 0;
				} else {
					$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_kbmd5fepw_challenge', 'challenge='.$GLOBALS['TYPO3_DB']->fullQuoteStr($F_chalvalue, 'tx_kbmd5fepw_challenge'));
				}
			}

			if(!$OK)     {
					// Failed login attempt (wrong password) - write that to the log!
				if ($this->writeAttemptLog) {
					$this->writelog(255,3,3,1,
						"Login-attempt from %s (%s), username '%s', password not accepted!",
						Array($this->authInfo['REMOTE_ADDR'], $this->authInfo['REMOTE_HOST'], $this->login['uname']));
				}
				if ($this->writeDevLog) 	t3lib_div::devLog('Password not accepted: '.$this->login['uident'], 'tx_sv_auth', 2);
			}

				// Checking the domain (lockToDomain)
			if ($OK && $user['lockToDomain'] && $user['lockToDomain']!=$this->authInfo['HTTP_HOST'])	{
					// Lock domain didn't match, so error:
				if ($this->writeAttemptLog) {
					$this->writelog(255,3,3,1,
						"Login-attempt from %s (%s), username '%s', locked domain '%s' did not match '%s'!",
						Array($this->authInfo['REMOTE_ADDR'], $this->authInfo['REMOTE_HOST'], $user[$this->db_user['username_column']], $user['lockToDomain'], $this->authInfo['HTTP_HOST']));
				}
				$OK = false;
			}
		}

		return $OK>0?200:0;
	}


}


?>
