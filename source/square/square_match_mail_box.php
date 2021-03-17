<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_POST["title"]) && isset($_POST["contents"]) && $_POST["contents"])
{
    if(!$_POST["title"])
    {
        $_POST["title"] = "无题";
    }
    if(!$_POST["plimit"])
    {
        $_POST["plimit"] = 1;
    }
    if(!$_POST["grade1"]
        && !$_POST["grade2"]
        && !$_POST["grade3"]
        && !$_POST["grade4"]
        && !$_POST["grade5"])
    {
        $_POST["grade1"] = 1;
        $_POST["grade2"] = 1;
        $_POST["grade3"] = 1;
        $_POST["grade4"] = 1;
        $_POST["grade5"] = 1;
    }
    db_insert("activity_mail_letter", array(
        'received' => 0,
        'plimit' => $_POST["plimit"],
        'title' => $_POST['title'],
        'contents' => $_POST['contents'],
        'gender' => $_POST['gender'],
        'grade1' => $_POST["grade1"],
        'grade2' => $_POST["grade2"],
        'grade3' => $_POST["grade3"],
        'grade4' => $_POST["grade4"],
        'grade5' => $_POST["grade5"],
        'open' => 0,
        'allowShared' => $_POST["allowShared"],
        'time' => time(),
        'uid' => $_G['user']['uid']
    ));
    CORE_GOTOURL("index.php?mod=square&action=match&do=mail&step=box");
}

$inbox = user_setting_get(1);

if(isset($_GET['inbox']) && !$inbox)
{
    send_user_mail(
        $_G['user']['uid'],
        "要问南小宝为什么要办这样的活动，原因就是：小宝这几天取了很多的信，发现太多文采飞扬的信只能我一个人独享，简直是暴！殄！天！物！而且，小宝写了不少超级暖的回信，也真的真的真的很想分享给大家看一看~\r\n于是这个活动就来啦！你只要往下一滑，就可以看到大家分享的各种信件，你还可以每天领取3票，把票投给那些最打动你的文字！\r\n解忧杂货店会从票数高的信件中选出5个顾客瓜分5份奖品！这些奖品是：Freebuds妙享版、零食大礼包+奶茶、精美笔记本+笔、(南小猫玩偶+绿植)*2。\r\n具体的获奖攻略见我们马上推出的推送！（如果你还没关注我们的公众号，我是不会告诉你公众号名称是“NJU南小宝”的，哼(￢︿̫̿￢☆)",
        "活动：杂货店里那些打动你的文字",
        1
    );
    user_setting_update(1, 1);
    CORE_GOTOURL("index.php?mod=square&action=match&do=mail&step=box&r=".rand(1, 999));
}

$open_letter = db_query("SELECT * FROM activity_mail_letter WHERE `open`=1 ORDER BY vote1 DESC");

include template("app/square:match_mail_box");
?>