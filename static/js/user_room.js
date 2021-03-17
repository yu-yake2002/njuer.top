var inits = 0;
var message_time2 = 0;

function loading_message(gid) {
    var DataSender=null;
    if (window.XMLHttpRequest)
    {
        DataSender=new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        DataSender=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (DataSender!=null)
    {
        DataSender.onreadystatechange=function (){
            if (DataSender.readyState === 4)
            {
                if (DataSender.status === 200)
                {
                    document.getElementById("message_list").scrollTop = 99999999999;
                    var message;
                    eval("message = " + DataSender.responseText);
                    var s = "";
                    for(var i = 0; i < message['message'].length; i++) {
                        message['message'][i]['itemid'] = Number(message['message'][i]['itemid']);
                        if(message['message'][i]['itemid'] > message_stop){
                            message_stop = message['message'][i]['itemid'];
                        }
                        if(message['message'][i]['itemid'] < message_start || message_start === 0){
                            message_start = message['message'][i]['itemid'];
                        }
                        if(message['message'][i]['time'] - message_time >= 300){
                            s += "<p align=\"center\" class=\"message_time\">" + message['message'][i]['time_s'] + "</p>";
                            message_time = message['message'][i]['time'];
                        }
                        if(message['message'][i]['item'] === "right") {
                            s += "<li class=\"Item Item--right\">" +
                                "<div class=\"Messages\">" +
                                "<div class=\"Message\">" +
                                "<div class=\"Message-inner\">";
                            s += message['message'][i]['text'];
                            s += "</div></div></div><div class=\"Avatar\">";
                            s += "<a href='index.php?mod=user&action=profile&uid= " + message['message'][i]['uid'] + " '>"
                            s += "<img src=\"" + message['message'][i]['avatar'] + "\" class=\"Avatar-image\" />";
                            s += "</a></div></li>";
                        }else{
                            s += "<li class=\"Item Item--left\">" +
                                "<div class=\"Avatar\">";
                            s += "<a href='index.php?mod=user&action=profile&uid= " + message['message'][i]['uid'] + " '>"
                            s += "<img src=\"" + message['message'][i]['avatar'] + "\" class=\"Avatar-image\" />";
                            s += "</a></div>" +
                                "<div class=\"Messages\">" +
                                "<div class=\"Message\">" +
                                "<div class=\"Message-inner\">";
                            s += message['message'][i]['text'];
                            s += "</div></div></div></li>";
                        }
                    }
                    document.getElementById("message_list").innerHTML += s;
                    if(message['message'].length !== 0) {
                        document.getElementById("scrollMessage").scrollTop = 9999999;
                    }
                    if(inits >= 0){
                        loading_message(gid);
                    }else{
                        loading_message(gid);
                    }
                    inits--;
                    if(inits < 0 && document.getElementById("scrollMessage").scrollTop === 0){
                        loading_past_message(gid);
                    }
                }
            }
        };
        DataSender.open("GET",
            "index.php?mod=php_api&action=user_room&func=searchMessage&gid="
            + encodeURIComponent(gid.toString())
            + "&start=" + message_stop.toString()
            + "&init=" + inits.toString(), true);
        DataSender.send();
    }
}

function loading_past_message(gid) {
    var DataSender=null;
    if (window.XMLHttpRequest)
    {
        DataSender=new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        DataSender=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (DataSender!=null)
    {
        DataSender.onreadystatechange=function (){
            if (DataSender.readyState === 4)
            {
                if (DataSender.status === 200)
                {
                    document.getElementById("message_list").scrollTop = 99999999999;
                    var message;
                    eval("message = " + DataSender.responseText);
                    var s = "";
                    for(var i = 0; i < message['message'].length; i++) {
                        if(Number(message['message'][i]['itemid']) < message_start || message_start === 0){
                            message_start = message['message'][i]['itemid'];
                        }
                        if(message_time2 - message['message'][i]['time'] >= 300 || message_time2 === 0){
                            s += "<p align=\"center\" class=\"message_time\">" + message['message'][i]['time_s'] + "</p>";
                            message_time2 = message['message'][i]['time'];
                        }
                        if(message['message'][i]['item'] === "right") {
                            s += "<li class=\"Item Item--right\">" +
                                "<div class=\"Messages\">" +
                                "<div class=\"Message\">" +
                                "<div class=\"Message-inner\">";
                            s += message['message'][i]['text'];
                            s += "</div></div></div><div class=\"Avatar\">";
                            s += "<a href='index.php?mod=user&action=profile&uid= " + message['message'][i]['uid'] + " '>"
                            s += "<img src=\"" + message['message'][i]['avatar'] + "\" class=\"Avatar-image\" />";
                            s += "</a></div></li>";
                        }else{
                            s += "<li class=\"Item Item--left\">" +
                                "<div class=\"Avatar\">";
                            s += "<a href='index.php?mod=user&action=profile&uid= " + message['message'][i]['uid'] + " '>"
                            s += "<img src=\"" + message['message'][i]['avatar'] + "\" class=\"Avatar-image\" />";
                            s += "</a></div>" +
                                "<div class=\"Messages\">" +
                                "<div class=\"Message\">" +
                                "<div class=\"Message-inner\">";
                            s += message['message'][i]['text'];
                            s += "</div></div></div></li>";
                        }
                    }
                    document.getElementById("message_list").innerHTML
                        = s + document.getElementById("message_list").innerHTML;
                    if(message['message'].length !== 0) {
                        document.getElementById("scrollMessage").scrollTop = 5;
                    }
                }
            }
        };
        DataSender.open("GET",
            "index.php?mod=php_api&action=user_room&func=searchPastMessage&gid="
            + encodeURIComponent(gid.toString())
            + "&stop=" + message_start, true);
        DataSender.send();
    }
}

function post_message(gid) {
    var DataSender=null;
    if (window.XMLHttpRequest)
    {
        DataSender=new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        DataSender=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (DataSender!=null)
    {
        DataSender.onreadystatechange=function (){
            if (DataSender.readyState === 4)
            {
                if (DataSender.status === 200)
                {
                    document.getElementById("message").value = "";
                    return true;
                }
            }
            return false;
        };
        DataSender.open("GET",
            "index.php?mod=php_api&action=user_room&func=sendMessage&text="
            + encodeURIComponent(document.getElementById("message").value)
            + "&gid=" + encodeURIComponent(gid), true);
        DataSender.send();
        return true;
    }else{
        return false;
    }
}