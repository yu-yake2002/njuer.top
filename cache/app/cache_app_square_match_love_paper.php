<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 纸条</title>
    <link rel="stylesheet" href="./template_app/css/love_reg.css?r=9908">
    <link rel="stylesheet" href="./template_app/css/square_match_out.css?r=9908">
</head>
<body>
<?php include template("app/square:common_header"); ?>
<?php include template("app/square:match_love_common"); ?>
<h1 class="Reg_title">
    小纸条
</h1>
<div class="addOut_field">
    <textarea class="addOut_field_text2"
              id="text"
              placeholder="写下你想对TA说的话，根据活动流程，我们建议双方不要互换联系方式哦~"
              oninput="document.getElementById('text_words_').innerHTML=this.value.length;
                  document.getElementById('text_wordsCount_').style.display='block';"
              rows="8"></textarea>
    <span class="addOut_words_count" id="text_wordsCount_">
        <span id="text_words_">0</span>/500
    </span>
    <br>
    <br>
    <div class="post_submit" onclick="send_Paper();">
        发送纸条
    </div>
</div>
<?php while($paper = db_fetch($papers)){ ?>
    <p class="addOut_field">
        TA 在 <?php echo formatTime($paper['time']); ?> 对你说: <br>
        <?php $paper['msg'] = str_ireplace("\n", "<br>", $paper['msg']); ?>
        <?php echo isset($paper['msg'])?($paper['msg']):(""); ?>
    </p>
<?php } ?>
<br>
<br>
<br>
<br>
</body>
<script src="static/js/square_match_love_sendPaper.js?r=9908"></script>
</html>