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
            && isset($_GET['gid'])
            && $_GET['text']){
            db_insert("user_room_message", array(
                'uid' => $_G['user']['uid'],
                'gid' => $_GET['gid'],
                'text' => $_GET['text'],
                'time' => time()
            ));
        }
        break;
    case 'searchMessage':
        if($_G['user']['loginned']
            && isset($_GET['gid'])
            && isset($_GET['start'])){
            $result = array();
            $i = 0;
            $result['message'] = array();

            if(isset($_GET['init']) && $_GET['init'] > 0){
                $query = db_query("SELECT uid, text, time, itemid FROM user_room_message WHERE itemid > {$_GET['start']} AND (gid = {$_GET['gid']}) ORDER BY itemid DESC LIMIT {$_GET['init']}, 1");
            }else{
                $query = db_query("SELECT uid, text, time, itemid FROM user_room_message WHERE itemid > {$_GET['start']} AND (gid = {$_GET['gid']}) ORDER BY itemid ASC");
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

            print(json_encode($result));
        }
        break;
    case 'searchPastMessage':
        if($_G['user']['loginned']
            && isset($_GET['gid'])
            && isset($_GET['stop'])){
            $result = array();
            $i = 0;
            $result['message'] = array();

            $query = db_query("SELECT uid, text, time, itemid FROM user_message WHERE itemid < {$_GET['stop']} AND gid = {$_GET['gid']} ORDER BY itemid DESC LIMIT 0, 10");
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
    default:
        break;
}

?>