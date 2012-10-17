#includeLibs.1 = fileadmin/crawltrack/class.user_functions.php

temp.templateName = CASE
temp.templateName{
  key.data = levelfield:-1, backend_layout_next_level, slide
  key.override.field = backend_layout
}

page = PAGE
page {
  typeNum = 0
  shortcutIcon = {$filepaths.images}favicon.ico
  
  # Définition d'une class pour le body
  bodyTagCObject < temp.templateName
  bodyTagCObject{
    default = TEXT
    default{
      value = default
      wrap =  <body class="|">
    }
  }

  # Définition de la template principale
  headerData.10 < temp.templateName
  10 < temp.templateName
}


[PIDinRootline = 55]
  page.bodyTagCObjec.default.wrap =  <body class="|">
[end]