<?php
/***************************************************************
*  Copyright notice
*  
*  (c) 2006 Jerome Schneider (typo3dev@ameos.com)
*  All rights reserved

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


class tx_ameosdragndropupload_cm1 {
	function main(&$backRef,$menuItems,$table,$uid)	{
		global $BE_USER,$TCA,$LANG;
		
		require(t3lib_extmgm::extPath("ameos_dragndropupload") . "mod1/mconf.php");

		$localItems = Array();
		if ($GLOBALS["BE_USER"]->modAccess($MCONF,0) && !$backRef->cmLevel)	{

			// Returns directly, because the clicked item was not from the filelist
			// in other words: Restrict to filelist module.
			if ($uid)	return $menuItems;
			if (!is_dir($table))	return $menuItems;

			// Adds the regular item:
			$LL = $this->includeLL();

			// Repeat this (below) for as many items you want to add!
			// Remember to add entries in the localconf.php file for additional titles.
			
			$path = $backRef->iParts[0];
			$script = 'file_upload.php';
			$type = "upload";
			$image = 'upload.gif';
			$loc='top.content'.(!$backRef->alwaysContentFrame?'.list_frame':'');
			
			$editOnClick='if('.$loc.'){'.$loc.".document.location=top.TS.PATH_typo3+'".$script.'?tx_ameosdragndropupload=1&target='.rawurlencode($path)."&returnUrl='+top.rawurlencode(".$backRef->frameLocation($loc.'.document').");}";
			
			$localItems["ameos_dragndropupload"] = $backRef->linkItem(
				$GLOBALS["LANG"]->getLLL("cm1_title",$LL),
				$backRef->excludeIcon('<img src="'.t3lib_extMgm::extRelPath("ameos_dragndropupload").'cm1/cm_icon.gif" width="15" height="12" border=0 align=top>'),
				$editOnClick.'return hideCM();'
			);

			$insertIndex = array_search("upload", array_keys($menuItems));
			$insertIndex = (is_null($insertIndex) || $insertIndex === FALSE) ? count($menuItems) : $insertIndex + 0; /* 0 = before, 1 = after classic upload */

			array_splice($menuItems, $insertIndex, 0, $localItems);

			// Simply merges the two arrays together and returns ...
//			$menuItems=array_merge($menuItems, $localItems);

				// Returns directly, because the clicked item was not from the pages table ## (WOP:[cm][1][only_page])
			if ($table!="pages")	return $menuItems;
		}
		return $menuItems;
	}

	/**
	 * Includes the [extDir]/locallang.php and returns the $LOCAL_LANG array found in that file.
	 */
	function includeLL()	{
		include(t3lib_extMgm::extPath("ameos_dragndropupload")."locallang_db.php");
		return $LOCAL_LANG;
	}
} 



if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/ameos_dragndropupload/cm1/class.tx_ameosdragndropupload_cm1.php"])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/ameos_dragndropupload/cm1/class.tx_ameosdragndropupload_cm1.php"]);
}

?>
