<?php /*自动生成的模板文件*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?><table>
    <tr>
        <td align="center" width="48" rowspan="2" style="vertical-align: top;">
            <a href="index.php?mod=user&action=profile&uid=<?php echo isset($row['uid'])?($row['uid']):(""); ?><?php if(isset($_GET['on_app'])){ ?>&on_app=true<?php } ?>">
                <img src="<?php echo isset($row['avatar'])?($row['avatar']):(""); ?>" width="48" height="48" style="border-radius: 50%; ">
            </a>
        </td>
        <td style="padding-left: 12px" width="100%">
            <p align="left" style="font-size: 12px"><?php echo isset($row['name'])?($row['name']):(""); ?></p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 12px">
            <div class="chat-bubble" style="padding: 6px">
                <?php if(isset($classinfo) && $classinfo){ ?>
                <div class="content3" style="text-align: left">
                    <p class="classlist-titlenav">
                        <span class="classlist-title"><?php echo isset($classinfo['name'])?($classinfo['name']):("var[classinfo['name']]"); ?></span>
                    <hr size="1" color="white">
                    </p>
                    <div class="classlist-introduction">
                        <p>课程号: <?php echo isset($classinfo['num'])?($classinfo['num']):("var[classinfo['num']]"); ?>，授课老师: <?php echo isset($classinfo['teacher'])?($classinfo['teacher']):("var[classinfo['teacher']]"); ?></p>
                        <p>考核方式: <?php echo (isset($classinfo_ext['exam']) && $classinfo_ext['exam'])?$classinfo_ext['exam']:"暂缺"; ?></p>
                        <p>课程综合评分: <?php echo round($classinfo['total'], 2); ?>
                        <p align="right" style="padding-top: 6px">
                            <a href="javascript:;" class="classlist-link" onclick="RemarkClass('<?php echo isset($classinfo['classid'])?($classinfo['classid']):("var[classinfo['classid']]"); ?>');">评价</a>
                        </p>
                    </div>
                </div>
                <?php } ?>
                <p align="left"><?php echo isset($row['contents'])?($row['contents']):(""); ?></p>
            </div>
        </td>
    </tr>
</table>