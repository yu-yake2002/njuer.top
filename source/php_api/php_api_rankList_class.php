<?php
/*
 * Copyright By 南小宝
 * Last Edited: 20200909, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['func']))
{
    $func = $_GET['func'];
}else{
    exit('false');
}

if(!$_G['user']['loginned']){
    CORE_GOTOURL("index.php");
}

switch ($func) {
    case 'SearchClass':
        if(isset($_GET['keyword']))
        {
            $typecondition = "";
            if(isset($_GET['SearchType'])) {
                $type = $_GET['SearchType'];
                $typeconditions = array();
                if($type[0] == "1"){
                    $typeconditions[] = "(`classtype` = 4)";
                }
                if($type[1] == "1"){
                    $typeconditions[] = "(`classtype` = 5)";
                }
                if($type[2] == "1"){
                    $typeconditions[] = "(`classtype` = 0)";
                }
                if($type[3] == "1"){
                    $typeconditions[] = "(`classtype` = 1)";
                }
                if($type[4] == "1"){
                    $typeconditions[] = "(`classtype` = 2)";
                }
                if($type[5] == "1"){
                    $typeconditions[] = "(`classtype` = 3)";
                }
                if($type[6] == "1"){
                    $typeconditions[] = "(`classtype` = 7)";
                }
                $typecondition = " AND (".join(" OR ", $typeconditions).")";
            }
            $keyword = str_ireplace(" ", "%", $_GET['keyword']);
            $where = " (`num` LIKE \"%$keyword%\" OR `name` LIKE \"%$keyword%\" OR `teacher` LIKE \"%$keyword%\") ".$typecondition;
            if(!isset($_GET['start'])) {
                $rank = 0;
            }else{
                $rank = $_GET['start'];
            }
            $query = db_query("select * from class_common WHERE $where ORDER BY total DESC, classid ASC LIMIT $rank, 15");
            while($classinfo = db_fetch($query)){
                $rank++;
                $classinfo_ext =
                    db_fetch(db_query("select exam, persons from class_ext where classid=".$classinfo['classid']));
                include template("app/rankList_class:classList_content");
            }
        }
        break;
    case 'OpenClass':
        if (isset($_GET['ClassId']) && $_G['user']['loginned'])
        {
            if($classinfo = db_fetch(db_query("select * from class_common where classid = ".$_GET['ClassId'])))
            {
                $classinfo_ext = db_fetch(db_query("select * from class_ext where classid=" . $classinfo['classid']));
                $remark = db_query(
                    "select * from class_mark where cid=".$classinfo['classid']." AND others IS NOT NULL AND others != '' order by likes desc"
                );

                include template("app/rankList_class:classinfo");
            }
        }
        break;
    case 'like':
        if(isset($_GET['mid'])) {
            $mid = $_GET['mid'];
            if (isset($_COOKIE["likes_$mid"]) and $_COOKIE["likes_$mid"] > 0) {
                $new_likes = db_fetch(db_query("select * from class_mark where mid=$mid"))['likes'] - 1;
                setcookie("likes_$mid", 0);
            }else{
                $new_likes = db_fetch(db_query("select * from class_mark where mid=$mid"))['likes'] + 1;
                setcookie("likes_$mid", 1);
            }
            db_update("class_mark", array("likes" => $new_likes), "mid=$mid");
            print $new_likes;
        }
        break;
    case 'update':
        if(isset($_POST["knowledge"])
            && isset($_POST["marks"])
            && isset($_POST["gains"])
            && isset($_POST["teacher"])
            && isset($_POST["costtime"])
            && isset($_POST["exam"])
            && isset($_POST["special"])
            && isset($_POST["others"])
            && $_G['user']['loginned']
            && isset($_POST["blanking"])
            && time() - $_POST["blanking"] >= 4)
        {
            $classid = $_POST["classid"];
            $knowledge = 5 - $_POST["knowledge"];
            $marks2 = $_POST["marks"];
            if($marks2 <= 80){
                $marks = ($marks2 / 10) - 6;
            }else {
                $marks = 0.15 * $marks2 - 10;
            }
            $gains = $_POST["gains"];
            $teacher = $_POST["teacher"];
            $costtime2 = $_POST["costtime"];
            if($costtime2 <= 2){
                $costtime = 5 - ($costtime2 / 2);
            }elseif($costtime2 <= 4){
                $costtime = 6 - $costtime2;
            }elseif($costtime2 <= 8){
                $costtime = 3 - $costtime2 / 4;
            }else{
                $costtime = 5 - ($costtime2 / 2);
            }
            $exam = $_POST["exam"];
            $special = $_POST["special"];
            $others = $_POST["others"];
            mark_class($classid, $_G['user']['uid'], array(
                'knowledge' => $knowledge,
                'marks' => $marks,
                'gains' => $gains,
                'teacher' => $teacher,
                'costtime' => $costtime,
                'exam' => $exam,
                'special' => $special,
                'others' => $others,
                'blanking' => time() - $_POST["blanking"]
            ));
        }
        break;
    case 'RemarkClass':
        if($classinfo = db_fetch(db_query("select * from class_common where classid = ".$_GET['ClassId']))) {
            $classinfo_ext = db_fetch(db_query("select * from class_ext where classid=" . $classinfo['classid']));
            if($history = db_fetch(db_query("select * from class_mark where cid=".$classinfo['classid']." and uid=".$_G['user']['uid']))){
                include template("app/rankList_class:err1");
            }else{
                include template("app/rankList_class:class_remark");
            }
        }
        break;
    case 'JoinClass':
        if(isset($_GET['ClassId']) && is_numeric($_GET['ClassId'])){
            $class_count = db_count(db_query(
                "SELECT logid FROM class_user WHERE uid = {$_G['user']['uid']} AND state < 3 AND cid != {$_GET['ClassId']}")) + 1;
            if($class_count > 15){
                if($_G['user']['credits']['credits'] >= 2) {
                    credits_update($_G['user']['uid'], -2, "加入第 $class_count 门课程消耗积分", false);
                    print "你本学期已经加入了 $class_count 门课程（含已退出课程），本次加入消耗 2 积分。";
                }else{
                    print "积分余额不足！";
                    exit();
                }
            }else{
                print "你已经成功加入此课程！";
            }
            db_update("class_user", array(
                'state' => 1,
                'time' => time(),
                'subscribe' => 0),
                array(
                    'uid' => $_G['user']['uid'],
                    'cid' => $_GET['ClassId']),
                true);
        }
        break;
    case 'ExitClass':
        if(isset($_GET['ClassId']) && is_numeric($_GET['ClassId'])){
            print "你已经成功退出此课程！如果有相关的订阅，也已经取消。";
            db_update("class_user", array(
                'state' => 0,
                'time' => time(),
                'subscribe' => 0),
                array(
                    'uid' => $_G['user']['uid'],
                    'cid' => $_GET['ClassId']),
                true);
        }
        break;
    case 'SubscribeClass':
        if(isset($_GET['ClassId']) && is_numeric($_GET['ClassId'])){
            if($_G['user']['credits']['credits'] >= 2) {
                credits_update($_G['user']['uid'], -2, "订阅课程消耗积分(课程{$_GET['ClassId']})", false);
                print "积分已扣除，您已经成功订阅此课程。";
            }else{
                print "积分余额不足！";
                exit();
            }
            db_update("class_user", array(
                'state' => 1,
                'subscribe' => 1),
                array(
                    'uid' => $_G['user']['uid'],
                    'cid' => $_GET['ClassId']),
                true);
        }
        break;
    case 'ApplyAdmin':
        if(isset($_GET['ClassId']) && is_numeric($_GET['ClassId'])
            && isset($_GET['reason'])){
            db_insert("class_apply_admin", array(
                'reason' => $_GET['reason'],
                'state' => 0,
                'time' => time(),
                'uid' => $_G['user']['uid'],
                'cid' => $_GET['ClassId']));
            print "您的申请我们已经收到。";
        }
        break;
    case 'GiveCredits':
        if(isset($_GET['credits']) && is_numeric($_GET['credits'])
            && isset($_GET['pid']) && is_numeric($_GET['pid'])){
            $tid = db_fetch(db_query("SELECT credits, tid, uid FROM forum_post WHERE pid={$_GET['pid']}"));
            if($tid){
                $init_credits = $tid['credits'];
                $post_author = $tid['uid'];
                $tid = $tid['tid'];
            }else{
                exit('内部错误');
            }

            $thread = db_fetch(db_query("SELECT uid, credits FROM forum_threads WHERE tid={$tid}"));
            if($_G['user']['uid'] != $thread['uid']){
                exit('内部错误');
            }
            if($thread['credits'] < $_GET['credits']){
                exit('积分不足以支付此次悬赏。');
            }

            db_update("forum_threads", array(
                'credits' => $thread['credits'] - $_GET['credits']),
                array('tid' => $tid),
                true);

            db_update("forum_post", array(
                'credits' => $tid['credits'] + $_GET['credits']),
                array('pid' => $_GET['pid']),
                true);

            credits_update($post_author, $_GET['credits'], "回答 {$_GET['pid']} 被 用户{$_G['user']['uid']} 采纳，获得悬赏积分。");

            print "操作成功！";
        }
        break;
    case 'DeletePost':
        if(isset($_GET['pid']) && is_numeric($_GET['pid'])) {
            $pid = $_GET['pid'];
            $post = db_fetch(db_query("SELECT uid FROM forum_post WHERE pid = $pid"));
            if($post && $post['uid'] == $_G['user']['uid']) {
                db_update("forum_post", array(
                    'hide' => 1),
                    array('pid' => $pid),
                    true);
                print "删除成功！";
            }else{
                print "您要删除的帖子不存在。";
            }
        }
        break;
    case 'DeleteThread':
        if(isset($_GET['tid']) && is_numeric($_GET['tid'])) {
            $tid = $_GET['tid'];

            $post = db_fetch(db_query("SELECT uid, pid FROM forum_post WHERE tid = $tid ORDER BY `time` ASC"));
            if($post && $post['uid'] == $_G['user']['uid']) {
                db_update("forum_post", array(
                    'hide' => 1),
                    array('pid' => $post['pid']),
                    true);
                db_update("forum_threads", array(
                    'contents' => "该内容已被作者删除"),
                    array('tid' => $tid),
                    true);
                print "删除成功！";
            }else{
                print "您要删除的帖子不存在。";
            }
        }
        break;
    case 'SetClass':
        if(isset($_GET['cid'])
            && isset($_GET['key'])
            && isset($_GET['value'])){
            $cid = $_GET['cid'];
            $key = $_GET['key'];
            $value = $_GET['value'];
            $classinfo = db_fetch(db_query("SELECT * FROM class_common WHERE classid = $cid"));
            if(!$classinfo || $classinfo['admin'] != $_G['user']['uid']){
                exit();
            }
            db_update("class_common", array(
                $key => $value),
                array('classid' => $cid),
                true);
            db_insert("admin_log", array(
                'uid' => $_G['user']['uid'],
                'contents' => "将课程 $cid 的 $key 修改为 $value",
                'time' => time()
            ));
            print "设置修改保存成功！";
        }
        break;
    case 'send_msg':
        if(isset($_GET['cid'])
            && isset($_POST["msg"])){
            $cid = $_GET['cid'];
            $classinfo = db_fetch(db_query("SELECT * FROM class_common WHERE classid = $cid"));
            if(!$classinfo || $classinfo['admin'] != $_G['user']['uid']){
                exit("发送失败。");
            }
            $users = db_query("SELECT uid FROM class_user WHERE cid=$cid AND subscribe=1 AND state <= 2 AND state >= 1");
            $i = 0;
            while($user=db_fetch($users)){
                if($user['uid'] == $_G['user']['uid']) {
                    send_message($user['uid'],
                        "来自课程【{$classinfo['name']}】的群发通知: <br>" .
                        str_ireplace("\n", "<br>", $_POST["msg"]));
                    $i++;
                }
            }
            db_insert("admin_log", array(
                'uid' => $_G['user']['uid'],
                'contents' => "课程 $cid 群发消息：{$_POST["msg"]}",
                'time' => time()
            ));
            print "通知发送完毕，$i 人已经收到通知。";
        }
        break;
    default:
        print 'false';
        break;
}

?>