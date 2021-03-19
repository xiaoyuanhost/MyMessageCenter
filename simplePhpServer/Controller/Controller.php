<?php

namespace App\Http\Controllers\Msg;

use App\MsgToken;
use Illuminate\Routing\Controller as BaseController;

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
            $tokenM=$$tokens[0];
            if ($tokenM) {
                return $tokenM->user_id;
            }
        }
    }
}
