<?php

namespace App\Http\Controllers\Api\Msg;

use App\MsgChannel;
use JsonReturn;
use Illuminate\Http\Request;
use App\Http\Controllers\Msg\Controller;

class ChannelController extends Controller
{
    public function addChannel()
    {
        $channelName= $_GET["channelName"];
        $token= getallheaders()['token'];
        if ($token) {
            if ($user_id=$this->getUserIdByToken($token)) {
                if ($channelName) {
                    DB()->insert("channels", [
                        "user_id" => $user_id,
                        "name" => $channelName,
                        "token" => $this->getrandstr(200)
                    ]);

                    JsonReturn::success(
                        '添加成功',
                        []
                    );
                } else {
                    JsonReturn::failure('channelName must need', '');
                }
            }
        } else {
            JsonReturn::failure('token must need', '');
        }
    }
    private function getrandstr($length)
    {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $lengthStr=str_pad($str, $length, $str);
        $randStr = str_shuffle($str);//打乱字符串
 
        $rands= substr($randStr, 0, $length);//substr(string,start,length);返回字符串的一部分
 
        return $rands;
    }

    public function getChannelList()
    {
        $token = getallheaders()['token'];

        if ($token) {
            if ($user_id=$this->getUserIdByToken($token)) {
                $channels = DB()->select("channels", ['user_id'], [
                    "user_id[=]" => $user_id,
                    "expire_at[>=]" => date('Y-m-d H:i:s'),
                    "LIMIT" => 1
                ]);
                return JsonReturn::success(
                    '成功',
                    $channels
                );
            }
        } else {
            return JsonReturn::failure('token must need', '');
        }
    }
    public function delChannel()
    {
        $token = getallheaders()['token'];

        if ($token) {
            if ($user_id=$this->getUserIdByToken($token)) {

                if ($id= $_GET['id']) {
                    $channels = DB()->delete("channels", ['user_id'], [
                        "id[=]" => $id,
                        "user_id[=]" => $user_id,
                    ]);
                    return JsonReturn::success(
                        '删除成功',
                        []
                    );
                } else {
                    return JsonReturn::failure('id must need', '');
                }
            }
        } else {
            return JsonReturn::failure('token must need', '');
        }
    }
}
