function send_Paper() {
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
                    document.getElementById("text").value = "";
                    return true;
                }
            }
            return false;
        };
        DataSender.open("GET", "index.php?mod=php_api&action=square_love&func=sendPaper&text="
            + encodeURIComponent(document.getElementById("text").value), true);
        DataSender.send();
        return true;
    }else{
        return false;
    }
}