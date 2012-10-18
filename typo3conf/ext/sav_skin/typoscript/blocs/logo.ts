lib.logo         = IMAGE
lib.logo{
	file    = {$filepaths.images}header_logo.jpg
	altText = Entreprises et communication
	stdWrap.typolink{
	  parameter = http://{$config.domain}/
	  extTarget  = _self
	}
}