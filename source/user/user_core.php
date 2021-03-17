<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!isset($_GET['action']))
{
    CORE_GOTOURL("index.php");
}elseif(in_array($_GET['action'], array(
    'login', 'mail', 'message', 'profile', 'room', 'gift'
)))
{
    $action = $_GET['action'];
    include_once "./source/user/user_$action.php";
}elseif($_GET['action'] == 'exit')
{
    setcookie("key", "", time() - 1);
    session_destroy();
    CORE_GOTOURL("index.php?mod=user&action=login");
}else{
    CORE_GOTOURL("index.php");
}

?>