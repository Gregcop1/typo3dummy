menu.default = HMENU
menu.default{
  special = directory
  special.value = 1
  1 = TMENU
  1{
    noBlur = 1
    wrap = <ul>|</ul>

    NO = 1
    NO{
        wrapItemAndSub = <li>|</li>|*|<li>|</li>
    }
    
    CUR < .NO
    CUR{
        wrapItemAndSub = <li class="active current">|</li>|*|<li class="active current">|</li>
    }
    
    ACT < .NO
    ACT{
        wrapItemAndSub = <li class="active">|</li>|*|<li class="active">|</li>
    }
  }
}