plugin.tx_inaddthis_pi1{
  wrapPlugin.wrap = <ul id="tools">|</ul>
  
  order   = print,email,more
  services  = facebook,twitter,linkedin,digg,delicious
  
  print {
    file = {$filepaths.images}picto-print.gif
    stdWrap.typolink.wrap = <li>|</li>
  }
  
  email {
    file = {$filepaths.images}picto-mail.gif
    stdWrap.typolink.wrap = <li>|</li>
  }
  
  more {
    file = {$filepaths.images}picto-share.gif
    stdWrap.typolink.wrap = <li>|</li>
  }
  
  rss = IMAGE
  rss {
    file = {$filepaths.images}picto-rss.gif
    altText = RSS
    params = class="hover"
    stdWrap.typolink {
      wrap = <li>|</li>
      extTarget = _blank
      parameter = 1
      additionalParams = &type=100
      additionalParams.insertData = register:SWORD_PARAMS
    }
  } 
}