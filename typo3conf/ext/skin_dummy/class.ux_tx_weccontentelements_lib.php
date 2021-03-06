<?php

	class ux_tx_weccontentelements_lib extends tx_weccontentelements_lib {

		public function addContentElement($extensionKey, $key, $flexformPath = '', $type = '', $title = '', $description = '', $icon = '', $wizardIcon = '') {
			global $TCA;
		t3lib_div::loadTCA('tt_content');

			// Set defaults for title, description, icons, and content element type.
		$locallangPath = 'LLL:EXT:' . $extensionKey . '/' . $key . '/locallang.xml:tt_content.' . $key . '.';
		if (!$title) {
			$title = $locallangPath . 'title';
		}
		if (!$description) {
			$description = $locallangPath . 'description';
		}
		if (!$icon) {
			$icon = 'EXT:' . $extensionKey . '/' . $key . '/icon.gif';
		}
		if (!$wizardIcon) {
			$wizardIcon = t3lib_extMgm::extRelPath($extensionKey) . $key . '/wizard-icon.gif';
		}
		if (!$type) {
			$type = 'special';
		}
		if (!$flexformPath && @file_exists(t3lib_extMgm::extPath($extensionKey) . $key . '/flexform.xml')) {
			$flexformPath = 'FILE:EXT:' . $GLOBALS['_EXTKEY'] . '/' . $key . '/flexform.xml';
		}


		if ($flexformPath) {
			$TCA['tt_content']['columns']['pi_flexform']['config']['ds']['*,' . $key] = $flexformPath;
			$TCA['tt_content']['types'][$key] = array(
				'showitem' => 'CType;;4;;1-1-1, hidden, header;;3;;2-2-2, linkToTop;;;;3-3-3, --div--;' . $title . ', pi_flexform;;;;1-1-1, --div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access, starttime, endtime'
			);
		} else {
			$TCA['tt_content']['types'][$key] = array(
				'showitem' => 'CType;;4;;1-1-1, hidden, header;;3;;2-2-2, linkToTop;;;;3-3-3, --div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access, starttime, endtime'
			);

		}
		if(!preg_match('/, parentPosition/', $TCA['tt_content']['palettes'][4]['showitem'])){
			$TCA['tt_content']['palettes'][4]['showitem'] .= ', parentPosition';
		}

		t3lib_extMgm::addPlugin(array(
			$title,
			$key,
			$icon
		), 'CType');


		$TSConfig =
			'wizards.newContentElement.wizardItems.' . $type . ' {
				elements {
					' . $key . ' {
						icon = ' . $wizardIcon . '
						title = ' . $title . '
						description = ' . $description . '
						tt_content_defValues {
							CType = ' . $key .'
						}
					}
				}
				show := addToList(' . $key .')
			}';

		t3lib_extMgm::addPageTSConfig(
			'mod.' . $TSConfig . chr(10) .
			'templavoila.' . $TSConfig . chr(10)
		);
		}
	}
?>
