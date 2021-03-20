<?php

namespace Controllers;

use JsonReturn;

class UserController
{
    public $loginAfterSignUp = true;

    public function __construct()
    {
//        $this->middleware('throttle:6,1');
    }

    public function loginRegister()
    {
        $json=json_decode(file_get_contents("php://input"),true);
        $loginemail= $json['loginemail'];
        $password= $json['password'];

        !$loginemail && $loginemail=$_POST['loginemail'];
        !$password && $password=$_POST['password'];


        if ($password) {
            if ($loginemail) {
                $userlist = DB()->select("user", ['id','password'], [
                    "loginemail[=]" => $loginemail,
                    "LIMIT" => 1
                ]);

                $save_password = md5($password);

                if ($userlist) {
                    $user=$userlist[0];

                    if ($save_password==$user['password']) {
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
                    DB()->insert("user", [
                        "password" => $save_password,
                        "loginemail" => $loginemail,
                    ]);
                    $user_id = DB()->id();

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
        DB()->insert("token", [
            "user_id" => $user_id,
            "token" => $token,
            "expire_at" => date('Y-m-d H:i:s', strtotime('+1 day')),

        ]);

        return $token;
    }

}
