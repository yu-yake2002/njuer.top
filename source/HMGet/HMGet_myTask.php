<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200906, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!isset($_GET['do']))
    $_GET['do'] = "myRequest";

include template("app/HMGet:myTask");
?>