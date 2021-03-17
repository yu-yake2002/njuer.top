var pdf_url = "";

function post_pdf() {
    document.getElementById("pdf").innerHTML = "正在上传中";
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
                    document.getElementById("pdf").innerHTML = DataSender.responseText;
                    pdf_url = document.getElementById("uploaded_pdf").value;
                }
            }
            return false;
        };
        DataSender.open("POST", "index.php?mod=php_api&action=common&func=upload_pdf", true);
        DataSender.send(formData);
        return true;
    }else{
        return false;
    }
}