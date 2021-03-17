<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 积分记录</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/love_reg.css?r=6859">
</head>
<body>
<?php include template("app/working:common_header"); ?>
<div class="working">
    <h1 class="Reg_title">
        工作控制台
    </h1>
    <div id="working_notes" style="height: 86px; overflow-y: hidden; background: rgba(255,255,255,0.3); padding: 12px">
        为了方便大家相对灵活的利用空余时间一起来做好“<?php echo isset($org['name'])?($org['name']):(""); ?>”的工作，我们在南小宝app上线了工作台界面。在工作台界面，大家可以查看、修改自己的团队状态。<br>
        团队状态有“暂离”、“待分配任务”、“已分配任务”、“已完成任务”四种状态，大家每一天的默认状态为“暂离”。在工作台界面，你可以：<br>
        1. 未来7天内的任意一天，你可以把状态从“暂离”变更为“待分配任务”；<br>
        2. 除今明两天以外，你可以任意的把状态从“待分配任务”变更为“暂离”；<br>
        3. 我们会主动联系“待分配任务”状态的成员，分配任务后将你的状态从“待分配任务”变更为“已分配任务”；<br>
        4. 你可以联系我们将某一天的状态从“已分配任务”变更为“暂离”，或者将今明两天内的状态从“待分配任务”变更为“暂离”；<br>
        5. 每天的任务一般都有直接的对接人，经过对接人验收以后，当天状态从“已分配任务”变更为“已完成任务”，并录入一定的积分；<br>
        6. 当天的团队状态不影响线上会议的进行，即便你的状态为“暂离”，你仍可以自由地参加我们的例会（寒假期间的例会内容以线上团建和工作讨论为主）。
    </div>
    <div style="line-height: 24px; text-align: center; font-size: 20px; padding-top: 12px; padding-bottom: 12px;color: #0e84b5;
     background: rgba(255,255,255,0.4)" onclick="document.getElementById('working_notes').style.height='auto';this.style.display='none';">
        <strong>展开</strong>
    </div>
    <div class="working_group_list">
        <?php for($datestamp = $_CORE['today']['datestamp'] - 3; $datestamp <= ($_CORE['today']['datestamp'] + 7); $datestamp++){ ?>
        <?php $work_state = get_work_state($datestamp); ?>
        <?php echo date_to_str($datestamp); ?>:
        <?php if($work_state == 0){ ?>
        暂离
        <?php if($datestamp > $_CORE['today']['datestamp']){ ?>
        <a href="index.php?mod=working&action=workday&oid=<?php echo isset($OrgUser['oid'])?($OrgUser['oid']):(""); ?>&update=1&date=<?php echo isset($datestamp)?($datestamp):(""); ?>">
            <button class="link">切换为：待分配任务</button>
        </a>
        <?php } ?>
        <?php }elseif($work_state == 1){ ?>
        待分配任务
        <?php if($datestamp > $_CORE['today']['datestamp'] + 2){ ?>
        <a href="index.php?mod=working&action=workday&oid=<?php echo isset($OrgUser['oid'])?($OrgUser['oid']):(""); ?>&update=0&date=<?php echo isset($datestamp)?($datestamp):(""); ?>">
            <button class="link">切换为：暂离</button>
        </a>
        <?php } ?>
        <?php }elseif($work_state == 2){ ?>
        已分配任务
        <?php }elseif($work_state == 3){ ?>
        已完成任务
        <?php } ?>
        <br>
        <?php } ?>
        <?php if($OrgAdmin && $OrgAdmin['working']){ ?>
        待分配任务:<br>
        <?php while($to_arrange = db_fetch($query)){ ?>
            <?php echo isset($to_arrange['name'])?($to_arrange['name']):(""); ?> <?php echo date_to_str($to_arrange['date']); ?>
            <a href="index.php?mod=working&action=workday&oid=<?php echo isset($OrgUser['oid'])?($OrgUser['oid']):(""); ?>&uoid=<?php echo isset($to_arrange['uoid'])?($to_arrange['uoid']):(""); ?>&date=<?php echo isset($to_arrange['date'])?($to_arrange['date']):(""); ?>&change=1">
                <button class="link">已分配</button>
            </a><br>
        <?php } ?>
        <?php } ?>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
</body>
</html>