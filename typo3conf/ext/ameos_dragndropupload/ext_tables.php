<?php

	if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

	if(TYPO3_MODE == "BE") {

		t3lib_extMgm::addModule('file','ameosdragndropupload','',t3lib_extMgm::extPath($_EXTKEY).'mod1/');
		// add mass upload module function

		t3lib_extMgm::insertModuleFunction(
			'txdamM1_file',
			'tx_ameosdragndropupload_file_massupload',
			t3lib_extmgm::extPath("ameos_dragndropupload") . 'modfunc_file_massupload/class.tx_ameosdragndropupload_file_massupload.php',
			"Mass upload"
			//'LLL:EXT:dam/modfunc_file_list/locallang.xml:tx_dam_file_list.title'
		);

		$GLOBALS["TBE_MODULES_EXT"]["xMOD_alt_clickmenu"]["extendCMclasses"][] = array(
			"name" => "tx_ameosdragndropupload_cm1",
			"path" => t3lib_extMgm::extPath($_EXTKEY)."cm1/class.tx_ameosdragndropupload_cm1.php"
		);
	}
?>