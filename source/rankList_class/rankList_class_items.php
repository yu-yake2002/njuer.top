<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if($_G['user']['loginned'] && $_G['user']['identification']['verified'] >= 1){
    if(isset($_COOKIE["firstcome"]))
    {
        setcookie("firstcome", 1, time() - 3600);
        $firstcome = 1;
    }

    $uid = $_G['user']['uid'];
    $myClass = db_query("select * from class_mark where uid=$uid");

    include template("app/rankList_class:items");
}else{
    CORE_GOTOURL("index.php?mod=user&action=login");
}
?>