tt_content.clickToPlay = COA
tt_content.clickToPlay {
	1 = HEADERDATA
	1.value (
		<script type="text/javascript" src="typo3conf/ext/skinFlex/clickToPlay/res/clickToPlay.js"></script>
		<link rel="stylesheet" type="text/css" href="typo3conf/ext/skinFlex/clickToPlay/res/style.css" media="all">
	)

	5 = < lib.stdheader

	10 = COA
	10 {
		wrap = <div class="clickToPlayBloc">|</div>

		10 = IMAGE
		10{
			file.import.data = t3datastructure : pi_flexform->file
			file.import.wrap = uploads/skinFlex/clickToPlay/
			#file.maxW = 565m
			#file.maxH = 330m
		}
		
		20 = COA
		20 {
			5 = HTML
			5.value = <div class="infos">

			10 = TEXT
			10{
				data = t3datastructure : pi_flexform->title
				wrap = <h3>|</h3>
			}
			
			20 = TEXT
			20{
				data = t3datastructure : pi_flexform->desc
				wrap = <p class="description">|</p>
				br = 1
			}

			30 = TEXT
			30{
				data = LLL:EXT:skinFlex/clickToPlay/locallang.xml:tt_content.clickToPlay.btnLabel
				stdWrap.typolink{
					parameter = javascript:;
					ATagParams = class="play"
				}
				wrap = <p>|</p>
			}

			35 = HTML
			35.value = </div>
		}
		

		30 = TEXT
		30{
			data = t3datastructure : pi_flexform->video
			wrap = <iframe class="player" width="100%" height="100%" future_src="|?autoplay=1" frameborder="0" allowfullscreen></iframe>

			stdWrap.replacement {
			    10 {
			      search = watch?v=
			      replace = embed/
			    }
			  }
			}
		}
	}
}
