<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005 Morten Tranberg Hansen (mth@daimi.au.dk)
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
 * TODO: Description.
 *
 * @author	Morten Tranberg Hansen <mth@daimi.au.dk>
 */


class tx_templavoilapagemod_tcemainprocdm {
      
  function processDatamap_preProcessFieldArray(&$fieldArray, $table, $id, &$reference) {
    
  }


  function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, &$reference) {
#    debug(array($status, $table, $id, &$fieldArray, &$reference),'POST PROCESS');

    // adds access to the shy old templavoila page module, this is needed because you can manually make access to it for your users when we made it shy.
    // it too adds access to the List module as this is needed.
    if($table==='be_groups' && !empty($fieldArray['groupMods'])) {
      $mods = t3lib_div::trimExplode(',',$fieldArray['groupMods'],1);
      if(array_search('web_txtemplavoilapagemodM1',$mods)!==FALSE) {

	if(array_search('web_txtemplavoilaM1',$mods)===FALSE)$fieldArray['groupMods'] .= ',web_txtemplavoilaM1';
	if(array_search('web_list',$mods)===FALSE)$fieldArray['groupMods'] .= ',web_list';
	
      }
    }
    
  }

}

if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/templavoila_pagemod/class.tx_templavoilapagemod_tcemainprocdm.php"])	{
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/templavoila_pagemod/class.tx_templavoilapagemod_tcemainprocdm.php"]);
}

?>