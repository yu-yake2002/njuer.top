<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 聊天界面</title>
    <link rel="stylesheet" href="./template_app/css/user_message.css?r=2275">
    <script>
        var message_start = 0;
        var message_stop = 0;
        var message_time = 0;
    </script>
</head>
<body>
<div class="header_list" onclick="history.back();">
    返回
    <span style="float:right;"><?php echo isset($group['name'])?($group['name']):(""); ?></span>
</div>
<div class="message_list" id="scrollMessage">
    <ul class="List" id="message_list">
    </ul>
</div>
<div class="post_message_box">
    <input type="text" class="post_message_input" id="message">
    <input type="submit" class="post_message_btn" value="发送" onclick="post_message(<?php echo isset($group['gid'])?($group['gid']):(""); ?>);">
</div>
</body>
<script src="static/js/user_room.js?r=2275"></script>
<script>
    loading_message(<?php echo isset($group['gid'])?($group['gid']):(""); ?>);
</script>
</html>