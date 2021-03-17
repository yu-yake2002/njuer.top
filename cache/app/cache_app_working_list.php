<?php /*自动生成的模板文件_*/
if(!defined("IS_INCLUDED")) die('Access denied!'); ?>
<?php include template("app/common:header"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>南小宝 - 我的工作组</title>
    <link rel="stylesheet" href="./template_app/css/love_reg.css?r=3509">
    <link rel="stylesheet" href="./template_app/css/square_match_out.css?r=3509">
</head>
<body>
<link rel="stylesheet" href="./template_app/css/working.css?r=3509">
<div class="working">
    <p>
        该功能正在内测中，尚未正式上线。<br>
    </p>
    <div class="working_group_list">
        <div class="working_group_cell">
            输入组织号、邀请码与姓名加入组织：
            <form action="index.php?mod=working" method="post">
                <div class="addOut_field">
                    <div class="addOut_field_label">组织号</div>
                    <input type="text" class="addOut_field_input"
                           name="key" placeholder="请输入组织号">
                </div>
                <div class="addOut_field">
                    <div class="addOut_field_label">邀请码</div>
                    <input type="text" class="addOut_field_input"
                           name="pwd" placeholder="请输入邀请码">
                </div>
                <div class="addOut_field">
                    <div class="addOut_field_label">姓名</div>
                    <input type="text" class="addOut_field_input"
                           name="name" placeholder="请输入真实姓名">
                </div>
                <div class="post_submit"
                     onclick="document.getElementById('sign<?php echo isset($Meet['meetid'])?($Meet['meetid']):(""); ?>').click();">
                    加入组织
                </div>
                <input hidden type="submit" id="sign<?php echo isset($Meet['meetid'])?($Meet['meetid']):(""); ?>">
            </form>
        </div>
    <?php while($user = db_fetch($query)){ ?>
        <?php $org = get_org($user['oid']); ?> 
        <a href="index.php?mod=working&action=index&oid=<?php echo isset($org['oid'])?($org['oid']):(""); ?>&r= <?php echo rand(1,10000); ?>" style="color: #0d0d0d">
            <div class="working_group_cell">
                <h3><?php echo isset($org['name'])?($org['name']):(""); ?></h3>
                简介: <?php echo isset($org['intro'])?($org['intro']):(""); ?>
            </div>
        </a>
    <?php } ?>
    </div>
</div>
</body>
</html>