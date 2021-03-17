function GiveCredits(pid, credits) {
    $.confirm({
        text: "您确认采纳此答案并授予他积分吗？",
        onOK: function () {
            $.prompt({
                text: "本主题剩余" + credits + "积分未悬赏，请输入您要授予他的积分数量",
                onOK: function (data) {
                    if(data <= Number(credits)) {
                        $.ajax({
                            url: "index.php?mod=php_api&action=rankList_class&func=GiveCredits&pid=" + pid
                                + "&credits=" + encodeURIComponent(data),
                            success: function (result) {
                                $.alert(result);
                            }
                        });
                    }else{
                        $.alert({
                           text: "主题剩余的悬赏积分不足，请重新操作。",
                           onOK: function () {
                                GiveCredits(pid, credits);
                           }
                        });
                    }
                }
            });
        }
    });
}

function DeletePost(pid) {
    $.confirm({
        text: "您确认删除此贴内容吗？<font color='red'>一经删除将无法恢复！</font>",
        onOK: function () {
            $.ajax({
                url: "index.php?mod=php_api&action=rankList_class&func=DeletePost&pid=" + pid,
                success: function (result) {
                    $.alert(result);
                }
            });
        }
    });
}

function DeleteThread(tid) {
    $.confirm({
        text: "您确认删除此贴内容吗？<font color='red'>一经删除将无法恢复！</font>",
        onOK: function () {
            $.ajax({
                url: "index.php?mod=php_api&action=rankList_class&func=DeleteThread&tid=" + tid,
                success: function (result) {
                    $.alert(result);
                }
            });
        }
    });
}