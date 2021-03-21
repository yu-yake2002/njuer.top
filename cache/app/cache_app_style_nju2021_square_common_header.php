<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<link rel="stylesheet" href="./template_app/style/nju2021/css/square.css?r=8695">

<table width="80%" align="center" style="margin: 0 auto" class="footmenu_list">
    <tr>
        <td align="center" width="33%" onclick="location.href='index.php?mod=square&action=dingli&r=<?php echo rand(1,50); ?>';">
            <img src="static/style_img/nju2021/dingli.png?r=8695" class="footmenu_item<?php if($_GET['action'] == 'dingli'){ ?>_chosen<?php } ?>">
        </td>
        <td align="center" width="33%" onclick="location.href='index.php?mod=square&action=match&r=<?php echo rand(1,50); ?>';">
            <img src="static/style_img/nju2021/youyue.png?r=8695" class="footmenu_item<?php if($_GET['action'] == 'match'){ ?>_chosen<?php } ?>">
            <?php if($_G['user']['new_mail'] > 0){ ?><span class="new_message" style="font-size: 8px; float: left; position: absolute">New</span><?php } ?>
        </td>
        <td align="center" width="33%" onclick="location.href='index.php?mod=square&action=lanjing&r=<?php echo rand(1,50); ?>';">
            <img src="static/style_img/nju2021/lanjing.png?r=8695" class="footmenu_item<?php if($_GET['action'] == 'lanjing'){ ?>_chosen<?php } ?>">
            <?php if($_G['user']['new_message']){ ?><span class="new_message" style="font-size: 8px; float: left; position: absolute">New</span><?php } ?>
        </td>
    </tr>
    <tr>
        <td align="center" class="menu_title" onclick="location.href='index.php?mod=square&action=dingli&r=<?php echo rand(1,50); ?>';">
            鼎里
        </td>
        <td align="center" class="menu_title" onclick="location.href='index.php?mod=square&action=match&r=<?php echo rand(1,50); ?>';">
            有约
        </td>
        <td align="center" class="menu_title" onclick="location.href='index.php?mod=square&action=lanjing&r=<?php echo rand(1,50); ?>';">
            消息
        </td>
    </tr>
</table>
