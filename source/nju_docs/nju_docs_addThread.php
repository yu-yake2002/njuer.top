<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['fid']) && is_numeric($_GET['fid'])) {
    $fid = $_GET['fid'];
}else {
    $fid = 1;
}

$forum = db_fetch(db_query("SELECT * FROM forum_class WHERE cid = {$fid}"));
if(!$forum){
    $fid = 1;
    $forum = db_fetch(db_query("SELECT * FROM forum_class WHERE cid = 1"));
}

if(isset($_GET['tid']) && is_numeric($_GET['tid'])){
    if (isset($_POST['contents'])) {
        db_update("forum_threads", array(
            'time' => time()
        ), "tid = {$_GET['tid']}");
        db_insert("forum_post", array(
            'time' => time(),
            'likes' => 0,
            'tid' => db_fetch(db_query("SELECT tid FROM forum_threads ORDER BY tid DESC"))['tid'],
            'contents' => $_POST['contents'],
            'uid' => $_G['user']['uid']
        ));
        CORE_GOTOURL("index.php?mod=nju_docs&action=communication&tid={$_GET['tid']}&fid={$forum['cid']}");
    }
}else {
    if (isset($_POST['subject'])
        && isset($_POST['contents'])) {
        if (!isset($_POST['credits']) || !is_numeric($_POST['credits'])) {
            $_POST['credits'] = 0;
        }
        if ($_G['user']['credits']['credits'] <= $_POST['credits']) {
            $_POST['credits'] = $_G['user']['credits']['credits'];
        }
        if ($_POST['credits'] < 0) {
            $_POST['credits'] = 0;
        }
        db_update("forum_class", array('time' => time(), 'threads' => $forum['threads'] + 1), "cid = {$forum['cid']}");
        db_insert("forum_threads", array(
            'time' => time(),
            'createTime' => time(),
            'subject' => $_POST['subject'],
            'credits' => ($_POST['question'] == 1)?$_POST['credits']:0,
            'likes' => 0,
            'fid' => $forum['cid'],
            'contents' => $_POST['contents'],
            'uid' => $_G['user']['uid'],
            'academy' => $_POST['academy'],
            'question' => $_POST['question']
        ));
        db_insert("forum_post", array(
            'time' => time(),
            'likes' => 0,
            'tid' => db_fetch(db_query("SELECT tid FROM forum_threads ORDER BY tid DESC"))['tid'],
            'contents' => $_POST['contents'],
            'uid' => $_G['user']['uid']
        ));
        credits_update($_G['user']['uid'], -$_POST['credits'], "悬赏消费积分");
        CORE_GOTOURL("index.php?mod=nju_docs&action=communication&fid={$forum['cid']}");
    }
}

include template("app/nju_docs:addThread");

?>