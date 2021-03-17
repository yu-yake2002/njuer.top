function OpenClass(classid) {
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            if(xmlhttp.responseText){
                location.href="index.php?mod=php_api&action=rankList_class&func=OpenClass&ClassId=" + classid;
            }else{
                document.getElementById("window").innerHTML = "\n" +
                    "    <table id=\"window_contents\" class=\"classlist-window_contents\" height=\"100%\" width=\"100%\">\n" +
                    "        <tr>\n" +
                    "            <td class=\"classlist-window_header\" id=\"window_contents_header\" height=\"15%\" colspan=\"2\">\n" +
                    "\n" +
                    "            </td>\n" +
                    "        </tr>\n" +
                    "        <tr>\n" +
                    "            <td class=\"classlist-window_p\" id=\"window_contents_p\" height=\"75%\" align=\"center\" colspan=\"2\">\n" +
                    "\n" +
                    "            </td>\n" +
                    "        </tr>\n" +
                    "        <tr class=\"classlist-window_btn\">\n" +
                    "            <td height=\"10%\" align=\"center\" width=\"50%\" class=\"classlist-window_btn1\">\n" +
                    "                <a href=\"javascript:;\" onclick=\"CloseClassWindow();\" id=\"classlist-window_btn1\" class=\"classlist-window_btn1_font\">取消</a>\n" +
                    "            </td>\n" +
                    "            <td align=\"center\" width=\"50%\" class=\"classlist-window_btn2\">\n" +
                    "                <a href=\"javascript:;\" onclick=\"CloseClassWindow();\" id=\"classlist-window_btn2\" class=\"classlist-window_btn2_font\">确认</a>\n" +
                    "            </td>\n" +
                    "        </tr>\n" +
                    "    </table>";
                document.getElementById("window_contents_header").innerHTML = '错误提示';
                document.getElementById("window_contents_p").innerHTML = '没有找到相关课程';
                document.getElementById("window").style.visibility = "visible";
            }
        }
    };
    xmlhttp.open("GET", "index.php?mod=core&action=OpenClass&ClassId=" + classid);
    xmlhttp.send();
}