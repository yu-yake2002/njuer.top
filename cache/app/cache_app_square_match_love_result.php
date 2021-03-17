<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 七日情侣结果</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/love_reg.css?r=5666">
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/square_match_out.css?r=5666">
</head>
<body>
<?php include template("app/square:common_header"); ?>
<?php include template("app/square:match_love_common"); ?>

<div class="Reg">
    <?php if($Reg['state'] == 6 || $Reg['state'] == 5){ ?>
    <h1 class="Reg_title">
        匹配结果
    </h1>
    <?php if($Match){ ?>
    <div class="watch_image_box">
        <img class="watch_image" src="https://www.njuer.top/<?php echo isset($Match['photo'])?($Match['photo']):(""); ?>">
    </div>
    <p class="addOut_field" align="center">
        姓名: <?php echo isset($Match['name'])?($Match['name']):(""); ?><br>
        学号: <?php echo isset($Match['sid'])?($Match['sid']):(""); ?><br>
        身高: <?php echo isset($Match['body_height'])?($Match['body_height']):(""); ?>cm<br>
        QQ: <?php echo isset($Match['qq'])?($Match['qq']):(""); ?>
    </p>
    <?php $Match['intro'] = str_ireplace("\n", "<br>", $Match['intro']); ?> 
    <p class="addOut_field">
        个人介绍: <?php echo isset($Match['intro'])?($Match['intro']):(""); ?>
    </p>
    <?php if(time() <= $BeginAct){ ?>
    <div class="post_submit" onclick="location.href='index.php?mod=square&action=match&do=Love&step=result&confirm=false';">
        退出活动
    </div>
    <?php } ?>
    <!--<p class="addOut_field">
        请在10月17日20点之前点击“确认结果”以确认匹配结果。<br>
        如果您确认结果：<br>
        1. 对方退出活动：双方退出活动，你们将获得双方的QQ；<br>
        2. 对方确认结果：活动进入后续流程；<br>
        3. 对方无操作：双方退出活动，你们将获得双方的QQ。<br>
        如果您退出活动：<br>
        1. 对方退出活动：双方退出活动，匹配消失；<br>
        2. 对方确认结果：双方退出活动，你们将获得双方的QQ；<br>
        3. 对方无操作：双方退出活动，匹配消失。<br>
        退出活动以后：<br>
        您可以点击重新匹配再次进入匹配过程，但是有一定的概率匹配失败，此类型的匹配失败不在补偿范围内。<br>
        确认结果以后：<br>
        在对方确认之前，您可以重新匹配。
    </p>
    <?php if(time() - 158400 <= $BeginAct && time() >= $BeginAct){ ?>
    <div class="post_submit"<?php if(time() > $BeginAct){ ?> onclick="location.href='index.php?mod=square&action=match&do=Love&step=result&confirm=true';"<?php } ?>>
        确认结果
    </div>
    <div class="post_submit"<?php if(time() > $BeginAct){ ?> onclick="location.href='index.php?mod=square&action=match&do=Love&step=result&confirm=false';"<?php } ?>>
        退出活动
    </div>
    <br>
    <br>
    <br>
    <?php } ?>-->
    <?php }else{ ?>
    <p class="addOut_field">
        非常抱歉，您没有匹配成功。之前匹配失败是会有我们手写明信片赠送的，但因为这次是寒假，我们没法把明信片送到大家手中，真的很抱歉。
    </p>
    <?php } ?>
    <?php }elseif($Reg['state'] == 8){ ?>
    <?php if($Match['state'] == 8){ ?>
    <h1 class="Reg_title">
        七日备忘录
    </h1>
    <?php if($day < 1){ ?>
    <p class="addOut_field">
        现在是活动第 <?php echo isset($day)?($day):(""); ?> 天，今天的日程安排是：<br>
        1. 通过小纸条约定10月18日的聊天时间(到时本页面会自动出现聊天按钮)；<br>
        2. 在本页面选择第 4 天的活动方式：浪漫电影/心动舞会。
    </p>
    <div class="addOut_field">
        <h3 align="center">第4天活动报名规则</h3>
        活动组为大家策划了两场活动：
        浪漫电影(<?php if($Wish['type'] == 1){ ?>60人，分两场<?php }else{ ?>LGBT设专场<?php } ?>)和
        心动舞会(<?php if($Wish['type'] == 1){ ?>30人<?php }else{ ?>30人，LGBT不设专场<?php } ?>)。<br>
        10月17日20:29前情侣可以共同编辑活动意向，也可以选择不填(如果意向1和意向2相同，则意向2作废)。<br>
        10月17日20:30在本页面公布抽签结果。
    </div>
    <?php if(time() <= 1602937800){ ?>
    <div class="addOut_field">
        <div class="addOut_field_label">意向1</div>
        <select onchange="changeWish('1', this.value);" name="" class="addOut_field_input" style="background-color: #f7f7fa">
            <option value="0"<?php if($Wish['wish1'] == 0){ ?> selected<?php } ?>>空</option>
            <option value="1"<?php if($Wish['wish1'] == 1){ ?> selected<?php } ?>>浪漫电影</option>
            <option value="2"<?php if($Wish['wish1'] == 2){ ?> selected<?php } ?>>心动舞会</option>
        </select>
        <br><br>
        <div class="addOut_field_label">意向2</div>
        <select onchange="changeWish('2', this.value);" class="addOut_field_input" style="background-color: #f7f7fa">
            <option value="0"<?php if($Wish['wish2'] == 0){ ?> selected<?php } ?>>空</option>
            <option value="1"<?php if($Wish['wish2'] == 1){ ?> selected<?php } ?>>浪漫电影</option>
            <option value="2"<?php if($Wish['wish2'] == 2){ ?> selected<?php } ?>>心动舞会</option>
        </select>
    </div>
    <?php }else{ ?>
    <div class="addOut_field">
        <div class="addOut_field_label">抽签结果</div>
        <p class="addOut_field_contents">
            <?php if($Wish['result'] == 0){ ?>
            自由活动
            <?php }elseif($Wish['result'] == 1){ ?>
            浪漫电影(场次1)
            <?php }elseif($Wish['result'] == 2){ ?>
            心动舞会
            <?php }elseif($Wish['result'] == 3){ ?>
            浪漫电影(场次3(LGBT专场))
            <?php }elseif($Wish['result'] == 4){ ?>
            浪漫电影(场次2)
            <?php } ?>
        </p>
    </div>
    <?php } ?>
    <?php }elseif($day == 1){ ?>
    <p class="addOut_field">
        现在是活动第 <?php echo isset($day)?($day):(""); ?> 天，今天的日程安排是：<br>
        1. 在昨天约定的时间点击下方按钮开始即时聊天；<br>
        2. 在即时聊天中约定好你们明天的见面地点。<br>
    </p>
    <div class="post_submit" onclick="location.href='index.php?mod=user&action=message&uid=<?php echo isset($Match['uid'])?($Match['uid']):(""); ?>&r=<?php echo rand(0, 50); ?>';">
        即时聊天
    </div>
    <?php }elseif($day == 2){ ?>
    <p class="addOut_field">
        现在是活动第 <?php echo isset($day)?($day):(""); ?> 天，今天的日程安排是：<br>
        1. 在食堂门口见面；<br>
        欢迎拍下短视频投稿给南小宝APP用户交流群群主或者管理员，我们会帮您剪vlog哦~<br>
    </p>
    <?php }elseif($day == 4){ ?>
    <p class="addOut_field">
        现在是活动第 <?php echo isset($day)?($day):(""); ?> 天，今天的日程安排是：<br>
        休问我，彼为谁；十月露沾衣，是我，待君会。
        <?php if($Wish['result'] == 0){ ?>
        抽签结果: 很遗憾，没有抽中<br>
        今晚，我们可以共约自习、共上一堂课......无论怎样，我们开心变好。
        <?php }elseif($Wish['result'] == 1){ ?>
        今晚19:50，于逸夫楼C104，在泷与三叶的见证下，再遇最好的ta~<br>
        请凭入场码入场: <strong><?php echo strtoupper(substr(md5($Wish['wid']), 0, 4)); ?></strong>
        <?php }elseif($Wish['result'] == 2){ ?>
        今晚19:50，于逸夫楼C105，在泷与三叶的见证下，再遇最好的ta~<br>
        请凭入场码入场: <strong><?php echo strtoupper(substr(md5($Wish['wid']), 0, 4)); ?></strong>
        <?php }elseif($Wish['result'] == 3){ ?>
        今晚19:50，于逸夫楼C203(LGBT专场)，重温《请以你的名字呼唤我》。<br>
        请凭入场码入场: <strong><?php echo strtoupper(substr(md5($Wish['wid']), 0, 4)); ?></strong>
        <?php }elseif($Wish['result'] == 4){ ?>
        今晚19:50，于逸夫楼C114，在泷与三叶的见证下，再遇最好的ta~<br>
        请凭入场码入场: <strong><?php echo strtoupper(substr(md5($Wish['wid']), 0, 4)); ?></strong>
        <?php } ?>
    </p>
    <?php }elseif($day == 5){ ?>
    <p class="addOut_field">
        对方QQ：<?php echo isset($Match['qq'])?($Match['qq']):(""); ?><br>
        今天是你们假扮情侣的第5天，相处至今，相信落花有意，流水亦有情。今日，你需要和ta共同策划一场双人活动，内容形式不限，但结束时需要将上传一条有创意的朋友圈/动态，并将截图上传给南小宝客服，让南小宝记录你们的甜蜜。
    </p>
    <?php }elseif($day == 6){ ?>
    <p class="addOut_field">
        很好，现在是第六天，七日情侣活动已经步入了尾声，是时候为ta准备一个小礼物啦！你将在周六约会归来之后，在南小宝的见证下，亲手送给最好的ta<br>
        （友情提示：礼轻情意重，不要超过10元，也不要提前告诉ta嗷~）
    </p>
    <?php }elseif($day == 7){ ?>
    <p class="addOut_field">
        眨眼到了周六，现在是七日情侣的第七天。是时候约ta走出校园，在南京走走看看啦！提前祝你们度过一个愉快的周末~<br>
        最后，记得在19点左右赶回南大，到香雪海喝下一杯南小宝为你俩准备的温热红茶。你们将在南小宝工作人员的见证下，互赠明信片和事先准备的小礼物。至此，七日情侣活动完结，接下来，是你和ta新的开始~<br>
    </p>
    <?php if(!$together){ ?>
    <div class="post_submit" onclick="location.href='index.php?mod=square&action=match&do=Love&step=result&together=true&&r=<?php echo rand(0, 50); ?>';">
        继续情侣关系
    </div>
    <div class="post_submit" onclick="location.href='index.php?mod=square&action=match&do=Love&step=result&together=false&&r=<?php echo rand(0, 50); ?>';">
        结束情侣关系
    </div>
    <?php }else{ ?>
    对方的选择是：<?php if(!$match_together){ ?>暂未选择<?php }elseif($match_together['state'] == 1){ ?>继续情侣关系<?php }elseif($match_together['state'] == 0){ ?>结束情侣关系<?php } ?>
    <?php } ?>
    <?php } ?>
    <?php } ?>
    <h1 class="Reg_title">
        匹配结果
    </h1>
    <div class="watch_image_box">
        <img class="watch_image" src="https://www.njuer.top/<?php echo isset($Match['photo'])?($Match['photo']):(""); ?>">
    </div>
    <p class="addOut_field" align="center">
        姓名: <?php echo isset($Match['name'])?($Match['name']):(""); ?><br>
        学号: <?php echo isset($Match['sid'])?($Match['sid']):(""); ?><br>
        身高: <?php echo isset($Match['body_height'])?($Match['body_height']):(""); ?>cm<br>
        对方:
        <?php if($Match['state'] == 6){ ?>
        未确认且未退出
        <?php if(time() - 158400 >= $BeginAct){ ?>
        <br>QQ号: <?php echo isset($Match['qq'])?($Match['qq']):(""); ?>
        <?php } ?>
        <?php }elseif($Match['state'] == 8){ ?>
        已确认
        <?php }elseif($Match['state'] == 7 || $Match['state'] == 9){ ?>
        已退出
        <br>QQ号: <?php echo isset($Match['qq'])?($Match['qq']):(""); ?>
        <?php } ?>
    </p>
    <?php $Match['intro'] = str_ireplace("\n", "<br>", $Match['intro']); ?>
    <p class="addOut_field">
        个人介绍: <?php echo isset($Match['intro'])?($Match['intro']):(""); ?>
    </p>
    <?php if(time() - 158400 <= $BeginAct && time() >= $BeginAct){ ?>
    <?php if($Match['state'] == 7 || $Match['state'] == 9 || $Match['state'] == 6){ ?>
    <div class="post_submit" onclick="location.href='index.php?mod=square&action=match&do=Love&step=result&reMatch=true&&r=<?php echo rand(0, 50); ?>';">
        退出并重新匹配
    </div>
    <?php } ?>
    <?php } ?>
    <?php }elseif($Reg['state'] == 7){ ?>
    <h1 class="Reg_title">
        匹配结果
    </h1>
    <div class="watch_image_box">
        <img class="watch_image" src="https://www.njuer.top/<?php echo isset($Match['photo'])?($Match['photo']):(""); ?>">
    </div>
    <p class="addOut_field" align="center">
        姓名: <?php echo isset($Match['name'])?($Match['name']):(""); ?><br>
        学号: <?php echo isset($Match['sid'])?($Match['sid']):(""); ?><br>
        身高: <?php echo isset($Match['body_height'])?($Match['body_height']):(""); ?>cm<br>
        QQ号: <?php echo isset($Match['qq'])?($Match['qq']):(""); ?>
    </p>
     <?php $Match['intro'] = str_ireplace("\n", "<br>", $Match['intro']); ?>
    <p class="addOut_field">
        个人介绍: <?php echo isset($Match['intro'])?($Match['intro']):(""); ?>
    </p>
    <?php if(time() - 158400 <= $BeginAct && time() >= $BeginAct){ ?>
    <div class="post_submit" onclick="location.href='index.php?mod=square&action=match&do=Love&step=result&reMatch=true&&r=<?php echo rand(0, 50); ?>';">
        重新匹配
    </div>
    <?php } ?>
    <?php }elseif($Reg['state'] == 9){ ?>
    请等待重新匹配。
    <?php }else{ ?>
    您暂未完成报名！
    <?php } ?>
    <?php if($_G['user']['identification']['verified'] > 5 && time() <= 1602937800){ ?>
    <div class="post_submit" onclick="location.href='index.php?mod=square&action=match&do=Love&step=result&chouQian=true';">
        抽签
    </div>
    <?php } ?>
</div>
<br>
<br>
<br><br><br>
<br><br><br>
<br><br><br>
</body>
<script src="static/js/square_match_love_result.js?r=5666"></script>
<script src="static/js/square_match_Love_post_image.js?r=5666"></script>
</html>