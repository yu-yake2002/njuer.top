<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(!$_G['user']['loginned'])
    exit('false');

if(isset($_GET['func']))
{
    $func = $_GET['func'];
}else{
    exit('false');
}

switch ($func){
    case 'update':
        if(isset($_GET['name'])
            && isset($_GET['guxiang'])
            && isset($_GET['yuanxi'])
            && isset($_GET['birthday'])
            && isset($_GET['favorite'])
            && isset($_GET['sex'])
            && isset($_GET['words']))
        {
            $uid=$_G['user']['uid'];
            $name = $_GET['name'];
            $guxiang = $_GET['guxiang'];
            $yuanxi = $_GET['yuanxi'];
            $birthday = $_GET['birthday'];
            $favorite = $_GET['favorite'];
            $sex = $_GET['sex'];
            $words = $_GET['words'];

            db_update('common_user_sign',
                array(
                    'name' => $name
                ),
                "uid=$uid"
            );
            db_update('user_profile',
                array(
                    'guxiang' => $guxiang,
                    'yuanxi' => $yuanxi,
                    'birthday' => $birthday,
                    'favorite' => $favorite,
                    'sex' => $sex,
                    'words' => $words
                ),
                "uid=$uid"
            );
        }
        break;
    case 'attention':
        if(isset($_GET['uid'])
            && is_numeric($_GET['uid']))
        {
            if(db_fetch(db_query("SELECT atid FROM home_attention WHERE uid = {$_G['user']['uid']} AND attention = {$_GET['uid']}")))
            {
                db_delete("home_attention", "uid = {$_G['user']['uid']} AND attention = {$_GET['uid']}");
                db_add("home_fans", array(
                    'fans' => -1
                ), array(
                    'uid' => $_GET['uid']
                ));
                db_add("home_fans", array(
                    'attens' => -1
                ), array(
                    'uid' => $_G['user']['uid']
                ));
                exit("follow");
            }else{
                db_insert("home_attention", array(
                    'uid' => $_G['user']['uid'],
                    'attention' => $_GET['uid'],
                    'time' => time()
                ));
                db_add("home_fans", array(
                    'fans' => 1
                ), array(
                    'uid' => $_GET['uid']
                ));
                db_add("home_fans", array(
                    'attens' => 1
                ), array(
                    'uid' => $_G['user']['uid']
                ));
                exit("followed");
            }
        }
        break;
    case 'set_private':
        if(isset($_GET['key'])
            && isset($_GET['value'])
            && is_numeric($_GET['value']))
        {
            $key = $_GET['key'];
            $value = $_GET['value'];
            if(in_array($key, array(
                'myFollow', 'myFans', 'myVisitors', 'myOnline', 'mySid',
                'allowFollow', 'allowRecommend'
            ))){
                db_update("user_private", array($key => $value), array('uid' => $_G['user']['uid']), true);
            }
        }
        break;
    case 'settings':
        if(isset($_GET['key'])
            && isset($_GET['value'])
            && is_numeric($_GET['value']))
        {
            $key = $_GET['key'];
            $value = $_GET['value'];
            if(in_array($key, array(
                'style'
            ))){
                if($value == 0){
                    $value = "day";
                }
                if($value == 1){
                    $value = "nju2021";
                }
                if($value == 2){
                    $value = "NewYear2021";
                }
                if($value == 3){
                    $value = "day2021";
                }
                if($value == 4){
                    $value = "eve2021";
                }
                if($value == 5){
                    $value = "Cat2021";
                }
                db_update("common_user_sign", array($key => $value), array('uid' => $_G['user']['uid']), true);
            }
        }
        break;
    default:
        break;
}

?>