lib.logo         = IMAGE
lib.logo{
	file    = {$filepaths.images}header_logo.jpg
	altText = {$config.siteName}
    altText.insertData = 1
	stdWrap.typolink{
	  parameter = http://{$config.domain}/
	  extTarget  = _self
	}
}