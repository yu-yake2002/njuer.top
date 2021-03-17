<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 七日广场</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/love_reg.css?r=6895">
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/square_match_out.css?r=6895">
</head>
<body>
<?php include template("app/square:common_header"); ?>
<?php include template("app/square:match_love_common"); ?>

<div class="Reg">
    <?php $i = 0; ?> 
    <?php if($Reg['state'] <= 6 && $Reg['state'] >= 5 && $Reg['uid2'] == 0 && (time() <= $BeginAct)){ ?>
    <h1 class="Reg_title">
        七日广场
    </h1>
    <div class="dingli_list_cells">
        <?php while($row = db_fetch($query)){ ?>
            <?php if((substr($Reg['sid'], 0, 2) == "20" && substr($row['grade_o'], 0, 1) == "1")
        || (substr($Reg['sid'], 0, 2) == "19" && substr($row['grade_o'], 2, 1) == "1")
        || (substr($Reg['sid'], 0, 2) == "18" && substr($row['grade_o'], 4, 1) == "1")
        || (substr($Reg['sid'], 0, 2) != "20"
         && substr($Reg['sid'], 0, 2) != "19"
          && substr($Reg['sid'], 0, 2) != "18"
           && substr($row['grade_o'], 6, 1) == "1")){ ?>
            <div class="dingli_list_cell">
                <h4 class="dingli_title">
                    学号前两位：<?php echo substr($row['sid'], 0, 2); ?>
                    <?php $isLoved = db_fetch(db_query("SELECT * FROM square_love_heart WHERE regid = ".$Reg['regid']." AND uid = ".$row['uid']." AND `time` >= ".$BeginReg)); ?>
                    <?php $isLove = db_fetch(db_query("SELECT * FROM square_love_heart WHERE uid = ".$_G['user']['uid']." AND regid = ".$row['regid']." AND `time` >= ".$BeginReg)); ?>
                    <p class="like2">
                        💖<span id="love_<?php echo isset($row['regid'])?($row['regid']):(""); ?>" onclick="square_Love(<?php echo isset($row['regid'])?($row['regid']):(""); ?>)"><?php if($isLove){ ?>已心动 <?php echo formatTime($isLove['time']); ?><?php }else{ ?>心动TA<?php } ?></span>
                        <?php if($isLoved && $isLove){ ?>💖
                        <?php db_update("square_match_love_reg", array("uid2" => $row['uid']), "regid=".$Reg['regid']); ?>
                        <?php db_update("square_match_love_reg", array("uid2" => $_G['user']['uid']), "regid=".$row['regid']); ?>
                        <script>location.href='index.php?mod=square&action=match&do=Love&step=result&r=<?php echo rand(1, 50); ?>';</script>
                        <?php } ?>
                    </p>
                </h4>
                <div class="dingli_text">
                     <?php $row['intro'] = square_dingli_text($row['intro']."\n身高: ".$row['body_height']."cm\n点击下图查看照片", 0); ?>
                    <p class="dingli_text_line"><?php echo isset($row['intro'])?($row['intro']):(""); ?></p>
                    <div class="watch_image_box">
                        <img src="static/img/logo.png" onclick="this.src='https://www.njuer.top/<?php echo isset($row['photo'])?($row['photo']):(""); ?>';" class="watch_image">
                    </div>
                    <a href="index.php?mod=user&action=message&uid=<?php echo isset($row['uid'])?($row['uid']):(""); ?>">
                        <div class="post_submit">发起聊天</div>
                    </a>
                    <a href="index.php?mod=square&action=match&do=Love&step=square&pingbiid=<?php echo isset($row['regid'])?($row['regid']):(""); ?>">
                        <div class="post_submit">屏蔽</div>
                    </a>
                </div>
            </div>
            <?php } ?>
        <?php } ?>


        <div class="dingli_list_cell">
            <div class="dingli_text">
                已经没有更多啦~<?php if($Lovers > 0){ ?>（悄咪咪的告诉你，有<?php echo isset($Lovers)?($Lovers):(""); ?>个人已经心动了你哦！）<?php } ?>
            </div>
        </div>
    </div>
    <p align="center" style="color: <?php echo isset($_CORE['style_color1'])?($_CORE['style_color1']):(""); ?>">左右滑动可以查看更多</p>
    <?php } ?>
</div>
<br>
<br>
<br><br><br>
</body>
<script src="static/js/square_match_love_square.js?r=6895"></script>
</html>