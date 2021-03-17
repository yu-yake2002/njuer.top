<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 解忧收件箱</title>
</head>
<body>
<?php include template("app/square:common_header"); ?>
<?php include template("app/square:match_mail_common"); ?>
<div class="card3">
    <div class="card2_title">
        <?php echo isset($letter['title'])?($letter['title']):(""); ?>
    </div>
    <p class="card2_contents">
        信件号: <?php echo isset($letter['letterid'])?($letter['letterid']):(""); ?> | 推荐人数: <?php echo isset($letter['vote1'])?($letter['vote1']):(""); ?>
    </p>
    <?php if($letter_received){ ?>
    <table width="100%">
        <tr>
            <?php if($letter_received['known'] != 1 && $letter['uid'] != $_G['user']['uid']){ ?>
            <td>
                <div class="card2_btn" onclick="location.href='index.php?mod=square&action=match&do=mail&step=letter&id=<?php echo isset($_GET['id'])?($_GET['id']):(""); ?>&known=1';">
                    希望认识
                </div>
            </td>
            <?php } ?>
            <?php if($letter_received['replied'] != 1 && $letter['uid'] != $_G['user']['uid']){ ?>
            <td>
                <div class="card2_btn" onclick="document.getElementById('sendMail').style.display = 'block';">
                    回复信件
                </div>
            </td>
            <?php } ?>
        </tr>
    </table>
    <?php if($letter_received['replied'] != 1 && $letter['uid'] != $_G['user']['uid']){ ?>
    <form action="index.php?mod=square&action=match&do=mail&step=letter&id=<?php echo isset($_GET['id'])?($_GET['id']):(""); ?>" method="post">
        <div id="sendMail" style="display: none">
            <table width="100%">
                <tr>
                    <td colspan="2">
                        <input name="title" class="nxb_input" placeholder="请输入标题">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <textarea name="contents" rows="7" class="nxb_input" placeholder="请输入信件内容"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="image" class="card2">
                            如果您要上传图片，可以点击“添加图片”选择图片后在正文中输入相应的插入代码，插入示例：“最近拍了一些猫的照片。{img31}这是数分。{img32}这是浩哥。”
                            <div class="card2_btn" onclick="document.getElementById('file').click();">
                                <p align="center">添加图片</p>
                                <input type="file" id="file" hidden onchange="post_image2()">
                            </div>
                            <div id="image_loading"></div>
                        </div>
                        <input type="submit" id="submit" hidden><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <select name="allowShared" class="nxb_input">
                            <option value="0">设为私密，禁止收件人分享</option>
                            <option value="1" selected>允许被分享</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="card2_btn" onclick="document.getElementById('submit').click();">
                <p align="center">发送回复</p>
            </div>
        </div>
    </form>
    <?php } ?>
    <?php }elseif($letter["grade$grade"] && ($letter['gender'] == 0 || $letter['gender'] == $_G['user']['profile']['gender'])){ ?>
    <div class="card2_btn" onclick="location.href='index.php?mod=square&action=match&do=mail&step=letter&id=<?php echo isset($_GET['id'])?($_GET['id']):(""); ?>&collect=1';">
        收进信箱
    </div>
    <?php } ?>
    <div class="card2_contents">
        <?php echo isset($letter['contents'])?($letter['contents']):(""); ?>
        <p align="right">
            <?php echo mail_show_uid($letter['uid']); ?><br>
            <?php echo date("Y年m月d日", $letter['time']); ?>
        </p>
    </div>
    <table width="100%">
        <tr>
            <?php if($letter['allowShared'] > 0 && $letter['open'] != 1 && $letter['uid'] != $_G['user']['uid']){ ?>
            <td>
                <div class="card2_btn" onclick="location.href='index.php?mod=square&action=match&do=mail&step=letter&id=<?php echo isset($_GET['id'])?($_GET['id']):(""); ?>&share=1';">
                    分享信件
                </div>
            </td>
            <?php } ?>
            <?php if(!$recommend){ ?>
            <td>
                <div class="card2_btn" onclick="location.href='index.php?mod=square&action=match&do=mail&step=letter&id=<?php echo isset($_GET['id'])?($_GET['id']):(""); ?>&recommend=1';">
                    推荐信件
                </div>
            </td>
            <?php } ?>
        </tr>
    </table>
    <?php if($letter_received){ ?>
    <div class="card2_comments">
        <h3 align="center">信件追踪</h3>
        <p>
            用户 <strong><?php echo mail_show_uid($letter['uid']); ?></strong> 于<?php echo formatTime($letter['time']); ?>发出，信件号: <?php echo isset($letter['letterid'])?($letter['letterid']):(""); ?>，
            信件
            <?php if($letter['allowShared'] > 0){ ?>
            允许被分享
            <?php }else{ ?>
            设置私密，禁止分享
            <?php } ?>
            。
        </p>
        <?php if($letter['time'] != $letter_received['time']){ ?>
        <p><?php echo isset($letter['letterid'])?($letter['letterid']):(""); ?>号信件在
            <?php echo formatTime($letter['time']); ?>
            至
            <?php echo formatTime($letter_received['time']); ?>
            停留在信箱中，取信<strong>
            <?php if($letter['gender'] == 0){ ?>无性别要求<?php } ?>
            <?php if($letter['gender'] == 1){ ?>要求性别为女<?php } ?>
            <?php if($letter['gender'] == 2){ ?>要求性别为男<?php } ?>
            </strong>
            ，年级限于
            <strong>
            <?php $printed = 0; ?>
            <?php if($letter['grade1'] == 1){ ?><?php $printed = 1; ?><?php echo isset($_SETTINGS['year'])?($_SETTINGS['year']):(""); ?>级本科生<?php } ?>
            <?php if($letter['grade2'] == 1){ ?><?php if($printed){ ?>、<?php }else{ ?><?php $printed = 1; ?><?php } ?><?php echo $_SETTINGS['year'] - 1; ?>级本科生<?php } ?>
            <?php if($letter['grade3'] == 1){ ?><?php if($printed){ ?>、<?php }else{ ?><?php $printed = 1; ?><?php } ?><?php echo $_SETTINGS['year'] - 2; ?>级本科生<?php } ?>
            <?php if($letter['grade4'] == 1){ ?><?php if($printed){ ?>、<?php }else{ ?><?php $printed = 1; ?><?php } ?><?php echo $_SETTINGS['year'] - 3; ?>级本科生<?php } ?>
            <?php if($letter['grade5'] == 1){ ?><?php if($printed){ ?>、<?php }else{ ?><?php $printed = 1; ?><?php } ?><?php echo $_SETTINGS['year'] - 3; ?>级本科生以上<?php } ?>
            </strong>
            中。
        </p>
        <?php } ?>
        <p>
            用户 <strong><?php echo isset($letter_received['uid'])?($letter_received['uid']):(""); ?></strong> 于 <?php echo formatTime($letter_received['time']); ?> 取信。
        </p>
    </div>
    <?php } ?>
</div>
<br>
<br>
<br>
<br>
</body>
<script src="./static/js/common_post_image.js?r=9095"></script>
</html>