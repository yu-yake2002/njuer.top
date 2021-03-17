<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$joinFail = false;
$joinSuccess = false;


if(isset($_GET['gid'])){
    if(($group = db_fetch(db_query("SELECT name FROM square_match_out_groups WHERE gid = {$_GET['gid']}")))
        && !db_fetch(db_query("SELECT oid FROM square_match_out WHERE gid = {$_GET['gid']} AND uid = {$_G['user']['uid']}"))){
        $groupName = $group['name'];
    }else{
        $joinSuccess = true;
        $_GET['gid'] = 0;
    }
}

if(!isset($_GET['gid']) || !$_GET['gid']){
    $query = db_query("SELECT * FROM square_match_out_groups WHERE people < people_limit OR gid in (SELECT gid FROM square_match_out WHERE uid = {$_G['user']['uid']}) ORDER BY gid DESC LIMIT 0, 30");
}

if(isset($_POST["gid"])){
    if($group = db_fetch(db_query("SELECT people, people_limit FROM square_match_out_groups WHERE gid = {$_POST["gid"]}"))){
        if($group['people'] < $group['people_limit']) {
            if(!db_fetch(db_query("SELECT oid FROM square_match_out WHERE gid = {$_POST["gid"]} AND uid = {$_G['user']['uid']}"))) {
                db_insert("square_match_out", array(
                    'uid' => $_G['user']['uid'],
                    'gid' => $_POST["gid"],
                    'time' => time(),
                    'mobile' => $_POST["mobile"],
                    'others' => $_POST["others"] ? $_POST["others"] : "空",
                    'name' => $_POST["uname"] ? $_POST["uname"] : "匿名",
                    'sex' => $_POST["sex"],
                    'sexo' => $_POST["sexo"]
                ));
                db_update("square_match_out_groups", array(
                    'people' => $group['people'] + 1
                ), "gid={$_POST["gid"]}");
            }
            $joinSuccess = true;
        }else{
            $joinFail = true;
        }
    }
}

$group_u_sex = array(
    '',
    '男',
    '女',
    '男(跨性别)',
    '女(跨性别)',
    '保密'
);

$group_u_sexo = array(
    '',
    '男',
    '女',
    '保密'
);

if(time() <= 1613059199 && !db_fetch(db_query("SELECT chance FROM activity_year_chance WHERE uid = {$_G['user']['uid']}"))){
    db_add("activity_year_chance", array("chance" => 1), array("uid" => $_G['user']['uid']));
    $add_chance = 1;
}

include template("app/square:match_out");
?>