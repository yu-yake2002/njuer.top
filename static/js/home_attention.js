function attention(obj, uid)
{
    var MessageList=null;
    if (window.XMLHttpRequest)
    {
        MessageList=new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        MessageList=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (MessageList!=null) {
        MessageList.onreadystatechange = function () {
            if (MessageList.readyState == 4) {
                if (MessageList.status == 200) {
                    obj.src="static/img/2021/" + MessageList.responseText + ".png";
                }
            }
        };
        MessageList.open("GET",
            "index.php?mod=php_api&action=user_profile&func=attention&uid=" + uid.toString(), true);
        MessageList.send();
        return true;
    }
}
