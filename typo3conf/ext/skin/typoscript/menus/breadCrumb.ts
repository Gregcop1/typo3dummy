menu.breadCrumb = COA
menu.breadCrumb {
    wrap = <ul class="breadCrumb">|</ul>

    10 = TEXT
    10 {
        data = LLL:EXT:skin/locallang.xml:breadcrumb.home
        typolink.parameter = {$config.homeID}
        wrap = <li>|</li>
    }

    20 = TEXT
    20 {
        data = LLL:EXT:skin/locallang.xml:breadcrumb.separator
        required = 1
    }

    30  < menu.default
    30 {
        special = rootline
        special.range = 1|4

        1 {
            wrap = |
            NO = 1
            NO{
                wrapItemAndSub = <li>|</li>{LLL:EXT:skin/locallang.xml:breadcrumb.separator}|*|<li>|</li>
                wrapItemAndSub.insertData = 1
            }
            CUR >
            ACT >
        }        
    }
}