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


if(!isset($_GET['action'])) {
    $_GET['action'] = "index";
}

if(!in_array($_GET['action'], array(
    'register', 'history', 'index', 'cash'
))) {
    $action = "index";
}else{
    $action = $_GET['action'];
}

if($_G['user']['identification']['mall_register'] != 1 && $action != "register"){
    CORE_GOTOURL("index.php?mod=mall&action=register");
}
if($_G['user']['identification']['mall_register'] == 1 && $action == "register"){
    CORE_GOTOURL("index.php?mod=mall&action=index");
}

include_once "source/mall/mall_{$action}.php";

?>