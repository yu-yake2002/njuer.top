<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function get_classinfo($cid){
    return db_fetch(db_query("SELECT * FROM class_common WHERE classid = $cid"));
}

$classList = db_query("SELECT cid, subscribe FROM class_user WHERE uid = {$_G['user']['uid']} AND (state = 1 OR state = 2) ORDER BY `time` DESC");

include template("app/myClass:list");

?>