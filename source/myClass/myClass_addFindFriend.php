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

if(isset($_POST["contents"])){
    db_insert("class_findfriend",array(
        'classnum' => $_POST["classnum"],
        'uid' => $_G['user']['uid'],
        'uname' => $_POST["uname"],
        'intro' => $_POST["contents"],
        'gender' => $_POST["sex"],
        'grade' => $_POST["grade"],
        'department' => $_POST["department"]
    ));
    CORE_GOTOURL("index.php?mod=myClass&action=findFriend");
}

include template("app/myClass:addfindFriend");

?>