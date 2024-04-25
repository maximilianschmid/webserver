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
 * Frontend Session with superchallenge enabled
 *
 * $Id$
 *
 * @author	Kraft Bernhard <kraftb@gmx.net>
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */

class ux_tslib_cObj extends tslib_cObj {

	function FORM($conf,$formData='')    {
		$ret = parent::FORM($conf, $formData);
		if ($GLOBALS['TSFE']->additionalHeaderData['JSFormValidate'])	{
			$GLOBALS['TSFE']->additionalHeaderData['JSFormValidate'] = '<script type="text/javascript" src="'.str_replace(PATH_site, '', t3lib_extMgm::siteRelPath('kb_md5fepw')).'res/jsfunc.validateform.js"></script>';
			$GLOBALS['TSFE']->additionalHeaderData['MD5_script'] = '<script type="text/javascript" src="typo3/md5.js"></script>';
		}
		return $ret;
	}

}

?>
