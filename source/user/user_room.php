<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20201001, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$_G['FullScreen'] = true;

if(!$_G['user']['loginned']){
    CORE_GOTOURL("index.php?mod=user&action=login");
}

if(!isset($_GET['gid'])) {
    CORE_GOTOURL("index.php");
}

$query = db_query("SELECT * FROM square_match_out_groups WHERE gid = {$_GET['gid']}");
$group = db_fetch($query);

if(!$group){
    CORE_GOTOURL("index.php");
}

if(!db_fetch(db_query(
    "SELECT oid FROM square_match_out WHERE gid = {$_GET['gid']} AND uid = {$_G['user']['uid']}")))
{
    CORE_GOTOURL("index.php");
}

include template("app/user:room");

?>