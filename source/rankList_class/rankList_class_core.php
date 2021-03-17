<?php

/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!$_G['user']['loginned']){
    CORE_GOTOURL("index.php");
}

if(!isset($_GET['action']))
{
    $_GET['action'] = "class";
}

if(isset($_GET['action'])
    && in_array($_GET['action'], array(
        'class', 'items'
    )))
{
    $action = $_GET['action'];
    include_once "./source/rankList_class/rankList_class_$action.php";
}else{
    CORE_GOTOURL("index.php");
}

?>