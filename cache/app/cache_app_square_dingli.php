<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 鼎里</title>
</head>
<body>
<?php include template("app/square:common_header"); ?>
<div class="nav_row">
    <a href="index.php?mod=user&action=profile&uid=<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>">
        <img src="<?php echo isset($_G['user']['profile']['avatar'])?($_G['user']['profile']['avatar']):(""); ?>" class="avatar_small">
    </a>
    <a href="index.php?mod=square&action=dingli&do=Wri"
       class="nav_btn<?php if($_GET['do'] == 'Wri'){ ?>_chosen<?php } ?>_small">投稿</a>
    <a href="index.php?mod=square&action=dingli&do=New"
       class="nav_btn<?php if($_GET['do'] == 'New'){ ?>_chosen<?php } ?>_small">最新</a>
    <a href="index.php?mod=square&action=dingli&do=Hot"
       class="nav_btn<?php if($_GET['do'] == 'Hot'){ ?>_chosen<?php } ?>_small">热榜</a>
    <a href="index.php?mod=square&action=dingli&do=Search"
       class="nav_btn<?php if($_GET['do'] == 'Search'){ ?>_chosen<?php } ?>_small">搜索</a>
    <a href="index.php?mod=square&action=dingli&do=List"
       class="nav_btn<?php if($_GET['do'] == 'List'){ ?>_chosen<?php } ?>_small">列表</a>
    <a href="index.php?mod=square&action=dingli&do=Col"
       class="nav_btn<?php if($_GET['do'] == 'Col'){ ?>_chosen<?php } ?>_small">收藏</a>
</div>
<br>
<br>
<br>
<?php if($_GET['do'] != "Wri"){ ?>
<?php if($_GET['do'] == "Search"){ ?>
<input type="text" name="keyword" class="post_select" value="<?php echo isset($_GET['keyword'])?($_GET['keyword']):(""); ?>" placeholder="输入关键词后点击任意处搜索" onchange="location.href='index.php?mod=square&action=dingli&do=Search&keyword=' + encodeURIComponent(this.value)">
<?php } ?>
<div id="DingLiList" class="dingli_list_cells"></div>
<p align="center" style="color: #793c65">左右滑动可以查看更多内容</p>
<select class="post_select" onchange="location.href='index.php?mod=square&action=dingli&do=<?php echo isset($_GET['do'])?($_GET['do']):(""); ?>&class=' + this.value">
    <option value="0"<?php if($_GET['class'] == 0){ ?> selected<?php } ?>>全部投稿</option>
    <option value="1"<?php if($_GET['class'] == 1){ ?> selected<?php } ?>>故事投稿</option>
    <option value="2"<?php if($_GET['class'] == 2){ ?> selected<?php } ?>>问答求助</option>
    <option value="3"<?php if($_GET['class'] == 3){ ?> selected<?php } ?>>生活吐槽</option>
    <option value="4"<?php if($_GET['class'] == 4){ ?> selected<?php } ?>>趣事分享</option>
    <option value="5"<?php if($_GET['class'] == 5){ ?> selected<?php } ?>>同片天空</option>
    <option value="6"<?php if($_GET['class'] == 6){ ?> selected<?php } ?>>海底捞</option>
    <option value="7"<?php if($_GET['class'] == 7){ ?> selected<?php } ?>>表白</option>
    <option value="9"<?php if($_GET['class'] == 9){ ?> selected<?php } ?>>校猫照片</option>
    <option value="10"<?php if($_GET['class'] == 10){ ?> selected<?php } ?>>鼎里话题</option>
    <option value="8"<?php if($_GET['class'] == 8){ ?> selected<?php } ?>>其他</option>
</select>
<?php }else{ ?>
<select class="post_select" id="post_class">
    <option value="0" selected>请选择投稿分类</option>
    <option value="1">故事投稿</option>
    <option value="2">问答求助</option>
    <option value="3">生活吐槽</option>
    <option value="4">趣事分享</option>
    <option value="5">同片天空</option>
    <option value="6">海底捞</option>
    <option value="7">表白</option>
    <option value="9">校猫照片</option>
    <option value="10">鼎里话题</option>
    <option value="8">其他</option>
</select>

<textarea class="post_textarea" rows="12" id="text" placeholder="您可以在这里匿名投稿任何内容，恶意言论将被删除"></textarea>

<br>

<div class="post_submit" onclick="document.getElementById('file').click();" id="choose_image">
    选择配图
    <input type="file" id="file" hidden onchange="post_image()">
</div>
<div id="image" class="watch_image_box"></div>
<div class="post_submit" onclick="post_dingli();">
    发到鼎里
</div>
<?php } ?>
<br>
<br>
<br>
<br>
<br>
</body>
<script src="static/js/common_post_image.js?r=6392"></script>
<script src="static/js/square_dingli_post.js?r=6392"></script>
<script src="static/js/square_dingli_loading.js?r=6392"></script>
<script src="static/js/square_dingli_operation.js?r=6392"></script>
<?php if($_GET['do'] != "Wri"){ ?>
<script>
    square_DingLiList("type=<?php echo isset($_GET['do'])?($_GET['do']):(""); ?>&class=<?php echo isset($_GET['class'])?($_GET['class']):(""); ?>&keyword=" + encodeURIComponent("<?php echo isset($_GET['keyword'])?($_GET['keyword']):(""); ?>"));
</script>
<?php }else{ ?>
<?php if(isset($_GET['replyid'])){ ?>
<script>
    document.getElementById("text").value="#Reply[<?php echo isset($_GET['replyid'])?($_GET['replyid']):(""); ?>]#";
</script>
<?php } ?>
<?php } ?>
</html>