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
    case 'getMail':
        if($_G['user']['loginned']
            && !db_fetch(db_query("SELECT lid FROM activity_mail_received WHERE replied = 0 AND `type` = 1 AND uid = ".$_G['user']['uid']))){
            $grade = $_SETTINGS['year'] - $_G['user']['profile']['grade'] + 1;
            $query = db_query("SELECT title, contents, letterid, received FROM activity_mail_letter WHERE `open` = 0 AND received < 10 AND uid != {$_G['user']['uid']} AND received < plimit AND letterid not in (SELECT lid FROM activity_mail_received WHERE uid = {$_G['user']['uid']}) AND (gender = 0 OR gender = {$_G['user']['profile']['gender']}) AND grade{$grade} = 1 ORDER BY RAND()");
            $query_count = db_count($query);
            if($query_count >= 4)
            {
                $letter = db_fetch($query);
                if(!preg_match("/\{img([^\}]*)\}/i", $letter['contents'], $imgid)){
                    $imgid = 0;
                }else{
                    $imgid = $imgid[1];
                }
                db_insert("activity_mail_received", array(
                    'uid' => $_G['user']['uid'],
                    'lid' => $letter['letterid'],
                    'read' => 0,
                    'time' => time(),
                    'subject' => $letter['title'],
                    'abstract' => substr(preg_replace("/\{img([^\}]*)\}/i", "", $letter['contents']), 0, 300),
                    'replied' => 0,
                    'image' => $imgid,
                    'known' => 0,
                    'type' => 1
                ));
                db_update("activity_mail_letter", array('received' => $letter['received'] + 1), "letterid = {$letter['letterid']}");
                print "取件成功！快去收件箱看看吧~";
            }elseif($query_count > 0){
                $query = db_query("SELECT `time` FROM activity_mail_letter WHERE `open` = 0 AND received < 10 AND uid != {$_G['user']['uid']} AND received < plimit AND letterid not in (SELECT lid FROM activity_mail_received WHERE uid = {$_G['user']['uid']}) AND (gender = 0 OR gender = {$_G['user']['profile']['gender']}) AND grade{$grade} = 1 ORDER BY `time` ASC");
                $min_time = db_fetch($query)['time'];
                $expect_time = floor((time() - $min_time) * (4 - $query_count) / ($query_count * 60));
                if($expect_time >= 2000)
                {
                    $expect_time = "12-24 20:00";
                }else{
                    if($expect_time >= 60)
                    {
                        $hour = floor($expect_time / 60);
                        $expect_time %= 60;
                        if($expect_time > 0){
                            $expect_time .= "分钟";
                            $expect_time = $hour."小时".$expect_time;
                        }else{
                            $expect_time = $hour."小时";
                        }
                    }else{
                        $expect_time .= "分钟";
                    }
                }
                print "取件失败，信件正在配送途中，预计{$expect_time}后可以取件~";
            }else{
                $query = db_query("SELECT title, contents, letterid, received FROM activity_mail_letter WHERE `open` = 0 AND uid != {$_G['user']['uid']} AND received < plimit AND letterid not in (SELECT lid FROM activity_mail_received WHERE uid = {$_G['user']['uid']}) AND (gender = 0 OR gender = {$_G['user']['profile']['gender']}) AND grade{$grade} = 1 ORDER BY `time` ASC");
                $query_count = db_count($query);
                if($query_count == 0)
                {
                    $letter = db_fetch($query);
                    if(!preg_match("/\{img([^\}]*)\}/i", $letter['contents'], $imgid)){
                        $imgid = 0;
                    }else{
                        $imgid = $imgid[1];
                    }
                    db_insert("activity_mail_received", array(
                        'uid' => $_G['user']['uid'],
                        'lid' => $letter['letterid'],
                        'read' => 0,
                        'time' => time(),
                        'subject' => $letter['title'],
                        'abstract' => substr(preg_replace("/\{img([^\}]*)\}/i", "", $letter['contents']), 0, 300),
                        'replied' => 0,
                        'image' => $imgid,
                        'known' => 0,
                        'type' => 1
                    ));
                    db_update("activity_mail_letter", array('received' => $letter['received'] + 1), "letterid = {$letter['letterid']}");
                    print "取件成功！快去收件箱看看吧~";
                }else {
                    print "取件失败，信件正在配送途中~";
                }
            }
        }
        break;
    default:
        break;
}

?>
