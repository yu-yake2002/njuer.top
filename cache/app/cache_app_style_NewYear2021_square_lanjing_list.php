<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<table class="message_cells" width="100%">
    <?php while($friend = db_fetch($query)){ ?>
        <?php $friend['user'] = get_user($friend['from_uid']);; ?> 
        <tr onclick="location.href='index.php?mod=user&action=message&uid=<?php echo isset($friend['from_uid'])?($friend['from_uid']):(""); ?>'">
            <td rowspan="2">
                <a href="index.php?mod=user&action=profile&uid=<?php echo isset($friend['from_uid'])?($friend['from_uid']):(""); ?>">
                    <img src="<?php echo isset($friend['user']['profile']['avatar'])?($friend['user']['profile']['avatar']):(""); ?>" class="avatar_middle">
                </a>
            </td>
            <td width="100%">
                <a href="index.php?mod=user&action=profile&uid=<?php echo isset($friend['from_uid'])?($friend['from_uid']):(""); ?>">
                    <font color="#c30000"><?php echo isset($friend['user']['common']['name'])?($friend['user']['common']['name']):(""); ?></font>
                </a>
                <span style="float: right; color: #5f646e; font-size: 14px">
                    <?php echo formatTime($friend['time']); ?>
                </span>
            </td>
        </tr>
        <tr onclick="location.href='index.php?mod=user&action=message&uid=<?php echo isset($friend['from_uid'])?($friend['from_uid']):(""); ?>'">
            <td style="color: #5f646e">
                 <?php echo (strlen($friend['text']) >= 33)?substr($friend['text'], 0, 33)."...":$friend['text']; ?>
                <?php if($friend['toread'] > 0){ ?>
                <span class="new_message">
                        <?php echo isset($friend['toread'])?($friend['toread']):(""); ?>
                    </span>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="background-color: #fcf6ea;height: 2px">

            </td>
        </tr>
    <?php } ?>
</table>