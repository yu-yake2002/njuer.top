<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<link rel="stylesheet" href="./template_app/css/HMGet.css?r=7521">

<div class="sc-bottom-bar">
    <a class="sc-menu-item<?php if($_GET['action'] == 'needsList'){ ?> sc-current<?php } ?>"
       href="index.php?mod=HMGet&action=needsList&from=<?php echo isset($_GET["action"])?($_GET["action"]):(""); ?>&r=<?php echo rand(1,10000); ?> " id="needsList">
        <i class="fas fa-list"></i>
    </a>
    <a href="index.php?mod=HMGet&action=myRequest&from=<?php echo isset($_GET["action"])?($_GET["action"]):(""); ?>&r=<?php echo rand(1,10000); ?>" id="myRequest"
       class="sc-menu-item<?php if($_GET['action'] == 'myRequest'){ ?> sc-current<?php } ?>">
        <i class="fas fa-hand-paper"></i>
    </a>
    <a class="sc-nav-indicator">
    </a>
    <a class="sc-menu-item<?php if($_GET['action'] == 'myTask'){ ?> sc-current<?php } ?>"
       href="index.php?mod=HMGet&action=myTask&from=<?php echo isset($_GET["action"])?($_GET["action"]):(""); ?>&r= <?php echo rand(1,10000); ?>" id="myTask">
        <i class="fas fa-user"></i>
    </a>
</div>

<script>
    var menu_bar = document.querySelector('.sc-bottom-bar');
    var menu_indicator = document.querySelector('.sc-nav-indicator');
    var menu_current_item = document.querySelector('.sc-current');
    var menu_position;

    menu_position = menu_current_item.offsetLeft - 16;
    menu_indicator.style.left = menu_position + "px";
    menu_bar.style.backgroundPosition = menu_position - 8 + 'px';
</script>
<script src="static/js/HMGet_common.js?r=7521"></script>