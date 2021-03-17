<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 炜华</title>
</head>
<body>
<?php include template("app/square:common_header"); ?>
<div class="nav_row">
    <a href="index.php?mod=square&action=dingli&do=New"
       class="nav_btn<?php if($_GET['do'] == 'New'){ ?>_chosen<?php } ?>">
        最新
    </a>
    <a href="index.php?mod=square&action=dingli&do=Hot"
       class="nav_btn<?php if($_GET['do'] == 'Hot'){ ?>_chosen<?php } ?>">
        周热榜
    </a>
    <a href="index.php?mod=square&action=dingli&do=Col"
       class="nav_btn<?php if($_GET['do'] == 'Col'){ ?>_chosen<?php } ?>">
        收藏
    </a>
</div>
<br>
<br>
<div id="WeiHuaList" class="weihua_list_cells"></div>
</body>
<script src="static/js/square_weihua_post.js?r=4685"></script>
<script src="static/js/square_weihua_loading.js?r=4685"></script>
<script src="static/js/square_weihua_operation.js?r=4685"></script>
<script>
    square_WeiHuaList("type=<?php echo isset($_GET['do'])?($_GET['do']):(""); ?>&class=<?php echo isset($_GET['class'])?($_GET['class']):(""); ?>");
</script>
</html>