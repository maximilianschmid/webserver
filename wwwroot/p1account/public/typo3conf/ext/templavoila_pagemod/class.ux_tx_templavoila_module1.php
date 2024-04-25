<?php
/**
 * User-Extension of tx_templavoila_module1 class.
 *
 * @author Morten Tranberg Hansen <mth@daimi.au.dk>
 */

class ux_tx_templavoila_module1 extends tx_templavoila_module1 {

  var $pageinfo;
  var $pagehandler;

  function main()    {

    // set pageinfo, for use in this function and pagehandler
    $this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);

    // initialize pagehandler
    require_once(t3lib_extMgm::extPath('templavoila_pagemod').'class.tx_templavoilapagemod_pagehandler.php');
    $this->pagehandler = t3lib_div::makeInstance('tx_templavoilapagemod_pagehandler');
    $this->pagehandler->init($this);
    
    if (intval($this->pageinfo['doktype'])==4 && !$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['templavoila_pagemod']['dont_follow_shortcuts']) {                                    // shortcut
      
      $shortScript = $this->pagehandler->moveToShortcut();
      if($shortScript) {   // if shortcut was found
	$this->content = $shortScript;
      } else {             // else just display page
	$this->runTemplavoila();
      }
      
    } else {                                                                             // standard page
      $this->runTemplavoila();
    }
    
  }

  function runTemplavoila() {

    parent::main();    

    $listModuleURL = t3lib_div::getIndpEnv('TYPO3_SITE_URL').'/'.TYPO3_mainDir.'db_list.php?id='.intval($this->pageinfo['uid']);
    $onClick = "top.nextLoadModuleUrl='".$listModuleURL."';top.fsMod.recentIds['web']=".intval($this->pageinfo['uid']).";top.goToModule('web_list',1);";
    $listModuleLink = '
				<img'.t3lib_iconWorks::skinImg('/'.TYPO3_mainDir, 'mod/web/list/list.gif', '').' style="text-align:center; vertical-align: middle; border:0;" />
				<strong><a href="#" onClick="'.$onClick.'">'.$GLOBALS['LANG']->getLL('editpage_sysfolder_switchtolistview','',1).'</a></strong>
			';
    if(!$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['templavoila_pagemod']['disable_listviewLink']) // only display if enabled in extension manager
      $this->content .= '<hr>'.$listModuleLink;
    
#    $this->pagehandler->highlightPageModule();

  }


}

?>