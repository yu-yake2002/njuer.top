<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200908, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function HMGet_need_state($type, $time3, $time5, $uid2)
{
    switch ($type)
    {
        case 0:
            if($time3 >= time())
            {
                return "待接单";
            }else{
                return "已过期";
            }
            break;
        case 1:
            if($time5 >= time())
            {
                return "用户 $uid2 已接单";
            }else{
                return "用户 $uid2 已超时<br>举报QQ群：195959801";
            }
            break;
        case 2:
            return "已送达";
            break;
    }
}
?>