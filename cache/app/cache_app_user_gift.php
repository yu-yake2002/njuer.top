<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>南小宝 - <?php echo isset($user['common']['name'])?($user['common']['name']):("var[user['common']['name']]"); ?>发起了抽奖</title>
    <link href="https://cdn.bootcss.com/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link href="template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/home.css?r=8001" rel="stylesheet" />
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
</head>
<body>

<div class="gallery-section">
    <div class="home-cover" id="home-cover" onclick="this.style.display='none';">
        <div class="home-cover-inner">
            <table style="margin: auto; text-align: center">
                <tr>
                    <td>
                        <div class="round_icon">
                            <img src="static/img/2021/gift.jpg" width="100" height="100">
                        </div>
                    </td>
                </tr>
            </table>
            <br>
            <div>
                <h1><?php echo isset($gift['title'])?($gift['title']):(""); ?></h1>
            </div>
            <h3 align="center">由<?php echo isset($user['name'])?($user['name']):(""); ?>发起</h3>
        </div>
    </div>
    <div class="inner-width2">
        <table style="margin: auto; text-align: center">
            <tr>
                <td rowspan="2">
                    <a href="javascript:;" onclick="document.getElementById('file').click();">
                        <div class="round_icon">
                            <img src="static/img/2021/gift.jpg" width="100" height="100" id="avatar">
                        </div>
                    </a>
                    <!--<?php if($_G['user']['uid'] == $user['common']['uid']){ ?>-->
                    <input type="file" id="file" hidden onchange="post_avatar()">
                    <!--<?php } ?>-->
                </td>
                <td>
                    <h1><?php echo isset($gift['title'])?($gift['title']):(""); ?></h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h3 align="center"><?php echo isset($gift['gift_persons'])?($gift['gift_persons']):(""); ?>人参与</h3>
                </td>
            </tr>
        </table>

        <br>
        <br>
        <div style="text-align: center" id="gift_info">
            <input type="text" class="home-input" placeholder="请输入抽奖密码" id="gift_pwd" <?php if($gift['pwd'] == ""){ ?>hidden<?php } ?>><br>
            <img src="static/img/2021/gift_btn.png" width="100" style="border-radius: 50%; box-shadow: 0 0 4px black;" onclick="readpwd();">
        </div>
        <br>
        <br>
        <div class="home_profile">
            <h4>抽奖规则</h4>
            <hr size="1">
            <?php if($gift['type'] == 1){ ?>
            1. 活动的奖品是<?php if($gift['isCredits']){ ?><?php echo isset($gift['giftlimit'])?($gift['giftlimit']):(""); ?>积分<?php }else{ ?><?php echo isset($gift['title'])?($gift['title']):(""); ?> * <?php echo isset($gift['giftlimit'])?($gift['giftlimit']):(""); ?><?php } ?>，参与抽奖之后你可以以类似微信抢红包的形式获得一定量的<?php echo isset($gift['title'])?($gift['title']):(""); ?>。<br>
            2. 您<?php if($gift['pwd'] != ""){ ?>输入抽奖密码以后<?php } ?>点击抽奖按钮即可参与抽奖<?php if(!$gift['isCredits']){ ?>，我们默认您和抽奖发起者能够取得联系<?php } ?>。<br>
            3. 抽奖时间截至<?php echo formatTime($gift['timelimit']); ?>，<?php echo isset($gift['personlimit'])?($gift['personlimit']):(""); ?>人次可以参加抽奖。<br>
            4. <?php echo isset($gift['intro'])?($gift['intro']):(""); ?><br>
            5. 本活动最终解释权归 <?php echo isset($user['name'])?($user['name']):(""); ?> 所有。
            <?php }elseif($gift['type'] == 2){ ?>
            1. 活动的奖品是<?php echo isset($gift['title'])?($gift['title']):(""); ?>，最终<?php echo isset($gift['giftlimit'])?($gift['giftlimit']):(""); ?>人可以获奖。<br>
            2. 你输入抽奖密码以后点击抽奖按钮即可参与抽奖，我们默认您和抽奖发起者能够取得联系。<br>
            3. 抽奖时间截至<?php echo formatTime($gift['timelimit']); ?>，<?php echo isset($gift['personlimit'])?($gift['personlimit']):(""); ?>人可以参加抽奖；满足条件后抽奖系统将自动开奖。<br>
            4. <?php echo isset($gift['intro'])?($gift['intro']):(""); ?><br>
            5. 本活动最终解释权归 南小宝用户<?php echo isset($user['name'])?($user['name']):(""); ?> 所有。
            <?php }elseif($gift['type'] == 3){ ?>
            1. 活动的奖品是<?php echo isset($gift['title'])?($gift['title']):(""); ?>，最终<?php echo isset($gift['giftlimit'])?($gift['giftlimit']):(""); ?>人可以获奖。<br>
            2. 你输入抽奖密码以后点击抽奖按钮即可参与抽奖，我们默认您和抽奖发起者能够取得联系。<br>
            3. 抽奖时间截至<?php echo formatTime($gift['timelimit']); ?>，<?php echo isset($gift['personlimit'])?($gift['personlimit']):(""); ?>人可以参加抽奖。<br>
            4. 抽奖发起者可以随时开奖。<br>
            5. <?php echo isset($gift['intro'])?($gift['intro']):(""); ?><br>
            6. 本活动最终解释权归 南小宝用户<?php echo isset($user['name'])?($user['name']):(""); ?> 所有。
            <?php }elseif($gift['type'] == 4){ ?>
            1. 活动的奖品是<?php echo isset($gift['title'])?($gift['title']):(""); ?> * <?php echo isset($gift['giftlimit'])?($gift['giftlimit']):(""); ?>，每个人有<?php echo isset($gift['probability'])?($gift['probability']):(""); ?>%的概率中奖。<br>
            2. 你输入抽奖密码以后点击抽奖按钮即可参与抽奖，我们默认您和抽奖发起者能够取得联系。<br>
            3. 抽奖时间截至<?php echo formatTime($gift['timelimit']); ?>，<?php echo isset($gift['personlimit'])?($gift['personlimit']):(""); ?>人可以参加抽奖。<br>
            4. 活动奖品数量有限，抽完即止。<br>
            5. <?php echo isset($gift['intro'])?($gift['intro']):(""); ?><br>
            6. 本活动最终解释权归 南小宝用户<?php echo isset($user['name'])?($user['name']):(""); ?> 所有。
            <?php } ?>
        </div>
        <br>
        <br>
        <?php if($gift['type'] == 1){ ?>
        <div class="home_profile">
            <h4>抽奖记录</h4>
            <hr size="1">
            大家已经瓜分<?php echo isset($gift['gift_got'])?($gift['gift_got']):(""); ?>积分，目前获得积分最多的是：<br>
            <?php while($luck = db_fetch($lucky)){ ?>
                用户<?php echo isset($luck['uid'])?($luck['uid']):(""); ?>获得<?php echo isset($luck['get_gift'])?($luck['get_gift']):(""); ?>积分。<br>
            <?php } ?>
        </div>
        <?php } ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>
</body>
<script>
    setTimeout(function () {
        document.getElementById("home-cover").style.display = "none";
    }, 2000);
    function readpwd()
    {
        var pwd = document.getElementById("gift_pwd").value;
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
                        if(MessageList.responseText != "") {
                            document.getElementById("gift_info").innerHTML
                                = MessageList.responseText;
                        }
                    }
                }
            };
            MessageList.open("GET",
                "index.php?mod=php_api&action=gift&func=read_pwd&giftid=<?php echo isset($gift['giftid'])?($gift['giftid']):(""); ?>&pwd=" + pwd, true);
            MessageList.send();
            return true;
        }
    }
</script>
</html>
