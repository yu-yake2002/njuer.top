<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!$_G['user']['loginned'])
{
    CORE_GOTOURL("index.php?mod=user&action=login");
}

$query = db_query("SELECT uid FROM user_online_data WHERE square >= ".(time() - 660));
$_G['online']['persons'] = db_count($query);
$_G['online']['user'] = db_fetch(db_query("SELECT uid, square FROM user_online_data WHERE uid != {$_G['user']['uid']} AND uid != 10000 ORDER BY square DESC"));

if(!isset($_GET['action'])) {
    $_GET['action'] = "dingli";
}

if(!in_array($_GET['action'], array(
    'match', 'lanjing', 'dingli', 'weihua'
))) {
    $action = "dingli";
}else{
    $action = $_GET['action'];
}

include_once "source/square/square_{$action}.php";

?>