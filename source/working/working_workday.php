<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function get_work_state($date)
{
    global $OrgUser;
    $res = db_fetch(db_query("SELECT state FROM org_working WHERE `uoid` = {$OrgUser['uoid']} AND `date` = $date"));
    if($res){
        return $res['state'];
    }else{
        return 0;
    }
}

if(isset($_GET['oid']) && isset($_GET['update']) && isset($_GET['date']))
{
    if(is_numeric($_GET['date']) && isset($_GET['update'])){
        if(($_GET['date'] > $_CORE['today']['datestamp'] && $_GET['update'] == 1)
            || ($_GET['date'] > $_CORE['today']['datestamp'] + 2 && $_GET['update'] == 0)) {
            db_update("org_working", array('state' => $_GET['update'], 'name' => $OrgUser['name']),
                array('uoid' => $OrgUser['uoid'], 'date' => $_GET['date'], 'oid' => $OrgUser['oid']), true);
            CORE_GOTOURL("index.php?mod=working&action=workday&oid={$_GET['oid']}");
        }
    }
}

if($OrgAdmin && $OrgAdmin['working']){
    if(isset($_GET['change']) && $_GET['change']){
        if(isset($_GET['uoid']) && is_numeric($_GET['uoid']) && isset($_GET['date']) && is_numeric($_GET['date'])) {
            db_update("org_working", array('state' => 2),
                array('uoid' => $_GET['uoid'], 'date' => $_GET['date'], 'oid' => $OrgUser['oid']), true);
            CORE_GOTOURL("index.php?mod=working&action=workday&oid={$_GET['oid']}");
        }
    }
    $query = db_query("SELECT `name`, `date`, `uoid` FROM org_working WHERE `oid` = {$OrgUser['oid']} AND `state` = 1 AND `date` >= ".($_CORE['today']['datestamp'] + 1)." ORDER BY `date` ASC LIMIT 30");
}

include template("app/working:workday");

?>