<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Book as Books;

/**
 * 用户模块接口服务
 */
class Book extends Api {
    public function getRules() {
        return array(
            'addBook' => array(
                'book_name' => array('name' => 'book_name', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_name'),
                'book_author' => array('name' => 'book_author', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_author'),
                'book_ISBN' => array('name' => 'book_ISBN', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_ISBN'),
                'book_num' => array('name' => 'book_num', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_num'),
                'book_unitPrice' => array('name' => 'book_unitPrice', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_unitPrice'),
            ),
            'delBook' => array(
                'book_id' => array('name' => 'book_id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_id'),
            ),
            'updateBook' => array(
                'book_id' => array('name' => 'book_id', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_id'),
                'book_name' => array('name' => 'book_name', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_name'),
                'book_author' => array('name' => 'book_author', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_author'),
                'book_ISBN' => array('name' => 'book_ISBN', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_ISBN'),
                'book_num' => array('name' => 'book_num', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_num'),
                'book_unitPrice' => array('name' => 'book_unitPrice', 'require' => true, 'min' => 1, 'max' => 10, 'desc' => 'book_unitPrice'),
            ),
        );
    }

    /**
     * 获取全部书籍的接口
     * @desc 获取全部书籍信息
     * @return array info 全部书籍的信息
     */
    public function getAll() {
        $model = new Books();
        $res = $model->getAll();
        return array('info' => $res);
    }

    /**
     * 按照借出升序获取全部书籍的接口
     * @desc 按照借出升序获取全部书籍
     * @return array info 全部书籍的信息
     */
    public function getBookOrder() {
        $model = new Books();
        $res = $model->getBookOrder();
        return array('info' => $res);
    }

    /**
     * 获取全部书籍总数的接口
     * @desc 获取全部书籍总数
     * @return int num 全部书籍总数
     */
    public function getBookSum() {
        $model = new Books();
        $res = $model->getBookSum();
        return array('sum' => $res);
    }

    /**
     * 获取外借书籍总数的接口
     * @desc 获取外借书籍总数
     * @return int num 外借书籍总数
     */
    public function getBookLentSum() {
        $model = new Books();
        $res = $model->getBookLentSum();
        return array('sum' => $res);
    }

    /**
     * 获取全部书籍的总价格的接口
     * @desc 获取全部书籍的总价格
     * @return int num 全部书籍的总价格
     */
    public function getAllBookPrice() {
        $model = new Books();
        $res = $model->getAllBookPrice();
        return array('sum' => $res);
    }

    /**
     * 增加书籍的接口
     * @desc 增加书籍
     * @return array status 状态, info 描述
     */
    public function addBook(){
        $model = new Books();
        $book_name = $this->book_name;
        $book_author = $this->book_author;
        $book_ISBN = $this->book_ISBN;
        $book_num = $this->book_num;
        $book_unitPrice = $this->book_unitPrice;
        $res = $model->addBook($book_name, $book_author, $book_ISBN, $book_num, $book_unitPrice);
        if (!$res){
            return array('status' => false, 'info' => '增加失败');
        }
        else
            return array('status' => true, 'info' => '增加成功');
    }

    /**
     * 删除书籍的接口
     * @desc 删除书籍
     * @return array status 状态, info 描述
     */
    public function delBook(){
        $model = new Books();
        $book_id = $this->book_id;
        $res = $model->delBook($book_id);
        if (!$res){
            return array('status' => false, 'info' => '删除失败');
        }
        else
            return array('status' => true, 'info' => '删除成功');
    }

    /**
     * 更新书籍的接口
     * @desc 更新书籍
     * @return array status 状态, info 描述
     */
    public function updateBook(){
        $model = new Books();
        $book_id = $this->book_id;
        $book_name = $this->book_name;
        $book_author = $this->book_author;
        $book_ISBN = $this->book_ISBN;
        $book_num = $this->book_num;
        $book_unitPrice = $this->book_unitPrice;
        $res = $model->updateBook($book_id, $book_name, $book_author, $book_ISBN, $book_num, $book_unitPrice);
        if (!$res){
            return array('status' => false, 'info' => '更新失败');
        }
        else
            return array('status' => true, 'info' => '更新成功');
    }
}
