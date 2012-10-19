menu.bottom < menu.default
menu.bottom {
  special.value = {$menu.bottomID}
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