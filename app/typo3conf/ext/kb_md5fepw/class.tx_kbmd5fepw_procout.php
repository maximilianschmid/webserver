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
 * Replacing a marker with the Challenge
 *
 * $Id$
 *
 * @author	Kraft Bernhard <kraftb@gmx.net>
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */

class tx_kbmd5fepw_procout {
	function contentPostProc_output(&$params) {
		$feobj = &$params['pObj'];	
		$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_kbmd5fepw_challenge', '(tstamp+(60*30))<'.time());
		if (strpos($feobj->content, '###KB_MD5FEPW_CHALLENGE###') !== false) {
			$feobj->content = str_replace('###KB_MD5FEPW_CHALLENGE###', $chal = md5(time()), $feobj->content);
			$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_kbmd5fepw_challenge', array('challenge' => $chal, 'tstamp' => time()));
		}
	}
}


?>
