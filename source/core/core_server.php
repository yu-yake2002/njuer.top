<?php

/*
 * Copyright By 南小宝
 * Last Edited: 20200906, By 张运筹
 */

class nxb_ChatServer{
    protected $master = null;
    protected $connectPool = [];
    protected $handPool = [];
    protected $chat_with = [];
    protected $uid = [];
    protected $not_uid = [];

    public function __construct($ip, $port, $backlog=20000)
    {
        $this->startServer($ip, $port, $backlog);
    }

    protected function startServer($ip, $port, $backlog=20000)
    {
        global $_COOKIE;
        $this->connectPool[] = $this->master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_bind($this->master, $ip, $port);
        socket_listen($this->master, $backlog);
        while (true){
            $sockets = $this->connectPool;
            $write = $except = null;
            socket_select($sockets, $write, $except, 60);

            foreach ($sockets as $socket)
            {
                if($socket == $this->master)
                {
                    $this->connectPool[] = $client = socket_accept($this->master);
                    $keyArr = \array_keys($this->connectPool, $client);
                    $key = end($keyArr);
                    $this->handPool[$key] = false;
                    $this->chat_with[$key] = -1;
                    $this->uid[$key] = -1;
                    $this->not_uid[$key] = -1;
                }else{
                    try {
                        $length = \socket_recv($socket, $buffer, 1024, 0);
                    } catch (Exception $error){
                        $length = 0;
                    }
                    if($length < 1)
                    {
                        $this->close($socket);
                    }else{
                        $key = \array_search($socket, $this->connectPool);
                        if($this->handPool[$key] == false) {
                            $this->handShake($socket, $buffer, $key);
                        } elseif($this->chat_with[$key] == -1) {
                            $message = $this->deFrame($buffer);
                            $msgArr = explode(",", $message);
                            $answer = "Fail Type: 1, count(megArr)=".count($msgArr);
                            if(count($msgArr) == 3) {
                                $answer = "Fail Type: 2, chatKey is wrong. ";
                                $uid = $msgArr[0];
                                $chat_with = $msgArr[1];
                                $chatKey = substr(md5($msgArr[0]."J2L@ma0".$msgArr[1]), 6, 18);
                                if($chatKey == $msgArr[2])
                                {
                                    if($chat_with != -2) {
                                        if ($uidKey = array_search($uid, $this->uid)) {
                                            $this->close($this->connectPool[$uidKey]);
                                        }
                                        $this->uid[$key] = $uid;
                                        $this->chat_with[$key] = $chat_with;
                                        $answer = "Success";
                                    }else{
                                        if ($uidKey = array_search($uid, $this->not_uid)) {
                                            $this->close($this->connectPool[$uidKey]);
                                        }
                                        $this->not_uid[$key] = $uid;
                                        $this->chat_with[$key] = $chat_with;
                                        $answer = "Success";
                                    }
                                }
                            }
                            $answer = $this->enFrame($answer);
                            socket_write($this->connectPool[$key], $answer, strlen($answer));
                        } elseif($this->chat_with[$key] == -2) {
                            $message = $this->deFrame($buffer);
                            $message = "Recieved: {$message}, uid={$this->not_uid[$key]}";
                            $message = $this->enFrame($message);
                            socket_write($this->connectPool[$key], $message, strlen($message));
                        } else {
                            $message = $this->deFrame($buffer);
                            if($this->send_message($message, $key)) {
                                $message = "Msg: ".$message;
                                $this->send($message, $key);
                            }
                        }
                    }
                }
            }
        }
    }

    protected function close($socket)
    {
        $key = \array_search($socket, $this->connectPool);
        unset($this->connectPool[$key]);
        unset($this->handPool[$key]);
        unset($this->chat_with[$key]);
        unset($this->uid[$key]);
        unset($this->not_uid[$key]);
        \socket_close($socket);
    }

    protected function handShake($socket, $buffer, $key)
    {
        $buf = substr($buffer, strpos($buffer, 'Sec-WebSocket-Key:') + 18);
        $secKey = trim(substr($buf, 0, strpos($buf, "\r\n")));
        $resKey = base64_encode(sha1($secKey.'258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
        $resposeHeader = "HTTP/1.1 101 Switching Protocols\r\n";
        $resposeHeader .= "Upgrade: websocket\r\n";
        $resposeHeader .= "Sec-WebSocket-Version: 13\r\n";
        $resposeHeader .= "Connection: Upgrade\r\n";
        $resposeHeader .= "Sec-WebSocket-Accept: " . $resKey . "\r\n\r\n";
        socket_write($socket, $resposeHeader, strlen($resposeHeader));
        $this->handPool[$key] = true;
    }

    protected function deFrame($buffer)
    {
        $decoded = null;
        $len = ord($buffer[1]) & 127;

        if($len === 126) {
            $masks = substr($buffer, 4, 4);
            $data = substr($buffer, 8);
        }elseif($len === 127) {
            $masks = substr($buffer, 10, 4);
            $data = substr($buffer, 14);
        }else{
            $masks = substr($buffer, 2, 4);
            $data = substr($buffer, 6);
        }
        for($index = 0; $index < strlen($data); $index++)
        {
            $decoded .= $data[$index] ^ $masks[$index % 4];
        }
        return $decoded;
    }

    protected function enFrame($message)
    {
        $len = strlen($message);
        if ($len <= 125){
            return "\x81" . chr($len) . $message;
        } elseif ($len <= 65535) {
            return "\x81" . chr(126) . pack("n", $len) . $message;
        } else {
            return "\x81" . char(127) . pack("xxxxN", $len) . $message;
        }
    }

    protected function send($message, $key){
        $message1 = "0".$message;
        $message2 = "1".$message;
        $message1 = $this->enFrame($message1);
        $message2 = $this->enFrame($message2);
        $ChatWith_Key = \array_search($this->chat_with[$key], $this->uid);
        if(!$ChatWith_Key){
            $ChatWith_Key = \array_search($this->chat_with[$key], $this->not_uid);
        }elseif($this->chat_with[$ChatWith_Key] != $this->uid[$key]){
            $ChatWith_Key = false;
        }
        if($ChatWith_Key) {
            $socket = $this->connectPool[$ChatWith_Key];
            if ($socket != $this->master) {
                socket_write($socket, $message1, strlen($message1));
            }
        }
        socket_write($this->connectPool[$key], $message2, strlen($message2));
    }

    protected function send_message($message, $key){
        $uid = $this->uid[$key];
        $to_uid = $this->chat_with[$key];
        $answer = "Message is sent!";
        $message_length = strlen($message);
        if($message_length > 5 && substr($message, 0, 5) == "send:") {
            $message = substr($message, 5, $message_length - 5);
            if($uid && $to_uid && $message) {
                try {
                    db_insert("user_message", array(
                        'uid' => $uid,
                        'to_uid' => $to_uid,
                        'text' => $message,
                        'time' => time()
                    ));
                }catch (Exception $error){}
                if ($toread = db_fetch(db_query("SELECT * FROM user_message_list WHERE uid={$to_uid} AND from_uid={$uid}"))) {
                    $toread = $toread['toread'] + 1;
                    db_update("user_message_list", array(
                        "toread" => $toread,
                        "time" => time(),
                        "text" => $message
                    ), "uid={$to_uid} AND from_uid={$uid}");
                } else {
                    db_insert("user_message_list", array(
                        "toread" => 1,
                        "from_uid" => $uid,
                        "uid" => $to_uid,
                        "text" => $message,
                        "time" => time()
                    ));
                }
                db_update("user_message_list", array(
                    "toread" => 0,
                    "time" => time(),
                    "text" => $message
                ), "uid={$uid} AND from_uid={$to_uid}");
            }
        }else{
            $answer = "Fail";
        }
        $answer = $this->enFrame($answer);
        socket_write($this->connectPool[$key], $answer, strlen($answer));
        if($answer == "Fail"){
            return false;
        }else{
            return true;
        }
    }
}

?>