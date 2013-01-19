<?php

###########################
## EXTENSION: cms
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/cms/ext_tables.php
###########################

$_EXTKEY = 'cms';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


# TYPO3 SVN ID: $Id$
if (!defined ('TYPO3_MODE'))	die ('Access denied.');


if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModule('web','layout','top',t3lib_extMgm::extPath($_EXTKEY).'layout/');
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_layout','EXT:cms/locallang_csh_weblayout.xml');
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_info','EXT:cms/locallang_csh_webinfo.xml');

	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_cms_webinfo_page',
		t3lib_extMgm::extPath($_EXTKEY).'web_info/class.tx_cms_webinfo.php',
		'LLL:EXT:cms/locallang_tca.xml:mod_tx_cms_webinfo_page'
	);
	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_cms_webinfo_lang',
		t3lib_extMgm::extPath($_EXTKEY).'web_info/class.tx_cms_webinfo_lang.php',
		'LLL:EXT:cms/locallang_tca.xml:mod_tx_cms_webinfo_lang'
	);
}


	// Add allowed records to pages:
t3lib_extMgm::allowTableOnStandardPages('pages_language_overlay,tt_content,sys_template,sys_domain,backend_layout');


// ******************************************************************
// This is the standard TypoScript content table, tt_content
// ******************************************************************
$TCA['tt_content'] = array (
	'ctrl' => array (
		'label' => 'header',
		'label_alt' => 'subheader,bodytext',
		'sortby' => 'sorting',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'title' => 'LLL:EXT:cms/locallang_tca.xml:tt_content',
		'delete' => 'deleted',
		'versioningWS' => 2,
		'versioning_followPages' => true,
		'origUid' => 't3_origuid',
		'type' => 'CType',
		'hideAtCopy' => true,
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' => 'colPos,sys_language_uid',
		'useColumnsForDefaultValues' => 'colPos,sys_language_uid',
		'shadowColumnsForNewPlaceholders' => 'colPos',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'typeicon_column' => 'CType',
		'typeicon_classes' => array(
			'header' => 'mimetypes-x-content-header',
			'textpic' => 'mimetypes-x-content-text-picture',
			'image' => 'mimetypes-x-content-image',
			'bullets' => 'mimetypes-x-content-list-bullets',
			'table' => 'mimetypes-x-content-table',
			'splash' => 'mimetypes-x-content-splash',
			'uploads' => 'mimetypes-x-content-list-files',
			'multimedia' => 'mimetypes-x-content-multimedia',
			'media' => 'mimetypes-x-content-multimedia',
			'menu' => 'mimetypes-x-content-menu',
			'list' => 'mimetypes-x-content-plugin',
			'mailform' => 'mimetypes-x-content-form',
			'search' => 'mimetypes-x-content-form-search',
			'login' => 'mimetypes-x-content-login',
			'shortcut' => 'mimetypes-x-content-link',
			'script' => 'mimetypes-x-content-script',
			'div' => 'mimetypes-x-content-divider',
			'html' => 'mimetypes-x-content-html',
			'text' => 'mimetypes-x-content-text',
			'default' => 'mimetypes-x-content-text',
		),
		'typeicons' => array (
			'header' => 'tt_content_header.gif',
			'textpic' => 'tt_content_textpic.gif',
			'image' => 'tt_content_image.gif',
			'bullets' => 'tt_content_bullets.gif',
			'table' => 'tt_content_table.gif',
			'splash' => 'tt_content_news.gif',
			'uploads' => 'tt_content_uploads.gif',
			'multimedia' => 'tt_content_mm.gif',
			'media' => 'tt_content_mm.gif',
			'menu' => 'tt_content_menu.gif',
			'list' => 'tt_content_list.gif',
			'mailform' => 'tt_content_form.gif',
			'search' => 'tt_content_search.gif',
			'login' => 'tt_content_login.gif',
			'shortcut' => 'tt_content_shortcut.gif',
			'script' => 'tt_content_script.gif',
			'div' => 'tt_content_div.gif',
			'html' => 'tt_content_html.gif'
		),
		'thumbnail' => 'image',
		'requestUpdate' => 'list_type,rte_enabled,menu_type',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_tt_content.php',
		'dividers2tabs' => 1
	)
);

// ******************************************************************
// fe_users
// ******************************************************************
$TCA['fe_users'] = array (
	'ctrl' => array (
		'label' => 'username',
		'default_sortby' => 'ORDER BY username',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'fe_cruser_id' => 'fe_cruser_id',
		'title' => 'LLL:EXT:cms/locallang_tca.xml:fe_users',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'disable',
			'starttime' => 'starttime',
			'endtime' => 'endtime'
		),
		'typeicon_classes' => array(
			'default' => 'status-user-frontend',
		),
		'useColumnsForDefaultValues' => 'usergroup,lockToDomain,disable,starttime,endtime',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php',
		'dividers2tabs' => 1
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'username,password,usergroup,name,address,telephone,fax,email,title,zip,city,country,www,company',
	)
);

// ******************************************************************
// fe_groups
// ******************************************************************
$TCA['fe_groups'] = array (
	'ctrl' => array (
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'delete' => 'deleted',
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'enablecolumns' => array (
			'disabled' => 'hidden'
		),
		'title' => 'LLL:EXT:cms/locallang_tca.xml:fe_groups',
		'typeicon_classes' => array(
			'default' => 'status-user-group-frontend',
		),
		'useColumnsForDefaultValues' => 'lockToDomain',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php',
		'dividers2tabs' => 1
	)
);

// ******************************************************************
// sys_domain
// ******************************************************************
$TCA['sys_domain'] = array (
	'ctrl' => array (
		'label' => 'domainName',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'title' => 'LLL:EXT:cms/locallang_tca.xml:sys_domain',
		'iconfile' => 'domain.gif',
		'enablecolumns' => array (
			'disabled' => 'hidden'
		),
		'typeicon_classes' => array(
			'default' => 'mimetypes-x-content-domain',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php'
	)
);

// ******************************************************************
// pages_language_overlay
// ******************************************************************
$TCA['pages_language_overlay'] = array (
	'ctrl' => array (
		'label'                           => 'title',
		'tstamp'                          => 'tstamp',
		'title'                           => 'LLL:EXT:cms/locallang_tca.xml:pages_language_overlay',
		'versioningWS'                    => true,
		'versioning_followPages'          => true,
		'origUid'                         => 't3_origuid',
		'crdate'                          => 'crdate',
		'cruser_id'                       => 'cruser_id',
		'delete'                          => 'deleted',
		'enablecolumns'                   => array (
			'disabled'  => 'hidden',
			'starttime' => 'starttime',
			'endtime'   => 'endtime'
		),
		'transOrigPointerField'           => 'pid',
		'transOrigPointerTable'           => 'pages',
		'transOrigDiffSourceField'        => 'l18n_diffsource',
		'shadowColumnsForNewPlaceholders' => 'title',
		'languageField'                   => 'sys_language_uid',
		'mainpalette'                     => 1,
		'dynamicConfigFile'               => t3lib_extMgm::extPath($_EXTKEY) . 'tbl_cms.php',
		'type'                            => 'doktype',
		'typeicon_classes' => array(
			'default' => 'mimetypes-x-content-page-language-overlay',
		),

		'dividers2tabs'                   => true
	)
);


// ******************************************************************
// sys_template
// ******************************************************************
$TCA['sys_template'] = array (
	'ctrl' => array (
		'label' => 'title',
		'tstamp' => 'tstamp',
		'sortby' => 'sorting',
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'title' => 'LLL:EXT:cms/locallang_tca.xml:sys_template',
		'versioningWS' => true,
		'origUid' => 't3_origuid',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'delete' => 'deleted',
		'adminOnly' => 1,	// Only admin, if any
		'iconfile' => 'template.gif',
		'thumbnail' => 'resources',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime'
		),
		'typeicon_column' => 'root',
		'typeicon_classes' => array(
			'default' => 'mimetypes-x-content-template-extension',
			'1' => 'mimetypes-x-content-template',
		),
		'typeicons' => array (
			'0' => 'template_add.gif'
		),
		'dividers2tabs' => 1,
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php'
	)
);


// ******************************************************************
// layouts
// ******************************************************************
$TCA['backend_layout'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:cms/locallang_tca.xml:backend_layout',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tbl_cms.php',
		'iconfile' => 'backend_layout.gif',
		'selicon_field' => 'icon',
		'selicon_field_path' => 'uploads/media',
		'thumbnail' => 'resources',
	)
);


###########################
## EXTENSION: sv
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/sv/ext_tables.php
###########################

$_EXTKEY = 'sv';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE == 'BE') {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['sv']['services'] = array(
		'title'       => 'LLL:EXT:sv/reports/locallang.xml:report_title',
		'description' => 'LLL:EXT:sv/reports/locallang.xml:report_description',
		'icon'		  => 'EXT:sv/reports/tx_sv_report.png',
		'report'      => 'tx_sv_reports_ServicesList'
	);
}

###########################
## EXTENSION: em
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/em/ext_tables.php
###########################

$_EXTKEY = 'em';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	t3lib_extMgm::addModule('tools', 'em', '', t3lib_extMgm::extPath($_EXTKEY) . 'classes/');

		// register Ext.Direct
	t3lib_extMgm::registerExtDirectComponent(
		'TYPO3.EM.ExtDirect',
		t3lib_extMgm::extPath($_EXTKEY) . 'classes/connection/class.tx_em_connection_extdirectserver.php:tx_em_Connection_ExtDirectServer',
		'tools_em',
		'admin'
	);

	t3lib_extMgm::registerExtDirectComponent(
		'TYPO3.EMSOAP.ExtDirect',
		t3lib_extMgm::extPath($_EXTKEY) . 'classes/connection/class.tx_em_connection_extdirectsoap.php:tx_em_Connection_ExtDirectSoap',
		'tools_em',
		'admin'
	);

		// register reports check
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['Extension Manager'][] = 'tx_em_reports_ExtensionStatus';

	$icons = array(
		'extension-required' => t3lib_extMgm::extRelPath('em') . 'res/icons/extension-required.png'
 	);
 	t3lib_SpriteManager::addSingleIcons($icons, 'em');
}

###########################
## EXTENSION: recordlist
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/recordlist/ext_tables.php
###########################

$_EXTKEY = 'recordlist';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	t3lib_extMgm::addModulePath('web_list', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
	t3lib_extMgm::addModule('web', 'list', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}

###########################
## EXTENSION: css_styled_content
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/css_styled_content/ext_tables.php
###########################

$_EXTKEY = 'css_styled_content';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


# TYPO3 SVN ID: $Id$
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

	// add flexform
t3lib_extMgm::addPiFlexFormValue('*', 'FILE:EXT:css_styled_content/flexform_ds.xml','table');
$TCA['tt_content']['types']['table']['showitem']='CType;;4;;1-1-1, hidden, header;;3;;2-2-2, linkToTop;;;;4-4-4,
			--div--;LLL:EXT:cms/locallang_ttc.xml:CType.I.5, layout;;10;;3-3-3, cols, bodytext;;9;nowrap:wizards[table], text_properties, pi_flexform,
			--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access, starttime, endtime, fe_group';

t3lib_extMgm::addStaticFile($_EXTKEY, 'static/', 'CSS Styled Content');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v3.8/', 'CSS Styled Content TYPO3 v3.8');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v3.9/', 'CSS Styled Content TYPO3 v3.9');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v4.2/', 'CSS Styled Content TYPO3 v4.2');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v4.3/', 'CSS Styled Content TYPO3 v4.3');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/v4.4/', 'CSS Styled Content TYPO3 v4.4');

$TCA['tt_content']['columns']['section_frame']['config']['items'][0] = array('LLL:EXT:css_styled_content/locallang_db.php:tt_content.tx_cssstyledcontent_section_frame.I.0', '0');
$TCA['tt_content']['columns']['section_frame']['config']['items'][9] = array('LLL:EXT:css_styled_content/locallang_db.php:tt_content.tx_cssstyledcontent_section_frame.I.9', '66');


###########################
## EXTENSION: info
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/info/ext_tables.php
###########################

$_EXTKEY = 'info';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	t3lib_extMgm::addModule('web', 'info', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}

###########################
## EXTENSION: perm
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/perm/ext_tables.php
###########################

$_EXTKEY = 'perm';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	t3lib_extMgm::addModule('web', 'perm', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
	$TYPO3_CONF_VARS['BE']['AJAX']['SC_mod_web_perm_ajax::dispatch'] = t3lib_extMgm::extPath($_EXTKEY) . 'mod1/class.sc_mod_web_perm_ajax.php:SC_mod_web_perm_ajax->dispatch';
}

###########################
## EXTENSION: func
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/func/ext_tables.php
###########################

$_EXTKEY = 'func';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	t3lib_extMgm::addModule('web', 'func', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}

###########################
## EXTENSION: filelist
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/filelist/ext_tables.php
###########################

$_EXTKEY = 'filelist';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	t3lib_extMgm::addModule('file', 'list', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}

###########################
## EXTENSION: about
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/about/ext_tables.php
###########################

$_EXTKEY = 'about';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE') {
	t3lib_extMgm::addModule('help','about','top',t3lib_extMgm::extPath($_EXTKEY).'mod/');
}

###########################
## EXTENSION: version
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/version/ext_tables.php
###########################

$_EXTKEY = 'version';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE=='BE')	{
	if (!t3lib_extMgm::isLoaded('workspaces')) {
		$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][]=array(
			'name' => 'tx_version_cm1',
			'path' => t3lib_extMgm::extPath($_EXTKEY).'class.tx_version_cm1.php'
		);

		t3lib_extMgm::addModule('web', 'txversionM1', '', t3lib_extMgm::extPath($_EXTKEY) . 'cm1/');
	}
}

###########################
## EXTENSION: tsconfig_help
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/tsconfig_help/ext_tables.php
###########################

$_EXTKEY = 'tsconfig_help';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE == 'BE')	{

	t3lib_extMgm::addModule('help','txtsconfighelpM1','',t3lib_extMgm::extPath($_EXTKEY).'mod1/');
}

###########################
## EXTENSION: context_help
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/context_help/ext_tables.php
###########################

$_EXTKEY = 'context_help';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addLLrefForTCAdescr('fe_groups','EXT:context_help/locallang_csh_fe_groups.xml');
t3lib_extMgm::addLLrefForTCAdescr('fe_users','EXT:context_help/locallang_csh_fe_users.xml');
t3lib_extMgm::addLLrefForTCAdescr('pages','EXT:context_help/locallang_csh_pages.xml');
t3lib_extMgm::addLLrefForTCAdescr('pages_language_overlay','EXT:context_help/locallang_csh_pageslol.xml');
t3lib_extMgm::addLLrefForTCAdescr('static_template','EXT:context_help/locallang_csh_statictpl.xml');
t3lib_extMgm::addLLrefForTCAdescr('sys_domain','EXT:context_help/locallang_csh_sysdomain.xml');
t3lib_extMgm::addLLrefForTCAdescr('sys_template','EXT:context_help/locallang_csh_systmpl.xml');
t3lib_extMgm::addLLrefForTCAdescr('tt_content','EXT:context_help/locallang_csh_ttcontent.xml');

// Labels for TYPO3 4.5 and greater.  These labels override the ones set above, while still falling back to the original labels if no translation is available.
$GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['EXT:context_help/locallang_csh_pages.xml'][] = 'EXT:context_help/4.5/locallang_csh_pages.xml';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['EXT:context_help/locallang_csh_ttcontent.xml'][] = 'EXT:context_help/4.5/locallang_csh_ttcontent.xml';


###########################
## EXTENSION: extra_page_cm_options
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/extra_page_cm_options/ext_tables.php
###########################

$_EXTKEY = 'extra_page_cm_options';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][]=array(
		'name' => 'tx_extrapagecmoptions',
		'path' => t3lib_extMgm::extPath($_EXTKEY).'class.tx_extrapagecmoptions.php'
	);
}

###########################
## EXTENSION: impexp
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/impexp/ext_tables.php
###########################

$_EXTKEY = 'impexp';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE')	{
	$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][] = array(
		'name' => 'tx_impexp_clickmenu',
		'path' => t3lib_extMgm::extPath($_EXTKEY).'class.tx_impexp_clickmenu.php'
	);


	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['taskcenter']['impexp']['tx_impexp_task'] = array(
		'title'       => 'LLL:EXT:impexp/locallang_csh.xml:.alttitle',
		'description' => 'LLL:EXT:impexp/locallang_csh.xml:.description',
		'icon'		  => 'EXT:impexp/export.gif'
	);

	t3lib_extMgm::addLLrefForTCAdescr('xMOD_tx_impexp','EXT:impexp/locallang_csh.xml');

	// CSH labels for TYPO3 4.5 and greater.  These labels override the ones set above, while still falling back to the original labels if no translation is available.
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['EXT:impexp/locallang_csh.xml'][] = 'EXT:impexp/locallang_csh_45.xml';

		// special context menu actions for the import/export module
	$importExportActions = '
		9000 = DIVIDER

		9100 = ITEM
		9100 {
			name = exportT3d
			label = LLL:EXT:impexp/app/locallang.xml:export
			spriteIcon = actions-document-export-t3d
			callbackAction = exportT3d
		}

		9200 = ITEM
		9200 {
			name = importT3d
			label = LLL:EXT:impexp/app/locallang.xml:import
			spriteIcon = actions-document-import-t3d
			callbackAction = importT3d
		}
	';

		// context menu user default configuration
	$GLOBALS['TYPO3_CONF_VARS']['BE']['defaultUserTSconfig'] .= '
		options.contextMenu.table {
			pages_root.items {
				' . $importExportActions . '
			}

			pages.items.1000 {
				' . $importExportActions . '
			}
		}
	';
}

###########################
## EXTENSION: sys_note
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/sys_note/ext_tables.php
###########################

$_EXTKEY = 'sys_note';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	$TCA['sys_note'] = Array (
		'ctrl' => Array (
			'label' => 'subject',
			'default_sortby' => 'ORDER BY crdate',
			'tstamp' => 'tstamp',
			'crdate' => 'crdate',
			'cruser_id' => 'cruser',
			'prependAtCopy' => 'LLL:EXT:lang/locallang_general.php:LGL.prependAtCopy',
			'delete' => 'deleted',
			'title' => 'LLL:EXT:sys_note/locallang_tca.php:sys_note',
			'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
		),
		'interface' => Array (
			'showRecordFieldList' => 'category,subject,message,author,email,personal'
		),
		'columns' => Array (
			'category' => Array (
				'label' => 'LLL:EXT:lang/locallang_general.php:LGL.category',
				'config' => Array (
					'type' => 'select',
					'items' => Array (
						Array('', '0'),
						Array('LLL:EXT:sys_note/locallang_tca.php:sys_note.category.I.1', '1'),
						Array('LLL:EXT:sys_note/locallang_tca.php:sys_note.category.I.2', '3'),
						Array('LLL:EXT:sys_note/locallang_tca.php:sys_note.category.I.3', '4'),
						Array('LLL:EXT:sys_note/locallang_tca.php:sys_note.category.I.4', '2')
					),
					'default' => '0'
				)
			),
			'subject' => Array (
				'label' => 'LLL:EXT:sys_note/locallang_tca.php:sys_note.subject',
				'config' => Array (
					'type' => 'input',
					'size' => '40',
					'max' => '256'
				)
			),
			'message' => Array (
				'label' => 'LLL:EXT:sys_note/locallang_tca.php:sys_note.message',
				'config' => Array (
					'type' => 'text',
					'cols' => '40',
					'rows' => '15'
				)
			),
			'author' => Array (
				'label' => 'LLL:EXT:lang/locallang_general.php:LGL.author',
				'config' => Array (
					'type' => 'input',
					'size' => '20',
					'eval' => 'trim',
					'max' => '80'
				)
			),
			'email' => Array (
				'label' => 'LLL:EXT:lang/locallang_general.php:LGL.email',
				'config' => Array (
					'type' => 'input',
					'size' => '20',
					'eval' => 'trim',
					'max' => '80'
				)
			),
			'personal' => Array (
				'label' => 'LLL:EXT:sys_note/locallang_tca.php:sys_note.personal',
				'config' => Array (
					'type' => 'check'
				)
			)
		),
		'types' => Array (
			'0' => Array('showitem' => 'category;;;;2-2-2, author, email, personal, subject;;;;3-3-3, message')
		)
	);

	t3lib_extMgm::allowTableOnStandardPages('sys_note');
}

t3lib_extMgm::addLLrefForTCAdescr('sys_note','EXT:sys_note/locallang_csh_sysnote.xml');

###########################
## EXTENSION: tstemplate
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/tstemplate/ext_tables.php
###########################

$_EXTKEY = 'tstemplate';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	t3lib_extMgm::addModule('web','ts','',t3lib_extMgm::extPath($_EXTKEY).'ts/');

###########################
## EXTENSION: tstemplate_ceditor
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/tstemplate_ceditor/ext_tables.php
###########################

$_EXTKEY = 'tstemplate_ceditor';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::insertModuleFunction(
		'web_ts',
		'tx_tstemplateceditor',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_tstemplateceditor.php',
		'LLL:EXT:tstemplate/ts/locallang.xml:constantEditor'
	);
}

###########################
## EXTENSION: tstemplate_info
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/tstemplate_info/ext_tables.php
###########################

$_EXTKEY = 'tstemplate_info';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::insertModuleFunction(
		'web_ts',
		'tx_tstemplateinfo',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_tstemplateinfo.php',
		'LLL:EXT:tstemplate/ts/locallang.xml:infoModify'
	);
}

###########################
## EXTENSION: tstemplate_objbrowser
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/tstemplate_objbrowser/ext_tables.php
###########################

$_EXTKEY = 'tstemplate_objbrowser';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::insertModuleFunction(
		'web_ts',
		'tx_tstemplateobjbrowser',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_tstemplateobjbrowser.php',
		'LLL:EXT:tstemplate/ts/locallang.xml:objectBrowser'
	);
}

###########################
## EXTENSION: tstemplate_analyzer
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/tstemplate_analyzer/ext_tables.php
###########################

$_EXTKEY = 'tstemplate_analyzer';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::insertModuleFunction(
		'web_ts',
		'tx_tstemplateanalyzer',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_tstemplateanalyzer.php',
		'LLL:EXT:tstemplate/ts/locallang.xml:templateAnalyzer'
	);
}

###########################
## EXTENSION: func_wizards
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/func_wizards/ext_tables.php
###########################

$_EXTKEY = 'func_wizards';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::insertModuleFunction(
		'web_func',
		'tx_funcwizards_webfunc',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_funcwizards_webfunc.php',
		'LLL:EXT:func_wizards/locallang.php:mod_wizards'
	);
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_func','EXT:func_wizards/locallang_csh.xml');
}

###########################
## EXTENSION: wizard_crpages
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/wizard_crpages/ext_tables.php
###########################

$_EXTKEY = 'wizard_crpages';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::insertModuleFunction(
		'web_func',
		'tx_wizardcrpages_webfunc_2',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_wizardcrpages_webfunc_2.php',
		'LLL:EXT:wizard_crpages/locallang.php:wiz_crMany',
		'wiz'
	);
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_func','EXT:wizard_crpages/locallang_csh.xml');
}

###########################
## EXTENSION: wizard_sortpages
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/wizard_sortpages/ext_tables.php
###########################

$_EXTKEY = 'wizard_sortpages';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::insertModuleFunction(
		'web_func',
		'tx_wizardsortpages_webfunc_2',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_wizardsortpages_webfunc_2.php',
		'LLL:EXT:wizard_sortpages/locallang.php:wiz_sort',
		'wiz'
	);
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_func','EXT:wizard_sortpages/locallang_csh.xml');
}

###########################
## EXTENSION: lowlevel
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/lowlevel/ext_tables.php
###########################

$_EXTKEY = 'lowlevel';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::addModule('tools','dbint','',t3lib_extMgm::extPath($_EXTKEY).'dbint/');
	t3lib_extMgm::addModule('tools','config','',t3lib_extMgm::extPath($_EXTKEY).'config/');

/*
	t3lib_extMgm::insertModuleFunction(
		'web_func',
		'tx_lowlevel_cleaner',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_lowlevel_cleaner.php',
		'Cleaner',
		'function',
		'online'
	);
*/
}

###########################
## EXTENSION: install
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/install/ext_tables.php
###########################

$_EXTKEY = 'install';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE') {
	t3lib_extMgm::addModule('tools', 'install', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod/');

	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['typo3'][] = 'tx_install_report_InstallStatus';
}


###########################
## EXTENSION: belog
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/belog/ext_tables.php
###########################

$_EXTKEY = 'belog';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::addModule('tools','log','',t3lib_extMgm::extPath($_EXTKEY).'mod/');
	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_belog_webinfo',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_belog_webinfo.php',
		'Log'
	);
}

###########################
## EXTENSION: beuser
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/beuser/ext_tables.php
###########################

$_EXTKEY = 'beuser';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::addModule('tools','beuser','top',t3lib_extMgm::extPath($_EXTKEY).'mod/');

	$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][] = array(
		'name' => 'tx_beuser',
		'path' => t3lib_extMgm::extPath($_EXTKEY).'class.tx_beuser.php'
	);
}

###########################
## EXTENSION: aboutmodules
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/aboutmodules/ext_tables.php
###########################

$_EXTKEY = 'aboutmodules';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	t3lib_extMgm::addModule('help','aboutmodules','after:about',t3lib_extMgm::extPath($_EXTKEY).'mod/');

###########################
## EXTENSION: setup
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/setup/ext_tables.php
###########################

$_EXTKEY = 'setup';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::addModule('user','setup','after:task',t3lib_extMgm::extPath($_EXTKEY).'mod/');
	t3lib_extMgm::addLLrefForTCAdescr('_MOD_user_setup','EXT:setup/locallang_csh_mod.xml');
}

$GLOBALS['TYPO3_USER_SETTINGS'] = array(
	'ctrl' => array (
		'dividers2tabs' => 1
	),
	'columns' => array (
		'realName' => array(
			'type' => 'text',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:beUser_realName',
			'table' => 'be_users',
			'csh' => 'beUser_realName',
		),
		'email' => array(
			'type' => 'text',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:beUser_email',
			'table' => 'be_users',
			'csh' => 'beUser_email',
		),
		'emailMeAtLogin' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:emailMeAtLogin',
			'csh' => 'emailMeAtLogin',
		),
		'password' => array(
			'type' => 'password',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:newPassword',
			'table' => 'be_users',
			'csh' => 'newPassword',
			'eval' => 'md5',
		),
		'password2' => array(
			'type' => 'password',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:newPasswordAgain',
			'table' => 'be_users',
			'csh' => 'newPasswordAgain',
			'eval' => 'md5',
		),
		'lang' => array(
			'type' => 'select',
			'itemsProcFunc' => 'SC_mod_user_setup_index->renderLanguageSelect',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:language',
			'csh' => 'language',
		),
		'startModule' => array(
			'type' => 'select',
			'itemsProcFunc' => 'SC_mod_user_setup_index->renderStartModuleSelect',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:startModule',
			'csh' => 'startModule',
		),
		'thumbnailsByDefault' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:showThumbs',
			'csh' => 'showThumbs',
		),
		'edit_wideDocument' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:edit_wideDocument',
			'csh' => 'edit_wideDocument',
		),
		'titleLen' => array(
			'type' => 'text',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:maxTitleLen',
			'csh' => 'maxTitleLen',
		),
		'edit_RTE' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:edit_RTE',
			'csh' => 'edit_RTE',
		),
		'edit_docModuleUpload' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:edit_docModuleUpload',
			'csh' => 'edit_docModuleUpload',
		),
		'disableCMlayers' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:disableCMlayers',
			'csh' => 'disableCMlayers',
		),
		'copyLevels' => array(
			'type' => 'text',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:copyLevels',
			'csh' => 'copyLevels',
		),
		'recursiveDelete' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:recursiveDelete',
			'csh' => 'recursiveDelete',
		),
		'simulate' => array(
			'type' => 'select',
			'itemsProcFunc' => 'SC_mod_user_setup_index->renderSimulateUserSelect',
			'access' => 'admin',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:simulate',
			'csh' => 'simuser'
		),
		'enableFlashUploader' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:enableFlashUploader',
			'csh' => 'enableFlashUploader',
		),
		'resizeTextareas' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:resizeTextareas',
			'csh' => 'resizeTextareas',
		),
		'resizeTextareas_MaxHeight' => array(
			'type' => 'text',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:resizeTextareas_MaxHeight',
			'csh' => 'resizeTextareas_MaxHeight',
		),
		'resizeTextareas_Flexible' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:resizeTextareas_Flexible',
			'csh' => 'resizeTextareas_Flexible',
		),
		'debugInWindow' => array(
			'type' => 'check',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:debugInWindow',
			'access' => 'admin',
		),
		'installToolEnableButton' => array(
			'type' => 'user',
			'label' => 'LLL:EXT:setup/mod/locallang.xml:enableInstallTool.label',
			'userFunc' => 'SC_mod_user_setup_index->renderInstallToolEnableFileButton',
			'access' => 'admin',
			'csh' => 'enableInstallTool'
		),
	),
	'showitem' => '--div--;LLL:EXT:setup/mod/locallang.xml:personal_data,realName,email,emailMeAtLogin,password,password2,lang,
			--div--;LLL:EXT:setup/mod/locallang.xml:opening,startModule,thumbnailsByDefault,titleLen,
			--div--;LLL:EXT:setup/mod/locallang.xml:editFunctionsTab,edit_RTE,edit_wideDocument,edit_docModuleUpload,enableFlashUploader,resizeTextareas,resizeTextareas_MaxHeight,resizeTextareas_Flexible,disableCMlayers,copyLevels,recursiveDelete,
			--div--;LLL:EXT:setup/mod/locallang.xml:adminFunctions,simulate,debugInWindow,installToolEnableButton'

);

###########################
## EXTENSION: taskcenter
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/taskcenter/ext_tables.php
###########################

$_EXTKEY = 'taskcenter';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('tools_txtaskcenterM1', t3lib_extMgm::extPath($_EXTKEY) . 'task/');
	t3lib_extMgm::addModule('user','task', 'top', t3lib_extMgm::extPath($_EXTKEY) . 'task/');

	$GLOBALS['TYPO3_CONF_VARS']['BE']['AJAX']['Taskcenter::saveCollapseState']	= 'EXT:taskcenter/classes/class.tx_taskcenter_status.php:tx_taskcenter_status->saveCollapseState';
	$GLOBALS['TYPO3_CONF_VARS']['BE']['AJAX']['Taskcenter::saveSortingState']	= 'EXT:taskcenter/classes/class.tx_taskcenter_status.php:tx_taskcenter_status->saveSortingState';
}

###########################
## EXTENSION: info_pagetsconfig
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/info_pagetsconfig/ext_tables.php
###########################

$_EXTKEY = 'info_pagetsconfig';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_infopagetsconfig_webinfo',
		t3lib_extMgm::extPath($_EXTKEY).'class.tx_infopagetsconfig_webinfo.php',
		'LLL:EXT:info_pagetsconfig/locallang.php:mod_pagetsconfig'
	);
}

t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_info','EXT:info_pagetsconfig/locallang_csh_webinfo.xml');


###########################
## EXTENSION: viewpage
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/viewpage/ext_tables.php
###########################

$_EXTKEY = 'viewpage';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	t3lib_extMgm::addModule('web','view','after:layout',t3lib_extMgm::extPath($_EXTKEY).'view/');

###########################
## EXTENSION: rtehtmlarea
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/rtehtmlarea/ext_tables.php
###########################

$_EXTKEY = 'rtehtmlarea';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

		// Add static template for Click-enlarge rendering
	t3lib_extMgm::addStaticFile($_EXTKEY,'static/clickenlarge/','Clickenlarge Rendering');

		// Add acronyms table
	$TCA['tx_rtehtmlarea_acronym'] = Array (
		'ctrl' => Array (
			'title' => 'LLL:EXT:rtehtmlarea/locallang_db.xml:tx_rtehtmlarea_acronym',
			'label' => 'term',
			'default_sortby' => 'ORDER BY term',
			'sortby' => 'sorting',
			'delete' => 'deleted',
			'enablecolumns' => Array (
				'disabled' => 'hidden',
				'starttime' => 'starttime',
				'endtime' => 'endtime',
			),
			'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
			'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'extensions/Acronym/skin/images/acronym.gif',
		),
	);
	t3lib_extMgm::allowTableOnStandardPages('tx_rtehtmlarea_acronym');
	t3lib_extMgm::addLLrefForTCAdescr('tx_rtehtmlarea_acronym','EXT:' . $_EXTKEY . '/locallang_csh_abbreviation.xml');

		// Add contextual help files
	$htmlAreaRteContextHelpFiles = array(
		'General' => 'EXT:' . $_EXTKEY . '/locallang_csh.xml',
		'Acronym' => 'EXT:' . $_EXTKEY . '/extensions/Acronym/locallang_csh.xml',
		'EditElement' => 'EXT:' . $_EXTKEY . '/extensions/EditElement/locallang_csh.xml',
		'Language' => 'EXT:' . $_EXTKEY . '/extensions/Language/locallang_csh.xml',
		'PlainText' => 'EXT:' . $_EXTKEY . '/extensions/PlainText/locallang_csh.xml',
		'RemoveFormat' => 'EXT:' . $_EXTKEY . '/extensions/RemoveFormat/locallang_csh.xml',
	);
	foreach ($htmlAreaRteContextHelpFiles as $key => $file) {
		t3lib_extMgm::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_' . $key, $file);
	}
	unset($htmlAreaRteContextHelpFiles);

		// Extend TYPO3 User Settings Configuration
if (TYPO3_MODE === 'BE' && t3lib_extMgm::isLoaded('setup') && is_array($GLOBALS['TYPO3_USER_SETTINGS'])) {
	$GLOBALS['TYPO3_USER_SETTINGS']['columns'] = array_merge(
		$GLOBALS['TYPO3_USER_SETTINGS']['columns'],
		array(
			'rteWidth' => array(
				'type' => 'text',
				'label' => 'LLL:EXT:rtehtmlarea/locallang.xml:rteWidth',
				'csh' => 'xEXT_rtehtmlarea_General:rteWidth',
			),
			'rteHeight' => array(
				'type' => 'text',
				'label' => 'LLL:EXT:rtehtmlarea/locallang.xml:rteHeight',
				'csh' => 'xEXT_rtehtmlarea_General:rteHeight',
			),
			'rteResize' => array(
				'type' => 'check',
				'label' => 'LLL:EXT:rtehtmlarea/locallang.xml:rteResize',
				'csh' => 'xEXT_rtehtmlarea_General:rteResize',
			),
			'rteMaxHeight' => array(
				'type' => 'text',
				'label' => 'LLL:EXT:rtehtmlarea/locallang.xml:rteMaxHeight',
				'csh' => 'xEXT_rtehtmlarea_General:rteMaxHeight',
			),
			'rteCleanPasteBehaviour' => array(
				'type' => 'select',
				'label' => 'LLL:EXT:rtehtmlarea/htmlarea/plugins/PlainText/locallang.xml:rteCleanPasteBehaviour',
				'items' => array(
					'plainText' => 'LLL:EXT:rtehtmlarea/htmlarea/plugins/PlainText/locallang.xml:plainText',
					'pasteStructure' => 'LLL:EXT:rtehtmlarea/htmlarea/plugins/PlainText/locallang.xml:pasteStructure',
					'pasteFormat' => 'LLL:EXT:rtehtmlarea/htmlarea/plugins/PlainText/locallang.xml:pasteFormat',
				),
				'csh' => 'xEXT_rtehtmlarea_PlainText:behaviour',
			),
		)
	);
	$GLOBALS['TYPO3_USER_SETTINGS']['showitem'] .= ',--div--;LLL:EXT:rtehtmlarea/locallang.xml:rteSettings,rteWidth,rteHeight,rteResize,rteMaxHeight,rteCleanPasteBehaviour';

	$icons = array(
		'clearcachemenu' => t3lib_extMgm::extRelPath('rtehtmlarea') . 'hooks/clearrtecache/clearrtecache.png'
	);
	t3lib_SpriteManager::addSingleIcons($icons, 'rtehtmlarea');
}

###########################
## EXTENSION: t3skin
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/t3skin/ext_tables.php
###########################

$_EXTKEY = 't3skin';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE == 'BE' || (TYPO3_MODE == 'FE' && isset($GLOBALS['BE_USER']))) {
	global $TBE_STYLES;

		// register as a skin
	$TBE_STYLES['skins'][$_EXTKEY] = array(
		'name' => 't3skin',
	);

		// Support for other extensions to add own icons...
	$presetSkinImgs = is_array($TBE_STYLES['skinImg']) ?
		$TBE_STYLES['skinImg'] :
		array();

	$TBE_STYLES['skins'][$_EXTKEY]['stylesheetDirectories']['sprites'] = 'EXT:t3skin/stylesheets/sprites/';

	/**
	 * Setting up backend styles and colors
	 */
	$TBE_STYLES['mainColors'] = array(	// Always use #xxxxxx color definitions!
		'bgColor'    => '#FFFFFF',		// Light background color
		'bgColor2'   => '#FEFEFE',		// Steel-blue
		'bgColor3'   => '#F1F3F5',		// dok.color
		'bgColor4'   => '#E6E9EB',		// light tablerow background, brownish
		'bgColor5'   => '#F8F9FB',		// light tablerow background, greenish
		'bgColor6'   => '#E6E9EB',		// light tablerow background, yellowish, for section headers. Light.
		'hoverColor' => '#FF0000',
		'navFrameHL' => '#F8F9FB'
	);

	$TBE_STYLES['colorschemes'][0] = '-|class-main1,-|class-main2,-|class-main3,-|class-main4,-|class-main5';
	$TBE_STYLES['colorschemes'][1] = '-|class-main11,-|class-main12,-|class-main13,-|class-main14,-|class-main15';
	$TBE_STYLES['colorschemes'][2] = '-|class-main21,-|class-main22,-|class-main23,-|class-main24,-|class-main25';
	$TBE_STYLES['colorschemes'][3] = '-|class-main31,-|class-main32,-|class-main33,-|class-main34,-|class-main35';
	$TBE_STYLES['colorschemes'][4] = '-|class-main41,-|class-main42,-|class-main43,-|class-main44,-|class-main45';
	$TBE_STYLES['colorschemes'][5] = '-|class-main51,-|class-main52,-|class-main53,-|class-main54,-|class-main55';

	$TBE_STYLES['styleschemes'][0]['all'] = 'CLASS: formField';
	$TBE_STYLES['styleschemes'][1]['all'] = 'CLASS: formField1';
	$TBE_STYLES['styleschemes'][2]['all'] = 'CLASS: formField2';
	$TBE_STYLES['styleschemes'][3]['all'] = 'CLASS: formField3';
	$TBE_STYLES['styleschemes'][4]['all'] = 'CLASS: formField4';
	$TBE_STYLES['styleschemes'][5]['all'] = 'CLASS: formField5';

	$TBE_STYLES['styleschemes'][0]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][1]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][2]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][3]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][4]['check'] = 'CLASS: checkbox';
	$TBE_STYLES['styleschemes'][5]['check'] = 'CLASS: checkbox';

	$TBE_STYLES['styleschemes'][0]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][1]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][2]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][3]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][4]['radio'] = 'CLASS: radio';
	$TBE_STYLES['styleschemes'][5]['radio'] = 'CLASS: radio';

	$TBE_STYLES['styleschemes'][0]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][1]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][2]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][3]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][4]['select'] = 'CLASS: select';
	$TBE_STYLES['styleschemes'][5]['select'] = 'CLASS: select';

	$TBE_STYLES['borderschemes'][0] = array('', '', '', 'wrapperTable');
	$TBE_STYLES['borderschemes'][1] = array('', '', '', 'wrapperTable1');
	$TBE_STYLES['borderschemes'][2] = array('', '', '', 'wrapperTable2');
	$TBE_STYLES['borderschemes'][3] = array('', '', '', 'wrapperTable3');
	$TBE_STYLES['borderschemes'][4] = array('', '', '', 'wrapperTable4');
	$TBE_STYLES['borderschemes'][5] = array('', '', '', 'wrapperTable5');



		// Setting the relative path to the extension in temp. variable:
	$temp_eP = t3lib_extMgm::extRelPath($_EXTKEY);

		// Alternative dimensions for frameset sizes:
	$TBE_STYLES['dims']['leftMenuFrameW'] = 190;		// Left menu frame width
	$TBE_STYLES['dims']['topFrameH']      = 42;			// Top frame height
	$TBE_STYLES['dims']['navFrameWidth']  = 280;		// Default navigation frame width

		// Setting roll-over background color for click menus:
		// Notice, this line uses the the 'scriptIDindex' feature to override another value in this array (namely $TBE_STYLES['mainColors']['bgColor5']), for a specific script "typo3/alt_clickmenu.php"
	$TBE_STYLES['scriptIDindex']['typo3/alt_clickmenu.php']['mainColors']['bgColor5'] = '#dedede';

		// Setting up auto detection of alternative icons:
	$TBE_STYLES['skinImgAutoCfg'] = array(
		'absDir'             => t3lib_extMgm::extPath($_EXTKEY).'icons/',
		'relDir'             => t3lib_extMgm::extRelPath($_EXTKEY).'icons/',
		'forceFileExtension' => 'gif',	// Force to look for PNG alternatives...
#		'scaleFactor'        => 2/3,	// Scaling factor, default is 1
		'iconSizeWidth'      => 16,
		'iconSizeHeight'     => 16,
	);

		// Changing icon for filemounts, needs to be done here as overwriting the original icon would also change the filelist tree's root icon
	$TCA['sys_filemounts']['ctrl']['iconfile'] = '_icon_ftp_2.gif';

		// Adding flags to sys_language
	t3lib_div::loadTCA('sys_language');
	$TCA['sys_language']['ctrl']['typeicon_column'] = 'flag';
	$TCA['sys_language']['ctrl']['typeicon_classes'] = array(
		'default' => 'mimetypes-x-sys_language',
		'mask'	=> 'flags-###TYPE###'
	);
	$flagNames = array(
		'multiple', 'ad', 'ae', 'af', 'ag', 'ai', 'al', 'am', 'an', 'ao', 'ar', 'as', 'at', 'au', 'aw', 'ax', 'az',
		'ba', 'bb', 'bd', 'be', 'bf', 'bg', 'bh', 'bi', 'bj', 'bm', 'bn', 'bo', 'br', 'bs', 'bt', 'bv', 'bw', 'by', 'bz',
		'ca', 'catalonia', 'cc', 'cd', 'cf', 'cg', 'ch', 'ci', 'ck', 'cl', 'cm', 'cn', 'co', 'cr', 'cs', 'cu', 'cv', 'cx', 'cy', 'cz',
		'de', 'dj', 'dk', 'dm', 'do', 'dz',
		'ec', 'ee', 'eg', 'eh', 'england', 'er', 'es', 'et', 'europeanunion',
		'fam', 'fi', 'fj', 'fk', 'fm', 'fo', 'fr',
		'ga', 'gb', 'gd', 'ge', 'gf', 'gh', 'gi', 'gl', 'gm', 'gn', 'gp', 'gq', 'gr', 'gs', 'gt', 'gu', 'gw', 'gy',
		'hk', 'hm', 'hn', 'hr', 'ht', 'hu',
		'id', 'ie', 'il', 'in', 'io', 'iq', 'ir', 'is', 'it',
		'jm', 'jo', 'jp',
		'ke', 'kg', 'kh', 'ki', 'km', 'kn', 'kp', 'kr', 'kw', 'ky', 'kz',
		'la', 'lb', 'lc', 'li', 'lk', 'lr', 'ls', 'lt', 'lu', 'lv', 'ly',
		'ma', 'mc', 'md', 'me', 'mg', 'mh', 'mk', 'ml', 'mm', 'mn', 'mo', 'mp', 'mq', 'mr', 'ms', 'mt', 'mu', 'mv', 'mw', 'mx', 'my', 'mz',
		'na', 'nc', 'ne', 'nf', 'ng', 'ni', 'nl', 'no', 'np', 'nr', 'nu', 'nz',
		'om',
		'pa', 'pe', 'pf', 'pg', 'ph', 'pk', 'pl', 'pm', 'pn', 'pr', 'ps', 'pt', 'pw', 'py',
		'qa', 'qc',
		're', 'ro', 'rs', 'ru', 'rw',
		'sa', 'sb', 'sc', 'scotland', 'sd', 'se', 'sg', 'sh', 'si', 'sj', 'sk', 'sl', 'sm', 'sn', 'so', 'sr', 'st', 'sv', 'sy', 'sz',
		'tc', 'td', 'tf', 'tg', 'th', 'tj', 'tk', 'tl', 'tm', 'tn', 'to', 'tr', 'tt', 'tv', 'tw', 'tz',
		'ua', 'ug', 'um', 'us', 'uy', 'uz',
		'va', 'vc', 've', 'vg', 'vi', 'vn', 'vu',
		'wales', 'wf', 'ws',
		'ye', 'yt',
		'za', 'zm', 'zw'
	);
	foreach ($flagNames as $flagName) {
		$TCA['sys_language']['columns']['flag']['config']['items'][] = array($flagName, $flagName, 'EXT:t3skin/images/flags/'. $flagName . '.png');
	}

		// Manual setting up of alternative icons. This is mainly for module icons which has a special prefix:
	$TBE_STYLES['skinImg'] = array_merge($presetSkinImgs, array (
		'gfx/ol/blank.gif'                         => array('clear.gif','width="18" height="16"'),
		'MOD:web/website.gif'                      => array($temp_eP.'icons/module_web.gif','width="24" height="24"'),
		'MOD:web_layout/layout.gif'                => array($temp_eP.'icons/module_web_layout.gif','width="24" height="24"'),
		'MOD:web_view/view.gif'                    => array($temp_eP.'icons/module_web_view.png','width="24" height="24"'),
		'MOD:web_list/list.gif'                    => array($temp_eP.'icons/module_web_list.gif','width="24" height="24"'),
		'MOD:web_info/info.gif'                    => array($temp_eP.'icons/module_web_info.png','width="24" height="24"'),
		'MOD:web_perm/perm.gif'                    => array($temp_eP.'icons/module_web_perms.png','width="24" height="24"'),
		'MOD:web_func/func.gif'                    => array($temp_eP.'icons/module_web_func.png','width="24" height="24"'),
		'MOD:web_ts/ts1.gif'                       => array($temp_eP.'icons/module_web_ts.gif','width="24" height="24"'),
		'MOD:web_modules/modules.gif'              => array($temp_eP.'icons/module_web_modules.gif','width="24" height="24"'),
		'MOD:web_txversionM1/cm_icon.gif'          => array($temp_eP.'icons/module_web_version.gif','width="24" height="24"'),
		'MOD:file/file.gif'                        => array($temp_eP.'icons/module_file.gif','width="22" height="24"'),
		'MOD:file_list/list.gif'                   => array($temp_eP.'icons/module_file_list.gif','width="22" height="24"'),
		'MOD:file_images/images.gif'               => array($temp_eP.'icons/module_file_images.gif','width="22" height="22"'),
		'MOD:user/user.gif'                        => array($temp_eP.'icons/module_user.gif','width="22" height="22"'),
		'MOD:user_task/task.gif'                   => array($temp_eP.'icons/module_user_taskcenter.gif','width="22" height="22"'),
		'MOD:user_setup/setup.gif'                 => array($temp_eP.'icons/module_user_setup.gif','width="22" height="22"'),
		'MOD:user_doc/document.gif'                => array($temp_eP.'icons/module_doc.gif','width="22" height="22"'),
		'MOD:user_ws/sys_workspace.gif'            => array($temp_eP.'icons/module_user_ws.gif','width="22" height="22"'),
		'MOD:tools/tool.gif'                       => array($temp_eP.'icons/module_tools.gif','width="25" height="24"'),
		'MOD:tools_beuser/beuser.gif'              => array($temp_eP.'icons/module_tools_user.gif','width="24" height="24"'),
		'MOD:tools_em/em.gif'                      => array($temp_eP.'icons/module_tools_em.png','width="24" height="24"'),
		'MOD:tools_em/install.gif'                 => array($temp_eP.'icons/module_tools_em.gif','width="24" height="24"'),
		'MOD:tools_dbint/db.gif'                   => array($temp_eP.'icons/module_tools_dbint.gif','width="25" height="24"'),
		'MOD:tools_config/config.gif'              => array($temp_eP.'icons/module_tools_config.gif','width="24" height="24"'),
		'MOD:tools_install/install.gif'            => array($temp_eP.'icons/module_tools_install.gif','width="24" height="24"'),
		'MOD:tools_log/log.gif'                    => array($temp_eP.'icons/module_tools_log.gif','width="24" height="24"'),
		'MOD:tools_txphpmyadmin/thirdparty_db.gif' => array($temp_eP.'icons/module_tools_phpmyadmin.gif','width="24" height="24"'),
		'MOD:tools_isearch/isearch.gif'            => array($temp_eP.'icons/module_tools_isearch.gif','width="24" height="24"'),
		'MOD:help/help.gif'                        => array($temp_eP.'icons/module_help.gif','width="23" height="24"'),
		'MOD:help_about/info.gif'                  => array($temp_eP.'icons/module_help_about.gif','width="25" height="24"'),
		'MOD:help_aboutmodules/aboutmodules.gif'   => array($temp_eP.'icons/module_help_aboutmodules.gif','width="24" height="24"'),
		'MOD:help_cshmanual/about.gif'         => array($temp_eP.'icons/module_help_cshmanual.gif','width="25" height="24"'),
		'MOD:help_txtsconfighelpM1/moduleicon.gif' => array($temp_eP.'icons/module_help_ts.gif','width="25" height="24"'),
	));

		// Logo at login screen
	$TBE_STYLES['logo_login'] = $temp_eP . 'images/login/typo3logo-white-greyback.gif';

		// extJS theme
	$TBE_STYLES['extJS']['theme'] =  $temp_eP . 'extjs/xtheme-t3skin.css';

	// Adding HTML template for login screen
	$TBE_STYLES['htmlTemplates']['templates/login.html'] = 'sysext/t3skin/templates/login.html';

	$GLOBALS['TYPO3_CONF_VARS']['typo3/backend.php']['additionalBackendItems'][] = t3lib_extMgm::extPath('t3skin').'registerIe6Stylesheet.php';

	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['preHeaderRenderHook'][] = t3lib_extMgm::extPath('t3skin').'pngfix/class.tx_templatehook.php:tx_templatehook->registerPngFix';

	$GLOBALS['TBE_STYLES']['stylesheets']['admPanel'] = t3lib_extMgm::siteRelPath('t3skin') . 'stylesheets/standalone/admin_panel.css';

	foreach ($flagNames as $flagName) {
		t3lib_SpriteManager::addIconSprite(
			array(
				'flags-' . $flagName,
				'flags-' . $flagName . '-overlay',
			)
		);
	}
	unset($flagNames, $flagName);

}


###########################
## EXTENSION: t3editor
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/t3editor/ext_tables.php
###########################

$_EXTKEY = 't3editor';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE == 'BE') {
	// Register AJAX handlers:
	$TYPO3_CONF_VARS['BE']['AJAX']['tx_t3editor::saveCode'] = 'EXT:t3editor/classes/class.tx_t3editor.php:tx_t3editor->ajaxSaveCode';
	$TYPO3_CONF_VARS['BE']['AJAX']['tx_t3editor::getPlugins'] = 'EXT:t3editor/classes/class.tx_t3editor.php:tx_t3editor->getPlugins';
	$TYPO3_CONF_VARS['BE']['AJAX']['tx_t3editor_TSrefLoader::getTypes'] = 'EXT:t3editor/classes/ts_codecompletion/class.tx_t3editor_tsrefloader.php:tx_t3editor_TSrefLoader->processAjaxRequest';
	$TYPO3_CONF_VARS['BE']['AJAX']['tx_t3editor_TSrefLoader::getDescription'] = 'EXT:t3editor/classes/ts_codecompletion/class.tx_t3editor_tsrefloader.php:tx_t3editor_TSrefLoader->processAjaxRequest';
	$TYPO3_CONF_VARS['BE']['AJAX']['tx_t3editor_codecompletion::loadTemplates'] = 'EXT:t3editor/classes/ts_codecompletion/class.tx_t3editor_codecompletion.php:tx_t3editor_codecompletion->processAjaxRequest';
}

###########################
## EXTENSION: reports
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/reports/ext_tables.php
###########################

$_EXTKEY = 'reports';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('tools_txreportsM1', t3lib_extMgm::extPath($_EXTKEY) . 'mod/');
	t3lib_extMgm::addModule('tools', 'txreportsM1', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod/');

	$statusReport = array(
		'title'       => 'LLL:EXT:reports/reports/locallang.xml:status_report_title',
		'description' => 'LLL:EXT:reports/reports/locallang.xml:status_report_description',
		'report'      => 'tx_reports_reports_Status'
	);

	if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status'])) {
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status'] = array();
	}

	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status'] = array_merge(
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status'],
		$statusReport
	);

	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['typo3'][] = 'tx_reports_reports_status_Typo3Status';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['system'][] = 'tx_reports_reports_status_SystemStatus';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['security'][] = 'tx_reports_reports_status_SecurityStatus';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['configuration'][] = 'tx_reports_reports_status_ConfigurationStatus';

}


###########################
## EXTENSION: felogin
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/felogin/ext_tables.php
###########################

$_EXTKEY = 'felogin';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$_EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['felogin']);

t3lib_div::loadTCA('tt_content');

if(t3lib_div::int_from_ver(TYPO3_version) >= 4002000)
	t3lib_extMgm::addPiFlexFormValue('*','FILE:EXT:'.$_EXTKEY.'/flexform.xml','login');
else
	t3lib_extMgm::addPiFlexFormValue('default','FILE:EXT:'.$_EXTKEY.'/flexform.xml');



	#replace login
$TCA['tt_content']['types']['login']['showitem'] = '--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.general;general,
													--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.header;header,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.plugin,
													pi_flexform;;;;1-1-1,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
													--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility,
													--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.appearance,
													--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.frames;frames,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.behaviour,
													--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.extended';

	// Adds the redirect field to the fe_groups table
$tempColumns = array(
	'felogin_redirectPid' => array(
		'exclude' => 1,
		'label'  => 'LLL:EXT:felogin/locallang_db.xml:felogin_redirectPid',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
		)
	),
);

t3lib_div::loadTCA('fe_groups');
t3lib_extMgm::addTCAcolumns('fe_groups', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('fe_groups', 'felogin_redirectPid;;;;1-1-1');

	// Adds the redirect field and the forgotHash field to the fe_users-table
$tempColumns = array (
	"felogin_redirectPid" => array (
		"exclude" => 1,
		"label" => "LLL:EXT:felogin/locallang_db.xml:felogin_redirectPid",
		"config" => array (
			"type" => "group",
			"internal_type" => "db",
			"allowed" => "pages",
			"size" => 1,
			"minitems" => 0,
			"maxitems" => 1,
		)
	),
	'felogin_forgotHash' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:felogin/locallang_db.xml:felogin_forgotHash',
		'config' => array (
			'type' => 'passthrough',
		)
	),
);

t3lib_div::loadTCA("fe_users");
t3lib_extMgm::addTCAcolumns("fe_users",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("fe_users","felogin_redirectPid;;;;1-1-1");


###########################
## EXTENSION: kb_nescefe
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/kb_nescefe/ext_tables.php
###########################

$_EXTKEY = 'kb_nescefe';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

define('PATH_kb_nescefe', t3lib_extMgm::extPath($_EXTKEY));

$tempColumns = array(
	'parentPosition' => Array (
		'label' => 'LLL:EXT:kb_nescefe/locallang_db.xml:tt_content.cPos',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
			),
			'itemsProcFunc' => 'EXT:kb_nescefe/class.tx_kbnescefe_itemproc.php:tx_kbnescefe_itemproc->contentPositions',
			'default' => '0',
			'softref' => 'kb_nescefe_parent',
		),
	),
	'container' => array(
		'label' => 'LLL:EXT:kb_nescefe/locallang_db.xml:tt_content.container',
		'config' => Array (
			'type' => 'select',
			'items' => array(
				array('LLL:EXT:kb_nescefe/locallang_db.xml:tt_content.container.none', 0),
			),
			'foreign_table' => 'tx_kbnescefe_containers',
			'foreign_table_where' => ' AND tx_kbnescefe_containers.pid=###PAGE_TSCONFIG_ID###',
			'size' => '1',
			'maxitems' => '1',
			'minitems' => '0',
			'softref' => 'kb_nescefe_container',
		)
	),
);
			
if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['templateSoftReference']) {
	$tempColumns['container']['config']['softref'] = 'kb_nescefe_container';
}

$TCA['tx_kbnescefe_containers'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:kb_nescefe/locallang_db.xml:tx_kbnescefe_containers',		
		'label' => 'name',	
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => Array (		
			'disabled' => 'hidden',	
			'starttime' => 'starttime',	
			'endtime' => 'endtime',	
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => PATH_kb_nescefe.'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_kbnescefe_containers.gif',
	),
	'feInterface' => Array (
		'fe_admin_fieldList' => 'hidden, starttime, endtime, fe_group, name, fetemplate, betemplate',
	)
);



t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('tt_content', 'parentPosition');

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'pages,layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] = 'container';
$TCA['tt_content']['columns']['colPos']['config']['items']['kb_nescefe'] = Array('LLL:EXT:kb_nescefe/locallang_db.xml:tt_content.containerColumn', $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['containerElementColPos']);

t3lib_extMgm::addPlugin(Array('LLL:EXT:kb_nescefe/locallang_db.xml:tt_content.CType_pi1', $_EXTKEY.'_pi1', 'EXT:kb_nescefe/ext_icon.gif'), 'list_type');

t3lib_extMgm::addPageTSConfig('
mod.wizards.newContentElement.wizardItems.common.show := addToList(kb_nescefe_pi1);
');

$GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses']['tx_kbnescefe_dbNewContentEl'] = PATH_kb_nescefe.'class.tx_kbnescefe_dbNewContentEl.php';

if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['templatesOnPages']) {
	t3lib_extMgm::allowTableOnStandardPages('tx_kbnescefe_containers');
}


###########################
## EXTENSION: static_info_tables
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/static_info_tables/ext_tables.php
###########################

$_EXTKEY = 'static_info_tables';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addStaticFile(STATIC_INFO_TABLES_EXTkey, 'static/static_info_tables/', 'Static Info tables');

$TCA['static_territories'] = array(
	'ctrl' => array(
		'label' => 'tr_name_en',
		'label_alt' => 'tr_name_en,tr_iso_nr',
		'readOnly' => 1,	// This should always be true, as it prevents the static data from being altered
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY tr_name_en',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_territories.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_territories.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'tr_name_en,tr_iso_nr'
	)
);

// Country reference data from ISO 3166-1
$TCA['static_countries'] = array(
	'ctrl' => array(
		'label' => 'cn_short_en',
		'label_alt' => 'cn_short_en,cn_iso_2',
		'readOnly' => 1,	// This should always be true, as it prevents the static data from being altered
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY cn_short_en',
		'delete' => 'deleted',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_countries.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_countries.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'cn_iso_2,cn_iso_3,cn_iso_nr,cn_official_name_local,cn_official_name_en,cn_capital,cn_tldomain,cn_currency_iso_3,cn_currency_iso_nr,cn_phone,cn_uno_member,cn_eu_member,cn_address_format,cn_short_en'
	)
);

// Country subdivision reference data from ISO 3166-2
$TCA['static_country_zones'] = array(
	'ctrl' => array(
		'label' => 'zn_name_local',
		'label_alt' => 'zn_name_local,zn_code',
		'readOnly' => 1,
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY zn_name_local',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_country_zones.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_countries.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'zn_country_iso_nr,zn_country_iso_3,zn_code,zn_name_local,zn_name_en'
	)
);

// Language reference data from ISO 639-1
$TCA['static_languages'] = array(
	'ctrl' => array(
		'label' => 'lg_name_en',
		'label_alt' => 'lg_name_en,lg_iso_2',
		'readOnly' => 1,
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY lg_name_en',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_languages.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_languages.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'lg_name_local,lg_name_en,lg_iso_2,lg_typo3,lg_country_iso_2,lg_collate_locale,lg_sacred,lg_constructed'
	)
);

// Currency reference data from ISO 4217
$TCA['static_currencies'] = array(
	'ctrl' => array(
		'label' => 'cu_name_en',
		'label_alt' => 'cu_name_en,cu_iso_3',
		'readOnly' => 1,
		'adminOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY cu_name_en',
		'title' => 'LLL:EXT:'.STATIC_INFO_TABLES_EXTkey.'/locallang_db.xml:static_currencies.title',
		'dynamicConfigFile' => PATH_BE_staticinfotables.'tca.php',
		'iconfile' => PATH_BE_staticinfotables_rel.'icon_static_currencies.gif',
	),
	'interface' => array(
		'showRecordFieldList' => 'cu_iso_3,cu_iso_nr,cu_name_en,cu_symbol_left,cu_symbol_right,cu_thousands_point,cu_decimal_point,cu_decimal_digits,cu_sub_name_en,cu_sub_divisor,cu_sub_symbol_left,cu_sub_symbol_right'
	)
);

$TCA['static_countries']['ctrl']['readOnly'] = 0;
$TCA['static_languages']['ctrl']['readOnly'] = 0;
$TCA['static_country_zones']['ctrl']['readOnly'] = 0;
$TCA['static_currencies']['ctrl']['readOnly'] = 0;
$TCA['static_territories']['ctrl']['readOnly'] = 0;


// ******************************************************************
// sys_language
// ******************************************************************

t3lib_div::loadTCA('sys_language');
$TCA['sys_language']['columns']['static_lang_isocode']['config'] = array(
	'type' => 'select',
	'items' => array(
		array('',0),
	),
	#'foreign_table' => 'static_languages',
	#'foreign_table_where' => 'AND static_languages.pid=0 ORDER BY static_languages.lg_name_en',
	'itemsProcFunc' => 'tx_staticinfotables_div->selectItemsTCA',
	'itemsProcFunc_config' => array(
		'table' => 'static_languages',
		'indexField' => 'uid',
		// I think that will make more sense in the future
		// 'indexField' => 'lg_iso_2',
		'prependHotlist' => 1,
		//	defaults:
		//'hotlistLimit' => 8,
		//'hotlistSort' => 1,
		//'hotlistOnly' => 0,
		//'hotlistApp' => TYPO3_MODE,
	),
	'size' => 1,
	'minitems' => 0,
	'maxitems' => 1,
);

$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:'.STATIC_INFO_TABLES_EXTkey.'/class.tx_staticinfotables_syslanguage.php:&tx_staticinfotables_syslanguage';


###########################
## EXTENSION: wec_contentelements
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/wec_contentelements/ext_tables.php
###########################

$_EXTKEY = 'wec_contentelements';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['wec_contentelements']);
if (is_array($extConf) && array_key_exists('includeDefaultContentElements', $extConf)) {
	$includeDefaultContentElements = $extConf['includeDefaultContentElements'];
} else {
	$includeDefaultContentElements = TRUE;
}

if ($includeDefaultContentElements) {
	tx_weccontentelements_lib::addContentElement($_EXTKEY, 'vimeo');
	tx_weccontentelements_lib::addContentElement($_EXTKEY, 'youtube');
	tx_weccontentelements_lib::addContentElement($_EXTKEY, 'localmenu');
	tx_weccontentelements_lib::addContentElement($_EXTKEY, 'slideshow');
	tx_weccontentelements_lib::addContentElement($_EXTKEY, 'filedownload');
}


###########################
## EXTENSION: realurl
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/realurl/ext_tables.php
###########################

$_EXTKEY = 'realurl';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
//	t3lib_extMgm::addModule('tools','txrealurlM1','',t3lib_extMgm::extPath($_EXTKEY).'mod1/');

	// Add Web>Info module:
	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_realurl_modfunc1',
		t3lib_extMgm::extPath($_EXTKEY) . 'modfunc1/class.tx_realurl_modfunc1.php',
		'LLL:EXT:realurl/locallang_db.xml:moduleFunction.tx_realurl_modfunc1',
		'function',
		'online'
	);
}

t3lib_div::loadTCA('pages');
$TCA['pages']['columns'] += array(
	'tx_realurl_pathsegment' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_pathsegment',
		'displayCond' => 'FIELD:tx_realurl_exclude:!=:1',
		'exclude' => 1,
		'config' => array (
			'type' => 'input',
			'max' => 255,
			'eval' => 'trim,nospace,lower'
		),
	),
	'tx_realurl_pathoverride' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_path_override',
		'exclude' => 1,
		'config' => array (
			'type' => 'check',
			'items' => array(
				array('', '')
			)
		)
	),
	'tx_realurl_exclude' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_exclude',
		'exclude' => 1,
		'config' => array (
			'type' => 'check',
			'items' => array(
				array('', '')
			)
		)
	),
	'tx_realurl_nocache' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_nocache',
		'exclude' => 1,
		'config' => array (
			'type' => 'check',
			'items' => array(
				array('', ''),
			),
		),
	)
);

$TCA['pages']['ctrl']['requestUpdate'] .= ',tx_realurl_exclude';

$TCA['pages']['palettes']['137'] = array(
	'showitem' => 'tx_realurl_pathoverride'
);

if (t3lib_div::compat_version('4.3')) {
	t3lib_extMgm::addFieldsToPalette('pages', '3', 'tx_realurl_nocache', 'after:cache_timeout');
}
if (t3lib_div::compat_version('4.2')) {
	// For 4.2 or new add fields to advanced page only
	t3lib_extMgm::addToAllTCAtypes('pages', 'tx_realurl_pathsegment;;137;;,tx_realurl_exclude', '1', 'after:nav_title');
	t3lib_extMgm::addToAllTCAtypes('pages', 'tx_realurl_pathsegment;;137;;,tx_realurl_exclude', '4,199,254', 'after:title');
}
else {
	// Put it for standard page
	t3lib_extMgm::addToAllTCAtypes('pages', 'tx_realurl_pathsegment;;137;;,tx_realurl_exclude', '2', 'after:nav_title');
	t3lib_extMgm::addToAllTCAtypes('pages', 'tx_realurl_pathsegment;;137;;,tx_realurl_exclude', '1,5,4,199,254', 'after:title');
}

t3lib_extMgm::addLLrefForTCAdescr('pages','EXT:realurl/locallang_csh.xml');

$TCA['pages_language_overlay']['columns'] += array(
	'tx_realurl_pathsegment' => array(
		'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_pathsegment',
		'exclude' => 1,
		'config' => array (
			'type' => 'input',
			'max' => 255,
			'eval' => 'trim,nospace,lower'
		),
	),
);

t3lib_extMgm::addToAllTCAtypes('pages_language_overlay', 'tx_realurl_pathsegment', '', 'after:nav_title');


###########################
## EXTENSION: realurlmanagement
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/realurlmanagement/ext_tables.php
###########################

$_EXTKEY = 'realurlmanagement';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=="BE")	{
		
	t3lib_extMgm::addModule("web","txrealurlmanagementM1","",t3lib_extMgm::extPath($_EXTKEY)."mod1/");
}

###########################
## EXTENSION: tscobj
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/tscobj/ext_tables.php
###########################

$_EXTKEY = 'tscobj';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


	if (!defined ('TYPO3_MODE')) {
		die ('Access denied.');
	}
	
	// Load content TCA
	t3lib_div::loadTCA('tt_content');
	
	// Plugin options
	$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages,recursive';
	
	// Add flexform fields to plugin options
	$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform';
	
	// Add flexform DataStructures
	t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:' . $_EXTKEY . '/flexform_ds_pi1.xml');
	
	// Add plugins
	t3lib_extMgm::addPlugin(Array('LLL:EXT:tscobj/locallang_db.php:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');
	
	// Wizard icons
	if (TYPO3_MODE=='BE') {
		$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_tscobj_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_tscobj_pi1_wizicon.php';
	}

###########################
## EXTENSION: weeaar_googlesitemap
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/weeaar_googlesitemap/ext_tables.php
###########################

$_EXTKEY = 'weeaar_googlesitemap';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=="BE")	{
		
	t3lib_extMgm::addModule("web","txweeaargooglesitemapM1","",t3lib_extMgm::extPath($_EXTKEY)."mod1/");
}

###########################
## EXTENSION: indexed_search
## FILE:      /home/gregory/www/typo3dummy/typo3/sysext/indexed_search/ext_tables.php
###########################

$_EXTKEY = 'indexed_search';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addPlugin(Array('LLL:EXT:indexed_search/locallang.php:mod_indexed_search', $_EXTKEY));

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY] = 'layout,select_key,pages';

if (TYPO3_MODE=='BE')    {
	t3lib_extMgm::addModule('tools','isearch','after:log',t3lib_extMgm::extPath($_EXTKEY).'mod/');

	t3lib_extMgm::insertModuleFunction(
		'web_info',
		'tx_indexedsearch_modfunc1',
		t3lib_extMgm::extPath($_EXTKEY).'modfunc1/class.tx_indexedsearch_modfunc1.php',
		'LLL:EXT:indexed_search/locallang.php:mod_indexed_search'
	);
	t3lib_extMgm::insertModuleFunction(
		"web_info",
		"tx_indexedsearch_modfunc2",
		t3lib_extMgm::extPath($_EXTKEY)."modfunc2/class.tx_indexedsearch_modfunc2.php",
		"LLL:EXT:indexed_search/locallang.php:mod2_indexed_search"
	);
}

t3lib_extMgm::allowTableOnStandardPages('index_config');
t3lib_extMgm::addLLrefForTCAdescr('index_config','EXT:indexed_search/locallang_csh_indexcfg.xml');

if (t3lib_extMgm::isLoaded('crawler'))	{
	$TCA['index_config'] = Array (
		'ctrl' => Array (
			'title' => 'LLL:EXT:indexed_search/locallang_db.php:index_config',
			'label' => 'title',
			'tstamp' => 'tstamp',
			'crdate' => 'crdate',
			'cruser_id' => 'cruser_id',
			'type' => 'type',
			'default_sortby' => 'ORDER BY crdate',
			'enablecolumns' => Array (
				'disabled' => 'hidden',
				'starttime' => 'starttime',
			),
			'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
			'iconfile' => 'default.gif',
		),
		'feInterface' => Array (
			'fe_admin_fieldList' => 'hidden, starttime, title, description, type, depth, table2index, alternative_source_pid, get_params, chashcalc, filepath, extensions',
		)
	);
}


	// Example of crawlerhook (see also ext_localconf.php!)
/*
	t3lib_div::loadTCA('index_config');
	$TCA['index_config']['columns']['type']['config']['items'][] =  Array('My Crawler hook!', 'tx_myext_example1');
	$TCA['index_config']['types']['tx_myext_example1'] = $TCA['index_config']['types']['0'];
*/


###########################
## EXTENSION: irfaq
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/irfaq/ext_tables.php
###########################

$_EXTKEY = 'irfaq';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::allowTableOnStandardPages('tx_irfaq_q');

$TCA['tx_irfaq_q'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:irfaq/lang/locallang_db.xml:tx_irfaq_q',
		'label' => 'q',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'fe_group' => 'fe_group',
		),
		'dividers2tabs' => true,
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca/tca_q.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/icon_tx_irfaq_q.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, fe_group, q, cat, a, related',
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_irfaq_cat');

$TCA['tx_irfaq_cat'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:irfaq/lang/locallang_db.xml:tx_irfaq_cat',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca/tca_cat.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/icon_tx_irfaq_cat.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, fe_group, title',
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_irfaq_expert');

$TCA['tx_irfaq_expert'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:irfaq/lang/locallang_db.xml:tx_irfaq_expert',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'delete' => 'deleted',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca/tca_expert.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/icon_tx_irfaq_expert.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'name, email, url',
	)
);

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key,pages';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';

//adding sysfolder icon
t3lib_div::loadTCA('pages');
$TCA['pages']['columns']['module']['config']['items'][$_EXTKEY]['0'] = 'LLL:EXT:irfaq/lang/locallang_db.xml:tx_irfaq.sysfolder';
$TCA['pages']['columns']['module']['config']['items'][$_EXTKEY]['1'] = $_EXTKEY;

t3lib_extMgm::addStaticFile($_EXTKEY, 'static/ts/', 'IRFAQ default TS');
//t3lib_extMgm::addStaticFile($_EXTKEY, 'static/css/', 'Default CSS-styles (obsolete)');
t3lib_extMgm::addPlugin(array('LLL:EXT:irfaq/lang/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY . '_pi1'), 'list_type');
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:irfaq/flexform/flexform_ds.xml');

if (TYPO3_MODE=='BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_irfaq_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY) . 'pi1/class.tx_irfaq_pi1_wizicon.php';
	//adding sysfolder icon
	$ICON_TYPES[$_EXTKEY] = array('icon' => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/icon_tx_irfaq_sysfolder.gif');
}

###########################
## EXTENSION: tt_news
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/tt_news/ext_tables.php
###########################

$_EXTKEY = 'tt_news';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


/**
 * $Id: ext_tables.php 44687 2011-03-06 15:21:07Z rupi $
 */

if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
	// get extension configuration
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['tt_news']);





$TCA['tt_news'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:tt_news/locallang_tca.xml:tt_news',
		'label' => ($confArr['label']) ? $confArr['label'] : 'title',
		'label_alt' => $confArr['label_alt'] . ($confArr['label_alt2'] ? ',' . $confArr['label_alt2'] : ''),
		'label_alt_force' => $confArr['label_alt_force'],
		'default_sortby' => 'ORDER BY datetime DESC',
		'prependAtCopy' => $confArr['prependAtCopy'] ? 'LLL:EXT:lang/locallang_general.php:LGL.prependAtCopy' : '',
 		'versioningWS' => TRUE,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'shadowColumnsForNewPlaceholders' => 'sys_language_uid,l18n_parent,starttime,endtime,fe_group',

		'dividers2tabs' => TRUE,
		'useColumnsForDefaultValues' => 'type',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'crdate' => 'crdate',
		'tstamp' => 'tstamp',
		'delete' => 'deleted',
		'type' => 'type',
		'cruser_id' => 'cruser_id',
		'editlock' => 'editlock',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'typeicon_column' => 'type',
		'typeicons' => array (
			'1' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/tt_news_article.gif',
			'2' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/tt_news_exturl.gif',
		),
//		'mainpalette' => '10',
		'thumbnail' => 'image',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/ext_icon.gif',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php'
	)
);


#$category_OrderBy = $confArr['category_OrderBy'];
$TCA['tt_news_cat'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:tt_news/locallang_tca.xml:tt_news_cat',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'delete' => 'deleted',
		'default_sortby' => 'ORDER BY uid',
		'treeParentField' => 'parent_category',
		'dividers2tabs' => TRUE,
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
// 		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.php:LGL.prependAtCopy',
		'hideAtCopy' => true,
		'mainpalette' => '2,10',
		'crdate' => 'crdate',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/gfx/tt_news_cat.gif',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php'
	)
);

	// load tt_content to $TCA array
t3lib_div::loadTCA('tt_content');
	// remove some fields from the tt_content content element
$TCA['tt_content']['types']['list']['subtypes_excludelist'][9] = 'layout,select_key,pages,recursive';
	// add FlexForm field to tt_content
$TCA['tt_content']['types']['list']['subtypes_addlist'][9] = 'pi_flexform';
	// add tt_news to the "insert plugin" content element (list_type = 9)
t3lib_extMgm::addPlugin(array('LLL:EXT:tt_news/locallang_tca.xml:tt_news', 9));

t3lib_extMgm::addTypoScriptSetup('
  includeLibs.ts_news = EXT:tt_news/pi/class.tx_ttnews.php
  plugin.tt_news = USER
  plugin.tt_news {
    userFunc = tx_ttnews->main_news

    # validate some configuration values and display a message if errors have been found
    enableConfigValidation = 1
  }
');

	// initialize static extension templates
t3lib_extMgm::addStaticFile($_EXTKEY,'pi/static/ts_new/','News settings');
t3lib_extMgm::addStaticFile($_EXTKEY,'pi/static/css/','News CSS-styles');
//t3lib_extMgm::addStaticFile($_EXTKEY,'pi/static/ts_old/','table-based tmpl');
t3lib_extMgm::addStaticFile($_EXTKEY,'pi/static/rss_feed/','News feeds (RSS,RDF,ATOM)');

	// allow news and news-category records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tt_news_cat');
t3lib_extMgm::allowTableOnStandardPages('tt_news');
	// add the tt_news record to the insert records content element
t3lib_extMgm::addToInsertRecords('tt_news');

	// switch the XML files for the FlexForm depending on if "use StoragePid"(general record Storage Page) is set or not.
if ($confArr['useStoragePid']) {
	t3lib_extMgm::addPiFlexFormValue(9, 'FILE:EXT:tt_news/flexform_ds.xml');
} else {
	t3lib_extMgm::addPiFlexFormValue(9, 'FILE:EXT:tt_news/flexform_ds_no_sPID.xml');
}


t3lib_extMgm::addPageTSConfig('
	# RTE mode in table "tt_news"
	RTE.config.tt_news.bodytext.proc.overruleMode = ts_css

	TCEFORM.tt_news.bodytext.RTEfullScreenWidth = 100%



mod.web_txttnewsM1 {
	catmenu {
		expandFirst = 1

		show {
			cb_showEditIcons = 1
			cb_expandAll = 1
			cb_showHiddenCategories = 1

			btn_newCategory = 1
		}
	}
	list {
		limit = 15
		pidForNewArticles =
		fList = pid,uid,title,datetime,archivedate,tstamp,category;author
		icon = 1

		# configures the behavior of the record-title link. Possible values:
		# edit: link editform, view: link FE singleView, any other value: no link
		clickTitleMode = edit

		noListWithoutCatSelection = 1

		show {
			cb_showOnlyEditable = 1
			cb_showThumbs = 1
			search = 1

		}
		imageSize = 50

	}
	defaultLanguageLabel =
}



');




	// initalize "context sensitive help" (csh)
t3lib_extMgm::addLLrefForTCAdescr('tt_news','EXT:tt_news/csh/locallang_csh_ttnews.php');
t3lib_extMgm::addLLrefForTCAdescr('tt_news_cat','EXT:tt_news/csh/locallang_csh_ttnewscat.php');
t3lib_extMgm::addLLrefForTCAdescr('xEXT_tt_news','EXT:tt_news/csh/locallang_csh_manual.xml');
t3lib_extMgm::addLLrefForTCAdescr('_MOD_web_txttnewsM1','EXT:tt_news/csh/locallang_csh_mod_newsadmin.xml');

//TODO how to insert CSH to the be_users table ???

	// adds processing for extra "codes" that have been added to the "what to display" selector in the content element by other extensions
include_once(t3lib_extMgm::extPath($_EXTKEY).'lib/class.tx_ttnews_itemsProcFunc.php');
	// class for displaying the category tree in BE forms.
include_once(t3lib_extMgm::extPath($_EXTKEY).'lib/class.tx_ttnews_TCAform_selectTree.php');
	// class that uses hooks in class.t3lib_tcemain.php (processDatamapClass and processCmdmapClass)
	// to prevent not allowed "commands" (copy,delete,...) for a certain BE usergroup
include_once(t3lib_extMgm::extPath($_EXTKEY).'lib/class.tx_ttnews_tcemain.php');





$tempColumns = array (
		'tt_news_categorymounts' => array (
			'exclude' => 1,
		#	'l10n_mode' => 'exclude', // the localizalion mode will be handled by the userfunction
			'label' => 'LLL:EXT:tt_news/locallang_tca.xml:tt_news.categorymounts',
			'config' => array (


				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_ttnews_TCAform_selectTree->renderCategoryFields',
				'treeView' => 1,
				'foreign_table' => 'tt_news_cat',
				#'foreign_table_where' => $fTableWhere.'ORDER BY tt_news_cat.'.$confArr['category_OrderBy'],
				'size' => 3,
				'minitems' => 0,
				'maxitems' => 500,
// 				'MM' => 'tt_news_cat_mm',

			)
		),
// 		'tt_news_cmounts_usesubcats' => array (
// 			'exclude' => 1,
// 			'label' => 'LLL:EXT:tt_news/locallang_tca.xml:tt_news.cmounts_usesubcats',
// 			'config' => array (
// 				'type' => 'check'
// 			)
// 		),
);


t3lib_div::loadTCA('be_groups');
t3lib_extMgm::addTCAcolumns('be_groups',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('be_groups','tt_news_categorymounts;;;;1-1-1');

$tempColumns['tt_news_categorymounts']['displayCond'] = 'FIELD:admin:=:0';
// $tempColumns['tt_news_cmounts_usesubcats']['displayCond'] = 'FIELD:admin:=:0';


t3lib_div::loadTCA('be_users');
t3lib_extMgm::addTCAcolumns('be_users',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('be_users','tt_news_categorymounts;;;;1-1-1');


if (TYPO3_MODE == 'BE')	{
	if (t3lib_div::int_from_ver(TYPO3_version) >= 4000000) {
		if (t3lib_div::int_from_ver(TYPO3_version) >= 4002000) {
			t3lib_extMgm::addModule('web','txttnewsM1','',t3lib_extMgm::extPath($_EXTKEY).'mod1/');

			$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables'][$_EXTKEY][0]['fList'] = 'uid,title,author,category,datetime,archivedate,tstamp';
			$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables'][$_EXTKEY][0]['icon'] = TRUE;


		} else {
			/**
			 * @deprecated
			 * this module will be removed completely in future versions
			 */
			t3lib_extMgm::insertModuleFunction(
				'web_info',
				'tx_ttnewscatmanager_modfunc1',
				t3lib_extMgm::extPath($_EXTKEY).'modfunc1/class.tx_ttnewscatmanager_modfunc1.php',
				'LLL:EXT:tt_news/modfunc1/locallang.xml:moduleFunction.tx_ttnews_modfunc1'
			);
		}
		// register contextmenu for the tt_news category manager
		$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][] = array(
			'name' => 'tx_ttnewscatmanager_cm1',
			'path' => t3lib_extMgm::extPath($_EXTKEY).'cm1/class.tx_ttnewscatmanager_cm1.php'
		);
	}
		// Adds a tt_news wizard icon to the content element wizard.
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_ttnews_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi/class.tx_ttnews_wizicon.php';

		// add folder icon
	if (t3lib_div::int_from_ver(TYPO3_version) < 4004000) {
		$ICON_TYPES['news'] = array('icon' => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/gfx/ext_icon_ttnews_folder.gif');
	} else {
		t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-news', t3lib_extMgm::extRelPath($_EXTKEY) . 'res/gfx/ext_icon_ttnews_folder.gif');
	}

	if (TYPO3_UseCachingFramework) {
		// register the cache in BE so it will be cleared with "clear all caches"
		try {
			$GLOBALS['typo3CacheFactory']->create(
				'tt_news_cache',
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tt_news_cache']['frontend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tt_news_cache']['backend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tt_news_cache']['options']);
		} catch (t3lib_cache_exception_DuplicateIdentifier $e) {
			// do nothing, a tt_news_cache cache already exists
		}
	}

}

	// register HTML template for the tt_news BackEnd Module
$GLOBALS['TBE_STYLES']['htmlTemplates']['mod_ttnews_admin.html'] = t3lib_extMgm::extRelPath('tt_news').'mod1/mod_ttnews_admin.html';





###########################
## EXTENSION: mbl_newsevent
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/mbl_newsevent/ext_tables.php
###########################

$_EXTKEY = 'mbl_newsevent';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);

$tempColumns = Array (
	"tx_mblnewsevent_isevent" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_isevent",		
		"config" => Array (
			"type" => "check",
		)
	),
	"tx_mblnewsevent_from" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_from",		
		"config" => Array (
			"type" => "input",
			"size" => "12",
			"max" => "20",
			"eval" => "date",
			"checkbox" => "0",
			"default" => "0"
		)
	),
	"tx_mblnewsevent_fromtime" => Array (		
		"exclude" => 1,	
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_fromtime",
		"config" => Array (
			"type" => "input",
			"size" => "6",
			"max" => "20",
			"eval" => "time",
			"default" => "0",
			"checkbox" => "0"
		)
	),
	"tx_mblnewsevent_to" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_to",		
		"config" => Array (
			"type" => "input",
			"size" => "12",
			"max" => "20",
			"eval" => "date",
			"checkbox" => "0",
			"default" => "0"
		)
	),
	"tx_mblnewsevent_totime" => Array (		
		"exclude" => 1,	
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_totime",
		"config" => Array (
			"type" => "input",
			"size" => "6",
			"max" => "20",
			"eval" => "time",
			"default" => "0",
			"checkbox" => "0"
		)
	),
	"tx_mblnewsevent_hasregistration" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_hasregistration",		
		"config" => Array (
			"type" => "check",
		)
	),
	"tx_mblnewsevent_regfrom" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_regfrom",		
		"config" => Array (
			"type" => "input",
			"size" => "12",
			"max" => "20",
			"eval" => "date",
			"checkbox" => "0",
			"default" => "0"
		)
	),
	"tx_mblnewsevent_regfromtime" => Array (		
		"exclude" => 1,	
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_regfromtime",
		"config" => Array (
			"type" => "input",
			"size" => "6",
			"max" => "20",
			"eval" => "time",
			"default" => "0",
			"checkbox" => "0"
		)
	),
	"tx_mblnewsevent_regto" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_regto",		
		"config" => Array (
			"type" => "input",
			"size" => "12",
			"max" => "20",
			"eval" => "date",
			"checkbox" => "0",
			"default" => "0"
		)
	),
	"tx_mblnewsevent_regtotime" => Array (		
		"exclude" => 1,	
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_regtotime",
		"config" => Array (
			"type" => "input",
			"size" => "6",
			"max" => "20",
			"eval" => "time",
			"default" => "0",
			"checkbox" => "0"
		)
	),
	'tx_mblnewsevent_regurl' => Array (
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_regurl',
		'config' => Array (
			'type' => 'input',
			'size' => '40',
			'max' => '256',
			'wizards' => Array(
				'_PADDING' => 2,
				'link' => Array(
					'type' => 'popup',
					'title' => 'Link',
					'icon' => 'link_popup.gif',
					'script' => 'browse_links.php?mode=wizard',
					'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
				)
			)
		)
	),
	'tx_mblnewsevent_registrationmax' => Array (
		"exclude" => 1,
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_registrationmax",
		"config" => Array (
			"type" => "input",
			"size" => "4",
			"eval" => "int",
		)
	),
	"tx_mblnewsevent_where" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_where",		
		"config" => Array (
			"type" => "input",	
			"size" => "30",
		)
	),
	"tx_mblnewsevent_organizer" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_organizer",		
		"config" => Array (
			"type" => "group",	
			"internal_type" => "db",	
			"allowed" => "fe_users,be_users,tt_address",	
			"size" => 1,	
			"minitems" => 0,
			"maxitems" => 1,	
			//"MM" => "tt_news_tx_mblfenewsadd_feuser_mm",
		)
	),
	'tx_mblnewsevent_price' => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_price",		
		"config" => Array (
			"type" => "input",
			"size" => "6",
			"max" => "20",
			"eval" => "double2",
			"default" => "0.00"
		)
	),
	'tx_mblnewsevent_pricenote' => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:mbl_newsevent/locallang_db.php:tt_news.tx_mblnewsevent_pricenote",		
		"config" => Array (
			"type" => "input",
			"size" => "30",
			"max" => "255",
		)
	),
);

if(is_array($confArr) && $confArr['multiLineWhere']) {
	$tempColumns['tx_mblnewsevent_where']['config']['type'] = 'text';
	$tempColumns['tx_mblnewsevent_where']['config']['cols'] = 30;
	$tempColumns['tx_mblnewsevent_where']['config']['rows'] = 4;
}


t3lib_div::loadTCA("tt_news");
t3lib_extMgm::addTCAcolumns("tt_news",$tempColumns,1);

/*
Thanks to Peter Klein!
*/
$TCA['tt_news']['palettes']['tx_mblnewsevent_from_palette'] = array('showitem' => 'tx_mblnewsevent_from,tx_mblnewsevent_fromtime','canNotCollapse' => 1);
$TCA['tt_news']['palettes']['tx_mblnewsevent_to_palette'] = array('showitem' => 'tx_mblnewsevent_to,tx_mblnewsevent_totime','canNotCollapse' => 1);
$TCA['tt_news']['palettes']['tx_mblnewsevent_regfrom_palette'] = array('showitem' => 'tx_mblnewsevent_regfrom,tx_mblnewsevent_regfromtime','canNotCollapse' => 1);
$TCA['tt_news']['palettes']['tx_mblnewsevent_regto_palette'] = array('showitem' => 'tx_mblnewsevent_regto,tx_mblnewsevent_regtotime','canNotCollapse' => 1);
$TCA['tt_news']['palettes']['tx_mblnewsevent_price_palette'] = array('showitem' => 'tx_mblnewsevent_pricenote','canNotCollapse' => 1);
t3lib_extMgm::addToAllTCAtypes("tt_news",",--div--;LLL:EXT:mbl_newsevent/locallang_db.xml:eventEditSection,tx_mblnewsevent_isevent;;;;1-1-1, --palette--;LLL:EXT:mbl_newsevent/locallang_db.xml:tt_news.tx_mblnewsevent_fromlabel:;tx_mblnewsevent_from_palette;;,--palette--;LLL:EXT:mbl_newsevent/locallang_db.xml:tt_news.tx_mblnewsevent_tolabel:;tx_mblnewsevent_to_palette;;, tx_mblnewsevent_hasregistration;;;;2-2-2, --palette--;LLL:EXT:mbl_newsevent/locallang_db.xml:tt_news.tx_mblnewsevent_regfromlabel:;tx_mblnewsevent_regfrom_palette;;,--palette--;LLL:EXT:mbl_newsevent/locallang_db.xml:tt_news.tx_mblnewsevent_regtolabel:;tx_mblnewsevent_regto_palette;;, tx_mblnewsevent_registrationmax, tx_mblnewsevent_regurl, tx_mblnewsevent_where;;;;3-3-3, tx_mblnewsevent_organizer;;;;4-4-4,tx_mblnewsevent_price;;;;5-5-5,--palette--;LLL:EXT:mbl_newsevent/locallang_db.xml:tt_news.tx_mblnewsevent_pricenote:;tx_mblnewsevent_price_palette;;,;;;;6-6-6,--div--;LLL:EXT:mbl_newsevent/locallang_db.xml:accessSection");

t3lib_extMgm::addStaticFile($_EXTKEY,'static/standard/','News Event');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/ics/','News Event iCalendar (.ics) feed (type=101)');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/singleics/','Single News Event iCalendar (.ics) (type=102)');


t3lib_div::loadTCA('tt_content');

if (TYPO3_MODE=='BE')	{
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('EVENT_FUTURE', 'EVENT_FUTURE');
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('EVENT_PAST', 'EVENT_PAST');
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('LATEST_EVENT_PAST', 'LATEST_EVENT_PAST');
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('LATEST_EVENT_FUTURE', 'LATEST_EVENT_FUTURE');
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('EVENT_CURRENT', 'EVENT_CURRENT');
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('LATEST_EVENT_CURRENT', 'LATEST_EVENT_CURRENT');
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('EVENT_REGISTERABLE', 'EVENT_REGISTERABLE');
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('LATEST_EVENT_REGISTERABLE', 'LATEST_EVENT_REGISTERABLE');
	
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['order_by'][] = array('Event start', '(tx_mblnewsevent_from + tx_mblnewsevent_fromtime)');
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['order_by'][] = array('Event end', '(tt_news.tx_mblnewsevent_to + tt_news.tx_mblnewsevent_totime)');
	//$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('EVENT_SELECTOR', 'EVENT_SELECTOR');
	//require_once(t3lib_extMgm::extPath('mbl_newsevent').'class.mbl_newsevent.php');
}


###########################
## EXTENSION: powermail
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/powermail/ext_tables.php
###########################

$_EXTKEY = 'powermail';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$extPath = t3lib_extMgm::extPath($_EXTKEY);
$extRelPath = t3lib_extMgm::extRelPath($_EXTKEY);
$extIconPath = $extRelPath . 'res/img/';

t3lib_extMgm::addStaticFile($_EXTKEY, 'static/pi1/', 'Powermail');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/css_basic/', 'Powermail basic CSS');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/css_fancy/', 'Powermail fancy CSS');
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['powermail']);
t3lib_extMgm::allowTableOnStandardPages('tx_powermail_fieldsets');


require_once($extPath . 'lib/class.user_powermail_tx_powermail_forms_recip_id.php');
if (TYPO3_MODE == 'BE' || (TYPO3_MODE == 'FE' && t3lib_div::int_from_ver(TYPO3_version) > t3lib_div::int_from_ver('4.2.99') && isset($GLOBALS['BE_USER']) && $GLOBALS['BE_USER']->isFrontendEditingActive())) {
	require_once($extPath . 'lib/class.user_powermail_tx_powermail_forms_recip_table.php');
	require_once($extPath . 'lib/class.user_powermail_tx_powermail_forms_preview.php');
	require_once($extPath . 'lib/class.user_powermail_tx_powermail_forms_sender_field.php');
	require_once($extPath . 'lib/class.user_powermail_tx_powermail_fields_fe_field.php');
	require_once($extPath . 'lib/class.user_powermail_tx_powermail_example.php');
	require_once($extPath . 'lib/class.user_powermail_tx_powermail_uid.php');
	require_once($extPath . 'lib/user_powermail_updateError.php');
}

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key,pages,recursive';

t3lib_extMgm::addToInsertRecords('tx_powermail_fieldsets');

$GLOBALS['TCA']['tx_powermail_fieldsets'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_fieldsets',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'sortby' => 'sorting',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime'
		),
		'dynamicConfigFile' => $extPath . 'tca.php',
		'iconfile'          => $extIconPath . 'icon_tx_powermail_fieldsets.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'fe_group, form, title, felder, hidden',
	)
);


t3lib_extMgm::allowTableOnStandardPages('tx_powermail_fields');

t3lib_extMgm::addToInsertRecords('tx_powermail_fields');

$GLOBALS['TCA']['tx_powermail_fields'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_fields',
		'requestUpdate' => 'formtype',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime'
		),
		'dynamicConfigFile' => $extPath . 'tca.php',
		'iconfile'          => $extIconPath . 'icon_tx_powermail_fields.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'fieldset, title, name, flexform, value, size, maxsize, max, min, step, pattern, placeholder, mandantory, more, fe_field, hidden',
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_powermail_mails');

t3lib_extMgm::addToInsertRecords('tx_powermail_mails');

$GLOBALS['TCA']['tx_powermail_mails'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_mails',
		'label'     => 'sender',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate DESC',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => $extPath . 'tca.php',
		'iconfile'          => $extIconPath . 'icon_tx_powermail_mails.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'formid, recipient, subject_r, sender, content, piVars, senderIP, UserAgent, Referer, SP_TZ, hidden',
	)
);

t3lib_div::loadTCA('tt_content');

t3lib_extMgm::addPlugin(
	array(
		'LLL:EXT:powermail/locallang_db.xml:tt_content.CType_pi1',
		$_EXTKEY . '_pi1',
		$extRelPath . 'ext_icon.gif'
	),
	'CType'
);

$tempColumns = Array (
	'tx_powermail_title' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.title',
		'config' => Array (
			'type' => 'input',
			'size' => '30',
			'max' => '30',
			'eval' => 'required,trim,lower,alphanum_x,nospace',
		)
	),
	'tx_powermail_recipient' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.recipient',
		'config' => Array (
			'type' => 'text',
			'cols' => '60',
			'rows' => '2',
		)
	),
	'tx_powermail_subject_r' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.subject_r',
		'config' => Array (
			'type' => 'input',
			'size' => '30',
		)
	),
	'tx_powermail_subject_s' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.subject_s',
		'config' => Array (
			'type' => 'input',
			'size' => '30',
		)
	),
	'tx_powermail_sender' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.sender',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.recip_table.I.0', '0'),
			),
			'itemsProcFunc' => 'user_powermail_tx_powermail_forms_sender_field->main',
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'tx_powermail_sendername' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.sendername',
		'config' => Array (
			'type' => 'select',
			'items' => array(),
			'itemsProcFunc' => 'user_powermail_tx_powermail_forms_sender_field->main',
			'size' => 3,
			'maxitems' => 10,
		)
	),
	'tx_powermail_confirm' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.confirm',
		'config' => Array (
			'type' => 'check',
			'default' => 1,
		)
	),
	'tx_powermail_pages' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.startingpoint',
		'config' => Array (
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'size' => 1,
			'maxitems' => 1,
			'show_thumbs' => 1,
		)
	),
	'tx_powermail_multiple' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.multiple',
		'config' => Array (
			'type'  => 'select',
			'items' => array (
				Array('LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.multiple.I.0', '0'),
				Array('LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.multiple.I.1', '1'),
				Array('LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.multiple.I.2', '2'),
			),
		)
	),
	'tx_powermail_recip_table' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.recip_table',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
				Array('', '0'),
			),
			'itemsProcFunc' => 'user_powermail_tx_powermail_forms_recip_table->main',
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'tx_powermail_recip_id' => Array (
		'exclude' => 1,
		'displayCond' => 'FIELD:tx_powermail_recip_table:REQ:true',
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.recip_id',
		'config' => Array (
			'type' => 'select',
			'items' => Array (
			),
			'itemsProcFunc' => 'user_powermail_tx_powermail_forms_recip_id->main',
			'size' => 5,
			'maxitems' => 100,
			'allowNonIdValues' => 1,
		)
	),
	'tx_powermail_thanks' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.thanks',
		'config' => Array (
			'type' => 'text',
			'cols' => '60',
			'rows' => '2',
			'default' => '###POWERMAIL_ALL###',
		)
	),
	'tx_powermail_mailsender' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.mailsender',
		'config' => Array (
			'type' => 'text',
			'cols' => '60',
			'rows' => '2',
			'default' => '###POWERMAIL_ALL###',
		)
	),
	'tx_powermail_mailreceiver' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.mailreceiver',
		'config' => Array (
			'type' => 'text',
			'cols' => '60',
			'rows' => '2',
			'default' => '###POWERMAIL_ALL###',
		)
	),
	'tx_powermail_redirect' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.redirect',
		'config' => Array (
			'type' => 'input',
			'size' => '30',
			'wizards' => Array(
				'_PADDING' => 2,
				'link' => Array(
					'type' => 'popup',
					'title' => 'Link',
					'icon' => 'link_popup.gif',
					'script' => 'browse_links.php?mode=wizard',
					'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
				),
			),
		)
	),
	'user_powermail_updateError' => Array (
		'label' => 'Powermail error',
		'config' => Array (
			'type' => 'user',
			'userFunc' => 'user_powermail_updateError->user_updateError'
		)
	),
	'tx_powermail_fieldsets' => Array(
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.fieldsets',
		'config' => Array (
			'type' => 'inline',
			'foreign_table' => 'tx_powermail_fieldsets',
			'foreign_field' => 'tt_content',
			'foreign_sortby' => 'sorting',
			'foreign_label' => 'title',
			'maxitems' => 1000,
			'appearance' => Array(
				'collapseAll' => 1,
				'expandSingle' => 1,
				'useSortable' => 1,
				'newRecordLinkAddTitle' => 1,
				'levelLinksPosition' => 'both',
				'showSynchronizationLink' => 0,
				'showAllLocalizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showRemovedLocalizationRecords' => 1,
			),
			'behaviour' => array(
				'localizeChildrenAtParentLocalization' => 1,
				'localizationMode' => 'select',
			),
		)
	),
	'tx_powermail_users' => Array (
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.users',
		'config' => Array (
			'type' => 'passthrough'
		)
	),
	'tx_powermail_preview' => Array (
		'label' => 'LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.preview',
		'config' => Array (
			'type' => 'user',
			'userFunc' => 'user_powermail_tx_powermail_forms_preview->main',
		)
	),
);

	// If preview window is deactivated, clear tx_powermail_preview
if ($confArr['usePreview'] != 1) {
	unset($tempColumns['tx_powermail_preview']);
}

	// If settings for powermail found in localconf, clear user_powermail_updateError
if (strlen($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['powermail']) > 1) {
	unset($tempColumns['user_powermail_updateError']);
}

t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content', $tempColumns, 1);

$GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_pi1']['showitem'] = '
	CType;;4;button;1-1-1, hidden,1-1-1, header;;3;;3-3-3, linkToTop;;;;3-3-3,
	--div--;LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.div1, tx_powermail_title;;;;2-2-2, tx_powermail_pages;;;;3-3-3, tx_powermail_confirm;;;;3-3-3, tx_powermail_multiple,
	--div--;LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.div2, tx_powermail_fieldsets;;;;4-4-4, user_powermail_updateError, tx_powermail_preview,
	--div--;LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.div3, tx_powermail_sender, tx_powermail_sendername, tx_powermail_subject_s,, tx_powermail_mailsender;;;richtext:rte_transform[mode=ts],
	--div--;LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.div4, tx_powermail_subject_r, tx_powermail_recipient, tx_powermail_users;;;;5-5-5,tx_powermail_recip_table, tx_powermail_recip_id, tx_powermail_mailreceiver;;;richtext:rte_transform[mode=ts],
	--div--;LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.div5, tx_powermail_thanks;;;richtext:rte_transform[mode=ts], tx_powermail_redirect,
	--div--;LLL:EXT:powermail/locallang_db.xml:tx_powermail_forms.div8, starttime, endtime, fe_group';

	// If preview window is deactivated, clear tx_powermail_preview
if ($confArr['usePreview'] != 1) {
	$GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_pi1']['showitem'] = str_replace('tx_powermail_preview,', '', $GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_pi1']['showitem']);
}

	// Add "tx_powermail_recip_table" to the requestUpdate
$GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] ? ',tx_powermail_recip_table' : 'tx_powermail_recip_table';

if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_powermail_pi1_wizicon'] = $extPath . 'pi1/class.tx_powermail_pi1_wizicon.php';
	if ($confArr['disableBackendModule'] !== '1') {
		t3lib_extMgm::addModule('web', 'txpowermailM1', '', $extPath . 'mod1/');
	}
}

###########################
## EXTENSION: ameos_dragndropupload
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/ameos_dragndropupload/ext_tables.php
###########################

$_EXTKEY = 'ameos_dragndropupload';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];



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

###########################
## EXTENSION: skinFlex
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/skinFlex/ext_tables.php
###########################

$_EXTKEY = 'skinFlex';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];


ux_tx_weccontentelements_lib::addContentElement($_EXTKEY, 'slideshow');
// ux_tx_weccontentelements_lib::addContentElement($_EXTKEY, 'clickToPlay');
// ux_tx_weccontentelements_lib::addContentElement($_EXTKEY, 'imageLegend');

// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexContact');
// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexQuote');
// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexIntro');

// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexZoomSur');
// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexKaleidoscope');

// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexSlideshow');
// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexLogoList');
// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexList');

// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexEtapes');
// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexPedago');
// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexChrono');
// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexIndex');
// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexIndexNav');

// tx_weccontentelements_lib::addContentElement($_EXTKEY, 'flexAjaxZoom');


###########################
## EXTENSION: scriptmerger
## FILE:      /home/gregory/www/typo3dummy/typo3conf/ext/scriptmerger/ext_tables.php
###########################

$_EXTKEY = 'scriptmerger';
$_EXTCONF = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY];



if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

/** @noinspection PhpUndefinedVariableInspection */
t3lib_extMgm::addStaticFile($_EXTKEY, 'configuration/', 'Scriptmerger');

?>
