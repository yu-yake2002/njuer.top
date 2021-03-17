<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!isset($_GET['cid'])){
    CORE_GOTOURL("index.php");
}
$cid = $_GET['cid'];
$classinfo = db_fetch(db_query("SELECT * FROM class_common WHERE classid = $cid"));
if(!$classinfo){
    CORE_GOTOURL("index.php");
}

if($classinfo['admin'] != $_G['user']['uid']){
    CORE_GOTOURL("index.php?mod=myClass");
}

$forums = db_query("SELECT `cid`, `name` FROM forum_class WHERE `close` = 0;");

if(!$classinfo['docs']){
    $folder = db_fetch(db_query("SELECT * FROM docs_file WHERE father = 1 AND `name`=\"{$classinfo['name']}\""));
    if(!$folder) {
        db_insert('docs_file', array(
            'name' => $classinfo['name'],
            'father' => 1,
            'type' => 1,
            'pwd' => '123456',
            'credits' => 0,
            'updateTime' => time(),
            'downloads' => 0,
            'allowPDF' => 1,
            'allowFolder' => 1,
            'uid' => $_G['user']['uid']
        ));
        $folder = db_fetch(db_query("SELECT * FROM docs_file WHERE father = 1 AND `name`=\"{$classinfo['name']}\""));
    }
    db_update("class_common", array('docs' => $folder['id']), "classid=$cid");
}

include template("app/myClass:admin");

?>