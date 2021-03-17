<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200905, By 张运筹
 */

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

if(isset($_GET['func']))
{
    $func = $_GET['func'];
}else{
    exit('false');
}



switch ($func) {
    case 'upload_image':
        if($_G['user']['loginned']){
            $temp = explode(".", $_FILES["file"]["name"]);
            $ext = end($temp);
            if(in_array($ext, $_SETTINGS['upload_allowedExt']['image'])
                && in_array($_FILES["file"]["type"], $_SETTINGS['upload_FileType']['image'])
                && $_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                if ($_FILES["file"]["error"] <= 0)
                {
                    $filename = md5($_G['user']['uid'])."_".md5(time()).md5(rand(1, 99999).md5("H&ae^7ADSa_$%(912A^"));
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        "data/upload_image/{$filename}.{$ext}");
                    print("<img src='data/upload_image/{$filename}.{$ext}' class='watch_image'>");
                    print("<input id='uploaded_image' hidden value='data/upload_image/{$filename}.{$ext}'>");
                }else{
                    print("上传失败，错误类型: {$_FILES["file"]["error"]}");
                }
            }elseif($_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                print "图片类型({$ext})不符合要求";
            }else{
                $limit = $_SETTINGS['upload_FileSize']['image'] / 1048576;
                print "图片大小不符合要求(限制{$limit}MB以内)";
            }
        }
        break;
    case 'replace_image':
        if($_G['user']['loginned']){
            $temp = explode(".", $_FILES["file"]["name"]);
            $ext = end($temp);
            if(in_array($ext, $_SETTINGS['upload_allowedExt']['image'])
                && in_array($_FILES["file"]["type"], $_SETTINGS['upload_FileType']['image'])
                && $_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                if ($_FILES["file"]["error"] <= 0)
                {
                    $filename = $_GET['replace_url'];
                    list($dst_w,$dst_h)=getimagesize($filename);
                    $user_dir = "hechengxigua/res_".$_G['user']['uid']."/raw-assets/";
                    if(substr($filename, 0, strlen($user_dir)) != $user_dir){
                        print($filename);
                        exit();
                    }
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        "{$filename}");
                    list($src_w,$src_h,$type)=getimagesize($filename);
                    ini_set("memory_limit","30M");
                    switch ($type) {
                        case 1:
                            $im = imagecreatefromgif($filename);
                            break;
                        case 2:
                            $im = imagecreatefromjpeg($filename);
                            break;
                        case 3:
                            $im = imagecreatefrompng($filename);
                            break;
                        default:
                            print($filename);
                            exit();
                    }

                    $new_image = imagecreatetruecolor($dst_w,$dst_h);
                    imagecopyresized($new_image, $im,0, 0,0, 0, $dst_w, $dst_h, $src_w, $src_h);
                    imagepng($new_image, $filename);
                    imagedestroy($im);
                    imagedestroy($new_image);
                    $circle_image = img_to_circle($filename);
                    imagepng($circle_image, $filename);
                    imagedestroy($circle_image);

                    print("{$filename}?r=".rand(1, 9999));
                }else{
                    print("{$filename}");
                }
            }elseif($_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                print("{$filename}");
            }else{
                $limit = $_SETTINGS['upload_FileSize']['image'] / 1048576;
                print("{$filename}");
            }
        }
        break;
    case 'upload_images':
        if($_G['user']['loginned']){
            $temp = explode(".", $_FILES["file"]["name"]);
            $ext = end($temp);
            if(in_array($ext, $_SETTINGS['upload_allowedExt']['image'])
                && in_array($_FILES["file"]["type"], $_SETTINGS['upload_FileType']['image'])
                && $_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                if ($_FILES["file"]["error"] <= 0)
                {
                    $filename = md5($_G['user']['uid'])."_".md5(time()).md5(rand(1, 99999).md5("H&ae^7ADSa_$%(912A^"));
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        "data/upload_image/{$filename}.{$ext}");
                    db_insert("forum_img", array(
                        'uid' => $_G['user']['uid'],
                        'url' => "data/upload_image/{$filename}.{$ext}"));
                    $imgid = db_fetch(db_query("SELECT imgid FROM forum_img ORDER BY imgid DESC"))['imgid'];
                    print("<table width='100%'><tr><td width='40%' align='center'>");
                    print("<img src='data/upload_image/{$filename}.{$ext}' class='watch_image'></td>");
                    print("<td>插入代码: {img{$imgid}}</td></tr></table>");
                }else{
                    print("上传失败，错误类型: {$_FILES["file"]["error"]}");
                }
            }elseif($_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                print "图片类型({$ext})不符合要求";
            }else{
                $limit = $_SETTINGS['upload_FileSize']['image'] / 1048576;
                print "图片大小不符合要求(限制{$limit}MB以内)";
            }
        }
        break;
    case 'upload_pdf':
        if($_G['user']['loginned']){
            $temp = explode(".", $_FILES["file"]["name"]);
            $ext = end($temp);
            print ("<div class=\"card2\">");
            if(in_array($ext, $_SETTINGS['upload_allowedExt']['pdf'])
                && in_array($_FILES["file"]["type"], $_SETTINGS['upload_FileType']['pdf'])
                && $_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['pdf']){
                if ($_FILES["file"]["error"] <= 0)
                {
                    $filename = md5($_G['user']['uid'])."_".md5(time()).md5(rand(1, 99999).md5("H&ae^7ADSa_$%(912A^"));
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        "data/upload_pdf/{$filename}.{$ext}");
                    print("<input name='name' value='{$_FILES["file"]["name"]}' class='nxb_input'>");
                    print("<input name='url' value='https://www.njuer.top/data/upload_pdf/{$filename}.{$ext}' class='nxb_input'>");
                }else{
                    print("上传失败，错误类型: {$_FILES["file"]["error"]}");
                }
            }elseif($_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                print "文件类型({$ext})不符合要求";
            }else{
                $limit = $_SETTINGS['upload_FileSize']['image'] / 1048576;
                print("<input name='name' value='{$_FILES["file"]["name"]}' class='nxb_input'>");
                print "文件大小不符合要求(限制{$limit}MB以内)，请上传到box.nju.edu.cn后将分享链接复制到下方";
                print("<input name='url' placeholder='请输入分享链接' class='nxb_input'>");
            }
            print ("<input hidden id='submit' type='submit'>");
            print ("<div class=\"card2_btn\" onclick=\"document.getElementById('submit').click();\">提交</div>");
            print ("</div>");
        }
        break;
    case 'upload_avatar':
        if($_G['user']['loginned']){
            $temp = explode(".", $_FILES["file"]["name"]);
            $ext = end($temp);
            if(in_array($ext, $_SETTINGS['upload_allowedExt']['image'])
                && in_array($_FILES["file"]["type"], $_SETTINGS['upload_FileType']['image'])
                && $_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                if ($_FILES["file"]["error"] <= 0)
                {
                    ini_set("memory_limit","30M");
                    list($src_w,$src_h,$type)=getimagesize($_FILES["file"]["tmp_name"]);
                    switch ($type) {
                        case 1:
                            $im = imagecreatefromgif($_FILES["file"]["tmp_name"]);
                            break;
                        case 2:
                            $im = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
                            break;
                        case 3:
                            $im = imagecreatefrompng($_FILES["file"]["tmp_name"]);
                            break;
                        default:
                            exit();
                    }
                    $dst_w = 240;
                    $dst_h = 240;
                    $new_image = imagecreatetruecolor($dst_w,$dst_h);
                    imagecopyresized($new_image, $im,0, 0,0, 0, $dst_w, $dst_h, $src_w, $src_h);
                    $ext = "gif";
                    imagegif($new_image, "data/avatar/{$_G['user']['uid']}.{$ext}");
                    imagedestroy($im);
                    imagedestroy($new_image);
                    print("data/avatar/{$_G['user']['uid']}.{$ext}?r=".time());
                    db_update("user_profile", array(
                        'avatar' => "data/avatar/{$_G['user']['uid']}.{$ext}?r=".time()
                    ), "uid={$_G['user']['uid']}");
                }
            }
        }
        break;
    case 'upload_photo_wall':
        if($_G['user']['loginned']){
            $temp = explode(".", $_FILES["file"]["name"]);
            $ext = end($temp);
            if(in_array($ext, $_SETTINGS['upload_allowedExt']['image'])
                && in_array($_FILES["file"]["type"], $_SETTINGS['upload_FileType']['image'])
                && $_FILES["file"]["size"] <= $_SETTINGS['upload_FileSize']['image']){
                if ($_FILES["file"]["error"] <= 0)
                {
                    ini_set("memory_limit","30M");
                    list($src_w,$src_h,$type)=getimagesize($_FILES["file"]["tmp_name"]);
                    switch ($type) {
                        case 1:
                            $im = imagecreatefromgif($_FILES["file"]["tmp_name"]);
                            break;
                        case 2:
                            $im = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
                            break;
                        case 3:
                            $im = imagecreatefrompng($_FILES["file"]["tmp_name"]);
                            break;
                        default:
                            exit('exit');
                    }
                    if($src_w >= 1080){
                        $dst_w = 1080;
                        $dst_h = $src_h * 1080 / $src_w;
                    }else{
                        $dst_w = $src_w;
                        $dst_h = $src_h;
                    }
                    $new_image = imagecreatetruecolor($dst_w,$dst_h);
                    imagecopyresized($new_image, $im,0, 0,0, 0, $dst_w, $dst_h, $src_w, $src_h);
                    $ext = "jpg";
                    if(!is_dir("data/photo_wall")){
                        mkdir("data/photo_wall");
                    }
                    $filename = "data/photo_wall/".md5("{$_G['user']['uid']}_".time().rand(1,99999)).".{$ext}";
                    imagejpeg($new_image, $filename);
                    imagedestroy($im);
                    imagedestroy($new_image);
                    db_insert("user_photo_wall", array(
                        'time' => time(),
                        'uid' => $_G['user']['uid'],
                        'photo' => $filename
                    ));
                    if(file_exists($filename)) {
                        print($filename);
                    }else{
                        print("/exit");
                    }
                }
            }
        }
        break;
    case 'readNotice':
        if($_G['user']['loginned'] && isset($_GET['nid'])){
            db_update("common_notice_read", array("time" => time()), array('nid' => $_GET['nid'], 'uid' => $_G['user']['uid']), true);
        }
        break;
    default:
        break;
}
?>