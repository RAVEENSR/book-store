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

//    /**
//     * Gets all the books named under a main category.
//     * @param $main_categoryTitle String Main category name
//     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
//     */
//    public function get_books_under_main_category($main_categoryTitle) {
//        // get the result row from the 'book' table
//        $this->db->select('*');
//        $this->db->where('categoryTitle', $main_categoryTitle);
//        $result = $this->db->get('book');
//        // check the number of rows in the result
//        if ($result->num_rows() == 0) {
//            return FALSE;
//        } else {
//            return $result->result();
//        }
//    }
//
//    /**
//     * Gets all the books named under a sub category.
//     * @param $subcategoryTitle String Sub category name
//     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
//     */
//    public function get_books_under_subcategory($subcategoryTitle) {
//        // get the result row from the 'book' table
//        $this->db->select('subCategoryTitle');
//        $this->db->where('subCategoryTitle', $subcategoryTitle);
//        $result = $this->db->get('book');
//        // check the number of rows in the result
//        if ($result->num_rows() == 0) {
//            return FALSE;
//        } else {
//            return $result->result();
//        }
//    }

    /**
     * Gets books which are likely having title.
     * @param $title String Title of the book
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_books_by_title($title)
    {
        // get the result row from the 'book' table
        $this->db->like('title', $title);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets a book by the isbn number.
     * @param $isbn_no String ISBN number of the book
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_book_by_isbn($isbn_no)
    {
        // get the result row from the 'book' table
        $this->db->where('isbnNo', $isbn_no);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() != 1) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets the main category title by the main category id.
     * @param $main_category_id integer id of the main category
     * @return bool|String Returns the result string if found or FALSE if not found.
     */
    public function get_main_category_title_by_id($main_category_id)
    {
        // get the result row from the 'category' table
        $this->db->select('categoryTitle');
        $this->db->where('categoryId', $main_category_id);
        $result = $this->db->get('category');
        // check the number of rows in the result
        if ($result->num_rows() != 1) {
            return FALSE;
        } else {
            return ($result->result())[0]->categoryTitle;
        }
    }

    /**
     * Gets the sub category title by the sub category id.
     * @param $subcategory_id integer id of the sub category
     * @return bool|String Returns the result string if found or FALSE if not found.
     */
    public function get_subcategory_title_by_id($subcategory_id)
    {
        // get the result row from the 'subcategory' table
        $this->db->select('subCategoryTitle');
        $this->db->where('subCategoryId', $subcategory_id);
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        if ($result->num_rows() != 1) {
            return FALSE;
        } else {
            return ($result->result())[0]->subCategoryTitle;
        }
    }

//    /**
//     * Get books which are likely having author name.
//     * @param $author_name String Name of the author of the book
//     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
//     */
//    public function get_books_by_author($author_name) {
//        // get the result row from the 'book' table
//        $this->db->like('authorName', $author_name);
//        $result = $this->db->get('book');
//        // check the number of rows in the result
//        if ($result->num_rows() == 0) {
//            return FALSE;
//        } else {
//            return $result->result();
//        }
//    }

    /**
     * Get count of the books of likely having title.
     * @param $title String Title of the book
     * @return integer Returns the count of books.
     */
    public function get_count_books_by_title($title)
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
     * @param $page_no Number Page number of the results
     * @param $items_per_page Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_limited_books_by_title($title, $page_no, $items_per_page)
    {
        $offset = ($page_no - 1) * $items_per_page;
        $limit = $items_per_page;
        // get the result row from the 'book' table
        $this->db->like('title', $title);
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Get count of the books of likely having author name.
     * @param $author_name String Name of the author of the book
     * @return integer Returns the count of books.
     */
    public function get_count_books_by_author($author_name)
    {
        // get the result row from the 'book' table
        $this->db->like('authorName', $author_name);
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books of likely having author name with a limit.
     * @param $author_name String Name of the author of the book
     * @param $page_no Number Page number of the results
     * @param $items_per_page Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_limited_books_by_author($author_name, $page_no, $items_per_page)
    {
        $offset = ($page_no - 1) * $items_per_page;
        $limit = $items_per_page;
        // get the result row from the 'book' table
        $this->db->like('authorName', $author_name);
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Get count of the books of likely having title and author name.
     * @param $title String Title of the book
     * @param $author_name String Name of the author
     * @return integer Returns the count of books.
     */
    public function get_count_books_by_title_and_author($title, $author_name)
    {
        // get the result row from the 'book' table
        $this->db->like(array('title' => $title, 'authorName' => $author_name));
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books of likely having title and author name with a limit.
     * @param $title String Title of the book
     * @param $author_name String Name of the author of the book
     * @param $page_no Number Page number of the results
     * @param $items_per_page Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_limited_books_by_title_and_author($title, $author_name, $page_no, $items_per_page)
    {
        $offset = ($page_no - 1) * $items_per_page;
        $limit = $items_per_page;
        // get the result row from the 'book' table
        $this->db->like(array('title' => $title, 'authorName' => $author_name));
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Get count of the books of a search term likely having title or author name.
     * @param $search_term String text to be search in author name or title
     * @return integer Returns the count of books.
     */
    public function get_count_books_by_title_or_author($search_term)
    {
        // get the result row from the 'book' table
        $this->db->like(array('title' => $search_term));
        $this->db->or_like('authorName', $search_term);
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books by a search terms of likely having title or author name with a limit.
     * @param $search_term String text to be search in author name or title
     * @param $page_no Number Page number of the results
     * @param $items_per_page Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_limited_books_by_title_or_author($search_term, $page_no, $items_per_page)
    {
        $offset = ($page_no - 1) * $items_per_page;
        $limit = $items_per_page;
        // get the result row from the 'book' table
        $this->db->like(array('title' => $search_term));
        $this->db->or_like('authorName', $search_term);
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Get the count of the books having the given main category and sub category.
     * @param $main_category String Main category title
     * @param $subcategory String Sub Category title
     * @return integer Returns the count of books.
     */
    public function get_count_books_by_main_category_and_subcategory($main_category, $subcategory)
    {
        // get the result row from the 'book' table
        $this->db->where(array('subCategoryTitle' => $subcategory, 'categoryTitle' => $main_category));
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get books of likely having author name with a limit.
     * @param $main_category String Main category title
     * @param $subcategory String Sub Category title
     * @param $page_no Number Page number of the results
     * @param $items_per_page Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_limited_books_by_main_category_and_subcategory($main_category, $subcategory, $page_no, $items_per_page)
    {
        $offset = ($page_no - 1) * $items_per_page;
        $limit = $items_per_page;
        // get the result row from the 'book' table
        $this->db->where(array('subCategoryTitle' => $subcategory, 'categoryTitle' => $main_category));
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

//    /**
//     * There can be authors with the same name. In order to separately identify each author an author code is used.
//     * This method returns all the author codes matches to a certain author name.
//     * @param $authorFirstName String First name of the author
//     * @param $authorLastName String Last name of the author
//     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
//     */
//    public function getAuthorCodes($authorFirstName, $authorLastName) {
//        // get the result row from the 'book' table
//        $this->db->where(array('firstName' => $authorFirstName, 'lastName' => $authorLastName));
//        $result = $this->db->get('author');
//        // check the number of rows in the result
//        if ($result->num_rows() == 0) {
//            return FALSE;
//        } else {
//            return $result->result();
//        }
//    }

//    /**
//     * Get books which are likely having similar title and author name.
//     * @param $title String Title of the book
//     * @param $author_name String Name of the author
//     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
//     */
//    public function get_book_by_title_and_author($title, $author_name) {
//        // get the result row from the 'book' table
//        $this->db->like(array('title' => $title, 'authorName' => $author_name));
//        $result = $this->db->get('book');
//        // check the number of rows in the result
//        if ($result->num_rows() == 0) {
//            return FALSE;
//        } else {
//            return $result->result();
//        }
//    }

//    /**
//     * Gets all the books in the database.
//     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
//     */
//    public function get_all_books() {
//        // get the result rows from the 'book' table
//        $this->db->select('*');
//        $result = $this->db->get('book');
//        // check the number of rows in the result
//        if ($result->num_rows() == 0) {
//            return FALSE;
//        } else {
//            return $result->result();
//        }
//    }

    /**
     * Get count of the books.
     * @return integer Returns the count of books.
     */
    public function get_count_books()
    {
        // get the result row from the 'book' table
        $this->db->from('book');
        $result = $this->db->count_all_results();
        return $result;
    }

    /**
     * Get all the books with a limit.
     * @param $page_no Number Page number of the results
     * @param $items_per_page Number Number of items displayed in a page
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_limited_books($page_no, $items_per_page)
    {
        $offset = ($page_no - 1) * $items_per_page;
        $limit = $items_per_page;
        // get the result row from the 'book' table
        $this->db->limit($limit, $offset);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the authors in the database.
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_all_authors()
    {
        // get the result rows from the 'book' table
        $this->db->select('authorName');
        $result = $this->db->get('author');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the publishers in the database.
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_all_publishers()
    {
        // get the result rows from the 'book' table
        $this->db->select('publisherName');
        $result = $this->db->get('publisher');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the Main Categories in the database.
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_all_main_categories()
    {
        // get the result rows from the 'category' table
        $this->db->select('categoryTitle');
        $result = $this->db->get('category');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the Main Categories in the database with their ids.
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_all_main_categories_with_main_category_id()
    {
        // get the result rows from the 'category' table
        $result = $this->db->get('category');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the Sub Categories under a Main Category in the database.
     * @param $main_category String Name of the Main Category
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_subcategories_of_main_category($main_category)
    {
        // get the result row from the 'subCategory' table
        $this->db->select('subCategoryTitle');
        $this->db->where('categoryTitle', $main_category);
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets all the Sub Categories with title and id under a Main Category in the database.
     * @param $main_category String Name of the Main Category
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_subcategories_of_main_category_with_subcategory_id($main_category)
    {
        // get the result row from the 'subCategory' table
        $this->db->select('subCategoryTitle, subCategoryId');
        $this->db->where('categoryTitle', $main_category);
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gives top 6 books viewed by users who also viewed the given book.
     * @param $book_id String ISBN number of the viewed book
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_top_six_books($book_id)
    {
        $this->db->select('userId');
        $this->db->where('isbnNo', $book_id);
        $this->db->from('user_viewed_book');
        $sub_query1 = $this->db->get_compiled_select();

        $this->db->distinct();
        $this->db->select('isbnNo');
        $this->db->select('COUNT(isbnNo) as total');
        $this->db->from('user_viewed_book');
        $this->db->where("userId IN ($sub_query1)", NULL, FALSE);
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
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Returns number of views of a book per day for a given date limit.
     * @param $isbn String isbn number of the book
     * @param $number_of_dates Number number of dates to limit
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_last_days_views_of_book($isbn, $number_of_dates)
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
        $this->db->limit($number_of_dates);
        $result = $this->db->get('user_viewed_book');

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }


    /**
     * Returns most viewed book titles for a given book limit.
     * @param $number_of_books Number required top most book titles
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_most_viewed_books($number_of_books)
    {
        $this->db->distinct();
        $this->db->select('isbnNo');
        $this->db->select('count(userId) AS total');
        $this->db->from('user_viewed_book');
        $this->db->group_by("isbnNo");
        $this->db->order_by('total', 'DESC');
        $sub_query1 = $this->db->get_compiled_select();

        $this->db->select('title, total');
        $this->db->from('book AS bookTable');
        $this->db->join("($sub_query1) AS viewTable", 'bookTable.isbnNo = viewTable.isbnNo', 'INNER');
        $this->db->group_by("title");
        $this->db->order_by('viewTable.total', 'DESC');
        $this->db->limit($number_of_books);
        $result = $this->db->get();

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Returns most viewed category titles for a given book limit.
     * @param $number_of_categories Number required top most category titles
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_most_viewed_categories($number_of_categories)
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
        $sub_query1 = $this->db->get_compiled_select();

        $this->db->select('categoryTitle, total');
        $this->db->from('book AS bookTable');
        $this->db->join("($sub_query1) AS viewTable", 'bookTable.isbnNo = viewTable.isbnNo', 'INNER');
        $this->db->group_by("categoryTitle");
        $this->db->order_by('viewTable.total', 'DESC');
        $this->db->limit($number_of_categories);
        $result = $this->db->get();

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Returns most viewed sub category titles for a given date limit.
     * @param $number_of_subcategories Number required top most sub category titles
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_most_viewed_subcategories($number_of_subcategories)
    {
        $this->db->distinct();
        $this->db->select('isbnNo');
        $this->db->select('COUNT(userId) AS total');
        $this->db->from('user_viewed_book');
        $this->db->group_by("isbnNo");
        $this->db->order_by('total', 'DESC');
        $sub_query1 = $this->db->get_compiled_select();

        $this->db->select('subCategoryTitle, total');
        $this->db->from('book AS bookTable');
        $this->db->join("($sub_query1) AS viewTable", 'bookTable.isbnNo = viewTable.isbnNo', 'INNER');
        $this->db->group_by("subCategoryTitle");
        $this->db->order_by('viewTable.total', 'DESC');
        $this->db->limit($number_of_subcategories);
        $result = $this->db->get();

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Returns most viewed sub category titles for a given date limit.
     * @param $number_of_days Number how long in past the result should be given
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_total_number_of_book_views($number_of_days)
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
        $this->db->limit($number_of_days);
        $result = $this->db->get('user_viewed_book');

        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets the newest books  in the database.
     * @param $number_of_books Number number of result books needed
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_newest_books($number_of_books)
    {
        // get the result rows from the 'book' table
        $this->db->select('*');
        $this->db->order_by('isbnNo', 'DESC');
        $this->db->limit($number_of_books);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Gets the vary first books in the database.
     * @param $number_of_books Number number of result books needed
     * @return bool|ArrayObject Returns the result array if found or FALSE if not found.
     */
    public function get_editor_picked_books($number_of_books)
    {
        // get the result rows from the 'book' table
        $this->db->select('*');
        $this->db->order_by('isbnNo', 'ASC');
        $this->db->limit($number_of_books);
        $result = $this->db->get('book');
        // check the number of rows in the result
        if ($result->num_rows() === 0) {
            return FALSE;
        } else {
            return $result->result();
        }
    }

    /**
     * Checks whether a Main Category title is available in the database.
     * @param $main_category String Name of the Main Category
     * @return bool Returns TRUE if main category title is available, FALSE if not.
     */
    public function is_category_available($main_category)
    {
        // get the result row from the 'category' table
        $this->db->select('categoryTitle');
        $this->db->where('categoryTitle', $main_category);;
        $result = $this->db->get('category');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? FALSE : TRUE;
    }

    /**
     * Checks whether a Sub Category title is available in the database.
     * @param $subcategory String Name of the Sub Category
     * @return bool Returns TRUE if sub category title is available, FALSE if not.
     */
    public function is_subcategory_available($subcategory)
    {
        // get the result row from the 'subcategory' table
        $this->db->select('subCategoryTitle');
        $this->db->where('subCategoryTitle', $subcategory);;
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? FALSE : TRUE;
    }

    /**
     * Checks whether a given Sub Category is available under the given Main Category in the database.
     * @param $subcategory String Name of the Sub Category
     * @param $main_category String Name of the Main Category
     * @return bool Returns TRUE if sub category title is available, FALSE if not.
     */
    public function is_subcategory_available_in_main_category($subcategory, $main_category)
    {
        // get the result row from the 'category' table
        $this->db->select('subCategoryTitle');
        $this->db->where(array('subCategoryTitle' => $subcategory, 'categoryTitle' => $main_category));
        $result = $this->db->get('subcategory');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? FALSE : TRUE;
    }

    /**
     * Checks whether an Author is available in the database.
     * @param $author_name String Name of the Author
     * @return bool Returns TRUE if author name is available, FALSE if not.
     */
    public function is_author_available($author_name)
    {
        // get the result row from the 'author' table
        $this->db->select('authorName');
        $this->db->where('authorName', $author_name);;
        $result = $this->db->get('author');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? FALSE : TRUE;
    }

    /**
     * Checks whether a Publisher is available in the database.
     * @param $publisher_name String Name of the Publiksher
     * @return bool Returns TRUE if publisher name is available, FALSE if not.
     */
    public function is_publisher_available($publisher_name)
    {
        // get the result row from the 'publisher' table
        $this->db->select('publisherName');
        $this->db->where('publisherName', $publisher_name);;
        $result = $this->db->get('publisher');
        // check the number of rows in the result
        return $result->num_rows() === 0 ? FALSE : TRUE;
    }

    /**
     * Adds a new book to the database.
     * @param $book_config_array ArrayObject Details of the book as an associative array
     * @return bool Returns TRUE if result is successful or FALSE if not found.
     */
    public function add_book($book_config_array)
    {
        $this->db->insert('book', $book_config_array);
        return ($this->db->affected_rows() !== 1) ? FALSE : TRUE;
    }

    /**
     * Adds a new author to the database.
     * @param $author_config_array ArrayObject Details of the author as an associative array
     * @return bool Returns TRUE if result is successful or FALSE if not found.
     */
    public function add_author($author_config_array)
    {
        $this->db->insert('author', $author_config_array);
        return ($this->db->affected_rows() !== 1) ? FALSE : TRUE;
    }

    /**
     * Adds a new publisher to the database.
     * @param $publisher_config_array ArrayObject Details of the publisher as an associative array
     * @return bool Returns TRUE if result is successful or FALSE if not found.
     */
    public function add_publisher($publisher_config_array)
    {
        $this->db->insert('publisher', $publisher_config_array);
        return ($this->db->affected_rows() !== 1) ? FALSE : TRUE;
    }

    /**
     * Adds new main category/s of books to the database.
     * @param $category_array ArrayObject Array of new main category names
     * @return bool Returns TRUE if result is successful or FALSE if not found.
     */
    public function create_book_categories($category_array)
    {
        $this->db->insert_batch('category', $category_array);
        return ($this->db->affected_rows() !== 1) ? FALSE : TRUE;
    }

    /**
     * Adds a new sub category/s of books to the database.
     * @param $subcategory_array ArrayObject Array of new main category names
     * @return bool Returns TRUE if result is successful or FALSE if not found.
     */
    public function create_book_subcategories($subcategory_array)
    {
        $this->db->insert_batch('subCategory', $subcategory_array);
        return ($this->db->affected_rows() !== 1) ? FALSE : TRUE;
    }

    /**
     * Adds a new visitor to the database.
     * @param $visitor_id String Unique id of the visitor
     * @return bool Returns TRUE if result is successful or FALSE if not found.
     */
    public function add_visitor($visitor_id)
    {
        $this->db->insert('temp_user', array('userId' => $visitor_id));
        return ($this->db->affected_rows() !== 1) ? FALSE : TRUE;
    }

    /**
     * Adds a record for a visitor  book view.
     * @param $visitor_id String Unique id of the visitor
     * @param $book_id String ISBN number of the viewed book
     * @return bool Returns TRUE if result is successful or FALSE if not found.
     */
    public function add_user_book_view($visitor_id, $book_id)
    {
        $this->db->insert('user_viewed_book', array('userId' => $visitor_id, 'isbnNo' => $book_id));
        return ($this->db->affected_rows() !== 1) ? FALSE : TRUE;
    }
}

?>