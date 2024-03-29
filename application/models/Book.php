<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Book Class
 *
 * This class represents a database activities regarding a book in the book store.
 *
 * @author Raveen Savinda Rathnayake
 */
class Book extends CI_Model
{

    /**
     * BookHandler constructor.
     */
    public function __construct()
    {
        // CI_Model constructor call
        parent::__construct();
        // load database object
        $this->load->database();
    }

    /**
     * Gets a book by the isbn number.
     * @param $isbnNo String ISBN number of the book
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getBookByIsbn($isbnNo)
    {
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
    public function getMainCategoryTitleById($mainCategoryId)
    {
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
    public function getSubCategoryTitleById($subCategoryId)
    {
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
     * Get count of the books of likely having title.
     * @param $title String Title of the book
     * @return integer Returns the count of books.
     */
    public function getCountBooksByTitle($title)
    {
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
    public function getLimitedBooksByTitle($title, $pageNo, $itemsPerPage)
    {
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
    public function getCountBooksByAuthor($authorName)
    {
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
    public function getLimitedBooksByAuthor($authorName, $pageNo, $itemsPerPage)
    {
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
    public function getCountBooksByTitleAndAuthor($title, $authorName)
    {
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
    public function getLimitedBooksByTitleAndAuthor($title, $authorName, $pageNo, $itemsPerPage)
    {
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
    public function getCountBooksByTitleOrAuthor($searchTerm)
    {
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
     * @param $subcategory String Sub Category title
     * @return integer Returns the count of books.
     */
    public function getCountBooksByMainCategoryAndSubCategory($mainCategory, $subcategory)
    {
        // get the result row from the 'book' table
        $this->db->where(array('subCategoryTitle' => $subcategory, 'categoryTitle' => $mainCategory));
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books of likely having author name with a limit.
     * @param $mainCategory String Main category title
     * @param $subcategory String Sub Category title
     * @param $pageNo Number Page number of the results
     * @param $itemsPerPage Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getLimitedBooksByMainCategoryAndSubCategory($mainCategory, $subcategory, $pageNo, $itemsPerPage)
    {
        $offset = ($pageNo - 1) * $itemsPerPage;
        $limit = $itemsPerPage;
        // get the result row from the 'book' table
        $this->db->where(array('subCategoryTitle' => $subcategory, 'categoryTitle' => $mainCategory));
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
     * Get count of the books.
     * @return integer Returns the count of books.
     */
    public function getCountBooks()
    {
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
    public function getLimitedBooks($pageNo, $itemsPerPage)
    {
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
    public function getAllAuthors()
    {
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
    public function getAllPublishers()
    {
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
    public function getAllMainCategories()
    {
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
    public function getAllMainCategoriesWithMainCategoryId()
    {
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
    public function getSubCategoriesOfMainCategory($mainCategory)
    {
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
    public function getSubCategoriesOfMainCategoryWithSubCategoryId($mainCategory)
    {
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
    public function getTopSixBooks($bookId)
    {
        $this->db->select('userId');
        $this->db->where('isbnNo', $bookId);
        $this->db->from('user_viewed_book');
        $subQuery1 = $this->db->get_compiled_select();

        $this->db->distinct();
        $this->db->select('isbnNo');
        $this->db->select('COUNT(isbnNo) as total');
        $this->db->from('user_viewed_book');
        $this->db->where("userId IN ($subQuery1)", null, false);
        $this->db->group_by("isbnNo");
        $this->db->order_by('total', 'DESC');
        $this->db->limit(6);
        $subQuery2 = $this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->from('book AS bookTable');
        $this->db->join("($subQuery2) AS viewTable", 'bookTable.isbnNo = viewTable.isbnNo', 'INNER');
        $this->db->order_by('viewTable.total', 'DESC');
        $result = $this->db->get();

        /*
        SELECT
            *
        FROM
            book AS bookTable
        INNER JOIN(
            SELECT DISTINCT
                isbnNo,
                COUNT(isbnNo) AS total
            FROM
                user_viewed_book
            WHERE
                userId IN(
                SELECT
                    userId
                FROM
                    user_viewed_book
                WHERE
                    isbnNo = '6240934'
            )
        GROUP BY
            isbnNo
        ORDER BY
            total
        DESC
        LIMIT 6
        ) AS viewTable
        ON
            bookTable.isbnNo = viewTable.isbnNo
        ORDER BY
            viewTable.total
        DESC;
        */

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Returns number of views of a book per day for a given date limit.
     * @param $isbn String isbn number of the book
     * @param $numberOfDates Number number of dates to limit
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getLastDaysViewsOfBook($isbn, $numberOfDates)
    {
        // get the result row from the 'category' table
        /*
         * SELECT
                DATE(date) as visitedDate,
                COUNT(userId) AS numberOfViews
            FROM
                user_viewed_book
            WHERE
                isbnNo = '6240934'
            GROUP BY
                visitedDate
                ORDER  BY visitedDate DESC
                LIMIT 5;
         * */
        $this->db->select('DATE(date) AS visitedDate, COUNT(userId) AS numberOfViews');
        $this->db->where('isbnNo', $isbn);
        $this->db->group_by("visitedDate");
        $this->db->order_by('visitedDate', 'DESC');
        $this->db->limit($numberOfDates);
        $result = $this->db->get('user_viewed_book');

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return false;
        } else {
            return $result->result();
        }
    }


    /**
     * Returns most viewed book titles for a given book limit.
     * @param $numberOfBooks Number required top most book titles
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getMostViewedBooks($numberOfBooks)
    {
        $this->db->distinct();
        $this->db->select('isbnNo');
        $this->db->select('count(userId) AS total');
        $this->db->from('user_viewed_book');
        $this->db->group_by("isbnNo");
        $this->db->order_by('total', 'DESC');
        $subQuery1 = $this->db->get_compiled_select();

        $this->db->select('title, total');
        $this->db->from('book AS bookTable');
        $this->db->join("($subQuery1) AS viewTable", 'bookTable.isbnNo = viewTable.isbnNo', 'INNER');
        $this->db->group_by("title");
        $this->db->order_by('viewTable.total', 'DESC');
        $this->db->limit($numberOfBooks);
        $result = $this->db->get();

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Returns most viewed category titles for a given book limit.
     * @param $numberOfCategories Number required top most category titles
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getMostViewedCategories($numberOfCategories)
    {
        /*
        SELECT
            categoryTitle,
            total
        FROM
            book AS bookTable
        INNER JOIN(
            SELECT DISTINCT
                isbnNo,
                COUNT(userId) AS total
            FROM
                user_viewed_book
            GROUP BY
                isbnNo
            ORDER BY
                total DESC
        ) AS viewTable
        ON
            bookTable.isbnNo = viewTable.isbnNo
        GROUP BY
            categoryTitle
        ORDER BY
            total
        DESC
        LIMIT 10;
         * */
        $this->db->distinct();
        $this->db->select('isbnNo');
        $this->db->select('COUNT(userId) as total');
        $this->db->from('user_viewed_book');
        $this->db->group_by("isbnNo");
        $this->db->order_by('total', 'DESC');
        $subQuery1 = $this->db->get_compiled_select();

        $this->db->select('categoryTitle, total');
        $this->db->from('book AS bookTable');
        $this->db->join("($subQuery1) AS viewTable", 'bookTable.isbnNo = viewTable.isbnNo', 'INNER');
        $this->db->group_by("categoryTitle");
        $this->db->order_by('viewTable.total', 'DESC');
        $this->db->limit($numberOfCategories);
        $result = $this->db->get();

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Returns most viewed sub category titles for a given date limit.
     * @param $numberOfSubCategories Number required top most sub category titles
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getMostViewedSubCategories($numberOfSubCategories)
    {
        $this->db->distinct();
        $this->db->select('isbnNo');
        $this->db->select('COUNT(userId) AS total');
        $this->db->from('user_viewed_book');
        $this->db->group_by("isbnNo");
        $this->db->order_by('total', 'DESC');
        $subQuery1 = $this->db->get_compiled_select();

        $this->db->select('subCategoryTitle, total');
        $this->db->from('book AS bookTable');
        $this->db->join("($subQuery1) AS viewTable", 'bookTable.isbnNo = viewTable.isbnNo', 'INNER');
        $this->db->group_by("subCategoryTitle");
        $this->db->order_by('viewTable.total', 'DESC');
        $this->db->limit($numberOfSubCategories);
        $result = $this->db->get();

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Returns most viewed sub category titles for a given date limit.
     * @param $numberOfDays Number how long in past the result should be given
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getTotalNumberOfBookViews($numberOfDays)
    {
        /*
        SELECT
            DATE(DATE) AS visitedDate,
            COUNT(userId) AS NumberOfViews
        FROM
            user_viewed_book
        GROUP BY
            visitedDate
        ORDER BY
            visitedDate
        LIMIT 30;
         */

        $this->db->select('DATE(DATE) AS visitedDate, COUNT(userId) AS NumberOfViews');
        $this->db->group_by("visitedDate");
        $this->db->order_by('visitedDate', 'ASC');
        $this->db->limit($numberOfDays);
        $result = $this->db->get('user_viewed_book');

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets the newest books  in the database.
     * @param $numberOfBooks Number number of result books needed
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getNewestBooks($numberOfBooks)
    {
        // get the result rows from the 'book' table
        $this->db->select('*');
        $this->db->order_by('isbnNo', 'DESC');
        $this->db->limit($numberOfBooks);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return false;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets the vary first books in the database.
     * @param $numberOfBooks Number number of result books needed
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function getEditorPickedBooks($numberOfBooks)
    {
        // get the result rows from the 'book' table
        $this->db->select('*');
        $this->db->order_by('isbnNo', 'ASC');
        $this->db->limit($numberOfBooks);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() === 0) {
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
    public function isCategoryAvailable($mainCategory)
    {
        // get the result row from the 'category' table
        $this->db->select('categoryTitle');
        $this->db->where('categoryTitle', $mainCategory);;
        $result = $this->db->get('category');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? false : true;
    }

    /**
     * Checks whether a Sub Category title is available in the database.
     * @param $subcategory String Name of the Sub Category
     * @return bool Returns true if sub category title is available, false if not.
     */
    public function isSubCategoryAvailable($subcategory)
    {
        // get the result row from the 'subcategory' table
        $this->db->select('subCategoryTitle');
        $this->db->where('subCategoryTitle', $subcategory);;
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? false : true;
    }

    /**
     * Checks whether a given Sub Category is available under the given Main Category in the database.
     * @param $subcategory String Name of the Sub Category
     * @param $mainCategory String Name of the Main Category
     * @return bool Returns true if sub category title is available, false if not.
     */
    public function isSubCategoryAvailableInMainCategory($subcategory, $mainCategory)
    {
        // get the result row from the 'category' table
        $this->db->select('subCategoryTitle');
        $this->db->where(array('subCategoryTitle' => $subcategory, 'categoryTitle' => $mainCategory));
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? false : true;
    }

    /**
     * Checks whether an Author is available in the database.
     * @param $authorName String Name of the Author
     * @return bool Returns true if author name is available, false if not.
     */
    public function isAuthorAvailable($authorName)
    {
        // get the result row from the 'author' table
        $this->db->select('authorName');
        $this->db->where('authorName', $authorName);;
        $result = $this->db->get('author');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? false : true;
    }

    /**
     * Checks whether a Publisher is available in the database.
     * @param $publisherName String Name of the Publiksher
     * @return bool Returns true if publisher name is available, false if not.
     */
    public function isPublisherAvailable($publisherName)
    {
        // get the result row from the 'publisher' table
        $this->db->select('publisherName');
        $this->db->where('publisherName', $publisherName);;
        $result = $this->db->get('publisher');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? false : true;
    }

    /**
     * Adds a new book to the database.
     * @param $bookConfigArray ArrayObject Details of the book as an associative array
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addBook($bookConfigArray)
    {
        $this->db->insert('book', $bookConfigArray);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    /**
     * Adds a new author to the database.
     * @param $authorConfigArray ArrayObject Details of the author as an associative array
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addAuthor($authorConfigArray)
    {
        $this->db->insert('author', $authorConfigArray);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    /**
     * Adds a new publisher to the database.
     * @param $publisherConfigArray ArrayObject Details of the publisher as an associative array
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addPublisher($publisherConfigArray)
    {
        $this->db->insert('publisher', $publisherConfigArray);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    /**
     * Adds new main category/s of books to the database.
     * @param $categoryArray ArrayObject Array of new main category names
     * @return bool Returns true if result is successful or false if not found.
     */
    public function createBookCategories($categoryArray)
    {
        $this->db->insert_batch('category', $categoryArray);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    /**
     * Adds a new sub category/s of books to the database.
     * @param $subCategoryArray ArrayObject Array of new main category names
     * @return bool Returns true if result is successful or false if not found.
     */
    public function createBookSubCategories($subCategoryArray)
    {
        $this->db->insert_batch('subCategory', $subCategoryArray);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    /**
     * Adds a new visitor to the database.
     * @param $visitorId String Unique id of the visitor
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addVisitor($visitorId)
    {
        $this->db->insert('temp_user', array('userId' => $visitorId));
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    /**
     * Adds a record for a visitor  book view.
     * @param $visitorId String Unique id of the visitor
     * @param $bookId String ISBN number of the viewed book
     * @return bool Returns true if result is successful or false if not found.
     */
    public function addUserBookView($visitorId, $bookId)
    {
        $this->db->insert('user_viewed_book', array('userId' => $visitorId, 'isbnNo' => $bookId));
        return ($this->db->affected_rows() !== 1) ? false : true;
    }
}

?>