<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$Love_reg_persons = db_count(db_query("SELECT * FROM square_match_love_reg WHERE state >= 5"));

if($_G['user']['identification']['verified'] > 5 && isset($_GET['clear'])){
    db_update("square_match", array('state' => 0), "1");
}

//$query = db_query("SELECT * FROM common_match WHERE state = 1");
//while($users = db_fetch($query)){
//    if(db_fetch(db_query("SELECT * FROM common_match WHERE state = 1 AND uid = {$users['match_uid']}"))){
//        print $users['uid'];
//        print ",";
//        print $users['match_uid'];
//        print "<br>";
//    }
//}

if(isset($_GET['do'])
    && in_array($_GET['do'],
        array("out", "addOut", "Love", "admin_Love", "mail", "study"))){
    include_once "source/square/square_match_{$_GET['do']}.php";
}else {

    if ((date("H", time()) >= 19 && (date("i", time()) >= 20 && date("i", time()) <= 30))
        || (date("H", time()) == 22 && date("i", time()) >= 20)
        || date("H", time()) == 23
        || (date("H", time()) == 0 && date("i", time()) <= 30)) {
        $allowChat = true;
    } else {
        $allowChat = false;
    }
    if(time() <= 1613084399){
        $allowChat = true;
    }

    $persons = 2 * db_count(db_query("SELECT rid FROM square_match WHERE state>=2"));

    include template("app_style/{$_G['user']['style']}:square:match");
}

?>