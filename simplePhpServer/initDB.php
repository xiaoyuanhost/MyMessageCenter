<?php

use Exception;
use Medoo\Medoo;

$database =null;

function DB(){
    global $database;

    if($database!=null){
        return $database;
    }

    $dbconfig = include_once BASEPATH . '/config/db.php';

    if (array_key_exists($dbconfig['db'], $dbconfig)) {
        if($dbconfig['db']== 'sqlite3'){
            $database = new Medoo([
                'database_type' => 'sqlite',
                'database_file' => $dbconfig['sqlite3']['database_file'],
                // 'database_file' => 'database_v1.db'
            ]);
            return $database;
        }

    }

    throw new Exception('init DB ERROR');


}
