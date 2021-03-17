<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if($Match){
    $papers = db_query("SELECT * FROM square_papers WHERE uid={$_G['user']['uid']} ORDER BY time DESC");
}else{
    CORE_GOTOURL("index.php?mod=square&action=match&do=Love&step=result");
}

include template("app/square:match_love_paper");
?>