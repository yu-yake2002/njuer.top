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
    'checkMailCode', 'HMGetFunc', 'admin', 'rankList_class', 'rankList_food',
    'square', 'common', 'user_message', 'user_profile', 'square_match',
    'user_room', 'square_love', 'mall', 'user_credits', 'square_mail',
    'gift'
)))
{
    $action = $_GET['action'];
    include_once "./source/php_api/php_api_$action.php";
}else{
    CORE_GOTOURL("index.php");
}

?>