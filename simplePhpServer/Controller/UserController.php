<?php

namespace App\Http\Controllers\Api\Msg;

use JsonReturn;
use App\MsgUser;
use App\MsgToken;
use App\ResetPasswordMsg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public $loginAfterSignUp = true;

    public function __construct()
    {
//        $this->middleware('throttle:6,1');
    }

    public function loginRegister()
    {
        $loginemail= $_GET['loginemail'];
        $password= $_GET['password'];
        if ($password) {
            if ($loginemail) {
                $user = DB()->select("users", ['user_id'], [
                    "email[=]" => $loginemail,
                    "LIMIT" => 1
                ]);
                $save_password = md5($password);

                if ($user) {
                    if ($password==$user['password']) {
                        //验证成功 生成token
                        JsonReturn::success(
                            '登陆成功',
                            [
                            'userId'=> $user['id'],
                            'userName'=> $loginemail,
                            'token'=>$this->newToken($user['id']),
                            ]
                        );
                    } else {
                        JsonReturn::failure('密码错误', '');
                    }
                } else {
                    //启动注册流程
                    $user_id= DB()->insert("users", [
                        "password" => $save_password,
                        "loginemail" => $loginemail,
                    ]);

                    JsonReturn::success(
                        '登陆成功',
                        [
                            'userId'=> $user_id,
                            'userName' => $loginemail,
                            'token' => $this->newToken($user_id),
                            ]
                    );
                }
            } else {
                JsonReturn::failure('email must need', '');
            }
        } else {
            JsonReturn::failure('password must need', '');
        }
    }

    private function newToken($user_id)
    {
        $token= md5(md5($user_id));
        $user_id = DB()->insert("token", [
            "user_id" => $user_id,
            "token" => $token,
            "expire_at" => date('Y-m-d H:i:s', strtotime('+1 day')),
        ]);

        return $token;
    }

}
