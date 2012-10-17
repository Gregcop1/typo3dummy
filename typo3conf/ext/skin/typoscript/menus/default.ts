menu.default = HMENU
menu.default{
  special = directory
  special.value = 1
  1 = TMENU
  1{
    noBlur = 1
    wrap = <ul>|</ul>
    NO{
      wrapItemAndSub = <li>|</li>|*|<li>|</li>
    }
    CUR = 1
    CUR{
        wrapItemAndSub = <li class="active current">|</li>|*|<li class="active current">|</li>
    }
    ACT = 1
    ACT{
        wrapItemAndSub = <li class="active">|</li>|*|<li class="active">|</li>
    }
  }
  2 < .1
  2.wrap = <ul class="second">|</ul>
}