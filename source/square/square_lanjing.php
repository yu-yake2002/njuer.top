<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200922, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!isset($_GET['do']) or !in_array($_GET['do'], array("Message", "Attention")))
{
    $_GET['do'] = "Message";
}

if($_GET['do'] == "Message") {
    $token = substr(md5($_G['user']['uid'] . "J2L@ma0-2"), 6, 18);
}

if($_GET['do'] == "Attention") {
    $attentions = db_query("SELECT attention FROM home_attention WHERE uid = {$_G['user']['uid']}");
}

include template("app_style/{$_G['user']['style']}:square:lanjing");
?>