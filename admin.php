<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200902, By 张运筹
 */


const DEBUG = 1; # 当前是否是DEBUG状态
const IS_INCLUDED = 1; # 定义该变量防止其他文件被直接打开


include_once 'source/core/core_header.php'; # 核心功能

if(isset($_GET['mod']) and $_GET['mod'] == 'ranklist'){
    $_GET['mod'] = 'square';
}

if(!$_G['user']['loginned']){
    CORE_GOTOURL("index.php");
}

if($_G['user']['identification']['verified'] <= 0){
    CORE_GOTOURL("index.php");
}

if(isset($_GET['mod'])
    && in_array($_GET['mod'], array(
        'myClass'
    )))
{
    include_once "source/admin/admin_{$_GET['mod']}.php"; # 插入内容
}

include_once 'source/core/core_footer.php'; # 收尾工作

?>