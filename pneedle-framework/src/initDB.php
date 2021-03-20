<?php

use Exception;
use Medoo\Medoo;

$database =null;

function DB(){
    global $database;

    if($database!=null){
        return $database;
    }

    if (array_key_exists(CONFIGDB()['db'], CONFIGDB())) {
        if(CONFIGDB()['db']== 'sqlite3'){
            $database = new Medoo([
                'database_type' => 'sqlite',
                'database_file' => CONFIGDB()['sqlite3']['database_file'],
                // 'database_file' => 'database_v1.db'
            ]);
            return $database;
        }

    }

    throw new Exception('init DB ERROR');


}
