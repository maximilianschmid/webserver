<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008-2008 Franz Holzinger <contact@fholzinger.com>
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
 * Part of the div2007 (Static Methods for Extensions End of 2007) extension.
 *
 * hook functions for the TYPO3 cms
 *
 * $Id:$
 *
 * @author	Franz Holzinger <contact@fholzinger.com>
 * @maintainer	Franz Holzinger <contact@fholzinger.com>
 * @package TYPO3
 * @subpackage div2007
 *
 *
 */


class tx_div2007_hooks_cms {
	public $extKey = '';	// extension key must be overridden

	/**
	 * Draw the item in the page module
	 *
	 * @param	array		parameters
	 * @param	object		the parent object
	 * @return	  string
	 */

	function pmDrawItem(&$params, &$pObj)	{
		$bPhp5 = version_compare(phpversion(), '5.0.0', '>=');

		if (t3lib_extMgm::isLoaded($this->extKey) &&
			in_array(intval($pObj->pageRecord['doktype']), array(1,2,5)) &&
			$params['row']['pi_flexform'] != ''
		)	{
			include_once (PATH_BE_div2007.'class.tx_div2007_ff.php');

			tx_div2007_ff::load($params['row']['pi_flexform'],$this->extKey);
			$codes = 'CODE: '.tx_div2007_ff::get($this->extKey, 'display_mode');
		}
		return $codes;
	}
}


?>
