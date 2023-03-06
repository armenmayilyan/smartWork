<?php

namespace phplogin\model;

use phplogin\model\traits\Queryable;

include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/model/traits/Queryable.php';

class User
{
    use Queryable;
}
//public static function getAllUsers()
//    {
//
//        $conn = Config::connect();
//        $sql = "SELECT * FROM users";
//        $results = $conn->query($sql);
//        $results->fetch_assoc();
//        return $results;
//
//
//    }
//
//
//    public static function getById($data)
//    {
//
//        $conn = Config::connect();
//        $sql = "SELECT * FROM users WHERE `id` = '$data'";
//        $results = $conn->query($sql);
//        $row = $results->fetch_assoc();
//        return $row;
//    }

//    public static function getUser($data)
//    {
//        var_dump($data);
//        $conn = Config::connect();
//        $sql = "SELECT * FROM users WHERE `email` = '$data'";
//        $results = $conn->query($sql);
//        $row = $results->fetch_assoc();
//        return $row;
//    }

//    public static function updateUser($data)
//    {
//        $conn = Config::connect();
//        $sql = "UPDATE users
//SET name='{$data['name']}', email='{$data['email']}',password='{$data['pass']}'
//WHERE id='{$data['id']}'";
//        $conn->query($sql);
//
//
//    }
//
//    public static function deleteUser($data)
//    {
//        $id = (int)$data;
//        $conn = Config::connect();
//        $sql = "DELETE FROM users WHERE `id`  = '{$id}'";
//        $conn->query($sql);
//
//
//    }
//
//    public static function roles($userId)
//    {
//        $conn = Config::connect();
//        $sql = "SELECT users.*, role.role_name
//FROM users
//         INNER JOIN role_user ru on users.id = {$userId}
//
//         INNER JOIN role
//                    ON ru.role_id = role.id";
//        $results = $conn->query($sql);
//        $row = $results->fetch_assoc();
//        return $row;
//    }
//}


