<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26
 * Time: 22:55
 */
// 这里只取几个主要信息
class Book {
    private $book_title;
    private $book_isbn;
    private $author;
    private $book_cover;
    private $book_info;
   private $book_publisher;
    private $book_price;
    private $book_pubdate;
    public function __construct($book_title, $book_isbn, $author, $book_cover, $book_info,$book_publisher,$book_price,$book_pubdate) {
        $this->author = $author;
        $this->book_isbn = $book_isbn;
        $this->book_cover = $book_cover;
        $this->book_title = $book_title;
        $this->book_info = $book_info;
        $this->book_publisher=$book_publisher;
        $this->book_price=$book_price;
        $this->book_pubdate=$book_pubdate;
    }
    public function getTitle() {
        return $this->book_title;
    }
    public function getISBN() {
        return $this->book_isbn;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getCover() {
        return $this->book_cover;
    }
    public function getBookInfo() {
        return $this->book_info;
    }
    public function get_Publisher() {
        return $this->book_publisher;
    }
    public function get_Price() {
        return $this->book_price;
    }
    public function get_Pubdate() {
        return $this->book_pubdate;
    }
}