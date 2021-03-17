<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php $i = $_GET['start']; ?> 
<?php while($dingli = db_fetch($query)){ ?>
    <?php if(!$dingli['hide']){ ?>
    <?php $i++; ?>
    <div class="weihua_list_cell">
        <?php $dingli['text'] = square_dingli_text($dingli['text'], $dingli['reply']); ?>
        <h4 class="dingli_title">第 <?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?> 号投稿
            <span class="dingli_time">发表于 <?php echo date("Y-m-d H:i:s", $dingli['time']); ?></span>
            <p class="like">
                <a href="javascript:colDingLi(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);"><font color="#793c65">💖收藏</font></a>
                <a href="javascript:dingli_reply(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);"><font color="#793c65">📝回复</font></a>
                <a href="javascript:addComment(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);"><font color="#793c65">🍉评论</font></a>
                <?php if($_G['user']['identification']['verified'] > 5){ ?>
                <a href="javascript:delDingLi(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);"><font color="#793c65">❎删除</font></a>
                <?php }else{ ?>
                <a href="javascript:repDingLi(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);"><font color="#793c65">❎举报</font></a>
                <?php } ?>
                <br>
                🔥热度:<?php echo isset($dingli['hot'])?($dingli['hot']):(""); ?>
                <a href="javascript:zanDingLi(<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>);"><font color="#793c65">👍<span id="likes_<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>"><?php echo isset($dingli['likes'])?($dingli['likes']):(""); ?></span></font></a>
                举报:<span id="reports_<?php echo isset($dingli['hid'])?($dingli['hid']):(""); ?>"><?php echo isset($dingli['reports'])?($dingli['reports']):(""); ?></span>人
            </p>
        </h4>
        <div class="dingli_text">
            <p class="dingli_text_line"><?php echo isset($dingli['text'])?($dingli['text']):(""); ?></p>
            <?php $comments_query = square_dingli_comments_query($dingli['hid']); ?>
            <table style="border-top: 1px solid #793c65; margin: 6px; width: calc(100% - 12px)">
                <?php while($comments = db_fetch($comments_query)){ ?>
                    <?php if($comments){ ?>
                    <?php $have_comments = 1; ?>
                    <tr>
                        <td style="vertical-align: top" width="100%">
                            <?php echo square_dingli_text($comments['text'], 0); ?>
                            <span class="dingli_time">发表于 <?php echo date("Y-m-d H:i:s", $comments['time']); ?></span>
                        </td>
                        <td align="center">
                            <a href="javascript:zanComment(<?php echo isset($comments['cid'])?($comments['cid']):(""); ?>);"><font color="#793c65">
                                👍<br>
                                <span id="likes_comments_<?php echo isset($comments['cid'])?($comments['cid']):(""); ?>"><?php echo isset($comments['likes'])?($comments['likes']):(""); ?></span>
                            </font></a>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                <?php if(!isset($have_comments)){ ?>
                <tr>
                    <td>
                        暂无评论
                    </td>
                </tr>
                <?php } ?>
            </table>
            <br>
        </div>
    </div>
    <?php } ?>
<?php } ?>