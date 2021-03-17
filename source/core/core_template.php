<?php

if(!defined("IS_INCLUDED"))
{
    die('Error: You can\'t arrive it directly. ');
}

class core_template{
    public $src;
    public $code_src;
    public $code;
    public $cache;

    function init($src, $where="template")
    {
        $this->src = explode("/", $src)[0];
        $this->find_template = $where;
        if($this->src == 'app')
        {
            $this->src = explode("/", $src)[1];
            $src_explode = explode(":", $this->src);
            $this->cache = 'cache/app/cache_app_'.$src_explode[0].'_'.$src_explode[1].'.php';
            $this->code_src = 'template_app/'.$src_explode[0].'/'.$src_explode[0].'_'.$src_explode[1].'.html';
        }else if($this->src == 'plugin') {
            $this->src = explode("/", $src)[1];
            $src_explode = explode(":", $this->src);
            $this->cache = 'cache/app/cache_plugin_'.$src_explode[0].'_'.$src_explode[1].'.php';
            $this->code_src = 'source/plugin/'.$src_explode[0].'/template/'.$src_explode[1].'.html';
        }else if($this->src == 'app_style') {
            $this->src = explode("/", $src)[1];
            $src_explode = explode(":", $this->src);
            if($src_explode[0] == "day"){
                $this->cache = 'cache/app/cache_app_'.$src_explode[1].'_'.$src_explode[2].'.php';
                $this->code_src = 'template_app/'.$src_explode[1].'/'.$src_explode[1].'_'.$src_explode[2].'.html';
            }else{
                $this->cache = 'cache/app/cache_app_style_'.$src_explode[0].'_'.$src_explode[1].'_'.$src_explode[2].'.php';
                $this->code_src = "template_app/style/{$src_explode[0]}/{$src_explode[1]}/{$src_explode[1]}_{$src_explode[2]}.html";

                if(!file_exists($this->code_src)){
                    $this->cache = 'cache/app/cache_app_'.$src_explode[1].'_'.$src_explode[2].'.php';
                    $this->code_src = 'template_app/'.$src_explode[1].'/'.$src_explode[1].'_'.$src_explode[2].'.html';
                }

            }
        }else{
            if($this->find_template == "template")
            {
                $src_explode = explode(":", $this->src);
                $this->cache = 'cache/pc/cache_pc_'.$src_explode[0].'_'.$src_explode[1].'.php';
                $this->code_src = 'template_pc/'.$src_explode[0].'/'.$src_explode[0].'_'.$src_explode[1].'.html';
            }elseif($this->find_template == "this")
            {
                $src_explode = explode(":", $this->src);
                $this->cache = 'cache/cache_'.$src_explode[0].'_'.$src_explode[1].'.php';
                $this->code_src = 'template/'.$src_explode[0].'_'.$src_explode[1].'.html';
            }
        }
    }

    function get_code()
    {
        if(!file_exists($this->code_src)){
            $this->code = "";
        }else {
            $this->code = file_get_contents($this->code_src);
        }
    }

    function translate()
    {
        $array = array(
            "<?php\r\n" => "<?php ",
            //"\r\n" => "",
            "<else>" => "<?php }else{ ?>",
            "{else}" => "<?php }else{ ?>",
            "{/if}" => "<?php } ?>",
            "{php}" => "<php>",
            "{/php}" => "</php>",
            "</if>" => "<?php } ?>",
            "date(\"Y-m-d H:i:s\", " => "formatTime(",
            "<php>echo rand(1,9999)</php>" => rand(1,9999),
            "{rand}" => rand(1,9999),
            "{uRand}" => "<php>echo rand(1,10000)</php>",
            "</loop>" => "<?php } ?>",
            "</foreach>" => "<?php } ?>",
            "{/for}" => "<?php } ?>"
        );
        foreach ($array as $key => $value){
            $this->code = str_ireplace($key, $value, $this->code);
        }

        $array = array(
            "/<!--{template (.*?)}-->/" => '<?php include template("\\1"); ?>',
            "/<if (.*?)>/" => "<?php if(\\1){ ?>",
            "/<elseif (.*?)>/" => "<?php }elseif(\\1){ ?>",
            "/{if (.*?)}/" => "<?php if(\\1){ ?>",
            "/{elseif (.*?)}/" => "<?php }elseif(\\1){ ?>",
            "/<php>([\s\S]*)<\/php>/" => "<?php \\1; ?>",
            "/<php>(.*?)<\/php>/" => "<?php \\1; ?>",
            "/<\/php>([\s\S]*)<php>/" => "; ?> \\1 <?php ",
            "/<while (.*?)>([\s\S]*)<\/while>/" => "<?php while(\\1){ ?>\\2<?php } ?>",
            "/<loop \\$(.*?) row_var \\$(.*?)>/" => "<?php while($\\2 = db_fetch($\\1)){ ?>",
            "/<foreach \\$(.*?)>/" => "<?php foreach($\\1 as \$key => \$value){ ?>",
            "/<var (.*?)>(.*?)<\/var>/" => "<?php $\\1 = \\2; ?>",
            "/{posted (.*?)}/" => '<?php echo isset($_POST["\\1"])?($_POST["\\1"]):(""); ?>',
            "/{post (.*?)}/" => '<?php echo isset($_POST["\\1"])?($_POST["\\1"]):(""); ?>',
            "/{\\$(.*?)}/" => '<?php echo isset($\\1)?($\\1):(""); ?>',
            "/{get (.*?)}/" => '<?php echo isset($_GET["\\1"])?($_GET["\\1"]):(""); ?>',
            "/{time (.*?)}/" => '<?php echo formatTime(\\1); ?>',
            "/<var>(.*?)<\/var>/" => "<?php echo $\\1; ?>",
            "/{\$(.*?)}/" => "<?php echo $\\1; ?>",
            "/{for (.*?)}/" => "<?php for(\\1){ ?>",
            "/{func (.*?)}(.*?){\/func}/" => "<?php echo \\1(\\2); ?>",
            "/<func (.*?)>(.*?)<\/func>/" => "<?php echo \\1(\\2); ?>"
        );

        foreach ($array as $pattern => $value){
            $this->code = preg_replace($pattern, $value, $this->code);
        }
        foreach ($array as $pattern => $value){
            $this->code = preg_replace($pattern, $value, $this->code);
        }
        foreach ($array as $pattern => $value){
            $this->code = preg_replace($pattern, $value, $this->code);
        }

        $array = array(
            "/<title>(.*?)<\/title>/" => '<title>南小宝 - \\1</title>'
        );
        foreach ($array as $pattern => $value){
            $this->code = preg_replace($pattern, $value, $this->code);
        }

        preg_match_all("/echo \\$(.*?);/", $this->code, $variables);
        foreach ($variables[1] as $value)
        {
            if(substr_count($value, '+')
                || substr_count($value, '-')
                || substr_count($value, '*')
                || substr_count($value, '/')
                || substr_count($value, '(')
                || substr_count($value, ' ')
                || substr_count($value, '=')
                || substr_count($value, '!')
                || substr_count($value, '&')
                || substr_count($value, '|')
                || substr_count($value, '%')
                || substr_count($value, '^')
                || substr_count($value, '?')
                || substr_count($value, ':'))
            {
                continue;
            }
            $word = str_ireplace('"', '\"', $value);
            $this->code = str_ireplace(
                "echo $$value;",
                "echo isset($$value)?($$value):(\"var[$word]\");",
                $this->code
            );
        }
        $this->code = str_ireplace("<!---->", "", $this->code);
    }

    function header()
    {
        $this->code = "<?php /*自动生成的模板文件_*/\r\nif(!defined(\"IS_INCLUDED\")) die('Access denied!'); ?>\r\n".$this->code;
    }

}

function template($src, $where="template")
{
    $result = new core_template();
    $result->init($src, $where);

    if (!file_exists($result->cache) || defined("DEBUG"))
    {
        $result->get_code();
        $result->translate();
        $result->header();
        file_put_contents($result->cache, $result->code);
    }

    return $result->cache;
}

?>