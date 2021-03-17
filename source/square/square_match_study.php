<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!in_array($_GET['step'], array(
    'index', 'ranklist'
))) {
    $step = "index";
}else{
    $step = $_GET['step'];
}

include_once "source/square/square_match_study_{$step}.php";

?>