<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php $i = $_GET['start']; ?> 
<?php while($dingli = db_fetch($query)){ ?>
    <?php if(!$dingli['hide']){ ?>
    <?php $have_comments = 0; ?>
    <?php $i++; ?>
    <?php if(!$hide_div){ ?>
    <div class="dingli_list_cell" id="hole_cell_<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>">
        <?php } ?>
        <?php $dingli['text'] = square_dingli_text($dingli['text'], $dingli['reply']); ?>
        <h4 class="dingli_title">第 <?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?> 号投稿<?php if($dingli['stick'] == 1){ ?>(置顶)<?php } ?>
            <span class="dingli_time">发表于 <?php echo formatTime($dingli['time']); ?></span>
            <div class="like">
                <a href="javascript:dingli_reply(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);" class="like_btn"><font color="#f7ecd8">引用</font></a>
                <a href="javascript:colDingLi(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);" class="like_btn"><font color="#f7ecd8">收藏</font></a>
                <a href="javascript:freshDingLi(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);" class="like_btn"><font color="#f7ecd8">刷新</font></a>
                <a href="javascript:repDingLi(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);" class="like_btn"><font color="#f7ecd8">举报(<span id="reports_<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>"><?php echo isset($dingli['reports'])?($dingli['reports']):(""); ?></span>)</font></a>
            </div>
        </h4>
        <div class="dingli_text">
            <?php if($_G['user']['identification']['verified'] > 5){ ?>
            <div class="comment_admin">
                🔒管理:
                <a href="index.php?mod=user&action=profile&uid=<?php echo isset($dingli['uid'])?($dingli['uid']):(""); ?>" class="like_btn"><font color="#f7ecd8">作者</font></a>
                <a href="javascript:delDingLi(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);" class="like_btn"><font color="#f7ecd8">删除</font></a>
                <a href="javascript:creditsUpdate(<?php echo isset($dingli['uid'])?($dingli['uid']):(""); ?>);" class="like_btn"><font color="#f7ecd8">积分</font></a><br>
                <a href="javascript:sendData_GET('index.php?mod=php_api&action=square&func=close&hid=<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>');$.alert('操作成功！');" class="like_btn"><font color="#f7ecd8"><?php if($dingli['closed'] == 1){ ?>解封<?php }else{ ?>封楼<?php } ?></font></a>
                <?php if($_G['user']['identification']['verified'] == 7){ ?>
                <a href="javascript:sendData_GET('index.php?mod=php_api&action=square&func=stick&hid=<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>');$.alert('操作成功！');" class="like_btn"><font color="#f7ecd8"><?php if($dingli['stick'] == 1){ ?>取消<?php } ?>置顶</font></a>
                <?php } ?>
            </div>
            <?php } ?>
            <p class="dingli_text_line"><?php echo isset($dingli['text'])?($dingli['text']):(""); ?></p>
            <?php if($dingli['image']){ ?>
            <div class="watch_image_box">
                <img src="<?php echo isset($dingli['image'])?($dingli['image']):(""); ?>" class="watch_image">
            </div>
            <?php } ?>
            <div class="like">
                <p align="right" style="padding-right: 6px">
                    <a href="javascript:zanDingLi(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);">
                        <?php if(db_fetch(db_query("SELECT likeid FROM square_hole_like WHERE uid= ".$_G['user']['uid']." AND hid=".$dingli['hid']))){ ?>
                    <img src="static/style_img/NewYear2021/zaned.png?r=3" height="20px" id="zan_img_hole_<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>" alt="取消赞"><font color="#c30000"><span id="likes_<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>"><?php echo isset($dingli['likes'])?($dingli['likes']):(""); ?></span></font>
                    <?php }else{ ?>
                    <img src="static/style_img/NewYear2021/flower.png?r=3" height="20px" id="zan_img_hole_<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>" alt="点赞"><font color="#c30000"><span id="likes_<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>"><?php echo isset($dingli['likes'])?($dingli['likes']):(""); ?></span></font>
                    <?php } ?>
                    </a>
                    <img src="static/img/fire.png" height="20px"><font color="#c30000">热度:<?php echo isset($dingli['hot'])?($dingli['hot']):(""); ?></font>
                </p>
            </div>
            <?php $comments_query = square_dingli_comments_query($dingli['hid']); ?>

            <table style="margin: 0; width: calc(100%)">
                <tr>
                    <td align="center" colspan="2">
                        <?php if($dingli['closed'] == 1){ ?>
                        <div class="comment_admin">
                            🔒管理员已封楼，此帖禁止评论
                        </div>
                        <?php }else{ ?>
                        <input type="text" class="comment_text" placeholder="说点什么吧" onclick="javascript:addComment(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);" oninput="javascript:addComment(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);">
                        <?php } ?>
                    </td>
                </tr>
                <?php $i = 0; ?>
            <?php while($comments = db_fetch($comments_query)){ ?>
                <?php if($comments){ ?>
                <?php $i++; ?>
                <tr>
                    <td style="vertical-align: top; font-family: 'Times New Roman', '楷体'" width="100%">
                        <font color="#303030"><?php echo isset($i)?($i):(""); ?>楼: </font> <?php echo ($comments['hide'] == 1)?"评论已被折叠":square_dingli_text($comments['text'], 0); ?>
                        <br>
                        <?php if($comments['hide'] != 1){ ?>
                        <p align="right">
                        <span class="dingli_time">
                            <?php if($dingli['closed'] == 0){ ?>
                            <a href="javascript:addComment(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>, '回复<?php echo isset($i)?($i):(""); ?>楼: ');"><font color="#808080">回复</font></a>
                            |<?php } ?>
                            <?php if($_G['user']['identification']['verified'] > 5){ ?>
                            <a href="javascript:delComment(<?php echo isset($comments['cid'])?($comments['cid']):(""); ?>);"><font color="#808080">折叠</font></a>
                            |
                            <a href="javascript:creditsUpdate(<?php echo isset($comments['uid'])?($comments['uid']):(""); ?>);"><font color="#808080">积分</font></a>
                            |
                            <?php } ?>
                            发表于 <?php echo formatTime($comments['time']); ?></span>
                        </p>
                        <?php } ?>
                    </td>
                    <td align="center" style="vertical-align: bottom; font-size: 12px">
                        <?php if($comments['hide'] != 1){ ?><a href="javascript:zanComment(<?php echo isset($comments['cid'])?($comments['cid']):(""); ?>);"><font color="#c30000">
                        <?php if(db_fetch(db_query("SELECT id FROM square_comments_likes WHERE uid= ".$_G['user']['uid']." AND cid=".$comments['cid']))){ ?>
                        <img src="static/style_img/NewYear2021/zaned.png?r=3" height="20px" id="zan_img_comments_<?php echo isset($comments['cid'])?($comments['cid']):(""); ?>" alt="取消赞">
                        <?php }else{ ?>
                            <img src="static/style_img/NewYear2021/flower.png?r=3" height="20px" id="zan_img_comments_<?php echo isset($comments['cid'])?($comments['cid']):(""); ?>" alt="点赞">
                        <?php } ?><br>
                            <span id="likes_comments_<?php echo isset($comments['cid'])?($comments['cid']):(""); ?>"><?php echo isset($comments['likes'])?($comments['likes']):(""); ?></span>
                        </font></a><?php } ?>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
                <?php if($i == 0){ ?>
                <tr>
                    <td>
                        暂无评论
                    </td>
                </tr>
                <?php } ?>
            </table>
            <br>
        </div>
        <?php if(!$hide_div){ ?>
    </div>
    <?php } ?>
    <?php } ?>
<?php } ?>