lib.centerColumn = COA

lib.centerColumn.10 =< menu.main

lib.centerColumn.20 < lib.defaultColumn 

[page|doktype = 150]
lib.centerColumn {
	30 = COA
	30 {
		10 = TEXT
		10 {
			value = <span class="test4u">{LLL:EXT:skin/locallang.xml:blog.test4u}</span> {page:title}
			insertData = 1
			wrap = <h2 class="entry-title">|</h2>
		}

		wrap = <div id="postSingle"><div class="post category-1">|</div></div>
	}
	30.30 < .20
	20 >

	
}
[end]