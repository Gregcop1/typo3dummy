<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Grégory Copin <gcopin@inouit.com>
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

require_once(PATH_tslib.'class.tslib_pibase.php');

/**
 * Plugin 'Library GC' for the 'gc_lib' extension.
 *
 * @author	Grégory Copin <gcopin@inouit.com>, Jeremy Viste <jviste@inouit.com>
 * @package	TYPO3
 * @subpackage tx_gclib
 */
 class tx_gclib extends tslib_pibase {
 	var $prefixId      = 'tx_gclib';
	var $scriptRelPath = 'class.tx_gclib.php';
	var $extKey        = 'gc_lib';
	var $pi_checkCHash = true;
	var $conf;
	var $config;


	/**
	 * The main method of the PlugIn
	 *
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		if (!$this->cObj)
			$this->cObj = t3lib_div::makeInstance("tslib_cObj");
		$this->flexform = t3lib_div::xml2array($this->cObj->data['pi_flexform']);

		if($this->pi_getFFvalue($this->flexform, 'additionalTSConfig', 'sDEF', 'lDEF', 'vDEF')) {
			$ffTS = $this->pi_getFFvalue($this->flexform, 'additionalTSConfig', 'sDEF', 'lDEF', 'vDEF');

			require_once(PATH_t3lib.'class.t3lib_tsparser.php');
			$TSParser = t3lib_div::makeInstance('t3lib_tsparser');
			$TSParser->setup = $this->conf['config.'];
			$TSParser->parse($ffTS);
			$this->conf['config.'] = $TSParser->setup;
		}

		$this->config = $this->mergeConfAndFlexform($this->conf['config.']);
	}

	 /**
	 * Method to merge two array recursively
	 *
	 * @param	array		$arr1: Array to override
	 * @param	array		$arr2: Array wich override
	 * @return	Merged array
	 */
	public static function mergeArrayRecursive($arr1, $arr2) {
		$savArr1 = $arr1;
		$keys1 = is_array($arr1) ? array_keys($arr1) : array();
		$keys2 = is_array($arr2) ? array_keys($arr2) : array();
		$keys = array_merge($keys1, $keys2);

		if(count($keys)) {
			foreach($keys as $key) {
				if(isset($arr2[$key])){
					if(is_array($arr2[$key])){
						if(!isset($arr1[$key])) {
							$arr1[$key] = array();
						}
						$arr1[$key] = tx_gclib::mergeArrayRecursive($arr1[$key], $arr2[$key]);
					}else {
						$arr1[$key] = $arr2[$key];
					}
				}
			}
		}

		return $arr1;
	}

	 /**
	 * Method to merge typoscript and flexform configuration
	 *
	 * @param	array		$conf: The PlugIn configuration
	 * @return	Merged array configuration
	 */
	function mergeConfAndFlexform($configuration) {
		$mergedConfiguration = array();

		if(is_array($configuration) && count($configuration)>0) {
			foreach($configuration as $key => $val){
				if(is_array($val)) {
					$mergedConfiguration[$key] = $this->mergeConfAndFlexform($val);
				}else {
					list($sheet, $lang, $field, $value) = explode('|', $val);
					if( $field ) {
						$mergedConfiguration[$key] = $this->pi_getFFvalue($this->flexform, $field, $sheet, $lang, $value);
					}else{
						$mergedConfiguration[$key] = $val;
					}
					if (method_exists($this->cObj,'stdWrap')) {
						$mergedConfiguration[$key] = $this->cObj->stdWrap( $mergedConfiguration[$key], $configuration[$key.'.'] );
					} else {
						$cObj = t3lib_div::makeInstance("tslib_cObj");
						$mergedConfiguration[$key] = $cObj->stdWrap( $mergedConfiguration[$key], $configuration[$key.'.'] );
					}
				}
			}
		}

		return $mergedConfiguration;
	}

	/**
	 * Method to get a recursive array of page ids
	 *
	 * @param	string $pid: UID of the first page
	 * @param	int	$recursiveLevel: Level of recursivity
	 *
	 * @return	array	Array of recursive pid
	 */
	function getRecursivePid($pid, $recursiveLevel = 0) {
		$pids = array();
		$pids[] = $pid;

		if($recursiveLevel > 0) {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'pages.uid',
				'pages',
				'pages.pid = "'.$pid.'"'.$this->cObj->enableFields('pages')
			);
			if(is_array($res) && count( $res )) {
				foreach( $res as $item ) {
					$pids = array_merge( $pids, $this->getRecursivePid($item['uid'], ($recursiveLevel-1) ));
				}
			}
		}

		return $pids;
	}


	/**
	* Method to make an instance of class with predifened configuration
	*
	* @param	string	$path: path to the class
	* @param	string	$className: name of the class
	* @param	... All additionnal parameters are set as main function parameter of the new object
	*****************************************************************************/
  	function &makeInstance($path,$className){
  		require_once($path);
		$obj = t3lib_div::makeInstance($className);
		$obj->parent = &$this;
		$obj->cObj = clone $this->cObj;

		if(method_exists($obj,'main')) {
			$args = func_get_args();
			$args = array_splice($args, 2);

			return call_user_func_array(array($obj,'main'), $args);
		}
	}


	/**
	* Auto generate the ext_typoscript_setup file
	*
	* @param	array	$folders: folders to check
	*
	*****************************************************************************/
  	public static function autoGenerateSetup($key, $folders){
  		$ext_path = t3lib_extMgm::extPath($key);
  		$setup = '';
  		$eol = '
';
  		if($folders && count($folders)) {
  			foreach ($folders as $folder) {
  				if (is_dir($ext_path.$folder) && $handle = opendir($ext_path.$folder)) {
				    $setup .= '### Include du dossier '.$folder.$eol;
				    while (false !== ($entry = readdir($handle))) {
				        if($entry!='.' && $entry!='..' && $extension = strrchr($entry,'.') && (strrchr($entry,'.') == '.ts' ) || strrchr($entry,'.') == '.txt' ) {

				        	$setup .= '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$key.'/'.$folder.$entry.'">'.$eol;
				        }
				    }

				    closedir($handle);
				}
  			}

  			if($setup != '') {
  				t3lib_div::writeFile($ext_path.'ext_typoscript_setup.txt',$setup);
  			}
  		}
  	}
 }


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/gc_lib/class.tx_gclib.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/gc_lib/class.tx_gclib.php']);
}

 ?>
