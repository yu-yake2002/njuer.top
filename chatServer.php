<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200902, By 张运筹
 */

//const DEBUG = 1; # 当前是否是DEBUG状态
const IS_INCLUDED = 1; # 定义该变量防止其他文件被直接打开
const IS_SERVER = 1; # 该文件用于作为服务器


include_once 'source/core/core_header.php'; # 核心功能

include_once 'source/source_chatServer.php'; # 核心功能

include_once 'source/core/core_footer.php'; # 收尾工作

?>