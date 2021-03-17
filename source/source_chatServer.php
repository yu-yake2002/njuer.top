<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200906, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

include_once './source/core/core_server.php';

new nxb_ChatServer("0.0.0.0", 8888);

?>