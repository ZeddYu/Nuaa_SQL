<?php
/**
 * Created by PhpStorm.
 * User: zedd
 * Date: 2019-06-22
 * Time: 00:03
 */

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Book extends NotORM {

    public function getAll() {
        return $this->getORM()->select('*')->fetchAll();
    }

    public function getBookOrder(){
        //order by lent DESC
        return $this->getORM()->select('*')->order('lent DESC')->fetchAll();
    }

    public function getBookSum(){
        return $this->getORM()->sum('num');
    }

    public function getBookLentSum(){
        return $this->getORM()->sum('lent');
    }

    public function getAllBookPrice(){
        //select sum(num*price) from book;
        return $this->getORM()->sum('num * price');
    }

    public function checkNum($id){
        $sql = 'SELECT if(num-lent<=0,0,1) AS num FROM book WHERE id = :id';
        $params = array(':id' => $id);
        return $this->getORM()->queryAll($sql, $params);
    }

    public function borrowBook($book_id){
        return $this->getORM()->where('id', $book_id)->updateCounter('lent', 1);
    }

    public function returnBook($book_id){
        return $this->getORM()->where('id', $book_id)->updateCounter('lent', -1);
    }

    public function addBook($book_name, $book_author, $book_ISBN, $book_num, $book_unitPrice){
        $data = array('name' => $book_name, 'author' => $book_author, 'ISBN' => $book_ISBN, 'num' => $book_num, 'price' => $book_unitPrice, 'lent' => 0);
        $orm = $this->getORM();

        $orm->insert($data);

        return $orm->insert_id();
    }

    public function delBook($book_id){
        return $this->getORM()->where('id', $book_id)->delete();
    }

    public function updateBook($book_id, $book_name, $book_author, $book_ISBN, $book_num, $book_unitPrice){
        $data = array('name' => $book_name, 'author' => $book_author, 'ISBN' => $book_ISBN, 'num' => $book_num, 'price' => $book_unitPrice,);
        return $this->getORM()->where('id', $book_id)->update($data);
    }
}