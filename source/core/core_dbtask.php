<?php

/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

//const NOFOOTER = 1;

if(!isset($_GET['type']))
{
    die('Access denied!');
}else{
    $type = $_GET['type'];
}

if($type == 1)
{//发表评论
    if(!$_G['user']['loginned'])
    {
        die('Access denied!');
    }
    if(isset($_GET['hidename'])
        && isset($_GET['text'])
        && isset($_GET['tid'])){
        $hidename = $_GET['hidename'];
        $text = $_GET['text'];
        $tid = $_GET['tid'];
        db_insert('square_comments', array(
            'tid' => $tid,
            'text' => $text,
            'uid' => $_G['user']['uid'],
            'hidename' => $hidename
        ));

        db_update(
            'square_talk',
            array(
                'comments' => db_fetch(db_query("select comments from square_talk where tid=$tid"))['comments'] + 1
            ),
            "tid=$tid");
    }
}elseif($type == 2)
{
    if(isset($_GET['tid'])) {
        $tid = $_GET['tid'];
        if (!isset($_COOKIE["zan_$tid"])) {
            if(!$_G['user']['loginned'] || $_G['user']['identification']['verified'] <= 5){
                setcookie("zan_$tid", 1, time() + 86400);
            }
            db_update(
                'square_talk',
                array(
                    'positive' => db_fetch(db_query("select positive from square_talk where tid=$tid"))['positive'] + 1
                ),
                "tid=$tid");

            $uid = db_fetch(db_query("select uid from square_talk where tid=$tid"))['uid'];
            $query = db_query("select positive from user_ext where uid=$uid");
            if($fetch = db_fetch($query))
            {
                db_update("user_ext", array(
                    "positive" => $fetch['positive'] + 1
                ), "uid=$uid");
            }else{
                db_insert("user_ext", array(
                    "positive" => 1,
                    "uid" => $uid
                ));
            }

            if($_G['user']['loginned']){
                CORE_SENDMESSAGE(
                    db_fetch(db_query("select uid from square_talk where tid=$tid"))['uid'],
                    "我在 ".date("Y-m-d H:i:s", time())." 点赞了您的 $tid 号动态。",
                    $_G['user']['name'],
                    db_fetch(db_query("select text from square_talk where tid=$tid"))['text']
                );
            }
        }
        echo(db_fetch(db_query("select positive from square_talk where tid=$tid"))['positive']);
    }
}elseif($type == 3)
{
    $uid = db_fetch(db_query("select uid from common_user_sign order by uid desc"))['uid'];
    $ans = get_user(rand(10000, $uid));
    echo "<div style='text-align: center'>";
    echo "<a href='index.php?mod=user&action=profile&uid=".$ans['common']['uid']."'><img src='".$ans['profile']['avatar']."' width='240px' height='240px'></a><br>";
    echo "<a href='index.php?mod=user&action=profile&uid=".$ans['common']['uid']."'><font color='white'>".$ans['common']['name']."</font></a>";
    echo "</div>";
}elseif($type == 4)
{
    if(isset($_GET['mid']))
    {
        $mid = $_GET['mid'];
        db_update(
            'user_messagelist',
            array(
                'read' => 1
            ),
            "messageid=$mid and uid=".$_G['user']['uid']);
    }
}elseif($type == 5)
{
    if(isset($_GET['mid']))
    {
        $mid = $_GET['mid'];
        db_update(
            'user_messagelist',
            array(
                'read' => 0
            ),
            "messageid=$mid and uid=".$_G['user']['uid']);
    }
}elseif($type == 6)
{
    if(isset($_GET['uid']) && $_GET['type'] == 6)
    {
        db_insert('user_attention',
        array('uid' => $_G['user']['uid'],
            'to_uid' => $_GET['uid']));
        CORE_SENDMESSAGE($_GET['uid'], $_G['user']['name']."在 ".date("Y-m-d H:i:s")." 关注了你！");
        print 1;
    }
}elseif($type == 7)
{
    if(isset($_GET['uid']))
    {
        db_delete('user_attention',
            "uid = ".$_G['user']['uid']." and to_uid=".$_GET['uid']);
    }
}elseif($type == 8)
{
    if(isset($_GET['name'])
        && isset($_GET['guxiang'])
        && isset($_GET['yuanxi'])
        && isset($_GET['birthday'])
        && isset($_GET['favorite'])
        && isset($_GET['sex'])
        && isset($_GET['words']))
    {
        $uid=$_G['user']['uid'];
        $name = $_GET['name'];
        $guxiang = $_GET['guxiang'];
        $yuanxi = $_GET['yuanxi'];
        $birthday = $_GET['birthday'];
        $favorite = $_GET['favorite'];
        $sex = $_GET['sex'];
        $words = $_GET['words'];

        db_update('common_user_sign',
            array(
                'name' => $name
            ),
            "uid=$uid"
        );
        db_update('user_profile',
            array(
                'guxiang' => $guxiang,
                'yuanxi' => $yuanxi,
                'birthday' => $birthday,
                'favorite' => $favorite,
                'sex' => $sex,
                'words' => $words
            ),
            "uid=$uid"
        );
    }
}elseif($type == 9)
{
    if(isset($_GET['asktype'])){
        $asktype = $_GET['asktype'];
        if($asktype == 1){
            if($_G['user']['loginned'] && $_G['user']['identification']['verified'] > 0){
                $text = $_GET['sendtext'];
                $from = $_G['user']['name'];
                $name = $_GET['name'];
                CORE_SENDMESSAGE($_GET['uid'],
                    "$name ，你好鸭~我在".date("Y-m-d H:i:s", time())."来访问了你的空间！我想对你说：<div class=\"quote\"> $text </div>"
                    , $from);
            }else{
                $warn = "请先通过南大学生认证再发送消息！";
            }
        }elseif($asktype == 2)
        {
            if($_G['user']['loginned'] && $_G['user']['identification']['verified'] > 0){
                $text = $_GET['sendtext'];
                $rid = $_GET['rid'];

                $room = db_fetch(db_query("SELECT * FROM common_user_interaction_room WHERE rid = $rid"));
                if(!$room || !$rid)
                {
                    $warn = "没有找到该房间！";
                }else{

                    $room['adminid'] = explode(",", $room['adminid']);
                    if($room['userid']) {
                        $room['userid'] = explode(",", $room['userid']);
                    }else{
                        $room['userid'] = array();
                    }
                    $persons = count($room['adminid']) + count($room['userid']);

                    if(!in_array($_G['user']['uid'], $room['adminid'])
                        && !in_array($_G['user']['uid'], $room['userid'])) {
                        if ($room['allowjoin'] == 2) {
                            $warn = "该房间是私密型或者设置为禁止任何人加入";
                        } elseif (($room['type'] == 1 && $persons >= 200) || ($room['type'] == 0 && $persons >= 25)){
                            $warn = "该房间已满员";
                        } elseif ($room['allowjoin'] == 1) {
                            echo "　✅验证通过，成功加入房间，<a href='index.php?mod=user&action=interaction_message&rid=$rid'>请点击此处进入房间</a>。";
                            foreach($room['adminid'] as $value)
                            {
                                CORE_SENDMESSAGE($value,
                                    "由于房间是任何人可以加入的，我没有通过验证直接加入了房间 ".db_fetch(db_query("select name from common_user_interaction_room_profile where rid=$rid"))['name']
                                    , $_G['user']['name']);
                            }
                            db_update('common_user_interaction_room', array(
                                'userid' => join(',', array_merge($room['userid'], array($_G['user']['uid'])))
                            ), "rid=$rid");
                            db_insert('common_user_interaction_message',
                                array(
                                    'rid'=>$rid,
                                    'uid' => $_G['user']['uid'],
                                    'contents' => "大家好，很高兴加入本群。^p$text",
                                    'type' => 0
                                ));
                        } elseif ($room['allowjoin'] == 0) {
                            if(!$_GET['sendtext'])
                            {
                                $warn="请输入验证消息！";
                            }else{
                                echo "　✅请求已发送，请等待房间管理员同意";
                                foreach($room['adminid'] as $value)
                                {
                                    CORE_SENDMESSAGE($value,
                                        "您好！我申请加入房间 ".db_fetch(db_query("select name from common_user_interaction_room_profile where rid=$rid"))['name']
                                        , $_G['user']['name'],
                                        "$text".
                                        "<div align='right' style='width: 96%' id='room_{messageid}'>".
                                        "<a href='javascript:;' onclick=\"room_allow('".$_G['user']['uid']."', '{messageid}', '$rid')\">批准</a>".
                                        " | <a href='javascript:;' onclick=\"read('{messageid}', '{this_i}')\">忽略</a></div>".
                                        "<script src='./source/js/messagelist_roomallow.js'></script>"
                                    );
                                }
                            }
                        }
                    } else {
                        $warn = "你已经加入该房间！<a href='index.php?mod=user&action=interaction_message&rid=$rid'>请点击此处进入房间</a>";
                    }
                }
            }else{
                $warn = "请先通过南大学生认证再发送请求！";
            }
        }elseif($asktype == 3)
        {
            if(isset($_GET['DeleteTID']) && isset($_GET['sendtext']) && $_GET['sendtext']){
                if($_G['user']['identification']['verified'] > 5)
                {
                    $tid = $_GET['DeleteTID'];
                    $text = $_GET['sendtext'];
                    $talkuid = db_fetch(db_query("select uid from square_talk where tid=$tid"))['uid'];
                    CORE_SENDMESSAGE(
                        $talkuid,
                        "您的动态已于 ".date("Y-m-d H:i:s", time())." 被管理员 ".$_G['user']['name']." 进行删除操作",
                        "系统消息",
                        "操作理由: $text"
                    );
                    db_delete("square_talk", "tid=$tid");
                    echo "☑成功删除！";
                }
            }else{
                $warn = "请输入操作理由！";
            }
        }
    }
}elseif($type == 10)
{
    if($_G['user']['loginned'] && $_G['user']['identification']['verified'] > 0 && isset($_POST["avatar_img"]))
    {
        $base64_img = $_POST["avatar_img"];
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){
            $type = $result[2];
            $new_file = 'data/avatar/'.$_G['user']['uid'].'.jpg';
            file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_img)));
            $image = (new imgcompress($new_file,1))->compressImg($new_file);
            db_update("user_profile", array('avatar' => 1), "uid=".$_G['user']['uid']);
        }
    }
}elseif($type == 11)
{
    if(isset($_GET['rid']) && isset($_GET['uid']))
    {
        $uid = $_GET['uid'];
        $rid = $_GET['rid'];

        $room = db_fetch(db_query("SELECT * FROM common_user_interaction_room WHERE rid = $rid"));
        $room['adminid'] = explode(",", $room['adminid']);
    }
}elseif($type == 12)
{
    if(isset($_GET['userpic']) && isset($_GET['cardpic']) && isset($_GET['confidence']))
    {
        $uid = $_G['user']['uid'];
        $confidence = $_GET['confidence'];
        $userpic = $_GET['userpic'];
        $cardpic = $_GET['cardpic'];

        db_update('common_user_identification',array(
            'confidence' => $confidence,
            'userpic' => $userpic,
            'cardpic' => $cardpic,
            'verified' => 0
        ), "uid=$uid");
    }
}elseif($type == 13)
{
    if(isset($_GET['uid'])
        && isset($_GET['rid'])
        && isset($_GET['msgid']))
    {
        $aid = $_GET['uid'];
        $uid = $_G['user']['uid'];
        $rid = $_GET['rid'];
        $mid = $_GET['msgid'];

        $room = db_fetch(db_query("SELECT * FROM common_user_interaction_room WHERE rid = $rid"));
        $room['adminid'] = explode(",", $room['adminid']);
        if(in_array($uid, $room['adminid']))
        {
            $room['userid'] = explode(",", $room['userid']);
            $room['userid'][] = $aid;
            $room['userid'] = join(",", $room['userid']);
            db_update('common_user_interaction_room',
                array(
                    'userid' => $room['userid']
                ),
                "rid=$rid");

            db_update('user_messagelist',
                array(
                    'quote' => $_G['user']['name']."已于 ".date("Y-m-d H:i:s")." 批准加入！"
                ),
                "messageid=$mid");

            CORE_SENDMESSAGE($aid, $_G['user']['name']."已于 ".date("Y-m-d H:i:s")." 批准您加入第 $rid 号房间！<a href='javascript:;' onclick=\"open_onwindow('index.php?mod=user&action=interaction_message&rid=$rid')\"> 点击这里进入房间 </a>", $_G['user']['name']);
        }
    }
}elseif($type == 14)
{
    if(isset($_POST["knowledge"])
        && isset($_POST["marks"])
        && isset($_POST["gains"])
        && isset($_POST["teacher"])
        && isset($_POST["costtime"])
        && isset($_POST["exam"])
        && isset($_POST["special"])
        && isset($_POST["others"])
        && $_G['user']['loginned']
        && isset($_POST["blanking"])
        && time() - $_POST["blanking"] >= 4)
    {
        $classid = $_POST["classid"];
        $knowledge = 5 - $_POST["knowledge"];
        $marks2 = $_POST["marks"];
        if($marks2 <= 80){
            $marks = ($marks2 / 10) - 6;
        }else {
            $marks = 0.15 * $marks2 - 10;
        }
        $gains = $_POST["gains"];
        $teacher = $_POST["teacher"];
        $costtime2 = $_POST["costtime"];
        if($costtime2 <= 2){
            $costtime = 5 - ($costtime2 / 2);
        }elseif($costtime2 <= 4){
            $costtime = 6 - $costtime2;
        }elseif($costtime2 <= 8){
            $costtime = 3 - $costtime2 / 4;
        }else{
            $costtime = 5 - ($costtime2 / 2);
        }
        $exam = $_POST["exam"];
        $special = $_POST["special"];
        $others = $_POST["others"];
        mark_class($classid, $_G['user']['uid'], array(
            'knowledge' => $knowledge,
            'marks' => $marks,
            'gains' => $gains,
            'teacher' => $teacher,
            'costtime' => $costtime,
            'exam' => $exam,
            'special' => $special,
            'others' => $others,
            'blanking' => time() - $_POST["blanking"]
        ));
    }
}elseif($type == 15)
{
    if(isset($_GET['ClassId'])
        && isset($_GET['question'])
        && isset($_G['user']['uid']))
    {
        db_insert("common_user_interaction_message", array(
            'contents' => $_GET['question'],
            'quotetype' => 1,
            'quote' => $_GET['ClassId'],
            'uid' => $_G['user']['uid'],
            'rid' => 29,
            'type' => 0
        ));
    }
}elseif($type == 16)
{
    if(isset($_GET['mid'])) {
        $mid = $_GET['mid'];
        if (isset($_COOKIE["likes_$mid"]) and $_COOKIE["likes_$mid"] > 0) {
            $new_likes = db_fetch(db_query("select * from class_mark where mid=$mid"))['likes'] - 1;
            setcookie("likes_$mid", 0);
        }else{
            $new_likes = db_fetch(db_query("select * from class_mark where mid=$mid"))['likes'] + 1;
            setcookie("likes_$mid", 1);
        }
        db_update("class_mark", array("likes" => $new_likes), "mid=$mid");
        print $new_likes;
    }
}

if(isset($warn)){
    include template("common:askerror");
}
?>