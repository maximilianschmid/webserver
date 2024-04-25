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
 * base class for all database table classes
 *
 * $Id: class.tx_srfeuserregister_model_setfixed.php 9373 2008-06-23 07:09:58Z franzholz $
 *
 * @author  Franz Holzinger <contact@fholzinger.com>
 * @maintainer	Franz Holzinger <contact@fholzinger.com> 
 * @package TYPO3
 * @subpackage sr_feuser_register
 *
 */

require_once(PATH_BE_srfeuserregister.'model/class.tx_srfeuserregister_model_table_base.php');


class tx_srfeuserregister_model_setfixed extends tx_srfeuserregister_model_table_base {

}

if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/model/class.tx_srfeuserregister_model_setfixed.php']) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/model/class.tx_srfeuserregister_model_setfixed.php']);
}

?>
