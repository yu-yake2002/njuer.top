function delWeiHua(hid) {
    $.confirm({
        text: "确认删除该条？",
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
                DataSender.open("GET", "index.php?mod=php_api&action=square&func=delWeiHua&hid=" + hid.toString(), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}

function colWeiHua(hid) {
    $.confirm({
        text: "确认收藏/取消收藏该条？",
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
                            $.alert(DataSender.responseText);
                        }
                    }
                    return false;
                };
                DataSender.open("GET", "index.php?mod=php_api&action=square&func=colWeiHua&hid=" + hid.toString(), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}

function addComment(hid) {
    $.prompt({
        text: "请输入评论内容",
        onOK: function (text) {
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
                            $.alert("评论已经发布成功，刷新后可以看到评论内容！");
                            return DataSender.responseText;
                        }
                    }
                    return false;
                };
                DataSender.open("GET",
                    "index.php?mod=php_api&action=square&func=addComment&hid="
                    + hid.toString() + "&text=" + encodeURIComponent(text), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}

function repWeiHua(hid) {
    $.confirm({
        text: "确认举报/取消举报该条？",
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
                            document.getElementById("reports_" + hid.toString()).innerHTML =
                                eval(document.getElementById("reports_" + hid.toString()).innerHTML) + 1;
                        }
                    }
                    return false;
                };
                DataSender.open("GET", "index.php?mod=php_api&action=square&func=repWeiHua&hid=" + hid.toString(), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}


function zanWeiHua(hid) {
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
                    document.getElementById("likes_" + hid.toString()).innerHTML =
                        DataSender.responseText;
                }
            }
            return false;
        };
        DataSender.open("GET", "index.php?mod=php_api&action=square&func=zanWeiHua&hid=" + hid.toString(), true);
        DataSender.send();
        return true;
    }else{
        return false;
    }
}


function zanComment(cid) {
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
                    document.getElementById("likes_comments_" + cid.toString()).innerHTML =
                        DataSender.responseText;
                }
            }
            return false;
        };
        DataSender.open("GET", "index.php?mod=php_api&action=square&func=zanComment&cid=" + cid.toString(), true);
        DataSender.send();
        return true;
    }else{
        return false;
    }
}