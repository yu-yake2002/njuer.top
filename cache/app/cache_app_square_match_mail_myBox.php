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
<?php while($letter = db_fetch($letters)){ ?>
    <div class="card3" onclick="location.href='index.php?mod=square&action=match&do=mail&step=letter&id=<?php echo isset($letter['lid'])?($letter['lid']):(""); ?>';">
        <div class="card3_image_container">
            <table width="100%">
                <tr>
                    <td>
                        <div class="card_title_unline"><?php echo isset($letter['subject'])?($letter['subject']):(""); ?>
                            <?php if($letter['read'] == 0 && $step != "mysent"){ ?>
                            <span class="new_message" style="font-size: 8px">New</span>
                            <?php } ?>
                        </div>
                        <p class="dingli_time" style="padding-left: 12px">信件号: #<?php echo isset($letter['lid'])?($letter['lid']):(""); ?> | 收件号: #<?php echo isset($letter['rid'])?($letter['rid']):(""); ?>
                            | 收信人: <?php echo mail_show_uid($letter['uid']); ?>
                            | 收信时间: <?php echo formatTime($letter['time']); ?>
                            <?php if($letter['read'] == 1){ ?>
                            | <font color="#ff7f50">已读</font>
                            <?php }else{ ?>
                            | 送达
                            <?php } ?></p>
                        <div class="card_contents"><?php echo isset($letter['abstract'])?($letter['abstract']):(""); ?></div>
                    </td>
                    <?php if($letter['image'] > 0){ ?>
                    <td width="30%">
                        <?php echo show_image_card("{img".$letter['image']."}"); ?>
                    </td>
                    <?php } ?>
                </tr>
            </table>
        </div>
    </div>
<?php } ?>
<br>
<br>
<br>
<br>
</body>
</html>