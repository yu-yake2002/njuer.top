<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200909, By 张运筹
 */

    if(!defined("IS_INCLUDED"))
    {
        die('Access denied!');
    }


    $_G['user']['loginned'] = false;
    if(isset($_COOKIE["key"]))
    {
        $login_key = unserialize(base64_decode($_COOKIE["key"]));
        $query = db_query(
            "select * from common_user_sign where uid = {$login_key['uid']}"
        );
        $_G['user'] = db_fetch($query);
        $query = db_query(
            "select * from common_user_login where uid = {$login_key['uid']} AND hash = '{$login_key['hash']}'"
        );
        $_G['login_key'] = db_fetch($query);

        if($_G['user'] && $_G['login_key'])
        {
            $_CORE['loginverify']['correctpassword'] = $_G['user']['pwd'];

            if ($_CORE['loginverify']['correctpassword'] != $login_key["pwd"]) {
                $_G['user']['loginned'] = false;
                if(isset($_GET['action']) and $_GET['action'] == "login") {
                    $code = array();
                    for ($i = 0; $i < 6; $i++) {
                        $code[] = rand(0, 9);
                    }
                    $code = join('', $code);
                    $salt = md5(md5($_G['user']['mobile']).md5("HA81A"));
                    SENDMAIL($_G['user']['mobile'] . "@smail.nju.edu.cn", "【南小宝】南大学生身份认证 邮箱验证码",
                        "您好！有人正在使用您的邮箱进行南小宝邮箱认证，如果不是您本人操作，请忽略此份邮件。10分钟内有效的6位验证码为<p align='center' style='color: #ec8b89; font-weight: bold; font-size: 32px'>$code</p>");
                    $_SESSION["mailcode"] = md5(md5($code).$salt);
                    setcookie("sent", 1, time() + 15);
                    setcookie("user_sid", $_G['user']['mobile'], time() + 600);

                    CORE_GOTOURL("index.php?mod=user&action=mail");
                }
            } else {
                $_G['user']['loginned'] = true;
            }
        }else{
            $_G['user']['loginned'] = false;
        }
    }
    if($_G['user']['loginned']){
        $query = db_query(
            "select * from common_user_identification where uid = '{$_G['user']['uid']}'"
        );
        $_G['user']['identification'] = db_fetch($query);
        $_G['notice'] = db_count(
            db_query("SELECT messageid FROM user_messagelist WHERE `read`=0 and `uid`={$_G['user']['uid']}")
        );
        $query = db_query(
            "select * from user_credits where uid = '{$_G['user']['uid']}'"
        );
        $_G['user']['credits'] = db_fetch($query);

        $query = db_query("select * from user_credits_ask where uid = '{$_G['user']['uid']}'");
        $_G['user']['credits_ask'] = db_fetch($query);
        while(!$_G['user']['credits_ask']){
            db_insert('user_credits_ask', array(
                'uid' => $_G['user']['uid'],
                'credits' => 0,
                'mobile' => ""
            ));
            $query = db_query("select * from user_credits_ask where uid = '{$_G['user']['uid']}'");
            $_G['user']['credits_ask'] = db_fetch($query);
        }

        $_G['user']['rest_confidence'] = $_G['user']['credits_ask']['confidence'];
        if($_G['user']['credits']['vip'] >= time())
        {
            $_G['user']['rest_confidence'] += $_G['user']['credits_ask']['vip_confidence'];
        }
        $_G['user']['rest_confidence'] = $_G['user']['rest_confidence'] - $_G['user']['credits_ask']['credits'];
        $_G['user']['profile'] = db_fetch(db_query("select * from user_profile where uid={$_G['user']['uid']}"));
        if($_G['user']['profile']['avatar']){
            $avatar_temp = explode("?r=", $_G['user']['profile']['avatar'])[0];
            $temp = explode(".", $avatar_temp);
            $ext = end($temp);
            if(false) {
                ini_set("memory_limit","30M");
                list($src_w, $src_h, $type) = getimagesize($avatar_temp);
                switch ($type) {
                    case 1:
                        $im = imagecreatefromgif($avatar_temp);
                        break;
                    case 2:
                        $im = imagecreatefromjpeg($avatar_temp);
                        break;
                    case 3:
                        $im = imagecreatefrompng($avatar_temp);
                        break;
                    default:
                        exit();
                }
                $dst_w = 240;
                $dst_h = 240;
                $new_image = imagecreatetruecolor($dst_w,$dst_h);
                imagecopyresized($new_image, $im,0, 0,0, 0, $dst_w, $dst_h, $src_w, $src_h);
                $ext = "gif";
                imagegif($new_image, "data/avatar/{$_G['user']['uid']}.{$ext}");
                imagedestroy($im);
                imagedestroy($new_image);
                db_update("user_profile", array(
                    'avatar' => "data/avatar/{$_G['user']['uid']}.{$ext}?r=".time()
                ), "uid={$_G['user']['uid']}");
            }
        }
        $_G['user']['profile']['avatar'] = $_G['user']['profile']['avatar']?$_G['user']['profile']['avatar']:"data/avatar/common.png";
        $_G['user']['profile']['grade'] = substr($_G['user']['mobile'], 0, 2);
        if(substr($_G['user']['profile']['grade'], 0, 1) == "M" || substr($_G['user']['profile']['grade'], 0, 1) == "D")
        {
            $_G['user']['profile']['grade'] = $_SETTINGS['year'] - 4;
        }
        $_G['user']['ext'] = db_fetch(db_query("select * from user_ext where uid={$_G['user']['uid']}"));
        if(!$_G['user']['ext']){
            $_G['user']['ext'] = array(
                'photos' => 3
            );
        }
        $_G['user']['new_message'] = db_fetch(db_query("select * from user_message_list where toread > 0 and uid={$_G['user']['uid']}"));
        $_G['user']['new_mail'] = db_count(db_query("SELECT lid FROM activity_mail_received where uid = {$_G['user']['uid']} AND `read` = 0"));
    }
    if($_G['user']['loginned']){
        $ban = db_fetch(db_query("SELECT * FROM common_ban WHERE uid = {$_G['user']['uid']}"));
        $Android_msg_token = substr(md5($_G['user']['uid'] . "J2L@ma0-2"), 6, 18);
    }else{
        $_CORE['style_css'] = "";
    }

?>