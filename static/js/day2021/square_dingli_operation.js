function delDingLi(hid) {
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
                DataSender.open("GET", "index.php?mod=php_api&action=square&func=delDingLi&hid=" + hid.toString(), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}

function delComment(cid) {
    $.confirm({
        text: "确认折叠该条？",
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
                DataSender.open("GET", "index.php?mod=php_api&action=square&func=delComment&cid=" + cid.toString(), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}

function colDingLi(hid) {
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
                DataSender.open("GET", "index.php?mod=php_api&action=square&func=colDingLi&hid=" + hid.toString(), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}

function addComment(hid, init="") {
    $.prompt({
        text: init?"请输入回复内容":"请输入评论内容",
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
                            $.alert(init?"已经回复成功，刷新后可看到回复内容！":"评论已经发布成功，刷新后可以看到评论内容！");
                            return DataSender.responseText;
                        }
                    }
                    return false;
                };
                DataSender.open("GET",
                    "index.php?mod=php_api&action=square&func=addComment&hid="
                    + hid.toString() + "&text=" + encodeURIComponent(init + text), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}

function repDingLi(hid) {
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
                            document.getElementById("reports_" + hid.toString()).innerHTML = DataSender.responseText;
                        }
                    }
                    return false;
                };
                DataSender.open("GET", "index.php?mod=php_api&action=square&func=repDingLi&hid=" + hid.toString(), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}


function zanDingLi(hid) {
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
                    if(document.getElementById("zan_img_hole_" + hid.toString()).alt == "点赞") {
                        document.getElementById("zan_img_hole_" + hid.toString()).alt = "取消赞";
                        document.getElementById("zan_img_hole_" + hid.toString()).src = 'static/style_img/day2021/zaned.png?r=3';
                    }else{
                        document.getElementById("zan_img_hole_" + hid.toString()).alt = "点赞";
                        document.getElementById("zan_img_hole_" + hid.toString()).src = 'static/style_img/day2021/flower.png?r=3';
                    }
                }
            }
            return false;
        };
        DataSender.open("GET", "index.php?mod=php_api&action=square&func=zanDingLi&hid=" + hid.toString(), true);
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
                    if(document.getElementById("zan_img_comments_" + cid.toString()).alt == "点赞") {
                        document.getElementById("zan_img_comments_" + cid.toString()).alt = "取消赞";
                        document.getElementById("zan_img_comments_" + cid.toString()).src = 'static/style_img/day2021/zaned.png?r=3';
                    }else{
                        document.getElementById("zan_img_comments_" + cid.toString()).alt = "点赞";
                        document.getElementById("zan_img_comments_" + cid.toString()).src = 'static/style_img/day2021/flower.png?r=3';
                    }
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


function freshDingLi(hid) {
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
                    document.getElementById("hole_cell_" + hid.toString()).innerHTML =
                        DataSender.responseText;
                    $.alert("刷新成功");
                }
            }
            return false;
        };
        DataSender.open("GET", "index.php?mod=php_api&action=square&func=DingLiList&type=Hid&start=0&fresh=1&hid=" + hid.toString(), true);
        DataSender.send();
        return true;
    }else{
        return false;
    }
}