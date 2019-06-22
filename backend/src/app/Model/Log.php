<?php
/**
 * Created by PhpStorm.
 * User: zedd
 * Date: 2019-06-22
 * Time: 02:48
 */

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Log extends NotORM
{

    public function borrowBook($book_id, $user_id){
        $data = array('user_id' => $user_id, 'book_id' => $book_id);

        $orm = $this->getORM();
        $orm->insert($data);

        return $orm->insert_id();
    }

    public function getAll(){

        $sql = "SELECT log.id,book.name,user.username "
            . "FROM log "
            . "INNER JOIN user ON log.user_id=user.id "
            . "INNER JOIN book ON log.book_id=book.id";
        return $this->getORM()->queryAll($sql, array());
    }

    public function getById($user_id){
        $sql = "SELECT log.id,book.name,book.author,book.ISBN,user.username,log.book_id "
            . "FROM log "
            . "INNER JOIN user ON log.user_id=user.id "
            . "INNER JOIN book ON log.book_id=book.id "
            . "WHERE user.id=:user_id";
        $params = array(':user_id' => $user_id);
        return $this->getORM()->queryAll($sql, $params);
    }

    public function returnBook($book_id, $user_id, $log_id){
        return $this->getORM()->where('book_id', $book_id)->where('user_id', $user_id)->where('id', $log_id)->delete();
    }
}