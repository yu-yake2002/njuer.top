<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

//if(isset($_GET['setmode']) && $_GET['setmode'] == "eve"){
//    setcookie("mode", 1);
//    $_COOKIE["mode"] = 1;
//}elseif(isset($_GET['setmode']) && $_GET['setmode'] == "day"){
//    setcookie("mode", 0, time() - 1);
//    $_COOKIE["mode"] = 0;
//}


if($_G['user']['loginned']){
    if(isset($_COOKIE["firstcome"]))
    {
        setcookie("firstcome", 1, time() - 3600);
        $firstcome = 1;
    }

    include template("app/rankList_class:class");
}else{
    CORE_GOTOURL("index.php?mod=user&action=login");
}

if(rand(0, 9) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 1), array("uid" => $_G['user']['uid']));
    $add_chance = 1;
}elseif(rand(0, 29) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 2), array("uid" => $_G['user']['uid']));
    $add_chance = 2;
}elseif(rand(0, 59) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 5), array("uid" => $_G['user']['uid']));
    $add_chance = 5;
}elseif(rand(0, 199) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 10), array("uid" => $_G['user']['uid']));
    $add_chance = 10;
}elseif(rand(0, 999) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 10), array("uid" => $_G['user']['uid']));
    $add_chance = 20;
}elseif(rand(0, 1699) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 10), array("uid" => $_G['user']['uid']));
    $add_chance = 30;
}

?>