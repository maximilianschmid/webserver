<?php
/***************************************************************
*  Copyright notice
*
*  (c) 1999-2003 Kasper Skårhøj <kasperYYYY@typo3.com>
*  (c) 2004-2008 Stanislas Rolland <stanislas.rolland(arobas)sjbr.ca>
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
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 *
 * Front End creating/editing/deleting records authenticated by email address, also called subscriptions.
 *
 * $Id: class.tx_sremailsubscribe_pi1.php 34466 2010-06-17 12:26:40Z franzholz $
 *
 * @author	Kasper Skårhøj <kasperYYYY@typo3.com>
 * @author	Stanislas Rolland <stanislas.rolland(arobas)sjbr.ca>
 * @author	Franz Holzinger <franz@ttproducts.de>
 */


require_once(PATH_BE_sremailsubscribe.'pi1/class.tx_sremailsubscribe_pi1_base.php');


class tx_sremailsubscribe_pi1 {
	var $cObj;

	function main ($content, $conf) {
		$pibaseObj = &t3lib_div::getUserObj('&tx_sremailsubscribe_pi1_base');
		$pibaseObj->cObj = &$this->cObj;
		$content = &$pibaseObj->main($content, $conf);
		return $content;
	}
}

if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_email_subscribe/pi1/class.tx_sremailsubscribe_pi1.php']) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_email_subscribe/pi1/class.tx_sremailsubscribe_pi1.php']);
}

?>
