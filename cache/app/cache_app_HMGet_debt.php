<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php if($_G['user']['credits_ask']['uid2']){ ?>
<script>
    $.modal({
        title: "转账提醒",
        text: "请将 " + (<?php echo isset($_G['user']['credits_ask']['credits'])?($_G['user']['credits_ask']['credits']):(""); ?> / 10) + " 元钱转账给用户<?php echo isset($_G['user']['credits_ask']['uid2'])?($_G['user']['credits_ask']['uid2']):(""); ?>，"
            + "其联系方式为<br><font color='red'><?php echo isset($_G['user']['credits_ask']['mobile2'])?($_G['user']['credits_ask']['mobile2']):(""); ?></font>",
        buttons: [
            { text: "我已转账", onClick: function(){
                $.confirm({
                    text: "请确认是否已经完成转账。如果没有完成转账却选择此项您的信用将会严重受损，这可能导致您的帐号被封停甚至公告通报。因为不诚信操作导致的一切后果将由您本人承担。",
                    onOK: function () {
                        sendData_GET("index.php?mod=php_api&action=HMGetFunc&func=finishCredits");
                    }
                })
                } },
            { text: "稍后再说", className: "default"}
        ]
    });
</script>
<?php } ?>
<?php if($_G['notice']){ ?>
<script>
    $.modal({
        title: "南小宝公告",
        text: "<?php echo isset($_G['notice']['text'])?($_G['notice']['text']):(""); ?>",
        buttons: [
        { text: "我已收到", onClick: function(){
                sendData_GET("index.php?mod=php_api&action=common&func=readNotice&nid=<?php echo isset($_G['notice']['nid'])?($_G['notice']['nid']):(""); ?>");
            } },
        { text: "稍后再看", className: "default"}
    ]
    });
</script>
<?php } ?>