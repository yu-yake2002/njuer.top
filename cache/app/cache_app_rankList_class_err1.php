<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<table id="window_contents" class="classlist-window_contents" height="100%" width="100%">
    <tr>
        <td class="classlist-window_header" id="window_contents_header" height="15%" colspan="2">
            <font size="5"><font color="#ff7f50" id="NowStep">1</font>/9 </font>评价: <?php echo isset($classinfo['name'])?($classinfo['name']):("var[classinfo['name']]"); ?>
        </td>
    </tr>
    <tr>
        <td class="classlist-window_p" id="window_contents_p" height="75%" align="center" colspan="2">
            <div id="ClassItemStepDiv1">
                <input id="RemarkCid" type="hidden" value="<?php echo isset($classinfo['classid'])?($classinfo['classid']):("var[classinfo['classid']]"); ?>">
                <font color="red">您已经评价过此课程！</font> 如果您需要重新评价，请点击“下一项”。
            </div>
            <div id="ClassItemStepDiv2">
                <div class="weui-cells__title">
                    您估计这门课的平均分是 <span id="marks2" class="classlist-marks"><?php echo class_givemark(history['marks']); ?></span> 分。<font color="red">（必答）</font>
                </div>
                <div class="weui-cell">
                    <input type="range" min="60" max="100" step="0.5" value="<?php echo class_givemark(history['marks']); ?>" width="100%" id="marks"
                           oninput="remarkchange('marks', this.value)">
                </div>
                <div class="field">
                    <input type="text" style="width: 100%; padding-left: 12px" id="marks3"
                           oninput="remarkchange('marks', this.value)" value="<?php echo class_givemark(history['marks']); ?>">
                </div>
                <div class="field">
                    <input type="text" style="width: 100%; padding-left: 12px" placeholder="请补充填写说明（选答）"
                           onchange="add_to_others('给分', this.value)">
                </div>
            </div>
            <div id="ClassItemStepDiv3">
                <div class="weui-cells__title">
                    在这门课程上，您每周 <strong>课外</strong> 的时间投入大概是 <span id="costtime2" class="classlist-marks"><?php echo class_discribe_costtime_int(history['costtime']); ?></span> 小时。
                    <font color="red">（必答）</font>
                </div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <input type="range" min="0" max="10" step="0.25" value="<?php echo class_discribe_costtime_int(history['costtime']); ?>" width="100%" id="costtime"
                               oninput="remarkchange('costtime', this.value)">
                    </div>
                    <div class="field">
                        <input type="text" style="width: 100%; padding-left: 12px" id="costtime3"
                               oninput="remarkchange('costtime', this.value)" value="<?php echo class_discribe_costtime_int(history['costtime']); ?>">
                    </div>
                    <div class="field">
                        <input type="text" style="width: 100%; padding-left: 12px" placeholder="请补充填写说明（选答）"
                               onchange="add_to_others('时间投入', this.value)">
                    </div>
                    <div class="weui-cells weui-cells_form">
                    </div>
                </div>
            </div>
            <div id="ClassItemStepDiv4">
                <div class="weui-cells__title">
                    您认为这门课程知识的难度如何？（5代表很难，0代表很简单）
                    <font color="red">（必答）</font>
                    <br>
                </div>
                <p id="knowledge2" class="classlist-marks" align="right"><?php echo $history['knowledge'] * -1 + 5; ?></p>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <input type="range" min="0" max="5" step="0.01" value="<?php echo $history['knowledge'] * -1 + 5; ?>" width="100%" id="knowledge"
                               oninput="remarkchange('knowledge', this.value)">
                    </div>
                    <div class="field">
                        <input type="text" style="width: 100%; padding-left: 12px" id="knowledge3"
                               oninput="remarkchange('knowledge', this.value)" value="<?php echo $history['knowledge'] * -1 + 5; ?>">
                    </div>
                    <div class="field">
                        <input type="text" style="width: 100%; padding-left: 12px" placeholder="请补充填写说明（选答）"
                               onchange="add_to_others('难度', this.value)">
                    </div>
                </div>
            </div>
            <div id="ClassItemStepDiv5">
                <div class="weui-cells__title">
                    您喜欢这门课程授课老师的授课风格吗？（5代表很喜欢，0反之）
                    <font color="red">（必答）</font>
                    <br>
                </div>
                <p id="teacher2" class="classlist-marks" align="right"><?php echo isset($history['teacher'])?($history['teacher']):("var[history['teacher']]"); ?></p>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <input type="range" min="0" max="5" step="0.01" value="<?php echo isset($history['teacher'])?($history['teacher']):("var[history['teacher']]"); ?>" width="100%" id="teacher"
                               oninput="remarkchange('teacher', this.value)">
                    </div>
                    <div class="field">
                        <input type="text" style="width: 100%; padding-left: 12px" id="teacher3"
                               oninput="remarkchange('teacher', this.value)" value="<?php echo isset($history['teacher'])?($history['teacher']):("var[history['teacher']]"); ?>">
                    </div>
                    <div class="field">
                        <input type="text" style="width: 100%; padding-left: 12px" placeholder="请补充填写说明（选答）"
                               onchange="add_to_others('授课老师', this.value)">
                    </div>
                </div>
            </div>
            <div id="ClassItemStepDiv6">
                <div class="weui-cells__title">
                    这门课程给您带来的收获大吗？（5代表很大，0反之）
                    <font color="red">（必答）</font>
                    <br>
                </div>
                <p id="gains2" class="classlist-marks" align="right"><?php echo isset($history['gains'])?($history['gains']):("var[history['gains']]"); ?></p>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <input id="blankingtime" value="<?php echo time(); ?> " type="hidden">
                        <input type="range" min="0" max="5" step="0.01" value="<?php echo isset($history['gains'])?($history['gains']):("var[history['gains']]"); ?>" width="100%" id="gains"
                               oninput="remarkchange('gains', this.value)">
                    </div>
                    <div class="field">
                        <input type="text" style="width: 100%; padding-left: 12px" id="gains3"
                               oninput="remarkchange('gains', this.value)" value="<?php echo isset($history['gains'])?($history['gains']):("var[history['gains']]"); ?>">
                    </div>
                    <div class="field">
                        <input type="text" style="width: 100%; padding-left: 12px" placeholder="请补充填写说明（选答）"
                               onchange="add_to_others('收获', this.value)">
                    </div>
                </div>
            </div>
            <div id="ClassItemStepDiv7">
                <div class="weui-cells__title">这门课的分数组成及考核方式是怎样的？<font color="red">（必答）</font></div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <textarea class="weui-textarea" placeholder="可写成 期末*30% 的格式" rows="3" id="exam" maxlength="80"
                                      oninput="document.getElementById('exam_words').innerHTML=this.value.length"> <?php echo isset($classinfo_ext['exam'])?$classinfo_ext['exam']:""; ?></textarea>
                            <div class="weui-textarea-counter"><span id="exam_words">0</span>/80</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ClassItemStepDiv8">
                <div class="weui-cells__title">你认为这门课有什么课程特色吗？（选答）</div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <textarea class="weui-textarea" placeholder="请输入文本" rows="3" id="special" maxlength="80"
                                      oninput="document.getElementById('special_words').innerHTML=this.value.length"><?php echo isset($history['special'])?($history['special']):("var[history['special']]"); ?></textarea>
                            <div class="weui-textarea-counter"><span id="special_words">0</span>/80</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ClassItemStepDiv9">
                <div class="weui-cells__title">请编辑你的评论：（选答）</div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <textarea class="weui-textarea" placeholder="请输入文本" rows="3" id="others" maxlength="500"
                                      oninput="document.getElementById('others_words').innerHTML=this.value.length"><?php echo isset($history['others'])?($history['others']):("var[history['others']]"); ?></textarea>
                            <div class="weui-textarea-counter"><span id="others_words">0</span>/500</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ClassItemStepDiv_Err" style="visibility: hidden; display: none;">
                <font color="red">请检查是否回答完全所有必答题！</font>
            </div>
        </td>
    </tr>
    <tr class="classlist-window_btn">
        <td height="10%" align="center" width="50%" class="classlist-window_btn1">
            <a href="javascript:;" onclick="ClassItem(-1);" id="classlist-window_btn1" class="classlist-window_btn1_font">取消</a>
        </td>
        <td align="center" width="50%" class="classlist-window_btn2">
            <a href="javascript:;" onclick="ClassItem(1);" id="classlist-window_btn2" class="classlist-window_btn2_font">确认</a>
        </td>
    </tr>
</table>