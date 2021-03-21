<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!$_G['user']['loginned']){
    CORE_GOTOURL("index.php");
}

if(!isset($_GET['action'])) {
    $_GET['action'] = "list";
}

if(!in_array($_GET['action'], array(
    'list', 'findFriend', 'admin', 'addFindFriend', 'myFindFriend',
))) {
    $action = "list";
}else{
    $action = $_GET['action'];
}

include_once "source/myClass/myClass_{$action}.php";

?>