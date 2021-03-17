<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 七日情侣报名</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/love_reg.css?r=5297">
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/square_match_out.css?r=5297">
</head>
<body>
<?php include template("app/square:common_header"); ?>
<?php include template("app/square:match_love_common"); ?>

<div class="Reg">
    <?php if(!$Reg){ ?>
    <div class="addOut_field">
        暂无需审核的报名信息
    </div>
    <?php }else{ ?>
    <h1 class="Reg_title">
        报名表
    </h1>
    <h1 class="Reg_title2">
        基本信息
    </h1>
    <div class="addOut_field">
        <div class="addOut_field_label">报名号</div>
        <?php $show_regid = $Reg['regid'] - 1601; ?> 
        <p class="addOut_field_contents"><?php echo isset($show_regid)?($show_regid):(""); ?></p>
        <div class="addOut_field_label">报名状态</div>
        <?php if(!(isset($_GET['times']) && $_GET['times'] == 2)){ ?>
        <p class="addOut_field_contents">信息审核中</p>
        <?php }else{ ?>
        <p class="addOut_field_contents">信息二审中</p>
        <?php } ?>
        <?php if(!(isset($_GET['times']) && $_GET['times'] == 2)){ ?>
        <div class="addOut_field_label">姓名</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['name'])?($Reg['name']):(""); ?></p>
        <div class="addOut_field_label">学号</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['sid'])?($Reg['sid']):(""); ?></p>
        <div class="addOut_field_label">年级</div>
        <p class="addOut_field_contents">本科 20<?php echo substr($Reg['sid'], 0, 2); ?>级</p>
        <?php } ?>
        <div class="addOut_field_label">生理性别</div>
        <p class="addOut_field_contents"> <?php echo $Reg['sex']?"男":"女"; ?></p>
        <div class="addOut_field_label">身高</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['body_height'])?($Reg['body_height']):(""); ?>cm</p>
        <div class="addOut_field_label">QQ</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['qq'])?($Reg['qq']):(""); ?></p>
        <div class="addOut_field_label">个人介绍</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['intro'])?($Reg['intro']):(""); ?></p>
    </div>
    <h1 class="Reg_title2">
        生活照
    </h1>
    <div class="watch_image_box">
        <img src="<?php echo isset($Reg['photo'])?($Reg['photo']):(""); ?>" class="watch_image">
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">置信度</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['match'])?($Reg['match']):(""); ?>%</p>
        <div class="addOut_field_label">颜值1</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['beauty_m'])?($Reg['beauty_m']):(""); ?></p>
        <div class="addOut_field_label">颜值2</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['beauty_fm'])?($Reg['beauty_fm']):(""); ?></p>
    </div>

    <?php if(!(isset($_GET['times']) && $_GET['times'] == 2)){ ?>
    <h1 class="Reg_title2">
        校园卡照片
    </h1>
    <div class="watch_image_box">
        <img src="<?php echo isset($Reg['card_pic'])?($Reg['card_pic']):(""); ?>" class="watch_image">
    </div>
    <div class="addOut_field">
        <div class="addOut_field_label">颜值1</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['card_beauty_m'])?($Reg['card_beauty_m']):(""); ?></p>
        <div class="addOut_field_label">颜值2</div>
        <p class="addOut_field_contents"><?php echo isset($Reg['card_beauty_fm'])?($Reg['card_beauty_fm']):(""); ?></p>
    </div>
    <?php } ?>
    <div class="addOut_field_label">报名人</div>
    <p class="addOut_field_contents">南小宝UID: <?php echo isset($Reg['uid'])?($Reg['uid']):(""); ?></p>
    <?php if(isset($_GET['times']) && $_GET['times'] == 2){ ?>
    <a href="index.php?mod=square&action=match&do=admin_Love&times=2&passid=<?php echo isset($Reg['regid'])?($Reg['regid']):(""); ?>">
        <div class="post_submit">
            审核通过
        </div>
    </a>
    <a href="index.php?mod=square&action=match&do=admin_Love&times=2&unpassid=<?php echo isset($Reg['regid'])?($Reg['regid']):(""); ?>">
        <div class="post_submit">
            驳回报名
        </div>
    </a>
    <?php }else{ ?>
    <?php if($Reg['state'] == 3 || $Reg['state'] == 4){ ?>
    <a href="index.php?mod=square&action=match&do=admin_Love&passid=<?php echo isset($Reg['regid'])?($Reg['regid']):(""); ?>">
        <div class="post_submit">
            审核通过
        </div>
    </a>
    <?php } ?>
    <?php if($Reg['state'] == 2){ ?>
    <a href="index.php?mod=square&action=match&do=admin_Love&sex=<?php echo isset($Reg['sex'])?($Reg['sex']):(""); ?>&sexid=<?php echo isset($Reg['regid'])?($Reg['regid']):(""); ?>">
        <div class="post_submit">
            性别反转
        </div>
    </a>
    <?php } ?>
    <?php if($Reg['state'] == 5 || $Reg['state'] == 6){ ?>
    <a href="index.php?mod=square&action=match&do=admin_Love&deleteid=<?php echo isset($Reg['regid'])?($Reg['regid']):(""); ?>">
        <div class="post_submit">
            强制退出
        </div>
    </a>
    <?php } ?>
    <?php if($Reg['state'] == 3 || $Reg['state'] == 4){ ?>
    <a href="index.php?mod=square&action=match&do=admin_Love&unpassid=<?php echo isset($Reg['regid'])?($Reg['regid']):(""); ?>">
        <div class="post_submit">
            驳回报名
        </div>
    </a>
    <?php } ?>
    <?php } ?>
    <a href="index.php?mod=user&action=message&uid=<?php echo isset($Reg['uid'])?($Reg['uid']):(""); ?>">
        <div class="post_submit">
            联系用户
        </div>
    </a>
    <?php } ?>
</div>
<br>
<br>
<br><br><br>
</body>
<script src="static/js/square_match_love_Reg.js?r=5297"></script>
<script src="static/js/square_match_Love_post_image.js?r=5297"></script>
</html>