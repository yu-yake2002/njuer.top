var image_url = "";

function post_photo() {
    document.getElementById("posting").style.display = "";
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
                    if(DataSender.responseText.length >= 30) {
                        document.getElementById("uploaded").value = "True";
                        document.getElementById("posting").innerHTML = "下一步";
                    }
                }
            }
            return false;
        };
        DataSender.open("POST", "index.php?mod=php_api&action=square_love&func=upload_photo", true);
        DataSender.send(formData);
        return true;
    }else{
        return false;
    }
}

function post_LifePhoto() {
    document.getElementById("posting").style.display = "";
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
                    if(DataSender.responseText.length >= 30) {
                        document.getElementById("uploaded").value = "True";
                        document.getElementById("posting").innerHTML = "下一步";
                    }
                }
            }
            return false;
        };
        DataSender.open("POST", "index.php?mod=php_api&action=square_love&func=upload_LifePhoto", true);
        DataSender.send(formData);
        return true;
    }else{
        return false;
    }
}