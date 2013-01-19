page {
  headerData.10.2 < template.interne1C
  headerData.10.2.workOnSubpart = DOCUMENT_HEADER
  10.2 =< template.interne1C

  bodyTagCObject{
    2 < .default
    2.value = interne1C
  }
}

temp.templateFile = EXT:skin/template/interne1C.html

## gestion de la template
template.interne1C = TEMPLATE
template.interne1C {
  workOnSubpart = DOCUMENT_BODY

  template < plugin.tx_automaketemplate_pi1
  template.content.file < temp.templateFile

  ## création des markers
  template.elements {
    H1.id.logo = 1

    UL.id.topNav     = 1
    UL.id.mainNav     = 1
    UL.id.bottomNav     = 1

    DIV.id.mainContent    = 1
  }

  subparts {
    logo < lib.logo
    mainContent < lib.centerColumn

    topNav  < menu.top
    mainNav < menu.main
    bottomNav  < menu.bottom
  }
}