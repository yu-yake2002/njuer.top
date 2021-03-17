var inits = 0;
var message_time2 = 0;
var noNewMessage = 0;
var Topics = Array("你在鼎里投稿过吗？",
    "这个周末打算怎么安排？",
    "曾经有什么遗憾，让你难忘？",
    "你是哪个专业的？",
    "冬天来了，你暖和吗？",
    "今天有什么快乐的事情吗？",
    "你对数码产品感兴趣吗？",
    "说说你最勇敢的一次经历。",
    "要不要一起来玩故事接龙？",
    "学校里你最喜欢的一个老师？",
    "你最喜欢的一门课是什么？",
    "你有过恋爱经历吗？",
    "你想要脱单吗？");

function loading_message(to_uid) {
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
                    if(noNewMessage >= 3){
                        s += "<div class='message_notice'>问一问ta:“"
                            + Topics[Math.floor(Math.random() * 13)] + "”</div>";
                        noNewMessage = -100;
                    }
                    if(s != "") {
                        if(noNewMessage > 0) {
                            noNewMessage = 0;
                        }
                        document.getElementById("message_list").innerHTML += s;
                    }else{
                        noNewMessage++;
                    }
                    if(message['message'].length !== 0) {
                        document.getElementById("scrollMessage").scrollTop = 9999999;
                    }
                    inits--;
                    prepare_loading_past_message(to_uid);
                }
            }
        };
        DataSender.open("GET",
            "index.php?mod=php_api&action=user_message&func=searchMessage&to_uid="
            + encodeURIComponent(to_uid.toString())
            + "&start=" + message_stop.toString()
            + "&init=" + inits.toString(), true);
        DataSender.send();
    }
}

function prepare_loading_past_message(to_uid) {
    if(inits < 0 && document.getElementById("scrollMessage").scrollTop === 0){
        loading_past_message(to_uid);
    }
    setTimeout(function () {
        prepare_loading_past_message(to_uid);
    }, 1000);
}

function loading_past_message(to_uid) {
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
            "index.php?mod=php_api&action=user_message&func=searchPastMessage&to_uid="
            + encodeURIComponent(to_uid.toString())
            + "&stop=" + message_start, true);
        DataSender.send();
    }
}

function post_message(to_uid) {
    var Message = document.getElementById("message").value;
    ws.send("send:" + Message);
}