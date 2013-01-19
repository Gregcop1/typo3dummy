menu.top < menu.default
menu.top {
  special.value = {$menu.topID}
  special.value.insertData = 1
  1 {
    wrap = |

    NO {
      ATagParams = class="menu{field:uid}"
      ATagParams.insertData = 1
    }
    CUR < .NO
    ACT < .NO
  }
}