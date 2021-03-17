<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function show_image($contents){
    $contents = str_ireplace("｛", "{", $contents);
    $contents = str_ireplace("｝", "}", $contents);
    while(preg_match("/\{img([^\}]*)\}/i", $contents, $imgid)){
        $imgid = $imgid[1];
        $img_url = db_fetch(db_query("SELECT url FROM forum_img WHERE imgid={$imgid};"))['url'];
        $contents = str_ireplace("{img{$imgid}}", "<div class=\"watch_image_box\"><img src=\"{$img_url}\" class=\"watch_image\"></div>", $contents);
    }
    $contents = str_ireplace("\n", "</p><p>", $contents);
    return $contents;
}

function show_image_card($contents){
    $contents = str_ireplace("｛", "{", $contents);
    $contents = str_ireplace("｝", "}", $contents);
    while(preg_match("/\{img([^\}]*)\}/i", $contents, $imgid)){
        $imgid = $imgid[1];
        $img_url = db_fetch(db_query("SELECT url FROM forum_img WHERE imgid={$imgid};"))['url'];
        $contents = str_ireplace("{img{$imgid}}", "<div class=\"card2_image_container\"><img src=\"{$img_url}\" class=\"card2_image\"></div>", $contents);
    }
    return $contents;
}

function send_user_mail($uid, $message, $title="系统提示", $read=0)
{
    db_insert("activity_mail_letter", array(
        'received' => 1,
        'plimit' => 1,
        'title' => $title,
        'contents' => $message,
        'gender' => 0,
        'grade1' => 1,
        'grade2' => 1,
        'grade3' => 1,
        'grade4' => 1,
        'grade5' => 1,
        'open' => 0,
        'allowShared' => 1,
        'time' => time(),
        'uid' => 10000
    ));
    if(!preg_match("/\{img([^\}]*)\}/i", $message, $imgid)){
        $imgid = 0;
    }else{
        $imgid = $imgid[1];
    }
    db_insert("activity_mail_received", array(
        'uid' => $uid,
        'lid' => db_fetch(db_query("SELECT letterid FROM activity_mail_letter WHERE uid = 10000 ORDER BY letterid DESC"))['letterid'],
        'read' => $read,
        'time' => time(),
        'subject' => $title,
        'abstract' => substr(preg_replace("/\{img([^\}]*)\}/i", "", $message), 0, 300),
        'replied' => 0,
        'image' => $imgid,
        'known' => 0,
        'type' => 3
    ));
    return 0;
}

function mail_collect($letterid)
{
    global $_G;
    $letter = db_fetch(db_query("SELECT title, contents FROM activity_mail_letter WHERE letterid=$letterid"));
    if(!preg_match("/\{img([^\}]*)\}/i", $letter['contents'], $imgid)){
        $imgid = 0;
    }else{
        $imgid = $imgid[1];
    }
    db_insert("activity_mail_received", array(
        'uid' => $_G['user']['uid'],
        'lid' => $letterid,
        'read' => 1,
        'time' => time(),
        'subject' => "[收藏]".$letter['title'],
        'abstract' => substr(preg_replace("/\{img([^\}]*)\}/i", "", $letter['contents']), 0, 300),
        'replied' => 0,
        'image' => $imgid,
        'known' => 0,
        'type' => 4
    ));
}

function user_setting_get($selection_name)
{
    global $_G;
    $sql = "SELECT `set` FROM common_user_settings WHERE uid={$_G['user']['uid']} AND `name`=$selection_name";
    $query = db_query($sql);
    if($ans = db_fetch($query))
    {
        return $ans['set'];
    }
    return 0;
}

function user_setting_update($selection_name, $set)
{
    global $_G;
    db_update("common_user_settings", array(
        'set' => $set,
        'time' => time()
    ), array(
        'uid' => $_G['user']['uid'],
        'name' => $selection_name
    ), true);
    return 0;
}

?>