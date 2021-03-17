<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$isB = (substr($_G['user']['mobile'], 0, 1) == "1"
    || substr($_G['user']['mobile'], 0, 1) == "2");

if(time() >= $BeginAct){
    CORE_GOTOURL("index.php?mod=square&action=match&do=Love&step=result");
}

if($Reg['state'] >= 5 && isset($_POST["new_intro"]) && $_POST["new_intro"] != $Reg['intro']){
    db_update("square_match_love_reg", array(
        'intro' => $_POST["new_intro"],
        'state' => $Reg['state'] - 2
    ), "regid = {$Reg['regid']}");
    $Reg['intro'] = $_POST["new_intro"];
}

if($Reg['editable'] && isset($_GET['rewrite']) && $_GET['rewrite'] == "true"){
    db_update("square_match_love_reg", array(
        'state' => 2
    ), "regid = {$Reg['regid']}");
    $Reg['state'] = 2;
}

if($Reg['state'] == 2
    && isset($_POST["name"])
    && isset($_POST["body_height"])
    && isset($_POST["body_weight"])
    && isset($_POST["sexo"])
    && isset($_POST["grade_o"])
    && isset($_POST["qq"])
    && isset($_POST["body_height1"])
    && isset($_POST["body_height2"])
    && isset($_POST["body_weight1"])
    && isset($_POST["body_weight2"])
    && isset($_POST["accept"])
    && isset($_POST["intro"])){
    if(!$_POST["body_height1"])
        $_POST["body_height1"] = 0;
    if(!$_POST["body_height2"])
        $_POST["body_height2"] = 999;
    if(!$_POST["body_weight1"])
        $_POST["body_weight1"] = 0;
    if(!$_POST["body_weight2"])
        $_POST["body_weight2"] = 999;
    if(!$_POST["body_weight"])
        $_POST["body_weight"] = 999;
    if(!$_POST["beauty_m"])
        $_POST["beauty_m"] = $Reg['beauty_m'];
    $bmi = $_POST["body_weight"] / pow($_POST["body_height"] / 100, 2);
    db_update("square_match_love_reg", array(
        'state' => 3,
        'name' => $_POST["name"],
        'sexo' => $_POST["sexo"],
        'qq' => $_POST["qq"],
        'body_height' => $_POST["body_height"],
        'body_weight' => $_POST["body_weight"],
        'bmi' => $bmi,
        'min_bh' => $_POST["body_height1"],
        'max_bh' => $_POST["body_height2"],
        'min_bw' => $_POST["body_weight1"],
        'max_bw' => $_POST["body_weight2"],
        'grade_o' => $_POST["grade_o"],
        'beauty_o' => $_POST["beauty_o"],
        'beauty_self' => $_POST["beauty_m"],
        'intro' => $_POST["intro"],
        'accept' => $_POST["accept"]
    ), "regid = {$Reg['regid']}");
    $Reg['state'] = 3;
    CORE_GOTOURL("index.php?mod=square&action=match&do=Love&r=".rand(1, 50));
}

if(isset($_GET['return'])){
    $Reg['state'] = 1;
}

include template("app/square:match_love_reg");
?>