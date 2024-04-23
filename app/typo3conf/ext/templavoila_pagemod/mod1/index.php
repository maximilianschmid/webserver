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


	// DEFAULT initialization of a module [BEGIN]
unset($MCONF);
require_once('conf.php');
require_once($BACK_PATH.'init.php');
require_once($BACK_PATH.'template.php');

$LANG->includeLLFile('EXT:templavoila_pagemod/mod1/locallang.xml');
require_once(PATH_t3lib.'class.t3lib_scbase.php');
$BE_USER->modAccess($MCONF,1);	// This checks permissions and exits if the users has no permission for entry.
	// DEFAULT initialization of a module [END]



/**
 * Module 'Edit' for the 'templavoila_pagemod' extension.
 *
 * @author	Morten Tranberg Hansen <mth@daimi.au.dk>
 * @package	TYPO3
 * @subpackage	tx_templavoilapagemod
 */
class  tx_templavoilapagemod_module1 extends t3lib_SCbase {
  var $pageinfo;
  
  /**
   * Initializes the Module
   * @return	void
   */
  function init()	{
    global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;
    
    parent::init();
     
    if (t3lib_div::_GP('clear_all_cache'))	{
      $this->include_once[] = PATH_t3lib.'class.t3lib_tcemain.php';
    }
    
  }
  
  /**
   * Main function of the module. Write the content to $this->content
   */
  function main()	{
    global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;
    
    // Access check!
    // The page will show only if there is a valid page and if this page may be viewed by the user
    $this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);
    $access = is_array($this->pageinfo) ? 1 : 0;

    if (($this->id && $access) || ($BE_USER->user['admin'] && !$this->id))	{

      // fake acces to list and page module..
      
      
      // Render content:
      $this->moduleContent();
      
    } else {
      // If no access or if ID == zero
      $this->doc = t3lib_div::makeInstance('mediumDoc');
      $this->doc->backPath = $BACK_PATH;
      
      $this->content.=$this->doc->startPage($LANG->getLL('title'));
      $this->content.=$this->doc->header($LANG->getLL('title'));
      $this->content.=$this->doc->spacer(5);
      $this->content.=$this->doc->spacer(10);
    }
  }
  
  /**
   * Prints out the module HTML
   *
   * @return	void
   */
  function printContent()	{    
    echo $this->content;
  }
  
  /**
   * Generates the module content
   *
   * @return	void
   */
  function moduleContent()	{
    global $LANG;
#					  debug($this->pageinfo,'pageinfo');
#    debug($GLOBALS['TYPO3_CONF_VARS']);
#    debug($GLOBALS['TBE_MODULES']);    
        
    // initializes the page handler: used to change modules
    require_once(t3lib_extMgm::extPath('templavoila_pagemod').'class.tx_templavoilapagemod_pagehandler.php');
    $pagehandler = t3lib_div::makeInstance('tx_templavoilapagemod_pagehandler');
    $pagehandler->init($this);
      
    switch(intval($this->pageinfo['doktype'])) {
    case 254:                                      // sys folder
      $content .= $pagehandler->moveToSysFolder();
      break;
    default:                                       // everything else, if page uid=0 we regard it as a sys folder
      $content .= intval($this->pageinfo['uid']) ? $pagehandler->moveToStandardFolder() : $pagehandler->moveToSysFolder();
      break;
    }
    
#      debug(array($content));     
    $this->content.=$content;
  }

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/templavoila_pagemod/mod1/index.php'])	{
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/templavoila_pagemod/mod1/index.php']);
}




// Make instance:
$SOBE = t3lib_div::makeInstance('tx_templavoilapagemod_module1');
$SOBE->init();

// Include files?
foreach($SOBE->include_once as $INC_FILE)	include_once($INC_FILE);

$SOBE->main();
$SOBE->printContent();

?>