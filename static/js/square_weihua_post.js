function post_weihua() {
    var weihua_text = document.getElementById("text").value;
    var weihua_class = document.getElementById("post_class").value;
    if (weihua_text == "") {
        document.getElementById("text").focus();
    } else if (weihua_class == 0){
        $.alert("请选择投稿分类！");
    } else{
        $.confirm({
            text: "确定发到炜华？<font color='red'>一经发表将无法删除!</font>",
            onOK: function () {
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
                                location.reload();
                                return DataSender.responseText;
                            }
                        }
                        return false;
                    };
                    DataSender.open("GET", "index.php?mod=php_api&action=square&func=sendWeiHua&text="
                        + encodeURIComponent(weihua_text) + "&class=" + encodeURIComponent(weihua_class), true);
                    DataSender.send();
                    return true;
                }else{
                    return false;
                }
            }
        });
    }
}

function weihua_reply(hid) {
    document.getElementById("text").value += "#Reply[" + hid.toString() + "]#";
    return true;
}