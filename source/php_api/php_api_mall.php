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

switch ($func) {
    case 'BuyGoods':
        if(isset($_GET['gid']))
        {
            $goods = db_fetch(db_query("SELECT * FROM mall_goods WHERE gid = {$_GET['gid']}"));
            if($goods){
                if($goods['credits'] > $_G['user']['credits']['credits']){
                    print '积分余额不足！';
                }elseif($goods['num'] <= 0){
                    print "商品库存不足！";
                }else{
                    db_update("mall_goods", array('num' => $goods['num'] - 1), "gid={$goods['gid']}");
                    db_update("user_credits", array('credits' => $_G['user']['credits']['credits'] - $goods['credits']), "uid = {$_G['user']['uid']}");
                    db_insert("user_credits_log", array(
                        'time' => time(),
                        'credits' => -$goods['credits'],
                        'reason' => "积分商城消费积分",
                        'uid' => $_G['user']['uid']
                    ));
                    db_insert("mall_history", array(
                        'time' => time(),
                        'uid' => $_G['user']['uid'],
                        'state' => $goods['type'],
                        'gid' => $goods['gid'],
                        'credits' => $goods['credits'],
                        'gname' => $goods['gname'],
                        'num' => 1,
                        'image' => $goods['image'],
                        'abstract' => $goods['abstract']
                    ));
                    print "购买成功！";
                }
            }
        }
        break;
    case 'History':
        if($_G['user']['loginned']
            && isset($_GET['start'])) {
            $start = $_GET['start'];
            $query = db_query("SELECT * FROM mall_history WHERE uid = {$_G['user']['uid']} ORDER BY itemid DESC LIMIT $start, 10");
            include template("app/mall:history_item");
        }
        break;
    default:
        break;
}
?>