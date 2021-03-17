<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function mail_show_uid($uid)
{
    global $_G;
    if($uid == $_G['user']['uid'])
    {
        return $_G['user']['uid'];
    }
    if(!db_fetch(db_query("SELECT uid FROM activity_mail_vote WHERE uid = {$_G['user']['uid']} AND letter_authorid = {$uid}")))
    {
        return "匿名".substr(md5($uid.md5(934)), 0, 6);
    }
    if(!db_fetch(db_query("SELECT uid FROM activity_mail_vote WHERE uid = {$uid} AND letter_authorid = {$_G['user']['uid']}")))
    {
        return "匿名".substr(md5($uid.md5(934)), 0, 6);
    }
    return $uid;
}

if(!in_array($_GET['step'], array(
    'box', 'myBox', 'letter', 'mysent'
))) {
    $step = "box";
}else{
    $step = $_GET['step'];
}

include_once "source/square/square_match_mail_{$step}.php";

?>