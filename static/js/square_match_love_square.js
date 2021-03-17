function square_Love(regid) {
    $.confirm({
        text: "请确认操作",
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
                            document.getElementById("love_" + regid.toString()).innerHTML
                                =  DataSender.responseText;
                        }
                    }
                    return false;
                };
                DataSender.open("GET", "index.php?mod=php_api&action=square_love&func=Love&regid="
                    + regid.toString(), true);
                DataSender.send();
                return true;
            }else{
                return false;
            }
        }
    });
}