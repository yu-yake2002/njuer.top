<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200906, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!$_G['user']['loginned']){
    CORE_GOTOURL("index.php");
}

if(!isset($_GET['action']))
{
    $_GET['action'] = "needsList";
}

if(!isset($_GET['from']))
{
    $_GET['from'] = $_GET['action'];
}

if(in_array($_GET['action'], array(
    'needsList', 'myRequest', 'myTask'
)))
{
    $action = $_GET['action'];
    include_once "./source/HMGet/HMGet_$action.php";
}else{
    CORE_GOTOURL("index.php");
}


?>