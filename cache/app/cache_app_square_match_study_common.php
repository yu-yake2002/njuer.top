<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<div class="nav_row">
    <a href="index.php?mod=square&action=match&do=study&step=index&r=<?php echo rand(1,50); ?>"
       class="nav_btn<?php if($step == 'index'){ ?>_chosen<?php } ?>">
        主页
    </a>
    <a href="index.php?mod=square&action=match&do=study&step=ranklist&r=<?php echo rand(1,50); ?>"
       class="nav_btn<?php if($step == 'ranklist'){ ?>_chosen<?php } ?>">
        统计
    </a>
</div>
<br>
<br>
