<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['uid'])){
    $user = get_user($_GET['uid']);
}elseif($_G['user']['uid']){
    $_GET['uid'] = $_G['user']['uid'];
    $user = get_user($_GET['uid']);
}

if(!$_G['user']['loginned'])
{
    $_G['user']['uid'] = 0;
    $private = 2;
}else{
    $Following = db_fetch(db_query("SELECT atid FROM home_attention WHERE uid = {$_G['user']['uid']} AND attention = {$_GET['uid']}"));
    $Followed = db_fetch(db_query("SELECT atid FROM home_attention WHERE attention = {$_G['user']['uid']} AND uid = {$_GET['uid']}"));
    $LastVist = db_fetch(db_query("SELECT `time` FROM home_visitor WHERE visitor = {$_G['user']['uid']} AND uid = {$_GET['uid']}"));
    if(!$LastVist || (time() - $LastVist['time'] >= 600)) {
        db_insert("home_visitor", array(
            'uid' => $_GET['uid'],
            'visitor' => $_G['user']['uid'],
            'time' => time()
        ));
        db_add("home_fans", array(
            'visitors' => 1
        ), array(
            'uid' => $_GET['uid']
        ));
    }
    $private = 2;
    if($Followed && $Following){
        $private = 1;
    }
    if($_G['user']['uid'] == $user['common']['uid']){
        $private = 0;
    }
    if($_G['user']['identification']['verified'] >= 20 || $_G['user']['identification']['allowPrivate'] == 1){
        $private = 0;
    }
}

$user['private'] = db_fetch(db_query("SELECT * FROM user_private WHERE uid = {$_GET['uid']}"));
if(!$user['private']){
    $user['private'] = array(
        'myFollow' => 1,
        'myFans' => 1,
        'myVisitors' => 1,
        'myOnline' => 2,
        'mySid' => 0,
        'allowFollow' => 2,
        'allowRecommend' => 2
    );
}

$user['ext'] = db_fetch(db_query("SELECT * FROM user_ext WHERE uid = {$_GET['uid']}"));
if(!$user['ext']){
    $user['ext'] = array(
        'photos' => 3
    );
}

if(!$user['common'] || $_GET['uid'] < 10000)
{
    CORE_SHOWINFO("不存在该用户！", "index.php");
}

if($user['common']['uid'] == $_G['user']['uid'] && isset($_GET['setgender']) && ($_GET['setgender'] == 1 || $_GET['setgender'] == 2))
{
    db_update("user_profile", array('gender' => $_GET['setgender']), "uid = {$_G['user']['uid']}");
    CORE_GOTOURL("index.php?mod=user&action=profile&uid={$user['common']['uid']}");
}

$user['online'] = db_fetch(db_query("SELECT * FROM user_online_data WHERE uid = {$_GET['uid']}"));
$user['online']['hours'] = floor($user['online']['online'] / 4);
$user['online']['last_online'] = formatTime($user['online']['square']);
$user['attention'] = db_fetch(db_query("SELECT * FROM home_fans WHERE uid = {$_GET['uid']}"));
if(!$user['attention']){
    db_insert("home_fans", array("uid" => $_GET['uid']));
    $user['attention'] = db_fetch(db_query("SELECT * FROM home_fans WHERE uid = {$_GET['uid']}"));
}
$user['credits'] = db_fetch(db_query("SELECT * FROM user_credits WHERE uid = {$_GET['uid']}"));

if(!isset($_GET['page']) || !$_GET['page']) {
    $page = 0;
}elseif(is_numeric($_GET['page']) && $_GET['page'] >= 0){
    $page = $_GET['page'];
}else{
    $page = 0;
}
$page++;
$start = ($page - 1) * 20;

$user['photo_wall'] = db_query("SELECT photo FROM user_photo_wall WHERE uid = {$user['common']['uid']} ORDER BY photoid DESC LIMIT {$user['ext']['photos']}");
$show_photos = db_count($user['photo_wall']);
if($show_photos == 0) {
    $img = array();
    for ($i = 0; $i < 58; $i++) {
        $img[$i] = $i + 1;
    }
    shuffle($img);
}
$photo_wall = array();
while($photo = db_fetch($user['photo_wall'])){
    $photo_wall[] = $photo['photo'];
}
$photo_wall = array_reverse($photo_wall);

include template("app/user:profile");

?>