<?php
	$_EXTCONF = unserialize($_EXTCONF);
	t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skin_dummy/pageTSconfig.txt">');

    tx_gclib::autoGenerateSetup($_EXTKEY, array('typoscript/extensions/', 'typoscript/blocs/', 'typoscript/menus/', 'typoscript/page/'));

	require_once(t3lib_extMgm::extPath('skin_dummy').'class.ux_tx_weccontentelements_lib.php');
?>