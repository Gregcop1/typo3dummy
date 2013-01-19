<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007  <>
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


	unset($MCONF);
	require_once('conf.php');
	require_once($BACK_PATH.'init.php');
	require_once($BACK_PATH.'template.php');
	require_once(PATH_t3lib . 'class.t3lib_basicfilefunc.php');

	$LANG->includeLLFile('EXT:ameos_dragndropupload/mod1/locallang.xml');
	$sBackup = $GLOBALS["TBE_MODULES"]["file"];
	$GLOBALS["TBE_MODULES"]["file"] .= ",ameosdragndropupload";
	if($BE_USER->modAccess($MCONF,$bExitOnError=TRUE) == FALSE) {
		// This checks permissions and exits if the users has no permission for entry.
		echo "ERROR - You don't have access permission to Mass upload";
		exit;
	}
	$GLOBALS["TBE_MODULES"]["file"] = $sBackup;
	unset($GLOBALS["TBE_MODULES"]["_temp"]);

	require_once('t38compat.php');

	$oFile = t3lib_div::makeInstance("t3lib_basicFileFunctions");
	$aMsg = array();
	$sTargetDir = "";
	$sRelSubDir = "";

	ob_start();

	if(!empty($_FILES)) {

		$aPost = t3lib_div::_POST();
		reset($aPost["file"]["upload"]);
		while(list(, $aInfos) = each($aPost["file"]["upload"])) {

//			print_r($aInfos);

			$sTargetDir = $oFile->cleanDirectoryName(str_replace("\\", "/", trim($aInfos["target"])));
			$sRelSubDir = $oFile->cleanDirectoryName(str_replace("\\", "/", trim($aInfos["directory"])));
			if(($sFileName = trim(basename($oFile->getUniqueName($oFile->cleanFileName($aInfos["filename"]), $sTargetDir . $sRelSubDir)))) === "") {
				$sFileName = $oFile->cleanFileName($aInfos["filename"]);
			}

/*			print_r("FILENAME:" . $sFileName . "\n");
			print_r("cleanFileName:" . $oFile->cleanFileName($aInfos["filename"]) . "\n");
			print_r("sTargetDir . sRelSubDir:" . $sTargetDir . $sRelSubDir . "\n");
			print_r("getUniqueName:" . $oFile->getUniqueName($oFile->cleanFileName($aInfos["filename"]), $sTargetDir . $sRelSubDir) . "\n");
			print_r(array(
				"sTargetDir" => $sTargetDir,
				"sRelSubDir" => $sRelSubDir,
				"sFileName" => $sFileName
			));*/

			if(t3lib_div::verifyFilenameAgainstDenyPattern($sFileName)) {
				if(substr($sTargetDir, -1, 1) != "/") {
					$sTargetDir .= "/";
				}

				if($sRelSubDir !== "") {
					if(substr($sRelSubDir, 0, 1) == "/") {
						$sRelSubDir = substr($sRelSubDir, 1);
					}

					if(substr($sRelSubDir, -1, 1) != "/") {
						$sRelSubDir .= "/";
					}
				}

				//$aMsg[] = $sTargetDir . $sRelSubDir . $sFileName;

				// création du subdir
				t38compat_mkdir_deep($sTargetDir, $sRelSubDir);
				t3lib_div::upload_copy_move(
					$_FILES["upload_" . $aInfos["data"]]["tmp_name"],
					$sTargetDir . $sRelSubDir . $sFileName
				);
				
				if($aPost["dam"] == 1) {
					require_once(t3lib_extmgm::extPath("dam") . "lib/class.tx_dam.php");
					tx_dam::notify_fileChanged($sTargetDir . $sRelSubDir . $sFileName);
				}
			} else {
				$aMsg[] = "[WARNING] " . $aInfos["filename"] . " is denied by TYPO3 (file ext)";
			}
		}

/*		print_r(t3lib_div::_POST());
		print_r($_FILES);
		print_r($aMsg);*/
		$sMessage = ob_get_flush();
		#error_log($sMessage . "\n\n\n\n\n\n\n\n", 3, "log.txt");

		ob_end_clean();
		//echo("UPLOAD FINISHED\n");
		if(count($aMsg) === 0) {
			echo "OK";
			exit;
		} else {
			echo(implode("\n", $aMsg));
			exit;
		}
	} else {
		ob_end_clean();

		if(t3lib_div::_GET("fromJava") === 1) {
			echo "NOK";
			exit;
		} else {
			if(($sPath = trim(t3lib_div::_GET("id"))) === "") {
				$aFileMounts = $BE_USER->returnFilemounts();

				if(!empty($aFileMounts)) {
					$sFirstKey = array_shift(array_keys($aFileMounts));
					$sPath = $aFileMounts[$sFirstKey]["path"];
				} else {
					t3lib_BEfunc::typo3PrintError ('TYPO3 error','No file mount available','');
					exit;
				}
			} else {
				$sPath = rawurlencode($sPath);
			}

			$sT3ConfUrl = $BACK_PATH . "file_upload.php?tx_ameosdragndropupload=1&target=" . $sPath;
			header("Location: " . $sT3ConfUrl);
			exit;
		}
	}
?>