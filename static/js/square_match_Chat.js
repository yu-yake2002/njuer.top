var Matching = false;
var Matching2 = false;

function Match_Chat() {
    Matching = true;
    document.getElementById("Matching").style.display = "block";
    var DataSender=null;
    var result;
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
            if (DataSender.readyState === 4)
            {
                if (DataSender.status === 200)
                {
                    Matching2 = true;
                    eval("result = " + DataSender.responseText);
                    if(result['response'] == "success"){
                        location.href = "index.php?mod=user&action=message&uid=" + result['uid'].toString();
                    }
                    if(result['response'] == "loading"){
                        setTimeout(function () {
                            if(Matching){
                                Match_Chat();
                            }
                        }, 200);
                    }
                    if(result['response'] == "fail"){
                        document.getElementById("Matching").style.display = "hidden";
                        $.alert("非常抱歉，由于匹配名额有限，今日匹配已经提前结束！");
                    }
                    return true;
                }
            }
            return false;
        };
        DataSender.open("GET",
            "index.php?mod=php_api&action=square_match&func=Chat", true);
        DataSender.send();
        return true;
    }else{
        return false;
    }
}

function cancelChatMatching() {
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
            if (DataSender.readyState === 4)
            {
                if (DataSender.status === 200)
                {
                    Matching = false;
                    Matching2 = false;
                    document.getElementById("Matching").style.display = "none";
                    return true;
                }
            }
            return false;
        };
        DataSender.open("GET",
            "index.php?mod=php_api&action=square_match&func=cancelChat", true);
        if(Matching2) {
            DataSender.send();
        }
        return true;
    }else{
        return false;
    }
}