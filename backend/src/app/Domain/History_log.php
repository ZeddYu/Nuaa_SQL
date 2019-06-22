<?php
/**
 * Created by PhpStorm.
 * User: zedd
 * Date: 2019-06-22
 * Time: 08:23
 */

namespace App\Domain;

use App\Model\History_log as LogModel;

class History_log {
    public function borrowBook(){
        $model = new LogModel();
        return $model->borrowBook();
    }

    public function getAllHisLog() {
        $model = new LogModel();
        return $model->getAllHisLog();
    }
}