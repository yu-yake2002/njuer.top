var DingLiList_start = 0;
function square_DingLiList(pars, isList=false)
{
    var Height = document.body.offsetHeight;
    var windowHeight = window.screen.height;
    var scrollTop = document.body.scrollTop;
    if (Math.abs(Height - scrollTop - windowHeight) <= 1000 || Height == windowHeight) {
        var DingLiList=null;
        if (window.XMLHttpRequest)
        {
            DingLiList=new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        {
            DingLiList=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (DingLiList!=null) {
            DingLiList.onreadystatechange = function () {
                if (DingLiList.readyState == 4) {
                    if (DingLiList.status == 200) {
                        if(DingLiList.responseText.length >= 5) {
                            document.getElementById("DingLiList").innerHTML
                                += DingLiList.responseText;

                            DingLiList_start += 10;
                            setTimeout(function () {
                                square_DingLiList(pars, isList);
                            }, 1000);
                        }else{
                            document.getElementById("loading_hint").innerHTML = "已经没有更多啦~";
                        }
                    }
                }
            };
            DingLiList.open("GET",
                "index.php?mod=php_api&action=square&func=DingLiList&start="
                + DingLiList_start.toString()
                + "&" + encodeURI(pars), true);
            DingLiList.send();
            return true;
        }
    }else {
        setTimeout(function () {
            square_DingLiList(pars, isList);
        }, 1000);
    }
}