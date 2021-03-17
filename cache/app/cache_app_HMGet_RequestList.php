<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php while($need = db_fetch($query)){ ?>
    <div class="HMGet_sub_content">
        <div class="title">
            <?php echo isset($need['start'])?($need['start']):(""); ?> ➡ <?php echo isset($need['end'])?($need['end']):(""); ?>
        </div>
        <div class="details">
            <table class="details" width="100%">
                <tr>
                    <td width="40%">
                        单号:
                    </td>
                    <td>
                        <?php echo isset($need['nid'])?($need['nid']):(""); ?>
                    </td>
                </tr>
                <?php if(($need['state'] == 1 && $_G['user']['uid'] == $need['uid2']) || $_G['user']['identification']['verified'] > 5){ ?>
                <tr>
                    <td>
                        发单人UID:
                    </td>
                    <td>
                        <?php echo isset($need['uid'])?($need['uid']):(""); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        联系方式:
                    </td>
                    <td>
                        <?php echo isset($need['mobile'])?($need['mobile']):(""); ?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td>
                        支付积分:
                    </td>
                    <td>
                        <?php echo isset($need['credits'])?($need['credits']):(""); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        取件类型:
                    </td>
                    <td>
                        <?php echo isset($needtype[$need['type']])?($needtype[$need['type']]):(""); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        状态:
                    </td>
                    <td>
                        <?php echo HMGet_need_state($need['state'], $need['time3'], $need['time5'], $need['uid2']); ?> 
                    </td>
                </tr>
                <?php if($need['state'] == 0){ ?>
                <tr>
                    <td>
                        截止接单时间:
                    </td>
                    <td>
                        <?php echo formatTime($need['time3']); ?>
                    </td>
                </tr>
                <?php }else{ ?>
                <tr>
                    <td>
                        接单时间:
                    </td>
                    <td>
                        <?php echo formatTime($need['time2']); ?>
                    </td>
                </tr>
                <?php } ?>
                <?php if($need['state'] == 2){ ?>
                <tr>
                    <td width="40%">
                        送达时间:
                    </td>
                    <td>
                        <?php echo formatTime($need['time4']); ?>
                    </td>
                </tr>
                <?php }else{ ?>
                <tr>
                    <td width="40%">
                        截止送达时间:
                    </td>
                    <td>
                        <?php if($need['state'] == 0){ ?>
                        接单后<?php echo isset($need['time5'])?($need['time5']):(""); ?>分钟内
                        <?php }else{ ?>
                        <?php echo formatTime($need['time5']); ?>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                <?php if($need['state'] == 0 || $need['uid2'] == $_G['user']['uid']){ ?>
                <tr>
                    <td>
                        备注:
                    </td>
                    <td>
                        <?php if($need['others']){ ?>
                        <?php echo isset($need['others'])?($need['others']):(""); ?>
                        <?php }else{ ?>
                        无
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                <?php if(($need['state'] == 0 && $need['uid'] == $_G['user']['uid']) || $_G['user']['identification']['verified'] > 5){ ?>
                <tr>
                    <td colspan="2">
                        <button class="HMGet_btn"
                                onclick="deleteRequest(<?php echo isset($need['nid'])?($need['nid']):(""); ?>);">
                            撤回需求
                        </button>
                    </td>
                </tr>
                <?php } ?>
                <?php if($need['state'] == 1 && ($need['uid'] == $_G['user']['uid'] || $_G['user']['identification']['verified'] > 5)){ ?>
                <tr>
                    <td colspan="2">
                        <button class="HMGet_btn"
                                onclick="finishRequest(<?php echo isset($need['nid'])?($need['nid']):(""); ?>);">
                            确认收到
                        </button>
                    </td>
                </tr>
                <?php } ?>
                <?php if($need['state'] == 1 && $need['uid2'] == $_G['user']['uid']){ ?>
                <tr>
                    <td colspan="2">
                        <button class="HMGet_btn"
                                onclick="location.href='index.php?mod=user&action=message&uid= <?php echo ($need['uid'] == $_G['user']['uid'])?$need['uid2']:$need['uid']; ?>';">
                            联系对方
                        </button>
                    </td>
                </tr>
                <?php } ?>
                <?php if($need['state'] == 0 && $need['uid'] != $_G['user']['uid']){ ?>
                <tr>
                    <td colspan="2">
                        <button class="HMGet_btn"
                                onclick="getRequest(<?php echo isset($need['nid'])?($need['nid']):(""); ?>);">
                            我要接单
                        </button>
                    </td>
                </tr>
                <?php } ?>
                <?php if($need['state'] == 1 && $need['uid2'] == $_G['user']['uid'] && $_G['user']['identification']['verified'] <= 5){ ?>
                <tr>
                    <td colspan="2"><br></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 5px; border: 1px dashed #793c65">
                        <strong>Tips</strong><br/>
                        如果您准时送达，即可获得对方的全部支付积分以及系统的奖励积分；<br/>
                        如果您超时送达，对方可以确认收到也可以联系管理员举报，管理员将以邮件的形式与您进行沟通。<br/>
                        送达以后记得提醒对方确认收到哦！南小宝所有用户都已经通过了学号认证，如果沟通遇阻，您可以联系QQ群195959801的管理员举报。
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?php } ?>