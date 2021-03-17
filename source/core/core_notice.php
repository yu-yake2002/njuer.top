<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200909, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$_G['notice'] = db_fetch(db_query("SELECT * FROM common_notice"));
if(isset($_COOKIE["notice"])
    || db_fetch(db_query("SELECT * FROM common_notice_read WHERE uid={$_G['user']['uid']} AND nid = {$_G['notice']['nid']}"))){
    $_G['notice'] = array();
}elseif(!isset($_COOKIE["notice"])){
    setcookie("notice", 1, time() + 600);
}

?>