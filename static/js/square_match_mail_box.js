function Grade_choice(ele, add) {
    if(document.getElementById("grade" + add.toString()).value == "0"){
        ele.style.backgroundColor = "#793C65";
        ele.style.color = "#f7ecd8";
        document.getElementById("grade" + add.toString()).value = "1";
    }else{
        ele.style.backgroundColor = "#f7ecd8";
        ele.style.color = "#793C65";
        document.getElementById("grade" + add.toString()).value = "0";
    }
}