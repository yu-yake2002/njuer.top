var image_url = "";

function post_image() {
    document.getElementById("image").innerHTML = "正在上传中";
    var DataSender=null;
    var formData = new FormData();
    formData.append("file", document.getElementById("file").files[0]);
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
                    document.getElementById("image").innerHTML = DataSender.responseText;
                    image_url = document.getElementById("uploaded_image").value;
                }
            }
            return false;
        };
        DataSender.open("POST", "index.php?mod=php_api&action=common&func=upload_image", true);
        DataSender.send(formData);
        return true;
    }else{
        return false;
    }
}

function post_image2() {
    document.getElementById("image_loading").innerHTML = "正在上传中";
    var DataSender=null;
    var formData = new FormData();
    formData.append("file", document.getElementById("file").files[0]);
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
                    document.getElementById("image").innerHTML += DataSender.responseText;
                    document.getElementById("image_loading").innerHTML = "";
                }
            }
            return false;
        };
        DataSender.open("POST", "index.php?mod=php_api&action=common&func=upload_images", true);
        DataSender.send(formData);
        return true;
    }else{
        return false;
    }
}

function post_avatar() {
    var DataSender=null;
    var formData = new FormData();
    formData.append("file", document.getElementById("file").files[0]);
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
                    document.getElementById("avatar").src = DataSender.responseText;
                }
            }
            return false;
        };
        DataSender.open("POST", "index.php?mod=php_api&action=common&func=upload_avatar", true);
        DataSender.send(formData);
        return true;
    }else{
        return false;
    }
}

function post_IndexPhoto() {
    var DataSender=null;
    var formData = new FormData();
    formData.append("file", document.getElementById("files").files[0]);
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
                    var length = DataSender.length;
                    if(DataSender.responseText.substr(length - 4, length) == "exit"){
                        document.getElementById("photo_wall").innerHTML += "上传失败<br>";
                    }else {
                        document.getElementById("photo_wall").innerHTML += "<a><img src=\"" + DataSender.responseText + "\" alt=\"\" width=\"100%\" /></a><br><br>";
                    }
                }
            }
            return false;
        };
        DataSender.open("POST", "index.php?mod=php_api&action=common&func=upload_photo_wall", true);
        DataSender.send(formData);
        return true;
    }else{
        return false;
    }
}

function post_msg_image(to_uid) {
    var DataSender=null;
    var formData = new FormData();
    formData.append("file", document.getElementById("file").files[0]);
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
                    document.getElementById("image").innerHTML = DataSender.responseText;
                    image_url = document.getElementById("uploaded_image").value;
                    $.confirm({
                        text: "是否确认发送该图片？",
                        onOK: function () {
                            document.getElementById("message").value = "<img src=\"" + image_url + "\" width=\"100%\">";
                            post_message(to_uid);
                            document.getElementById("image").innerHTML = "";
                        },
                        onCancel:function () {
                            document.getElementById("image").innerHTML = "";
                        }
                    });
                }
            }
            return false;
        };
        DataSender.open("POST", "index.php?mod=php_api&action=common&func=upload_image", true);
        DataSender.send(formData);
        return true;
    }else{
        return false;
    }
}

