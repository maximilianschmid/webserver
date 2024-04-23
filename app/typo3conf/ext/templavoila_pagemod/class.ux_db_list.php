<?php
/**
 * User-Extension of SC_db_list class.
 *
 * @author Morten Tranberg Hansen <mth@daimi.au.dk>
 */

class ux_SC_db_list extends SC_db_list {

  var $pageinfo;

  function main()    {
    
    // set pageinfo, for use in this function and pagehandler
    $this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);

    // initialize pagehandler
    require_once(t3lib_extMgm::extPath('templavoila_pagemod').'class.tx_templavoilapagemod_pagehandler.php');
    $pagehandler = t3lib_div::makeInstance('tx_templavoilapagemod_pagehandler');
    $pagehandler->init($this);
	debug('list','hej');          
    if(t3lib_div::_GET('allowMove')) {

      if(intval($this->pageinfo['uid'])!=0 && intval($this->pageinfo['doktype'])!=254) { 

#	$this->content = $pagehandler->moveToStandardFolder();
      
      } else {
	
	parent::main();
	
	$pagehandler->highlightPageModule();
	
      }
      
    } else {
#      debug('clean');
      parent::main();

    }

  }

}

?>
