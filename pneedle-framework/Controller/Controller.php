<?php

namespace Controllers;

use App\MsgToken;
use Exception;

class Controller
{
    function getUserIdByToken($token)
    {
        $tokens = DB()->select("token", ['user_id'], [
            "token[=]" => $token,
            "expire_at[>=]" => date('Y-m-d H:i:s'),
            "LIMIT" => 1
        ]);
        if($tokens){
            $tokenM=$tokens[0];
            if ($tokenM) {
                return $tokenM['user_id'];
            }
        }
        throw new Exception("wrong token");
    }
}
