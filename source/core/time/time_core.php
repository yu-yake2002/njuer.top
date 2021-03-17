<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

date_default_timezone_set("Asia/Shanghai");

$_CORE['today']['date'] = date("Y-m-d", time());
$_CORE['today']['begin'] = strtotime($_CORE['today']['date']);
$_CORE['today']['datestamp'] = floor($_CORE['today']['begin'] / 86400);

function formatTime($time='')
{
    $rtime = date("Y-m-d H:i", $time);
    $htime = date("H:i", $time);
    $hour = date("H", $time);
    $day = date("d", $time);
    $today = date("d", time());
    $time = time() - $time;
    $str = $rtime;
    if($time < 0){
        return $str;
    }
    if($time < 60){
        return $time."秒前";
    }
    if($time < 3600){
        return floor($time / 60)."分钟前";
    }
    if($time < 60 * 60 * 24 * 3){
        if(($today - $day)==0){
            if($hour <= 5) {
                $str = '凌晨 ' . $htime;
            }elseif($hour <= 11) {
                $str = '上午 ' . $htime;
            }elseif($hour <= 13) {
                $str = '中午 ' . $htime;
            }elseif($hour <= 17) {
                $str = '下午 ' . $htime;
            }elseif($hour <= 21) {
                $str = '晚上 ' . $htime;
            }elseif($hour <= 23) {
                $str = '深夜 ' . $htime;
            }
        }elseif(($today - $day)==1){
            $str = '昨天 '.$htime;
        }elseif(($today - $day)==2){
            $str = '前天 '.$htime;
        }
    }
    return $str;
}

function time_to_date($time)
{
    return floor($time / 86400);
}

function date_to_time($date)
{
    return $date * 86400;
}

function date_to_str($date)
{
    return date("Y-m-d", date_to_time($date));
}
?>