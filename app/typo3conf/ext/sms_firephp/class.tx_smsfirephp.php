<?php
/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2008 sitegeist media solutions gmbh
 * All rights reserved
 *
 * This script is part of the Typo3 project. The Typo3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * A copy is found in the textfile GPL.txt and important notices to the license
 * from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 *
 ***************************************************************/

/**
 * This class holds some functions used by the sms_firephp extension
 *
 * @author Christoph Dorn <christoph@christophdorn.com>
 * @author Thorsten Kohpeiss <kohpeiss@sitegeist.de>
 */

require_once (t3lib_extMgm :: extPath($_EXTKEY) . '/FirePHPCore/FirePHP.class.php');

/**
 * Sends the given data to FirePHP Firefox Extension.
 * The data can be displayed in the Firebug Console or in the
 * "Server" request tab.
 *
 * Usage:
 * <code>
 * fb('Hello World'); // Defaults to FirePHP::LOG
 *
 * fb('Log message'  ,FirePHP::LOG);
 * fb('Info message' ,FirePHP::INFO);
 * fb('Warn message' ,FirePHP::WARN);
 * fb('Error message',FirePHP::ERROR);
 *
 * fb('Message with label','Label',FirePHP::LOG);
 *
 * fb(array(
 * 		'key1'=>'val1',
 * 		'key2'=>array(array('v1','v2'),'v3')),
 *		'TestArray',fb_LOG
 * );
 *
 * function test($Arg1) {
 *   throw new Exception('Test Exception');
 * }
 * try {
 *   test(array('Hello'=>'World'));
 * } catch(Exception $e) {
 *   fb($e);
 * }
 *
 * fb(array(
 * 		'2 SQL queries took 0.06 seconds',
 * 			array(
 *    			array('SQL Statement','Time','Result'),
 *    			array('SELECT * FROM Foo','0.02',array('row1','row2')),
 *    			array('SELECT * FROM Bar','0.04',array('row1','row2'))
 *   		)
 * 		),FirePHP::TABLE);
 *
 * // Will show only in "Server" tab for the request
 * fb(apache_request_headers(),'RequestHeaders',FirePHP::DUMP);
 *
 * </code>
 * @copyright   Copyright (C) 2007-2008 Christoph Dorn, Thorsten Kohpeiss
 * @author      Christoph Dorn <christoph@christophdorn.com>
 * @author      Thorsten Kohpeiss <kohpeiss@sitegeist.de>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @return Boolean  True if FirePHP was detected and headers were written, false otherwise
 *
 */
function fb() {
	if (!t3lib_div :: cmpIP(t3lib_div :: getIndpEnv('REMOTE_ADDR'), $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask']))
		return;

	if (empty ($args[1]))
		$args[1] = FirePHP :: INFO;

	$instance = FirePHP::getInstance(true);

	$args = func_get_args();
	return call_user_func_array(array($instance,'fb'),$args);

}

class FB {
  /**
   * Set some options for the library
   *
   * @see FirePHP->setOptions()
   * @param array $Options The options to be set
   * @return void
   */
  public function setOptions($Options) {
    $instance = FirePHP::getInstance(true);
    $instance->setOptions($Options);
  }

  /**
   * Log object to firebug
   *
   * @see http://www.firephp.org/Wiki/Reference/Fb
   * @param mixed $Object
   * @return true
   * @throws Exception
   */
  public static function send()
  {
    $instance = FirePHP::getInstance(true);
    $args = func_get_args();
    return call_user_func_array(array($instance,'fb'),$args);
  }

  /**
   * Start a group for following messages
   *
   * @param string $Name
   * @return true
   * @throws Exception
   */
  public static function group($Name) {
    return self::send(null, $Name, FirePHP::GROUP_START);
  }

  /**
   * Ends a group you have started before
   *
   * @return true
   * @throws Exception
   */
  public static function groupEnd() {
    return self::send(null, null, FirePHP::GROUP_END);
  }

  /**
   * Log object with label to firebug console
   *
   * @see FirePHP::LOG
   * @param mixes $Object
   * @param string $Label
   * @return true
   * @throws Exception
   */
  public static function log($Object, $Label=null) {
    return self::send($Object, $Label, FirePHP::LOG);
  }

  /**
   * Log object with label to firebug console
   *
   * @see FirePHP::INFO
   * @param mixes $Object
   * @param string $Label
   * @return true
   * @throws Exception
   */
  public static function info($Object, $Label=null) {
    return self::send($Object, $Label, FirePHP::INFO);
  }

  /**
   * Log object with label to firebug console
   *
   * @see FirePHP::WARN
   * @param mixes $Object
   * @param string $Label
   * @return true
   * @throws Exception
   */
  public static function warn($Object, $Label=null) {
    return self::send($Object, $Label, FirePHP::WARN);
  }

  /**
   * Log object with label to firebug console
   *
   * @see FirePHP::ERROR
   * @param mixes $Object
   * @param string $Label
   * @return true
   * @throws Exception
   */
  public static function error($Object, $Label=null) {
    return self::send($Object, $Label, FirePHP::ERROR);
  }

  /**
   * Dumps key and variable to firebug server panel
   *
   * @see FirePHP::DUMP
   * @param string $Key
   * @param mixed $Variable
   * @return true
   * @throws Exception
   */
  public static function dump($Key, $Variable) {
    return self::send($Variable, $Key, FirePHP::DUMP);
  }

  /**
   * Log a trace in the firebug console
   *
   * @see FirePHP::TRACE
   * @param string $Label
   * @return true
   * @throws Exception
   */
  public static function trace($Label) {
    return self::send($Label, FirePHP::TRACE);
  }

  /**
   * Log a table in the firebug console
   *
   * @see FirePHP::TABLE
   * @param string $Label
   * @param string $Table
   * @return true
   * @throws Exception
   */
  public static function table($Label, $Table) {
    return self::send($Table, $Label, FirePHP::TABLE);
  }

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sms_firephp/class.tx_smsfirephp.php']) {
	include_once ($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sms_firephp/class.tx_smsfirephp.php']);
}
?>