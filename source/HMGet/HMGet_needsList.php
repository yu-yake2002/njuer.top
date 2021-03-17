<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200906, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$queue = db_count(db_query("SELECT uid FROM HMGet_getRequest WHERE got_num < num AND time > ".time()));

if(isset($_GET['do'])
    && $_GET['do'] == "GetRequest") {
    $getRequest = db_fetch(db_query("SELECT * FROM HMGet_getRequest WHERE uid = {$_G['user']['uid']}"));
    if($getRequest && ($getRequest['got_num'] == $getRequest['num'] || $getRequest['time'] <= time())){
        $getRequest = array();
    }

    if (!$getRequest
        && isset($_POST["start"])
        && isset($_POST["num"])
        && isset($_POST["credits"])
        && isset($_POST["time"])
        && isset($_POST["stop"])){
        db_update("HMGet_getRequest", array('start' => $_POST["start"],
            'stop' => $_POST["stop"],
            'time' => strtotime(date("Y-m-d", time()) . " {$_POST["time"]}:00"),
            'got_num' => 0,
            'num' => $_POST["num"],
            'credits' => $_POST["credits"],
            'queue' => time()
        ), array('uid' => $_G['user']['uid']), true);
    }

    $getRequest = db_fetch(db_query("SELECT * FROM HMGet_getRequest WHERE uid = {$_G['user']['uid']}"));
    if($getRequest && ($getRequest['got_num'] == $getRequest['num'] || $getRequest['time'] <= time())){
        $getRequest = array();
    }
}

include template("app/HMGet:needsList");
?>