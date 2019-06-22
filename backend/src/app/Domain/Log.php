<?php
/**
 * Created by PhpStorm.
 * User: zedd
 * Date: 2019-06-22
 * Time: 02:47
 */

namespace App\Domain;

use App\Model\Log as LogModel;

class Log {
    public function getAll(){
        $model = new LogModel();
        return $model->getAll();
    }

    public function getById($user_id){
        $model = new LogModel();
        return $model->getById($user_id);
    }
}