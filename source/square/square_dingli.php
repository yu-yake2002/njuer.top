<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200922, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!isset($_GET['do']) or !in_array($_GET['do'], array("New", "Hot", "Col", "Wri", "Search", "List")))
{
    $_GET['do'] = "New";
}

if(!isset($_GET['class']) || !in_array($_GET['class'], array(
    0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10
    ))){
    $_GET['class'] = 0;
}

include template("app_style/{$_G['user']['style']}:square:dingli");
?>