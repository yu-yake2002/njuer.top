<?php
//Copyright by nanxiaobao

if (!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

const CORE_USER_REGISTER_SIGN = 1;
const CORE_USER_REGISTER_ADMINADD = 2;
const CORE_USER_REGISTER_JIAOWU = 3;
const CORE_USER_REGISTER_BYMAIL = 4;

function CORE_USER_ADD($array, $type){
    if($type == 1){
        $mobile = $array['mobile'];

        db_insert('common_user_sign', $array);

        $uid = db_fetch(db_query(
            "select * from common_user_sign where mobile = '$mobile'"
        ))['uid'];

        db_insert('common_user_identification', array(
            'uid'=>$uid,
            'verified'=>-1
        ));
    }elseif ($type == 2)
    {
        $mobile = $array['mobile'];

        db_insert('common_user_sign', $array);

        $uid = db_fetch(db_query(
            "select * from common_user_sign where mobile = '$mobile'"
        ))['uid'];

        db_insert('common_user_identification', array(
            'uid'=>$uid,
            'verified'=>-1
        ));
    }elseif ($type == 3)
    {
        $sid = $array['sid'];
        $name = $array['name'];
        $salt = substr(md5(time() + rand(1, 100)), 12, 5)."FBWUQAKSJD"[rand(0, 9)];

        db_insert('common_user_sign', array(
            'name'=>$name,
            'pwd'=>md5("ABCDEF"),
            'mobile'=>$sid,
            'salt'=>$salt
        ));

        $uid = db_fetch(db_query(
            "select * from common_user_sign where mobile = '$sid' order by uid desc"
        ))['uid'];

        db_insert('common_user_identification', array(
            'uid'=>$uid,
            'verified'=>1,
            'realname'=>$name,
            'sid'=>$sid,
            'remark'=>$_LANG['common']['core']['autoverify']
        ));
    }elseif($type == 4)
    {
        $mobile = $array['mail'];
        $code = $array['code'];
        $salt = substr(md5(time() + rand(1, 100)), 12, 5)."FBWUQAKSJD"[rand(0, 9)];
        $pwd = md5(md5($code).$salt);

        if(strlen($mobile) <= 11){
            db_insert('common_user_sign', array(
                'name'=>"NJUer",
                'pwd'=>$pwd,
                'mobile'=>$mobile,
                'salt'=>$salt
            ));
        }else{
            db_insert('common_user_sign', array(
                'name'=>"NJUer",
                'pwd'=>$pwd,
                'mobile'=>"NJUer",
                'salt'=>$salt
            ));
        }

        $uid = db_fetch(db_query(
            "select uid from common_user_sign order by uid desc"
        ))['uid'];

        $ans = array(
            'pwd' => "$pwd",
            'uid' => "$uid"
        );

        db_insert('common_user_identification', array(
            'uid'=>$uid,
            'verified'=>1,
            'mail'=>"$mobile@smail.nju.edu.cn",
            'remark'=>$_LANG['common']['core']['autoverify']
        ));
    }

    db_insert('user_profile',
    array(
       'uid' => $uid,
       'avatar' => 0
    ));

    db_insert('user_credits',
        array(
            'uid' => $uid,
            'credits' => 0
        ));
    db_insert('user_credits_log',
        array(
            'uid' => $uid,
            'credits' => 0,
            'time' => time(),
            'reason' => "初始积分: 0"
        ));

    $query = db_query("select userid, rid from common_user_interaction_room where type=3");
    while($fetch = db_fetch($query)) {
        $common_userid = $fetch['userid'];
        $rid = $fetch['rid'];
        if($common_userid != ''){
            db_update('common_user_interaction_room',
                array(
                    'userid' => "$common_userid,$uid"
                ), "rid=$rid");
        }else{
            db_update('common_user_interaction_room',
                array(
                    'userid' => "$uid"
                ), "rid=$rid");
        }
    }

    if(!isset($ans)) $ans = $uid;

    return $ans;
}

function get_user($uid)
{
    if($uid == -1)
    {
        $result['common']['name'] = '匿名用户';
        $result['common']['uid'] = 10000;
        $result['profile']['avatar'] = 'data/avatar/avatar_niming.png';
        return $result;
    }
    $result['common'] = db_fetch(db_query("select * from common_user_sign where uid=$uid"));
    $result['profile'] = db_fetch(db_query("select * from user_profile where uid=$uid"));

    $result['profile']['avatar'] = $result['profile']['avatar']?$result['profile']['avatar']:"data/avatar/common.png";
    return $result;
}

function send_message($uid, $text, $use=-1){
    global $_G;
    if($use == -1){
        $use = $_G['user']['uid'];
    }
    db_insert("user_message", array(
        'uid' => $use,
        'to_uid' => $uid,
        'text' => $text,
        'time' => time()
    ));
    if($toread = db_fetch(db_query("SELECT * FROM user_message_list WHERE uid={$uid} AND from_uid={$use}"))){
        $toread = $toread['toread'] + 1;
        db_update("user_message_list",array(
            "toread" => $toread,
            "time" => time(),
            "text"=>$text),
            "uid={$uid} AND from_uid={$use}");
    }else{
        db_insert("user_message_list",array(
            "toread" => 1,
            "from_uid" => $use,
            "uid" => $uid,
            "text" => $text,
            "time" => time()
        ));
    }
}
?>