
var ClassItemStep = 1;
function ClassItem(addstep){
    ClassItemStep += addstep;
    ShowStep();
    if(ClassItemStep <= 9) {
        document.getElementById('NowStep').innerHTML = ClassItemStep;
    }
    return true;
}

function ShowStep(){
    for (i = 1; i <= 9; i++) {
        if(i == ClassItemStep) {
            document.getElementById("ClassItemStepDiv" + i.toString()).style.visibility = "visible";
            document.getElementById("ClassItemStepDiv" + i.toString()).style.display = "block";
        }else{
            document.getElementById("ClassItemStepDiv" + i.toString()).style.visibility = "hidden";
            document.getElementById("ClassItemStepDiv" + i.toString()).style.display = "none";
        }
    }
    if(ClassItemStep == 1){
        document.getElementById("classlist-window_btn1").innerHTML = '取消';
        document.getElementById("classlist-window_btn2").innerHTML = '下一项';
    }else if(ClassItemStep == 9){
        document.getElementById("classlist-window_btn1").innerHTML = '上一项';
        document.getElementById("classlist-window_btn2").innerHTML = '确认';
    }else{
        document.getElementById("classlist-window_btn1").innerHTML = '上一项';
        document.getElementById("classlist-window_btn2").innerHTML = '下一项';
    }
    if(ClassItemStep <= 0){
        document.getElementById("ClassItemStepDiv_Err").style.visibility = 'hidden';
        CloseClassWindow();
    }
    if(ClassItemStep >= 10){
        $.confirm({
            title: '是否确认提交',
            text: '请注意：恶意评价课程可能导致您被没收积分并封号。',
            onOK: PostRemark
        });
    }
    return ClassItemStep;
}

function remarkchange(name, newvalue)
{
    document.getElementById(name).value = newvalue;
    document.getElementById(name + '3').value = newvalue;
    document.getElementById(name + '2').innerHTML = newvalue;
}

function add_to_others(keywords, givevalue) {
    document.getElementById('others').value += '关于' + keywords + ':' + givevalue + '\n';
    document.getElementById('others_words').innerHTML = document.getElementById('others').value.length;
}
function PostRemark() {
    to_post_knowledge = document.getElementById('knowledge').value;
    to_post_marks = document.getElementById('marks').value;
    to_post_gains = document.getElementById('gains').value;
    to_post_teacher = document.getElementById('teacher').value;
    to_post_costtime = document.getElementById('costtime').value;
    to_post_exam = document.getElementById('exam').value;
    to_post_special = document.getElementById('special').value;
    to_post_others = document.getElementById('others').value;
    to_post_time = document.getElementById('blankingtime').value;
    classid = document.getElementById('RemarkCid').value;
    if(to_post_knowledge
        && to_post_marks
        && to_post_gains
        && to_post_teacher
        && to_post_costtime
        && to_post_exam){
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
                //document.write(xmlhttp.responseText);
                CloseClassWindow();
                window.history.go(0);
            }
        };
        xmlhttp.open("POST", "index.php?mod=php_api&action=rankList_class&func=update");
        xmlhttp.setRequestHeader("Content-Type"
            , "application/x-www-form-urlencoded");
        xmlhttp.send(
            "classid=" + encodeURI(classid) +
            "&knowledge=" + encodeURI(to_post_knowledge) +
            "&marks=" + encodeURI(to_post_marks) +
            "&gains=" + encodeURI(to_post_gains) +
            "&teacher=" + encodeURI(to_post_teacher) +
            "&costtime=" + encodeURI(to_post_costtime) +
            "&exam=" + encodeURI(to_post_exam) +
            "&special=" + encodeURI(to_post_special) +
            "&others=" + encodeURI(to_post_others) +
            "&blanking=" + encodeURI(to_post_time)
        );
    }else{
        document.getElementById("ClassItemStepDiv_Err").style.visibility = 'visible';
        document.getElementById("ClassItemStepDiv_Err").style.display = 'block';
        document.getElementById('classlist-window_btn1').innerHTML = '返回';
        document.getElementById('classlist-window_btn2').innerHTML = '';
    }
}
function CloseClassWindow() {
    document.getElementById("window").style.visibility = "hidden";
}


function RemarkClass(classid) {
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
                document.getElementById("window").innerHTML = xmlhttp.responseText;
                ClassItemStep = 1;
                ShowStep();
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
            }
            document.getElementById("window").style.visibility = "visible";
        }
    };
    xmlhttp.open("GET", "index.php?mod=php_api&action=rankList_class&func=RemarkClass&ClassId=" + classid);
    xmlhttp.send();
}

function AskClass(classid) {
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
            document.getElementById("window").innerHTML = xmlhttp.responseText;
            document.getElementById("window").style.visibility = "visible";
        }
    };
    xmlhttp.open("GET", "index.php?mod=core&action=AskClass&ClassId=" + classid);
    xmlhttp.send();
}

function PostAsk(classid){
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
            location.href="index.php?mod=user&action=interaction_message&rid=29&on_app=true";
        }
    };
    xmlhttp.open("GET", "index.php?mod=core&action=update&type=15&ClassId="
        + document.getElementById('AskCid').value
        + "&question=" + document.getElementById("question").value);
    xmlhttp.send();
}