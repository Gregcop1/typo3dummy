<?php
# TYPO3 CVS ID: $Id: ext_localconf.php,v 1.3 2004/03/22 16:37:55 typo3 Exp $

if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE=='BE')	{
	$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['typo3/file_upload.php']=t3lib_extMgm::extPath($_EXTKEY).'res/xclass/class.ux_sc_file_upload.php';
}
?>