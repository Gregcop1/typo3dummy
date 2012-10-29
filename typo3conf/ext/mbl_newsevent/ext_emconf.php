<?php

########################################################################
# Extension Manager/Repository config file for ext "mbl_newsevent".
#
# Auto generated 22-10-2012 10:10
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'News Event',
	'description' => 'Adds event date/time, location, price and registration info to news (tt_news). Event information can be downloaded to calendars through an iCalendar (.ics) feed. Requires some TypoScript setup: Please read the manual!',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '2.4.1',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'tt_news',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Mathias Bolt Lesniak',
	'author_email' => 'mathias@lilio.com',
	'author_company' => 'LiliO Design',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'tt_news' => '',
			'php' => '5.0.0-0.0.0',
			'typo3' => '4.0.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:22:{s:20:"class.ext_update.php";s:4:"a347";s:23:"class.mbl_newsevent.php";s:4:"468d";s:19:"event_template.tmpl";s:4:"bb2e";s:21:"ext_conf_template.txt";s:4:"8a9f";s:12:"ext_icon.gif";s:4:"c028";s:17:"ext_localconf.php";s:4:"61e8";s:14:"ext_tables.php";s:4:"c769";s:14:"ext_tables.sql";s:4:"4c6a";s:13:"locallang.xml";s:4:"b75a";s:16:"locallang_db.xml";s:4:"2557";s:34:"tt_news_v2_template_newsevent.html";s:4:"25f6";s:14:"doc/manual.sxw";s:4:"2ef8";s:19:"doc/wizard_form.dat";s:4:"1b9f";s:20:"doc/wizard_form.html";s:4:"2a29";s:21:"res/ics_template.tmpl";s:4:"c57c";s:26:"res/singleics_download.gif";s:4:"6ebc";s:24:"static/ics/constants.txt";s:4:"006c";s:20:"static/ics/setup.txt";s:4:"2d4d";s:30:"static/singleics/constants.txt";s:4:"d2f3";s:26:"static/singleics/setup.txt";s:4:"1e25";s:29:"static/standard/constants.txt";s:4:"47e0";s:25:"static/standard/setup.txt";s:4:"738a";}',
);

?>