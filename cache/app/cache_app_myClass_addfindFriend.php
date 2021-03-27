<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 发起会友</title>
</head>
<body>
<?php include template("app/square:common_header"); ?>
<link rel="stylesheet" href="./template_app/css/square_match_out.css?r=1494">
<div class="nav_row">
    <a href="index.php?mod=user&action=profile&uid=<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>">
        <img src="<?php echo isset($_G['user']['profile']['avatar'])?($_G['user']['profile']['avatar']):(""); ?>" class="avatar_small">
    </a>
    <a href="index.php?mod=myClass&action=findFriend" class="nav_btn">
        会友广场
    </a>
    <a href="index.php?mod=myClass&action=addFindFriend" class="nav_btn_chosen">
        发起会友
    </a>
    <a href="index.php?mod=myClass&action=myFindFriend" class="nav_btn">
        我的会友
    </a>
</div>
<br>
<br>

<form action="index.php?mod=myClass&action=addFindFriend" method="POST">
    <h1 class="addOut_title">
        会友信息
    </h1>
    <div class="addOut_field">
        <div class="addOut_field_label">课程</div>
        <select class="addOut_field_input" name="classnum">
            <?php while($class = db_fetch($classList)){ ?>
                <?php $classinfo = get_classinfo($class['cid']); ?>
                <?php if($classinfo['classtype'] == 4 || $classinfo['classtype'] == 5 || $classinfo['classtype'] == 7){ ?>
                <option value = <?php echo isset($classinfo['num'])?($classinfo['num']):("var[classinfo['num']]"); ?>><?php echo isset($classinfo['name'])?($classinfo['name']):("var[classinfo['name']]"); ?>(<?php echo isset($classinfo['num'])?($classinfo['num']):("var[classinfo['num']]"); ?>)</option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">简介</div>
        <textarea class="addOut_field_text"
                  name="contents"
                  id="contents"
                  placeholder="必填,可以说说希望交到什么样的朋友^_^"
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
        　　以下信息（除联系方式）将被公开展示给其他想组队的同学。可以填写“保密”，但那样会影响您的组队成功率。<br>
        　　您的联系方式只有在对方加入组队以后才可以看到。对方将通过南小宝的私聊功能与您联系。
    </p>
    <div class="addOut_field">
        <div class="addOut_field_label">姓名</div>
        <input type="text" class="addOut_field_input" name="uname" placeholder="选填">
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
        <div class="addOut_field_label">院系</div>
        <input type="text" class="addOut_field_input" name="department" placeholder="选填">
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">年级</div>
        <input type="text" class="addOut_field_input" name="grade" placeholder="选填">
    </div>
    <p class="addOut_field">
        　　注意，发起会友后无法撤回。
    </p>
    <div class="card2_btn" onclick="submit_findFriend();">
        发起会友
    </div>
    <input type="submit" hidden id="submit_findFriend">
</form>
<br>
<br>
<br>
<br>
<br>
</body>
<script>
    function submit_findFriend() {
        if(document.getElementById("contents").value === ""){
            $.alert("请填写会友简介！");
        } else {
            document.getElementById("submit_findFriend").click();
        }
        return 0;
    }
</script>
</html>