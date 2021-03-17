<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['giftid']) && is_numeric($_GET['giftid'])) {
    $gift = db_fetch(db_query("SELECT * FROM home_gift WHERE giftid = {$_GET['giftid']}"));
}else{
    CORE_GOTOURL("index.php");
}
if(!$gift){
    CORE_GOTOURL("index.php");
}
if($gift['loginverify'] == 1 && !$_G['user']['loginned']){
    CORE_GOTOURL("index.php");
}

$user = db_fetch(db_query("SELECT * FROM common_user_sign WHERE uid = {$gift['uid']}"));

if($gift['type'] == 1){
    $lucky = db_query("SELECT * FROM home_gift_info ORDER BY `get_gift` DESC LIMIT 10");
}

include template("app/user:gift");

?>