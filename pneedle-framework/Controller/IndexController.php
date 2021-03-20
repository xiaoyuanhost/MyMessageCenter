<?php

namespace Controllers\Index;

use JsonReturn;
use Medoo\Medoo;

class IndexController
{
    public function index()
    {
        JsonReturn::SUCCESS(6666);
    }
    public function db()
    {
        $database = new Medoo([
            'database_type' => 'sqlite',
            'database_file' => 'database_v1.db'
        ]);

        $database->insert("account", [
            "user_name" => "foo",
            "email" => "foo@bar.com"
        ]);
        JsonReturn::SUCCESS(6666);
    }
    public function db2()
    {
        DB()->insert("account", [
            "user_name" => "foo",
            "email" => "foo@bar.com"
        ]);
        JsonReturn::SUCCESS(6666);
    }
    public function dbselect()
    {
        JsonReturn::SUCCESS(DB()->select("account", ['user_name','email'],[]));
    }

}
