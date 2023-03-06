<?php

namespace phplogin\controller;

use phplogin\model\User;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/controller/TestsDto.php';

class TestController
{
    public function create($data)
    {
        $testDto = new TestsDto($data);
        $valid = $testDto->validTest();
        return $valid;
    }

    public function store($table)
    {
        $get = User::getAll($table);
        return $get;
    }

//    public function getwhere($id)
//    {
//
//        $get = User::selectcategorypivote($id);
//        foreach ($get as $key) {
//            var_dump($key);
//        }
//        return $get;
//    }

    public function storeTests($table, $data)
    {
        $gettests = User::gettests($table, $data);
        return $gettests;
    }

    public function getanswers()
    {
        $getanswer = User::getall('answers');
        return $getanswer;
    }

    public function get($data)
    {
        $getCategory = User::getWhere(['table' => 'category'], ['id' => $data['category']]);
        return $getCategory;

    }

    public function checkAnswer($datas)
    {
        var_dump($datas);
        if (isset($datas['fields'])) {
            foreach ($datas['fields'] as $key => $val) {
                $question_id[] = [
                    'id' => $key
                ];
                $answer_id[] = [
                    'id' => $val
                ];
            }
            $data = User::selectMultiple('answers', $answer_id);
            $questions = User::selectMultiple('questions', $question_id);
            $savePoint = 0;
            foreach ($data as $item) {
                foreach ($questions as $key) {
                    if ($key['id'] == $item['questions_id'] && $item['correct'] == 1) {
                        $savePoint += $key['point'];
                    }
                }
            }
            foreach ($question_id as $id) {
                foreach ($answer_id as $answerId) {
                    $answerData[] = [
                        'question_id' => $id['id'],
                        'user_id' => $_SESSION['id'],
                        'answer_id' => $answerId['id']
                    ];
                }
            }
            $pivoteData[] = [
                'category_id' => $key['category_id'],
//                    'question_id' => $id['id'],
                'point' => $savePoint,
                'user_id' => $_SESSION['id']
            ];
            $create = User::createMultiPle('answer_user', $answerData);
            if ($create) {
                $pivote = User::createMultiPle('test_user', $pivoteData);
                if ($pivote) {
                    header('location: index.php');
                }
            }
        }
    }

    public function getpivote()
    {
        $datas = User::selectpivote($_SESSION['id']);
        return $datas;
    }
}

?>