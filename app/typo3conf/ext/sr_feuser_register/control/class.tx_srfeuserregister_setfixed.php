<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007-2010 Stanislas Rolland <stanislas.rolland(arobas)sjbr.ca)>
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
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
 * Part of the sr_feuser_register (Front End User Registration) extension.
 *
 * setfixed functions
 *
 * $Id: class.tx_srfeuserregister_setfixed.php 34954 2010-06-26 21:04:35Z franzholz $
 *
 * @author	Kasper Skaarhoj <kasperXXXX@typo3.com>
 * @author	Stanislas Rolland <stanislas.rolland(arobas)sjbr.ca>
 * @author	Franz Holzinger <franz@ttproducts.de>
 *
 * @package TYPO3
 * @subpackage sr_feuser_register
 *
 *
 */


class tx_srfeuserregister_setfixed {
	var $pibase;
	var $conf = array();
	var $config = array();
	var $control;
	var $controlData;
	var $tca;
	var $display;
	var $email;
	var $marker;
	var $previewLabel;
	var $setfixedEnabled;
	var $cObj;
	var $buttonLabelsList;
	var $otherLabelsList;


	function init (&$cObj, &$conf, &$config, &$controlData, &$tca, &$display, &$email, &$marker)	{
		global $TSFE;

		$this->cObj = &$cObj;
		$this->conf = &$conf;
		$this->config = &$config;
		$this->controlData = &$controlData;
		$this->tca = &$tca;
		$this->display = &$display;
		$this->email = &$email;
		$this->marker = &$marker;
	}


	/**
	* Process the front end user reply to the confirmation request
	*
	* @param array  Array with key/values being marker-strings/substitution values.
	* @return string  the template with substituted markers
	*/
	function processSetFixed (
		$theTable,
		$uid,
		$cmdKey,
		&$markerArray,
		&$templateCode,
		&$dataArray,
		&$origArray,
		$securedArray,
		&$pObj,
		&$dataObj,
		&$feuData,
		$token
	) {
		global $TSFE;

		$row = $origArray;

		if ($this->controlData->getSetfixedEnabled()) {
			$origUsergroup = $row['usergroup'];
			$setfixedUsergroup = '';
			$setfixedSuffix = $sFK = $feuData['sFK'];
			$fD = t3lib_div::_GP('fD', 1);
			$fieldArr = array();
			if (is_array($fD)) {
				foreach($fD as $field => $value) {
					$row[$field] = rawurldecode($value);
					if($field == 'usergroup') {
						$setfixedUsergroup = rawurldecode($value);
					}
					$fieldArr[] = $field;
				}
			}

			$authObj = &t3lib_div::getUserObj('&tx_srfeuserregister_auth');
			$tablesObj = &t3lib_div::getUserObj('&tx_srfeuserregister_lib_tables');
			$addressObj = $tablesObj->get('address');
			$userGroupObj = &$addressObj->getFieldObj('usergroup');

			$fieldList = $row['_FIELDLIST'];
			$theCode = $authObj->setfixedHash($row, $fieldList);

			if (!strcmp($authObj->getAuthCode(), $theCode) && !($sFK == 'APPROVE' && count($origArray) && $origArray['disable']=='0')) {

				if ($sFK == 'EDIT')	{

					$this->marker->addGeneralHiddenFieldsMarkers($markerArray, $cmd, $token);
					$content = $this->display->editScreen(
						$markerArray,
						$theTable,
						$dataArray,
						$origArray,
						$securedArray,
						'setfixed',
						$cmdKey,
						$this->controlData->getMode(),
						$dataObj->inError,
						$token
					);
				} else if ($sFK == 'DELETE' || $sFK == 'REFUSE') {
					if (!$this->tca->TCA['ctrl']['delete'] || $this->conf['forceFileDelete']) {
						// If the record is fully deleted... then remove the image attached.
						$dataObj->deleteFilesFromRecord($uid);
					}
					$res = $this->cObj->DBgetDelete($theTable, $uid, TRUE);
					$dataObj->deleteMMRelations($theTable, $uid, $row);
				} else {
					if ($theTable == 'fe_users') {
						if ($this->conf['create.']['allowUserGroupSelection']) {
							$originalGroups = is_array($origUsergroup)
								? $origUsergroup
								: t3lib_div::trimExplode(',', $origUsergroup, TRUE);
							$overwriteGroups = t3lib_div::trimExplode(
								',',
								$this->conf['create.']['overrideValues.']['usergroup'],
								TRUE
							);
							$remainingGroups = array_diff($originalGroups, $overwriteGroups);
							$groupsToAdd = t3lib_div::trimExplode(',', $setfixedUsergroup, TRUE);
							$finalGroups = array_merge(
								$remainingGroups, $groupsToAdd
							);
							$row['usergroup'] = implode(',', array_unique($finalGroups));
						}
					}

						// Hook: first we initialize the hooks
					$hookObjectsArr = array();
					if (is_array ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$this->controlData->getExtKey()][$this->controlData->getPrefixId()]['confirmRegistrationClass'])) {
						foreach  ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$this->controlData->getExtKey()][$this->controlData->getPrefixId()]['confirmRegistrationClass'] as $classRef) {
							$hookObjectsArr[] = &t3lib_div::getUserObj($classRef);
						}
					}
						// Hook: confirmRegistrationClass_preProcess
					foreach($hookObjectsArr as $hookObj)    {
						if (method_exists($hookObj, 'confirmRegistrationClass_preProcess')) {
							$hookObj->confirmRegistrationClass_preProcess($row, $this);
						}
					}
					$newFieldList = implode(array_intersect(t3lib_div::trimExplode(',', $dataObj->fieldList), t3lib_div::trimExplode(',', implode($fieldArr, ','), 1)), ',');

					$res = $this->cObj->DBgetUpdate($theTable, $uid, $row, $newFieldList, TRUE);
					$currArr = $origArray;
					$modArray = array();
					$currArr = $this->tca->modifyTcaMMfields($currArr,$modArray);
					$row = array_merge($row, $modArray);
					$pObj->userProcess_alt($this->conf['setfixed.']['userFunc_afterSave'],$this->conf['setfixed.']['userFunc_afterSave.'],array('rec'=>$currArr, 'origRec'=>$origArray));

						// Hook: confirmRegistrationClass_postProcess
					foreach($hookObjectsArr as $hookObj)    {
						if (method_exists($hookObj, 'confirmRegistrationClass_postProcess')) {
							$hookObj->confirmRegistrationClass_postProcess($row, $this);
						}
					}
				}

				// Outputting template
				if (
					$theTable == 'fe_users' &&
					in_array($sFK, array('APPROVE','ENTER','LOGIN'))	// LOGIN is here only for an error case
				)	{
					$this->marker->addGeneralHiddenFieldsMarkers($markerArray, 'login', $token);
					$this->marker->addMd5LoginMarkers($markerArray, $dataArray, $this->controlData->getUseMd5Password());
					$this->marker->setArray($markerArray);
				} else {
					$this->marker->addGeneralHiddenFieldsMarkers($markerArray, 'setfixed', $token);
				}

				if ($sFK == 'EDIT')	{
					// nothing
				} else {
					if ($this->conf['enableAdminReview'] && $sFK == 'APPROVE' && !$row['by_invitation']) {
						$setfixedSuffix .= '_REVIEW';
					}
					$subpartMarker = '###TEMPLATE_' . SETFIXED_PREFIX . 'OK_' . $setfixedSuffix . '###';
					$content = $this->display->getPlainTemplate(
						$templateCode,
						$subpartMarker,
						$markerArray,
						$origArray,
						$row,
						$securedArray,
						FALSE
					);

					if (!$content) {
						$subpartMarker = '###TEMPLATE_' . SETFIXED_PREFIX .'OK###';

						$content = $this->display->getPlainTemplate(
							$templateCode,
							$subpartMarker,
							$markerArray,
							$origArray,
							$row,
							$securedArray
						);
					}

					if (
						($this->conf['email.']['SETFIXED_REFUSE'] || $this->conf['enableEmailConfirmation'] || $this->conf['infomail'])
					)	{
						// Compiling email
						$errorContent = $this->email->compile(
							SETFIXED_PREFIX . $setfixedSuffix,
							$theTable,
							array($row),
							array($origArray),
							$securedArray,
							$origArray[$this->conf['email.']['field']],
							$markerArray,
							'setfixed',
							$cmdKey,
							$templateCode,
							$this->data->inError,
							$this->conf['setfixed.']
						);
					}

					if ($errorContent)	{
						$content = $errorContent;
					} else if ($theTable == 'fe_users') {

							// If applicable, send admin a request to review the registration request
						if ($this->conf['enableAdminReview'] && $sFK == 'APPROVE' && !$row['by_invitation']) {

							$errorContent = $this->email->compile(
								SETFIXED_PREFIX . 'REVIEW',
								$theTable,
								array($row),
								array($origArray),
								$securedArray,
								$origArray[$this->conf['email.']['field']],
								$markerArray,
								'setfixed',
								$cmdKey,
								$templateCode,
								$this->data->inError,
								$this->conf['setfixed.']
							);
						}

						if ($errorContent)	{
							$content = $errorContent;
								// Auto-login on confirmation
						} else if (
							$this->conf['enableAutoLoginOnConfirmation'] &&
							($sFK == 'APPROVE' || $sFK == 'ENTER')
						) {
							$pObj->login($currArr);
							exit;
						}
					}
				}
			} else {
				$content = $this->display->getPlainTemplate(
					$templateCode,
					'###TEMPLATE_SETFIXED_FAILED###',
					$markerArray,
					$origArray,
					'',
					''
				);
			}
		}
		return $content;
	}	// processSetFixed





	/**
	* Computes the setfixed url's
	*
	* @param array  $markerArray: the input marker array
	* @param array  $setfixed: the TS setup setfixed configuration
	* @param array  $r: the record row
	* @return void
	*/
	function computeUrl ($cmdKey, &$markerArray, $setfixed, $r, $theTable) {
		global $TSFE;

		$prefixId = $this->controlData->getPrefixId();

		if ($this->controlData->getSetfixedEnabled() && is_array($setfixed) ) {
			$setfixedpiVars = array();
			$authObj = &t3lib_div::getUserObj('&tx_srfeuserregister_auth');
			$tablesObj = &t3lib_div::getUserObj('&tx_srfeuserregister_lib_tables');
			$addressObj = $tablesObj->get('address');
			$userGroupObj = &$addressObj->getFieldObj('usergroup');

			if ($theTable != 'fe_users' && $theKey == 'EDIT' ) {
				$noFeusersEdit = TRUE;
			} else {
				$noFeusersEdit = FALSE;
			}

			foreach($setfixed as $theKey => $data) {

				if (strstr($theKey, '.') ) {
					$theKey = substr($theKey, 0, -1);
				}
				unset($setfixedpiVars);

				$setfixedpiVars[$prefixId . '%5BrU%5D'] = $r['uid'];
				$fieldList = $data['_FIELDLIST'];
				$fieldListArray = t3lib_div::trimExplode(',', $fieldList);

				foreach ($fieldListArray as $fieldname)	{

					if (isset($data[$fieldname]))	{
						$r[$fieldname] = $data[$fieldname];
					}
				}

				if ($noFeusersEdit)	{
					$cmd = $pidCmd = 'edit';
					if( $this->conf['edit.']['setfixed'] ) {
						$bSetfixedHash = TRUE;
					} else {
						$bSetfixedHash = FALSE;
						$setfixedpiVars[$prefixId . '%5BaC%5D'] = $authObj->authCode($r, $fieldList);
					}
				} else {
					$cmd = 'setfixed';
					$pidCmd = ($this->controlData->getCmd() == 'invite' ? 'confirmInvitation' : 'confirm');
					$setfixedpiVars[$prefixId . '%5BsFK%5D'] = $theKey;
					$bSetfixedHash = TRUE;
					if (isset($r['chalvalue']))	{
						$setfixedpiVars[$prefixId . '%5Bcv%5D'] = $r['chalvalue'];
					}
				}

				if ($bSetfixedHash)	{
					$setfixedpiVars[$prefixId . '%5BaC%5D'] = $authObj->setfixedHash($r, $fieldList);
				}
				$setfixedpiVars[$prefixId . '%5Bcmd%5D'] = $cmd;
				if (is_array($data) ) {
					foreach($data as $fieldName => $fieldValue) {
						$setfixedpiVars['fD%5B' . $fieldName . '%5D'] = rawurlencode($fieldValue);
					}
				}
				$linkPID = $this->controlData->getPID($pidCmd);

				if (t3lib_div::_GP('L') && !t3lib_div::inList($GLOBALS['TSFE']->config['config']['linkVars'], 'L')) {
					$setfixedpiVars['L'] = t3lib_div::_GP('L');
				}

				if ($this->conf['useShortUrls']) {

					$thisHash = $this->storeFixedPiVars($setfixedpiVars);
					$setfixedpiVars = array($prefixId . '%5BregHash%5D' => $thisHash);
				}
				$conf = array();
				$conf['disableGroupAccessCheck'] = TRUE;
				$confirmType = (t3lib_div::testInt($this->conf['confirmType']) ? intval($this->conf['confirmType']) : $TSFE->type);
				$url = tx_div2007_alpha::getTypoLink_URL_fh002($this->cObj, $linkPID . ',' . $confirmType, $setfixedpiVars,'',$conf);
				$bIsAbsoluteURL = ((strncmp($url,'http://',7) == 0) || (strncmp($url,'https://',8) == 0));
				$markerKey = '###SETFIXED_' . $this->cObj->caseshift($theKey,'upper') . '_URL###';
				$url = ($bIsAbsoluteURL ? '' : $this->controlData->getSiteUrl()) . ltrim($url,'/');
				$markerArray[$markerKey] = str_replace(array('[',']'), array('%5B', '%5D'), $url);
			}	// foreach
		}
	}	// computeUrl


	/**
		*  Store the setfixed vars and return a replacement hash
		*/
	function storeFixedPiVars ($vars) {
		global $TYPO3_DB;

			// create a unique hash value
		$regHash_array = t3lib_div::cHashParams(t3lib_div::implodeArrayForUrl('',$vars));
		$regHash_calc = t3lib_div::shortMD5(serialize($regHash_array),20);
			// and store it with a serialized version of the array in the DB
		$res = $TYPO3_DB->exec_SELECTquery('md5hash','cache_md5params','md5hash='.$TYPO3_DB->fullQuoteStr($regHash_calc,'cache_md5params'));
		if (!$TYPO3_DB->sql_num_rows($res))  {
			$insertFields = array (
				'md5hash' => $regHash_calc,
				'tstamp' => time(),
				'type' => 99,
				'params' => serialize($vars)
			);
			$TYPO3_DB->exec_INSERTquery('cache_md5params',$insertFields);
		}
		$TYPO3_DB->sql_free_result($res);
		return $regHash_calc;
	}	// storeFixedPiVars
}


if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/control/class.tx_srfeuserregister_setfixed.php'])  {
  include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/control/class.tx_srfeuserregister_setfixed.php']);
}
?>
