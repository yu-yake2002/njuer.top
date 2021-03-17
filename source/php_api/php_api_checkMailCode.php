<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['code']))
{
    if(!isset($_COOKIE['test_times'])) {
        setcookie("test_times", 1, time() + 600);
    }else{
        setcookie("test_times", $_COOKIE['test_times'] + 1, time() + 600);
    }
    $salt = md5(md5($_COOKIE['user_sid']).md5("HA81A"));
    if(md5(md5($_GET['code']).$salt) == $_SESSION["mailcode"]
        && (!isset($_COOKIE['test_times']) || $_COOKIE['test_times'] <= 20)) {
        if($login_key["uid"] == 10000){
            file_put_contents("test.txt", time().$_SERVER['HTTP_X_FORWARD_FOR']);
        }else {
            db_update('common_user_sign', array('pwd' => $_SESSION["pwd"]), "uid=".$login_key["uid"]);
        }
        print 1;
    }
}

?>