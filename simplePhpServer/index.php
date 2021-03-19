<?php

use Exception;


//auto load

require 'vendor/autoload.php';
include_once './function.php';
include_once './JsonReturn.php';
// 权限控制
include_once './auth.php';

// 应用入口文件

date_default_timezone_set("Asia/Shanghai");

header('Content-type: application/json;charset=utf-8');

// 项目根路径

define('BASEPATH', dirname(__FILE__));

// 调试模式

define('APP_DEBUG', True);

// 引入配置文件

include_once BASEPATH . '/config/config.php';

//DB init
include_once BASEPATH . '/initDB.php';


// 路由控制

include_once BASEPATH . '/phraseRequest.php';

try{
    phraseRequest();
}catch(Throwable $t){
    JsonReturn::error($t->getMessage());
}
