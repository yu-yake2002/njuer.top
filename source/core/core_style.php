<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200908, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if($_G['user']['loginned']) {
    if($_G['user']['style'] == ""){
        $_G['user']['style'] = "day";
    }
}else{
    $_G['user']['style'] = "day";
}

if($_G['user']['style'] == "day"){
    $_G['user']['style'] = "nju2021";
}

?>