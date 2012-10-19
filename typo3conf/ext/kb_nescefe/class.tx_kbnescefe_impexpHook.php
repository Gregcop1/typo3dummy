<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Bernhard Kraft (kraftb@think-open.at)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * Hook class for the import/export module
 *
 * @author	Bernhard Kraft <kraftb@think-open.at>
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */


class tx_kbnescefe_impexpHook {

	function updateColPos($params, &$parentObject) {
		if (is_array($params) && is_array($params['data']) && is_array($params['data']['tt_content'])) {
			foreach ($params['data']['tt_content'] as $key => &$data) {
				$this->updateColPos_record($data);
			}
		}
	}

	function updateColPos_record(&$data) {
		if ($data['parentPosition']) {
			$data['colPos'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['kb_nescefe']['containerElementColPos'];
		}
	}

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['kb_nescefe/class.tx_kbnescefe_impexpHook.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['kb_nescefe/class.tx_kbnescefe_impexpHook.php']);
}

?>
