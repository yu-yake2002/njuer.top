<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php while($log_item = db_fetch($query)){ ?>
    <div class="HMGet_sub_content">
        <div class="title">
            积分
            <?php if($log_item['credits'] > 0){ ?>
            +
            <?php } ?>
            <?php echo isset($log_item['credits'])?($log_item['credits']):(""); ?>
        </div>
        <div class="details">
            <p>流水号: <?php echo isset($log_item['lid'])?($log_item['lid']):(""); ?></p>
            <p>时间: <?php echo formatTime($log_item['time']); ?></p>
            <p>备注: <?php echo isset($log_item['reason'])?($log_item['reason']):(""); ?></p>
        </div>
    </div>
<?php } ?>