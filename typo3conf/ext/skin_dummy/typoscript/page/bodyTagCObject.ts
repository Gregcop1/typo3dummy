page.bodyTagCObject < temp.templateName
page.bodyTagCObject{
    default = TEXT
    default{
        value = default
        noTrimWrap =  |<body class="| page-{page:uid} level-{level:uid}">|
        noTrimWrap.insertData = 1
    }
}