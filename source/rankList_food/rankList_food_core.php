<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200919, By 张运筹
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
    $_GET['action'] = "foodList";
}

if(!in_array($_GET['action'], array(
    'foodList'
))) {
    $_GET['action'] = "foodList";
}

include_once "source/rankList_food/rankList_food_{$_GET['action']}.php";

?>