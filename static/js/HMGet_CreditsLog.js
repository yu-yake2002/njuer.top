var CreditsLog_start = 0;
function HMGet_CreditsLog(pars, isList=false)
{
    var Height = document.getElementById("CreditsLog").offsetHeight;
    var scrollHeight = document.getElementById("CreditsLog").scrollHeight;
    var scrollTop = document.getElementById("CreditsLog").scrollTop;
    if (Math.abs(scrollTop - scrollHeight + Height) <= 50 || Height == scrollHeight) {
        var CreditsLog=null;
        if (window.XMLHttpRequest)
        {
            CreditsLog=new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        {
            CreditsLog=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (CreditsLog!=null) {
            CreditsLog.onreadystatechange = function () {
                if (CreditsLog.readyState == 4) {
                    if (CreditsLog.status == 200) {
                        if (CreditsLog.responseText != '') {
                            var newmessage = CreditsLog.responseText;
                            if (newmessage) {
                                if(!isList){
                                    document.getElementById("CreditsLog").innerHTML
                                        += CreditsLog.responseText;
                                    CreditsLog_start += 10;
                                }else{
                                    document.getElementById("CreditsLog").innerHTML
                                        = CreditsLog.responseText;
                                }
                                setTimeout(HMGet_CreditsLog, 1000);
                            }
                        }else if(isList)
                        {
                            document.getElementById("CreditsLog").innerHTML
                                = "<p align='center'>没有查询到相关需求</p>";
                        }
                    }
                }
                return false;
            };
            CreditsLog.open("GET",
                "index.php?mod=php_api&action=HMGetFunc&func=CreditsLog&start="
                + CreditsLog_start.toString()
                + "&" + encodeURI(pars), true);
            CreditsLog.send();
            return true;
        }
    }else {
        setTimeout(HMGet_CreditsLog, 1000);
    }
}
