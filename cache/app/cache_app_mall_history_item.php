<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php while($log_item = db_fetch($query)){ ?>
    <div class="HMGet_sub_content">
        <div class="title">
            <?php echo isset($log_item['num'])?($log_item['num']):(""); ?> 件 <?php echo isset($log_item['gname'])?($log_item['gname']):(""); ?>
        </div>
        <div class="details">
            <p>订单号: <?php echo isset($log_item['itemid'])?($log_item['itemid']):(""); ?></p>
            <p>订单更新时间: <?php echo formatTime($log_item['time']); ?></p>
            <p>订单状态:
                <?php if($log_item['state'] == 0){ ?>已经支付积分，即将为您配送到<?php echo isset($_G['user']['identification']['home'])?($_G['user']['identification']['home']):(""); ?>宿舍楼楼下平台<?php } ?>
                <?php if($log_item['state'] == 1){ ?>已经送达<?php echo isset($_G['user']['identification']['home'])?($_G['user']['identification']['home']):(""); ?>宿舍楼楼下平台，请查收<?php } ?>
                <?php if($log_item['state'] == 2){ ?>订单已结束<?php } ?>
            </p>
            <p>备注:
                <?php if($log_item['abstract']){ ?><?php echo isset($log_item['abstract'])?($log_item['abstract']):(""); ?><?php }else{ ?>无<?php } ?>
            </p>
        </div>
    </div>
<?php } ?>
