<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

require_once('/home/inouit/TYPO3/src/localconf/localconf.php');


$TYPO3_CONF_VARS['SYS']['sitename'] = 'Typo3 Dummy';

	// Default password is "joh316" :
$TYPO3_CONF_VARS['BE']['installToolPassword'] = 'bacb98acf97e0b6112b1d1b650b84971';

$TYPO3_CONF_VARS['EXT']['extList'] = 'info,perm,func,filelist,about,version,tsconfig_help,context_help,extra_page_cm_options,impexp,sys_note,tstemplate,tstemplate_ceditor,tstemplate_info,tstemplate_objbrowser,tstemplate_analyzer,func_wizards,wizard_crpages,wizard_sortpages,lowlevel,install,belog,beuser,aboutmodules,setup,taskcenter,info_pagetsconfig,viewpage,rtehtmlarea,css_styled_content,t3skin,t3editor,reports,felogin';

$typo_db_extTableDef_script = 'extTables.php';

## INSTALL SCRIPT EDIT POINT TOKEN - all lines after this points may be changed by the install script!

$TYPO3_CONF_VARS['EXT']['extList'] = 'css_styled_content,info,perm,func,filelist,about,version,tsconfig_help,context_help,extra_page_cm_options,impexp,sys_note,tstemplate,tstemplate_ceditor,tstemplate_info,tstemplate_objbrowser,tstemplate_analyzer,func_wizards,wizard_crpages,wizard_sortpages,lowlevel,install,belog,beuser,aboutmodules,setup,taskcenter,info_pagetsconfig,viewpage,rtehtmlarea,t3skin,t3editor,reports,felogin,gc_lib,skin_dummy,skin,automaketemplate,kb_nescefe,p2_realurl,static_info_tables,captcha,jb_gd_resize,bvd_set_page_title,wec_contentelements,realurl,realurlmanagement,tscobj,weeaar_googlesitemap,indexed_search,irfaq,tt_news,mbl_newsevent,powermail,ameos_dragndropupload,skinFlex,scriptmerger';	// Modified or inserted by TYPO3 Extension Manager. Modified or inserted by TYPO3 Core Update Manager. 
// Updated by TYPO3 Core Update Manager 17-10-12 22:38:59
$TYPO3_CONF_VARS['SYS']['encryptionKey'] = '4559a63a457268c2b17e52be08753a4b3d6d26d6457dba847a4936fc0202bf7565124b2c705adc192c286b4f1450024b';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['SYS']['compat_version'] = '4.5';	//  Modified or inserted by TYPO3 Install Tool.
$typo_db_username = 'root';	//  Modified or inserted by TYPO3 Install Tool.
$typo_db_password = 'Kpouil*42';	//  Modified or inserted by TYPO3 Install Tool.
$typo_db_host = 'localhost';	//  Modified or inserted by TYPO3 Install Tool.
$typo_db = 'typo3_dummy';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['BE']['installToolPassword'] = 'd700366a0dd0b5e458d30f34d2dcb17d';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['GFX']['im'] = '0';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['GFX']['jpg_quality'] = '90';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['SYS']['sitename'] = 'Dummy Site';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['BE']['versionNumberInFilename'] = '0';	//  Modified or inserted by TYPO3 Install Tool.
// Updated by TYPO3 Install Tool 17-10-12 22:42:04
$TYPO3_CONF_VARS['EXT']['extConf']['em'] = 'a:1:{s:17:"selectedLanguages";s:2:"fr";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extList_FE'] = 'css_styled_content,version,install,rtehtmlarea,t3skin,felogin,gc_lib,skin_dummy,skin,automaketemplate,kb_nescefe,p2_realurl,static_info_tables,captcha,jb_gd_resize,bvd_set_page_title,wec_contentelements,realurl,realurlmanagement,tscobj,weeaar_googlesitemap,indexed_search,irfaq,tt_news,mbl_newsevent,powermail,ameos_dragndropupload,skinFlex,scriptmerger';	// Modified or inserted by TYPO3 Extension Manager. 
$TYPO3_CONF_VARS['EXT']['extConf']['rtehtmlarea'] = 'a:13:{s:21:"noSpellCheckLanguages";s:23:"ja,km,ko,lo,th,zh,b5,gb";s:15:"AspellDirectory";s:15:"/usr/bin/aspell";s:17:"defaultDictionary";s:2:"en";s:14:"dictionaryList";s:2:"en";s:20:"defaultConfiguration";s:105:"Typical (Most commonly used features are enabled. Select this option if you are unsure which one to use.)";s:12:"enableImages";s:1:"1";s:20:"enableInlineElements";s:1:"0";s:19:"allowStyleAttribute";s:1:"1";s:24:"enableAccessibilityIcons";s:1:"0";s:16:"enableDAMBrowser";s:1:"0";s:16:"forceCommandMode";s:1:"0";s:15:"enableDebugMode";s:1:"0";s:23:"enableCompressedScripts";s:1:"1";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['captcha'] = 'a:21:{s:6:"useTTF";s:1:"0";s:8:"imgWidth";s:2:"95";s:9:"imgHeight";s:2:"25";s:12:"captchaChars";s:1:"5";s:9:"noNumbers";s:1:"0";s:4:"bold";s:1:"0";s:7:"noLower";s:1:"0";s:7:"noUpper";s:1:"0";s:13:"letterSpacing";s:2:"16";s:5:"angle";s:2:"20";s:5:"diffx";s:1:"0";s:5:"diffy";s:1:"2";s:4:"xpos";s:1:"3";s:4:"ypos";s:1:"4";s:6:"noises";s:1:"6";s:9:"backcolor";s:7:"#f4f4f4";s:9:"textcolor";s:7:"#000000";s:11:"obfusccolor";s:7:"#c0c0c0";s:8:"fontSize";s:2:"16";s:8:"fontFile";s:0:"";s:12:"excludeChars";s:14:"gijloGIJLO0169";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['wec_contentelements'] = 'a:1:{s:29:"includeDefaultContentElements";s:1:"0";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['tt_news'] = 'a:20:{s:13:"useStoragePid";s:1:"1";s:17:"requireCategories";s:1:"0";s:18:"useInternalCaching";s:1:"1";s:11:"cachingMode";s:6:"normal";s:13:"cacheLifetime";s:1:"0";s:13:"cachingEngine";s:8:"internal";s:11:"treeOrderBy";s:3:"uid";s:13:"prependAtCopy";s:1:"1";s:5:"label";s:5:"title";s:9:"label_alt";s:0:"";s:10:"label_alt2";s:0:"";s:15:"label_alt_force";s:1:"0";s:21:"categorySelectedWidth";s:1:"0";s:17:"categoryTreeWidth";s:1:"0";s:25:"l10n_mode_prefixLangTitle";s:1:"1";s:22:"l10n_mode_imageExclude";s:1:"1";s:20:"hideNewLocalizations";s:1:"0";s:24:"writeCachingInfoToDevlog";s:10:"disabled|0";s:23:"writeParseTimesToDevlog";s:1:"0";s:18:"parsetimeThreshold";s:3:"0.1";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['mbl_newsevent'] = 'a:1:{s:14:"multiLineWhere";s:1:"0";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['powermail'] = 'a:8:{s:10:"usePreview";s:1:"1";s:12:"cssSelection";s:1:"1";s:14:"feusersPrefill";s:70:"name, address, telephone, fax, email, zip, city, country, www, company";s:12:"disableIPlog";s:1:"0";s:20:"disableBackendModule";s:1:"0";s:16:"disableStartStop";s:1:"0";s:7:"useIRRE";s:1:"1";s:12:"fileToolPath";s:9:"/usr/bin/";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['realurl'] = 'a:5:{s:10:"configFile";s:25:"typo3conf/realurlconf.php";s:14:"enableAutoConf";s:1:"0";s:14:"autoConfFormat";s:1:"0";s:12:"enableDevLog";s:1:"0";s:19:"enableChashUrlDebug";s:1:"0";}';	//  Modified or inserted by TYPO3 Extension Manager.
// Updated by TYPO3 Extension Manager 29-10-12 11:37:15
?>
