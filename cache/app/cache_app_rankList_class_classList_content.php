<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<div class="content2" style="text-align: left">
    <?php if(!$classinfo_ext){ ?>
    <p class="classlist-titlenav">
        <span class="classlist-rank"><?php echo isset($rank)?($rank):("var[rank]"); ?></span>
        <span class="classlist-title"><?php echo isset($classinfo['name'])?($classinfo['name']):("var[classinfo['name']]"); ?></span>
    <hr size="1" color="#793c65">
    </p>
    <div class="classlist-introduction">
        <p>课程号: <?php echo isset($classinfo['num'])?($classinfo['num']):("var[classinfo['num']]"); ?>(<?php echo isset($classinfo['credits'])?($classinfo['credits']):("var[classinfo['credits']]"); ?>学分)</p>
        <p>授课老师: <?php echo isset($classinfo['teacher'])?($classinfo['teacher']):("var[classinfo['teacher']]"); ?></p>
        <p align="right" style="padding-top: 6px">
            <a href="javascript:;" class="classlist-link" onclick="JoinClass('<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>');">加入</a>
            <a href="javascript:;" class="classlist-link" onclick="OpenClass('<?php echo isset($classinfo['classid'])?($classinfo['classid']):("var[classinfo['classid']]"); ?>');">详情</a>
            <a href="javascript:;" class="classlist-link" onclick="RemarkClass('<?php echo isset($classinfo['classid'])?($classinfo['classid']):("var[classinfo['classid']]"); ?>');">评价</a>
        </p>
    </div>
    <?php }else{ ?>
    <p class="classlist-titlenav">
        <span class="classlist-rank"><?php echo isset($rank)?($rank):("var[rank]"); ?></span>
        <span class="classlist-title"><?php echo isset($classinfo['name'])?($classinfo['name']):("var[classinfo['name']]"); ?></span>
        <hr size="1" color="#793c65">
    </p>
    <div class="classlist-introduction">
        <p>课程号: <?php echo isset($classinfo['num'])?($classinfo['num']):("var[classinfo['num']]"); ?>(<?php echo isset($classinfo['credits'])?($classinfo['credits']):("var[classinfo['credits']]"); ?>学分)</p>
        <p>授课老师: <?php echo isset($classinfo['teacher'])?($classinfo['teacher']):("var[classinfo['teacher']]"); ?></p>
        <p>小宝推荐指数: <?php echo round($classinfo['total'], 2); ?>(<?php echo isset($classinfo_ext['persons'])?($classinfo_ext['persons']):("var[classinfo_ext['persons']]"); ?>人评价)</p>
        <p align="right" style="padding-top: 6px">
            <a href="javascript:;" class="classlist-link" onclick="JoinClass('<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>');">加入</a>
            <a href="index.php?mod=php_api&action=rankList_class&func=OpenClass&ClassId=<?php echo isset($classinfo['classid'])?($classinfo['classid']):("var[classinfo['classid']]"); ?>" class="classlist-link">详情</a>
            <a href="javascript:;" class="classlist-link" onclick="RemarkClass('<?php echo isset($classinfo['classid'])?($classinfo['classid']):("var[classinfo['classid']]"); ?>');">评价</a>
        </p>
    </div>
    <?php } ?>
</div>