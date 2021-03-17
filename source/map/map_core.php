<?php

/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!$_G['user']['loginned']){
    CORE_GOTOURL("index.php");
}

if(isset($_GET['action'])
    && in_array($_GET['action'], array(
        'xian1', 'xian2', 'ifLow'
    ))
    && isset($_GET['floor'])
    && in_array($_GET['floor'], array(
        1, 2, 3, 4, 5
    )))
{
    $action = $_GET['action'];
    $floor = $_GET['floor'];
}else{
    $action = "index";
    $floor = 1;
}

if($action == "index")
{
    $location = "ifLow";
}else{
    $location = $action;
}

include template("app/map:index");

?>