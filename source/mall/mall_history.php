<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$query = db_query("SELECT * FROM mall_goods WHERE startTime < ".time()." AND endTime > ".time());

include template("app/mall:history");
?>