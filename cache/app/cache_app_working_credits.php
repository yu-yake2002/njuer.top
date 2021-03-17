<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 积分记录</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/love_reg.css?r=6558">
</head>
<body>
<?php include template("app/working:common_header"); ?>
<div class="working">
    <h1 class="Reg_title">
        积分记录
    </h1>
    <p>
        注意该积分仅适用于“<?php echo isset($org['name'])?($org['name']):(""); ?>”团队内部。
    </p>
    <div class="working_group_list">
        <?php while($log = db_fetch($query)){ ?>
            <div class="working_group_cell">
                <h3>获得积分 <?php echo isset($log['credits'])?($log['credits']):(""); ?></h3>
                理由: <?php echo isset($log['reason'])?($log['reason']):(""); ?><br>
                时间: <?php echo formatTime($log['time']); ?>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>