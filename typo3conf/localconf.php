<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TYPO3_CONF_VARS['SYS']['sitename'] = 'New TYPO3 site';

	// Default password is "joh316" :
$TYPO3_CONF_VARS['BE']['installToolPassword'] = 'bacb98acf97e0b6112b1d1b650b84971';

$TYPO3_CONF_VARS['EXT']['extList'] = 'info,perm,func,filelist,about,version,tsconfig_help,context_help,extra_page_cm_options,impexp,sys_note,tstemplate,tstemplate_ceditor,tstemplate_info,tstemplate_objbrowser,tstemplate_analyzer,func_wizards,wizard_crpages,wizard_sortpages,lowlevel,install,belog,beuser,aboutmodules,setup,taskcenter,info_pagetsconfig,viewpage,rtehtmlarea,css_styled_content,t3skin,t3editor,reports,felogin';

$typo_db_extTableDef_script = 'extTables.php';

## INSTALL SCRIPT EDIT POINT TOKEN - all lines after this points may be changed by the install script!

$TYPO3_CONF_VARS['EXT']['extList'] = 'css_styled_content,info,perm,func,filelist,about,version,tsconfig_help,context_help,extra_page_cm_options,impexp,sys_note,tstemplate,tstemplate_ceditor,tstemplate_info,tstemplate_objbrowser,tstemplate_analyzer,func_wizards,wizard_crpages,wizard_sortpages,lowlevel,install,belog,beuser,aboutmodules,setup,taskcenter,info_pagetsconfig,viewpage,rtehtmlarea,t3skin,t3editor,reports,felogin,gc_lib,skin_dummy,skin,automaketemplate';	// Modified or inserted by TYPO3 Extension Manager. Modified or inserted by TYPO3 Core Update Manager. 
// Updated by TYPO3 Core Update Manager 17-10-12 22:38:59
$TYPO3_CONF_VARS['SYS']['encryptionKey'] = '4559a63a457268c2b17e52be08753a4b3d6d26d6457dba847a4936fc0202bf7565124b2c705adc192c286b4f1450024b';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['SYS']['compat_version'] = '4.5';	//  Modified or inserted by TYPO3 Install Tool.
$typo_db_username = 'github';	//  Modified or inserted by TYPO3 Install Tool.
$typo_db_password = 'github*46';	//  Modified or inserted by TYPO3 Install Tool.
$typo_db_host = 'localhost';	//  Modified or inserted by TYPO3 Install Tool.
$typo_db = 'typo3_dummy';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['BE']['installToolPassword'] = 'd700366a0dd0b5e458d30f34d2dcb17d';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['GFX']['im'] = '0';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['GFX']['jpg_quality'] = '90';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['SYS']['sitename'] = 'Dummy Site';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['BE']['versionNumberInFilename'] = '0';	//  Modified or inserted by TYPO3 Install Tool.
// Updated by TYPO3 Install Tool 17-10-12 22:42:04
$TYPO3_CONF_VARS['EXT']['extConf']['em'] = 'a:1:{s:17:"selectedLanguages";s:2:"fr";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extList_FE'] = 'css_styled_content,version,install,rtehtmlarea,t3skin,felogin,gc_lib,skin_dummy,skin,automaketemplate';	// Modified or inserted by TYPO3 Extension Manager. 
// Updated by TYPO3 Extension Manager 18-10-12 22:49:11
?>