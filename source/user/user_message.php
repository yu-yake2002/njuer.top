<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20201001, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$_G['FullScreen'] = true;

if(!$_G['user']['loginned']){
    CORE_GOTOURL("index.php?mod=user&action=login");
}

if(!isset($_GET['uid'])) {
    CORE_GOTOURL("index.php");
}

$query = db_query("SELECT * FROM common_user_sign WHERE uid = {$_GET['uid']}");
$to_user = db_fetch($query);
$to_user['profile'] = db_fetch(db_query("select * from user_profile where uid={$to_user['uid']}"));
$to_user['avatar'] = $to_user['profile']['avatar']?$to_user['profile']['avatar']:"data/avatar/common.png";

if(!$to_user){
    CORE_GOTOURL("index.php");
}

$token = substr(md5($_G['user']['uid']."J2L@ma0".$to_user['uid']), 6, 18);

if(rand(0, 19) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 1), array("uid" => $_G['user']['uid']));
    $add_chance = 1;
}elseif(rand(0, 39) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 2), array("uid" => $_G['user']['uid']));
    $add_chance = 2;
}elseif(rand(0, 69) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 5), array("uid" => $_G['user']['uid']));
    $add_chance = 5;
}elseif(rand(0, 169) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 10), array("uid" => $_G['user']['uid']));
    $add_chance = 10;
}elseif(rand(0, 1699) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 10), array("uid" => $_G['user']['uid']));
    $add_chance = 20;
}elseif(rand(0, 5699) == 9 && time() <= 1613059199){
    db_add("activity_year_chance", array("chance" => 10), array("uid" => $_G['user']['uid']));
    $add_chance = 30;
}

include template("app_style/{$_G['user']['style']}:user:message");

?>