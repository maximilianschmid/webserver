<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007-2008 Franz Holzinger <kontakt@fholzinger.com>
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
 * Part of the sr_email_subsribe (Email Newsletter Registration) extension.
 *
 * hook functions for the TYPO3 cms
 *
 * $Id: class.tx_sremailsubscribe_hooks_cms.php 15780 2009-01-18 15:16:35Z franzholz $
 *
 * @author	Franz Holzinger <kontakt@fholzinger.com>
 * @maintainer	Franz Holzinger <kontakt@fholzinger.com> 
 * @package TYPO3
 * @subpackage sr_email_subsribe
 *
 *
 */


class tx_sremailsubscribe_hooks_cms {

	/**
	 * Draw the item in the page module
	 *
	 * @param	array		parameters
	 * @param	object		the parent object
	 * @return	  string
	 */

	function pmDrawItem(&$params, &$pObj)	{
		$bPhp5 = version_compare(phpversion(), '5.0.0', '>=');
		if ($bPhp5 && defined ('PATH_BE_div2007') && $pObj->pageRecord['doktype'] == 1 && $params['row']['pi_flexform'])	{
			include_once (PATH_BE_div2007.'class.tx_div2007_ff.php');

			tx_div2007_ff::load($params['row']['pi_flexform'],SR_EMAIL_SUBSCRIBE_EXTkey);
			$codes = 'CODE: '.tx_div2007_ff::get(SR_EMAIL_SUBSCRIBE_EXTkey, 'display_mode');
		}
		return $codes;
	}
}


if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_email_subscribe/hooks/class.tx_sremailsubsribe_hooks_cms.php'])	{
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_email_subscribe/hooks/class.tx_sremailsubsribe_hooks_cms.php']);
}

?>
