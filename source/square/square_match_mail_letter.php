<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['id']) && is_numeric($_GET['id']))
{
    db_update("activity_mail_received", array('read' => 1), "lid = {$_GET['id']} AND uid = {$_G['user']['uid']}");
    $letter_received = db_fetch(db_query("SELECT * FROM activity_mail_received WHERE lid = {$_GET['id']} AND uid = {$_G['user']['uid']}"));
    if($letter_received)
    {
        $letter = db_fetch(db_query("SELECT * FROM activity_mail_letter WHERE letterid = {$_GET['id']}"));
    }else{
        $letter = db_fetch(db_query("SELECT * FROM activity_mail_letter WHERE letterid = {$_GET['id']}"));
        if($letter['open'] != 1 && $letter['uid'] != $_G['user']['uid'])
        {
            $letter_received = array();
            $letter = array();
        }
    }
}
if(isset($_GET['known']) && $letter_received && $letter)
{
    db_update("activity_mail_received", array(
        'known' => 1
    ), "rid = {$letter_received['rid']}");
    db_insert("activity_mail_vote", array(
        'uid' => $_G['user']['uid'],
        'letter_id' => $letter_received['lid'],
        'letter_authorid' => $letter['uid'],
        'type' => 4,
        'time' => time()
    ));
    if(mail_show_uid($letter['uid']) == $letter['uid']){
        send_user_mail($letter['uid'], "恭喜您与用户 {$_G['user']['uid']} 互相希望认识！");
        send_user_mail($_G['user']['uid'], "恭喜您与用户 {$letter['uid']} 互相希望认识！");
    }
    CORE_GOTOURL("index.php?mod=square&action=match&do=mail&step=letter&id={$letter['letterid']}&r=".rand(1, 50));
}
if(isset($_GET['share']) && $letter_received && $letter)
{
    if($letter['allowShared'] > 0 && $letter['open'] != 1 && $letter['uid'] != $_G['user']['uid'])
    {
        db_update("activity_mail_letter", array(
            'open' => 1
        ), "letterid = {$letter_received['lid']}");
        db_update("user_action", array(), array(
            'type' => 1,
            'uid' => $_G['user']['uid'],
            'obj' => $letter_received['lid'],
            'time' => time(),
            'hide' => 3,
            'stick' => 0
        ), true);
        send_user_mail($letter['uid'], "您的信件(信件号: {$letter_received['lid']})已被收件号为 {$letter_received['rid']} 的收信人分享。");
    }
    CORE_GOTOURL("index.php?mod=square&action=match&do=mail&step=letter&id={$letter['letterid']}&r=".rand(1, 50));
}

if(isset($_POST["title"]) && isset($_POST["contents"]) && $_POST["contents"] && $letter_received && $letter)
{
    if(!$_POST["title"])
    {
        $_POST["title"] = "无题";
    }
    db_insert("activity_mail_letter", array(
        'received' => 1,
        'plimit' => 1,
        'title' => $_POST['title'],
        'contents' => $_POST['contents'],
        'gender' => 0,
        'grade1' => 1,
        'grade2' => 1,
        'grade3' => 1,
        'grade4' => 1,
        'grade5' => 1,
        'open' => 0,
        'allowShared' => $_POST["allowShared"],
        'time' => time(),
        'uid' => $_G['user']['uid']
    ));
    db_update("activity_mail_received", array(
        'replied' => 1
    ), "rid = {$letter_received['rid']}");
    if(!preg_match("/\{img([^\}]*)\}/i", $_POST['contents'], $imgid)){
        $imgid = 0;
    }else{
        $imgid = $imgid[1];
    }
    db_insert("activity_mail_received", array(
        'uid' => $letter['uid'],
        'lid' => db_fetch(db_query("SELECT letterid FROM activity_mail_letter WHERE uid = {$_G['user']['uid']} ORDER BY letterid DESC"))['letterid'],
        'read' => 0,
        'time' => time(),
        'subject' => $_POST['title'],
        'abstract' => substr(preg_replace("/\{img([^\}]*)\}/i", "", $_POST['contents']), 0, 300),
        'replied' => 0,
        'image' => $imgid,
        'known' => 0,
        'type' => 2
    ));
    CORE_GOTOURL("index.php?mod=square&action=match&do=mail&step=letter&id={$letter['letterid']}&r=".rand(1, 50));
}

$letter['contents'] = show_image($letter['contents']);
$grade = $_SETTINGS['year'] - $_G['user']['profile']['grade'] + 1;

if(isset($_GET['collect'])
    && !$letter_received
    && $letter["grade$grade"]
    && ($letter['gender'] == 0 || $letter['gender'] == $_G['user']['profile']['gender'])) {
    mail_collect($letter['letterid']);
    CORE_GOTOURL("index.php?mod=square&action=match&do=mail&step=letter&id={$letter['letterid']}&r=".rand(1, 50));
}

$recommend = db_fetch(db_query("SELECT voteid FROM activity_mail_vote WHERE uid = {$_G['user']['uid']} AND `type` = 1 AND letter_id = {$letter['letterid']}"));
if(isset($_GET['recommend']) && !$recommend)
{
    db_insert("activity_mail_vote", array(
        'uid' => $_G['user']['uid'],
        'type' => 1,
        'letter_id' => $letter['letterid'],
        'time' => time(),
        'letter_authorid' => $letter['uid']
    ));
    db_update("activity_mail_letter", array(
        'vote1' => $letter['vote1'] + 1
    ), "letterid={$letter['letterid']}");
    $recommend = true;
    $letter['vote1'] += 1;
}

include template("app/square:match_mail_letter");
?>