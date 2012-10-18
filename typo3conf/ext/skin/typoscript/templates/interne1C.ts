page {
  headerData.10.default < page.headerData.10.2
  10.default < page.10.2

  headerData.10.2 < template.interne1C
  headerData.10.2.workOnSubpart = DOCUMENT_HEADER
  10.2 =< template.interne1C

  bodyTagCObject{
    2 < .default
    2.value = interne1C
  }
}

temp.templateFile = EXT:skin/template/home.html

## gestion de la template
template.interne1C = TEMPLATE
template.interne1C {
  workOnSubpart = DOCUMENT_BODY

  template < plugin.tx_automaketemplate_pi1
  template.content.file < temp.templateFile

  ## création des markers
  template.elements {
    H1.id.logo = 1

    UL.id.mainNav     = 1

    DIV.id.sidebar    = 1
    DIV.id.centerColumn    = 1
  }

  subparts {
    mainNav < menu.main

    logo < lib.logo

    sidebar < lib.sidebarColumn
    centerColumn < lib.centerColumn
  }
}