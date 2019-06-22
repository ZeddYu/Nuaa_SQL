<?php
/**
 * Created by PhpStorm.
 * User: zedd
 * Date: 2019-06-22
 * Time: 00:04
 */

namespace App\Domain;

use App\Model\Book as BookModel;

class Book {
    public function getAll() {
        $model = new BookModel();
        return $model->getAll();
    }

    public function getBookOrder(){
        $model = new BookModel();
        return $model->getBookOrder();
    }

    public function getBookSum(){
        $model = new BookModel();
        return $model->getBookSum();
    }

    public function getBookLentSum(){
        $model = new BookModel();
        return $model->getBookLentSum();
    }

    public function getAllBookPrice(){
        $model = new BookModel();
        return $model->getAllBookPrice();
    }

    public function addBook($book_name, $book_author, $book_ISBN, $book_num, $book_unitPrice){
        $model = new BookModel();
        return $model->addBook($book_name, $book_author, $book_ISBN, $book_num, $book_unitPrice);
    }

    public function delBook($book_id){
        $model = new BookModel();
        return $model->delBook($book_id);
    }

    public function updateBook($book_id, $book_name, $book_author, $book_ISBN, $book_num, $book_unitPrice){
        $model = new BookModel();
        return $model->updateBook($book_id, $book_name, $book_author, $book_ISBN, $book_num, $book_unitPrice);
    }
}