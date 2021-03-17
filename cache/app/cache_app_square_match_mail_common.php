<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<div class="nav_row">
    <a href="index.php?mod=square&action=match&do=mail&step=box&r=<?php echo rand(1,50); ?>"
       class="nav_btn<?php if($step == 'box'){ ?>_chosen<?php } ?>">
        解忧杂货店
    </a>
    <a href="index.php?mod=square&action=match&do=mail&step=myBox&r=<?php echo rand(1,50); ?>"
       class="nav_btn<?php if($step == 'myBox'){ ?>_chosen<?php } ?>">
        收件箱
    </a>
    <a href="index.php?mod=square&action=match&do=mail&step=mysent&r=<?php echo rand(1,50); ?>"
       class="nav_btn<?php if($step == 'mysent'){ ?>_chosen<?php } ?>">
        发件箱
    </a>
</div>
<br>
<br>
