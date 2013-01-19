<?php
	$_EXTCONF = unserialize($_EXTCONF);
	t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skin/pageTSconfig.txt">');

    tx_gclib::autoGenerateSetup($_EXTKEY, array('typoscript/extensions/', 'typoscript/blocs/', 'typoscript/menus/', 'typoscript/page/', 'typoscript/templates/'));
?>