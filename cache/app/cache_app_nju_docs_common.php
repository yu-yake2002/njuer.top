<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<link rel="stylesheet" href="./template_app/css/nju_docs.css?r=5712">

<table width="80%" align="center" style="margin: 0 auto" class="footmenu_list2">
    <tr>
        <td align="center" width="33%" onclick="location.href='index.php?mod=nju_docs&action=docs&r=<?php echo rand(1,50); ?>';">
            <img src="static/img/passed.png?r=5712" class="footmenu2_item<?php if($action == 'docs'){ ?>_chosen<?php } ?>">
        </td>
        <td align="center" width="33%" onclick="location.href='index.php?mod=nju_docs&action=index&r=<?php echo rand(1,50); ?>';">
            <img src="static/img/gonglue.png?r=5712" class="footmenu2_item<?php if($action == 'index'){ ?>_chosen<?php } ?>">
        </td>
        <td align="center" width="33%" onclick="location.href='index.php?mod=nju_docs&action=communication&r=<?php echo rand(1,50); ?>';">
            <img src="static/img/question.png?r=5712" class="footmenu2_item<?php if($action == 'communication'){ ?>_chosen<?php } ?>">
        </td>
    </tr>
    <tr>
        <td align="center" class="menu_title2" onclick="location.href='index.php?mod=nju_docs&action=docs&r=<?php echo rand(1,50); ?>';">
            往届
        </td>
        <td align="center" class="menu_title2" onclick="location.href='index.php?mod=nju_docs&action=index&r=<?php echo rand(1,50); ?>';">
            攻略
        </td>
        <td align="center" class="menu_title2" onclick="location.href='index.php?mod=nju_docs&action=communication&r=<?php echo rand(1,50); ?>';">
            答疑
        </td>
    </tr>
</table>

<div class="nav2_row">
    <div class="nav2_btn">积分余额: <?php echo isset($_G['user']['credits']['credits'])?($_G['user']['credits']['credits']):(""); ?></div>
</div>
<br>
<br>