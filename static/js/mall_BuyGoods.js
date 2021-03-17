function BuyGoods(num, user_credits, goods_credits, gid) {
    if(num <= 0){
        $.alert('货品已售空！');
    }else if(user_credits < goods_credits){
        $.alert('积分不足！');
    }else{
        $.confirm({
            text: "是否确认花费<font color='red'>" + goods_credits.toString() + "</font>积分购买该商品？",
            onOK: function () {
                document.getElementById("loading").style.display = "block";
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
                                document.getElementById("loading").style.display = "none";
                            }
                        }
                        return false;
                    };
                    DataSender.open("GET", "index.php?mod=php_api&action=mall&func=BuyGoods&gid=" + gid.toString());
                    DataSender.send();
                    return true;
                }else{
                    return false;
                }
            }
        });
    }
}