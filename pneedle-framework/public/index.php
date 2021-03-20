<?php

use Exception;


//auto load

require '../vendor/autoload.php';

// 应用入口文件

date_default_timezone_set("Asia/Shanghai");

header('Content-type: application/json;charset=utf-8');
//跨域
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Origin: 跨域URL");
// header("Access-Control-Allow-Origin: http://192.168.0.104:1234");
header("Access-Control-Allow-Origin:*");
//CORS
header("Access-Control-Request-Methods:GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Headers:x-requested-with,content-type,test-token,token');//注意头部自定义参数不要用下划线
// 项目根路径

define('BASEPATH', dirname(__FILE__));


// 调试模式

define('APP_DEBUG', True);

// 引入配置文件

include_once BASEPATH . '/config/config.php';

//DB init
// include_once BASEPATH . '/initDB.php';


// 路由控制

// include_once BASEPATH . '/phraseRequest.php';

try{
    $router=new Router();
    $router->phraseRequest();
}catch(Throwable $t){
    JsonReturn::error($t->getMessage());
}
