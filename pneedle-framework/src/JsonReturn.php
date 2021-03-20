<?php
/**
 * Description:
 * 接口返回的JSON辅助类
 */

class JsonReturn
{

    const SUCCESS = 1;
    const FAILURE = -1;
    const ERROR = -2;

    public static function info($code, $message, $result = [])
    {
        $json = [
            'code' => $code,
            'message' => $message,
            'result' => $result,
        ];
        exit(json_encode($json));
    }

    public static function success($message, $result = [])
    {
        return self::info(self::SUCCESS, $message, $result);
    }

    public static function failure($message, $result = [])
    {
        return self::info(self::FAILURE, $message, $result);
    }

    public static function error($message, $result = [])
    {
        return self::info(self::ERROR, $message, $result);
    }

    public static function SUCCESSX()
    {
        return self::info(self::SUCCESS, "success", []);
    }

    public static function FAILUREX()
    {
        return self::info(self::FAILURE, "failure", []);
    }

    public static function ERRORX()
    {
        return self::info(self::ERROR, "error", []);
    }

}
