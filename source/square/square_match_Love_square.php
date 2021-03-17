<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['pingbiid']) && is_numeric($_GET['pingbiid'])){
    db_update("square_match_unwish",
        array("time" => time()),
        array("uid" => $_G['user']['uid'], "regid" => $_GET['pingbiid']),
        true);
}

if($Reg['state'] >= 5 && $Reg['uid2'] == 0){
    $grade_o = array();
    $Reg_grade_o = explode(",", $Reg['grade_o']);
    if($Reg_grade_o[0] == "1"){
        $grade_o[] = "sid LIKE \"20%\"";
    }
    if($Reg_grade_o[1] == "1"){
        $grade_o[] = "sid LIKE \"19%\"";
    }
    if($Reg_grade_o[2] == "1"){
        $grade_o[] = "sid LIKE \"18%\"";
    }
    if($Reg_grade_o[3] == "1"){
        $grade_o[] = "(sid NOT LIKE \"20%\" AND sid NOT LIKE \"19%\" AND sid NOT LIKE \"18%\")";
    }
    $grade_o = join(" OR ", $grade_o);

    $sexo = array();
    $Reg_sexo = explode(",", $Reg['sexo']);
    if($Reg_sexo[0] == "1"){
        $sexo[] = "0,0,0,1,0,0";
        $sexo[] = "0,0,0,1,1,0";
        $sexo[] = "0,0,0,1,0,1";
        $sexo[] = "0,0,0,1,1,1";
    }
    if($Reg_sexo[1] == "1"){
        $sexo[] = "0,0,1,0,0,0";
        $sexo[] = "1,1,1,0,0,0";
        $sexo[] = "0,1,1,0,0,0";
        $sexo[] = "1,0,1,0,0,0";
    }
    if($Reg_sexo[2] == "1"){
        $sexo[] = "0,1,1,0,0,0";
        $sexo[] = "0,1,0,0,0,0";
        $sexo[] = "1,1,0,0,0,0";
        $sexo[] = "1,1,1,0,0,0";
    }
    if($Reg_sexo[3] == "1"){
        $sexo[] = "1,0,0,0,0,0";
        $sexo[] = "1,1,0,0,0,0";
        $sexo[] = "1,0,1,0,0,0";
        $sexo[] = "1,1,1,0,0,0";
    }
    if($Reg_sexo[4] == "1"){
        $sexo[] = "0,0,0,0,0,1";
        $sexo[] = "0,0,0,1,1,1";
        $sexo[] = "0,0,0,0,1,1";
        $sexo[] = "0,0,0,1,0,1";
    }
    if($Reg_sexo[5] == "1"){
        $sexo[] = "0,0,0,0,1,1";
        $sexo[] = "0,0,0,0,1,0";
        $sexo[] = "0,0,0,1,1,0";
        $sexo[] = "0,0,0,1,1,1";
    }
    $sexo = "('".join("','", $sexo)."')";
    if($Reg['beauty_o'] == 0){
        $beauty = "1";
        $beauty_o = "beauty_o <= 2";
    }
    if($Reg['beauty_o'] == 1){
        $beauty = "1";
        $beauty_o = "beauty_o <= 2";
    }
    if($Reg['beauty_o'] == 2){
        $beauty = "1";
        $beauty_o = "beauty_o <= 2";
    }

    $query = db_query("SELECT * FROM square_match_love_reg WHERE regid NOT IN (SELECT regid FROM square_match_unwish WHERE uid = {$_G['user']['uid']}) AND uid NOT IN (SELECT uid FROM square_match_unwish WHERE regid = {$Reg['regid']}) and state >= 5 AND state <= 6 AND uid2 = 0 AND `time` >= {$BeginReg} AND uid != {$_G['user']['uid']} AND sexo IN $sexo AND $beauty AND $beauty_o AND ($grade_o) AND body_height >= {$Reg['min_bh']} AND body_height <= {$Reg['max_bh']} AND max_bh >= {$Reg['body_height']} AND min_bh <= {$Reg['body_height']} AND bmi >= {$Reg['min_bw']} AND bmi <= {$Reg['max_bw']} AND max_bw >= {$Reg['bmi']} AND min_bw <= {$Reg['bmi']} ORDER BY regid DESC");
}

$pingbi = db_query("SELECT regid FROM square_match_unwish WHERE uid = {$_G['user']['uid']}");

if(time() - $Reg['time'] >= 86400 && db_count($query) + db_count($pingbi) < 10){
    if($Reg['editable'] == 0) {
        db_update("square_match_love_reg", array("editable" => 1), "regid={$Reg['regid']}");
    }
}else{
    if($Reg['editable'] == 1) {
        db_update("square_match_love_reg", array("editable" => 0), "regid={$Reg['regid']}");
    }
}

$Lovers = db_count(db_query("SELECT * FROM square_love_heart WHERE regid = {$Reg['regid']}"));

include template("app/square:match_love_square");
?>