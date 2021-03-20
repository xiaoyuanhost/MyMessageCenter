<?php

use Exception;

class Router
{
    function phraseRequest()
    {
        // 路由控制
        if (false) {
            // if ($_SERVER['HTTP_HOST'] !== 'localhost:1234') {
            // if ($_SERVER['HTTP_HOST'] !== 'xxx.com') {

            throw new Exception('当前host不被允许');
        } else {

            $request_path = $_GET['s'];


            $request_path = $request_path ? $request_path : 'index/index';

            $request_path = trim($request_path, '/');

            if (array_key_exists($request_path, ROUTEMAP())) {


                $class_name = ROUTEMAP()[$request_path]['class_name'];

                $method_name = ROUTEMAP()[$request_path]['method_name'];

                $obj_module = new $class_name();

                if (!method_exists($obj_module, $method_name)) {

                    throw new Exception('要调用的方法:' . $method_name . '不存在');
                } else {

                    if (is_callable(array($obj_module, $method_name))) {

                        $obj_module->$method_name();
                    }
                }
            } else {

                throw new Exception('页面：' . $request_path . '不存在');
            }
        }
    }
}
