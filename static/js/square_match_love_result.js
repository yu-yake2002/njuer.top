function changeWish(wishid, changeWish) {
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
                    return true;
                }
            }
            return false;
        };
        DataSender.open("GET", "index.php?mod=php_api&action=square_love&func=ChangeWish&wish"
            + wishid.toString() + "=" + changeWish.toString(), true);
        DataSender.send();
        return true;
    }else{
        return false;
    }
}