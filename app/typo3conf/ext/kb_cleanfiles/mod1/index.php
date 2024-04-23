<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005 Kraft Bernhard <kraftb@gmx.net>
*  All rights reserved
*  based on work by: Thorsten Reichelt (Thorsten_Reichelt@gmx.de)
*
*  This script is part of the Typo3 project. The Typo3 project is
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
 * Module 'KB Clean File' for the 'kb_cleanfile' extension.
 *
 * $Id$
 *
 * @author	Kraft Bernhard <kraftb@gmx.net>
 * @package TYPO3
 * @subpackage tx_kbcleanfiles
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   74: class tx_kbcleanfiles_module1 extends t3lib_SCbase
 *   82:     function init()
 *   92:     function menuConfig()
 *  108:     function main()
 *  127:     function jumpToUrl(URL)
 *  176:     function printContent()
 *  190:     function getReferencedFiles($paths_and_fields)
 *  239:     function getFiles($dirs)
 *  253:     function getAllTables()
 *  267:     function getAllPathsAndFields($tables)
 *  314:     function getImageFields_Flex_Rec($xml_ar, $fields = array(), $path = array())
 *  344:     function getFlexTables($tables)
 *  363:     function moduleContent()
 *  474:     function parseFlexData($xmlData, $field, &$result, $type)
 *  501:     function parseFlexData_LLang($xmlData, $field, &$result, $type)
 *  537:     function getFlexPathsAndFiles($flex_tables)
 *  578:     function getDeleteableFiles()
 *
 * TOTAL FUNCTIONS: 16
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */



	// DEFAULT initialization of a module [BEGIN]
unset($MCONF);
require ('conf.php');
require ($BACK_PATH.'init.php');
require ($BACK_PATH.'template.php');
$GLOBALS['LANG']->includeLLFile('EXT:kb_cleanfiles/mod1/locallang.xml');
require_once (PATH_t3lib.'class.t3lib_scbase.php');
$BE_USER->modAccess($MCONF,1);	// This checks permissions and exits if the users has no permission for entry.
	// DEFAULT initialization of a module [END]

class tx_kbcleanfiles_module1 extends t3lib_SCbase {
	var $pageinfo;

	/**
	 * Returns nothing. Initializes the class.
	 *
	 * @return	void		nothing
	 */
	function init()	{
		global $AB,$BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$HTTP_GET_VARS,$HTTP_POST_VARS,$CLIENT,$TYPO3_CONF_VARS;
		parent::init();
	}

	/**
	 * Adds items to the ->MOD_MENU array. Used for the function menu selector.
	 *
	 * @return	void		nothing
	 */
	function menuConfig()	{
		global $LANG;
		$this->MOD_MENU = Array (
			'function' => Array (
				'1' => $LANG->getLL('function1'),
				'2' => $LANG->getLL('function2'),
			)
		);
		parent::menuConfig();
	}

	/**
	 * Main function of the module. Write the content to $this->content
	 *
	 * @return	void		nothing
	 */
	function main()	{
		global $AB,$BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$HTTP_GET_VARS,$HTTP_POST_VARS,$CLIENT,$TYPO3_CONF_VARS;

		// Access check!
		// The page will show only if there is a valid page and if this page may be viewed by the user
		$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);
		$access = is_array($this->pageinfo) ? 1 : 0;

		if (($this->id && $access) || ($BE_USER->user['admin'] && !$this->id))	{

				// Draw the header.
			$this->doc = t3lib_div::makeInstance('mediumDoc');
			$this->doc->backPath = $BACK_PATH;
			$this->doc->form='<form action="" method="POST">';

				// JavaScript
			$this->doc->JScode = '
				<script language="javascript">
					script_ended = 0;
					function jumpToUrl(URL)	{
						document.location = URL;
					}
				</script>
			';
			$this->doc->postCode='
				<script language="javascript">
					script_ended = 1;
					if (top.theMenu) top.theMenu.recentuid = '.intval($this->id).';
				</script>
			';

			$headerSection = $this->doc->getHeader('pages',$this->pageinfo,$this->pageinfo['_thePath']).'<br>'.$LANG->php3Lang['labels']['path'].': '.t3lib_div::fixed_lgd_pre($this->pageinfo['_thePath'],50);

			$this->content.=$this->doc->startPage($LANG->getLL('title'));
			$this->content.=$this->doc->header($LANG->getLL('title'));
			$this->content.=$this->doc->spacer(5);
			$this->content.=$this->doc->section('',$this->doc->funcMenu($headerSection,t3lib_BEfunc::getFuncMenu($this->id,'SET[function]',$this->MOD_SETTINGS['function'],$this->MOD_MENU['function'])));
			$this->content.=$this->doc->divider(5);


			// Render content:
			$this->moduleContent();


			// ShortCut
			if ($BE_USER->mayMakeShortcut())	{
				$this->content.=$this->doc->spacer(20).$this->doc->section('',$this->doc->makeShortcutIcon('id',implode(',',array_keys($this->MOD_MENU)),$this->MCONF['name']));
			}

			$this->content.=$this->doc->spacer(10);
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
	 * @return	void		nothing
	 */
	function printContent()	{
		global $SOBE;

		$this->content.=$this->doc->middle();
		$this->content.=$this->doc->endPage();
		echo $this->content;
	}

	/*
	 * Returns files referenced. From normal TCA
	 *
	 * @params	array		Paths and fields which contain images
	 * @return	array		Paths and files referenced
	 */
	function getReferencedFiles($paths_and_fields) {
		$result = array();
		if (!is_array($paths_and_fields))	{
			return $result;
		}
		foreach ($paths_and_fields as $path => $path_ar) {
			if (!is_array($path_ar['tables']))	{
				continue;
			}
			foreach ($path_ar['tables'] as $table => $fields_ar) {
				$deleted_field = $GLOBALS['TCA'][$table]['ctrl']['delete']?$GLOBALS['TCA'][$table]['ctrl']['delete']:0;
				$fields = implode(',', $fields_ar);
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($fields, $table, '');
				while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
					if (!is_array($fields_ar))	{
						continue;
					}
					foreach ($fields_ar as $field) {
						$images = $row[$field];
						$img_ar = t3lib_div::trimExplode(',', $images, 1);
						if ($deleted_field) {
							if ($row[$deleted_field]) {
								foreach ($img_ar as $img) {
									$result[$path]['referenced_deleted'][] = $img;
								}
							} else {
								foreach ($img_ar as $img) {
									$result[$path]['referenced'][] = $img;
								}
							}
						} else {
							foreach ($img_ar as $img) {
								$result[$path]['referenced'][] = $img;
							}
						}
					}
				}
				$GLOBALS['TYPO3_DB']->sql_free_result($res);
			}
		}
		return $result;
	}

	/*
	 * Returns files in list of directories
	 *
	 * @params	array		Directories
	 * @return	array		Array of Files
	 */
	function getFiles($dirs) {
		$result = array();
		foreach ($dirs as $dir) {
			$files = t3lib_div::getFilesInDir(PATH_site.$dir);
			$result[$dir]= array_values($files);
		}
		return $result;
	}

	/**
	 * Returns all active Typo3 Tables with a TCA array
	 *
	 * @return	array		list of all table names for which TCA arrays do exist
	 */
	function getAllTables() {
		$tables = array();
		while (list($name, $tca) = each($GLOBALS['TCA'])) {
			$tables[] = $name;
		}
		return $tables;
	}

	/**
	 * Returns all paths and fields from given tables
	 *
	 * @param	array		list of table names
	 * @return	array		list of all paths and fields
	 */
	function getAllPathsAndFields($tables) {
		$paths = array();
		foreach ($tables as $table) {
			t3lib_div::loadTCA($table);
			foreach ($GLOBALS['TCA'][$table]['columns'] as $name => $column) {
				if (($column['config']['type'] == 'group') && ($column['config']['internal_type'] == 'file') && ($uf = $column['config']['uploadfolder'])) {
					if (!$paths[$uf]) {
						$paths[$uf] = array();
						$paths[$uf]['exts'] = array();
						$paths[$uf]['tables'] = array();
					}
					if (!$paths[$uf]['tables'][$table]) {
						$paths[$uf]['tables'][$table] = array();
					}
					if ($column['config']['disallowed']) {
						$exts = t3lib_div::trimExplode(',', $column['config']['disallowed'], 1);
						foreach ($exts as $ext) {
							$ext = strtolower(trim($ext));
							if (!in_array($ext, $paths[$uf]['exts'])) {
								$paths[$uf]['disallowed_exts'][] = $ext;
							}
						}
					} else {
						$exts = t3lib_div::trimExplode(',', $column['config']['allowed'], 1);
						foreach ($exts as $ext) {
							$ext = strtolower(trim($ext));
							if (!in_array($ext, $paths[$uf]['exts'])) {
								$paths[$uf]['allowed_exts'][] = $ext;
							}
						}
					}
					$paths[$uf]['tables'][$table][] = $name;
				}
			} // EOF: while (list($name, $column) = each($GLOBALS['TCA'][$table]['columns']))
		} // EOF: foreach ($tables as $table)
		return $paths;
	}

	/*
	 * Returns the image fields found in a flex form DS
	 *
	 * @params	array		The XML Structure as PHP array
	 * @params	array		The array which contains the return values and gets filled while traveresing
	 * @params 	array		A path to the actual item
	 * @params 	boolean	If we are in a section
	 * @return	array		A array of images and their uploadfolders.
	 */
	function getImageFields_Flex_Rec($xml_ar, $fields = array(), $path = array()) {
		$orig_path = $path;
		if (is_array($xml_ar)) {
			foreach($xml_ar as $label => $xml_sub_ar) {
				$lastname = end($path);
				$path[] = $label.($xml_ar['section']?'|section':'');
				if ($label === 'TCEforms') {
					if (($xml_sub_ar['config']['type'] === 'group') && ($xml_sub_ar['config']['internal_type'] === 'file') && ($uf = $xml_sub_ar['config']['uploadfolder'])) {
						$allowed = $xml_sub_ar['config']['allowed'];
						$disallowed = $xml_sub_ar['config']['disallowed'];
						$new = array('field' => $lastname, 'path' => $path, 'uploadfolder' => $uf, 'allowed' => $allowed, 'disallowed' => $disallowed);
						if (!in_array($new, $fields))	{
							$fields[] = $new;
						}
					}
				} else {
					$fields = $this->getImageFields_Flex_Rec($xml_sub_ar, $fields, $path);
				}
				$path = $orig_path;
			}
		}
		return $fields;
	}

	/**
	 * Returns all paths and fields from given tables flex-form fields
	 *
	 * @param	array		list of table names
	 * @return	array		list of all paths, tables, flex-form-row-field, flex-form-field whic can contain images.
	 */
	function getFlexTables($tables) {
		global $LANG;
		$flex = array();
		foreach ($tables as $table) {
			t3lib_div::loadTCA($table);
			foreach ($GLOBALS['TCA'][$table]['columns'] as $name => $column) {
				if ($column['config']['type'] == 'flex') {
					$flex[$table][$name] = $column;
				} // EOF: if ($column['config']['type'] == 'flex')
			} // EOF: while (list($name, $column) = each($GLOBALS['TCA'][$table]['columns']))
		} // EOF: foreach ($tables as $table)
		return $flex;
	}

	/**
	 * Generates the module content
	 *
	 * @return	void		nothing
	 */
	function moduleContent(){
		global $LANG;

		// Switch function
		switch((string)$this->MOD_SETTINGS['function'])	{

		  // Introducting text
      case 1:
		  $content = $LANG->getLL('IntroContent');
		  $this->content.=$this->doc->section($LANG->getLL('IntroTitle'),$content,0,1);
		  break;

		  // Delete files
      case 2:
			$path_site = str_replace(t3lib_div::getIndpEnv(TYPO3_DOCUMENT_ROOT), '', PATH_site);
			$cmd = strlen(t3lib_div::_POST('cmd'))?t3lib_div::_POST('cmd'):(strlen(t3lib_div::_GET('cmd'))?t3lib_div::_GET('cmd'):'');
			switch($cmd) {

			// Delete Single File
			case 'clear':
				$content .= $LANG->getLL('ClearMsg').':&nbsp;'.$_GET['file'].'<br /><br /><a href="index.php">'.$LANG->getLL('backlink').'</a>';
				unlink(PATH_site.t3lib_div::_GET('file'));
				$this->content.=$this->doc->section($LANG->getLL('ClearTitle'),$content,0,1);
				break;

			// Delete many files
			case 'clearfiles':
				$todelete = t3lib_div::_POST('todelete');
				$files = unserialize(base64_decode($todelete));

				$content .= '<table width="450" border="0" cellspacing="2" cellpadding="2">'.chr(10);
				if ($files['unreferenced'] || $files['referencedDeleted']) {
					if ($files['referencedDeleted']) {
						foreach ($files['referencedDeleted'] as $file) {
							$content .= '<tr>';
							unlink(PATH_site.$file);
							$content .= '<td bgcolor="#FFAD37">DELETED: '.$file.'</td>';
							$content .='</tr>'.chr(10);
							$files = 1;
						}
					}
					if ($files['unreferenced']) {
						foreach ($files['unreferenced'] as $file) {
							$content .= '<tr>';
							unlink(PATH_site.$file);
							$content .= '<td bgcolor="#C0FF03">DELETED: '.$file.'</td>';
							$content .='</tr>'.chr(10);
							$files = 1;
						}
					}
				} else {
					$content .= '<tr><td>'.$LANG->getLL('noFiles').'</td></tr>';
				}

				$content .= '</table>'.chr(10);
				$this->content.=$this->doc->section($LANG->getLL('IndexTitle'),$content,0,1);
				$this->content.=$this->doc->spacer(5);
				$this->content.='<a href="index.php">'.$LANG->getLL('backlink').'</a>';
				break;

			// Read files and compare them to database. Can be very time consuming
			default:
				// Get all deletable files
				list($referencedFilesDeleted, $unreferencedFiles) = $this->getDeleteableFiles();

				$content .= '<table width="450" border="0" cellspacing="2" cellpadding="2">'.chr(10);
				if	(count($referencedFilesDeleted) || count($unreferencedFiles)) {
					foreach ($referencedFilesDeleted as $file) {
						$content .= '<tr>';
						$enc = urlencode($file);
						$content .= '<td bgcolor="#FFAD37">'.$file.'</td><td bgcolor="#E0FF82" width="40"><a href="index.php?cmd=clear&file='.$enc.'">'.$LANG->getLL('clear').'</a></td>';
						$content .='</tr>'.chr(10);
						$files = 1;
					}
					foreach ($unreferencedFiles as $file) {
						$content .= '<tr>';
						$enc = urlencode($file);
						$content .= '<td bgcolor="#C0FF03">'.$file.'</td><td bgcolor="#E0FF82" width="40"><a href="index.php?cmd=clear&file='.$enc.'">'.$LANG->getLL('clear').'</a></td>';
						$content .='</tr>'.chr(10);;
						$files = 1;
					}
				} else {
					$content .= '<tr><td>'.$LANG->getLL('noFiles').'</td></tr>';
				}

				$content .= '</table>';
				$content .= '<table>';
				$content .= '<tr><td bgcolor="#C0FF03" width="20" height="20">&nbsp;</td><td>'.$LANG->getLL('codeorange').'</td></tr>';
				$content .= '<tr><td bgcolor="#FFAD37" width="20" height="20">&nbsp;</td><td>'.$LANG->getLL('codered').'</td></tr>';
				$content .= '</table>'.chr(10);
				$content .= '<table>';
				$content .= '<tr><td bgcolor="#C0FF03" height="20" valign="middle"><form name="clearall_norefer" action="index.php" method="POST" enctype="multipart/form-data"><input type="submit" name="submit" value="'.$LANG->getLL('clearall_notdeleted').'" style="border: 1px solid #C0FF03; background-color: #C0FF03; width: 100%; height: 100%;"><input type="hidden" name="todelete" value="'.base64_encode(serialize(array('unreferenced' => $unreferencedFiles))).'"><input type="hidden" name="cmd" value="clearfiles"></form></td></tr>';
				$content .= '<tr><td bgcolor="#FFAD37" height="20" valign="middle"><form name="clearall_all" action="index.php" method="POST" enctype="multipart/form-data"><input type="submit" name="submit" value="'.$LANG->getLL('clearall_all').'" onClick="return confirm(\''.$LANG->getLL('confirm_deleteall').';" style="border: 1px solid #FFAD37; background-color: #FFAD37; width: 100%; height: 100%;"><input type="hidden" name="todelete" value="'.base64_encode(serialize(array('unreferenced' => $unreferencedFiles, 'referencedDeleted' => $referencedFilesDeleted))).'"><input type="hidden" name="cmd" value="clearfiles"></form></td></tr>';
				$content .= '</table>'.chr(10);
				$this->content.=$this->doc->section($LANG->getLL('IndexTitle'),$content,0,1);
				break;
			} // EOF: switch(t3lib_div::_GET('cmd'))
			break;
		} // EOF: switch((string)$this->MOD_SETTINGS['function'])
	} // EOF: function moduleContent()


	/*
	 * Parses the basic Flexform data array.
	 *
	 * @param	 array		The XML Data as PHP array
	 * @param	 array		The field description which we are currently processing
	 * @param	 array		The return value, passed by reference
	 * @param	 integer	The type. 1=deleted record, 2=normal record
	 * @return	void
	 */
	function parseFlexData($xmlData, $field, &$result, $type)	{
		$fpe = array_shift($field['path']);
		if ($fpe==='sheets')	{
			$sheet = array_shift($field['path']);
			$xmlData = $xmlData[$sheet];
			$fpe = array_shift($field['path']);
		} else	{
			$xmlData = $xmlData['sDEF'];
		}
		if ($fpe==='ROOT')	{
			if (is_array($xmlData))	{
				foreach ($xmlData as $lKey => $lArr)	{
					$this->parseFlexData_LLang($lArr, $field, $result, $type);
				}
			}
		}
	}

	/*
	 * Parses hierarchical field structures
	 *
	 * @param	 array		The XML Data as PHP array
	 * @param	 array		The field description which we are currently processing
	 * @param	 array		The return value, passed by reference
	 * @param	 integer	The type. 1=deleted record, 2=normal record
	 * @return	void
	 */
	function parseFlexData_LLang($xmlData, $field, &$result, $type)	{
		$fpe = array_shift($field['path']);
		if ($fpe==='el')	{
			$f = array_shift($field['path']);
			if (is_array($xmlData['el']))	{
				$this->parseFlexData_LLang($xmlData['el'][$f], $field, $result, $type);
				$xmlData = $xmlData['el'][$f];
			}
			else	{
				$this->parseFlexData_LLang($xmlData[$f], $field, $result, $type);
				$xmlData = $xmlData[$f];
			}
		} elseif ($fpe==='el|section')	{
			$f = array_shift($field['path']);
			if (is_array($xmlData['el']))	{
				foreach ($xmlData['el'] as $idx => $subData)	{
					$this->parseFlexData_LLang($subData[$f]['el'], $field, $result, $type);
				}
			}
		} elseif ($fpe==='TCEforms')	{
			if (is_array($xmlData))	{
				foreach ($xmlData as $vKey => $vVal)	{
					switch ($type)	{
						case 1:
							$result[$field['uploadfolder']]['referenced_deleted'][] = $vVal;
						break;
						case 2:
							$result[$field['uploadfolder']]['referenced'][] = $vVal;
						break;
					}
				}
			}
		}
	}

	/*
	 *	Returns all images referenced from within FlexForms. This function
	 * can be very time consuming.
	 *
	 * @param	array		Tables which contain flex-form elements
	 * @return	array		Paths with images in flex-forms
	 */
	function getFlexPathsAndFiles($flex_tables) {
		$result = array();
		foreach($flex_tables as $table => $ar) {
			t3lib_div::loadTCA($table);
			$deleted_field = $GLOBALS['TCA'][$table]['ctrl']['delete']?$GLOBALS['TCA'][$table]['ctrl']['delete']:0;
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $table, '');
			while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
				foreach ($ar as $fieldName => $fieldAr) {
					$config = $fieldAr['config'];
					$dataStructArray = t3lib_BEfunc::getFlexFormDS($config, $row, $table);
					if (is_array($dataStructArray)) {
						$imageFields = $this->getImageFields_Flex_Rec($dataStructArray);
						if (count($imageFields)&&strlen($row[$fieldName])) {
							$xmlData = $row[$fieldName];
							$editData = t3lib_div::xml2array($xmlData);
							if (!is_array($editData))	{
								continue;
							}
							foreach($imageFields as $imageField) {
								if ($deleted_field) {
									if ($row[$deleted_field]) {
										$this->parseFlexData($editData['data'], $imageField, $result, 1);
									} else {
										$this->parseFlexData($editData['data'], $imageField, $result, 2);
									}
								} else {
									$this->parseFlexData($editData['data'], $imageField, $result, 2);
								}
							}
						} // EOF: if (count($imageFields))
					} // EOF: if (is_array($dataStructArray))
				} // EOF: foreach ($ar as $fieldName => $fieldAr)
			} // EOF: while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
		} // EOF: foreach($flex_tables as $table => $ar)
		return $result;
	} // EOF: function getFlexPathsAndFiles($flex_tables)


	/*
	 * Returns array of all referenced files whose records are deleted and
	 * those records who have no reference at all
	 *
	 * @return	array		Referenced-deleted-files, Unreferenced files
	 */
	function getDeleteableFiles() {
		$all_tables = $this->getAllTables();

		$flex_tables = $this->getFlexTables($all_tables);

		$paths_and_fields = $this->getAllPathsAndFields($all_tables);

		$paths_and_files = $this->getReferencedFiles($paths_and_fields);

		$flex_paths_and_files = $this->getFlexPathsAndFiles($flex_tables);

		$paths = array_merge(array_keys($paths_and_fields), array_keys($flex_paths_and_files));
		$paths = array_unique($paths);

		$files = $this->getFiles($paths);

		$referencedFilesDeleted = array();
		$unreferencedFiles = array();
		foreach ($files as $path => $files_ar) {
			$flex_files_referenced_deleted = is_array($flex_paths_and_files[$path]['referenced_deleted']) ? $flex_paths_and_files[$path]['referenced_deleted'] : array();
			$flex_files_referenced = is_array($flex_paths_and_files[$path]['referenced']) ? $flex_paths_and_files[$path]['referenced'] : array();
			$normal_files_referenced_deleted = is_array($paths_and_files[$path]['referenced_deleted']) ? $paths_and_files[$path]['referenced_deleted'] : array();
			$normal_files_referenced = is_array($paths_and_files[$path]['referenced']) ? $paths_and_files[$path]['referenced'] : array();
			$all_files = array_merge($flex_files_referenced_deleted, $flex_files_referenced, $normal_files_referenced_deleted, $normal_files_referenced);
			$referenced_files = array_merge($flex_files_referenced, $normal_files_referenced);
			$referenced_files_deleted = array_merge($flex_files_referenced_deleted, $normal_files_referenced_deleted);

			$unreferencedFiles_ar = array_diff($files_ar, $all_files);

			$referencedFilesDeleted_ar = array_intersect($files_ar, array_diff($referenced_files_deleted, $referenced_files));
			foreach ($unreferencedFiles_ar as $file) {
				$file = $path.'/'.$file;
				$unreferencedFiles[] = $file;
			}
			foreach ($referencedFilesDeleted_ar as $file) {
				$file = $path.'/'.$file;
				$referencedFilesDeleted[] = $file;
			}

		}
		return array($referencedFilesDeleted, $unreferencedFiles);
	}

} // EOF: class tx_kbcleanfiles_module1 extends t3lib_SCbase

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/kb_cleanfiles/mod1/index.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/kb_cleanfiles/mod1/index.php']);
}

// Make instance:
$SOBE = t3lib_div::makeInstance('tx_kbcleanfiles_module1');
$SOBE->init();

// Include files?
reset($SOBE->include_once);
while(list(,$INC_FILE)=each($SOBE->include_once))	{include_once($INC_FILE);}

$SOBE->main();
$SOBE->printContent();

?>
