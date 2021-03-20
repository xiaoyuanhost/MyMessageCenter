<?php

namespace Controllers;

use JsonReturn;

class MsgController extends Controller
{
    public function pushMsg()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        $token = $json["token"];
        $from = $json["from"];
        $content = $json["content"];

        !$token && $token = $_POST["token"];
        !$from && $from = $_POST["from"];
        !$content && $content = $_POST["content"];

        
        !$token && $token = $_GET["token"];
        !$from && $from = $_GET["from"];
        !$content && $content = $_GET["content"];

        
        if ($token && $from && $content) {
            $fromChannels = DB()->select("channel", ['user_id'], [
                "token[=]" => $token,
                "LIMIT" => 1
            ]);
            
            if ($fromChannels) {
                $fromChannel= $fromChannels[0];

                DB()->insert("msg", [
                    "user_id" => $fromChannel['user_id'],
                    "from" => $from,
                    "content" => $content,
                    "token" => $token,
                ]);

                JsonReturn::success(
                    '添加成功',
                    []
                );
            } else {
                JsonReturn::failure('wrong token', '');
            }
        } else {
            JsonReturn::failure('token from content all need', '');
        }
    }

    public function getMsgList()
    {
        $lastId= $_GET['lastId']? $_GET['lastId']:0;
        $limit= $_GET['limit']? $_GET['limit']:20;
        $token = getallheaders()['token'];


        if ($token) {
            if ($user_id=$this->getUserIdByToken($token)) {

                $msgList = DB()->select("msg", '*', [
                    "user_id[=]" => $user_id,
                    "id[>]" => $lastId,
                    'LIMIT'=> $limit,
                ]);
                JsonReturn::success(
                    '成功',
                    $msgList
                );
            }
        } else {
            JsonReturn::failure('token must need', '');
        }
    }
    public function clearMsg()
    {
        $token = getallheaders()['token'];

        if ($token) {
            if ($user_id=$this->getUserIdByToken($token)) {
                DB()->delete("msg",[
                    "user_id[=]" => $user_id,
                ]);
                JsonReturn::success(
                    '删除成功',
                    []
                );
            } else {
                JsonReturn::failure('token must need', '');
            }
        } else {
            JsonReturn::failure('token must need', '');
        }
    }
}
