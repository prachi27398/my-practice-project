<?php 

//library management system by using PHP function

//Book class to represent a book in the library
class Book{

    public  $title;
    public  $author;
    public  $isbn;
    public  $isAvailable;

    public function __construct($title,$author,$isbn,$isAvailable  = true){
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->isAvailable = $isAvailable;
    }

}

//Library class to manage the collection of Books
class Library
{
    private $books = [];

    // function to add a book to the library

    public function addBook(Book $book): void {
        $this->books[$book->isbn] = $book;
    }
}




?>