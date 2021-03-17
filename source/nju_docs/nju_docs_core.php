<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!isset($_GET['action'])) {
    $_GET['action'] = "communication";
}

if(!in_array($_GET['action'], array(
    'index', 'docs', 'communication', 'addThread'
))) {
    $action = "index";
}else{
    $action = $_GET['action'];
}

include_once "source/nju_docs/nju_docs_{$action}.php";

?>