
function creditsUpdate(uid) {
    $.prompt({
        text: "请输入积分奖励数额",
        onOK:function (credits) {
            $.prompt({
                text: "请输入操作理由",
                onOK:function (reason) {
                    var DataSender=null;
                    if (window.XMLHttpRequest)
                    {
                        DataSender=new XMLHttpRequest();
                    }
                    else if (window.ActiveXObject)
                    {
                        DataSender=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    if (DataSender!=null)
                    {
                        DataSender.onreadystatechange=function (){
                            if (DataSender.readyState == 4)
                            {
                                if (DataSender.status == 200)
                                {
                                    $.alert(DataSender.responseText);
                                }
                            }
                            return false;
                        };
                        DataSender.open("GET", "index.php?mod=php_api&action=user_credits&func=update&uid="+ uid.toString()
                            + "&reason=" + reason.toString()
                            + "&credits=" + credits.toString(), true);
                        DataSender.send();
                        return true;
                    }else{
                        return false;
                    }
                }
            });
        }
    });

}