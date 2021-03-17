<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200920, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

$isB = (substr($_G['user']['mobile'], 0, 1) == "1"
    || substr($_G['user']['mobile'], 0, 1) == "2");

if($Reg['state'] == 3 || $Reg['state'] == 5 || isset($_GET['reNew'])) {
    $questions =
        db_fetch(db_query("SELECT questions FROM common_questionnaire WHERE qnid = 1"))['questions'];
    $questions = explode(",", $questions);
    if(!isset($_POST['ans_time'])) {
        $questions = join("','", $questions);
        $questions = "('$questions')";
        $query = db_query("SELECT * FROM common_question WHERE qid in $questions ORDER BY RAND()");
        $choice_num = array("A", "B", "C", "D", "E");
    }else{
        $ans = array();
        foreach ($questions as $key => $value){
            $ans[$value] = $_POST["qid_$value"];
        }
        $ans = json_encode($ans);
        db_update("common_question_answer", array(
            'ans' => $ans,
            'time' => time(),
            'blank_time' => time() - $_POST['ans_time']
        ), array('uid' => $_G['user']['uid'], 'qnid' => 1), true);
        if($Reg['state'] == 3 || $Reg['state'] == 5){
            $Reg['state'] += 1;
            db_update("square_match_love_reg", array(
                'state' => $Reg['state']
            ), "uid = {$_G['user']['uid']}");
        }
        CORE_GOTOURL("index.php?mod=square&action=match&do=Love&step=qn");
    }
}

include template("app/square:match_love_qn");
?>