<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008-2008 Franz Holzinger <franz@ttproducts.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License or
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
 * Part of the sr_feuser_register (Frontend User Registration) extension.
 *
 * base class for all database table fields classes
 *
 * $Id: class.tx_srfeuserregister_model_field_base.php 15775 2009-01-18 14:27:11Z franzholz $
 *
 * @author	Franz Holzinger <franz@ttproducts.de>
 * @maintainer	Franz Holzinger <franz@ttproducts.de>
 * @package TYPO3
 * @subpackage sr_feuser_register
 *
 */


class tx_srfeuserregister_model_field_base  {
	var $bHasBeenInitialised = FALSE;

	function init()	{
		$this->bHasBeenInitialised = TRUE;
	}

	function needsInit()	{
		return !$this->bHasBeenInitialised;
	}

	function modifyConf (&$conf, $cmdKey)	{
	}

	function get($row, $fieldname)	{
		return $row[$fieldname];
	}

	function parseOutgoingData($fieldname, $dataArray, &$origArray, &$parsedArr) {
		$parsedArr[$fieldname] = $dataArray[$fieldname];	// just copied the original value
	}
}


if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/model/field/class.tx_srfeuserregister_model_field_base.php']) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/model/field/class.tx_srfeuserregister_model_field_base.php']);
}


?>
