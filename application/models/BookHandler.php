<?php
/**
 * This class represents a database activities regarding a book in the book store.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . 'models/Book.php');

class BookHandler extends CI_Model {

    /**
     * BookHandler constructor.
     */
    public function __construct() {
        // CI_Model constructor call
        parent::__construct();
        // load database object
        $this->load->database();
    }

    /**
     * Gets all the books named under a main category.
     * @param $mainCategoryTitle String Main category name
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksUnderAMainCategory($mainCategoryTitle) {
        // get the result row from the 'book' table
        $this->db->where('categoryTitle', $mainCategoryTitle);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Gets all the books named under a sub category.
     * @param $subCategoryTitle String Sub category name
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksUnderASubCategory($subCategoryTitle) {
        // get the result row from the 'book' table
        $this->db->where('subCategoryTitle', $subCategoryTitle);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Gets all the books by title. (There can be multiple books by same title)
     * @param $title String Title of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksByTitle($title) {
        // get the result row from the 'book' table
        $this->db->where('title', $title);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Gets a book by the isbn number.
     * @param $isbnNo String ISBN number of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBookByISBN($isbnNo) {
        // get the result row from the 'book' table
        $this->db->where('isbnNo', $isbnNo);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Get books by author name.
     * @param $authorName String Name of the author of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksByAuthor($authorName) {
        // get the result row from the 'book' table
        $this->db->where('authorName', $authorName);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * There can be authors with the same name. In order to separately identify each author an author code is used.
     * This method returns all the author codes matches to a certain author name.
     * @param $authorFirstName String First name of the author
     * @param $authorLastName String Last name of the author
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getAuthorCodes($authorFirstName, $authorLastName) {
        // get the result row from the 'book' table
        $this->db->where(array('firstName' => $authorFirstName, 'lastName' => $authorLastName));
        $result = $this->db->get('author');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Gets a book by title and author code.
     * @param $title String Title of the book
     * @param $authorCode String Dedicated code for the author
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBookByTitleAndAuthorCode($title, $authorCode) {
        // get the result row from the 'book' table
        $this->db->where(array('title' => $title, 'authorCode' => $authorCode));
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Gets all the books in the database.
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getAllBooks() {
        // get the result row from the 'book' table
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result;
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
     * @param $bookConfigArray ArrayObject Details of the book as an associative array
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addBook($bookConfigArray) {
        //TODO: check whether the book exists in the place where this method called
        $this->db->insert('book', $bookConfigArray);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Adds a new main category of books to the database.
     * @param $category String Name of the new category
     * @return bool Returns true if result is successful or false if not found.
     */
    public function createBookCategory($category) {
        //TODO: check whether the category exists in the place where this method called
        $data = array('categoryTitle' => $category);
        $this->db->insert('category', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Adds a new sub category of books to the database.
     * @param $subCategory String Name of the new sub category
     * @param $category String Name of the category which sub category belongs
     * @return bool Returns true if result is successful or false if not found.
     */
    public function createBookSubCategory($subCategory, $category) {
        //TODO: check whether the sub category and category exists in the place where this method called
        $data = array('subCategoryTitle' => $subCategory, 'categoryTitle' => $category);
        $this->db->insert('subCategory', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
?>