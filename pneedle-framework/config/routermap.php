<?php

function ROUTEMAP()
{
               return [

                              'index/index' => [ 'class_name' => 'Controllers\Index\IndexController', 'method_name' => 'index'],
                              'index/db' => [ 'class_name' => 'Controllers\Index\IndexController', 'method_name' => 'db'],
                              'index/db2' => [ 'class_name' => 'Controllers\Index\IndexController', 'method_name' => 'db2'],
                              'index/dbselect' => [ 'class_name' => 'Controllers\Index\IndexController', 'method_name' => 'dbselect'],

                              'api/msg/loginRegister' => ['class_name' => 'Controllers\UserController', 'method_name' => 'loginRegister'],

                              'api/msg/addChannel' => [ 'class_name' => 'Controllers\ChannelController', 'method_name' => 'addChannel'],
                              'api/msg/delChannel' => [ 'class_name' => 'Controllers\ChannelController', 'method_name' => 'delChannel'],
                              'api/msg/getChannelList' => [ 'class_name' => 'Controllers\ChannelController', 'method_name' => 'getChannelList'],

                              'api/msg/pushMsg' => [ 'class_name' => 'Controllers\MsgController', 'method_name' => 'pushMsg'],
                              'api/msg/getMsgList' => [ 'class_name' => 'Controllers\MsgController', 'method_name' => 'getMsgList'],
                              'api/msg/clearMsg' => [ 'class_name' => 'Controllers\MsgController', 'method_name' => 'clearMsg'],
               ];
}
