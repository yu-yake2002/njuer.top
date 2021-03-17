<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 首页</title>
    <style>
        body{
            background-color: #fbecd7;
        }
    </style>
</head>
<body>
<?php if($_CORE['isMobile']){ ?>
<h1 style="padding-left: 12px; color: #978a7a; cursor: pointer;" onclick="window.open('nxb.apk');">
    Android通道：点击此处安装APP使用南小宝
</h1>
<h1 style="padding-left: 12px; color: #978a7a; cursor: pointer;" onclick="location.href='index.php?mod=user&action=login';">
    iOS端通道：点击此处使用南小宝
</h1>
<img src="static/img/pic_mobile.jpg" width="100%">
<?php }else{ ?>
<h2 style="padding-left: 12px; color: #978a7a; cursor: pointer;" onclick="location.href='index.php?mod=user&action=login';"
    align="center">
    PC通道：点击图片使用南小宝<br>
    <img src="static/img/pic_pc.jpg" width="90%">
</h2>
<?php } ?>
</body>
</html>