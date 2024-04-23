<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Maximilian Schmid <ms@anorak.io>
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
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');

//include templavoila API - deprecated - left for demo purposes
//require_once(t3lib_extMgm::extPath('templavoila').'class.tx_templavoila_api.php');


/**
 * Plugin 'aio feedit' for the 'aio_feedit' extension.
 *
 * @author	Maximilian Schmid <ms@anorak.io>
 * @package	TYPO3
 * @subpackage	tx_aiofeedit
 */
class tx_aiofeedit_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_aiofeedit_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_aiofeedit_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'aio_feedit';	// The extension key.
	var $pi_checkCHash = true;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf)	{
		

		/*return 'Hello World!<HR>
			Here is the TypoScript passed to the method:'.
					t3lib_div::view_array($conf);
		*/
		
		//examplecode for using TemplaVoila API
		if (t3lib_extMgm::isLoaded('templavoila')){
      $templavoilaApiObj = t3lib_div::makeInstance('tx_templavoila_api');
		}
		
    //check for be-user - only a hack
		if( isset($GLOBALS['BE_USER']->user['username']) ){
			//include JavaScript
      $javascript = "<script type='text/javascript' src='/typo3conf/ext/aio_feedit/res/js/feedit.all.js?revision=".$conf['revision']."'></script>";
		}else{
			$javascript = "";
		}
		
		return $javascript;

	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/aio_feedit/pi1/class.tx_aiofeedit_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/aio_feedit/pi1/class.tx_aiofeedit_pi1.php']);
}

?>