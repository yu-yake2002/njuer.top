<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 课程管理</title>
</head>
<body>
<?php include template("app/rankList_class:common_header"); ?>
<br>
<br>
<br>
<div class="weui-cell">
    <div class="weui-cell__bd" style="color: #793c65">
        <strong><?php echo isset($classinfo['name'])?($classinfo['name']):("var[classinfo['name']]"); ?></strong>
    </div>
</div>
<div class="form-table">
    <table align="center">
        <tr>
            <td width="125px">课程讨论区</td>
            <td><select class="nxb_input" style="width: 200px" name="forum"
                        onchange="if(this.value == '-1') { $.alert('24小时内客服将与您取得联系，请保持南小宝消息畅通。'); }
                        set_class('forum', this.value, '<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>');">
                <option value="0" <?php if($classinfo['forum'] == 0){ ?>selected<?php } ?>>不设讨论区</option>
                <option value="-1" <?php if($classinfo['forum'] == -1){ ?>selected<?php } ?>>申请新设讨论区</option>
                <?php while($folder = db_fetch($forums)){ ?>
                <option value="<?php echo isset($forum['cid'])?($forum['cid']):(""); ?>" <?php if($classinfo['forum'] == $forum['cid']){ ?>selected<?php } ?>><?php echo isset($forum['name'])?($forum['name']):(""); ?></option>
                <?php } ?>
            </select></td>
        </tr>
        <tr>
            <td width="125px">课程学习经验</td>
            <td><textarea class="nxb_input" style="width: 200px" rows="5"
                          onchange="set_class('experience', this.value, '<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>');"><?php echo isset($classinfo['experience'])?($classinfo['experience']):(""); ?></textarea></td>
        </tr>
        <tr>
            <td width="125px">编辑通知</td>
            <td><textarea class="nxb_input" style="width: 200px" id="msg" rows="5" placeholder="请在这里编辑通知"></textarea></td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="card2_btn" onclick="send_msg('<?php echo isset($classinfo['classid'])?($classinfo['classid']):(""); ?>');">
                    <p align="center">群发通知</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<br>
<br>
<br>
</body>
<script src="static/js/send_msg.js?r=7625"></script>
<script src="static/js/myClass_admin.js?r=7625"></script>
</html>