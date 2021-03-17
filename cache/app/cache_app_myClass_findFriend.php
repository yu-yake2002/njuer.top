<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 我的课程</title>
    <link rel="stylesheet" href="./template_app/css/love_reg.css?r=3297">
    <link rel="stylesheet" href="./template_app/css/rankList_class.css?r=3297">
</head>
<body>
<?php include template("app/rankList_class:common_header"); ?>
<h1 class="Reg_title">
    我的课程
</h1>
<?php if(db_count($classList) == 0){ ?>
<div class="card3">你还没有加入任何课程</div>
<?php }else{ ?>
<?php while($class = db_fetch($classList)){ ?>
    <?php $classinfo = get_classinfo($class['cid']); ?>
    <div class="card3" style="text-align: left" id="class_<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>">
        <p class="classlist-titlenav">
            <span class="classlist-title"><?php echo isset($classinfo['name'])?($classinfo['name']):("var[classinfo['name']]"); ?></span>
        <hr size="1" color="#793c65">
        </p>
        <div class="classlist-introduction">
            <p>课程号: <?php echo isset($classinfo['num'])?($classinfo['num']):("var[classinfo['num']]"); ?>(<?php echo isset($classinfo['credits'])?($classinfo['credits']):("var[classinfo['credits']]"); ?>学分)</p>
            <p>授课老师: <?php echo isset($classinfo['teacher'])?($classinfo['teacher']):("var[classinfo['teacher']]"); ?></p>
            <p style="padding-top: 6px">
                <a href="index.php?mod=myClass&action=findFriend" class="classlist-link">课程交友</a>
                <?php if(!$classinfo['admin']){ ?>
                <a href="javascript:;" class="classlist-link" onclick="ApplyAdmin('<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>', '<?php echo isset($classinfo['name'])?($classinfo['name']):(""); ?>')">申请课程管理员</a>
                <?php }elseif($classinfo['admin'] == $_G['user']['uid']){ ?>
                <a href="javascript:;" class="classlist-link">详情</a>
                <?php } ?>
                <?php if($classinfo['forum']){ ?>
                <a href="index.php?mod=nju_docs&action=communication&fid=<?php echo isset($classinfo['forum'])?($classinfo['forum']):(""); ?>" class="classlist-link">进入讨论区</a>
                <?php } ?>
                <?php if($classinfo['docs']){ ?>
                <a href="index.php?mod=nju_docs&action=docs&father=<?php echo isset($classinfo['docs'])?($classinfo['docs']):(""); ?>" class="classlist-link">课程资料</a>
                <?php } ?>
                <?php if($class['subscribe'] == 0){ ?>
                <a id="subscribe_<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>" href="javascript:;" class="classlist-link" onclick="SubscribeClass('<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>', '<?php echo isset($classinfo['name'])?($classinfo['name']):(""); ?>');">订阅课程通知</a>
                <?php } ?>
                <a href="javascript:;" class="classlist-link" onclick="ExitClass('<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>', '<?php echo isset($classinfo['name'])?($classinfo['name']):(""); ?>');">退出课程</a>
            </p>
        </div>
    </div>
<?php } ?>
<?php } ?>
<br>
<br>
<br>
<br>
</body>
<script src="static/js/class_join.js?r=3297"></script>
</html>