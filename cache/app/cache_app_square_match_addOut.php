<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 出游有约</title>
</head>
<body>
<?php include template("app/square:common_header"); ?>
<link rel="stylesheet" href="./template_app/css/square_match_out.css?r=7708">
<div class="nav_row">
    <a href="index.php?mod=square&action=match&do=out"
       class="nav_btn">
        组队空间
    </a>
    <a href="index.php?mod=square&action=match&do=addOut"
       class="nav_btn_chosen">
        发起组队
    </a>
</div>
<br>
<br>

<form action="index.php?mod=square&action=match&do=addOut" method="POST">
    <h1 class="addOut_title">
        队伍信息
    </h1>
    <div class="addOut_field">
        <div class="addOut_field_label">队名</div>
        <input type="text" class="addOut_field_input" name="name" placeholder="给你的小队起个好听的名字！" id="name">
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">人数限制</div>
        <input type="text" class="addOut_field_input" name="people_limit" placeholder="请输入允许组队的人数" id="people_limit">
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">简介</div>
        <textarea class="addOut_field_text"
                  name="contents"
                  id="contents"
                  placeholder="简单概括组队活动的时间、地点和具体内容以及集合地点和时间"
                  oninput="
                  document.getElementById('text_words').innerHTML=this.value.length;
                  document.getElementById('text_wordsCount').style.display='block';"
                  rows="5"></textarea>
        <span class="addOut_words_count" id="text_wordsCount">
            <span id="text_words">0</span>/100
        </span>
    </div>
    <h1 class="addOut_title">
        发起人信息
    </h1>
    <p class="addOut_field">
        　　以下信息（除联系方式）将被公开展示给其他想组队的同学，如果您不愿意透露，均可以填保密，但那样会影响您的组队成功率。<br>
        　　您的联系方式只有在对方加入组队以后才可以看到。
    </p>
    <div class="addOut_field">
        <div class="addOut_field_label">基本信息</div>
        <input type="text" class="addOut_field_input" name="uname"
               placeholder="格式示例：20硕 AI 张三，保密可不填">
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">性别</div>
        <select class="addOut_field_input" name="sex">
            <option value="1">男</option>
            <option value="2">女</option>
            <option value="3">男(跨性别)</option>
            <option value="4">女(跨性别)</option>
            <option value="5" selected>保密</option>
        </select>
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">性取向</div>
        <select class="addOut_field_input" name="sexo">
            <option value="1">男</option>
            <option value="2">女</option>
            <option value="3" selected>保密</option>
        </select>
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">联系方式</div>
        <input type="text" class="addOut_field_input" name="mobile" id="mobile"
               placeholder="请输入您的QQ号">
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">个人简介</div>
        <textarea class="addOut_field_text"
                  name="others"
                  placeholder="简单介绍一下你自己"
                  oninput="document.getElementById('text_words_').innerHTML=this.value.length;
                  document.getElementById('text_wordsCount_').style.display='block';"
                  rows="5"></textarea>
        <span class="addOut_words_count" id="text_wordsCount_">
            <span id="text_words_">0</span>/100
        </span>
    </div>
    <div class="addOut_submit" onclick="submit_matchOut();">
        发起组队
    </div>
    <input type="submit" hidden id="submit_match_out">
</form>
<br>
<br>
<br>
<br>
<br>
</body>
<script>
    function submit_matchOut() {
        if(document.getElementById("name").value === ""){
            $.alert("请填写队名！");
        }else if(document.getElementById("people_limit").value === ""){
            $.alert("请填写人数限制！");
        }else if(!/^\d+$/.test(document.getElementById("people_limit").value)){
            $.alert("人数限制请输入纯数字，不要带有空格或者中英文字符");
        }else if(document.getElementById("contents").value === ""){
            $.alert("请填写队伍简介！");
        }else if(document.getElementById("mobile").value === ""){
            $.alert("请填写您的联系方式！");
        }else {
            document.getElementById("submit_match_out").click();
        }
        return 0;
    }
</script>
</html>