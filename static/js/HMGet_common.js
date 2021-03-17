function deleteRequest(nid) {
    $.confirm({
        text: '您确认要删除单号为 ' + nid + ' 的需求吗？如果交易已完成，订单积分将不会返还。',
        onOK: function(){
            $.alert("操作成功！");
            sendData_GET('index.php?mod=php_api&action=HMGetFunc&func=DeleteRequest&nid=' + nid);
            location.reload();
        },
        onCancel: function(){
            return false;
        }
    });
}

function getRequest(nid) {
    $.confirm({
        text: '您确认要接单吗？<br><font color="red">一旦接单成功将无法撤销！</font>',
        onOK: function(){
            sendData_GET('index.php?mod=php_api&action=HMGetFunc&func=GetRequest&nid=' + nid);
            $.alert("接单成功！您可以点击下方导航栏第三个图标，打开“我的任务”查看发单人联系信息！");
        },
        onCancel: function(){
            return false;
        }
    });
}

function finishRequest(nid)
{
    $.confirm({
        text: '您确认要结束订单吗？<br><font color="red">一旦结束订单后对方将收到积分，并与您失去联系！</font>',
        onOK: function(){
            sendData_GET('index.php?mod=php_api&action=HMGetFunc&func=FinishRequest&nid=' + nid);
            $.alert("订单已结束！");
        },
        onCancel: function(){
            return false;
        }
    });
}