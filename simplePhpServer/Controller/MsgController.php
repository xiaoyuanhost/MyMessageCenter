<?php

namespace App\Http\Controllers\Api\Msg;

use App\Msg;
use App\MsgChannel;
use JsonReturn;
use Illuminate\Http\Request;
use App\Http\Controllers\Msg\Controller;

class MsgController extends Controller
{
    public function pushMsg()
    {
        $token = $_GET["token"];
        $from = $_GET["from"];
        $content = $_GET["content"];
        
        if ($token && $from && $content) {
            $fromChannel = DB()->select("channels", ['user_id'], [
                "token[=]" => $token,
                "LIMIT" => 1
            ]);
            if ($fromChannel) {

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
        $lastId= $_GET['lastId'];
        $token = getallheaders()['token'];


        if ($token) {
            if ($user_id=$this->getUserIdByToken($token)) {

                $msgList = DB()->select("msg", ['*'], [
                    "user_id[=]" => $user_id,
                    "id[>]" => $lastId,
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
                DB()->delete("msg", ['user_id'], [
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
