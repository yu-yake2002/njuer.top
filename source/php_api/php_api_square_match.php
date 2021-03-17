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
    case 'Chat':
        if($_G['user']['loginned'] && (((date("H", time()) >= 19 && (date("i", time()) >= 20 && date("i", time()) <= 30))
                || (date("H", time()) == 22 && date("i", time()) >= 20)
                || date("H", time()) == 23
                || (date("H", time()) == 0 && date("i", time()) <= 30)) || time() <= 1613084399)){
            if($room = db_fetch(db_query("SELECT rid, uid1 FROM square_match WHERE state=1 AND uid1 != {$_G['user']['uid']}")))
            {
                db_update("square_match", array(
                    'uid2' => $_G['user']['uid'],
                    'state' => 2,
                    'date' => date("md", time())
                ), "rid={$room['rid']}");
                $result['response'] = "success";
                $result['uid'] = $room['uid1'];
            }elseif($room = db_fetch(db_query("SELECT rid, uid2 FROM square_match WHERE state=2 AND uid1 = {$_G['user']['uid']}"))){
                $result['response'] = "success";
                $result['uid'] = $room['uid2'];
                db_update("square_match", array(
                    'state' => 3
                ), "rid={$room['rid']}");
            }elseif($room = db_fetch(db_query("SELECT rid FROM square_match WHERE state=0 ORDER BY rid ASC"))){
                if(!db_fetch(db_query("SELECT rid FROM square_match WHERE uid1={$_G['user']['uid']} AND state=1"))) {
                    db_update("square_match", array(
                        'uid1' => $_G['user']['uid'],
                        'state' => 1,
                        'date' => date("md", time())
                    ), "rid={$room['rid']}");
                }
                $result['response'] = "loading";
            }else{
                $result['response'] = "fail";
            }
            print(json_encode($result));
        }
        break;
    case 'cancelChat':
        if($_G['user']['loginned']
            && db_fetch(db_query("SELECT state FROM square_match WHERE uid1={$_G['user']['uid']}"))['state'] == 1){
            db_update("square_match", array('state' => 0), "uid1={$_G['user']['uid']}");
        }
        break;
    default:
        break;
}

?>
