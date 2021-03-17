<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}


if(!isset($_GET['step'])) {
    $_GET['step'] = "reg";
}

if(time() <= 1612368000) {
    $BeginReg = 1612195200;
    if($_G['user']['identification']['verified'] <= 3){
        CORE_GOTOURL("index.php");
    }
}else{
    $BeginReg = 1612368000;
}
$BeginAct = 1612951200;
$BeginAct2 = 1612951200;
$day = ceil((time() - $BeginAct2) / 86400);
$OldReg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE uid = {$_G['user']['uid']} AND state >= 0 ORDER BY `time` DESC"));
$Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE uid = {$_G['user']['uid']} AND `time` > {$BeginReg} AND state >= 0"));
if($Reg && $Reg['state'] >= 7){
    CORE_GOTOURL("index.php");
}
if($OldReg && !$Reg){
    $Reg = array();
    foreach ($OldReg as $key => $value){
        if(!is_numeric($key) && $key != "regid") {
            $Reg[$key] = $value;
        }
    }
    $Reg['uid2'] = 0;
    if($OldReg['state'] >= 2) {
        $Reg['state'] = 2;
    }
    $Reg['time'] = time();
    db_insert("square_match_love_reg", $Reg);
}

$Match = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE uid = {$Reg['uid2']} ORDER BY `time` DESC"));
if($Match) {
    $bh = $Match['body_height'] % 10;
}else{
    $bh = 0;
}
if($Match && $Match['uid2'] != $Reg['uid']){
    $Match['state'] = 7;
}

if(time() <= $BeginAct && $Reg['state'] <= 6 && false){
    $Match = array();
    $Match['uid'] = 10004;
    $Match['name'] = "未知";
    $Match['sid'] = "XXXXXXXXX";
    $Match['photo'] = "static/img/logo.png";
    $Match['body_height'] = "XX".$bh;
    $Match['intro'] = "您好，期待着10月17日19:00与您见面~";
    $Match['state'] = 6;
}

if(!in_array($_GET['step'], array(
    'reg', 'qn', 'square', 'result', 'paper'
))) {
    $step = "reg";
}else{
    $step = $_GET['step'];
}

include_once "source/square/square_match_Love_{$step}.php";

?>