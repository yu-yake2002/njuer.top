<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>

<div class="nav_row">
    <a href="index.php?mod=user&action=profile&uid=<?php echo isset($_G['user']['uid'])?($_G['user']['uid']):(""); ?>">
        <img src="<?php echo isset($_G['user']['profile']['avatar'])?($_G['user']['profile']['avatar']):(""); ?>" class="avatar_small">
    </a>
    <?php if(!$Reg || $Reg['state'] <= 2){ ?>
    <a href="index.php?mod=square&action=match&do=Love"
       class="nav_btn<?php if($_GET['step'] == 'reg'){ ?>_chosen<?php } ?>">
        线上情侣 - 报名
    </a>
    <?php }elseif($Reg['state'] <= 4){ ?>
    <a href="index.php?mod=square&action=match&do=Love"
       class="nav_btn<?php if($_GET['step'] == 'reg'){ ?>_chosen<?php } ?>">
        报名: 审核中
    </a>
    <?php }else{ ?>
    <?php if(time() <= $BeginAct){ ?>
    <a href="index.php?mod=square&action=match&do=Love&r=<?php echo rand(1, 500); ?>"
       class="nav_btn<?php if($_GET['step'] == 'reg'){ ?>_chosen<?php } ?>">
        报名表
    </a>
    <?php } ?>
    <!--<?php if($Match['state'] >= 8 && $Reg['state'] >= 8 && $Match['uid2'] == $Reg['uid']){ ?>
    <a href="index.php?mod=square&action=match&do=Love&step=result&r=<?php echo rand(1, 500); ?>"
       class="nav_btn<?php if($_GET['step'] == 'result'){ ?>_chosen<?php } ?>">
        活动
    </a>
    <?php }elseif(time() >= $BeginAct){ ?>
    <a href="index.php?mod=square&action=match&do=Love&step=result&r=<?php echo rand(1, 500); ?>"
       class="nav_btn<?php if($_GET['step'] == 'result'){ ?>_chosen<?php } ?>">
        结果
    </a>
    <?php } ?>-->
    <?php if(time() < $BeginAct && $Reg['uid2'] == 0){ ?>
    <a href="index.php?mod=square&action=match&do=Love&step=square&r=<?php echo rand(1, 500); ?>"
       class="nav_btn<?php if($_GET['step'] == 'square'){ ?>_chosen<?php } ?>">
        心动广场
    </a>
    <?php }elseif($Reg['uid2'] != 0 || time() >= $BeginAct){ ?>
    <a href="index.php?mod=square&action=match&do=Love&step=result&r=<?php echo rand(1, 500); ?>"
       class="nav_btn<?php if($_GET['step'] == 'result'){ ?>_chosen<?php } ?>">
        匹配结果
    </a>
    <?php } ?>
    <?php } ?>
</div>
<br>
<br>
<br>