page {
  headerData.10.default < page.headerData.10.1
  10.default < page.10.1

  headerData.10.1 < template.home
  headerData.10.1.workOnSubpart = DOCUMENT_HEADER
  10.1 =< template.home

  bodyTagCObject{
    1 < .default
    1.value = home
  }
}

temp.templateFile = EXT:skin/template/home.html

## gestion de la template
template.home = TEMPLATE
template.home {
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