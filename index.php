<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200902, By 张运筹
 */


const DEBUG = 1; # 当前是否是DEBUG状态
const IS_INCLUDED = 1; # 定义该变量防止其他文件被直接打开


include_once 'source/core/core_header.php'; # 核心功能

//if($_G['user']['loginned'] && $_G['user']['uid'] % 3 == date("d", time()) % 3 && $_G['user']['uid'] <= 16000){
//    $md5s = substr(md5("assd".$_G['user']['uid']), 8, 16);
//    die("由于南小宝服务器承受力有限，我们不得不在高峰期随机拒绝了一部分用户的访问，开学后您可以持此界面截图兑换南小宝周边小礼品。<br>UID: {$_G['user']['uid']}<br>token：{$md5s}'");
//}

if(isset($_GET['mod']) and $_GET['mod'] == 'ranklist'){
    $_GET['mod'] = 'square';
}

if(isset($_GET['mod'])
    && in_array($_GET['mod'], array(
        'user', 'php_api', 'HMGet', 'rankList_class',
        'rankList_food', 'square', 'map', 'working',
        'mall', 'nju_docs', 'plugin', 'myClass', 'article'
    )))
{
    include_once "source/{$_GET['mod']}/{$_GET['mod']}_core.php"; # 插入内容
}else {
    if(isset($_GET['mod'])
        && in_array($_GET['mod'], array(
            'game'
        ))){
        if(!$_G['user']['loginned']){
            CORE_GOTOURL("index.php?mod=user&action=login");
        }
        if(isset($_GET['action']) && $_GET['action'] == "hechengxigua"){
            include_once 'hechengxigua/index.php';
        }else {
            include_once 'source/source_index.php';
        }
    }else {
        include_once 'source/source_index.php';
    }
}

include_once 'source/core/core_footer.php'; # 收尾工作

?>