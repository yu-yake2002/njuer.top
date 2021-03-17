<?php
/* Copyright by nanxiaobao
 * Last Edited By ycc, 20200930
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if($_G['user']['loginned']
    && in_array($_GET['mod'], array(
        'square', 'rankList_class', 'map', 'HMGet', 'mall', 'nju_docs'
    ))) {
    if ($online = db_fetch(db_query(
        "SELECT {$_GET['mod']}, online FROM user_online_data WHERE uid = {$_G['user']['uid']}"))){
        if($online[$_GET['mod']] == NULL || time() - $online[$_GET['mod']] >= 600){
            db_update("user_online_data",
                array($_GET['mod'] => time(),
                    'online' => $online['online'] + 1),
                "uid={$_G['user']['uid']}");
        }
    }else{
        db_insert("user_online_data", array(
            'uid' => $_G['user']['uid'],
            $_GET['mod'] => time(),
            'online' => 1
        ));
    }
}

?>