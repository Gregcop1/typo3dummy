<?php

/**
 * Extension of the t3lib_TStemplate class.
 */
class ux_t3lib_TStemplate extends t3lib_TStemplate {
	function printTitle($title,$no_title=0)	{
                                $titlevar = $GLOBALS["TSFE"]->page["subtitle"]?$GLOBALS["TSFE"]->page["subtitle"]:$GLOBALS["TSFE"]->page["title"];
		$title = parent::printTitle($titlevar,$no_title);
		return $title;
	}
}
?>