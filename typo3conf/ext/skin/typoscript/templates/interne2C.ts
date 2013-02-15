page {
  headerData.10.3 < template.interne1C
  headerData.10.3.workOnSubpart = DOCUMENT_HEADER
  10.3 =< template.interne1C

  bodyTagCObject{
    3 < .default
    3.value = interne2C
  }
}

temp.templateFile = EXT:skin/template/interne1C.html

## gestion de la template
template.interne2C = TEMPLATE
template.interne2C {
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