tt_content.imageLegend = COA
tt_content.imageLegend {
	1 = HEADERDATA
	1.value (
		<link rel="stylesheet" type="text/css" href="typo3conf/ext/skinFlex/imageLegend/res/style.css" media="all">
	)

	5 = < lib.stdheader

	10 = COA
	10 {
		wrap = <div class="imageLegend">|</div>

		10 = IMAGE
		10{
			file.import.data = t3datastructure : pi_flexform->file
			file.import.wrap = uploads/skinFlex/imageLegend/
		}

		20 = TEXT
		20{
			data = t3datastructure : pi_flexform->title
			wrap = <p>|</p>
		}
	}
}
