<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200906, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if($_G['user']['loginned'] == true)
{
    CORE_GOTOURL("index.php?mod=square");
}

include template("app/common:index");
?>