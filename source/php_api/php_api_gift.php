<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['func']))
{
    $func = $_GET['func'];
}else{
    exit('false');
}

switch ($func){
    case 'read_pwd':
        if(isset($_GET['giftid'])
            && is_numeric($_GET['giftid'])
            && isset($_GET['pwd'])){
            $pwd = db_fetch(db_query("SELECT * FROM home_gift WHERE giftid = {$_GET['giftid']}"));
            if($pwd['giftid'] == 1) {
                $attens = db_fetch(db_query("SELECT fans FROM home_fans WHERE uid = {$_G['user']['uid']}"));
                $chance = db_fetch(db_query("SELECT chance FROM activity_year_chance WHERE uid = {$_G['user']['uid']}"));
                if($chance){
                    $chance = $chance['chance'];
                }else{
                    $chance = 0;
                }
                if ($attens['fans'] + 1 + $chance <= db_count(db_query("SELECT infoid FROM home_gift_info WHERE uid = {$_G['user']['uid']} AND giftid = 1"))){
                    die("没有更多抽奖机会啦！");
                }
            }
            if($pwd['loginverify'] && !$_G['user']['loginned']){
                die();
            }
            $info_pwd = md5(rand(1,99999).time());
            if($_GET['pwd'] == $pwd['pwd']
                && $pwd['gift_persons'] < $pwd['personlimit']
                && time() < $pwd['timelimit']
                && $pwd['gift_got'] < $pwd['giftlimit']){
                $get_gift = 0;
                if($pwd['type'] == 1){
                    $gift_remain = $pwd['giftlimit'] - $pwd['gift_got'];
                    $gift_remain_person = $pwd['personlimit'] - $pwd['gift_persons'];
                    if($pwd['isFloat'] == 1){
                        $gift_remain *= 100;
                    }
                    if($gift_remain_person == 1){
                        $get_gift = $gift_remain;
                    } else {
                        $min_get = 1;
                        $max_get = ($gift_remain * 2) / $gift_remain_person;
                        if(rand(0, 9) == 9 && $gift_remain_person >= 1000){
                            $max_get = ($gift_remain * 3) / $gift_remain_person;
                        }
                        $get_gift = rand($min_get, (floor($max_get) > $min_get)?floor($max_get):$min_get);
                        if(rand(0,9999) == 9 && $gift_remain_person >= 1000 && $gift_remain >= 4000){
                            $get_gift = 2021;
                        }
                        if(rand(0,99) == 9 && $gift_remain_person >= 1000 && $gift_remain >= 6000){
                            $max_get = 520;
                        }
                    }
                    if($pwd['isFloat'] == 1){
                        $get_gift /= 100;
                    }
                }
                if($pwd['type'] == 4){
                    $probability = $pwd['probability'] * 1000000;
                    if(rand(1, 100000000) <= $probability){
                        $get_gift = 1;
                    }
                }
                db_insert("home_gift_info", array(
                    'giftid' => $_GET['giftid'],
                    'pwd' => $info_pwd,
                    'get_gift' => $get_gift,
                    'uid' => $_G['user']['loginned']?$_G['user']['uid']:0
                ));
                db_add("home_gift", array(
                    "gift_got" => $get_gift,
                    "gift_persons" => 1
                ), array("giftid" => $_GET['giftid']));
                if($pwd['type'] == 4 && $get_gift == 1) {
                    print "恭喜您中奖啦，您的领奖密钥是{$info_pwd}，您可以截图本页联系发起人兑奖！";
                }
                if($pwd['type'] == 4 && $get_gift == 0) {
                    print "很遗憾，您没有中奖。";
                }
                if($pwd['type'] == 3) {
                    print "抽奖成功，您的领奖密钥是{$info_pwd}，开奖后您如中奖，可以截图本页联系发起人兑奖！";
                }
                if($pwd['type'] == 2) {
                    print "抽奖成功，您的领奖密钥是{$info_pwd}，开奖后您如中奖，可以截图本页联系发起人兑奖！";
                }
                if($pwd['type'] == 1) {
                    if($pwd['isCredits']){
                        print "恭喜您中奖啦，{$get_gift}积分已经到账。";
                        credits_update($_G['user']['uid'], $get_gift, "抽奖获得");
                    }else {
                        print "恭喜您中奖啦，您获得奖品数量{$get_gift}！您的领奖密钥是{$info_pwd}，您可以截图本页联系发起人兑奖。";
                    }
                }
            }else{
                print "没有抽奖机会了！";
            }
        }else{
            exit();
        }
        break;
    default:
        break;
}

?>