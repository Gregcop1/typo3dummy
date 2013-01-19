<?php

########################################################################
# Extension Manager/Repository config file for ext "bvd_set_page_title".
#
# Auto generated 22-10-2012 09:54
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Set subtitle as page title',
	'description' => 'Use the subtitle field to generate the page title in the Front End',
	'category' => 'fe',
	'shy' => 0,
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author' => 'Bart van Doveren - Thanks to Kasper!',
	'author_email' => 'webmaster@afsvlaanderen.be',
	'author_company' => 'AFS',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'version' => '0.0.1',
	'constraints' => array(
		'depends' => array(
			'typo3' => '3.5.0-0.0.0',
			'php' => '3.0.0-0.0.0',
			'cms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:2:{s:29:"class.ux_t3lib_TStemplate.php";s:4:"6e98";s:17:"ext_localconf.php";s:4:"1e03";}',
);

?>