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
    case 'sendMessage':
        if($_G['user']['loginned']
            && isset($_GET['text'])
            && isset($_GET['to_uid'])
            && $_GET['text']){
            db_insert("user_message", array(
                'uid' => $_G['user']['uid'],
                'to_uid' => $_GET['to_uid'],
                'text' => $_GET['text'],
                'time' => time()
            ));
            if($toread = db_fetch(db_query("SELECT * FROM user_message_list WHERE uid={$_GET['to_uid']} AND from_uid={$_G['user']['uid']}"))){
                $toread = $toread['toread'] + 1;
                db_update("user_message_list",array(
                    "toread" => $toread,
                    "time" => time(),
                    "text"=>$_GET['text']),
                    "uid={$_GET['to_uid']} AND from_uid={$_G['user']['uid']}");
            }else{
                db_insert("user_message_list",array(
                    "toread" => 1,
                    "from_uid" => $_G['user']['uid'],
                    "uid" => $_GET['to_uid'],
                    "text" => $_GET['text'],
                    "time" => time()
                ));
            }
        }
        break;
    case 'searchMessage':
        if($_G['user']['loginned']
            && isset($_GET['to_uid'])
            && isset($_GET['start'])){
            $result = array();
            $i = 0;
            $result['message'] = array();

            if(isset($_GET['init']) && $_GET['init'] >= 0){
                $query = db_query("SELECT uid, text, time, itemid FROM user_message WHERE itemid > {$_GET['start']} AND ((uid = {$_G['user']['uid']} AND to_uid = {$_GET['to_uid']}) OR (to_uid = {$_G['user']['uid']} AND uid = {$_GET['to_uid']})) ORDER BY itemid DESC LIMIT {$_GET['init']}, 1");
            }else{
                $query = db_query("SELECT uid, text, time, itemid FROM user_message WHERE itemid > {$_GET['start']} AND ((uid = {$_G['user']['uid']} AND to_uid = {$_GET['to_uid']}) OR (to_uid = {$_G['user']['uid']} AND uid = {$_GET['to_uid']})) ORDER BY itemid ASC");
            }
            while($message = db_fetch($query)){
                $result['message'][] = array(
                    'text' => $message['text'],
                    'uid' => $message['uid'],
                    'item' => ($_G['user']['uid'] == $message['uid'])?"right":"left",
                    'avatar' => get_user($message['uid'])['profile']['avatar'],
                    'itemid' => $message['itemid'],
                    'time' => $message['time'],
                    'time_s' => formatTime($message['time'])
                );
            }

            if($query = db_query("SELECT * FROM user_message_list WHERE from_uid={$_GET['to_uid']} AND uid={$_G['user']['uid']}")){
                db_update("user_message_list",
                    array("toread" => 0),
                    "uid={$_G['user']['uid']} AND from_uid={$_GET['to_uid']}");
            }

            print(json_encode($result));
        }
        break;
    case 'searchPastMessage':
        if($_G['user']['loginned']
            && isset($_GET['to_uid'])
            && isset($_GET['stop'])){
            $result = array();
            $i = 0;
            $result['message'] = array();

            $query = db_query("SELECT uid, text, time, itemid FROM user_message WHERE itemid < {$_GET['stop']} AND ((uid = {$_G['user']['uid']} AND to_uid = {$_GET['to_uid']}) OR (to_uid = {$_G['user']['uid']} AND uid = {$_GET['to_uid']})) ORDER BY itemid DESC LIMIT 0, 10");
            while($message = db_fetch($query)){
                $result['message'][] = array(
                    'text' => $message['text'],
                    'uid' => $message['uid'],
                    'item' => ($_G['user']['uid'] == $message['uid'])?"right":"left",
                    'avatar' => get_user($message['uid'])['profile']['avatar'],
                    'itemid' => $message['itemid'],
                    'time' => $message['time'],
                    'time_s' => formatTime($message['time'])
                );
            }
            $result['message'] = array_reverse($result['message']);

            print(json_encode($result));
        }
        break;
    case 'messageList':
        if($_G['user']['uid'] == 10000){
            $query = db_query("SELECT * FROM user_message_list WHERE uid = {$_G['user']['uid']} ORDER BY time DESC LIMIT 50");
        }else{
            $query = db_query("SELECT * FROM user_message_list WHERE uid = {$_G['user']['uid']} ORDER BY time DESC LIMIT 20");
        }
        include template("app_style/{$_G['user']['style']}:square:lanjing_list");
        break;
    default:
        break;
}

?>