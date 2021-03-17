<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['confirm'])
    && ($Reg['state'] == 5 || $Reg['state'] == 6)
    && $Match
    && $_GET['confirm'] == "true"
    && time() - 158400 <= $BeginAct){
    db_update("square_match_love_reg", array('state' => 8), "uid={$_G['user']['uid']}");
    if($Match['state'] == 8 && $Match['uid2'] == 8){
        db_insert("square_match_love_wish", array(
            "uid1" => $_G['user']['uid'],
            "uid2" => $Match['uid'],
            "wish1" => 0,
            "wish2" => 0,
            "type" => ($Reg['sex'] == $Match['sex'])?1:(($Reg['sex'] == 1)?2:3)));
    }
    CORE_GOTOURL("index.php?mod=square&action=match&do=Love&step=result&r=".rand(0, 50));
}

if(isset($_GET['confirm'])
    && ($Reg['state'] == 5 || $Reg['state'] == 6)
    && $Match
    && time() <= $BeginAct
    && $_GET['confirm'] == "false"){
    db_update("square_match_love_reg", array('state' => $Reg['state'] + 1, 'uid2' => 0), "regid={$Reg['regid']}");
    db_update("square_match_love_reg", array('uid2' => 0), "regid={$Match['regid']}");
    db_update("square_match_unwish",
        array("time" => time()),
        array("uid" => $_G['user']['uid'], "regid" => $Match['regid']),
        true);
    CORE_GOTOURL("index.php?mod=square&action=match&do=Love&step=square&r=".rand(0, 50));
}
if(isset($_GET['reMatch'])
    && ($Reg['state'] == 7 || ($Reg['state'] == 8 && ($Match['state'] == 7 || $Match['state'] == 6 || $Match['state'] == 9)))
    && $Match
    && $_GET['reMatch'] == "true"
    && time() - 158400 <= $BeginAct){
    db_update("square_match_love_reg", array('state' => 9, 'uid2' => 0), "uid={$_G['user']['uid']}");
    CORE_GOTOURL("index.php?mod=square&action=match&do=Love&step=result&r=".rand(0, 50));
}

if($Reg['state'] == 8 && $Match['state'] == 8){
    $Wish = db_fetch(db_query("SELECT * FROM square_match_love_wish WHERE uid1 = {$_G['user']['uid']}"));
    if(!$Wish){
        $Wish = db_fetch(db_query("SELECT * FROM square_match_love_wish WHERE uid2 = {$_G['user']['uid']}"));
    }
}

if(isset($_GET['together'])){
    if($_GET['together'] == "true"){
        db_insert("common_match", array(
            'uid' => $Reg['uid'],
            'match_uid' => $Match['uid'],
            'state' => 1,
            'time' => time()
        ));
    }elseif($_GET['together'] == "false"){
        db_insert("common_match", array(
            'uid' => $Reg['uid'],
            'match_uid' => $Match['uid'],
            'state' => 0,
            'time' => time()
        ));
    }
}

$together = db_fetch(db_query("SELECT * FROM common_match WHERE uid={$Reg['uid']}"));
$match_together = db_fetch(db_query("SELECT * FROM common_match WHERE uid={$Match['uid']}"));

if($_G['user']['identification']['verified'] > 5 && isset($_GET['chouQian'])){
    $query = db_query("SELECT * FROM square_match_love_wish WHERE type = 0");
    while ($row=db_fetch($query)){
        $row1 = db_fetch(db_query("SELECT sex FROM square_match_love_reg WHERE uid = {$row['uid1']}"));
        $row2 = db_fetch(db_query("SELECT sex FROM square_match_love_reg WHERE uid = {$row['uid2']}"));
        if($row1['sex'] != $row2['sex']){
            db_update("square_match_love_wish", array(
                'type' => 1
            ), "wid={$row['wid']}");
        }elseif($row1['sex'] == 1){
            db_update("square_match_love_wish", array(
                'type' => 2
            ), "wid={$row['wid']}");
        }elseif($row1['sex'] == 0){
            db_update("square_match_love_wish", array(
                'type' => 3
            ), "wid={$row['wid']}");
        }
    }
    db_update("square_match_love_wish", array("result" => 0),
        "1");
    db_update("square_match_love_wish", array("result" => 1),
        "wish1 = 1 AND type = 1 ORDER BY RAND() DESC LIMIT 30");
    db_update("square_match_love_wish", array("result" => 2),
        "wish1 = 2 ORDER BY RAND() DESC LIMIT 15");
    db_update("square_match_love_wish", array("result" => 3),
        "wish1 = 1 AND (type = 2 OR type = 3) ORDER BY RAND() DESC LIMIT 15");
    $wish1 = 30 - db_count(db_query("SELECT * FROM square_match_love_wish WHERE result = 1"));
    $wish2 = 15 - db_count(db_query("SELECT * FROM square_match_love_wish WHERE result = 2"));
    $wish3 = 15 - db_count(db_query("SELECT * FROM square_match_love_wish WHERE result = 3"));
    if($wish1 > 0) {
        db_update("square_match_love_wish", array("result" => 1),
            "wish2 = 1 AND result = 0 AND type = 1 ORDER BY RAND() DESC LIMIT {$wish1}");
    }
    if($wish2 > 0) {
        db_update("square_match_love_wish", array("result" => 2),
            "wish2 = 2 AND result = 0 ORDER BY RAND() DESC LIMIT {$wish2}");
    }
    if($wish3 > 0) {
        db_update("square_match_love_wish", array("result" => 3),
            "wish2 = 1 AND result = 0 AND (type = 2 OR type = 3) ORDER BY RAND() DESC LIMIT {$wish3}");
    }
    db_update("square_match_love_wish", array("result" => 4), "result = 1 ORDER BY RAND() DESC LIMIT 15");
}

include template("app/square:match_love_result");
?>