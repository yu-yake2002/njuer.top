<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 传承南大</title>
</head>
<body>
<?php include template("app/rankList_class:common_header"); ?>
<?php if(time() <= $_SETTINGS['open_time']['nju_docs1']){ ?>
<div style="text-align: center; margin-top: 100px">
    <img src="static/img/question.png?r=2475" style="max-width: 100%; max-height: 70%; min-height: 60%;">
    <h1>开甲书院答疑坊</h1>
    <h2>上线时间: 11.13 19:00</h2>
</div>
<?php }else{ ?>
<br>
<br>
<br>
<div style="padding: 24px">
<form method="post" action="index.php?mod=nju_docs&action=addThread<?php if(isset($_GET['tid'])){ ?>&tid=<?php echo isset($_GET['tid'])?($_GET['tid']):(""); ?><?php } ?>&fid=<?php echo isset($forum['cid'])?($forum['cid']):(""); ?>">
<table width="100%">
    <?php if(!isset($_GET['tid'])){ ?>
    <tr>
        <td>
            <input name="subject" class="nxb_input" placeholder="请输入标题">
        </td>
    </tr>
    <tr>
        <td>
            <textarea name="contents" rows="8" class="nxb_input" placeholder="请输入帖子内容"></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <select name="question" class="nxb_input" onchange="if(this.value == 1) $('#credits').show(); else{ $('#credits').hide(); }">
                <option value="2" selected>分享帖</option>
                <option value="1">问答帖</option>
            </select>
        </td>
    </tr>
    <tr id="credits" style="display: none;">
        <td>
            <input name="credits" class="nxb_input" placeholder="请输入悬赏积分">
        </td>
    </tr>
    <tr>
        <td>
            <select name="academy" class="nxb_input">
                <option value="1" selected>学术类</option>
                <option value="2">评课类</option>
                <option value="3">其他</option>
            </select>
        </td>
    </tr>
    <?php }else{ ?>
    <tr>
        <td>
            <textarea name="contents" rows="10" class="nxb_input" placeholder="请输入回答"></textarea>
        </td>
    </tr>
    <?php } ?>
</table>
<?php if($forum['close'] <= 0){ ?>
<div id="image">
    <div id="image_loading"></div>
    如果您要上传图片，可以点击“添加图片”选择图片后在正文中输入相应的插入代码，插入示例：“题目如图所示。{img1}大家可以帮我看一下吗？”
</div>
<div class="card2_btn" onclick="document.getElementById('file').click();">
    <p align="center">添加图片</p>
    <input type="file" id="file" hidden onchange="post_image2()">
</div>
    <input type="submit" id="submit" hidden>
<div class="card2_btn" onclick="document.getElementById('submit').click();">
    <?php if(!isset($_GET['tid'])){ ?>
    <p align="center">发布主题</p>
    <?php }else{ ?>
    <p align="center">提交回答</p>
    <?php } ?>
</div>
<?php } ?>
</form>
<?php } ?>
<br>
<br>
<br>
<br>
</div>
</body>
<script src="./static/js/common_post_image.js?r=2475"></script>
</html>