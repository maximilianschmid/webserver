<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2016 Oliver Hader <oliver@typo3.org>
*
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
 * Workspace/Version preview hooks.
 */
class tx_version_preview implements t3lib_Singleton{

	/**
	 * @return tx_version_preview
	 */
	static public function getInstance() {
		return t3lib_div::makeInstance('tx_version_preview');
	}

	/**
	 * Defines whether to force read permissions on pages.
	 *
	 * @var bool
	 * @see \TYPO3\CMS\Core\Authentication\BackendUserAuthentication::getPagePermsClause
	 */
	protected $forceReadPermissions = FALSE;

	/**
	 * Modified workspace record for a degraded admin user.
	 *
	 * @var array
	 */
	protected $workspaceRecord = NULL;

	/**
	 * Gets forced read permissions.
	 *
	 * @return bool
	 */
	public function getForceReadPermissions() {
		return $this->forceReadPermissions;
	}

	/**
	 * Sets forced read permissions.
	 *
	 * @param bool $forceReadPermissions
	 */
	public function setForceReadPermissions($forceReadPermissions) {
		$this->forceReadPermissions = (bool)$forceReadPermissions;
	}

	/**
	 * Sets the modified workspace record.
	 *
	 * @param array $workspaceRecord
	 */
	public function setWorkspaceRecord(array $workspaceRecord) {
		$this->workspaceRecord = $workspaceRecord;
	}

	/**
	 * Gets the modified workspace record.
	 *
	 * @return array
	 */
	public function getWorkspaceRecord() {
		return $this->workspaceRecord;
	}

	/**
	 * Overrides the page permission clause in case an admin
	 * user has been degraded to a regular user without any user
	 * group assignments. This method is used as hook callback.
	 *
	 * @param array $parameters
	 * @return string
	 * @see \TYPO3\CMS\Core\Authentication\BackendUserAuthentication::getPagePermsClause
	 */
	public function overridePagePermissionClause(array $parameters) {
		$clause = $parameters['currentClause'];
		if ($parameters['perms'] & 1 && $this->forceReadPermissions) {
			$clause = ' 1=1';
		}
		return $clause;
	}

	/**
	 * Overrides the row permission value in case an admin
	 * user has been degraded to a regular user without any user
	 * group assignments. This method is used as hook callback.
	 *
	 * @param array $parameters
	 * @return int
	 * @see \TYPO3\CMS\Core\Authentication\BackendUserAuthentication::calcPerms
	 */
	public function overridePermissionCalculation(array $parameters) {
		$permissions = $parameters['outputPermissions'];
		if (!($permissions & 1) && $this->forceReadPermissions) {
			$permissions |= 1;
		}
		return $permissions;
	}

}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/version/class.tx_version_preview.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/version/class.tx_version_preview.php']);
}
?>