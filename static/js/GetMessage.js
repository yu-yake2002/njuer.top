function GetMessage()
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
                    if (document.getElementById("messageBox").innerHTML
                        != MessageList.responseText) {
                        document.getElementById("messageBox").innerHTML
                            = MessageList.responseText;
                    }
                }
            }
        };
        MessageList.open("GET",
            "index.php?mod=php_api&action=user_message&func=messageList", true);
        MessageList.send();
        return true;
    }
}
