function post_dingli() {
    var dingli_text = document.getElementById("text").value;
    var dingli_class = document.getElementById("post_class").value;
    if (dingli_text == "") {
        document.getElementById("text").focus();
    } else if (dingli_class == 0){
        $.alert("请选择投稿分类！");
    } else{
        $.confirm({
            text: "确定发到鼎里？<font color='red'>一经发表将无法删除!</font>",
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
                    DataSender.open("GET", "index.php?mod=php_api&action=square&func=sendDingLi&text="
                        + encodeURIComponent(dingli_text)
                        + "&class=" + encodeURIComponent(dingli_class)
                        + "&image=" + encodeURIComponent(image_url), true);
                    DataSender.send();
                    return true;
                }else{
                    return false;
                }
            }
        });
    }
}

function dingli_reply(hid) {
    location.href="index.php?mod=square&action=dingli&do=Wri&replyid=" + hid.toString();
    return true;
}

