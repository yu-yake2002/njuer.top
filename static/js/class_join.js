function JoinClass(classid) {
    $.confirm({
        text: "为防止用户恶意添加多门课程，你每个学期仅可以免费加入15门课程。<font color='red'>第16门（含已退出的课程）起每加入一门课程消耗2积分。</font>",
        onOK: function () {
            $.ajax({
                url: "index.php?mod=php_api&action=rankList_class&func=JoinClass&ClassId=" + classid,
                success: function (result) {
                    $.alert(result);
                }
            });
        }
    });
}

function ExitClass(classid, className) {
    $.confirm({
        text: "确定要退出课程" + className + "吗？加入课程消耗的积分将不会返还。",
        onOK: function () {
            $.ajax({
                url: "index.php?mod=php_api&action=rankList_class&func=ExitClass&ClassId=" + classid,
                success: function (result) {
                    $.alert({
                        text: result,
                        onOK: function () {
                            $("#class_" + classid).hide();
                        }
                    });
                }
            });
        }
    });
}

function SubscribeClass(classid, className) {
    $.confirm({
        text: "您确定要订阅课程" + className + "吗？该操作将消耗您2积分。",
        onOK: function () {
            $.ajax({
                url: "index.php?mod=php_api&action=rankList_class&func=SubscribeClass&ClassId=" + classid,
                success: function (result) {
                    $.alert({
                        text: result,
                        onOK: function () {
                            $("#subscribe_" + classid).hide();
                        }
                    });
                }
            });
        }
    });
}

function ApplyAdmin(classid, className) {
    $.confirm({
        text: "您确定要申请成为课程 " + className + " 的管理员吗？<br>"
            + "<p style='text-align: left'>1. 成为管理员以后，您需要负责管理课程讨论区、更新课程通知、课程资料、课程简介、考核方式等内容；</p>"
            + "<p style='text-align: left'>2. 同时您将每个月获得100积分的奖励，且在南小宝的各种活动中拥有一定的优先权。</p>",
        onOK: function () {
            $.prompt({
                text: "你可以在这里留下申请理由",
                onOK: function (data) {
                    $.ajax({
                        url: "index.php?mod=php_api&action=rankList_class&func=ApplyAdmin&ClassId=" + classid
                            + "&reason=" + encodeURIComponent(data),
                        success: function (result) {
                            $.alert(result);
                        }
                    });
                }
            });
        }
    });
}