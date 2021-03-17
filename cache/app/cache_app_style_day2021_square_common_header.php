<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<link rel="stylesheet" href="./template_app/style/day2021/css/square.css?r=3986">

<table width="80%" align="center" style="margin: 0 auto" class="footmenu_list2">
    <tr>
        <td align="center" width="33%" onclick="location.href='index.php?mod=square&action=dingli&r=<?php echo rand(1,50); ?>';">
            <img src="static/style_img/day2021/dingli.png?r=3986" class="footmenu2_item<?php if($_GET['action'] == 'dingli'){ ?>_chosen<?php } ?>">
        </td>
        <td align="center" width="33%" onclick="location.href='index.php?mod=square&action=match&r=<?php echo rand(1,50); ?>';">
            <img src="static/style_img/day2021/youyue.png?r=3986" class="footmenu2_item<?php if($_GET['action'] == 'match'){ ?>_chosen<?php } ?>">
            <?php if($_G['user']['new_mail'] > 0){ ?><span class="new_message" style="font-size: 8px; float: left; position: absolute">New</span><?php } ?>
        </td>
        <td align="center" width="33%" onclick="location.href='index.php?mod=square&action=lanjing&r=<?php echo rand(1,50); ?>';">
            <img src="static/style_img/day2021/lanjing.png?r=3986" class="footmenu2_item<?php if($_GET['action'] == 'lanjing'){ ?>_chosen<?php } ?>">
            <?php if($_G['user']['new_message']){ ?><span class="new_message" style="font-size: 8px; float: left; position: absolute">New</span><?php } ?>
        </td>
    </tr>
    <tr>
        <td align="center" class="menu_title2" onclick="location.href='index.php?mod=square&action=dingli&r=<?php echo rand(1,50); ?>';">
            鼎里
        </td>
        <td align="center" class="menu_title2" onclick="location.href='index.php?mod=square&action=match&r=<?php echo rand(1,50); ?>';">
            有约
        </td>
        <td align="center" class="menu_title2" onclick="location.href='index.php?mod=square&action=lanjing&r=<?php echo rand(1,50); ?>';">
            消息
        </td>
    </tr>
</table>
