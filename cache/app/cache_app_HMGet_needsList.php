<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 需求空间</title>
    <?php if(isset($_GET['do']) && $_GET['do'] == "GetRequest"){ ?>
    <link rel="stylesheet" href="./template_app/css/HMGet_myRequest.css?r=4730">
    <?php } ?>
</head>
<body>
<?php if(isset($_GET['do']) && $_GET['do'] == "creditsLog"){ ?>
<?php include template("app/rankList_class:common_header"); ?>
<link rel="stylesheet" href="./template_app/css/HMGet.css?r=4730">
<div class="HMGet_content" id="CreditsLog">
</div>
<br>
<br>
<br>
<?php }else{ ?>
<?php include template("app/HMGet:common_header"); ?>
<div class="nav_row">
    <?php if(!isset($_GET['do'])){ ?>
    <a class="nav_btn_chosen_small" href="index.php?mod=HMGet&action=needsList&from=needsList&r=<?php echo rand(1,10000); ?> ">
        需求空间
    </a>
    <a class="nav_btn_small" href="index.php?mod=HMGet&action=needsList&from=needsList&do=GetRequest&r=<?php echo rand(1,10000); ?>">
        预约
    </a>
    <a class="nav_btn_small" href="index.php?mod=HMGet&action=needsList&from=needsList&do=help&r=<?php echo rand(1,10000); ?>">
        帮助
    </a>
    <?php }else{ ?>
    <a class="nav_btn_small" href="index.php?mod=HMGet&action=needsList&from=needsList&r=<?php echo rand(1,10000); ?>">
        需求空间
    </a>
    <a class="nav_btn<?php if($_GET['do'] == "GetRequest"){ ?>_chosen<?php } ?>_small" href="index.php?mod=HMGet&action=needsList&from=needsList&do=GetRequest">
        预约
    </a>
    <a class="nav_btn<?php if($_GET['do'] == "help"){ ?>_chosen<?php } ?>_small" href="index.php?mod=HMGet&action=needsList&from=needsList&do=help">
        帮助
    </a>
    <?php } ?>
    <a class="nav_btn<?php if(isset($_GET['do']) && $_GET['do'] == "creditsLog"){ ?>_chosen<?php } ?>_small" href="index.php?mod=HMGet&r=<?php echo rand(1,10000); ?>&action=needsList&from=needsList&do=creditsLog">
        积分: <font color="#ff7f50"><?php echo isset($_G['user']['credits']['credits'])?($_G['user']['credits']['credits']):(""); ?></font>　
        VIP:
        <?php if($_G['user']['credits']['vip'] >= time()){ ?>
        <font color="#ff7f50"> <?php echo floor(($_G['user']['credits']['vip'] - time()) / 86400); ?></font>天
        <?php }else{ ?>
        未开通
        <?php } ?>
    </a>
</div>
<br>
<br>
<?php if(!isset($_GET['do'])){ ?>
<h1 align="center" style="color: #793c65">筛 选</h1>
<table width="100%">
    <tr>
        <td align="right" width="50%">
            <select class="common_select" oninput="choose_from();" id="from">
                <option value="">不限</option>
                <option value="南门">南门</option>
                <option value="西门">西门</option>
                <option value="15栋">15栋</option>
                <option value="22栋">22栋</option>
                <option value="其他" id="from_other">其他</option>
            </select>
        </td>
        <td align="left">
            <b>→</b>
            <select class="common_select" oninput="choose_to();" id="to">
                <option value="">不限</option>
                <option value="1栋">1栋</option>
                <option value="2栋">2栋</option>
                <option value="3栋">3栋</option>
                <option value="4栋">4栋</option>
                <option value="5栋">5栋</option>
                <option value="6栋">6栋</option>
                <option value="9栋">9栋</option>
                <option value="其他" id="to_other">其他</option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" style="color: #999">
            <font color="#ff7f50"><?php echo isset($queue)?($queue):(""); ?></font>人已经在排队等待接单
        </td>
    </tr>
</table>
<hr size="1" color="#793c65" style="margin: 12px 12px 0 12px;">
<div class="HMGet_content" id="RequestList">
</div>
<?php }elseif($_GET['do'] == "creditsLog"){ ?>
<div class="HMGet_content" id="CreditsLog">
</div>
<?php }elseif($_GET['do'] == "credits"){ ?>
<button class="HMGet_btn" onclick="ask_for_credits(<?php echo isset($_G['user']['rest_confidence'])?($_G['user']['rest_confidence']):(""); ?>, <?php echo isset($_G['user']['credits_ask']['mobile'])?($_G['user']['credits_ask']['mobile']):(""); ?>);">求购积分</button>
<div class="HMGet_content" id="Credits">
</div>
<?php }elseif($_GET['do'] == "help"){ ?>
<h1 align="center" style="color: #793c65">帮 助</h1>
<div class="HMGet_content">
    <div class="HMGet_sub_content">
        Q: 积分如何变现？<br>
        A: 进入小宝商城，在“积分市场”中售出积分等待对方转账即可~<br><br>
        Q: 我消费的积分去了哪里？<br>
        A: 2分会被南小宝平台扣除作为手续费，剩余的积分会转给接单人。<br><br>
        Q: 我接单以后应该把快递送到哪里？<br>
        A: 如果无法联系上对方的话，送到对应的宿舍楼栋下拍照发给对方就可以啦~（您接单以后会得到对方的手机号，也可以和对方发起即时聊天）<br><br>
        如果您还有其他问题，欢迎加入南小宝app用户交流群咨询，QQ群号是195959801。
    </div>
</div>
<?php }elseif($_GET['do'] == "GetRequest"){ ?>
<div class="card front">
    <form class="form" autocomplete="off" novalidate method="post" action="index.php?mod=HMGet&action=needsList&from=needsList&do=GetRequest">
        <header>预约信息卡</header>
        <div class="pass">
            你希望有新需求以后自动接单吗？你只需要登记下表，当有人发起<font color="red">非大件</font>的需求时，如果符合您登记的条件，您就会进入接单队列(越早预约，优先级越高)，接下1单后你会回到队列末尾。<br>
            提示：如果接单以后超时送达并且被对方举报，您将被禁用预约功能7天。如果您的信用较好，您的最大接单量上限会提高。<br>
            <font color="red">注意 预约以后不可撤回！</font>
        </div>
        <?php if(!$getRequest){ ?>
        <fieldset>
            <label>取货地点:(*)</label>
            <select class="select" name="start">
                <option value="22栋" selected>22栋</option>
                <option value="15栋">15栋</option>
                <option value="南门">南门</option>
                <option value="西门">西门</option>
            </select>
        </fieldset>
        <fieldset>
            <label>送达地点:(*)</label>
            <select class="select" name="stop">
                <option value="1栋">1栋</option>
                <option value="2栋">2栋</option>
                <option value="3栋">3栋</option>
                <option value="4栋">4栋</option>
                <option value="5栋">5栋</option>
                <option value="1栋,2栋,3栋,4栋,5栋" selected>一组团</option>
                <option value="6栋">6栋</option>
                <option value="9栋">9栋</option>
                <option value="1栋,2栋,3栋,4栋,5栋,6栋,9栋">以上都可</option>
            </select>
        </fieldset>
        <fieldset>
            <label>预计送达:</label>
            <input type="time" class="input-cart-number" name="time">
        </fieldset>
        <div class="pass">
            说明:例如您本项选择7:00PM，则为您接送达时间在晚上7:00以后的需求。
        </div>
        <fieldset>
            <label>支付积分:</label>
            <select class="select" name="credits">
                <option value="5">5 积分及以上</option>
                <option value="10">10 积分及以上</option>
                <option value="15">15 积分及以上</option>
                <option value="20" selected>20 积分及以上</option>
                <option value="30">30 积分及以上</option>
                <option value="50">50 积分及以上</option>
            </select>
        </fieldset>
        <fieldset>
            <label>最大接单量:</label>
            <select class="select" name="num">
                <option value="1">1 件</option>
                <option value="2">2 件</option>
                <option value="3">3 件</option>
                <option value="4">4 件</option>
            </select>
        </fieldset>
        <?php }else{ ?>
        <fieldset>
            <label>取货地点:</label>
            <?php echo isset($getRequest['start'])?($getRequest['start']):(""); ?>
        </fieldset>
        <fieldset>
            <label>送达地点:</label>
            <?php echo isset($getRequest['stop'])?($getRequest['stop']):(""); ?>
        </fieldset>
        <fieldset>
            <label>预计送达:</label>
            <?php echo formatTime($getRequest['time']); ?>
        </fieldset>
        <fieldset>
            <label>支付积分:</label>
            <?php echo isset($getRequest['credits'])?($getRequest['credits']):(""); ?> 积分及以上
        </fieldset>
        <fieldset>
            <label>接单量:</label>
            <?php echo isset($getRequest['got_num'])?($getRequest['got_num']):(""); ?> / <?php echo isset($getRequest['num'])?($getRequest['num']):(""); ?>
        </fieldset>
        <?php } ?>
        <input type="submit" hidden id="submit_GetRequest">
    </form>
</div>
<?php if(!$getRequest){ ?>
<div class="button-cnt" onclick="document.getElementById('submit_GetRequest').click();">
    <button class="secondary-cta secondary-cta--send">预约代取</button>
</div>
<?php } ?>
<br>
<br>
<br>
<br>
<?php } ?>
<br>
<br>
<br>
<br>
<br>
<br>
<?php } ?>
</body>
<?php if(!isset($_GET['do'])){ ?>
<script src="static/js/HMGet_RequestList.js?r=4730"></script>
<script>
    var todo_start = "";
    var todo_end = "";
    function choose_from()
    {
        if(document.getElementById("from").value == "其他") {
            $.prompt({
                text: "请输入出发点，例如食堂",
                onOK: function (text) {
                    todo_start = text;
                    document.getElementById("from_other").innerText = text;
                    HMGet_RequestList("type=ToDo&todo_start=" + todo_start + "&todo_end=" + todo_end, true);
                }
            });
        }else{
            todo_start = document.getElementById("from").value;
            document.getElementById("from_other").innerText = "其他";
        }
        HMGet_RequestList("type=ToDo&todo_start=" + todo_start + "&todo_end=" + todo_end, true);
    }
    function choose_to()
    {
        if(document.getElementById("to").value == "其他") {
            $.prompt({
                text: "请输入收货点，例如仙二",
                onOK: function (text) {
                    todo_end = text;
                    document.getElementById("to_other").innerText = text;
                    HMGet_RequestList("type=ToDo&todo_start=" + todo_start + "&todo_end=" + todo_end, true);
                }
            });
        }else{
            todo_end = document.getElementById("to").value;
            document.getElementById("to_other").innerText = "其他";
        }
        HMGet_RequestList("type=ToDo&todo_start=" + todo_start + "&todo_end=" + todo_end, true);
    }
    HMGet_RequestList("type=ToDo&todo_start=" + todo_start + "&todo_end=" + todo_end, true);
</script>
<?php }elseif($_GET['do'] == "creditsLog"){ ?>
<script src="static/js/HMGet_CreditsLog.js?r=4730"></script>
<script>
    HMGet_CreditsLog("");
</script>
<?php }elseif($_GET['do'] == "credits"){ ?>
<script src="static/js/HMGet_Credits.js?r=4730"></script>
<script>
    HMGet_Credits("");
</script>
<?php } ?>
</html>