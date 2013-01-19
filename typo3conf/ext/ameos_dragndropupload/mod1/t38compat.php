<?php

	function t38compat_mkdir_deep($destination,$deepDir) {
		if(!function_exists('t3lib_div::test')) {
			$allParts = t3lib_div::trimExplode('/',$deepDir,1);
			$root = '';
			foreach($allParts as $part)	{
				$root.= $part.'/';
				if (!is_dir($destination.$root))	{
					t3lib_div::mkdir($destination.$root);
					if (!@is_dir($destination.$root))	{
						return 'Error: The directory "'.$destination.$root.'" could not be created...';
					}
				}
			}
		} else {
			return t3lib_div::mkdir_deep($destination,$deepDir);
		}
	}

?>