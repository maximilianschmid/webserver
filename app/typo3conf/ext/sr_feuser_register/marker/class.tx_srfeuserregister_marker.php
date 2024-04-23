<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007-2010 Stanislas Rolland <stanislas.rolland(arobas)sjbr.ca>
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
 * marker functions
 *
 * $Id: class.tx_srfeuserregister_marker.php 34954 2010-06-26 21:04:35Z franzholz $
 *
 * @author	Kasper Skaarhoj <kasper2007@typo3.com>
 * @author	Stanislas Rolland <stanislas.rolland(arobas)sjbr.ca>
 * @author	Franz Holzinger <franz@ttproducts.de>
 *
 * @package TYPO3
 * @subpackage sr_feuser_register
 *
 *
 */


define('SAVED_SUFFIX', '_SAVED');
define('SETFIXED_PREFIX', 'SETFIXED_');


class tx_srfeuserregister_marker {
	var $pibase;
	var $conf = array();
	var $config = array();
	var $data;
	var $control;
	var $controlData;
	var $urlObj;
	var $langObj;
	var $tca;
	var $previewLabel;
	var $staticInfo;
	var $markerArray = array();
	var $cObj;
	var $buttonLabelsList;
	var $otherLabelsList;
	var $dataArray; // temporary array of data


	function init (&$pibase, &$conf, &$config, $data, &$tca, &$langObj, &$controlData, &$urlObj, $uid, $token)	{
		global $TSFE;

		$this->pibase = &$pibase;
		$this->conf = &$conf;
		$this->config = &$config;
		$this->data = &$data;
		$this->tca = &$tca;
		$this->langObj = &$langObj;
		$this->cObj = &$pibase->cObj;
		$this->controlData = &$controlData;
		$this->urlObj = &$urlObj;

		if (t3lib_extMgm::isLoaded(STATIC_INFO_TABLES_EXTkey)) {
			$this->staticInfo = &t3lib_div::getUserObj('&tx_staticinfotables_pi1');
		}
		$markerArray = array();

			// prepare for character set settings
		if ($TSFE->metaCharset) {
			$charset = $TSFE->csConvObj->parse_charset($TSFE->metaCharset);
		} else {
			$charset = 'iso-8859-1'; // charset to be used in emails and form conversions
		}
		$prefixId = $this->controlData->getPrefixId();
		$extKey = $this->controlData->getExtKey();
		$markerArray['###CHARSET###'] = $charset;
		$markerArray['###PREFIXID###'] = $prefixId;

			// Setting URL, HIDDENFIELDS and signature markers
		$this->addURLMarkers($markerArray, $this->controlData->getBackURL(), $uid, $token);

		if (is_array ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$extKey][$prefixId]['registrationProcess'])) {
			foreach  ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$extKey][$prefixId]['registrationProcess'] as $classRef) {
				$hookObj= &t3lib_div::getUserObj($classRef);
				if (method_exists($hookObj, 'addGlobalMarkers')) {
					$hookObj->addGlobalMarkers($markerArray, $this);
				}
			}
		}

		if (is_object($this->data->freeCap)) {
			$captchaMarkerArray = $this->data->freeCap->makeCaptcha();
		} else {
			$captchaMarkerArray = array('###SR_FREECAP_NOTICE###' => '', '###SR_FREECAP_CANT_READ###' => '', '###SR_FREECAP_IMAGE###' => '', '###SR_FREECAP_ACCESSIBLE###' => '');
		}
		$markerArray = array_merge($markerArray, $captchaMarkerArray);
		$this->setArray($markerArray);

			// Button labels
		$buttonLabelsList = 'register,confirm_register,back_to_form,update,confirm_update,enter,confirm_delete,cancel_delete,update_and_more,password_forgotten';

		$this->setButtonLabelsList($buttonLabelsList);

		$otherLabelsList = 'yes,no,password_again,tooltip_password_again,tooltip_invitation_password_again,click_here_to_register,tooltip_click_here_to_register,click_here_to_edit,tooltip_click_here_to_edit,click_here_to_delete,tooltip_click_here_to_delete'.
		',copy_paste_link,enter_account_info,enter_invitation_account_info,required_info_notice,excuse_us,'.
			',tooltip_login_username,tooltip_login_password,'.
			',registration_problem,registration_sorry,registration_clicked_twice,registration_help,kind_regards,kind_regards_cre,kind_regards_del,kind_regards_ini,kind_regards_inv,kind_regards_upd'.
			',v_verify_before_create,v_verify_invitation_before_create,v_verify_before_update,v_really_wish_to_delete,v_edit_your_account'.
			',v_dear,v_email_lost_password,v_infomail_dear,v_infomail_lost_password_confirm,v_infomail_lost_password_subject,v_now_enter_your_username,v_notification'.
			',v_registration_created,v_registration_created_subject,v_registration_created_message1,v_registration_created_message2,v_registration_created_message3'.
			',v_to_the_administrator'.
			',v_registration_review_subject,v_registration_review_message1,v_registration_review_message2,v_registration_review_message3'.
			',v_please_confirm,v_your_account_was_created,v_your_account_was_created_nomail,v_follow_instructions1,v_follow_instructions2,v_follow_instructions_review1,v_follow_instructions_review2'.
			',v_invitation_confirm,v_invitation_account_was_created,v_invitation_instructions1'.
			',v_registration_initiated,v_registration_initiated_subject,v_registration_initiated_message1,v_registration_initiated_message2,v_registration_initiated_message3,v_registration_initiated_review1,v_registration_initiated_review2'.
			',v_registration_invited,v_registration_invited_subject,v_registration_invited_message1,v_registration_invited_message2'.
			',v_registration_infomail_message1'.
			',v_registration_confirmed,v_registration_confirmed_subject,v_registration_confirmed_message1,v_registration_confirmed_message2,v_registration_confirmed_review1,v_registration_confirmed_review2'.
			',v_registration_cancelled,v_registration_cancelled_subject,v_registration_cancelled_message1,v_registration_cancelled_message2'.
			',v_registration_accepted,v_registration_accepted_subject,v_registration_accepted_message1,v_registration_accepted_message2'.
			',v_registration_refused,v_registration_refused_subject,v_registration_refused_message1,v_registration_refused_message2'.
			',v_registration_accepted_subject2,v_registration_accepted_message3,v_registration_accepted_message4'.
			',v_registration_refused_subject2,v_registration_refused_message3,v_registration_refused_message4'.
			',v_registration_entered_subject,v_registration_entered_message1,v_registration_entered_message2'.
			',v_registration_updated,v_registration_updated_subject,v_registration_updated_message1'.
			',v_registration_deleted,v_registration_deleted_subject,v_registration_deleted_message1,v_registration_deleted_message2';
		$this->setOtherLabelsList($otherLabelsList);
	}


	function getButtonLabelsList ()	{
		return $this->buttonLabelsList;
	}


	function setButtonLabelsList (&$buttonLabelsList)	{
		$this->buttonLabelsList = $buttonLabelsList;
	}


	function getOtherLabelsList ()	{
		return $this->otherLabelsList;
	}


	function setOtherLabelsList (&$otherLabelsList)	{
		$this->otherLabelsList = $otherLabelsList;
	}


	function addOtherLabelsList (&$otherLabelsList)	{
		if ($otherLabelsList != '')	{

			$formerOtherLabelsList = $this->getOtherLabelsList();

			if ($formerOtherLabelsList != '')	{
				$newOtherLabelsList = $formerOtherLabelsList . ',' . $otherLabelsList;
				$newOtherLabelsList = t3lib_div::uniqueList($newOtherLabelsList);
				$this->setOtherLabelsList($newOtherLabelsList);
			}
		}
	}


	function getArray ()	{
		return $this->markerArray;
	}


	function setArray ($param, $value = '')	{
		if (is_array($param))	{
			$this->markerArray = $param;
		} else {
			$this->markerArray[$param] = $value;
		}
	}


	function getPreviewLabel ()	{
		return $this->previewLabel;
	}


	function setPreviewLabel ($label)	{
		$this->previewLabel = $label;
	}


	// enables the usage of {data:<field>}, {tca:<field>} und {meta:<stuff>} in the label markers
	function replaceVariables ($matches) {
		$rc = '';
		switch ($matches[1]) {
			case 'data':
				$dataArray = $this->getReplaceData();
				$row = $dataArray['row'];
				$rc = $row[$matches[2]];
			break;
			case 'tca':
				if (!is_array($this->tmpTcaMarkers)) {
					$this->tmpTcaMarkers = array();
					$dataArray = $this->getReplaceData();
					$row = $dataArray['row'];
					$cmd = $this->controlData->getCmd();
					$cmdKey = $this->controlData->getCmdKey();
					$theTable = $this->controlData->getTable();
					$this->tca->addTcaMarkers($this->tmpTcaMarkers, $row, $this->data->getOrigArray(), $cmd, $cmdKey, $theTable, TRUE, '', FALSE);
				}
				$rc = $this->tmpTcaMarkers['###TCA_INPUT_'.$matches[2].'###'];
			break;
			case 'meta':
				if ($matches[2] == 'title') {
					$rc = $this->controlData->getPidTitle();
				}
			break;
		}
		return $rc;
	}


	function setReplaceData ($data)	{
		$this->dataArray['row'] = $data['row'];
	}


	function getReplaceData ()	{
		return $this->dataArray;
	}


	/**
	* Sets the error markers to 'no error'
	*
	* @param string command key
	* @param array  Array with key/values being marker-strings/substitution values.
	* @return void  all initialization done directly on array $this->dataArray
	*/
	function setNoError ($cmdKey, &$markContentArray) {
		if (is_array($this->conf[$cmdKey.'.']['evalValues.'])) {
			foreach($this->conf[$cmdKey.'.']['evalValues.'] as $theField => $theValue) {
				$markContentArray['###EVAL_ERROR_FIELD_'.$theField.'###'] = '<!--no error-->';
			}
		}
	} // setNoError


	/**
	* Gets the field name needed for the name attribute of the input HTML tag.
	*
	* @param string name of the table
	* @param string name of the field
	* @return string  FE[tablename][fieldname]  ... POST var to transmit the entries with the form
	*/
	function getFieldName ($theTable, $theField) {
		$rc = 'FE['.$theTable.']['.$theField.']';
		return $rc;
	}


	/**
	* Adds language-dependent label markers
	*
	* @param array  $markerArray: the input marker array
	* @param array  $row: the record array
	* @param array  $origRow: the original record array as stored in the database
	* @param array  $requiredArray: the required fields array
	* @param array  info fields
	* @param array  $TCA[tablename]['columns']
	* @return void
	*/
	function addLabelMarkers (&$markerArray, $theTable, $row, $origRow, $securedArray, $keepFields, $requiredArray, $infoFields, &$tcaColumns, $bChangesOnly=FALSE) {
		global $TSFE;

		if (is_array($securedArray))	{
			foreach ($securedArray as $field => $value)	{
				$row[$field] = $securedArray[$field];
			}
		}

		if (!$markerArray)	{
			$markerArray = $this->getArray();
		}

		// Data field labels
		$infoFieldArray = t3lib_div::trimExplode(',', $infoFields, 1);
		$charset = $TSFE->renderCharset;
		$specialFieldArray = t3lib_div::trimExplode(',',$this->data->getSpecialFieldList(),1);

		if ($specialFieldArray[0] != '')	{
			$infoFieldArray = array_merge($infoFieldArray, $specialFieldArray);
			$requiredArray = array_merge($requiredArray, $specialFieldArray);
		}

		foreach($infoFieldArray as $theField) {
			$markerkey = $this->cObj->caseshift($theField,'upper');
			$bValueChanged = FALSE;
			if (isset($row[$theField]) && isset($origRow[$theField]))	{
				if (is_array($row[$theField]) && is_array($origRow[$theField]))	{
					$diffArray = array_diff($row[$theField], $origRow[$theField]);
					if (count($diffArray))	{
						$bValueChanged = TRUE;
					}
				} else {
					if ($row[$theField] != $origRow[$theField])	{
						$bValueChanged = TRUE;
					}
				}
			}

			if (!$bChangesOnly || $bValueChanged || in_array($theField, $keepFields))	{
				$label = $this->langObj->getLL($theTable.'.'.$theField);
				if (empty($label))	{
					$label = $this->langObj->getLL($theField);
				}
				$label = (empty($label) ? $this->langObj->getLLFromString($tcaColumns[$theField]['label']) : $label);
				$label = htmlspecialchars($label,ENT_QUOTES,$charset);
			} else {
				$label = '';
			}
			$markerArray['###LABEL_'.$markerkey.'###'] = $label;
			$markerArray['###TOOLTIP_'.$markerkey.'###'] = $this->langObj->getLL('tooltip_' . $theField);
			$label = $this->langObj->getLL('tooltip_invitation_' . $theField);
			$label = htmlspecialchars($label,ENT_QUOTES,$charset);
			$markerArray['###TOOLTIP_INVITATION_'.$markerkey.'###'] = $label;
			$colConfig = $tcaColumns[$theField]['config'];

			if ($colConfig['type'] == 'select' && $colConfig['items'])	{
				$colContent = '';
				$markerArray['###FIELD_'.$markerkey.'_CHECKED###'] = '';
				$markerArray['###LABEL_'.$markerkey.'_CHECKED###'] = '';
				$markerArray['###POSTVARS_'.$markerkey.'###'] = '';
				$fieldArray = t3lib_div::trimExplode(',', $row[$theField]);
				foreach ($fieldArray as $key => $value) {
					$label = $this->langObj->getLLFromString($colConfig['items'][$value][0]);
					$markerArray['###FIELD_'.$markerkey.'_CHECKED###'] .= '- '.$label.'<br />';
					$label = $this->langObj->getLLFromString($colConfig['items'][$value][0]);
					$markerArray['###LABEL_'.$markerkey.'_CHECKED###'] .= '- '.$label.'<br />';
					$markerArray['###POSTVARS_'.$markerkey.'###'] .= chr(10).'	<input type="hidden" name="FE[fe_users]['.$theField.']['.$key.']" value ="'.$value.'" />';
				}
			} else if ($colConfig['type'] == 'check') {
				$markerArray['###FIELD_'.$markerkey.'_CHECKED###'] = ($row[$theField]) ? 'checked' : '';
				$markerArray['###LABEL_'.$markerkey.'_CHECKED###'] = ($row[$theField])?$this->langObj->getLL('yes'):$this->langObj->getLL('no');
			}
			if (in_array(trim($theField), $requiredArray)) {

				$markerArray['###REQUIRED_'.$markerkey.'###'] = $this->cObj->cObjGetSingle($this->conf['displayRequired'],$this->conf['displayRequired.'],$this->pibase->extKey); // default: '<span>*</span>';
				$markerArray['###MISSING_'.$markerkey.'###'] = $this->langObj->getLL('missing_'.$theField);
				$markerArray['###MISSING_INVITATION_'.$markerkey.'###'] = $this->langObj->getLL('missing_invitation_'.$theField);
			} else {
				$markerArray['###REQUIRED_'.$markerkey.'###'] = '';
				$markerArray['###MISSING_'.$markerkey.'###'] = '';
				$markerArray['###MISSING_INVITATION_'.$markerkey.'###'] = '';
			}
			$markerArray['###NAME_'.$markerkey.'###'] = $this->getFieldName($theTable,$theField);
		}
		$markerArray['###NAME_PASSWORD_AGAIN###'] = $this->getFieldName($theTable,'password_again');

		$buttonLabels = t3lib_div::trimExplode(',', $this->getButtonLabelsList(), 1);
		foreach($buttonLabels as $labelName) {
			if ($labelName)	{
				$markerArray['###LABEL_BUTTON_'.$this->cObj->caseshift($labelName,'upper').'###'] = $this->langObj->getLL('button_'.$labelName);
			}
		}

		if ($this->conf['salutation'] == 'informal' && $row['first_name'] != '')	{
			$name = $row['first_name'];
		} else {
			$name = ($row['name'] ? $row['name'] : $row['first_name'] . ($row['middle_name'] != '' ? ' ' . $row['middle_name'] : '' ) . ' ' . $row['last_name']);
			if ($name == '')	{
				$name = 'id(' . $row['uid'] . ')';
			}
		}

		$this->tmpTcaMarkers = NULL; // reset function replaceVariables
		$otherLabelsList = $this->getOtherLabelsList();

		if (isset($this->conf['extraLabels']) && $this->conf['extraLabels'] != '') {
			$otherLabelsList .= ',' . $this->conf['extraLabels'];
		}
		$otherLabels = t3lib_div::trimExplode(',', $otherLabelsList, 1);
		$dataArray = array();
		$dataArray['row'] = $row;
		$this->setReplaceData($dataArray);
		$username = ($row['username'] != '' ? $row['username'] : $row['email']);

		foreach($otherLabels as $labelName) {
			$langText = $this->langObj->getLL($labelName);
			$label = sprintf($langText, $this->controlData->getPidTitle(), $username, $name, $row['email'], $row['password']);
			$label = preg_replace_callback('/{([a-z_]+):([a-z_]+)}/', array(&$this, 'replaceVariables'), $label);
			$markerkey = $this->cObj->caseshift($labelName,'upper');
			$markerArray['###LABEL_'.$markerkey.'###'] = $label;
		}
	}	// addLabelMarkers


	function setRow ($row)	{
		$this->row = $row;
	}


	function getRow ($row)	{
		return $this->row;
	}


	/**
	* Adds URL markers to a $markerArray
	*
	* @param array  $markerArray: the input marker array
	* @param string auth code
	* @return void
	*/
	function addURLMarkers (&$markerArray, $backUrl, $uid, $token) {

		$this->checkToken($token);
		if (!$markerArray)	{
			$markerArray = $this->getArray();
		}
		$vars = array();
		$unsetVarsList = 'mode,pointer,sort,sword,backURL,submit,rU,aC,sFK,doNotSave,preview';
		$unsetVars = t3lib_div::trimExplode(',', $unsetVarsList);
		$unsetVars['cmd'] = 'cmd';
		$unsetVarsAll = $unsetVars;
		$unsetVarsAll[] = 'token';
		$formUrl = $this->urlObj->get('', $GLOBALS['TSFE']->id.','.$GLOBALS['TSFE']->type, $vars, $unsetVarsAll);

		unset($unsetVars['cmd']);
		$markerArray['###FORM_URL###'] = $formUrl;
		$theTable = $this->controlData->getTable();
		$form = $this->pibase->pi_getClassName($theTable.'_form');
		$markerArray['###FORM_NAME###'] = $form; // $this->conf['formName'];

		$ac = $this->controlData->getFeUserData('aC');
		if ($ac)	{
			$vars['aC'] = $ac;
		}
		$vars['cmd'] = $this->controlData->getCmd();
		$vars['token'] = $token;
		$vars['backURL'] = rawurlencode($this->urlObj->get('', $GLOBALS['TSFE']->id.','.$GLOBALS['TSFE']->type, $vars));
		$vars['cmd'] = 'delete';
		$vars['rU'] = $uid;
		$vars['preview'] = '1';

		$markerArray['###DELETE_URL###'] = $this->urlObj->get('', $this->controlData->getPid('edit').','.$GLOBALS['TSFE']->type, $vars);

		$vars['backURL'] = rawurlencode($formUrl);
		$vars['cmd'] = 'create';

		$url = $this->urlObj->get('', $this->controlData->getPid('register').','.$GLOBALS['TSFE']->type, $vars, $unsetVars);
		$markerArray['###REGISTER_URL###'] = $url;

		$unsetVarsList = 'mode,pointer,sort,sword,backURL,submit,doNotSave,preview';
		$unsetVars = t3lib_div::trimExplode(',', $unsetVarsList);

		$vars['cmd'] = 'login';
		$markerArray['###LOGIN_FORM###'] = $this->urlObj->get('', $this->controlData->getPid('login').','.$GLOBALS['TSFE']->type, $vars, $unsetVars);

		$vars['cmd'] = 'infomail';
		$markerArray['###INFOMAIL_URL###'] = $this->urlObj->get('', $this->controlData->getPid('infomail').','.$GLOBALS['TSFE']->type, $vars, $unsetVars);

		$vars['cmd'] = 'edit';

		$markerArray['###EDIT_URL###'] = $this->urlObj->get('', $this->controlData->getPid('edit').','.$GLOBALS['TSFE']->type, $vars, $unsetVars);
		$markerArray['###THE_PID###'] = $this->controlData->getPid();
		$markerArray['###THE_PID_TITLE###'] = $this->controlData->getPidTitle();
		$markerArray['###BACK_URL###'] = $backUrl;
		$markerArray['###SITE_NAME###'] = $this->conf['email.']['fromName'];
		$markerArray['###SITE_URL###'] = $this->controlData->getSiteUrl();
		$markerArray['###SITE_WWW###'] = t3lib_div::getIndpEnv('TYPO3_HOST_ONLY');
		$markerArray['###SITE_EMAIL###'] = $this->conf['email.']['from'];
	}	// addURLMarkers


	/**
	* Adds URL markers to a $markerArray
	*
	* @param array  $markerArray: the input marker array
	* @param string auth code
	* @return void
	*/
	function addGeneralHiddenFieldsMarkers (&$markerArray, $cmd, $token) {

		$localMarkerArray = array();
		$authObj = &t3lib_div::getUserObj('&tx_srfeuserregister_auth');
		$authCode = $authObj->getAuthCode();

		$prefixId = $this->controlData->getPrefixId();
		$backUrl = $this->controlData->getBackURL();

		$localMarkerArray['###HIDDENFIELDS###'] = $markerArray['###HIDDENFIELDS###'] . ($cmd ? '<input type="hidden" name="' . $prefixId . '[cmd]" value="' . $cmd . '" />':'');
		$localMarkerArray['###HIDDENFIELDS###'] .= chr(10) . ($authCode?'<input type="hidden" name="' . $prefixId . '[aC]" value="' . $authCode . '" />':'');
		$localMarkerArray['###HIDDENFIELDS###'] .= chr(10) . ($backUrl?'<input type="hidden" name="' . $prefixId . '[backURL]" value="' . htmlspecialchars($backUrl) . '" />':'');
		$this->addFormToken($localMarkerArray, $token);

		$markerArray = array_merge($markerArray, $localMarkerArray);
	}


	/**
		* Adds Static Info markers to a marker array
		*
		* @param array  $markerArray: the input marker array
		* @param array  $row: the table record
		* @return void
		*/
	function addStaticInfoMarkers (&$markerArray, $row='', $viewOnly=FALSE) {
		if (!$markerArray)	{
			$markerArray = $this->getArray();
		}

		if (is_object($this->staticInfo))	{
			$cmd = $this->controlData->getCmd();
			$theTable = $this->controlData->getTable();
			if ($this->controlData->getMode() == MODE_PREVIEW || $viewOnly) {
				$markerArray['###FIELD_static_info_country###'] = $this->staticInfo->getStaticInfoName('COUNTRIES', is_array($row)?$row['static_info_country']:'');
				$markerArray['###FIELD_zone###'] = $this->staticInfo->getStaticInfoName('SUBDIVISIONS', is_array($row)?$row['zone']:'', is_array($row)?$row['static_info_country']:'');
				if (!$markerArray['###FIELD_zone###'] ) {
					$markerArray['###HIDDENFIELDS###'] .= '<input type="hidden" name="FE['.$theTable.'][zone]" value="" />';
				}
				$markerArray['###FIELD_language###'] = $this->staticInfo->getStaticInfoName('LANGUAGES', is_array($row)?$row['language']:'');
			} else {
				if ($this->conf['templateStyle'] == 'css-styled') {
					$idCountry = $this->pibase->pi_getClassName('static_info_country');
					$titleCountry = $this->langObj->getLL('tooltip_' . (($cmd == 'invite')?'invitation_':'')  . 'static_info_country');
					$idZone = $this->pibase->pi_getClassName('zone');
					$titleZone = $this->langObj->getLL('tooltip_' . (($cmd == 'invite')?'invitation_':'')  . 'zone');
					$idLanguage = $this->pibase->pi_getClassName('language');
					$titleLanguage = $this->langObj->getLL('tooltip_' . (($cmd == 'invite')?'invitation_':'')  . 'language');
				}
				$selected = (is_array($row) && isset($row['static_info_country']) ? $row['static_info_country'] : array());
				if (isset($this->conf['where.']) && is_array($this->conf['where.']))	{
					$where = $this->conf['where.']['static_countries'];
				}
				$markerArray['###SELECTOR_STATIC_INFO_COUNTRY###'] = $this->staticInfo->buildStaticInfoSelector(
					'COUNTRIES',
					'FE['.$theTable.']'.'[static_info_country]',
					'',
					$selected,
					'',
					$this->conf['onChangeCountryAttribute'],
					$idCountry,
					$titleCountry,
					$where,
					'',
					$this->conf['useLocalCountry']
				);
				$markerArray['###SELECTOR_ZONE###'] =
					$this->staticInfo->buildStaticInfoSelector(
						'SUBDIVISIONS',
						'FE['.$theTable.']'.'[zone]',
						'',
						is_array($row)?$row['zone']:'',
						is_array($row)?$row['static_info_country']:'',
						'',
						$idZone,
						$titleZone
					);
				if (!$markerArray['###SELECTOR_ZONE###'] ) {
					$markerArray['###HIDDENFIELDS###'] .= '<input type="hidden" name="FE['.$theTable.'][zone]" value="" />';
				}

				$markerArray['###SELECTOR_LANGUAGE###'] =
					$this->staticInfo->buildStaticInfoSelector(
					'LANGUAGES',
					'FE['.$theTable.']'.'[language]',
					'',
					is_array($row)?$row['language']:'',
					'',
					'',
					$idLanguage,
					$titleLanguage
				);
			}
		}
	}	// addStaticInfoMarkers


	/**
		* Adds md5 password create/edit form markers to a marker array
		*
		* @param array  $markerArray: the input marker array
		* @return void
		*/
	function addMd5EventsMarkers (&$markerArray,$bEncryptMd5,$useMd5Password) {

		if (!$markerArray)	{
			$markerArray = $this->getArray();
		}
		if ($useMd5Password) {
			if (!$this->controlData->getJSmd5Added())	{
				$GLOBALS['TSFE']->additionalHeaderData['MD5_script'] = '<script type="text/javascript" src="typo3/md5.js"></script>';
				$GLOBALS['TSFE']->JSCode .= $this->getMD5Submit($bEncryptMd5);
				$this->controlData->setJSmd5Added(TRUE);
			}
			$markerArray['###FORM_ONSUBMIT###'] = 'onsubmit="return enc_form(this);"';
			$markerArray['###PASSWORD_ONCHANGE###'] = ($bEncryptMd5 ? 'onchange="pw_change=1; return true;"' : '');
		} else {
			$markerArray['###FORM_ONSUBMIT###'] = '';
			$markerArray['###PASSWORD_ONCHANGE###'] = '';
		}
	}	// addMd5EventsMarkers


	/**
		* Adds md5 password login form markers to a marker array
		*
		* @param array  $markerArray: the input marker array
		* @return void
		*/
	function addMd5LoginMarkers (&$markerArray, $dataArray, $useMd5Password) {

		if (!$markerArray)	{
			$markerArray = $this->getArray();
		}
		$onSubmit = '';
		$extraHidden = '';
		if ($useMd5Password) {
				// Hook used by kb_md5fepw extension by Kraft Bernhard <kraftb@gmx.net>
				// This hook allows to call User JS functions.
				// The methods should also set the required JS functions to get included

			list($onSub, $hid) = $this->loginFormOnSubmit($dataArray);
			$onSubmitArray = array();
			$extraHiddenArray = array();
			$onSubmitArray[] = $onSub;
			$extraHiddenArray[] = $hid;
			if (count($onSubmitArray)) {
				$onSubmit = implode('; ', $onSubmitArray).'; return true;';
				$onSubmit = strlen($onSubmit) ? ' onsubmit="'.$onSubmit.'"' : '';
				$extraHidden = implode(chr(10), $extraHiddenArray);
			}
		}
		$markerArray['###FORM_ONSUBMIT###'] = $onSubmit;
		$prefixId = $this->controlData->getPrefixId();

		$markerArray['###HIDDENFIELDS###'] .= '<input type="hidden" name="' . $prefixId . '[sFK]" value="LOGIN" />';
		$markerArray['###HIDDENFIELDS###'] .= $extraHidden;
		if (!$this->controlData->getJSmd5Added())	{
			$GLOBALS['TSFE']->additionalHeaderData['MD5_script'] = '<script type="text/javascript" src="typo3/md5.js"></script>';
			$GLOBALS['TSFE']->JSCode .= $this->getMD5Submit(TRUE);
			$this->controlData->setJSmd5Added(TRUE);
		}
		$markerArray['###PASSWORD_ONCHANGE###'] = '';
	}	// addMd5LoginMarkers


	/**
	* From the 'KB MD5 FE Password (kb_md5fepw)' extension.
	*
	* @author	Kraft Bernhard <kraftb@gmx.net>
	**/
	function loginFormOnSubmit ($dataArray) {

		$js = '
	function superchallenge_passwd(form) {
		var pass = form.pass.value;
		if (pass) {
			var enc_pass = pass;
			var str = form.user.value+":"+enc_pass+":"+form.challenge.value;
			form.pass.value = MD5(str);
			return true;
		} else {
			return false;
		}
	}
';
		$GLOBALS['TSFE']->JSCode .= $js;
		$GLOBALS['TSFE']->additionalHeaderData['tx_kbmd5fepw_felogin'] = '<script language="JavaScript" type="text/javascript" src="typo3/md5.js"></script>';

		$md5Obj = &t3lib_div::getUserObj('&tx_srfeuserregister_passwordmd5');
		$md5Obj->generateChallenge($dataArray);
		$chal_val = $md5Obj->getChallenge();
		$onSubmit =	'superchallenge_passwd(this)';
		$hidden = '<input type="hidden" name="challenge" value="'.$chal_val.'">';
		return array($onSubmit, $hidden);
	}


	/**
	* From the 'KB MD5 FE Password (kb_md5fepw)' extension.
	*
	* @author	Kraft Bernhard <kraftb@gmx.net>
	**/
	function getMD5Submit ($bEncryptMd5) {

		$theTable = $this->controlData->getTable();
		$JSPart = '
			function enc_form(form) {
				var pass = form[\'FE[' . $theTable . '][password]\'].value;
				var pass_again = form[\'FE[' . $theTable . '][password_again]\'].value;
				if (pass == \'\') {
					return true;
				}
				if (pass != pass_again) {
					alert(\'' . $this->langObj->getLL('evalErrors_twice_password') . '\');
					form[\'FE[' . $theTable . '][password]\'].select();
					form[\'FE[' . $theTable . '][password]\'].focus();
					return false;
				}' .
				($bEncryptMd5 ? '
				if (pw_change) {
					var enc_pass = MD5(pass);
					form[\'FE[' . $theTable . '][password]\'].value = enc_pass;
					form[\'FE[' . $theTable . '][password_again]\'].value = enc_pass;
				}' : '') .
				'return true;
			}';
		return $JSPart;
	}	// getMD5Submit


	/**
	* Builds a file uploader
	*
	* @param string  $theField: the field name
	* @param array  $config: the field TCA config
	* @param array  $filenames: array of uploaded file names
	* @param string  $prefix: the field name prefix
	* @return string  generated HTML uploading tags
	*/
	function buildFileUploader (
		$theField,
		$config,
		$cmd,
		$cmdKey,
		$filenameArray = array(),
		$prefix,
		$viewOnly = FALSE,
		$activity = '',
		$bHtml = TRUE
	) {
		$HTMLContent = '';
		$size = $config['maxitems'];
		$cmdParts = preg_split('/\[|\]/', $this->conf[$cmdKey.'.']['evalValues.'][$theField]);
		if(!empty($cmdParts[1]))	{
			$size = min($size, intval($cmdParts[1]));
		}
		$size = $size ? $size : 1;
		$number = $size - sizeof($filenameArray);
		$dir = $config['uploadfolder'];

		if ($this->controlData->getMode() == MODE_PREVIEW || $viewOnly) {
			for ($i = 0; $i < sizeof($filenameArray); $i++) {
				if ($this->conf['templateStyle'] == 'css-styled') {
					$HTMLContent .= $filenameArray[$i];

					if ($activity == 'email')	{
						if ($bHtml)	{
							$HTMLContent .= '<br />';
						} else {
							$HTMLContent .= chr(13) . chr(10);
						}
					} else if ($bHtml)	{
						$HTMLContent .= '<a href="' . $dir.'/' . $filenameArray[$i] . '"' . $this->pibase->pi_classParam('file-view') . ' target="_blank" title="' . $this->langObj->getLL('file_view') . '">' . $this->langObj->getLL('file_view') . '</a><br />';
					}
				} else {
					$HTMLContent .= $filenameArray[$i] . '&nbsp;&nbsp;<small><a href="' . $dir.'/' . $filenameArray[$i] . '" target="_blank">' . $this->langObj->getLL('file_view') . '</a></small><br />';
				}
			}
		} else {
			for($i = 0; $i < sizeof($filenameArray); $i++) {
				if ($this->conf['templateStyle'] == 'css-styled') {
					$HTMLContent .= $filenameArray[$i] . '<input type="image" src="' . $GLOBALS['TSFE']->tmpl->getFileName($this->conf['icon_delete']) . '" name="'.$prefix.'['.$theField.']['.$i.'][submit_delete]" value="1" title="'.$this->langObj->getLL('icon_delete').'" alt="' . $this->langObj->getLL('icon_delete'). '"' . $this->pibase->pi_classParam('delete-icon') . ' onclick=\'if(confirm("' . $this->langObj->getLL('confirm_file_delete') . '")) return true; else return false;\' />'
							. '<a href="' . $dir.'/' . $filenameArray[$i] . '"' . $this->pibase->pi_classParam('file-view') . 'target="_blank" title="' . $this->langObj->getLL('file_view') . '">' . $this->langObj->getLL('file_view') . '</a><br />';
				} else {
					$HTMLContent .= $filenameArray[$i] . '&nbsp;&nbsp;<input type="image" src="' . $GLOBALS['TSFE']->tmpl->getFileName($this->conf['icon_delete']) . '" name="'.$prefix.'['.$theField.']['.$i.'][submit_delete]" value="1" title="'.$this->langObj->getLL('icon_delete').'" alt="' . $this->langObj->getLL('icon_delete'). '"' . $this->pibase->pi_classParam('icon') . ' onclick=\'if(confirm("' . $this->langObj->getLL('confirm_file_delete') . '")) return true; else return false;\' />&nbsp;&nbsp;<small><a href="' . $dir.'/' . $filenameArray[$i] . '" target="_blank">' . $this->langObj->getLL('file_view') . '</a></small><br />';
				}
				$HTMLContent .= '<input type="hidden" name="' . $prefix . '[' . $theField . '][' . $i . '][name]' . '" value="' . $filenameArray[$i] . '" />';
			}
			for ($i = sizeof($filenameArray); $i < $number + sizeof($filenameArray); $i++) {
				$HTMLContent .= '<input id="'. $this->pibase->pi_getClassName($theField) . '-' . ($i-sizeof($filenameArray)) . '" name="'.$prefix.'['.$theField.']['.$i.']'.'" title="' . $this->langObj->getLL('tooltip_' . (($cmd == 'invite')?'invitation_':'')  . 'image') . '" size="40" type="file" '.$this->pibase->pi_classParam('uploader').' /><br />';
			}
		}
		return $HTMLContent;
	}	// buildFileUploader


	/**
	* Adds uploading markers to a marker array
	*
	* @param string  $theField: the field name
	* @param array  $markerArray: the input marker array
	* @param array  $dataArray: the record array
	* @return void
	*/
	function addFileUploadMarkers (
		$theField,
		$fieldConfig,
		&$markerArray,
		$cmd,
		$cmdKey,
		$dataArray = array(),
		$viewOnly = FALSE,
		$activity = '',
		$bHtml = TRUE
	) {
		$theTable = $this->controlData->getTable();

		if (!$markerArray)	{
			$markerArray = $this->getArray();
		}
		$filenameArray = array();
		if ($dataArray[$theField]) {
			$filenameArray = $dataArray[$theField];
		}

		if ($viewOnly) {
			$markerArray['###UPLOAD_PREVIEW_' . $theField . '###'] =
				$this->buildFileUploader(
					$theField,
					$fieldConfig['config'],
					$cmd,
					$cmdKey,
					$filenameArray,
					'FE['.$theTable.']',
					TRUE,
					$activity,
					$bHtml
				);
		} else {
			$markerArray['###UPLOAD_' . $theField . '###'] =
				$this->buildFileUploader(
					$theField,
					$fieldConfig['config'],
					$cmd,
					$cmdKey,
					$filenameArray,
					'FE['.$theTable.']',
					FALSE,
					$activity,
					$bHtml
				);
			$max_size = $fieldConfig['config']['max_size'] * 1024;
			$markerArray['###HIDDENFIELDS###'] .= '<input type="hidden" name="MAX_FILE_SIZE" value="' . $max_size . '" />';
		}
	}	// addFileUploadMarkers


	function checkToken ($token)	{
		$tokenError = '';
		if ($token == '')	{
			$tokenError = $this->langObj->getLL('internal_token_empty');
		} else if (strlen($token) < 10)	{
			$tokenError = $this->langObj->getLL('token_short');
		}
		if ($tokenError != '')	{
			exit($this->pibase->extKey . ': ' . $tokenError);
		}
	}


	/**
	* Inserts a token for the form and stores it
	*
	* @param array  $markerArray: the token is added to the '###HIDDENFIELDS###' marker
	*/
	function addFormToken (&$markerArray, $token)	{

		$this->checkToken($token);
		$prefixId = $this->controlData->getPrefixId();

		$markerArray['###HIDDENFIELDS###'] .= chr(10) . '<input type="hidden" name="' . $prefixId . '[token]" value="' . $token . '" />';
	}


	function addHiddenFieldsMarkers (&$markerArray, $cmdKey, $mode, $token, $dataArray = array()) {

		if (!$markerArray)	{
			$markerArray = $this->getArray();
		}
		$theTable = $this->controlData->getTable();
		$prefixId = $this->controlData->getPrefixId();

		if ($this->conf[$cmdKey.'.']['preview'] && $mode != MODE_PREVIEW) {
			$markerArray['###HIDDENFIELDS###'] .= chr(10) . '<input type="hidden" name="' . $prefixId .  '[preview]" value="1" />';
			if ($theTable == 'fe_users' && $cmdKey == 'edit' && $this->conf[$cmdKey.'.']['useEmailAsUsername']) {
				$markerArray['###HIDDENFIELDS###'] .= chr(10) . '<input type="hidden" name="FE[' . $theTable . '][username]" value="' . htmlspecialchars($dataArray['username']).'" />';
				$markerArray['###HIDDENFIELDS###'] .= chr(10) . '<input type="hidden" name="FE[' . $theTable . '][email]" value="' . htmlspecialchars($dataArray['email']).'" />';
			}
		}
		if ($mode == MODE_PREVIEW) {
			$fieldArray = explode(',', $this->conf[$cmdKey.'.']['fields']);
			$fieldArray = array_diff($fieldArray, array('hidden', 'disable'));
			if ($theTable == 'fe_users') {
				$fieldArray[] = 'password_again';
				if ($this->conf[$cmdKey.'.']['useEmailAsUsername'] || $this->conf[$cmdKey.'.']['generateUsername']) {
					$fieldArray = array_merge($fieldArray, array('username'));
				}
				if ($this->conf[$cmdKey.'.']['useEmailAsUsername']) {
					$fieldArray = array_merge($fieldArray, array('email'));
				}
			}
			$fields = implode(',', $fieldArray);
			$fields = $this->controlData->getOpenFields($fields);
			$fieldArray = explode(',', $fields);

			foreach($fieldArray as $theField) {
				$value = $dataArray[$theField];
				if (is_array($value))	{
					$value = implode (',', $value);
				} else {
					$value = htmlspecialchars($dataArray[$theField]);
				}
				$markerArray['###HIDDENFIELDS###'] .= chr(10) . '<input type="hidden" name="FE[' . $theTable . '][' . $theField . ']" value="' . $value . '" />';
			}
		}

		$this->addFormToken($markerArray, $token);
	}	// addHiddenFieldsMarkers


	/**
	* Removes irrelevant Static Info subparts (zone selection when the country has no zone)
	*
	* @param string  $templateCode: the input template
	* @param array  $markerArray: the marker array
	* @return string  the output template
	*/
	function removeStaticInfoSubparts ($templateCode, &$markerArray, $viewOnly = FALSE) {
		if (!$markerArray)	{
			$markerArray = $this->getArray();
		}
		if ($this->controlData->getMode() == MODE_PREVIEW || $viewOnly) {
			if (!$markerArray['###FIELD_zone###'] ) {
				return $this->cObj->substituteSubpart($templateCode, '###SUB_INCLUDED_FIELD_zone###', '');
			}
		} else {
			if (!$markerArray['###SELECTOR_ZONE###'] ) {
				return $this->cObj->substituteSubpart($templateCode, '###SUB_INCLUDED_FIELD_zone###', '');
			}
		}
		return $templateCode;
	}	// removeStaticInfoSubparts


	/**
	 * Adds elements to the input $markContentArray based on the values from the fields from $fieldList found in $row
	 *
	 * @param	array		Array with key/values being marker-strings/substitution values.
	 * @param	array		An array with keys found in the $fieldList (typically a record) which values should be moved to the $markContentArray
	 * @param	string		A list of fields from the $row array to add to the $markContentArray array. If empty all fields from $row will be added (unless they are integers)
	 * @param	boolean		If set, all values added to $markContentArray will be nl2br()'ed
	 * @param	string		Prefix string to the fieldname before it is added as a key in the $markContentArray. Notice that the keys added to the $markContentArray always start and end with "###"
	 * @param	boolean		If set, all values are passed through htmlspecialchars() - RECOMMENDED to avoid most obvious XSS and maintain XHTML compliance.
	 * @return	array		The modified $markContentArray
	 */
	function fillInMarkerArray ($markerArray, $row, $securedArray, $fieldList='', $nl2br=TRUE, $prefix='FIELD_', $HSC=TRUE)	{

		if (is_array($securedArray))	{
			foreach ($securedArray as $field => $value)	{
				$row[$field] = $securedArray[$field];
			}
		}
		if ($fieldList)	{
			$fArr = t3lib_div::trimExplode(',',$fieldList,1);
			foreach($fArr as $field)	{
				$markerArray['###'.$prefix.$field.'###'] = $nl2br?nl2br($row[$field]):$row[$field];
			}
		} else {
			if (is_array($row))	{
				foreach($row as $field => $value)	{
					if (!t3lib_div::testInt($field))	{
						if (is_array($value))	{
							$value = implode(',', $value);
						}
						if ($HSC)	{
							$value = htmlspecialchars($value);
						}
						$markerArray['###'.$prefix.$field.'###'] = $nl2br ? nl2br($value) : $value;
					}
				}
			}
		}
		return $markerArray;
	}
}


if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/marker/class.tx_srfeuserregister_marker.php'])  {
  include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/marker/class.tx_srfeuserregister_marker.php']);
}
?>
