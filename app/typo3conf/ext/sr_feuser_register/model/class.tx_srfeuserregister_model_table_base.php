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
 * base class for all database table classes
 *
 * $Id: class.tx_srfeuserregister_model_table_base.php 15775 2009-01-18 14:27:11Z franzholz $
 *
 * @author	Franz Holzinger <franz@ttproducts.de>
 * @maintainer	Franz Holzinger <franz@ttproducts.de>
 * @package TYPO3
 * @subpackage sr_feuser_register
 *
 */



class tx_srfeuserregister_model_table_base	{
	var $functablename;
	var $tablename;
	var $fieldClassArray = array(); // must be overridden
	var $bHasBeenInitialised = FALSE;

	function init ($functablename, $tablename)	{
		$this->setFuncTablename($functablename);
		$this->setTablename($tablename);
		$this->bHasBeenInitialised = TRUE;
	}

	function needsInit()	{
		return !$this->bHasBeenInitialised;
	}

	function getFieldClassAndPath ($fieldname)	{
		global $TCA;


		$class = '';
		$path = '';
		$tablename = $this->getTablename();

		if ($fieldname && isset($TCA[$tablename]['columns'][$fieldname]) && is_array($TCA[$tablename]['columns'][$fieldname]))	{

			$class = $this->fieldClassArray[$fieldname];
			if ($class)	{
				$path = PATH_BE_srfeuserregister;
			}
		}
		$rc = array('class' => $class, 'path' => $path);

		return $rc;
	}

	function &getFieldObj ($fieldname)	{
		$classAndPath = $this->getFieldClassAndPath($fieldname);

		if ($classAndPath['class'])	{
			$rc = $this->getObj($classAndPath);
		}
		return $rc;
	}

	function &getObj ($classArray)	{

		$className = $classArray['class'];
		$classNameView = $className.'_view';
		$path = $classArray['path'];

		include_once ($path.'model/field/class.'.$className.'.php');
		$fieldObj = &t3lib_div::getUserObj('&'.$className);	// fetch and store it as persistent object
		if ($fieldObj->needsInit())	{
			$fieldObj->init($this->cObj);
		}

		return $fieldObj;
	}

	function getFuncTablename ()	{
		return $this->functablename;
	}

	function setFuncTablename ($tablename)	{
		$this->functablename = $tablename;
	}

	function getTablename ()	{
		return $this->tablename;
	}

	function setTablename ($tablename)	{
		$this->tablename = $tablename;
	}
}

if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/model/class.tx_srfeuserregister_table_base.php']) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/model/class.tx_srfeuserregister_table_base.php']);
}

?>
