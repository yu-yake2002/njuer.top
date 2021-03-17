var RequestList_start = 0;
function HMGet_RequestList(pars, isList=false)
{
    var Height = document.getElementById("RequestList").offsetHeight;
    var scrollHeight = document.getElementById("RequestList").scrollHeight;
    var scrollTop = document.getElementById("RequestList").scrollTop;
    if (Math.abs(scrollTop - scrollHeight + Height) <= 50 || Height == scrollHeight) {
        var RequestList=null;
        if (window.XMLHttpRequest)
        {
            RequestList=new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        {
            RequestList=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (RequestList!=null) {
            RequestList.onreadystatechange = function () {
                if (RequestList.readyState == 4) {
                    if (RequestList.status == 200) {
                        if (RequestList.responseText != '') {
                            if(!isList){
                                document.getElementById("RequestList").innerHTML
                                    += RequestList.responseText;
                                RequestList_start += 10;
                                setTimeout(function () {
                                    HMGet_RequestList(pars, isList);
                                }, 1000);
                            }else{
                                document.getElementById("RequestList").innerHTML
                                    = RequestList.responseText;
                            }
                        }else if(isList)
                        {
                            document.getElementById("RequestList").innerHTML
                                = "<p align='center'>没有查询到相关需求</p>";
                        }
                    }
                }
            };
            RequestList.open("GET",
                "index.php?mod=php_api&action=HMGetFunc&func=RequestList&start="
                + RequestList_start.toString()
                + "&" + encodeURI(pars), true);
            RequestList.send();
            return true;
        }
    }else {
        setTimeout(function () {
            HMGet_RequestList(pars, isList);
        }, 1000);
    }
}
