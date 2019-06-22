<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Log as Logs;
use App\Domain\History_log as HisLog;

/**
 * 用户模块接口服务
 */
class Log extends Api {
    public function getRules() {
        return array(
            'getById' => array(
                'user_id' => array('name' => 'user_id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'user_id'),
            ),
        );
    }

    /**
     * 获取当前全部Log的接口
     * @desc 获取全部Log信息
     * @return array info 全部书籍的信息
     */
    public function getAll() {
        $model = new Logs();
        $res = $model->getAll();
        return array('info' => $res);
    }

    /**
     * 根据用户id查找他借的书
     * @desc 根据用户id查找他借的书
     * @return array info 全部书籍的信息
     */
    public function getById() {
        $user_id = $this->user_id;
        $model = new Logs();
        $res = $model->getById($user_id);
        return array('info' => $res);
    }

    /**
     * 获取全部History_Log的接口
     * @desc 获取全部History_Log
     * @return array info 全部History_Log的信息
     */
    public function getAllHisLog() {
        $model = new HisLog();
        $res = $model->getAllHisLog();
        return array('info' => $res);
    }
}
