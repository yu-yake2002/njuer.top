<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<!--2020年9月7日 ycc-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 我的任务</title>
</head>
<body>
<?php include template("app/HMGet:common_header"); ?>
<div class="nav_row">
    <a href="index.php?mod=HMGet&action=myTask&do=myRequest"
       class="nav_btn<?php if($_GET['do'] == 'myRequest'){ ?>_chosen<?php } ?>">
        我的需求
    </a>
    <a href="index.php?mod=HMGet&action=myTask&do=myTask"
       class="nav_btn<?php if($_GET['do'] == 'myTask'){ ?>_chosen<?php } ?>">
        我的任务
    </a>
</div>

<br>
<br>
<div class="HMGet_content" id="RequestList">
</div>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
<script src="static/js/HMGet_RequestList.js?r=9458"></script>
<?php if($_GET['do'] == 'myTask'){ ?>
<script>
    HMGet_RequestList("type=myTask");
</script>
<?php } ?>
<?php if($_GET['do'] == 'myRequest'){ ?>
<script>
    HMGet_RequestList("type=myRequest");
</script>
<?php } ?>
</html>