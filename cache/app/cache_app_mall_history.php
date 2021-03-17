<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<?php include template("app/mall:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 我的订单</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/HMGet.css?r=4244">
</head>
<body>
<div class="card_bg">
    <div class="HMGet_content" id="History">
    </div>
</div>
</body>
<script src="static/js/mall_History.js?r=4244"></script>
<script>
    mall_History("");
</script>
</html>