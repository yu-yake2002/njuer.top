<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$open = false;

if(isset($_GET['fid']) && is_numeric($_GET['fid'])) {
    $fid = $_GET['fid'];
}else {
    $fid = 1;
}

if(isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
}else {
    $page = 0;
}

$forum = db_fetch(db_query("SELECT * FROM forum_class WHERE cid = {$fid}"));
if(!$forum){
    $fid = 1;
    $forum = db_fetch(db_query("SELECT * FROM forum_class WHERE cid = 1"));
}
$query = db_query("SELECT * FROM forum_class WHERE father = {$fid} ORDER BY `order` ASC, cid DESC");
if(isset($_GET['tid']) && is_numeric($_GET['tid'])){
    $thread = db_fetch(db_query("SELECT * FROM forum_threads WHERE tid = {$_GET['tid']}"));
    $query_thread = db_query("SELECT * FROM forum_post WHERE tid = {$_GET['tid']} ORDER BY `time` ASC LIMIT {$page}, 30");
    $open = true;
}else {
    $condition_question = "1";
    $condition_academy = "1";
    if(isset($_GET['class'])){
        $academy = $_GET['class'];
        if($academy) {
            $condition_academy = "`academy` = $academy";
        }
    }
    if(isset($_GET['question'])){
        $question = $_GET['question'];
        if($question) {
            $condition_question = "`question` = $question";
        }
    }

    $query_thread = db_query("SELECT * FROM forum_threads WHERE fid = {$fid} AND $condition_academy AND $condition_question ORDER BY `time` DESC LIMIT {$page}, 30");
}


include template("app/nju_docs:communication");

?>