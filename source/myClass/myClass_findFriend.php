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

$classList = db_query("SELECT cid, subscribe FROM class_user WHERE uid = {$_G['user']['uid']} AND (state = 1 OR state = 2) ORDER BY `time` DESC");
$findFriendList = db_query("SELECT * FROM class_findfriend WHERE cid IN (SELECT cid FROM class_user WHERE uid = {$_G['user']['uid']} AND (state = 1 OR state = 2)) ORDER BY `ffid` DESC");


$getSex = array(
    '',
    '男',
    '女',
    '男(跨性别)',
    '女(跨性别)',
    '保密'
);

include template("app/myClass:findFriend");

?>