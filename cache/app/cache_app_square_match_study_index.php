<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 自律小宝</title>
    <style>
        .btn_item_card{
            box-shadow: black 0 0 5px 0;
            margin: 24px 12px;
            padding: 12px;
            display: inline-block;
            background: #ebe2cb url('/static/img/card.png?R=4');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: calc(102%);
            height: 128px;
            width: calc(50% - 48px);
            white-space: normal;
            border-radius: 12px;
        }
        .btn_item_todo{
            box-shadow: black 0 0 5px 0;
            margin: 24px 12px;
            padding: 12px;
            display: inline-block;
            background: #ebe2cb url('/static/img/todo.png');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: calc(80%);
            height: 128px;
            width: calc(50% - 48px);
            white-space: normal;
            border-radius: 12px;
        }
        .btn_title_card{
            line-height: 128px;
            word-spacing: 16px;
            text-align: center;
            color: white;
            text-shadow: #0d0d0d 2px 2px 4px;
        }
    </style>
</head>
<body>
<?php include template("app/square:common_header"); ?>
<?php include template("app/square:match_study_common"); ?>
<div class="big_btn_container">
    <img src="static/img/study_request.png" class="big_btn">
</div>

<div class="btn_list_todo">
    <div class="btn_item_card">
        <h1 class="btn_title_card">打 卡</h1>
    </div>
    <div class="btn_item_todo">
        <h1 class="btn_title_card">待 办</h1>
    </div>
</div>

<div class="card3">
    <h2 class="card2_title">自习信息</h2>
    <p class="card2_contents">明天 22:00-24:00 1栋自习室 | 监督人UID：10002</p>
    <p class="card2_contents">明天 22:00-24:00 1栋自习室 | 监督人UID：10002</p>
    <p class="card2_contents">明天 22:00-24:00 1栋自习室 | 监督人UID：10002</p>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>