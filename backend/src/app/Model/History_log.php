<?php
/**
 * Created by PhpStorm.
 * User: zedd
 * Date: 2019-06-22
 * Time: 08:25
 */

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class History_log extends NotORM
{

    public function borrowBook($book_id, $user_id){
        $data = array('user_id' => $user_id, 'book_id' => $book_id);

        $orm = $this->getORM();
        $orm->insert($data);

        return $orm->insert_id();
    }

    public function getAllHisLog(){
        $sql = "SELECT history_log.id,history_log.book_id,book.name, book.author, book.ISBN, history_log.user_id ,user.username "
            . "FROM history_log "
            . "INNER JOIN user ON history_log.user_id=user.id "
            . "INNER JOIN book ON history_log.book_id=book.id";
        return $this->getORM()->queryAll($sql, array());
    }
}