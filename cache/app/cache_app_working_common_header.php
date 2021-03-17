<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/working.css?r=7210">

<table width="80%" align="center" style="margin: 0 auto" class="footmenu_list">
    <tr>
        <td align="center" width="33%">
            <img src="static/img/dingli.png?r=7210" class="footmenu_item<?php if($_GET['action'] == 'dingli'){ ?>_chosen<?php } ?>">
        </td>
        <td align="center" width="33%">
            <a href="index.php?mod=working&action=documents&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>">
            <img src="static/img/youyue.png?r=7210" class="footmenu_item<?php if($_GET['action'] == 'documents'){ ?>_chosen<?php } ?>">
            </a>
        </td>
        <td align="center" width="33%">
            <a href="index.php?mod=working&action=index&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>">
            <img src="static/img/lanjing.png?r=7210" class="footmenu_item<?php if($_GET['action'] == 'index'){ ?>_chosen<?php } ?>">
            </a>
        </td>
    </tr>
    <tr>
        <td align="center" class="menu_title">
            执行
        </td>
        <td align="center" class="menu_title">
            文档
        </td>
        <td align="center" class="menu_title">
            例会
        </td>
    </tr>
</table>


<div class="nav_row">
    <a href="index.php?mod=user&action=profile&uid=<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>">
        <img src="<?php echo isset($_G['user']['profile']['avatar'])?($_G['user']['profile']['avatar']):(""); ?>" class="avatar_small">
    </a>
    <a href="index.php?mod=working&action=credits&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>"
       class="nav_btn<?php if($_GET['action'] == 'credits'){ ?>_chosen<?php } ?>">
        积分: <?php echo isset($OrgUser['credits'])?($OrgUser['credits']):(""); ?>
    </a>
    <a href="index.php?mod=working&action=workday&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>"
       class="nav_btn">
        <?php $name = db_fetch(db_query("SELECT name FROM org_user_states WHERE oid = ".$org['oid']." AND state = ".$OrgUser['state'])); ?>
        部门: <?php echo isset($name['name'])?($name['name']):(""); ?>
    </a>
</div>
<br>
<br>
<br>
