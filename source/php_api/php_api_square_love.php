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

switch ($func) {
    case 'upload_photo':
        if($_G['user']['loginned']){
            $temp = explode(".", $_FILES["file"]["name"]);
            $ext = end($temp);
            if(in_array($ext, $_SETTINGS['upload_allowedExt']['image'])
                && in_array($_FILES["file"]["type"], $_SETTINGS['upload_FileType']['image'])
                && $_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                if ($_FILES["file"]["error"] <= 0)
                {
                    $filename = $_G['user']['uid']."_".md5(time()).md5(rand(1, 99999));
                    ini_set("memory_limit","30M");
                    list($src_w,$src_h,$type)=getimagesize($_FILES["file"]["tmp_name"]);
                    switch ($type) {
                        case 1:
                            $im = imagecreatefromgif($_FILES["file"]["tmp_name"]);
                            break;
                        case 2:
                            $im = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
                            break;
                        case 3:
                            $im = imagecreatefrompng($_FILES["file"]["tmp_name"]);
                            break;
                        default:
                            print ("识别失败，请重新上传");
                            exit();
                    }
                    if($src_w <= 600){
                        if($src_h <= 600){
                            $dst_w = $src_w;
                            $dst_h = $src_h;
                        }else{
                            $dst_w = 600 * $src_w / $src_h;
                            $dst_h = 600;
                        }
                    }else{
                        if($src_w > $src_h) {
                            $dst_w = 600;
                            $dst_h = 600 * $src_h / $src_w;
                        }else{
                            $dst_w = 600 * $src_w / $src_h;
                            $dst_h = 600;
                        }
                    }
                    $new_image = imagecreatetruecolor($dst_w,$dst_h);
                    imagecopyresized($new_image, $im,0, 0,0, 0, $dst_w, $dst_h, $src_w, $src_h);
                    $ext = "jpg";
                    imagejpeg($new_image, "data/upload_image/{$filename}.{$ext}");
                    imagedestroy($im);
                    imagedestroy($new_image);
                    $face = analyse_face("data/upload_image/{$filename}.{$ext}");
                    if($face) {
                        db_update("square_match_love_reg", array(
                            'sex' => ($face['attributes']['gender']['value'] == "Male")?1:0,
                            'card_beauty_m' => $face['attributes']['beauty']['male_score'],
                            'card_beauty_fm' => $face['attributes']['beauty']['female_score'],
                            'state' => 1,
                            'sid' => $_G['user']['mobile'],
                            'card_pic' => "data/upload_image/{$filename}.{$ext}",
                            'time' => time()
                        ), array('uid' => $_G['user']['uid']), true);
                        print("<img src='data/upload_image/{$filename}.{$ext}' class='watch_image'>");
                        print("<input id='uploaded_image' hidden value='data/upload_image/{$filename}.{$ext}'>");
                    }else{
                        db_update("square_match_love_reg", array(
                            'sex' => 1,
                            'card_beauty_m' => -1,
                            'card_beauty_fm' => -1,
                            'state' => 1,
                            'sid' => $_G['user']['mobile'],
                            'card_pic' => "data/upload_image/{$filename}.{$ext}",
                            'time' => time()
                        ), array('uid' => $_G['user']['uid']), true);
                        print("<img src='data/upload_image/{$filename}.{$ext}' class='watch_image'>");
                        print("<input id='uploaded_image' hidden value='data/upload_image/{$filename}.{$ext}'>");
                    }
                }
            }
        }
        break;
    case 'upload_LifePhoto':
        if($_G['user']['loginned']){
            $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE uid = {$_G['user']['uid']} ORDER BY `time` DESC"));
            $temp = explode(".", $_FILES["file"]["name"]);
            $ext = end($temp);
            if(in_array($ext, $_SETTINGS['upload_allowedExt']['image'])
                && in_array($_FILES["file"]["type"], $_SETTINGS['upload_FileType']['image'])
                && $_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                if ($_FILES["file"]["error"] <= 0)
                {
                    $filename = $_G['user']['uid']."_".md5(time()).md5(rand(1, 99999));
                    ini_set("memory_limit","30M");
                    list($src_w,$src_h,$type)=getimagesize($_FILES["file"]["tmp_name"]);
                    switch ($type) {
                        case 1:
                            $im = imagecreatefromgif($_FILES["file"]["tmp_name"]);
                            break;
                        case 2:
                            $im = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
                            break;
                        case 3:
                            $im = imagecreatefrompng($_FILES["file"]["tmp_name"]);
                            break;
                        default:
                            print ("识别失败，请重新上传");
                            exit();
                    }
                    if($src_w <= 600){
                        if($src_h <= 600){
                            $dst_w = $src_w;
                            $dst_h = $src_h;
                        }else{
                            $dst_w = 600 * $src_w / $src_h;
                            $dst_h = 600;
                        }
                    }else{
                        if($src_w > $src_h) {
                            $dst_w = 600;
                            $dst_h = 600 * $src_h / $src_w;
                        }else{
                            $dst_w = 600 * $src_w / $src_h;
                            $dst_h = 600;
                        }
                    }
                    $new_image = imagecreatetruecolor($dst_w,$dst_h);
                    imagecopyresized($new_image, $im,0, 0,0, 0, $dst_w, $dst_h, $src_w, $src_h);
                    $ext = "jpg";
                    imagejpeg($new_image, "data/upload_image/{$filename}.{$ext}");
                    imagedestroy($im);
                    imagedestroy($new_image);
                    $face = analyse_face("data/upload_image/{$filename}.{$ext}");
                    if($face) {
                        db_update("square_match_love_reg", array(
                            'state' => ($Reg['state'] >= 5)?($Reg['state'] - 2):2,
                            'photo' => "data/upload_image/{$filename}.{$ext}",
                            'match' => compare_face($Reg['card_pic'], "data/upload_image/{$filename}.{$ext}"),
                            'beauty_m' => $face['attributes']['beauty']['male_score'],
                            'beauty_fm' => $face['attributes']['beauty']['female_score']
                        ), "regid = {$Reg['regid']}");
                        print("<img src='data/upload_image/{$filename}.{$ext}' class='watch_image'>");
                        print("<input id='uploaded_image' hidden value='data/upload_image/{$filename}.{$ext}'>");
                    }else{
                        db_update("square_match_love_reg", array(
                            'state' => ($Reg['state'] >= 5)?($Reg['state'] - 2):2,
                            'photo' => "data/upload_image/{$filename}.{$ext}",
                            'match' => -1,
                            'beauty_m' => -1,
                            'beauty_fm' => -1
                        ), "regid = {$Reg['regid']}");
                        print("<img src='data/upload_image/{$filename}.{$ext}' class='watch_image'>");
                        print("<input id='uploaded_image' hidden value='data/upload_image/{$filename}.{$ext}'>");
                    }
                }
            }
        }
        break;
    case 'Love':
        if($_G['user']['loginned']
            && isset($_GET['regid'])
            && time() <= 1612951140) {
            db_update("square_love_heart",
                array(
                    'time' => time()
                ),
                array(
                    'uid' => $_G['user']['uid'],
                    'regid' => $_GET['regid']
                ), true);
            print "已心动 ".formatTime(time());
        }
        break;
    case 'ChangeWish':
        if($_G['user']['loginned']) {
            if(isset($_GET['wish1'])) {
                db_update("square_match_love_wish",
                    array(
                        'wish1' => $_GET['wish1']
                    ), "uid1={$_G['user']['uid']}");
                db_update("square_match_love_wish",
                    array(
                        'wish1' => $_GET['wish1']
                    ), "uid2={$_G['user']['uid']}");
            }
            if(isset($_GET['wish2'])) {
                db_update("square_match_love_wish",
                    array(
                        'wish2' => $_GET['wish2']
                    ), "uid1={$_G['user']['uid']}");
                db_update("square_match_love_wish",
                    array(
                        'wish2' => $_GET['wish2']
                    ), "uid2={$_G['user']['uid']}");
            }
        }
        break;
    case 'sendPaper':
        if($_G['user']['loginned'] && isset($_GET['text'])) {
            $Reg = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE uid = {$_G['user']['uid']}"));
            $Match = db_fetch(db_query("SELECT * FROM square_match_love_reg WHERE uid = {$Reg['uid2']}"));
            if(!$Match) {
                $Match['uid'] = 10004;
            }
            db_insert("square_papers", array(
                'uid' => $Match['uid'],
                'msg' => $_GET['text'],
                'time' => time()));
        }
        break;
    default:
        break;
}
?>