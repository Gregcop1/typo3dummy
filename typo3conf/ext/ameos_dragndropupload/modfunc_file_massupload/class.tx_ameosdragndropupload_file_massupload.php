<?php
	
	require_once(PATH_txdam.'lib/class.tx_dam_scbase.php');
	require_once(t3lib_extmgm::extPath("ameos_dragndropupload") . 'class.tx_ameosdragndropupload.php');

	class tx_ameosdragndropupload_file_massupload extends tx_dam_SCbase {
		
		function main() {
			
			#$this->pObj->markers['FOLDER_INFO'] = '[' . $this->pathInfo['mount_name'] . ']:' . $this->pathInfo['dir_path_from_mount'];
			$this->pObj->markers['FOLDER_INFO'] = tx_dam_guiFunc::getPathBreadcrumbMenu($this->pathInfo, $browsable=TRUE, $maxLength=35);
			$iconFolder = tx_dam::icon_getFolder($this->pathInfo);
			$this->pObj->markers['PAGE_ICON'] = '<img'.t3lib_iconWorks::skinImg($GLOBALS["BACK_PATH"], $iconFolder, 'width="18" height="16"').' alt="" />';
			
			
			$oDnd = t3lib_div::makeInstance("tx_ameosdragndropupload");
			return $oDnd->render(
				tx_dam::path_makeAbsolute(
					$this->pObj->path
				),
				TRUE
			);
		}
	}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ameos_dragndropupload/modfunc_file_massupload/class.tx_ameosdragndropupload_file_massupload.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ameos_dragndropupload/modfunc_file_massupload/class.tx_ameosdragndropupload_file_massupload.php']);
}

?>