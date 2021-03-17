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
if(isset($_POST["qq"]) && isset($_POST["vx"]) && isset($_POST["tel"]) && isset($_POST["home"])){
    db_update("common_user_identification", array(
        'qq' => $_POST["qq"],
        'vx' => $_POST["vx"],
        'tel' => $_POST["tel"],
        'home' => $_POST["home"],
        'mall_register' => 1
    ), "uid={$_G['user']['uid']}");
    CORE_GOTOURL("index.php?mod=mall");
}

include template("app/mall:register");
?>