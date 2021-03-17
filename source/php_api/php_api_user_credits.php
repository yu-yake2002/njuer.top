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
        if(isset($_GET['uid'])
            && isset($_GET['credits'])
            && isset($_GET['reason']))
        {
            $credits = db_fetch(db_query("SELECT credits FROM user_credits WHERE uid = {$_GET['uid']}"))['credits'];

            credits_update($_GET['uid'], $_GET['credits'], "{$_GET['reason']}(操作人工号: {$_G['user']['uid']})");
            credits_update($_G['user']['uid'], -$_GET['credits'], "积分奖惩用户{$_GET['uid']}", false);
            print "操作成功！";
        }else{
            print "操作失败！";
        }
        break;
    default:
        break;
}

?>