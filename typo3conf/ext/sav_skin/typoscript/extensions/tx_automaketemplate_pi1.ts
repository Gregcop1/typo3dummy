# Configuring the Auto-Parser:
plugin.tx_automaketemplate_pi1 {
  content = FILE
  
  elements {
    BODY.all = 1
    BODY.all.subpartMarker = DOCUMENT_BODY

    HEAD.all = 1
    HEAD.all.subpartMarker = DOCUMENT_HEADER
    HEAD.rmTagSections = title
  }

  # Prefix all relative paths with this value:
  relPathPrefix = typo3conf/ext/skin/template/
}