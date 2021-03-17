<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 文档</title>
</head>
<body>
<?php include template("app/working:common_header"); ?>
<?php $i = 0; ?>
<input id='copy_url' class="nxb_input" placeholder="下载链接">
<?php if($father != 14){ ?>
<a href="index.php?mod=working&action=documents&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>&r=8523&father=<?php echo isset($folder['father'])?($folder['father']):(""); ?>">
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
    <a href="index.php?mod=working&action=documents&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>&r=8523&father=<?php echo isset($file['id'])?($file['id']):(""); ?>">
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
            <?php if($OrgAdmin['file']){ ?>
            <p class="card2_contents">上传者:  <?php echo get_org_user($file['uid'], "name")['name']; ?></p>
            <?php } ?>
            <?php if($file['private']){ ?>
            <p class="card2_contents">私密文件，仅本人和管理员可以下载</p>
            <?php if($OrgAdmin['file'] || $_G['user']['uid'] == $file['uid']){ ?>
            <a href="javascript:download('<?php echo isset($file['url'])?($file['url']):(""); ?>');">
                <div class="card2_btn">下载</div>
            </a>
            <?php } ?>
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
<form action="index.php?mod=working&action=documents&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>&r=3791&father=<?php echo isset($father)?($father):(""); ?>" method="post">
    <div id="pdf">

    </div>
</form>
<div class="card3" onclick="document.getElementById('file').click();">
    <p align="center"><span class="file_type">PDF</span>上传PDF文件</p>
    <input type="file" id="file" hidden onchange="post_pdf()">
</div>
<?php } ?>
<br>
<br>
<br>
<br>
</body>
<script src="./static/js/common_post_pdf.js?r=8523"></script>
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