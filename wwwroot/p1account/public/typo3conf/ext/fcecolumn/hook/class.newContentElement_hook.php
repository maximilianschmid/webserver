<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Heiko Kromm (heiko@kromm.net)
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
 * HOOK for db_new_content_el.php
 *
 * Originally based on the templavoila extension by Robert Lemke <robert@typo3.org> and Kasper Skaarhoj <kasper@typo3.com>
 */

require_once(PATH_typo3.'interfaces/interface.cms_newcontentelementwizarditemshook.php');

class tx_fcecolumn_newContentElement_hook implements cms_newContentElementWizardsHook {

  public function manipulateWizardItems(&$wizardItems, &$parentObject) {
    global $TCA;
    
    // get tv-field
    $colpos = '';
	  $colAr = t3lib_div::trimExplode(':',$parentObject->parentRecord,1);
	  if($pos = array_search('lDEF',$colAr)) {
      if ($pos+1 < count($colAr) && $colAr[$pos+1] != 'vDef') $colpos = $colAr[$pos+1];
    }
      
    // remove fce
    // get remove
    $TCEFORM_TSconfig = t3lib_BEfunc::getTCEFORM_TSconfig('tx_fcecolumn', array('pid' => $parentObject->id));
    $tceItems = array();
    if ($colpos != '' && is_array($TCEFORM_TSconfig[$colpos])) {
      foreach ($TCEFORM_TSconfig[$colpos] as $ds => $dsv) {      
        // remove dot from to- or ds-type
        $dt = (substr($ds, -1) == ".") ? substr($ds, 0, -1) : $ds;

        // Marcus: get the config
        $removePattern = $dsv['removeItems'];

        // Marcus: if onlyItems included it will clear everything and will keep selected items
        if ($dsv['onlyItems']) {
            $removePattern = '*';
            $onlyItems = t3lib_div::trimExplode(',',$dsv['onlyItems'],1);
        }

        // Marcus: Remove all items with asterrisk or show only selected items
        if ($removePattern == '*'){
            foreach ($wizardItems as $item => $val) {
                 if (is_array($val['tt_content_defValues']) && isset($val['tt_content_defValues'][$dt])) {
                     if (!in_array($val['tt_content_defValues'][$dt], $onlyItems)) {
                         unset($wizardItems[$item]);
                     }
                 }
            }
        } else {
            $removeItems = t3lib_div::trimExplode(',',$removePattern,1);
            foreach ($removeItems as $ri) {
              foreach ($wizardItems as $item => $val) {
                 if (is_array($val['tt_content_defValues']) && isset($val['tt_content_defValues'][$dt]) && $val['tt_content_defValues'][$dt]== $ri) {
                   unset($wizardItems[$item]);
                 }
              }
            }
        }
      }
    }
    
    t3lib_div::loadTCA('tt_content');
    // Get TCEFORM from TSconfig of current page
    $TCEFORM_TSconfig = t3lib_BEfunc::getTCEFORM_TSconfig('tt_content', array('pid' => $parentObject->id));
    if ($colpos != '') {
        $TCEFORM_TSconfig['CType'] = '';

        $onlyTypesItems = $TCEFORM_TSconfig['tx_fcecolumn'][$colpos.'.']['onlyItems'];
        $addvals = ($onlyTypesItems) ? '*' : $TCEFORM_TSconfig['tx_fcecolumn'][$colpos.'.']['removeItems'];


      if (strlen($addvals)>0) {
          if ($onlyTypesItems){
             $onlyTypesArray = t3lib_div::trimExplode(',', $onlyTypesItems,1);
          }
          
          if ($addvals == '*') {
              $availableTypes = array();
                foreach ($wizardItems as $key => $val){
                    $nextType = $val['tt_content_defValues']['CType'];
                    if ($nextType && !in_array($nextType, $availableTypes) && !in_array($nextType, $onlyTypesArray) && $nextType != 'list' && $nextType != 'templavoila_pi1') {
                        $availableTypes[] = $nextType;
                    }
                }
                $addvals = implode(',',$availableTypes);
          }

          $TCEFORM_TSconfig['CType']['removeItems'] .= (strlen($TCEFORM_TSconfig['CType']['removeItems']) > 0) ? ','.$addvals : $addvals;
      }
    }



    $removePlugins = array();
    $onlyPluginsPattern = $TCEFORM_TSconfig['tx_fcecolumn'][$colpos.'.']['onlyPlugins'];
    $removePluginsPattern = ($onlyPluginsPattern) ? '*' : $TCEFORM_TSconfig['tx_fcecolumn'][$colpos.'.']['removePlugins'];

    $onlyPlugins = t3lib_div::trimExplode(',', $onlyPluginsPattern, 1);
    foreach ($onlyPlugins as $oplgKey => $oplgVal){
        unset($onlyPlugins[$oplgKey]);
        $onlyPlugins[] = 'plugins_'.$oplgVal;
    }

    if ($removePluginsPattern == '*'){

        foreach ($wizardItems as $key => $val){
            if (substr($key, 0, 8) == 'plugins_'){
                $removePlugins[] = $key;
            }
        }

    //    debug($removePlugins);
    } else {
        $explodedPluginList = t3lib_div::trimExplode(',', $removePluginsPattern,1);
        foreach ($explodedPluginList as $rmplVal){
            $removePlugins[] = 'plugins_'.$rmplVal;
        }
    }
    
    foreach ($removePlugins as $plgKey){
        if (!in_array($plgKey, $onlyPlugins))
        unset($wizardItems[$plgKey]);
    }
    
    

    $removeItems = t3lib_div::trimExplode(',',$TCEFORM_TSconfig['CType']['removeItems'],1);

	$headersUsed = Array();
			// Traverse wizard items:
	foreach($wizardItems as $key => $cfg)	{
			// Exploding parameter string, if any (old style)
		if ($wizardItems[$key]['params'])	{
				// Explode GET vars recursively
			$tempGetVars = t3lib_div::explodeUrl2Array($wizardItems[$key]['params'],TRUE);
				// If tt_content values are set, merge them into the tt_content_defValues array, unset them from $tempGetVars and re-implode $tempGetVars into the param string (in case remaining parameters are around).
			if (is_array($tempGetVars['defVals']['tt_content']))	{
				$wizardItems[$key]['tt_content_defValues'] = array_merge(is_array($wizardItems[$key]['tt_content_defValues']) ? $wizardItems[$key]['tt_content_defValues'] : array(), $tempGetVars['defVals']['tt_content']);
				unset($tempGetVars['defVals']['tt_content']);
				$wizardItems[$key]['params'] = t3lib_div::implodeArrayForUrl('',$tempGetVars);
			}
		}
			// If tt_content_defValues are defined...:
				
		if (is_array($wizardItems[$key]['tt_content_defValues']))	{
			// Traverse field values:
            foreach($wizardItems[$key]['tt_content_defValues'] as $fN => $fV)	{

                if (is_array($TCA['tt_content']['columns'][$fN]))	{
                        // Get information about if the field value is OK:
                    $config = &$TCA['tt_content']['columns'][$fN]['config'];
                    $authModeDeny = $config['type']=='select' && $config['authMode'] && !$GLOBALS['BE_USER']->checkAuthMode('tt_content',$fN,$fV,$config['authMode']);
                    if ($authModeDeny || in_array($fV,$removeItems))	{
                            // Remove element all together:
                        unset($wizardItems[$key]);
                        break;
                    } else {
                            // Add the parameter:
                        $wizardItems[$key]['params'].= '&defVals[tt_content]['.$fN.']='.rawurlencode($fV);
                        $tmp = explode('_', $key);
                        $headersUsed[$tmp[0]] = $tmp[0];
                    }
                }
            }
        }
    }
    
    // remove empty headlines    
    foreach ($wizardItems as $key => $cfg)	{
			list ($itemCategory, $dummy) = explode('_', $key);
			if (!isset ($headersUsed[$itemCategory])) unset ($wizardItems[$key]);
		}    
  }
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/fcecolumn/hook/class.newContentElement_hook.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/fcecolumn/hook/class.newContentElement_hook.php']);
}
?>