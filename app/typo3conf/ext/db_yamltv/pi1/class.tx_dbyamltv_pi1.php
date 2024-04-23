<?php
/***************************************************************
*  Copyright notice
*  
*  Based on: 'flexform_getconstant'
*  (c) 2007 Andreas Stauder (adbw.ch) <stauder@adbw.ch>
*  All rights reserved
*
*  Modified by:
*  (c) 2007 Dieter Bunkerd (yaml.t3net.de) <db@t3net.de>
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
	 * Plugin 'tx_dbyamltv_pi1' for the 'db_yamltv' extension.
	 *
	 * @author		Andreas Stauder, Dieter Bunkerd
	 * @version		3.0.0
	 */

require_once(PATH_tslib.'class.tslib_pibase.php');

class tx_dbyamltv_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_dbyamltv_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_dbyamltv_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'db_yamltv';	// The extension key.
	var $pi_checkCHash = true;

	function main($content,$conf)	{
		$this->yamlstyle = $conf;
		$err_flag = 0; 
		$currLevel = 0;
		$returnCode = 0; 
		$currFieldValue = '';
		$currParentID = '';
		$loopEnd = 0;
		
		if(isset($this->yamlstyle["uid"])) $search_uid = $this->yamlstyle["uid"]; else $search_uid = $GLOBALS['TSFE']->id;
		if(isset($this->yamlstyle["field"])) $search_yamlfield = $this->yamlstyle["field"]; else {$err_flag = 1; $defReturnValue="tx_dbyamltv_no_field_specified";}

		$datastructure_uid = 0; 
		$startpage = 1;
		
		while($datastructure_uid == 0 && $search_uid != 0) {
			$findit = mysql_query("SELECT pid, tx_templavoila_ds, tx_templavoila_next_ds FROM pages WHERE uid = $search_uid");
		  if(mysql_num_rows($findit)>=1) {
		    !$startpage ? $datastructure_uid = mysql_result($findit, 0, 2) : $startpage = 0;
				if($datastructure_uid == 0) $datastructure_uid = mysql_result($findit, 0, 1);
				if($datastructure_uid != 0) {
					$datastructure = mysql_query("SELECT dataprot FROM tx_templavoila_datastructure WHERE uid = $datastructure_uid");
		      if(mysql_num_rows($datastructure) >= 1) {
						$dataprod = mysql_result($datastructure, 0, 0);
						$xmlstructure = t3lib_div::xml2array($dataprod);
						return $xmlstructure['ROOT']['yamldata'][$search_yamlfield];
					}
				}
				$search_uid = mysql_result($findit, 0, 0);
			}
			else {
				$search_uid = 0;
		  }
		}
		return '';
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/db_yamltv/pi1/class.tx_dbyamltv_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/db_yamltv/pi1/class.tx_dbyamltv_pi1.php']);
}

?>
