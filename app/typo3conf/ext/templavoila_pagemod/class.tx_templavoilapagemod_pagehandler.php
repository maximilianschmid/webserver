<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006 Morten Tranberg Hansen <mth@daimi.au.dk>
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
 * Class for handling moves in modules for the 'templavoila_pagemod' extension.
 *
 * @author	Morten Tranberg Hansen <mth@daimi.au.dk>
 * @package	TYPO3
 * @subpackage	tx_templavoilapagemod
 */
class tx_templavoilapagemod_pagehandler {
  
  var $pageinfo;
  
  /**
   * Initializes the Class. Should be called before any other functions in this class.
   * @return	void
   */
  function init(&$pObj) {
    $this->pageinfo = $pObj->pageinfo;
  }

  /**
   * Returns javascript there will move the list frame to the list module.
   * @return	string		Javascript there will change the to the right module
   */
  function moveToSysFolder() { // doktype 254
    $listModuleURL = t3lib_div::getIndpEnv('TYPO3_SITE_URL').TYPO3_mainDir.'db_list.php?id='.intval($this->pageinfo['uid']);
    $onClick = "top.nextLoadModuleUrl='".$listModuleURL."';top.fsMod.recentIds['web']=".intval($this->pageinfo['uid']).";top.goToModule('web_list',1);";
    
    return '
							<script language="javascript" type="text/javascript">
								'./*$onClick.*/'top.content.list_frame.location = "'.$listModuleURL.'";
							</script>';

  }
  
  /**
   * Returns javascript there will move the list frame to the templavoila module.
   * The page is based on the pages shortcut.
   * @return	string		Javascript there will change the to the right module
   */
  function moveToShortcut() { // doktype 4

    // init $shortcut, should be changed later, else nothing will be returned
    $shortcut = intval($this->pageinfo['uid']);

    if(intval($this->pageinfo['shortcut_mode'])==0) {               // shortcut to specific page
      $shortcut = intval($this->pageinfo['shortcut']);
    } else if (intval($this->pageinfo['shortcut_mode'])==1) {       // shortcut to first subpage
      
      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*','pages','pid='.$shortcut,'','sorting');
      if($GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
	$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
	$shortcut = $row['uid'];
      }

    }

    // module url
    $templavoilaModuleURL = t3lib_div::getIndpEnv('TYPO3_SITE_URL').t3lib_extmgm::siteRelPath('templavoila').'mod1/index.php?id='.intval($shortcut);

    if(intval($shortcut)!=intval($this->pageinfo['uid'])) {  // check for looping..
      $bank = $this->getTargetBank($shortcut);
      return '
							<script language="javascript" type="text/javascript">
								top.content.list_frame.location = "'.$templavoilaModuleURL.'";
								top.content.nav_frame.hilight_row("web","pages'.$shortcut.'_'.$bank.'");  
							</script>';
    } else {
      return 'Shortcut was looping.';
    }

  }

  function getTargetBank($pageuid) {
    global $BE_USER;
    $mounts = t3lib_div::trimExplode(',',$BE_USER->groupData['webmounts'],1);
    foreach($mounts as $bank=>$mountuid) {
      if($this->isInMount($mountuid,$pageuid))
	return $bank;
    }
    return 0;
  }

  function isInMount($startpageuid,$pageuid) {
    if($startpageuid==$pageuid) return TRUE;
    while(intval($startpageuid) && intval($pageuid) && intval($startpageuid)!=intval($pageuid)) {
      // get page,
      $pageRes = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*','pages','uid='.intval($pageuid));
      $page = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($pageRes);
      // get parent,
      $parentRes = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*','pages','uid='.intval($page['pid']));
      $parent = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($parentRes);
      $pageuid = $parent['uid'];
      // check if parent is startpage,
      if($startpageuid==$pageuid) return TRUE;
    }
    return FALSE;
  }

  /**
   * Returns javascript there will move the list frame to the templavoila module.
   * @return	string		Javascript there will change the to the right module
   */
  function moveToStandardFolder() {
    $templavoilaModuleURL = t3lib_div::getIndpEnv('TYPO3_SITE_URL').t3lib_extmgm::siteRelPath('templavoila').'mod1/index.php?id='.intval($this->pageinfo['uid']);
    $onClick = "top.nextLoadModuleUrl='".$templavoilaModuleURL."';top.fsMod.recentIds['web']=".intval($this->pageinfo['uid']).";top.goToModule('web_txtemplavoilaM1',1);";
    
    return '
							<script language="javascript" type="text/javascript">
								'./*$onClick.*/'top.content.list_frame.location = "'.$templavoilaModuleURL.'";
							</script>';
  }


  /**
   * Returns javascript there will highlight the templavoila_pagemod module
   * in web again.
   * @return	string		Javascript there will change the highlighting-
   */
  function highlightPageModule() {
    echo '
							<script language="javascript" type="text/javascript">
								top.highlightModuleMenuItem("ID_'.t3lib_div::md5int('web_txtemplavoilapagemodM1').'");
							</script>';
  }

}