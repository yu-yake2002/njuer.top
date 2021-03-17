<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php while($log_item = db_fetch($query)){ ?>
    <div class="HMGet_sub_content">
        <div class="title">
            求购 <?php echo isset($log_item['credits'])?($log_item['credits']):(""); ?> 积分
        </div>
        <div class="details">
            <strong>求购人信息</strong>
            <p>UID: <?php echo isset($log_item['uid'])?($log_item['uid']):(""); ?></p>
            <p>求购额度: <?php echo isset($log_item['confidence'])?($log_item['confidence']):(""); ?>(不含VIP附加额度)</p>
            <button class="HMGet_btn" onclick="sellCredits(<?php echo isset($log_item['uid'])?($log_item['uid']):(""); ?>, '<?php echo isset($_G['user']['credits_ask']['mobile'])?($_G['user']['credits_ask']['mobile']):(""); ?>', <?php echo isset($log_item['credits'])?($log_item['credits']):(""); ?>, '<?php echo isset($log_item['mobile'])?($log_item['mobile']):(""); ?>');">
                售出积分
            </button>
        </div>
    </div>
<?php } ?>