//-------------GESTION DU MOTEUR DE RECHERCHE
plugin.tx_indexedsearch {
  templateFile = {$filepaths.extensions}indexed_search/indexed_search.tmpl 
  config.language = fr
  show {
    rules = 0
    parsetimes = 0
    L2sections = 0
    L1sections = 1
    LxALLtypes = 0
    clearSearchBox = 0
    clearSearchBox.enableSubSearchCheckBox = 0
    forbiddenRecords = 0
    alwaysShowPageLinks = 0
    advancedSearchLink = 0
    resultNumber = 0
    mediaList =
  }
  _LOCAL_LANG = fr
  blind {
    type = 0
    defOp = 0
    sections = 0
    freeIndexUid = 1
    media = 0
    order = 1
    group = 1
    lang = 0
    desc = 0
    results = 0
    # defOp.1=1
    # extResume=1
  }
  search {
    rootPidList = {$indexed_search.rootPidList}
    page_links = 10
    detect_sys_domain_records = 0
    defaultFreeIndexUidList =
    skipExtendToSubpagesChecking = 0
    exactCount = 0
    targetPid.data = TSFE:id
    search.targetPid >
    search.targetPid = {$indexed_search.targetPid}
  }
  _DEFAULT_PI_VARS.lang = 0
}