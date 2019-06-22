<?php
namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception\BadRequestException;
use App\Domain\User as Users;

/**
 * 用户模块接口服务
 */
class User extends Api {
    public function getRules() {
        return array(
            'login' => array(
                'username' => array('name' => 'username', 'require' => true, 'min' => 1, 'max' => 50, 'desc' => '用户名'),
                'password' => array('name' => 'password', 'require' => true, 'min' => 4, 'max' => 20, 'desc' => '密码'),
            ),
            'register' => array(
                'username' => array('name' => 'username', 'require' => true, 'min' => 1, 'max' => 50, 'desc' => '用户名'),
                'password' => array('name' => 'password', 'require' => true, 'min' => 4, 'max' => 20, 'desc' => '密码'),
            ),
            'logout' => array(
                'id' => array('name' => 'id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'user_id'),
            ),
            'borrowBook' => array(
                'book_id' => array('name' => 'book_id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_id'),
                'user_id' => array('name' => 'user_id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'user_id'),
            ),
            'returnBook' => array(
                'book_id' => array('name' => 'book_id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_id'),
                'user_id' => array('name' => 'user_id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'user_id'),
                'log_id' => array('name' => 'log_id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'log_id'),
            ),
            'deleteUser' => array(
                'user_id' => array('name' => 'user_id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'user_id'),
            ),
        );
    }

    /**
     * 登录接口
     * @desc 根据账号和密码进行登录操作
     * @return boolean is_login 是否登录成功
     * @return int user_id 用户ID
     * @return int role 用户角色
     */
    public function login() {
        $username = $this->username;   // 账号参数
        $password = $this->password;   // 密码参数
        $model = new Users();
        $res = $model->loginCheck($username, $password);
        if($res){
            $token = $this->getToken();
            \PhalApi\DI()->cookie->set('username', $res[0]['username'], $_SERVER['REQUEST_TIME'] + 600);
            \PhalApi\DI()->cookie->set('id', $res[0]['id'], $_SERVER['REQUEST_TIME'] + 600);
            \PhalApi\DI()->cookie->set('role', $res[0]['role'], $_SERVER['REQUEST_TIME'] + 600);
            \PhalApi\DI()->cookie->set('token', $token, $_SERVER['REQUEST_TIME'] + 600);
            $model->setToken($res[0]['id'], $token);
            return array('is_login' => true, 'user_id' => $res[0]['id'], 'role' => $res[0]['role']);
        }
        else
//            throw new BadRequestException('username or password is wrong', 3);
            return array('is_login' => false, 'err_res' => "username or password is wrong");
    }

    /**
     * 注册接口
     * @desc 根据账号和密码进行注册操作
     * @return boolean register_status 是否注册成功
     */
    public function register() {
        $username = $this->username;   // 账号参数
        $password = $this->password;   // 密码参数
        $model = new Users();
        $res = $model->register($username, $password);
        if($res){
            return array('register_status' => true);
        }
        else
            return array('register_status' => false, 'err_res' => "Username has been taken");
    }

    /**
     * 获取token方法
     * @desc 根据账号和密码进行登录操作
     * @return string token 用户的token
     */
    protected function getToken(){
        $token = md5('LoginFunc' . date("Y-m-d") );
        return $token;
    }

    /**
     * 注销接口
     * @desc 根据用户id进行注销操作
     * @return boolean logout_status 是否注册成功
     */
    public function logout(){
        $id = $this->id;
        $model = new Users();
        $res = $model->logout($id);
        if ($res)
            return array('logout_status' => true);
        else
            return array('logout_status' => false);
    }

    /**
     * 获取目前用户总数的接口
     * @desc 获取目前用户总数
     * @return int sum 用户总数
     */
    public function getUserSum() {
        $model = new Users();
        $res = $model->getUserSum();
        return array('sum' => $res);
    }

    /**
     * 用户借书的接口
     * @desc 用户借书
     * @return array status 成功失败信息, info 相关信息
     */
    public function borrowBook() {
        $book_id = $this->book_id;
        $user_id = $this->user_id;
        $model = new Users();
        $res = $model->borrowBook($book_id, $user_id);
        if ($res[0]['num'] == 0){
            return array('status' => false, 'info' => '库存不足，借阅失败');
        }
        else
            return array('status' => true, 'info' => '借阅成功');
    }

    /**
     * 用户还书的接口
     * @desc 用户还书
     * @return array status 成功失败信息, info 相关信息
     */
    public function returnBook() {
        $book_id = $this->book_id;
        $user_id = $this->user_id;
        $log_id = $this->log_id;
        $model = new Users();
        $res = $model->returnBook($book_id, $user_id, $log_id);
        if (!$res){
            return array('status' => false, 'info' => '还书失败');
        }
        else
            return array('status' => true, 'info' => '还书成功');
    }

    /**
     * 返回所有用户信息的接口
     * @desc 返回所有用户信息
     * @return array info 相关信息
     */
    public function getAllUser() {
        $model = new Users();
        $res = $model->getAllUser();
        return array('info' => $res);
    }

    /**
     * 删除用户的接口
     * @desc 删除用户
     * @return array status 成功失败信息, info 相关信息
     */
    public function deleteUser() {
        $user_id = $this->user_id;
        $model = new Users();
        $res = $model->deleteUser($user_id);
        if (!$res){
            return array('status' => false, 'info' => '删除失败');
        }
        else
            return array('status' => true, 'info' => '删除成功');
    }
} 
