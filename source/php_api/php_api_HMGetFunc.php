<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200909, By 张运筹
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

switch ($func) {
    case 'AddRequest': #发起需求，需要登录状态、发起时间、接单截止时间、送达截止时间、支付积分、起点、终点、联系方式、备注
        if($_G['user']['loginned']
            && isset($_GET['start'])
            && isset($_GET['end'])
            && isset($_GET['time3'])
            && isset($_GET['time5'])
            && isset($_GET['mobile'])
            && isset($_GET['type'])
            && isset($_GET['credits'])
            && isset($_GET['others']))
        {
            $uid = $_G['user']['uid'];
            $start = $_GET['start'];
            $end = $_GET['end'];
            $time1 = time();
            $time3 = 60 * $_GET['time3'] + time();
            $time5 = $_GET['time5'];
            $mobile = $_GET['mobile'];
            $type = $_GET['type'];
            $credits = $_GET['credits'];
            $others = $_GET['others'];
            //变量定义
            if($_G['user']['credits']['vip'] >= $time1)
            {
                $time1 = $time1 - 600;
            }
            if($_G['user']['credits']['credits'] >= $credits) {
                credits_update($_G['user']['uid'], -$credits, "发起代取需求");
                db_insert("HMGet_needs", array(
                    'start' => "$start",
                    'end' => "$end",
                    'time1' => "$time1",
                    'time3' => "$time3",
                    'time5' => "$time5",
                    'mobile' => "$mobile",
                    'type' => "$type",
                    'credits' => "$credits",
                    'others' => "$others",
                    'uid' => "$uid",
                    'state' => 0
                ));
            }
            print "true";

            #排队接单
            $endTime = $time5 * 60 + $time3;
            $queue = db_fetch(db_query("SELECT uid, got_num FROM HMGet_getRequest WHERE credits <= $credits AND start LIKE \"%$start%\" AND stop LIKE \"%$end%\" AND time < $endTime AND got_num < num ORDER BY queue DESC"));
            if($queue){
                $nid = db_fetch(db_query("SELECT nid FROM HMGet_needs WHERE uid = $uid AND time1 = $time1"))['nid'];
                $uid = $queue['uid'];
                $time2 = $time3;
                db_update("HMGet_needs",
                    array('uid2' => $uid,
                        'time2' => $time2,
                        'time5' => $endTime,
                        'state' => 1),
                    "nid = $nid");
                db_update("HMGet_getRequest", array(
                    'queue' => time(),
                    'got_num' => $queue['got_num'] + 1
                ), "uid = $uid");
            }
        }
        break;
    case 'GetRequest': #接单，需要单号、登录状态、接单截止时间、当前时间
        if(isset($_GET['nid'])
            && $_G['user']['loginned'])
        {
            $nid = $_GET['nid'];
            $uid = $_G['user']['uid'];
            $time2 = time();
            $query = db_query("SELECT time3, time5 FROM HMGet_needs WHERE nid = $nid AND state = 0");
            if($query)
            {
                $init = db_fetch($query);
                $time3 = $init['time3'];
            }else{
                exit('false');
            }

            if($time2 >= $time3)
            {
                exit('false');
            }
            db_update("HMGet_needs",
                array('uid2' => $uid,
                    'time2' => $time2,
                    'time5' => $time2 + $init['time5'] * 60,
                    'state' => 1),
                "nid = $nid");
            print 'true';
        }else{
            print 'false';
        }
        break;
    case 'FinishRequest': #结束需求，需要登录状态、当前时间、送达截止时间、支付积分、接单人
        if(isset($_GET['nid'])
            && $_G['user']['loginned'])
        {
            if($_G['user']['identification']['verified'] > 5)
                $add = "(管理员确认收到，管理号：{$_G['user']['uid']})";
            $nid = $_GET['nid'];
            $uid = $_G['user']['uid'];
            $time4 = time();
            $query = db_query("SELECT uid, uid2, credits, state FROM HMGet_needs WHERE nid = $nid");
            if($query)
            {
                $need_uid = db_fetch($query);
            }else{
                exit('false');
            }

            if($uid != $need_uid['uid'] && $_G['user']['identification']['verified'] <= 5)
            {
                exit('false');
            }

            if($need_uid['state'] == 2)
            {
                exit('false');
            }

            db_update("HMGet_needs",
                array('time4' => $time4,
                    'state' => 2),
                "nid = $nid");
            credits_update($need_uid['uid2'], $need_uid['credits'] - 2, "帮忙代取收获积分(收取2积分交易税){$add}");

            if(time() <= 1600012800) {
                $credits_logs = db_count(db_query(
                    "SELECT lid FROM user_credits_log WHERE uid = {$need_uid['uid2']} AND reason LIKE \"%帮忙代取%\""
                ));
                if ($credits_logs == 0) {
                    credits_update($need_uid['uid2'], 30, "活动赠送");
                }
                if ($credits_logs == 1) {
                    credits_update($need_uid['uid2'], 20, "活动赠送");
                }
                if ($credits_logs == 2) {
                    credits_update($need_uid['uid2'], 15, "活动赠送");
                }
            }
            //9.11-9.13活动赠送积分

            print 'true';
        }else{
            print 'false';
        }
        break;
    case 'RequestList':
        if($_G['user']['loginned']
            && isset($_GET['start'])
            && isset($_GET['type']))
        {
            $sql = "";
            $start = $_GET['start'];
            $uid = $_G['user']['uid'];
            $needtype = array("未定义", "小件", "标准件", "大件");
            switch ($_GET['type'])
            {
                case 'myRequest':
                    $condition = "WHERE uid = $uid";
                    if($_G['user']['identification']['verified'] > 5){
                        $condition = "WHERE 1";
                    }
                    break;
                case 'myTask':
                    $condition = "WHERE uid2 = $uid";
                    break;
                case 'ToDo':
                    $condition = "WHERE NOT (state = 0 and time3 <= ".time().")";
                    if(isset($_GET['todo_start']) and $_GET['todo_start'] != '')
                    {
                        $_GET['todo_start'] = str_ireplace("OR", "", $_GET['todo_start']);
                        $_GET['todo_start'] = str_ireplace("AND", "", $_GET['todo_start']);
                        $condition = $condition." and start LIKE \"%".$_GET['todo_start']."%\"";
                    }
                    if(isset($_GET['todo_end']) and $_GET['todo_end'] != '')
                    {
                        $_GET['todo_end'] = str_ireplace("OR", "", $_GET['todo_end']);
                        $_GET['todo_end'] = str_ireplace("AND", "", $_GET['todo_end']);
                        $condition = $condition." and end LIKE \"%".$_GET['todo_end']."%\"";
                    }
                    break;
                default:
                    break;
            }
            $query = db_query("SELECT * FROM HMGet_needs ".$condition." ORDER BY (`state` < 2) DESC,`time1` DESC LIMIT $start, 10");
            include template("app/HMGet:RequestList");
        }else{
            print '';
        }
        break;
    case 'DeleteRequest':
        if($_G['user']['loginned']
            && isset($_GET['nid']))
        {
            $nid = $_GET['nid'];
            $need = db_fetch(db_query("SELECT uid, credits, time3 FROM HMGet_needs WHERE nid = $nid"));
            if(($_G['user']['uid'] == $need['uid']
                && $need['state'] != 1)
                || $_G['user']['identification']['verified'] > 5)
            {
                if($_G['user']['identification']['verified'] > 5)
                    $add = "(管理员删除，管理号：{$_G['user']['uid']})";
                if($need['state'] == 0 && time() <= $need['time3'])
                {
                    credits_update($need['uid'], $need['credits'] * 0.8, "撤回需求，返还80%支付积分$add");
                }elseif($need['state'] == 0){
                    credits_update($need['uid'], $need['credits'], "撤回需求，返还100%支付积分$add");
                }
                db_delete("HMGet_needs", "nid = $nid");
                print 'true';
            }else{
                print 'false';
            }
        }else{
            print 'false';
        }
        break;
    case 'CreditsLog':
        if($_G['user']['loginned']
            && isset($_GET['start'])) {
            $start = $_GET['start'];
            $query = db_query("SELECT * FROM user_credits_log WHERE uid={$_G['user']['uid']} ORDER BY time DESC LIMIT $start, 10");
            include template("app/HMGet:CreditsLog");
        }
        break;
    case 'Credits':
        if($_G['user']['loginned']
            && isset($_GET['start'])) {
            $start = $_GET['start'];
            $query = db_query("SELECT * FROM user_credits_ask WHERE uid != {$_G['user']['uid']} AND credits <= {$_G['user']['credits']['credits']} AND credits != 0 AND uid2 = 0 ORDER BY credits DESC LIMIT $start, 10");
            include template("app/HMGet:Credits");
        }
        break;
    case 'AskForCredits':
        if($_G['user']['loginned']
            && isset($_GET['mobile'])
            && isset($_GET['credits'])) {
            if($_GET['credits'] > $_G['user']['rest_confidence'])
            {
                $_GET['credits'] = $_G['user']['rest_confidence'];
            }
            credits_update($_G['user']['uid'], $_GET['credits'], "求购积分", false);
            $_GET['credits'] += $_G['user']['credits_ask']['credits'];
            db_update("user_credits_ask", array(
                'credits' => $_GET['credits'],
                'mobile' => $_GET['mobile']
            ), "uid={$_G['user']['uid']}");
        }
        break;
    case 'SellCredits':
        if($_G['user']['loginned']
            && isset($_GET['mobile2'])
            && isset($_GET['uid'])) {
            $creditsRequest = db_fetch(db_query(
                "SELECT credits, uid2 FROM user_credits_ask WHERE uid={$_GET['uid']}"
            ));
            if($_G['user']['credits']['credits'] < $creditsRequest['credits'] || $creditsRequest['uid2'])
            {
                exit('false');
            }
            credits_update($_G['user']['uid'], -$creditsRequest['credits'], "售出积分");
            db_update("user_credits_ask", array(
                'uid2' => $_G['user']['uid'],
                'mobile2' => $_GET['mobile2']
            ), "uid={$_GET['uid']}");
            db_insert("user_credits_debt", array(
                'uid1' => $_GET['uid'],
                'uid2' => $_G['user']['uid'],
                'time' => time(),
                'debt' => $creditsRequest['credits']
            ));
            print 'true';
        }
        break;
    case 'finishCredits':
        if($_G['user']['loginned']) {
            db_update("user_credits_ask", array(
                'uid2' => 0,
                'credits' => 0
            ), "uid={$_G['user']['uid']}");
            print 'true';
        }
        break;
    default:
        print 'false';
        break;
}

?>