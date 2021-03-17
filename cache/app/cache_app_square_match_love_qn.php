<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 七日情侣报名</title>
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/love_reg.css?r=3764">
    <link rel="stylesheet" href="./template_app/css<?php echo isset($_CORE['style_css'])?($_CORE['style_css']):("var[_CORE['style_css']]"); ?>/square_match_out.css?r=3764">
</head>
<body>
<?php include template("app/square:common_header"); ?>
<?php include template("app/square:match_love_common"); ?>

<div class="Reg">
    <form method="post" action="index.php?mod=square&action=match&do=Love&step=qn<?php if(isset($_GET['reNew'])){ ?>&reNew=<?php echo isset($_GET['reNew'])?($_GET['reNew']):(""); ?><?php } ?>" id="RegTable">
        <?php $i = 0; ?> 
        <?php if($Reg['state'] == 3 || $Reg['state'] == 5 || isset($_GET['reNew'])){ ?>
        <h1 class="Reg_title">
            性格测试问卷
        </h1>
        <p class="addOut_field">
            1. 问卷直接关系到您的匹配结果，请慎重填写；<br>
            2. 在问卷中，每道题都会给出一句陈述，您需要根据该陈述与您的情况是否相符合答题。
        </p>
        <input type="hidden" name="ans_time" value="<?php echo time(); ?>">
        <?php while($question = db_fetch($query)){ ?>
            <?php $i++; ?>
            <div class="qn_back">
                <h2 class="qn_text"><?php echo isset($i)?($i):(""); ?>. <?php echo isset($question['text'])?($question['text']):(""); ?></h2>
                <span id="answer_<?php echo isset($question['qid'])?($question['qid']):(""); ?>" class="qn_ans"></span>
                 <?php $ans = json_decode($question['answer'], true); ?>
                <?php foreach($ans as $key => $value){ ?>
                    <a href="javascript:;"
                       onclick="choose_ans(<?php echo isset($question['qid'])?($question['qid']):(""); ?>, <?php echo isset($key)?($key):(""); ?>)">
                        <p class="qn_option">
                            <?php echo isset($choice_num[$key + 2])?($choice_num[$key + 2]):(""); ?>. <?php echo isset($value)?($value):(""); ?>
                        </p>
                    </a>
                <?php } ?>
                <input type="hidden" name="qid_<?php echo isset($question['qid'])?($question['qid']):(""); ?>" id="answer_input_<?php echo isset($question['qid'])?($question['qid']):(""); ?>">
            </div>
        <?php } ?>
        <div onclick="document.getElementById('submit').click()" class="post_submit">
            完成问卷
        </div>
        <input type="submit" id="submit" hidden>
    </form>
    <?php }else{ ?>
    您已经完成问卷内容！
    <a href="javascript:;"
       onclick="location.href='index.php?mod=square&action=match&do=Love&step=qn&reNew='
        + Math.random().toString()" style="color: <?php echo isset($_CORE['style_color1'])?($_CORE['style_color1']):(""); ?>">
        重新填写
    </a>
    <?php } ?>
</div>
<br>
<br>
<br><br><br>
</body>
<script src="static/js/square_match_love_QN.js?r=3764"></script>
<script src="static/js/square_match_Love_post_image.js?r=3764"></script>
</html>