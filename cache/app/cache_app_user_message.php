<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 聊天界面</title>
    <link rel="stylesheet" href="./template_app/css/user_message.css?r=4785">
    <script>
        var message_start = 0;
        var message_stop = 0;
        var message_time = 0;
    </script>
</head>
<body>
<div class="header_list" onclick="history.back();">
    返回
    <span style="float:right;">与 <?php echo isset($to_user['name'])?($to_user['name']):(""); ?> 私聊中</span>
</div>
<div class="message_list" id="scrollMessage">
    <ul class="List" id="message_list">
    </ul>
</div>
<div id="image" style="position: fixed; bottom: 44px; right: 12px; max-width: 80px; max-height: 80px;"></div>
<div class="post_message_box">
    <input type="text" class="post_message_input" id="message">
    <input type="file" id="file" hidden onchange="post_msg_image(<?php echo isset($to_user['uid'])?($to_user['uid']):(""); ?>);">
    <input type="submit" class="post_message_img" value="图" onclick="document.getElementById('file').click();">
    <input type="submit" class="post_message_btn" value="发送" onclick="post_message(<?php echo isset($to_user['uid'])?($to_user['uid']):(""); ?>);">
</div>
</body>
<script src="static/js/common_post_image.js?r=4785"></script>
<script src="static/js/user_message.js?r=4785"></script>
<script>
    var ws;
    var lockReconnect = false;
    var lockConnect = 0;
    function createWebSocket(){
        lockConnect++;
        if(lockConnect >= 5){
            $.alert({text: "连接失败", onOK: function(){
		        lockConnect = 0;
                ws = new WebSocket("wss://chat.njuer.top");
                ws.binaryType='arraybuffer';
                websocketInit();
	        }});
        }else {
            ws = new WebSocket("wss://chat.njuer.top");
            websocketInit();
        }
    }

    function websocketInit () {
        // 建立 web socket 连接成功触发事件
        ws.onopen = function (evt) {
            onOpen(evt);
        };
        // 断开 web socket 连接成功触发事件
        ws.onclose = function (evt) {
            websocketReconnect("wss://chat.njuer.top");
        };
        // 接收服务端数据时触发事件
        ws.onmessage = function (evt) {
            onMessage(evt);
        };
        // 通信发生错误时触发
        ws.onerror = function (evt) {
            websocketReconnect("wss://chat.njuer.top");
        };
    };

    function onOpen(evt) {
        ws.send("<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>,<?php echo isset($to_user['uid'])?($to_user['uid']):(""); ?>,<?php echo isset($token)?($token):(""); ?>");
        heartCheck.start();
    }

    function onMessage(data) {
        heartCheck.start();
        if(data.data.substr(1, 10) == "Msg: send:") {
            var getData = data.data.substr(11, data.data.length - 11);
            var timestamp = (new Date()).valueOf();
            var s = "";
            if(data.data.substr(0, 1) == "1"){
                document.getElementById("message").value = "";
                s += "<li class=\"Item Item--right\">" +
                    "<div class=\"Messages\">" +
                    "<div class=\"Message\">" +
                    "<div class=\"Message-inner\">";
                s += getData;
                s += "</div></div></div><div class=\"Avatar\">";
                s += "<a href='index.php?mod=user&action=profile&uid=<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>'>";
                s += "<img src=\"<?php echo isset($_G['user']['profile']['avatar'])?($_G['user']['profile']['avatar']):(""); ?>\" class=\"Avatar-image\" />";
                s += "</a></div></li>";
            }
            if(data.data.substr(0, 1) == "0"){
                s += "<li class=\"Item Item--left\">" +
                    "<div class=\"Avatar\">";
                s += "<a href='index.php?mod=user&action=profile&uid=<?php echo isset($to_user['uid'])?($to_user['uid']):(""); ?>'>";
                s += "<img src=\"<?php echo isset($to_user['avatar'])?($to_user['avatar']):(""); ?>\" class=\"Avatar-image\" />";
                s += "</a></div>" +
                    "<div class=\"Messages\">" +
                    "<div class=\"Message\">" +
                    "<div class=\"Message-inner\">";
                s += getData;
                s += "</div></div></div></li>";
            }
            document.getElementById("message_list").innerHTML += s;
            document.getElementById("scrollMessage").scrollTop = 9999999;
        }else{
            console.log(data.data);
        }
    }

    function websocketReconnect(url) {
        if (lockReconnect) {       // 是否已经执行重连
            return;
        };
        lockReconnect = true;

        createWebSocket(url);
        setTimeout(function () {
            lockReconnect = false;
        }, 1000);
    }

    var heartCheck = {
        timeout: 30000,
        timeoutObj: null,
        serverTimeoutObj: null,
        start: function () {
            var self = this;
            this.timeoutObj && clearTimeout(this.timeoutObj);
            this.serverTimeoutObj && clearTimeout(this.serverTimeoutObj);
            this.timeoutObj = setTimeout(function () {
                ws.send("1");
                self.serverTimeoutObj = setTimeout(function () {
                    ws.close();
                }, self.timeout);
            }, this.timeout);
        }
    }

    createWebSocket();
    loading_message(<?php echo isset($to_user['uid'])?($to_user['uid']):(""); ?>);
</script>
<?php if(isset($add_chance)){ ?>
<script>
    $.alert("聊天功能的彩蛋砸中了你！恭喜您获得了<?php echo isset($add_chance)?($add_chance):(""); ?>次额外的积分抽奖机会！");
</script>
<?php } ?>
</html>