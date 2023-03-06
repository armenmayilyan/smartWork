<?php

namespace phplogin\controller;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/model/User.php';

use phplogin\model\User as model;

class TestsDto
{
    public $detals;
    public $errors;

    public function __construct($data)
    {
        $this->detals = $data;
    }


    public function validTest()
    {

        $getCategoryes = model::getWhere(['table' => 'category'], ['name' => $this->detals['category']]);
        if ($getCategoryes == null) {
            $categoryData = [
                'name' => $this->detals['category']
            ];
            $createCategoryins = model::createdata('category', $categoryData);
            if ($createCategoryins) {
                $getQuestions = model::getWhere(['table' => 'questions'], ['content' => $this->detals['name']]);
                if ($getQuestions == null) {
                    $questionData = [
                        'content' => $this->detals['name'],
                        'category_id' => $createCategoryins['id'],
                        'point' => $this->detals['point']
                    ];
                    $question = model::createData('questions', $questionData);

                    $correctAnswer = $this->detals['correct_answer'][0];
                    foreach ($this->detals['fields'] as $key => $field) {
                        $answersData[] = [
                            'answer' => "$field",
                            'questions_id' => $question['id'],
                            'correct' => $key == $correctAnswer ? 1 : 0
                        ];
                    }
                    model::createMultiple('answers', $answersData);
                    $answersData = [];
                }
            }
        } elseif ($getCategoryes) {
            $getQuestions = model::getWhere(['table' => 'questions'], ['content' => $this->detals['name']]);
            if ($getQuestions == null) {
                $questionData = [
                    'content' => $this->detals['name'],
                    'category_id' => $getCategoryes['id'],
                    'point' => $this->detals['point']
                ];
                $question = model::createData('questions', $questionData);
                $correctAnswer = $this->detals['correct_answer'][0];
                foreach ($this->detals['fields'] as $key => $field) {
                    $answersData[] = [
                        'answer' => "$field",
                        'questions_id' => $question['id'],
                        'correct' => $key == $correctAnswer ? 1 : 0
                    ];
                }
                model::createMultiple('answers', $answersData);
                $answersData = [];
            } else {
                echo "this question already is exist";
            }
        }
    }

    public function getQuestionData()
    {
        $getquestions = User::selectMultiple('questions', $this->detals);
        foreach ($getquestions as $keys) {
            $data[] = [
                'point' => $keys['point']
            ];
        }
        return $data;

    }

}