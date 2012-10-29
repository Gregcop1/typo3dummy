<?php
		
	class tx_ameosdragndropupload {
		
		function render($sPath, $bDam) {

			$aSizes = array(
				"iPhpFileMax"	=> 1024*1024*intval(ini_get("upload_max_filesize")),
				"iPhpPostMax"	=> 1024*1024*intval(ini_get("post_max_size")),
				"iT3FileMax"	=> 1024 * intval($GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize']),
			);
			asort($aSizes);
			$iMaxSize = array_shift($aSizes);

			$aConf = array(
				"sAppletPath"		=> t3lib_div::getIndpEnv("TYPO3_SITE_URL") . "" . t3lib_extmgm::siteRelPath("ameos_dragndropupload") . "res/jar/",
				"sUploadUrl"		=> t3lib_div::getIndpEnv("TYPO3_SITE_URL") . "" . t3lib_extmgm::siteRelPath("ameos_dragndropupload") . "mod1/index.php?fromJava=1",
				"sUploadPath"		=> $sPath,
				"sUserAgent"		=> t3lib_div::getIndpEnv("HTTP_USER_AGENT"),
				"sMaxUploadSize"	=> $iMaxSize,
				"sRand"				=> t3lib_div::shortMd5(time()),
				"sShortPath"		=> str_replace(PATH_site, "", $sPath),
				"sDam"				=> $bDam ? "1" : "0",
			);
			
		

			$sHtml =<<<APPLET

				<!--h3>Mass upload of folders and files</h3>
				<h4>Current folder: /{$aConf["sShortPath"]}</h4-->
				
				<script type="text/javascript">
					var sApplet = '<applet code="AmeosDragNDropUpload" archive="{$aConf["sAppletPath"]}AmeosDragNDropUpload.jar?{$aConf["sRand"]}" WIDTH=470 HEIGHT=439 MAYSCRIPT>'
							+ '<param name="uploadurl" value="{$aConf["sUploadUrl"]}" />'
							+ '<param name="target" value="{$aConf["sUploadPath"]}" />'
							+ '<param name="useragent" value="{$aConf["sUserAgent"]} "/>'
							+ '<param name="maxuploadsize" value="{$aConf["sMaxUploadSize"]}" />'
							+ '<param name="dam" value="{$aConf["sDam"]}" />'
						+ '</applet>';

					document.write(sApplet);
				</script>

				<div id="tx_ameosdragndropupload_logdiv"></div>

				<style type = 'text/css'>

					#tx_ameosdragndropupload_logdiv {
						height: 300px;
						width: 470px;
						overflow: auto;
					}

					#tx_ameosdragndropupload_logdiv .item {
						color: blue;
					}

					#tx_ameosdragndropupload_logdiv .notice {
						color: #909090;
						font-style: italic;
					}

					#tx_ameosdragndropupload_logdiv .skipping {
						color: red;
					}

					#tx_ameosdragndropupload_logdiv .completeok {
						color: green;
						font-weight: bold;
					}

					#tx_ameosdragndropupload_logdiv .completealmostok {
						color: orange;
						font-weight: bold;
					}

					#tx_ameosdragndropupload_logdiv .completefailed {
						color: red;
						font-weight: bold;
					}

				</style>
APPLET;
			
			return $sHtml;
		}
	}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ameos_dragndropupload/class.tx_ameosdragndropupload.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ameos_dragndropupload/class.tx_ameosdragndropupload.php']);
}
?>