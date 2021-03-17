var DingLiList_start = 0;
function square_DingLiList(pars, isList=false)
{
    var Height = document.getElementById("DingLiList").offsetWidth;
    var scrollHeight = document.getElementById("DingLiList").scrollWidth;
    var scrollTop = document.getElementById("DingLiList").scrollLeft;
    if (Math.abs(scrollTop - scrollHeight + Height) <= 1000 || Height == scrollHeight) {
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
                            if(!isList){
                                document.getElementById("DingLiList").innerHTML
                                    += DingLiList.responseText;

                                DingLiList_start += 10;
                                setTimeout(function () {
                                    square_DingLiList(pars, isList);
                                }, 1000);
                            }else{
                                document.getElementById("DingLiList").innerHTML
                                    = DingLiList.responseText;
                            }
                        }else if(isList)
                        {
                            document.getElementById("DingLiList").innerHTML
                                = "<p align='center'>没有查询到相关需求</p>";
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