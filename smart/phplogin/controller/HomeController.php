<?php
namespace phplogin\controller;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/controller/UserDto.php';

class HomeController
{
    public static $error = '';

    public static function create($data)
    {

        $userDto = new UserDto($data);
        $checkUser = $userDto->registerValid();

        if ($checkUser == 'success') {
            header("location: login.php");
        } else {
            self::$error = $userDto->errors;
        }
    }

    public static function login($data)
    {
        $userLogin = new UserDto($data);
        $loginValid = $userLogin->loginValid();
        if (is_null($loginValid)) {
            self::$error = $userLogin->errors;
        } else {
            header("location: index.php");

        }
    }


}