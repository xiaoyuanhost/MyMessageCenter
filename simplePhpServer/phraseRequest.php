<?php

use Exception;

function phraseRequest(){
    // 路由控制

    $router = include_once BASEPATH . '/config/router.php';

    if ($_SERVER['HTTP_HOST'] !== 'localhost:1234') {
        // if ($_SERVER['HTTP_HOST'] !== 'xxx.com') {

        throw new Exception('当前host不被允许');
    } else {

        $request_path = $_GET['s'];
        

        $request_path = $request_path ? $request_path : 'index/index';

        $request_path = trim($request_path, '/');

        if (array_key_exists($request_path, $router)) {

            $module_file = BASEPATH . '/' . $router[$request_path]['file_name'];

            $class_name = $router[$request_path]['class_name'];

            $method_name = $router[$request_path]['method_name'];

            if (file_exists($module_file)) {

                include $module_file;

                $obj_module = new $class_name();

                if (!method_exists($obj_module, $method_name)) {

                    throw new Exception('要调用的方法:' . $method_name . '不存在');
                } else {

                    if (is_callable(array($obj_module, $method_name))) {

                        $obj_module->$method_name();
                    }
                }
            } else {

                throw new Exception('定义的模块:' . $module_file . '不存在');
            }
        } else {

            throw new Exception('页面：' . $request_path . '不存在');
        }
    }

}
