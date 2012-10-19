plugin.tt_news {
  pid_list = {$tt_news.pid_list}
  singlePid = {$tt_news.singlePid}
  backPid = {$tt_news.backPid}
  useHRDates = 1
  useHRDatesSingle = 0
  substitutePagetitle = 1
  useSPidFromCategory = 1
  catExcludeList =
  catTextMode = 1
  maxCatTexts = 100
  templateFile = {$filepaths.extensions}tt_news/base.html
  general_stdWrap   >
  limit = 10
    
  pageBrowser {
    hscText = 0
    showFirstLast = 0
    showResultCount = 0
    dontLinkActivePage = 1
  }
  
  usePiBasePagebrowser = 0 

  displayLatest      {
    date_stdWrap.strftime= %m.%d.%G
  }

  _LOCAL_LANG.en {
    pi_list_browseresults_prev = &laquo;
    pi_list_browseresults_next = &raquo;
  }

  displayLatest {
    date_stdWrap.strftime= %m.%d.%G
  }

  displayList      {
    date_stdWrap.strftime = %m.%d.%G
    title_stdWrap.wrap = |
    subheader_stdWrap {
      stripHtml = 1
      wrap = |
      append >
    }
    imageWrapIfAny = |
    image {
      file.maxW >
      file.maxH >
      file.width = 470m
      file.height = 150m
      imageLinkWrap = 0
      stdWrap >
    }
  }

  displaySingle    {
    date_stdWrap.strftime = %m.%d.%G
    title_stdWrap.wrap = |
    subheader_stdWrap {
      stripHtml = 1
      wrap = |
    }
    prevLink_stdWrap.wrap = |
    nextLink_stdWrap.wrap = |
  }
  
  displayXML {
    rss2_tmplFile = EXT:tt_news/res/rss_2.tmpl
    xmlFormat = rss2
    xmlTitle = Flux RSS - {$config.siteName}
    xmlLink = http://{$config.domain}/
    xmlDesc = Latest news
    xmlLang = fr
    title_stdWrap.htmlSpecialChars = 1
    title_stdWrap.htmlSpecialChars.preserveEntities = 1
    subheader_stdWrap.stripHtml = 1
    subheader_stdWrap.htmlSpecialChars = 1
    subheader_stdWrap.htmlSpecialChars.preserveEntities = 1
    subheader_stdWrap.crop = 100 | ... | 1
    subheader_stdWrap.ifEmpty.field = bodytext
    xmlLastBuildDate = 1
 }
}

plugin.tt_news.mbl_newsevent {
  date_stdWrap.strftime = <span class="day">%d</span> <span class="month">%B</span>
  templateFile = {$filepaths.extensions}tt_news/int/events_display_date.tmpl
}

[treeLevel = 0]
plugin.tt_news.mbl_newsevent {
  date_stdWrap.strftime = <span class="day">%d</span> <span class="month">%B</span>
  templateFile = {$filepaths.extensions}tt_news/home/events_display_date.tmpl
}
[end]