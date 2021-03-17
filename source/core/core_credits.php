<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200906, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function credits_update($uid, $credits, $reason="系统操作", $vip_plus=true)
{
    $user = db_fetch(db_query("SELECT credits, vip FROM user_credits WHERE uid=$uid"));
    if($user['vip'] >= time() && $credits > 0 && $vip_plus)
    {
        $plus_credits = ceil($credits * 0.2);
    }else{
        $plus_credits = 0;
    }
    db_insert("user_credits_log", array(
        'uid' => $uid,
        'credits' => $credits + $plus_credits,
        'time' => time(),
        'reason' => "$reason(含VIP附加积分 $plus_credits 分)"
    ));
    db_update("user_credits", array(
        'credits' => ($user['credits'] + $credits + $plus_credits)
    ), "uid=$uid");
    return true;
}

?>