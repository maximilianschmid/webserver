<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 John Angel <johnange@gmail.com>
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
 * Class for the Content Replacer
 * Replaces string patterns from the page content. You can use it to replace URLs for Content Delivery Network (CDN).
 *
 * @author	John Angel <johnange@gmail.com>
 * @package	TYPO3
 * @subpackage tx_jareplacer
 */
class tx_jareplacer {
	/**
	 * Search links to resource and replace them with e.g. a CDN-Link
	 *
	 * You must set the Search and Replace patterns via TypoScript.
	 * usage from TypoScript:
	 *   config.tx_ja_replacer {
	 *     search {
	 *       1="typo3temp/pics/
	 *       2="fileadmin/
	 *     }
	 *     replace {
	 *       1="http://mycdn.com/i/
	 *       2="http://mycdn.com/f/
	 *     }
	 *   }
	 *
	 * Don't forget to clear the cache afterwards!
	 *
	 * @param	tslib_fe	$obj
	 * @return	void	The content is passed by reference
	 */
	function hook_indexContent(&$obj) {
			// Fetch configuration
		$config = &$obj->config['config']['tx_ja_replacer.'];

			// Quit immediately if no replace array setup
		if (!$config || !isset($config['search.']) || !$config['search.'] || !isset($config['replace.']) || !$config['replace.']) return;

			// Replace page content
		$obj->content = str_replace($config['search.'], $config['replace.'], $obj->content);

		// Replace additional headers in page
		if (is_array($obj->config['INTincScript_ext']['additionalHeaderData'])) {
			foreach ($obj->config['INTincScript_ext']['additionalHeaderData'] as $key => $value) {
				if ($value) {
					$obj->config['INTincScript_ext']['additionalHeaderData'][$key] = str_replace($config['search.'], $config['replace.'], $value);
				}
			}
		}
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ja_replacer/class.tx_jareplacer.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ja_replacer/class.tx_jareplacer.php']);
}

?>