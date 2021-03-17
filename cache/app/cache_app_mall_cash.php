<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<?php include template("app/mall:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 求购积分</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/HMGet.css?r=7355">
</head>
<body>
<div class="card_bg">
    <button class="HMGet_btn" onclick="ask_for_credits(<?php echo isset($_G['user']['rest_confidence'])?($_G['user']['rest_confidence']):(""); ?>, <?php echo isset($_G['user']['credits_ask']['mobile'])?($_G['user']['credits_ask']['mobile']):(""); ?>);">求购积分</button>
    <div class="HMGet_content" id="Credits">
    </div>
</div>
</body>
<script src="static/js/HMGet_common.js?r=7355"></script>
<script src="static/js/HMGet_Credits.js?r=7355"></script>
<script>
    HMGet_Credits("");
</script>
</html>