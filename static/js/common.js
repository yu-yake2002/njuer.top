//Edit 20200907 张运筹
function getValueById(id)
{
    return document.getElementById(id).value;
}

function sendData_GET(url)
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
                    return DataSender.responseText;
                }
            }
            return false;
        };
        DataSender.open("GET", encodeURI(url), true);
        DataSender.send();
        return true;
    }else{
        return false;
    }
}