<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200908, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function square_dingli_text($text, $replied){
    $text = str_ireplace("\n", "</p><p class=\"dingli_text_line\">", $text);
    if($replied != 0){
        $lastPost = db_fetch(db_query("SELECT text, reply, hide FROM square_hole WHERE hid = $replied"));
        if($lastPost) {
            if($lastPost['hide']){
                $lastPost['text'] = "***该内容已被删除或屏蔽***";
            }
            $text = $text."<div class='dingli_reply'><p class=\"dingli_text_line\">".square_dingli_text($lastPost['text'], $lastPost['reply'])."</p></div>";
        }else{
            $lastPost['text'] = "***该内容已被删除或屏蔽***";
            $lastPost['reply'] = 0;
            $text = $text."<div class='dingli_reply'><p class=\"dingli_text_line\">".square_dingli_text($lastPost['text'], $lastPost['reply'])."</p></div>";
        }
    }
    return $text;
}

function square_dingli_addHot($hid, $add_hot){
    $hot = db_fetch(db_query("SELECT hot, reply FROM square_hole WHERE hid = $hid"));
    db_update("square_hole", array('hot' => $hot['hot'] + $add_hot), "hid=$hid");
    if($add_hot > 1){
        square_dingli_addHot($hot['reply'], $add_hot - 1);
    }
    if($add_hot < -1){
        square_dingli_addHot($hot['reply'], $add_hot + 1);
    }
    return true;
}

function square_dingli_addLike($hid, $add_like){
    $likes = db_fetch(db_query("SELECT likes FROM square_hole WHERE hid = $hid"))['likes'];
    db_update("square_hole", array('likes' => $likes + $add_like), "hid=$hid");
    square_dingli_addHot($hid, $add_like * 2);
    if(($likes + $add_like) % 30 == 29){
        square_dingli_addHot($hid, ceil(($likes + $add_like) / 3));
    }
    return $likes + $add_like;
}

function square_dingli_addRep($hid, $add_report){
    $report = db_fetch(db_query("SELECT reports, likes FROM square_hole WHERE hid = $hid"));
    db_update("square_hole", array('reports' => $report['reports'] + $add_report), "hid=$hid");
    if(($report['likes'] <= 10 && ($report['reports'] + $add_report) >= 10)
        || ($report['likes'] > 10 && ($report['reports'] + $add_report) >= $report['likes'])){
        db_update("square_hole", array('hide' => 1), "hid={$_GET['hid']}");
    }
    return true;
}

function square_dingli_comments_query($hid){
    return db_query("SELECT * FROM square_hole_comments WHERE hid = $hid ORDER BY time ASC");
}

function square_love_like($json1, $json2){
    $json1 = json_decode($json1, true);
    $json2 = json_decode($json2, true);
    $distance = 0;
    foreach ($json1 as $key => $value){
        if(!is_numeric($json1[$key])){
            $json1[$key] = 0;
        }
        if(!is_numeric($json2[$key])){
            $json2[$key] = 0;
        }
        $distance += pow($json1[$key] - $json2[$key], 2);
    }
    return 1 - sqrt($distance) / 17.88854381999831757127338934985;
}
?>