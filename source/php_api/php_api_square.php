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
    case 'sendDingLi':
        if(isset($_GET['text'])
            && $_GET['text']
            && $_G['user']['loginned'])
        {
            if(!isset($_GET['image']))
            {
                $_GET['image'] = "";
            }
            if(preg_match("/#Reply\[([^\]]*)\]#/i", $_GET['text'], $reply)){
                $reply = $reply[1];
                $_GET['text'] = str_ireplace("#Reply[{$reply}]#", "", $_GET['text']);
            }else{
                $reply = 0;
            }

            if(!isset($_GET['class']) || !in_array($_GET['class'], array(
                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10
                ))){
                $_GET['class'] = 8;
            }

            db_insert("square_hole", array(
                'uid' => $_G['user']['uid'],
                'time' => time(),
                'text' => $_GET['text'],
                'reply' => $reply,
                'likes' => 0,
                'hide' => 0,
                'hot' => 0,
                'type' => $_GET['class'],
                'image' => $_GET['image'],
                'lastpost' => time()
            ));
        }
        break;
    case 'DingLiList':
        if(isset($_GET['start'])
            && is_numeric($_GET['start'])
            && isset($_GET['type'])
            && $_G['user']['loginned'])
        {
            $hide_div = false;
            $query = "";
            if(!isset($_GET['class']) || !in_array($_GET['class'], array(
                1, 2, 3, 4, 5, 6, 7, 8, 9, 10
            ))){
                $_GET['class'] = 0;
                $condition = "1";
            }else{
                $condition = "type={$_GET['class']}";
            }
            if($_GET['type'] == "Hid"){
                if(isset($_GET['hid']) && is_numeric($_GET['hid'])){
                    if(isset($_GET['fresh'])){
                        $hide_div = true;
                    }
                    $query = db_query("SELECT * FROM square_hole WHERE hid={$_GET['hid']}");
                }
            }
            if($_GET['type'] == "Hot")
            {
                $last_week = time() - 86400 * 7;
                $last_day = time() - 86400;
                $query = db_query("SELECT * FROM square_hole WHERE lastpost >= $last_day AND time >= $last_week AND {$condition} ORDER BY hot DESC LIMIT {$_GET['start']}, 10");
            }
            if($_GET['type'] == "New")
            {
                $query = db_query("SELECT * FROM square_hole WHERE 1 AND {$condition} ORDER BY stick DESC, lastpost DESC, time DESC LIMIT {$_GET['start']}, 10");
            }
            if($_GET['type'] == "List")
            {
                $query = db_query("SELECT * FROM square_hole WHERE 1 AND {$condition} ORDER BY hid DESC LIMIT {$_GET['start']}, 10");
            }
            if($_GET['type'] == "Col")
            {
                $query = db_query("SELECT * FROM square_hole WHERE hid in (SELECT hid FROM square_hole_col WHERE uid = {$_G['user']['uid']}) AND {$condition} ORDER BY lastpost DESC, time DESC LIMIT {$_GET['start']}, 10");
            }
            if($_GET['type'] == "Search")
            {
                if(!isset($_GET['keyword'])){
                    $_GET['keyword'] = "";
                }else{
                    $_GET['keyword'] = str_ireplace("\\", "", $_GET['keyword']);
                    $_GET['keyword'] = str_ireplace("\"", "", $_GET['keyword']);
                }
                $_GET['keyword'] = urldecode($_GET['keyword']);
                if(substr($_GET['keyword'], 0, 2) == "@#")
                {
                    $hid = substr($_GET['keyword'], 2, 999);
                    if(is_numeric($hid)){
                        $query = db_query("SELECT * FROM square_hole WHERE hid = $hid LIMIT {$_GET['start']}, 10");
                    }else{
                        $hid = explode("-", $hid);
                        if(count($hid) == 2) {
                            $query = db_query("SELECT * FROM square_hole WHERE hid >= {$hid[0]} AND hid <= {$hid[1]} ORDER BY hid ASC LIMIT {$_GET['start']}, 10");
                        }
                    }
                }else {
                    $query = db_query("SELECT * FROM square_hole WHERE text like \"%{$_GET['keyword']}%\" AND {$condition} ORDER BY lastpost DESC, time DESC LIMIT {$_GET['start']}, 10");
                }
            }

            if($query){
                include template("app_style/{$_G['user']['style']}:square:dingli_list");
            }
        }
        break;
    case 'stick':
        if($_G['user']['loginned']
            && $_G['user']['identification']['verified'] == 7
            && isset($_GET['hid']))
        {
            if(db_fetch(db_query("SELECT stick FROM square_hole WHERE hid={$_GET['hid']}"))['stick'] == 0) {
                db_update("square_hole", array(
                    'stick' => 1
                ), "hid={$_GET['hid']}");
            }else{
                db_update("square_hole", array(
                    'stick' => 0
                ), "hid={$_GET['hid']}");
            }
        }
        break;
    case 'close':
        if($_G['user']['loginned']
            && $_G['user']['identification']['verified'] >= 6
            && isset($_GET['hid']))
        {
            if(db_fetch(db_query("SELECT closed FROM square_hole WHERE hid={$_GET['hid']}"))['closed'] == 0) {
                db_update("square_hole", array(
                    'closed' => 1
                ), "hid={$_GET['hid']}");
            }else{
                db_update("square_hole", array(
                    'closed' => 0
                ), "hid={$_GET['hid']}");
            }
        }
        break;
    case 'addComment':
        if($_G['user']['loginned']
            && isset($_GET['text'])
            && isset($_GET['hid']))
        {
            db_insert("square_hole_comments", array(
                'hid' => $_GET['hid'],
                'uid' => $_G['user']['uid'],
                'text' => $_GET['text'],
                'likes' => 0,
                'time' => time()
            ));
            db_update("square_hole", array(
                'lastpost' => time()
            ), "hid = {$_GET['hid']}");
            square_dingli_addHot($_GET['hid'], 2);
        }
        break;
    case 'delDingLi':
        if($_G['user']['loginned']
            && $_G['user']['identification']['verified'] > 5
            && isset($_GET['hid']))
        {
            db_update("square_hole", array('hide' => 1), "hid={$_GET['hid']}");
        }
        break;
    case 'delComment':
        if($_G['user']['loginned']
            && $_G['user']['identification']['verified'] > 5
            && isset($_GET['cid']))
        {
            db_update("square_hole_comments", array('hide' => 1), "cid={$_GET['cid']}");
        }
        break;
    case 'colDingLi':
        if($_G['user']['loginned']
            && isset($_GET['hid']))
        {
            if($colid = db_fetch(db_query("SELECT colid FROM square_hole_col WHERE hid={$_GET['hid']} AND uid={$_G['user']['uid']}")))
            {
                square_dingli_addHot($_GET['hid'], -2);
                $colid = $colid['colid'];
                db_delete("square_hole_col", "colid=$colid");
                exit('已经取消收藏！');
            }else {
                square_dingli_addHot($_GET['hid'], 2);
                db_insert("square_hole_col", array("uid" => $_G['user']['uid'], "hid" => $_GET['hid']));
                exit('收藏成功！');
            }
        }
        break;
    case 'repDingLi':
        if($_G['user']['loginned']
            && isset($_GET['hid'])
            && is_numeric($_GET['hid']))
        {
            if($rid = db_fetch(db_query("SELECT rid FROM square_hole_reports WHERE hid={$_GET['hid']} AND uid={$_G['user']['uid']}")))
            {
                square_dingli_addRep($_GET['hid'], -1);
                $rid = $rid['rid'];
                db_delete("square_hole_reports", "rid=$rid");
            }else {
                square_dingli_addRep($_GET['hid'], 1);
                db_insert("square_hole_reports", array("uid" => $_G['user']['uid'], "hid" => $_GET['hid']));
            }
            exit(db_fetch(db_query("SELECT COUNT(rid) FROM square_hole_reports WHERE hid={$_GET['hid']}"))[0]);
        }
        break;
    case 'zanDingLi':
        if($_G['user']['loginned']
            && isset($_GET['hid']))
        {
            if($likeid = db_fetch(db_query("SELECT likeid FROM square_hole_like WHERE hid={$_GET['hid']} AND uid={$_G['user']['uid']}")))
            {
                $likeid = $likeid['likeid'];
                db_delete("square_hole_like", "likeid=$likeid");
                print(square_dingli_addLike($_GET['hid'], -1));
            }else{
                db_insert("square_hole_like", array("uid" => $_G['user']['uid'], "hid" => $_GET['hid']));
                print(square_dingli_addLike($_GET['hid'], 1));
            }
            exit();
        }
        break;
    case 'zanComment':
        if($_G['user']['loginned']
            && isset($_GET['cid']))
        {
            $cid = $_GET['cid'];
            $comment = db_fetch(db_query("select * from square_hole_comments where cid=$cid"));
            if($likeid = db_fetch(db_query("SELECT id FROM square_comments_likes WHERE cid={$_GET['cid']} AND uid={$_G['user']['uid']}")))
            {
                $likeid = $likeid['id'];
                db_delete("square_comments_likes", "id=$likeid");
                $new_likes = $comment['likes'] - 1;
                square_dingli_addHot($comment['hid'], -1);
            }else{
                $new_likes = $comment['likes'] + 1;
                square_dingli_addHot($comment['hid'], 1);
                db_insert("square_comments_likes", array("uid" => $_G['user']['uid'], "cid" => $cid));
            }
            db_update("square_hole_comments", array("likes" => $new_likes), "cid=$cid");

            print $new_likes;
        }
        break;
    case 'WeiHuaList':
        if(isset($_GET['start'])
            && isset($_GET['type'])
            && $_G['user']['loginned'])
        {
            $query = "";
            if(!isset($_GET['class']) || !in_array($_GET['class'], array(
                    1, 2, 3, 4, 5, 6, 7, 8
                ))){
                $_GET['class'] = 0;
                $condition = "1";
            }else{
                $condition = "type={$_GET['class']}";
            }
            if($_GET['type'] == "Hot")
            {
                $last_week = time() - 604800;
                $query = db_query("SELECT * FROM square_hole WHERE time >= $last_week AND {$condition} ORDER BY hot DESC LIMIT {$_GET['start']}, 10");
            }
            if($_GET['type'] == "New")
            {
                $query = db_query("SELECT * FROM square_hole WHERE 1 AND {$condition} ORDER BY time DESC LIMIT {$_GET['start']}, 10");
            }
            if($_GET['type'] == "Col")
            {
                $query = db_query("SELECT * FROM square_hole WHERE hid in (SELECT hid FROM square_hole_col WHERE uid = {$_G['user']['uid']}) AND {$condition} ORDER BY time DESC LIMIT {$_GET['start']}, 10");
            }

            if($query){
                include template("app/square:weihua_list");
            }
        }
        break;
    default:
        break;
}
?>