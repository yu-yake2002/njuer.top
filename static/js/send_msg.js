function send_msg(cid) {
    $.confirm({
        text: "确认群发通知？",
        onOK: function () {
            $.alert('<p id="loading_hint">正在群发消息，请不要关闭该窗口。</p>');
            $.post('index.php?mod=php_api&action=rankList_class&func=send_msg&cid=' + cid, {
                msg: $("#msg").val()
            }, function (data) {
                $("#loading_hint").html(data);
            });
        }
    });
}