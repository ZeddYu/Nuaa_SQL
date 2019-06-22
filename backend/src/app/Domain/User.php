<?php
namespace App\Domain;

use App\Model\User as UserModel;
use App\Model\Book as BookModel;
use App\Model\Log as LogModel;
use App\Model\History_log as HisLogModel;

class User {
    public function getUserInfo() {
        $userId = 1;
        $model = new UserModel();
        return $model->getUserInfo($userId);
    }

    public function loginCheck($username, $password){
        $model = new UserModel();
        $en_password = md5($password);
        return $model->loginCheck($username, $en_password);
    }

    public function setToken($id, $token){
        $model = new UserModel();
        return $model->setToken($id, $token);
    }

    public function register($username, $password){
        $model = new UserModel();
        $en_password = md5($password);
        return $model->register($username, $en_password);
    }

    public function logout($id){
        $model = new UserModel();
        return $model->logout($id);
    }

    public function getUserSum() {
        $model = new UserModel();
        return $model->getUserSum();
    }

    public function borrowBook($book_id, $user_id){

        $book_model = new BookModel();
        $log_model = new LogModel();
        $hislog_model = new HisLogModel();
        $res = $book_model->checkNum($book_id);
        if ($res[0]['num'] == 1){
            $log_model->borrowBook($book_id, $user_id);
            $hislog_model->borrowBook($book_id, $user_id);
            $book_model->borrowBook($book_id);
            return $res;
        }
        else
            return $res;

    }

    protected function checkNum($book_id){
        $book_model = new BookModel();
        return $book_model->checkNum($book_id);
    }

    public function returnBook($book_id, $user_id, $log_id){
        $book_model = new BookModel();
        $log_model = new LogModel();
        $res1 = $log_model->returnBook($book_id, $user_id, $log_id);
        $res2 = $book_model->returnBook($book_id);
        if ($res1 && $res2)
            return $res1;
        else
            return $res1;
    }

    public function getAllUser(){
        $model = new UserModel();
        return $model->getAllUser();
    }

    public function deleteUser($id) {
        $model = new UserModel();
        return $model->deleteUser($id);
    }
}