<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$letters = db_query("SELECT * FROM activity_mail_received WHERE uid = {$_G['user']['uid']} ORDER BY `time` DESC");

include template("app/square:match_mail_myBox");
?>