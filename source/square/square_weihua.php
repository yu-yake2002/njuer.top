<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200922, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!isset($_GET['do']) or !in_array($_GET['do'], array("New", "Hot", "Col")))
{
    $_GET['do'] = "New";
}

include template("app/square:weihua");
?>