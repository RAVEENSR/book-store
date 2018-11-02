<?php
/**
 * This class represents a database activities regarding a book in the book store.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . 'models/Book.php');

class BookModel extends CI_Model {

    /**
     * BookModel constructor.
     */
    public function __construct() {
        // CI_Model constructor call
        parent::__construct();
        // load database object
        $this->load->database();
    }

    /**
     * Gets books by category.
     * @param $mainCategory String Main category name
     * @param $subCategory String Sub category name
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksByCategory($mainCategory, $subCategory) {
        if(true) {
            return $data[0]=array();
        } else {
            return false;
        }
    }

    /**
     * Gets a book by title.
     * @param $title String Title of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBookByTitle($title) {
        if(true) {
            return $data[0]=array();
        } else {
            return false;
        }
    }

    /**
     * Gets a book by the isbn number.
     * @param $isbnNo String ISBN number of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBookByISBN($isbnNo) {
        if(true) {
            return $data[0]=array();
        } else {
            return false;
        }
    }

    /**
     * Get books by author name.
     * @param $authorName String Name of the author of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksByAuthor($authorName) {
        if(true) {
            return $data[0]=array();
        } else {
            return false;
        }
    }

    /**
     * Gets a book by title and author name.
     * @param $title String Title of the book
     * @param $authorName String Name of the author
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBookByTitleAndAuthor($title, $authorName) {
        if(true) {
            return $data[0]=array();
        } else {
            return false;
        }
    }

    /**
     * Gets all the books in the database.
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getAllBooks() {
        if(true) {
            return $data[0]=array();
        } else {
            return false;
        }
    }

    /**
     * Gets a book by title and author name.
     * @param $configurationObject ArrayObject An array object which contains details of a book
     * @return Book|bool Returns a object or false if error occurs
     */
    public function createBookObject($configurationObject) {
        if(true) {
            $bookObject = new Book($configurationObject);
            return $bookObject;
        } else {
            return false;
        }
    }

    /**
     * Adds a new book to the database.
     * @param $bookObject Book Details of the book
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addBook($bookObject) {
        //TODO: check whether the book exists
        if(true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Adds a new main category of books to the database.
     * @param $category String Name of the new category
     * @return bool Returns true if result is successful or false if not found.
     */
    public function createBookCategory($category) {
        //TODO: check whether the category exists
        if(true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Adds a new sub category of books to the database.
     * @param $subCategory String Name of the new sub category
     * @return bool Returns true if result is successful or false if not found.
     */
    public function createBookSubCategory($subCategory) {
        //TODO: check whether the category exists
        if(true) {
            return true;
        } else {
            return false;
        }
    }
}
?>