var Credits_start = 0;
function HMGet_Credits(pars, isList=false)
{
    var Height = document.getElementById("Credits").offsetHeight;
    var scrollHeight = document.getElementById("Credits").scrollHeight;
    var scrollTop = document.getElementById("Credits").scrollTop;
    if (Math.abs(scrollTop - scrollHeight + Height) <= 50 || Height == scrollHeight) {
        var Credits=null;
        if (window.XMLHttpRequest)
        {
            Credits=new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        {
            Credits=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (Credits!=null) {
            Credits.onreadystatechange = function () {
                if (Credits.readyState == 4) {
                    if (Credits.status == 200) {
                        if (Credits.responseText != '') {
                            var newmessage = Credits.responseText;
                            if (newmessage) {
                                if(!isList){
                                    document.getElementById("Credits").innerHTML
                                        += Credits.responseText;
                                    Credits_start += 10;
                                }else{
                                    document.getElementById("Credits").innerHTML
                                        = Credits.responseText;
                                }
                                setTimeout(HMGet_Credits, 1000);
                            }
                        }else if(isList)
                        {
                            document.getElementById("Credits").innerHTML
                                = "<p align='center'>没有查询到相关需求</p>";
                        }
                    }
                }
                return false;
            };
            Credits.open("GET",
                "index.php?mod=php_api&action=HMGetFunc&func=Credits&start="
                + Credits_start.toString()
                + "&" + encodeURI(pars), true);
            Credits.send();
            return true;
        }
    }else {
        setTimeout(HMGet_Credits, 1000);
    }
}


function ask_for_credits(credits_confidence, init_mobile)
{
    $.confirm({
        text: '您是否确认要求购积分？<br>' +
            '<font color="red">积分的建议价为1元/10积分。</font><br>' +
            '求购请求一经发布将无法撤回，发布请求后积分会自动到账。' +
            '在有人确认出售积分后您需要将钱转账给对方。' +
            '如果在您确认已转账后，对方没有收到钱并' +
            '发起举报，我们将冻结您的帐号并在调查清楚后解封。',
        onOK: function () {
            $.prompt({
                text: '请输入您的常用联系电话',
                input: init_mobile,
                onOK:function (mobile) {
                    $.prompt({
                        text: '请输入您求购的积分数量(您的剩余求购额度为' +
                            credits_confidence + ')',
                        onOK:function (credits) {
                            sendData_GET("index.php?mod=php_api&action=HMGetFunc" +
                                "&func=AskForCredits&credits=" + credits + "&mobile=" + mobile);
                            location.reload();
                        }
                    });
                }
            });
        }
    });
}

function sellCredits(uid, init_mobile, credits, mobiles)
{
    $.confirm({
        text: '您是否确认要售出积分？<br>' +
            '售出后您可以获得<font color="red">' + (credits / 10) + '</font>元，同时扣除相应的积分。' +
            '售出无法撤回，确认后积分会自动扣除。' +
            '对方登录APP后会收到提示并转账给您。' +
            '如果3个工作日内对方没有转账给您，请加入QQ群195959801联系管理员举报。<br>' +
            '<font color="red">南小宝的每一个用户都已经通过了邮箱的实名认证。</font>',
        onOK: function () {
            $.prompt({
                text: '请输入您的收款手机号(可备注您偏好的支付方式)',
                input: init_mobile,
                onOK:function (mobile) {
                    sendData_GET("index.php?mod=php_api&action=HMGetFunc" +
                        "&func=SellCredits&uid=" + uid + "&mobile2=" + mobile);
                    $.alert({
                        text: "积分已售出，请等待转账，对方的联系方式为: " + mobiles,
                        onOK: function () {
                            location.reload();
                        }
                    });
                }
            });
        }
    });
}