<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$OrgUser = array();

function get_org($orgid){
    return db_fetch(db_query("SELECT * FROM org_common WHERE oid={$orgid}"));
}

function get_org_user($uid, $search="*", $orgid = 0){
    global $_GET;
    if($orgid == 0){
        $orgid = $_GET['oid'];
    }
    return db_fetch(db_query("SELECT {$search} FROM org_user WHERE uid = {$uid} AND state > 0 AND oid={$orgid}"));
}

function get_meet($meetid){
    return db_fetch(db_query("SELECT * FROM org_meeting WHERE meetid={$meetid}"));
}

if(!isset($_GET['action']))
{
    if(isset($_POST["key"])
        && isset($_POST["pwd"])
        && isset($_POST["name"]))
    {
        $org = db_fetch(db_query("SELECT pwd, oid, common_state, uid FROM org_common WHERE `key` = '{$_POST["key"]}'"));
        if($org && $_POST["pwd"] == $org['pwd']) {
            db_update("org_user", array(
                'name' => $_POST["name"],
                'state' => $org['common_state'],
                'time' => time(),
                'credits' => 0
            ), array(
                'uid' => $_G['user']['uid'],
                'oid' => $org['oid']
            ), true);
        }
    }
    $query = db_query("SELECT * FROM org_user WHERE uid = {$_G['user']['uid']} AND state > 0");
    include template("app/working:list");
}elseif(isset($_GET['oid']) && is_numeric($_GET['oid']) && in_array($_GET['action'], array(
    'index', 'credits', 'workday', 'documents'
)))
{
    if(is_numeric($_GET['oid'])) {
        $OrgUser = get_org_user($_G['user']['uid']);
    }

    if($OrgUser) {
        $org = get_org($_GET['oid']);
    }

    $OrgAdmin = db_fetch(db_query("SELECT * FROM org_admin WHERE state = {$OrgUser['state']}"));

    $action = $_GET['action'];
    include_once "./source/working/working_$action.php";
}else{
    CORE_GOTOURL("index.php");
}

?>