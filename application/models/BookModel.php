<?php
/**
 * This class represents a database activities regarding a book in the book store.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

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
     * Gets books which are likely having title.
     * @param $title String Title of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksByTitle($title) {
        // get the result row from the 'book' table
        $this->db->like('title', $title);
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
        $this->db->where('isbnNo', $isbnNo);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() != 1) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets the main category title by the main category id.
     * @param $mainCategoryId integer id of the main category
     * @return bool|String Returns the result string if found or false if not found.
     */
    public function getMainCategoryTitleById($mainCategoryId) {
        // get the result row from the 'category' table
        $this->db->select('categoryTitle');
        $this->db->where('categoryId', $mainCategoryId);
        $result = $this->db->get('category');
        // check the number of rows in the result
        if ($result->num_rows() != 1) {
            return false;
        } else {
            return ($result->result())[0]->categoryTitle;
        }
    }

    /**
     * Gets the sub category title by the sub category id.
     * @param $subCategoryId integer id of the sub category
     * @return bool|String Returns the result string if found or false if not found.
     */
    public function getSubCategoryTitleById($subCategoryId) {
        // get the result row from the 'subcategory' table
        $this->db->select('subCategoryTitle');
        $this->db->where('subCategoryId', $subCategoryId);
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        if ($result->num_rows() != 1) {
            return false;
        } else {
            return ($result->result())[0]->subCategoryTitle;
        }
    }

    /**
     * Get books which are likely having author name.
     * @param $authorName String Name of the author of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBooksByAuthor($authorName) {
        // get the result row from the 'book' table
        $this->db->like('authorName', $authorName);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Get count of the books of likely having title.
     * @param $title String Title of the book
     * @return integer Returns the count of books.
     */
    public function getCountBooksByTitle($title) {
        // get the result row from the 'book' table
        $this->db->like('title', $title);
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books of likely having title with a limit.
     * @param $title String Title of the book
     * @param $pageNo Number Page number of the results
     * @param $itemsPerPage Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getLimitedBooksByTitle($title, $pageNo, $itemsPerPage) {
        $offset = ($pageNo - 1) * $itemsPerPage;
        $limit = $itemsPerPage;
        // get the result row from the 'book' table
        $this->db->like('title', $title);
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Get count of the books of likely having author name.
     * @param $authorName String Name of the author of the book
     * @return integer Returns the count of books.
     */
    public function getCountBooksByAuthor($authorName) {
        // get the result row from the 'book' table
        $this->db->like('authorName', $authorName);
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books of likely having author name with a limit.
     * @param $authorName String Name of the author of the book
     * @param $pageNo Number Page number of the results
     * @param $itemsPerPage Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getLimitedBooksByAuthor($authorName, $pageNo, $itemsPerPage) {
        $offset = ($pageNo - 1) * $itemsPerPage;
        $limit = $itemsPerPage;
        // get the result row from the 'book' table
        $this->db->like('authorName', $authorName);
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Get count of the books of likely having title and author name.
     * @param $title String Title of the book
     * @param $authorName String Name of the author
     * @return integer Returns the count of books.
     */
    public function getCountBooksByTitleAndAuthor($title, $authorName) {
        // get the result row from the 'book' table
        $this->db->like(array('title' => $title, 'authorName' => $authorName));
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books of likely having title and author name with a limit.
     * @param $title String Title of the book
     * @param $authorName String Name of the author of the book
     * @param $pageNo Number Page number of the results
     * @param $itemsPerPage Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getLimitedBooksByTitleAndAuthor($title, $authorName, $pageNo, $itemsPerPage) {
        $offset = ($pageNo - 1) * $itemsPerPage;
        $limit = $itemsPerPage;
        // get the result row from the 'book' table
        $this->db->like(array('title' => $title, 'authorName' => $authorName));
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Get count of the books of a search term likely having title or author name.
     * @param $searchTerm String text to be search in author name or title
     * @return integer Returns the count of books.
     */
    public function getCountBooksByTitleOrAuthor($searchTerm) {
        // get the result row from the 'book' table
        $this->db->like(array('title' => $searchTerm));
        $this->db->or_like('authorName', $searchTerm);
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books by a search terms of likely having title or author name with a limit.
     * @param $searchTerm String text to be search in author name or title
     * @param $pageNo Number Page number of the results
     * @param $itemsPerPage Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getLimitedBooksByTitleOrAuthor($searchTerm, $pageNo, $itemsPerPage)
    {
        $offset = ($pageNo - 1) * $itemsPerPage;
        $limit = $itemsPerPage;
        // get the result row from the 'book' table
        $this->db->like(array('title' => $searchTerm));
        $this->db->or_like('authorName', $searchTerm);
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Get the count of the books having the given main category and sub category.
     * @param $mainCategory String Main category title
     * @param $subCategory String Sub Category title
     * @return integer Returns the count of books.
     */
    public function getCountBooksByMainCategoryAndSubCategory($mainCategory, $subCategory) {
        // get the result row from the 'book' table
        $this->db->where(array('subCategoryTitle' => $subCategory, 'categoryTitle' => $mainCategory));
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books of likely having author name with a limit.
     * @param $mainCategory String Main category title
     * @param $subCategory String Sub Category title
     * @param $pageNo Number Page number of the results
     * @param $itemsPerPage Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getLimitedBooksByMainCategoryAndSubCategory($mainCategory, $subCategory, $pageNo, $itemsPerPage) {
        $offset = ($pageNo - 1) * $itemsPerPage;
        $limit = $itemsPerPage;
        // get the result row from the 'book' table
        $this->db->where(array('subCategoryTitle' => $subCategory, 'categoryTitle' => $mainCategory));
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }
//    /**
//     * Get publisher by publisher name.
//     * @param $publisherName String Name of the publisher
//     * @return bool|ArrayObject Returns the result array if found or false if not found.
//     */
//    public function getPublisherByName($publisherName) {
//        // get the result row from the 'book' table
//        $this->db->select('*');
//        $this->db->where('publisherName', $publisherName);
//        $result = $this->db->get('book');
//        // check the number of rows in the result
//        if ($result->num_rows() == 0) {
//            return false;
//        } else {
//            return $result->result();
//        }
//    }

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
    /**
     * Get books which are likely having similar title and author name.
     * @param $title String Title of the book
     * @param $authorName String Name of the author
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBookByTitleAndAuthor($title, $authorName) {
        // get the result row from the 'book' table
        $this->db->like(array('title' => $title, 'authorName' => $authorName));
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

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
     * Get count of the books.
     * @return integer Returns the count of books.
     */
    public function getCountBooks() {
        // get the result row from the 'book' table
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get all the books with a limit.
     * @param $pageNo Number Page number of the results
     * @param $itemsPerPage Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getLimitedBooks($pageNo, $itemsPerPage) {
        $offset = ($pageNo - 1) * $itemsPerPage;
        $limit = $itemsPerPage;
        // get the result row from the 'book' table
        $this->db->limit($limit, $offset);
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
     * Gets all the Main Categories in the database with their ids.
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getAllMainCategoriesWithMainCategoryId() {
        // get the result rows from the 'category' table
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
     * Gets all the Sub Categories with title and id under a Main Category in the database.
     * @param $mainCategory String Name of the Main Category
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getSubCategoriesOfAMainCategoryWithSubCategoryId($mainCategory) {
        // get the result row from the 'subCategory' table
        $this->db->select('subCategoryTitle, subCategoryId');
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
     * Gives top 6 books viewed by users who also viewed the given book.
     * @param $bookId String ISBN number of the viewed book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getTopSixBooks($bookId) {
        $this->db->select('userId');
        $this->db->where('isbnNo', $bookId);
        $this->db->from('user_viewed_book');
        $subQuery = $this->db->get_compiled_select();

        $this->db->distinct();
        $this->db->select('isbnNo');
        $this->db->select('count(isbnNo) as total');
        $this->db->where("userId IN ($subQuery)", NULL, FALSE);
        $this->db->group_by("isbnNo");
        $this->db->order_by('total', 'DESC');
        $this->db->limit(6);
        $result = $this->db->get('user_viewed_book');
        /*
         SELECT DISTINCT isbnNo, COUNT(isbnNo) as total
         FROM user_viewed_book
         WHERE userId IN (
            SELECT userId
            FROM user_viewed_book
            WHERE isbnNo = '6240934'
              )
              GROUP BY isbnNo
              ORDER BY total DESC
              LIMIT 6;
        */

        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Checks whether a Main Category title is available in the database.
     * @param $mainCategory String Name of the Main Category
     * @return bool Returns true if main category title is available, false if not.
     */
    public function isCategoryAvailable($mainCategory) {
        // get the result row from the 'category' table
        $this->db->select('categoryTitle');
        $this->db->where('categoryTitle', $mainCategory);;
        $result = $this->db->get('category');
        // check the number of rows in the result
        return $result->num_rows() == 0 ? false : true;
    }

    /**
     * Checks whether a Sub Category title is available in the database.
     * @param $subCategory String Name of the Sub Category
     * @return bool Returns true if sub category title is available, false if not.
     */
    public function isSubCategoryAvailable($subCategory) {
        // get the result row from the 'subcategory' table
        $this->db->select('subCategoryTitle');
        $this->db->where('subCategoryTitle', $subCategory);;
        $result = $this->db->get('subcategory');
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
        $this->db->select('subCategoryTitle');
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
        $this->db->select('authorName');
        $this->db->where('authorName', $authorName);;
        $result = $this->db->get('author');
        // check the number of rows in the result
        return $result->num_rows() == 0 ? false : true;
    }

    /**
     * Checks whether a Publisher is available in the database.
     * @param $publisherName String Name of the Publiksher
     * @return bool Returns true if publisher name is available, false if not.
     */
    public function isPublisherAvailable($publisherName) {
        // get the result row from the 'publisher' table
        $this->db->select('publisherName');
        $this->db->where('publisherName', $publisherName);;
        $result = $this->db->get('publisher');
        // check the number of rows in the result
        return $result->num_rows() == 0 ? false : true;
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

    /**
     * Adds a new visitor to the database.
     * @param $visitorId String Unique id of the visitor
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addVisitor($visitorId) {
        $this->db->insert('temp_user',  array('userId' => $visitorId));
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Adds a record for a visitor  book view.
     * @param $visitorId String Unique id of the visitor
     * @param $bookId String ISBN number of the viewed book
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addUserBookView($visitorId, $bookId) {
        $this->db->insert('user_viewed_book',  array('userId' => $visitorId, 'isbnNo' => $bookId));
        return ($this->db->affected_rows() != 1) ? false : true;
    }

}
?>