<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<link rel="stylesheet" href="./template_app/css/square.css?r=1179">
<link rel="stylesheet" href="./template_app/css/rankList_class.css?r=1179">

<table width="80%" align="center" style="margin: 0 auto" class="footmenu_list">
    <tr>
        <td align="center" width="33%" onclick="location.href='index.php?mod=rankList_class&r=<?php echo rand(1,50); ?>';">
            <img src="static/img/class_foot_logo1.png?r=1179" class="footmenu_item">
        </td>
        <td align="center" width="33%" onclick="location.href='index.php?mod=myClass&r=<?php echo rand(1,50); ?>';">
            <img src="static/img/class_foot_logo2.png?r=1179" class="footmenu_item">
        </td>
        <td align="center" width="33%" onclick="location.href='index.php?mod=nju_docs&r=<?php echo rand(1,50); ?>';">
            <img src="static/img/class_foot_logo3.png?r=1179" class="footmenu_item">
        </td>
    </tr>
    <tr>
        <td align="center" class="menu_title" onclick="location.href='index.php?mod=rankList_class&action=dingli&r=<?php echo rand(1,50); ?>';">
            选课指南
        </td>
        <td align="center" class="menu_title" onclick="location.href='index.php?mod=myClass&r=<?php echo rand(1,50); ?>';">
            我的课程
        </td>
        <td align="center" class="menu_title" onclick="location.href='index.php?mod=nju_docs&r=<?php echo rand(1,50); ?>';">
            传承南大
        </td>
    </tr>
</table>
<?php if(isset($_GET['do']) && $_GET['do'] == "creditsLog"){ ?>
<?php }else{ ?>
<div class="nav_row">
    <a href="index.php?mod=user&action=profile&uid=<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>">
        <img src="<?php echo isset($_G['user']['profile']['avatar'])?($_G['user']['profile']['avatar']):(""); ?>" class="avatar_small">
    </a>
    <a href="index.php?mod=HMGet&action=needsList&do=creditsLog"
       class="nav_btn<?php if($_GET['do'] == 'Wri'){ ?>_chosen<?php } ?>_small">积分余额: <?php echo isset($_G['user']['credits']['credits'])?($_G['user']['credits']['credits']):(""); ?></a>
</div>
<?php } ?>