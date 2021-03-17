<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if($_G['user']['loginned'] == true)
{
    if(UserisMobile()) {
        CORE_GOTOURL("index.php?mod=ranklist");
    }else{
        CORE_GOTOURL("index.php");
    }
}

session_start();

if (isset($_POST["pwd"])
    && isset($_POST["uid"])) {

    $query = db_query(
        "select * from common_user_sign where mobile = " . $_POST["uid"]
    );
    $_LOGIN['user'] = db_fetch($query);

    if ($_LOGIN['user']) {
        setcookie("uid", $_LOGIN['user']['uid']);
        $md5_pwd = md5(md5($_POST["pwd"]) . $_LOGIN['user']['salt']);
        setcookie("pwd", $md5_pwd);
    }else{
        if (strlen($_POST["uid"]) == 9){
            $salt = substr(md5(time() + rand(0, 100)), 6, 5)."FRPLMQUCNZ"[rand(0,9)];
            $pwd = md5(md5($_POST["pwd"]).$salt);

            $uid = CORE_USER_ADD(array(
                'name'=>"NJUer",
                'pwd'=>md5(rand(1,999999).time()),
                'mobile'=>$_POST["uid"],
                'salt'=>$salt
            ), 1);

            setcookie("uid", $uid);
            setcookie("pwd", $pwd);
        }
    }

    CORE_GOTOURL($_CORE['url']);
}

include template('app/user:mail');
?>