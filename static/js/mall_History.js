var History_start = 0;
function mall_History(pars, isList=false)
{
    var Height = document.getElementById("History").offsetHeight;
    var scrollHeight = document.getElementById("History").scrollHeight;
    var scrollTop = document.getElementById("History").scrollTop;
    if (Math.abs(scrollTop - scrollHeight + Height) <= 50 || Height == scrollHeight) {
        var History=null;
        if (window.XMLHttpRequest)
        {
            History=new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        {
            History=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (History!=null) {
            History.onreadystatechange = function () {
                if (History.readyState == 4) {
                    if (History.status == 200) {
                        if (History.responseText != '') {
                            var newmessage = History.responseText;
                            if (newmessage) {
                                if(!isList){
                                    document.getElementById("History").innerHTML
                                        += History.responseText;
                                    History_start += 10;
                                }else{
                                    document.getElementById("History").innerHTML
                                        = History.responseText;
                                }
                                setTimeout(mall_History, 1000);
                            }
                        }else if(isList)
                        {
                            document.getElementById("History").innerHTML
                                = "<p align='center'>没有查询到相关需求</p>";
                        }
                    }
                }
                return false;
            };
            History.open("GET",
                "index.php?mod=php_api&action=mall&func=History&start="
                + History_start.toString()
                + "&" + encodeURI(pars), true);
            History.send();
        }
    }else {
        setTimeout(mall_History, 1000);
    }
}
