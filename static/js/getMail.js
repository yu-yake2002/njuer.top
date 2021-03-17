function getMail() {
    document.getElementById("getMail").style.display = "block";
    if(document.getElementById("getMail_Success").innerHTML == "loading...")
    {
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
                        document.getElementById("getMail_Success").innerHTML = DataSender.responseText;
                    }
                }
                return false;
            };
            DataSender.open("GET", "index.php?mod=php_api&action=square_mail&func=getMail", true);
            DataSender.send();
            return true;
        }else{
            return false;
        }
    }
}