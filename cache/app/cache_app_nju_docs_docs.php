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
<?php include template("app/rankList_class:common_header"); ?>
<?php if(time() <= $_SETTINGS['open_time']['nju_docs1']){ ?>
<div style="text-align: center; margin-top: 100px">
    <img src="static/img/question.png?r=8634" style="max-width: 100%; max-height: 70%; min-height: 60%;">
    <h1>开甲书院答疑坊</h1>
    <p>由于技术问题，上线时间调整至11.14 12:00</p>
</div>
<?php }else{ ?>
<?php $i = 0; ?>
<input id='copy_url' class="nxb_input" placeholder="下载链接">
<?php if($father != 1){ ?>
<a href="index.php?mod=nju_docs&action=docs&r=8634&father=<?php echo isset($foler['father'])?($foler['father']):(""); ?>">
    <div class="card3">
        <font color="#808080">📂返回上级目录</font>
    </div>
</a>
<?php }else{ ?>
<div class="card3">
    不存在上级目录
</div>
<?php } ?>
<?php while($file = db_fetch($query)){ ?>
    <?php $i++; ?>
    <?php if($file['type'] == 1){ ?>
    <a href="index.php?mod=nju_docs&action=docs&r=8634&father=<?php echo isset($file['id'])?($file['id']):(""); ?>">
        <div class="card3">
            <font color="#000">
                <h2 class="card2_title_unline">📂<?php echo isset($file['name'])?($file['name']):(""); ?></h2>
                <p class="card2_contents">查看: <?php echo isset($file['downloads'])?($file['downloads']):(""); ?> | 上次更新时间: <?php echo formatTime($file['updateTime']); ?></p>
            </font>
        </div>
    </a>
    <?php }elseif($file['type'] == 2){ ?>
    <div class="card3">
        <font color="#000">
            <h3><span class="file_type">PDF</span><?php echo isset($file['name'])?($file['name']):(""); ?></h3>
            <p class="card2_contents">上传时间: <?php echo formatTime($file['time']); ?></p>
            <?php if($file['private']){ ?>
            <div class="card2_btn">审核中</div>
            <?php }else{ ?>
            <p class="card2_contents">简介: <?php echo isset($file['abstract'])?($file['abstract']):(""); ?></p>
            <a href="javascript:download('<?php echo isset($file['url'])?($file['url']):(""); ?>');">
                <div class="card2_btn">下载</div>
            </a>
            <?php } ?>
        </font>
    </div>
    <?php } ?>
<?php } ?>
<?php if($i == 0){ ?>
<div class="card3">
    没有找到指定目录下的文件
</div>
<?php } ?>

<?php if($folder['allowPDF']){ ?>
<form action="index.php?mod=nju_docs&action=docs&r=3791&father=<?php echo isset($father)?($father):(""); ?>" method="post">
<div id="pdf">

</div>
</form>
<div class="card3" onclick="document.getElementById('file').click();">
    <p align="center"><span class="file_type">PDF</span>上传PDF文件</p>
    <input type="file" id="file" hidden onchange="post_pdf()">
</div>
<?php } ?>
<?php } ?>
<br>
<br>
<br>
<br>
</body>
<script src="./static/js/common_post_pdf.js?r=8634"></script>
<script>
    function download(url){
        document.getElementById("copy_url").value = url;
        $.alert("已经复制到剪贴板","下载链接",
            function () {
                var copy_url = document.getElementById("copy_url");
                copy_url.select();
                document.execCommand("copy");
            });
        return;
    }
</script>
</html>