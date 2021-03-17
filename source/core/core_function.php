<?php
/*Copyright by nanxiaobao*/

if(!defined("IS_INCLUDED"))
{
    die('Access denied!');
}


include_once 'source/core/core_file.php';

session_start();

function UserisMobile()
{
    if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
        return true;
    } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML")) {
        return true;
    } elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
        return true;
    } elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
        return true;
    } else {
        return false;
    }
}

$_CORE["url"] = "https://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_CORE["uri"] = $_SERVER['REQUEST_URI'];
$_CORE['isMobile'] = UserisMobile();

function CORE_GOTOURL($url)
{
    global $_CORE;
    if($url != $_CORE["uri"] && "/$url" != $_CORE["uri"] && "/local_nanxiaobao/$url" != $_CORE["uri"]) {
        header("Location: $url");
        exit;
    }
}

function CORE_SHOWINFO($message, $url=-1)
{
    $_CORE['style_css'] = "";
    if($url==-1) {
        $url = urlencode($_CORE['url']);
    }else{
        $url = urlencode($url);
    }
    include template("app/common:header");
    echo "</body><script>$.alert({text: '{$message}', onOK: function() {
      location.href='{$url}';
    }});</script>";
    exit();
}

function CORE_SENDMESSAGE($uid, $text, $from="系统消息", $quote='')
{
    global $_G;
    if($_G['user']['loginned'] && $from == $_G['user']['name'])
    {
        $fromid = $_G['user']['uid'];
    }else{
        $fromid = 0;
    }
    db_insert(
        "user_messagelist",
        array(
            'read' => 0,
            'from' => $from,
            'uid' => $uid,
            'text' => $text,
            'fromid' => $fromid,
            'quote' => $quote
        )
    );
}

function SENDMAIL($to,$title,$content){
    global $_CONFIG;
    require_once("./source/core/core_phpmailer.php");
    require_once("./source/core/core_smtp.php");
    $mail_index = rand(0, $_CONFIG['mail_num']);
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth=true;
    $mail->Host = $_CONFIG['mail'][$mail_index]['smtp'];
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';
    $mail->FromName = '南小宝';
    $mail->Username = $_CONFIG['mail'][$mail_index]['from'];
    $mail->Password = $_CONFIG['mail'][$mail_index]['pwd'];
    $mail->From = $_CONFIG['mail'][$mail_index]['from'];
    $mail->isHTML(true);
    $mail->addAddress($to);
    $mail->Subject = $title;
    $mail->Body = $content;

    if($mail->send()) {
        return true;
    }else{
        return false;
    }
}

function compare_face($image1, $image2){
    global $_CONFIG;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $_CONFIG['api']['face_api_compare_host'],
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_AUTOREFERER => 1,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POSTFIELDS => array(
            'image_file1'=>new CURLFile($image1),
            'image_file2'=>new CURLFile($image2),
            'api_key'=>$_CONFIG['api']['face_api_key'],
            'api_secret'=>$_CONFIG['api']['face_api_secret']
        ),
        CURLOPT_HTTPHEADER => array("cache-control: no-cache",),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err)
    {
        print $err;
        return array();
    }
    else
    {
        $arr=json_decode($response,true);
        return $arr["confidence"];
    }
}

function analyse_face($image){
    global $_CONFIG;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api-cn.faceplusplus.com/facepp/v3/detect",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array(
            'image_file'=>new CURLFile($image),
            'api_key'=>$_CONFIG['api']['face_api_key'],
            'api_secret'=>$_CONFIG['api']['face_api_secret'],
            'return_landmark'=>"1",
            'return_attributes'=>"gender,beauty"),
        CURLOPT_HTTPHEADER => array("cache-control: no-cache",),
    ));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return array();
    } else {
        $response = json_decode($response, true);
        if($response['faces'])
            return $response['faces'][0];
        else
            return array();
    }
}



class jiaowu{
    public $code;
    public $sid;
    public $name;
    public $success = false;
    public $result;
    private $cookie_file;
    private $login_url;
    private $verify_code_url;
    private $curl;
    private $contents;
    private $getinfourl=
        "http://elite.nju.edu.cn/jiaowu/student/studentinfo/studentinfo.do?method=searchAllList";

    function __construct($token, $method="jiaowu")
    {
        $this->cookie_file = "JIAOWU.$token";
        $this->method = $method;
        if($method == "jiaowu") {
            $this->login_url = "https://elite.nju.edu.cn/jiaowu";
            $this->login_post_url = "http://elite.nju.edu.cn/jiaowu/login.do";
            $this->verify_code_url = "http://elite.nju.edu.cn/jiaowu/ValidateCode.jsp";
            $this->code = "data/cache/JIAOWU_verifyCode_$token.jpg";
            if(!file_exists($this->code)) {
                $this->curl = curl_init();
                curl_setopt($this->curl,
                    CURLOPT_URL, $this->login_url);
                curl_setopt($this->curl,
                    CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($this->curl,
                    CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($this->curl,
                    CURLOPT_COOKIEJAR, $this->cookie_file);
                $this->contents = curl_exec($this->curl);
                curl_close($this->curl);

                $this->curl = curl_init();
                curl_setopt($this->curl,
                    CURLOPT_URL, $this->verify_code_url);
                curl_setopt($this->curl,
                    CURLOPT_COOKIEFILE, $this->cookie_file);
                curl_setopt($this->curl,
                    CURLOPT_HEADER, 0);
                curl_setopt($this->curl,
                    CURLOPT_RETURNTRANSFER, 1);
                $code_img = curl_exec($this->curl);
                curl_close($this->curl);

                $fp = fopen($this->code, "w");
                fwrite($fp, $code_img);
                fclose($fp);
            }
        }else{
            $this->login_url = "https://authserver.nju.edu.cn/authserver/login";
            $this->login_post_url = "https://authserver.nju.edu.cn/authserver/login";
            $this->curl = curl_init();
            curl_setopt($this->curl,
                CURLOPT_URL, $this->login_url);
            curl_setopt($this->curl,
                CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($this->curl,
                CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($this->curl,
                CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->curl,
                CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($this->curl,
                CURLOPT_COOKIEJAR, $this->cookie_file);
            $this->contents = curl_exec($this->curl);
            curl_close($this->curl);
        }

    }
    public function login($sid, $pwd, $code=""){
        if($this->method == "jiaowu") {
            $post = "userName=$sid&password=$pwd&ValidateCode=$code";
        }else{
            $post = "username=$sid&password=$pwd";
        }

        $this->curl = curl_init();
        curl_setopt($this->curl,
            CURLOPT_URL, $this->login_post_url);
        curl_setopt($this->curl,
            CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($this->curl,
            CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($this->curl,
            CURLOPT_HEADER, false);
        curl_setopt($this->curl,
            CURLOPT_RETURNTRANSFER,1);
        curl_setopt($this->curl,
            CURLOPT_REFERER, $this->login_url);
        curl_setopt($this->curl,
            CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36");//来路
        curl_setopt($this->curl,
            CURLOPT_HTTPHEADER, array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Upgrade-Insecure-Requests: 1',
                'Content-Type: application/x-www-form-urlencoded',
                'Accept-Encoding: gzip, deflate',
                'Accept-Language: zh-CN,zh;q=0.8',
                'Content-Length:'.strlen($post)));
        curl_setopt($this->curl,
            CURLOPT_POSTFIELDS, $post);
        curl_setopt($this->curl,
            CURLOPT_COOKIEFILE, $this->cookie_file);
        $result = curl_exec($this->curl);
        curl_close($this->curl);
    }

    public function getinfo()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl,
            CURLOPT_URL, $this->getinfourl);
        curl_setopt($this->curl,
            CURLOPT_HEADER, false);
        curl_setopt($this->curl,
            CURLOPT_RETURNTRANSFER,1);
        curl_setopt($this->curl,
            CURLOPT_COOKIEFILE, $this->cookie_file);
        $result = curl_exec($this->curl);
        curl_close($this->curl);
        print $result;

        if(substr_count(
            $result,
            "<li id=\"studentinfo\"><a href=\"student/studentinfo/index.do\"><img src=\"image/student/personal.png\"><br />个人信息</a></li>"
        ))
        {
            if(substr_count(
                $result,
                "<td  class=\"TABLE_TD_02\">学号</td>"
            ))
            {
                $sid = explode("<td  class=\"TABLE_TD_02\">学号</td>", $result)[1];
                $sid = explode("</td>", $sid)[0];
                $sid = explode("<td class=\"TABLE_TD_01\">", $sid)[1];
                $this->success = true;
                $this->sid = $sid;
            }

            if(substr_count(
                $result,
                "<td class=\"TABLE_TD_02\">"
            ))
            {
                $name = explode("<td class=\"TABLE_TD_02\">姓名</td>", $result)[1];
                $name = explode("</td>", $name)[0];
                $name = explode("<td class=\"TABLE_TD_01\">", $name)[1];
                $this->success = true;
                $this->name = $name;
            }
        }
        $this->result=$result;

        if($this->method == "jiaowu") {
            unlink($this->code);
        }

        return $this->success;
    }
}

?>