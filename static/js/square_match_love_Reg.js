function Reg() {
    if(document.getElementById("uploaded").value == "True"){
        location.href='index.php?mod=square&action=match&do=Love&r=' + Math.random().toString();
    }
}

var Sex_o_chosen = Array(0,0,0,0,0,0);
function Sex_o_choice(ele, add) {
    if(Sex_o_chosen[add] == 0){
        ele.style.backgroundColor = "#793C65";
        ele.style.color = "#f7ecd8";
        Sex_o_chosen[add] = 1;
    }else{
        ele.style.backgroundColor = "#f7ecd8";
        ele.style.color = "#793C65";
        Sex_o_chosen[add] = 0;
    }
    document.getElementById("sexo").value = Sex_o_chosen.join(",");
}

var Grade_chosen = Array(0,0,0,0);
function Grade_choice(ele, add) {
    if(Grade_chosen[add] == 0){
        ele.style.backgroundColor = "#793C65";
        ele.style.color = "#f7ecd8";
        Grade_chosen[add] = 1;
    }else{
        ele.style.backgroundColor = "#f7ecd8";
        ele.style.color = "#793C65";
        Grade_chosen[add] = 0;
    }
    document.getElementById("grade_o").value = Grade_chosen.join(",");
}

function getValueById(id) {
    return document.getElementById(id).value;
}


function readme() {
    if(getValueById("beauty_o") == 2){
        $.alert("我们并不推荐您选择本项。这意味着您放弃性格匹配的机会，但由于活动人数有限，您并不一定能够匹配到颜值高很多的同学。大多数情况下，轻微颜控即可满足您的需求。");
    }
}

function submit_matchLove() {
    if(getValueById("body_height1") == ""){
        document.getElementById("body_height1").value = "0";
    }
    if(getValueById("body_height2") == ""){
        document.getElementById("body_height2").value = "999";
    }
    if(getValueById("body_weight1") == ""){
        document.getElementById("body_weight1").value = "0";
    }
    if(getValueById("body_weight2") == ""){
        document.getElementById("body_weight2").value = "999";
    }
    if(getValueById("name") == ""){
        $.alert("请输入姓名！");
        return 0;
    }
    if(getValueById("qq") == ""){
        $.alert("请输入QQ！");
        return 0;
    }
    if(getValueById("body_height") == ""){
        $.alert("请输入身高！");
        return 0;
    }
    if(getValueById("intro") == ""){
        $.alert("请输入个人介绍及择偶标准！");
        return 0;
    }
    if(getValueById("sexo") == "" || getValueById("sexo") == "0,0,0,0,0,0"){
        $.alert("请选择性取向！");
        return 0;
    }
    if(getValueById("grade_o") == "" || getValueById("grade_o") == "0,0,0,0"){
        $.alert("请选择年级要求！");
        return 0;
    }
    $.confirm({
        text: "<font color='red'>报名表一经提交将无法撤回或者修改。</font>您确认要提交报名表吗？",
        onOK: function () {
            $.alert({
                text: "祝您在本次活动中有一段愉快的七日恋爱经历，也希望您能够在活动开始后对活动和匹配对象负责，不要中途退出。",
                onOK:function () {
                    document.getElementById("RegTable").submit();
                }
            });
        }
    });
}