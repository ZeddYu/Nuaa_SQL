<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class User extends NotORM {

    public function getUserInfo($id) {
        return $this->getORM()->where('id', 1)->fetchOne();
    }

    public function loginCheck($username, $password){
        return $this->getORM()->where('username = ?', $username)->where('password = ?', $password)->fetchAll();
    }

    public function setToken($id, $token){
        $data = array('token' => $token);
        // UPDATE user SET token = $token WHERE (id = $id);
        return $this->getORM()->where('id', $id)->update($data);
    }

    public function register($username, $password){
        $data = array('username' => $username, 'password' => $password);

        // INSERT INTO user (username, password) VALUES ($username, $password)

        $orm = $this->getORM();

        $res = $orm->where('username = ?', $username)->fetchAll();

        if ($res)
            return false;
        else{
            $orm->insert($data);
            // 返回新增的ID（注意，这里不能使用连贯操作，因为要保持同一个ORM实例）
            return $orm->insert_id();
        }
    }

    public function logout($id){
        $data = array('token' => '');
        return $this->getORM()->where('id', $id)->update($data);
    }

    public function getUserSum() {
        return $this->getORM()->where('id > 1')->count('id');
    }

    public function getAllUser(){
        return $this->getORM()->select('id, username')->where('id > 1');
    }

    public function deleteUser($user_id){
        return $this->getORM()->where('id', $user_id)->delete();
    }
}