<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}

function dir_copy($src = '', $dst = '')
{
    if (empty($src) || empty($dst))
    {
        return false;
    }

    $dir = opendir($src);
    dir_mkdir($dst);
    while (false !== ($file = readdir($dir)))
    {
        if (($file != '.') && ($file != '..'))
        {
            if (is_dir($src . '/' . $file))
            {
                dir_copy($src . '/' . $file, $dst . '/' . $file);
            }
            else
            {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);

    return true;
}

function dir_mkdir($path = '', $mode = 0777, $recursive = true)
{
    clearstatcache();
    if (!is_dir($path))
    {
        mkdir($path, $mode, $recursive);
        return chmod($path, $mode);
    }

    return true;
}


function img_to_circle($imgpath) {
    $ext     = pathinfo($imgpath);
    $src_img = null;
    switch ($ext['extension']) {
        case 'jpg':
            $src_img = imagecreatefromjpeg($imgpath);
            break;
        case 'png':
            $src_img = imagecreatefrompng($imgpath);
            break;
    }
    $wh  = getimagesize($imgpath);
    $w   = $wh[0];
    $h   = $wh[1];
    $w   = min($w, $h);
    $h   = $w;
    $img = imagecreatetruecolor($w, $h);
    imagesavealpha($img, true);
    $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
    imagefill($img, 0, 0, $bg);
    $r   = $w / 2;
    $y_x = $r;
    $y_y = $r;
    for ($x = 0; $x < $w; $x++) {
        for ($y = 0; $y < $h; $y++) {
            $rgbColor = imagecolorat($src_img, $x, $y);
            if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                imagesetpixel($img, $x, $y, $rgbColor);
            }
        }
    }
    return $img;
}
?>