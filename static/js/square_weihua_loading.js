var WeiHuaList_start = 0;
function square_WeiHuaList(pars, isList=false)
{
    var Height = document.getElementById("WeiHuaList").offsetWidth;
    var scrollHeight = document.getElementById("WeiHuaList").scrollWidth;
    var scrollTop = document.getElementById("WeiHuaList").scrollLeft;
    if (Math.abs(scrollTop - scrollHeight + Height) <= 1000 || Height == scrollHeight) {
        var WeiHuaList=null;
        if (window.XMLHttpRequest)
        {
            WeiHuaList=new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        {
            WeiHuaList=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (WeiHuaList!=null) {
            WeiHuaList.onreadystatechange = function () {
                if (WeiHuaList.readyState == 4) {
                    if (WeiHuaList.status == 200) {
                        if(WeiHuaList.responseText.length >= 5) {
                            if(!isList){
                                document.getElementById("WeiHuaList").innerHTML
                                    += WeiHuaList.responseText;

                                WeiHuaList_start += 10;
                                setTimeout(function () {
                                    square_WeiHuaList(pars, isList);
                                }, 1000);
                            }else{
                                document.getElementById("WeiHuaList").innerHTML
                                    = WeiHuaList.responseText;
                            }
                        }else if(isList)
                        {
                            document.getElementById("WeiHuaList").innerHTML
                                = "<p align='center'>没有查询到相关需求</p>";
                        }
                    }
                }
            };
            WeiHuaList.open("GET",
                "index.php?mod=php_api&action=square&func=WeiHuaList&start="
                + WeiHuaList_start.toString()
                + "&" + encodeURI(pars), true);
            WeiHuaList.send();
            return true;
        }
    }else {
        setTimeout(function () {
            square_WeiHuaList(pars, isList);
        }, 1000);
    }
}