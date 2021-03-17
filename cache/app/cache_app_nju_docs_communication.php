<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 传承南大</title>
    <link rel="stylesheet" href="./template_app/css/love_reg.css?r=1131">
    <link rel="stylesheet" href="./template_app/css/nju_docs.css?r=1131">
</head>
<body>
<?php include template("app/rankList_class:common_header"); ?>
<br>
<br>
<br>
<h1 class="Reg_title3">
    <?php echo isset($forum['name'])?($forum['name']):(""); ?>
</h1>
<?php while($class = db_fetch($query)){ ?>
    <div class="card3">
        <h2 class="card2_title_unline"><?php echo isset($class['name'])?($class['name']):(""); ?></h2>
        <?php if($class['close'] <= 0){ ?>
        <p class="card2_contents">问题数: <?php echo isset($class['threads'])?($class['threads']):(""); ?> | 最后提问: <?php echo formatTime($class['time']); ?></p>
        <?php }else{ ?>
        <?php $subclass = db_query("SELECT * FROM forum_class WHERE father = ".$class['cid']." ORDER BY `order` ASC, cid DESC"); ?>
        <?php while($child = db_fetch($subclass)){ ?>
            <div class="child_class" onclick="location.href='index.php?mod=nju_docs&action=communication&fid=<?php echo isset($child['cid'])?($child['cid']):(""); ?>&r=<?php echo rand(1,10000); ?> ';">
                <img src="<?php echo isset($child['icon'])?($child['icon']):(""); ?>" class="child_class_icon"><br>
                <?php echo isset($child['name'])?($child['name']):(""); ?>
            </div>
        <?php } ?>
        <?php } ?>
    </div>
<?php } ?>
<?php if($forum['close'] <= 0){ ?>
<?php if($open){ ?>
<div class="card2_btn" onclick="location.href='index.php?mod=nju_docs&action=addThread&fid=<?php echo isset($forum['cid'])?($forum['cid']):(""); ?>&tid=<?php echo isset($thread['tid'])?($thread['tid']):(""); ?>&r=<?php echo rand(1,10000); ?>';">
    <p align="center">回复主题</p>
</div>
<?php }else{ ?>
<div class="card2_btn" onclick="location.href='index.php?mod=nju_docs&action=addThread&fid=<?php echo isset($forum['cid'])?($forum['cid']):(""); ?>&r=<?php echo rand(1,10000); ?>';">
    <p align="center">发布主题</p>
</div>
<?php } ?>
<?php } ?>
<?php if($forum['close'] <= 0 && !$open){ ?>
<div class="card3">
    <h2 class="card2_title_unline">内容筛选</h2>
    <p class="card2_contents">
        性质:
        <a href="index.php?mod=nju_docs&action=communication&fid=<?php echo isset($forum['cid'])?($forum['cid']):(""); ?>&class=1&question=<?php echo isset($question)?($question):(""); ?>" class="classlist-link">学术</a>
        <a href="index.php?mod=nju_docs&action=communication&fid=<?php echo isset($forum['cid'])?($forum['cid']):(""); ?>&class=2&question=<?php echo isset($question)?($question):(""); ?>" class="classlist-link">选课</a>
        <a href="index.php?mod=nju_docs&action=communication&fid=<?php echo isset($forum['cid'])?($forum['cid']):(""); ?>&class=3&question=<?php echo isset($question)?($question):(""); ?>" class="classlist-link">其他</a>
    </p>
    <p class="card2_contents">
        形式:
        <a href="index.php?mod=nju_docs&action=communication&fid=<?php echo isset($forum['cid'])?($forum['cid']):(""); ?>&question=1&class=<?php echo isset($academy)?($academy):(""); ?>" class="classlist-link">问答帖</a>
        <a href="index.php?mod=nju_docs&action=communication&fid=<?php echo isset($forum['cid'])?($forum['cid']):(""); ?>&question=2&class=<?php echo isset($academy)?($academy):(""); ?>" class="classlist-link">分享帖</a>
    </p>
</div>
<?php } ?>
<?php $i = 0; ?>
<?php while($post = db_fetch($query_thread)){ ?>
    <?php $i++; ?>
    <div class="card3"<?php if(!$open){ ?> onclick="location.href='index.php?mod=nju_docs&action=communication&fid=<?php echo isset($post['fid'])?($post['fid']):(""); ?>&tid=<?php echo isset($post['tid'])?($post['tid']):(""); ?>&r= <?php echo rand(1,10000); ?>';"<?php } ?>>
        <h2 class="card2_title_unline"><?php if(!$open){ ?><?php echo isset($post['subject'])?($post['subject']):(""); ?><?php }else{ ?><?php if($i == 1){ ?><?php echo isset($thread['subject'])?($thread['subject']):(""); ?><?php }else{ ?><?php echo isset($i)?($i):(""); ?>楼<?php } ?><?php } ?></h2>
        <p class="card2_contents">
            <?php if($thread['credits'] > 0 && $i == 1){ ?>悬赏积分: <?php echo isset($thread['credits'])?($thread['credits']):(""); ?> | <?php } ?>
            <?php if($post['credits'] > 0 && $open){ ?>获得积分: <?php echo isset($post['credits'])?($post['credits']):(""); ?> | <?php } ?>
            <?php if($post['credits'] > 0 && !$open){ ?>悬赏积分: <?php echo isset($post['credits'])?($post['credits']):(""); ?> | <?php } ?>
            <?php if($open){ ?>发表<?php }else{ ?>最近更新<?php } ?>于<?php echo formatTime($post['time']); ?></p>
        <hr size="1">
    <?php if($post['hide'] == 1){ ?>
    <p class="card2_contents">**该帖已经被原作者或管理员删除**</p>
    <?php }else{ ?>
    <p class="card2_contents"><?php echo show_image($post['contents']); ?></p>
    <?php } ?>

    <?php if($open && $i != 1 && $thread['uid'] == $_G['user']['uid'] && $thread['credits'] > 0){ ?>
    <div class="card2_btn" onclick="GiveCredits('<?php echo isset($post['pid'])?($post['pid']):(""); ?>', '<?php echo isset($thread['credits'])?($thread['credits']):(""); ?>');">
        <p align="center">授予积分</p>
    </div>
    <?php } ?>
    <?php if($post['uid'] == $_G['user']['uid']){ ?>
    <?php if($open && $i != 1){ ?>
    <div class="card2_btn" onclick="DeletePost('<?php echo isset($post['pid'])?($post['pid']):(""); ?>');">
        <p align="center">删除</p>
    </div>
    <?php }elseif($open){ ?>
    <div class="card2_btn" onclick="DeleteThread('<?php echo isset($post['tid'])?($post['tid']):(""); ?>');">
        <p align="center">删除</p>
    </div>
    <?php } ?>
    <?php } ?>
    </div>
<?php } ?>
<?php if($i == 0 && $forum['close'] <= 0){ ?>
<div class="card3">
    这里还没有人发过帖哦！
</div>
<?php } ?>
<br>
<br>
<br>
<br>
</body>
<script src="static/js/communication.js"></script>
</html>