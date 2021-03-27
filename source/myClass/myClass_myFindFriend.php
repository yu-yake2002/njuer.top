<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20210320, By 孙际儒
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function get_classinfo($cid){
    return db_fetch(db_query("SELECT * FROM class_common WHERE classid = $cid"));
}

$mySex = array(
    '',
    '男',
    '女',
    '男(跨性别)',
    '女(跨性别)',
    '保密'
);

$myFindFriendList = db_query("SELECT * FROM class_findfriend WHERE uid = {$_G['user']['uid']} ORDER BY `ffid` DESC");

include template("app/myClass:myFindFriend");

?>