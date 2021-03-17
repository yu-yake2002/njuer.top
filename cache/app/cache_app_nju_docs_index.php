<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 传承南浪</title>
</head>
<body>
<?php include template("app/nju_docs:common"); ?>
<?php if(time() <= $_SETTINGS['open_time']['nju_docs1']){ ?>
<div style="text-align: center; margin-top: 100px">
    <img src="static/img/question.png?r=80" style="max-width: 100%; max-height: 70%; min-height: 60%;">
    <h1>开甲书院答疑坊</h1>
    <p>由于技术问题，上线时间调整至11.14 12:00</p>
</div>
<?php }else{ ?>
<?php while($class = db_fetch($query)){ ?>
    <div class="card2">
        <h2 class="card2_title"><?php echo isset($class['name'])?($class['name']):(""); ?></h2>
        <p class="card2_contents">授课老师: <?php echo isset($class['teacher'])?($class['teacher']):(""); ?></p>
        <div class="card2">
            <p align="center" id="<?php echo isset($class['classid'])?($class['classid']):(""); ?>-1" onclick="
            this.style.display='none';document.getElementById('<?php echo isset($class['classid'])?($class['classid']):(""); ?>-2').style.display='';">点击查看课程攻略</p>
            <div id="<?php echo isset($class['classid'])?($class['classid']):(""); ?>-2" style="display: none">
                <p class="card2_contents"><?php if($class['abstract']){ ?><?php echo isset($class['abstract'])?($class['abstract']):(""); ?><?php }else{ ?>暂无<?php } ?></p>
                <a href="index.php?mod=nju_docs&action=communication&fid=6&tid=6&r=80"><div class="card2_btn">补充投稿</div></a>
                <div class="card2_btn" onclick="
            document.getElementById('<?php echo isset($class['classid'])?($class['classid']):(""); ?>-2').style.display='none';document.getElementById('<?php echo isset($class['classid'])?($class['classid']):(""); ?>-1').style.display='';">收起</div>
            </div>
        </div>
    </div>
<?php } ?>
<?php } ?>
<br>
<br>
<br>
<br>
</body>
</html>