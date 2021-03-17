<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 解忧杂货店</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/square_match_out.css?r=3553">
    <style>
        .btn_item_sendmail{
            box-shadow: black 0 0 5px 0;
            margin: 24px 12px;
            padding: 12px;
            display: inline-block;
            background: #da0062 url('/static/img/pigeon.jpeg');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: calc(240%);
            height: 128px;
            width: calc(50% - 48px);
            white-space: normal;
            border-radius: 12px;
        }
        .btn_item_mailbox{
            box-shadow: black 0 0 5px 0;
            margin: 24px 12px;
            padding: 12px;
            display: inline-block;
            background: #da0062 url('/static/img/mailbox.jpg');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: calc(200%);
            height: 128px;
            width: calc(50% - 48px);
            white-space: normal;
            border-radius: 12px;
        }
        .btn_title_sendmail{
            line-height: 128px;
            word-spacing: 16px;
            text-align: center;
            color: white;
            text-shadow: #0d0d0d 2px 2px 4px;
        }
    </style>
</head>
<body>
<?php include template("app/square:common_header"); ?>
<?php include template("app/square:match_mail_common"); ?>

<div class="btn_list_todo">
    <div class="btn_item_sendmail"
         onclick="document.getElementById('sendMail').style.display = 'block';document.getElementById('getMail').style.display = 'none';">
        <h1 class="btn_title_sendmail">发 信</h1>
    </div>
    <div class="btn_item_mailbox"
         onclick="document.getElementById('sendMail').style.display = 'none';getMail();">
        <h1 class="btn_title_sendmail">取 信</h1>
    </div>
</div>
<?php if($_G['user']['new_mail'] > 0){ ?>
<a href="index.php?mod=square&action=match&do=mail&step=myBox&r=<?php echo rand(1,50); ?>">
    <p class="message_list" align="center" style="background-color: #f7f7fa">
        <font color="#808080">您有 <font color="#ff7f50"><?php echo isset($_G['user']['new_mail'])?($_G['user']['new_mail']):(""); ?></font> 封未读邮件，点击进入收件箱</font>
    </p>
</a>
<?php } ?>
<div id="getMail" style="display: none">
    <?php if($to_reply = db_fetch(db_query("SELECT lid FROM activity_mail_received WHERE replied = 0 AND type = 1 AND uid = ".$_G['user']['uid']))){ ?>
    <div id="getMail_Success">
        <a href="index.php?mod=square&action=match&do=mail&step=letter&id=<?php echo isset($to_reply['lid'])?($to_reply['lid']):(""); ?>&r=<?php echo rand(1,50); ?>">
            <p class="message_list" align="center" style="background-color: #f7f7fa">
                <font color="#808080">您有未回复的已取邮件，请回复后再尝试取件</font>
            </p>
        </a>
    </div>
    <?php }else{ ?>
    <div id="getMail_Success" class="card2">loading...</div>
    <?php } ?>
    <?php if($_G['user']['profile']['gender'] == 0){ ?>
    <div class="card2" onclick="location.href='index.php?mod=user&action=profile&uid=<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>';">设置性别可以收到更多邮件哦</div>
    <?php } ?>
</div>
<form action="index.php?mod=square&action=match&do=mail&step=box" method="post">
<div id="sendMail" style="display: none">
    <table width="100%">
        <tr>
            <td colspan="2">
                <input name="title" class="nxb_input" placeholder="请输入标题">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <textarea name="contents" rows="7" class="nxb_input" placeholder="请输入信件内容"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id="image" class="card2">
                    如果您要上传图片，可以点击“添加图片”选择图片后在正文中输入相应的插入代码，插入示例：“最近拍了一些猫的照片。{img31}这是数分。{img32}这是浩哥。”
                    <div class="card2_btn" onclick="document.getElementById('file').click();">
                        <p align="center">添加图片</p>
                        <input type="file" id="file" hidden onchange="post_image2()">
                    </div>
                    <div id="image_loading"></div>
                </div>
                <input type="submit" id="submit" hidden><br>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <select name="allowShared" class="nxb_input">
                    <option value="0">设为私密，禁止收件人分享</option>
                    <option value="1" selected>允许被分享</option>
                </select><br>
                收件人要求
            </td>
        </tr>
        <tr>
            <td>
                <select name="gender" class="nxb_input">
                    <option value="0" selected>男女均可</option>
                    <option value="1">女</option>
                    <option value="2">男</option>
                </select>
            </td>
            <td>
                <input name="plimit" class="nxb_input" placeholder="最多收件人数，填数字">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="addOut_field_label">年级</span>
                <span class="addOut_field_option" onclick="Grade_choice(this, 1)">20级</span>
                <span class="addOut_field_option" onclick="Grade_choice(this, 2)">19级</span>
                <span class="addOut_field_option" onclick="Grade_choice(this, 3)">18级</span>
                <span class="addOut_field_option" onclick="Grade_choice(this, 4)">17级</span>
                <span class="addOut_field_option" onclick="Grade_choice(this, 5)">17级以上</span>
                <input hidden name="grade1" id="grade1" value="0">
                <input hidden name="grade2" id="grade2" value="0">
                <input hidden name="grade3" id="grade3" value="0">
                <input hidden name="grade4" id="grade4" value="0">
                <input hidden name="grade5" id="grade5" value="0">
            </td>
        </tr>
    </table>
    <div class="card2_btn" onclick="document.getElementById('submit').click();">
        <p align="center">发送信件</p>
    </div>
</div>
</form>
<?php if(!$inbox){ ?>
<div class="card3 card2_comments">
    <h3 align="center">活动：杂货店里那些打动你的文字</h3>
    <p>
        要问南小宝为什么要办这样的活动，原因就是：小宝这几天取了很多的信，发现太多文采飞扬的信只能我一个人独享，简直是暴！殄！天！物！而且，小宝写了不少超级暖的回信，也真的真的真的很想分享给大家看一看~
    </p>
    <p>
        于是这个活动就来啦！你只要往下一滑，就可以看到大家分享的各种信件，你还可以每天领取3票，把票投给那些最打动你的文字！
    </p>
    <p>
        解忧杂货店会从票数高的信件中选出5个顾客瓜分5份奖品！这些奖品是：Freebuds妙享版、零食大礼包+奶茶、精美笔记本+笔、(南小猫玩偶+绿植)*2。
        具体的获奖攻略见我们马上推出的推送！（如果你还没关注我们的公众号，我是不会告诉你公众号名称是“NJU南小宝”的，哼(￢︿̫̿￢☆)
    </p>
    <a href="index.php?mod=square&action=match&do=mail&step=box&inbox=1">
        <div class="card2_btn">收入信箱</div>
    </a>
</div>
<?php } ?>
<?php while($open = db_fetch($open_letter)){ ?>
    <?php $abstract = db_fetch(db_query("SELECT abstract FROM activity_mail_received WHERE lid=".$open['letterid']))['abstract']; ?>
    <div class="card3" onclick="location.href='index.php?mod=square&action=match&do=mail&step=letter&id=<?php echo isset($open['letterid'])?($open['letterid']):(""); ?>';">
        <h2 class="card2_title"><?php echo isset($open['title'])?($open['title']):(""); ?></h2>
        <p class="card2_contents">发信人: <?php echo mail_show_uid($open['uid']); ?> | <strong><?php echo isset($open['vote1'])?($open['vote1']):(""); ?></strong>人推荐</p>
        <p class="card2_contents"><?php echo isset($abstract)?($abstract):(""); ?></p>
        <div class="card2_btn">查看详情</div>
    </div>
<?php } ?>
<br>
<br>
<br>
<br>
</body>
<script src="static/js/getMail.js"></script>
<script src="static/js/square_match_mail_box.js?r=3553"></script>
<script src="./static/js/common_post_image.js?r=3553"></script>
</html>