<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if($_G['user']['identification']['verified'] <= 5){
    exit();
}

if(isset($_GET['times']) && $_GET['times'] == 2){
    if (isset($_GET['passid'])) {
        $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE regid={$_GET['passid']}"));
        db_update("square_match_love_reg", array('state_2' => 1), "regid={$_GET['passid']}");
        CORE_GOTOURL("index.php?mod=square&action=match&do=admin_Love&times=2&r=" . rand(1, 99999));
    }
    if (isset($_GET['unpassid'])) {
        $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE regid={$_GET['unpassid']}"));
        if ($Reg['state'] == 5) {
            db_update("square_match_love_reg", array('state_2' => 0, 'state' => 2), "regid={$_GET['unpassid']}");
        }elseif ($Reg['state'] == 6){
            db_update("square_match_love_reg", array('state_2' => -1, 'state' => 2), "regid={$_GET['unpassid']}");
        }
        send_message($Reg['uid'], "非常抱歉，为了保证报名表质量，我们对所有报名表进行了二次审核。您的报名表被驳回了，有可能是以下原因之一导致：<br>1.生活照中未露出面部；<br>2.生活照疑似并非本人；<br>3.生活照画质过低，无法辨认；<br>4.个人介绍中存在不合适的内容。<br>如果您认为您的报名表中没有以上所述信息，可以回复此条消息。");
        CORE_GOTOURL("index.php?mod=square&action=match&do=admin_Love&times=2&r=" . rand(1, 99999));
    }
    $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE state >= 5 AND state <= 6 AND uid2 = 0 AND state_2 <= 0 AND `time` >= 1612300000 ORDER BY regid ASC"));
}else {
    if (isset($_GET['uid'])) {
        $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE uid = {$_GET['uid']} ORDER BY `regid` DESC, `time` DESC"));
    } else {
        if (!isset($_GET['regid'])) {
            $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE state = 3 OR state = 4"));
        } else {
            $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE regid = {$_GET['regid']}"));
        }
    }

    if (isset($_GET['passid'])) {
        $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE regid={$_GET['passid']}"));
        if ($Reg['state'] == 3 && $Reg['state_2'] >= 0) {
            db_update("square_match_love_reg", array('state' => 5), "regid={$_GET['passid']}");
        } elseif ($Reg['state'] == 4) {
            db_update("square_match_love_reg", array('state' => 6), "regid={$_GET['passid']}");
        } elseif ($Reg['state'] == 3 && $Reg['state_2'] < 0) {
            db_update("square_match_love_reg", array('state' => 6), "regid={$_GET['passid']}");
        }
        CORE_GOTOURL("index.php?mod=square&action=match&do=admin_Love&r=" . rand(1, 99999));
    }
    if (isset($_GET['sexid'])) {
        if ($_GET['sex'] == 1) {
            db_update("square_match_love_reg", array('sex' => 0), "regid={$_GET['sexid']}");
        } elseif ($_GET['sex'] == 0) {
            db_update("square_match_love_reg", array('sex' => 1), "regid={$_GET['sexid']}");
        }
        CORE_GOTOURL("index.php?mod=square&action=match&do=admin_Love&r=" . rand(1, 99999));
    }
    if (isset($_GET['unpassid'])) {
        $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE regid={$_GET['unpassid']}"));
        db_update("square_match_love_reg", array('state' => 0), "regid={$_GET['unpassid']}");
        CORE_GOTOURL("index.php?mod=square&action=match&do=admin_Love&r=" . rand(1, 99999));
    }
    if (isset($_GET['deleteid'])) {
        db_update("square_match_love_reg", array('state' => -1), "regid={$_GET['deleteid']}");
        CORE_GOTOURL("index.php?mod=square&action=match&do=admin_Love&r=" . rand(1, 99999));
    }
}
include template("app/square:match_admin_Love");
?>