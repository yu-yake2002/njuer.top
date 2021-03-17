<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_POST["name"])
    && isset($_POST["people_limit"])
    && isset($_POST["contents"])
    && isset($_POST["mobile"])
    && is_numeric($_POST["people_limit"])){
    $token = md5(time().md5("sj812")).
        md5(md5(rand(1,999999)).md5($_G['user']['uid']).md5(time()));
    db_insert("square_match_out_groups",array(
        'name' => $_POST["name"],
        'people' => 1,
        'contents' => $_POST["contents"],
        'people_limit' => $_POST["people_limit"],
        'token' => $token
    ));
    $gid = db_fetch(db_query("SELECT gid FROM square_match_out_groups WHERE token='$token' ORDER BY gid DESC"))['gid'];
    db_insert("square_match_out", array(
        'uid' => $_G['user']['uid'],
        'gid' => $gid,
        'time' => time(),
        'mobile' => $_POST["mobile"],
        'others' => $_POST["others"]?$_POST["others"]:"空",
        'name' => $_POST["uname"]?$_POST["uname"]:"匿名",
        'sex' => $_POST["sex"],
        'sexo' => $_POST["sexo"]
    ));
    CORE_GOTOURL("index.php?mod=square&action=match&do=out");
}

include template("app/square:match_addOut");
?>