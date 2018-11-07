<?php
/**
 * This class represents a database activities regarding a book in the book store.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . 'models/Book.php');

class BookModel extends CI_Model {

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
        $this->db->select('*');
        $this->db->where('categoryTitle', $mainCategoryTitle);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the books named under a sub category.
     * @param $subCategoryTitle String Sub category name
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksUnderASubCategory($subCategoryTitle) {
        // get the result row from the 'book' table
        $this->db->select('subCategoryTitle');
        $this->db->where('subCategoryTitle', $subCategoryTitle);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the books by title. (There can be multiple books by same title)
     * @param $title String Title of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksByTitle($title) {
        // get the result row from the 'book' table
        $this->db->select('*');
        $this->db->where('title', $title);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets a book by the isbn number.
     * @param $isbnNo String ISBN number of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBookByISBN($isbnNo) {
        // get the result row from the 'book' table
        $this->db->select('*');
        $this->db->where('isbnNo', $isbnNo);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Get books by author name.
     * @param $authorName String Name of the author of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksByAuthor($authorName) {
        // get the result row from the 'book' table
        $this->db->select('*');
        $this->db->where('authorName', $authorName);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

//    /**
//     * There can be authors with the same name. In order to separately identify each author an author code is used.
//     * This method returns all the author codes matches to a certain author name.
//     * @param $authorFirstName String First name of the author
//     * @param $authorLastName String Last name of the author
//     * @return bool|ArrayObject Returns the result array if found or false if not found.
//     */
//    public function getAuthorCodes($authorFirstName, $authorLastName) {
//        // get the result row from the 'book' table
//        $this->db->where(array('firstName' => $authorFirstName, 'lastName' => $authorLastName));
//        $result = $this->db->get('author');
//        // check the number of rows in the result
//        if ($result->num_rows() == 0) {
//            return false;
//        } else {
//            return $result->result();
//        }
//    }
//
//    /**
//     * Gets a book by title and author code.
//     * @param $title String Title of the book
//     * @param $authorCode String Dedicated code for the author
//     * @return bool|ArrayObject Returns the result array if found or false if not found.
//     */
//    public function getBookByTitleAndAuthorCode($title, $authorCode) {
//        // get the result row from the 'book' table
//        $this->db->where(array('title' => $title, 'authorCode' => $authorCode));
//        $result = $this->db->get('book');
//        // check the number of rows in the result
//        if ($result->num_rows() == 0) {
//            return false;
//        } else {
//            return $result->result();
//        }
//    }

    /**
     * Gets all the books in the database.
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getAllBooks() {
        // get the result rows from the 'book' table
        $this->db->select('*');
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the authors in the database.
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getAllAuthors() {
        // get the result rows from the 'book' table
        $this->db->select('authorName');
        $result = $this->db->get('author');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the publishers in the database.
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getAllPublishers() {
        // get the result rows from the 'book' table
        $this->db->select('publisherName');
        $result = $this->db->get('publisher');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the Main Categories in the database.
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getAllMainCategories() {
        // get the result rows from the 'category' table
        $this->db->select('categoryTitle');
        $result = $this->db->get('category');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the Sub Categories under a Main Category in the database.
     * @param $mainCategory String Name of the Main Category
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getSubCategoriesOfAMainCategory($mainCategory) {
        // get the result row from the 'subCategory' table
        $this->db->select('subCategoryTitle');
        $this->db->where('categoryTitle', $mainCategory);
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Checks whether a Main Category is available in the database.
     * @param $mainCategory String Name of the Main Category
     * @return bool Returns true if main category title is available, false if not.
     */
    public function isCategoryAvailable($mainCategory) {
        // get the result row from the 'category' table
        $this->db->where('categoryTitle', $mainCategory);;
        $result = $this->db->get('category');
        // check the number of rows in the result
        return $result->num_rows() == 0 ? false : true;
    }

    /**
     * Checks whether a given Sub Category is available under the given Main Category in the database.
     * @param $subCategory String Name of the Sub Category
     * @param $mainCategory String Name of the Main Category
     * @return bool Returns true if sub category title is available, false if not.
     */
    public function isSubCategoryAvailableInMainCategory($subCategory, $mainCategory) {
        // get the result row from the 'category' table
        $this->db->where(array('subCategoryTitle' => $subCategory, 'categoryTitle' => $mainCategory));
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        return $result->num_rows() == 0 ? false : true;
    }

    /**
     * Checks whether an Author is available in the database.
     * @param $authorName String Name of the Author
     * @return bool Returns true if author name is available, false if not.
     */
    public function isAuthorAvailable($authorName) {
        // get the result row from the 'author' table
        $this->db->where('authorName', $authorName);;
        $result = $this->db->get('author');
        // check the number of rows in the result
        return $result->num_rows() == 0 ? false : true;
    }

//    /**
//     * Checks whether a Publisher is available in the database.
//     * @param $publisherName String Name of the Publiksher
//     * @return bool Returns true if publisher name is available, false if not.
//     */
//    public function isPublisherAvailable($publisherName) {
//        // get the result row from the 'publisher' table
//        $this->db->where('publisher', $publisherName);;
//        $result = $this->db->get('author');
//        // check the number of rows in the result
//        return $result->num_rows() == 0 ? false : true;
//    }

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
        $this->db->insert('book', $bookConfigArray);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Adds a new author to the database.
     * @param $authorConfigArray ArrayObject Details of the author as an associative array
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addAuthor($authorConfigArray) {
        $this->db->insert('author', $authorConfigArray);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Adds a new publisher to the database.
     * @param $publisherConfigArray ArrayObject Details of the publisher as an associative array
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addPublisher($publisherConfigArray) {
        $this->db->insert('publisher', $publisherConfigArray);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Adds new main category/s of books to the database.
     * @param $categoryArray ArrayObject Array of new main category names
     * @return bool Returns true if result is successful or false if not found.
     */
    public function createBookCategories($categoryArray) {
        $this->db->insert_batch('category', $categoryArray);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Adds a new sub category/s of books to the database.
     * @param $subCategoryArray ArrayObject Array of new main category names
     * @return bool Returns true if result is successful or false if not found.
     */
    public function createBookSubCategories($subCategoryArray) {
        $this->db->insert_batch('subCategory', $subCategoryArray);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
?>