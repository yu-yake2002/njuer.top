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

if(isset($_POST["contents"])){
    $classinfo = get_classinfo($_POST["cid"]);
    db_insert("class_findfriend",array(
        'classname' => $classinfo["name"],
        'cid' => $_POST["cid"],
        'uid' => $_G['user']['uid'],
        'uname' => $_POST["uname"]?$_POST["uname"]:"匿名",
        'intro' => $_POST["contents"],
        'gender' => $_POST["sex"],
        'grade' => $_POST["grade"]?$_POST["grade"]:"保密",
        'department' => $_POST["department"]?$_POST["department"]:"保密"
    ));
    CORE_GOTOURL("index.php?mod=myClass&action=findFriend");
}

include template("app/myClass:addfindFriend");

?>