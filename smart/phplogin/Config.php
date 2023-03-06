<?php
namespace phplogin;
class Config
{
    public static function connect()
    {
        $config = [
            'hostname' => '172.17.0.3',
            'username' => 'root',
            'password' => '123456789',
            'database' => 'blog',

        ];
//        $dsn = "mysql:host={$config['hostname']};dbname={$config['database']}";
//        $database = new PDO($dsn,$config['username'],$config['password']);
//        $database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//        return $database;
        return new \mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);

    }
}


