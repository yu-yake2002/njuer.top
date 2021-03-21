<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20210320, By 孙际儒
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function get_classinfo($classnum){
    return db_fetch(db_query("SELECT * FROM class_common WHERE num = $classnum"));
}

$findFriendList = db_query("SELECT * FROM class_findfriend ORDER BY `ffid` DESC");

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