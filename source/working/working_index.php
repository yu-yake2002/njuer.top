<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['sign']) && isset($_POST["key"]) && is_numeric($_GET['sign'])){
    $Meet = get_meet($_GET['sign']);
    $query = db_query("SELECT * FROM org_meeting_sign WHERE uid = {$_G['user']['uid']} AND meetid = {$_GET['sign']}");
    $UserMeet = db_fetch($query);
    if($Meet['state'] == 2 && $Meet['key'] == $_POST["key"] && $UserMeet && $UserMeet['state'] == 0){
        if($Meet['uid'] == $_G['user']['uid']){
            db_update("org_meeting_sign", array(
                'state' => 2
            ), "uid = {$_G['user']['uid']}");
        }else {
            db_update("org_meeting_sign", array(
                'state' => 1
            ), "uid = {$_G['user']['uid']}");
        }
        db_update("org_user", array(
            'credits' => $OrgUser['credits'] + $Meet['credits']
        ), "uid = {$_G['user']['uid']}");
        db_insert("org_user_credits", array(
            'uoid' => $OrgUser['uoid'],
            'credits' => $Meet['credits'],
            'reason' => "签到成功，会议号: {$Meet['meetid']}",
            'time' => time()
        ));
    }
}

if(isset($_GET['notice']) && is_numeric($_GET['notice'])){
    $Meet = get_meet($_GET['notice']);
    if($Meet['uid'] == $_G['user']['uid']){
        $query = db_query("SELECT uid, name FROM org_user WHERE oid = {$Meet['oid']}");
        while($meet_user = db_fetch($query)){
            db_update("org_meeting_sign", array(
                'state' => 0,
                'name' => $meet_user['name']
            ), array(
                'uid' => $meet_user['uid'],
                'meetid' => $_GET['notice']), true);
        }
        db_update("org_meeting", array(
            'state' => 1
        ), "meetid = {$_GET['notice']}");
    }
}

if(isset($_GET['beginSign']) && is_numeric($_GET['beginSign'])){
    $Meet = get_meet($_GET['beginSign']);
    if($Meet['uid'] == $_G['user']['uid']){
        db_update("org_meeting", array(
            'state' => 2,
            'key' => rand(100000, 999999)
        ), "meetid = {$_GET['beginSign']}");
    }
}

if(isset($_GET['endSign']) && is_numeric($_GET['endSign'])){
    $Meet = get_meet($_GET['endSign']);
    if($Meet['uid'] == $_G['user']['uid']){
        db_update("org_meeting", array(
            'state' => 3
        ), "meetid = {$_GET['endSign']}");
    }
}

$query = db_query("SELECT * FROM org_meeting_sign WHERE (uid = {$_G['user']['uid']} AND state != 1) order by `meetid` desc");

include template("app/working:index");

?>