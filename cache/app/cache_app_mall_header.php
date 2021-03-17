<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<div class="nav_row">
    <a class="nav_btn<?php if($action == 'index'){ ?>_chosen<?php } ?>_small" href="index.php?mod=mall&action=index&r=<?php echo rand(1,10000); ?> ">
        商城
    </a>
    <a class="nav_btn<?php if($action == 'cash'){ ?>_chosen<?php } ?>_small" href="index.php?mod=mall&action=cash&r=<?php echo rand(1,10000); ?>">
        求购
    </a>
    <a class="nav_btn<?php if($action == 'history'){ ?>_chosen<?php } ?>_small" href="index.php?mod=mall&action=history&r= <?php echo rand(1,10000); ?>">
        订单
    </a>
    <span class="nav_btn_small">
        积分: <?php echo isset($_G['user']['credits']['credits'])?($_G['user']['credits']['credits']):(""); ?>
    </span>
</div>
<br>
<br>