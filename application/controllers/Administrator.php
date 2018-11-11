<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Administrator Class
 *
 * This class represent all the controller work related to an Administrator.
 *
 * @author Raveen Savinda Rathnayake
 */
class Administrator extends CI_Controller
{

    public function __construct()
    {
        // Parent constructor call
        parent::__construct();
        if (!$this->session->userdata('admin_username')) {
            // if the admin user is not logged in redirect them to the login page
            redirect(site_url() . '/login/load_admin_login');
        }
    }

    public function index()
    {
        if (!$this->session->userdata('admin_username')) {
            // if the admin user is not logged in redirect them to the login page
            redirect(site_url() . '/login/load_admin_login');
        } else {
            $this->load_admin_portal();
        }
    }

    /**
     * Controls getting all the categories from the database.
     * @return array|bool
     */
    public function get_all_categories()
    {
        $this->load->model('Book');
        $result = $this->Book->get_all_main_categories();
        // if results not found FALSE will be returned
        if (!$result) {
            return FALSE;
        }
        $categories = array();
        foreach ($result as $row) {
            // row is an object, attributes are columns in the table
            $categories[] = $row->categoryTitle;
        }
        return $categories;
    }

    /**
     * Controls getting all the sub categories from the database.
     * @return array|bool
     */
    public function get_all_subcategories_of_main_category()
    {
        $main_category = $_POST['mainCategory'];
        $this->load->model('Book');
        $result = $this->Book->get_subcategories_of_main_category($main_category);
        // if results not found FALSE will be returned
        if (!$result) {
            return FALSE;
        }
        $subcategories = array();
        foreach ($result as $row) {
            // row is an object, attributes are columns in the table
            $subcategories[] = $row->subCategoryTitle;
        }
        $data['result'] = $subcategories;
        echo json_encode($data);
    }

    /**
     * Controls validating the ISBN number of a book.
     * @return String
     */
    public function validate_book_isbn()
    {
        $isbn = $_POST['isbn'];
        $this->load->model('Book');
        $result = $this->Book->get_book_by_isbn($isbn);
        // flag determines the validity of the isbn number
        $flag = FALSE;
        if (!$result) {
            // if results not found that means isbn is not in the db. Hence flag will be TRUE.
            $flag = TRUE;
        }
        echo json_encode($flag);
    }

    /**
     * Controls validating the ISBN number of a book.
     * @return String
     */
    public function validate_publisher_name()
    {
        $publisher_name = $_POST['publisherName'];
        $this->load->model('Book');
        // flag determines the validity of the isbn number
        $flag = $this->Book->is_publisher_available($publisher_name);
        echo json_encode(!$flag);
    }

    /**
     * Controls validating the main category title.
     * @return String
     */
    public function validate_main_category()
    {
        $category_name = $_POST['categoryName'];
        $this->load->model('Book');
        // flag determines the validity of the isbn number
        $flag = $this->Book->is_category_available($category_name);
        echo json_encode(!$flag);
    }

    /**
     * Controls validating the sub category title.
     * @return String
     */
    public function validate_subcategory()
    {
        $subcategory_name = $_POST['subCategoryName'];
        $this->load->model('Book');
        // flag determines the validity of the isbn number
        $flag = $this->Book->is_subcategory_available($subcategory_name);
        echo json_encode(!$flag);
    }

    /**
     * Controls getting all the authors from the database.
     * @return array|bool
     */
    public function get_all_authors()
    {
        $this->load->model('Book');
        $result = $this->Book->get_all_authors();
        // if results not found FALSE will be returned
        if (!$result) {
            return FALSE;
        }
        $authors = array();
        foreach ($result as $row) {
            // row is an object, attributes are columns in the table
            $authors[] = $row->authorName;
        }
        return $authors;
    }

    /**
     * Controls getting all the publishers from the database.
     * @return array|bool
     */
    public function get_all_publishers()
    {
        $this->load->model('Book');
        $result = $this->Book->get_all_publishers();
        // if results not found FALSE will be returned
        if (!$result) {
            return FALSE;
        }
        $publishers = array();
        foreach ($result as $row) {
            // row is an object, attributes are columns in the table
            $publishers[] = $row->publisherName;
        }
        return $publishers;
    }

    /**
     * Controls getting data(book details) from view and adding the book to the database.
     * @return String
     */
    public function add_book()
    {
        $config['upload_path'] = './img/product';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("imgURL")) {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];

            $title = $this->input->post('title');
            $author = $this->input->post('author');
            $isbn = $this->input->post('isbn');
            $main_category = $this->input->post('mainCategorySelect');
            $subcategory = $this->input->post('subCategorySelect');
            $publisher = $this->input->post('publisher');
            $edition = $this->input->post('edition');
            $price = $this->input->post('price');
            $quantity = $this->input->post('quantity');
            $description = $this->input->post('description');
            $img = 'img/product/' . $image;

            $this->load->model('Book');
            // check whether the entered author name exists. If not add the author.
            if (!$this->Book->is_author_available($author)) {
                $this->Book->add_author(array('authorName' => $author));
            }

            // check whether the entered main category exists. If not add the main category.
            if (!$this->Book->is_category_available($main_category)) {
                $category_data = array();
                array_push($category_data, array('categoryTitle' => $main_category));
                $this->Book->create_book_categories($category_data);
            }

            // check whether the entered sub category exists. If not add the sub category.
            if (!$this->Book->is_subcategory_available_in_main_category($subcategory, $main_category)) {
                $subcategory_data = array();
                array_push($subcategory_data, array('subCategoryTitle' => $subcategory, 'categoryTitle' => 
                    $main_category));
                $this->Book->create_book_subcategories($subcategory_data);
            }

            $newEntry = array('isbnNo' => $isbn,
                'title' => $title,
                'categoryTitle' => $main_category,
                'subCategoryTitle' => $subcategory,
                'authorName' => $author,
                'publisherName' => $publisher,
                'price' => number_format((float)$price, 2, '.', ''),
                'availableCopies' => $quantity,
                'description' => $description,
                'edition' => $edition,
                'imageURL' => $img);
            $result = $this->Book->add_book($newEntry);
            // flag determines the validity
            $flag = FALSE;
            if ($result) {
                $flag = TRUE;
            }
            echo json_encode($flag);
        }
    }

    /**
     * Controls getting data(new publisher data) from view and adding the publisher to the database.
     * @return bool
     */
    public function add_publisher()
    {
        if (!isset($_POST['publisherData'])) {
            return FALSE;
        }
        $received_data = $_POST['publisherData'];
        $new_entry = array('publisherName' => $received_data['publisherName'],
            'contactNo' => $received_data['contactNo']);
        $this->load->model('Book');
        return $this->Book->add_publisher($new_entry);
    }

    /**
     * Returns number of views of a book per day for a given date limit.
     * @return String
     * 0: Error occurred when getting the number of views
     * 1: Request successful
     */
    public function get_views_for_book_for_last_days()
    {
        if (isset($_POST['isbn']) && isset($_POST['numberOfDays'])) {
            $isbn = $_POST['isbn'];
            $number_of_days = ceil($_POST['numberOfDays']);
            $this->load->model('Book');
            $results = $this->Book->get_last_days_views_of_book($isbn, $number_of_days);
            $dates = array();
            $views = array();
            if (!$results) {
                $data['status'] = '1';
                $data['dates'] = $dates;
                $data['views'] = $views;
                echo json_encode($data);
            } else {
                foreach ($results as $bookView) {
                    $dates[] = $bookView->visitedDate;
                    $views[] = $bookView->numberOfViews;
                }
                $data['status'] = '1';
                $data['dates'] = $dates;
                $data['views'] = $views;
                echo json_encode($data);
            }
        } else {
            $data['status'] = '0';
            echo json_encode($data);
        }
    }

    /**
     * Controls getting data(new category title/s) from view and adding the main category to the database.
     * @return bool
     */
    public function create_main_category()
    {

        if (!isset($_POST['categories'])) {
            return FALSE;
        }
        $data = array();
        $this->load->model('Book');
        foreach ($_POST['categories'] as $category) {
            // check whether the entered main category exists. If not add the main category.
            if (!$this->Book->is_category_available($category)) {
                $new_entry = array('categoryTitle' => $category);
                array_push($data, $new_entry);
            }
        }
        return $this->Book->create_book_categories($data);
    }

    /**
     * Controls getting data(sub category title/s) from view and adding the sub category to the database.
     * @return bool
     */
    public function create_subcategory()
    {
        if (!isset($_POST['mainCategory']) OR !isset($_POST['subCategories'])) {
            return FALSE;
        }
        $main_category = $_POST['mainCategory'];
        $data = array();
        $this->load->model('Book');
        foreach ($_POST['subCategories'] as $subcategory) {
            // check whether the entered sub category exists. If not add the sub category.
            if (!$this->Book->is_subcategory_available_in_main_category($subcategory, $main_category)) {
                $new_Entry = array('subCategoryTitle' => $subcategory, 'categoryTitle' => $main_category);
                array_push($data, $new_Entry);
            }
        }
        return $this->Book->create_book_subcategories($data);
    }

    /**
     * Controls getting data(book title) from view and returning the searched book to the view.
     * @return bool
     */
    public function search_book_by_title()
    {
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        } else if (isset($_GET['title'])) {
            $title = $_GET['title'];
        } else {
            return FALSE;
        }

        if (isset($_GET['pageNo'])) {
            $page_no = $_GET['pageNo'];
        } else {
            $page_no = 1;
        }
        $this->load->model('Book');
        $count = $this->Book->get_count_books_by_title($title);
        $items_per_page = 20;
        $last_page = ceil($count / $items_per_page);

        // ensuring page number is within the range(from 1 to lastPage)
        $page_no = (int)$page_no;
        if ($page_no > $last_page) {
            $page_no = $last_page;
        }

        if ($page_no < 1) {
            $page_no = 1;
        }

        $result = $this->Book->get_limited_books_by_title($title, $page_no, $items_per_page);
        if ($page_no != $last_page) {
            $next_page = $page_no + 1;
            $data['next'] = site_url() . "/administrator/search_book_by_title/?pageNo=$next_page&title=$title";
            $data['last'] = site_url() . "/administrator/search_book_by_title/?pageNo=$last_page&title=$title";
        }
        if ($page_no !== 1) {
            $previous_page = $page_no - 1;
            $data['previous'] = site_url() . "/administrator/search_book_by_title/?pageNo=$previous_page&title=$title";
            $data['first'] = site_url() . "/administrator/search_book_by_title/?pageNo=1&title=$title";
        }
        $data['result'] = $result;
        $data['title'] = $title;
        if (!$result) {
            $error_message = 'No Search Results found';
            $data['errorMessage'] = $error_message;
            $this->load->view('admin/search_results', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('admin/search_results', $data);
        }
    }

    /**
     * Controls getting data(author name) from view and returning the searched book to the view.
     * @return bool
     */
    public function search_books_by_author()
    {
        if (isset($_POST['author'])) {
            $author = $_POST['author'];
        } else if (isset($_GET['author'])) {
            $author = $_GET['author'];
        } else {
            return FALSE;
        }

        if (isset($_GET['pageNo'])) {
            $page_no = $_GET['pageNo'];
        } else {
            $page_no = 1;
        }
        $this->load->model('Book');
        $count = $this->Book->get_count_books_by_author($author);
        $items_per_page = 20;
        $last_page = ceil($count / $items_per_page);

        // ensuring page number is within the range(from 1 to lastPage)
        $page_no = (int)$page_no;
        if ($page_no > $last_page) {
            $page_no = $last_page;
        }

        if ($page_no < 1) {
            $page_no = 1;
        }

        $result = $this->Book->get_limited_books_by_author($author, $page_no, $items_per_page);
        if ($page_no != $last_page) {
            $next_page = $page_no + 1;
            $data['next'] = site_url() . "/administrator/searchBookByAuthor/?pageNo=$next_page&author=$author";
            $data['last'] = site_url() . "/administrator/searchBookByAuthor/?pageNo=$last_page&author=$author";
        }
        if ($page_no !== 1) {
            $previous_page = $page_no - 1;
            $data['previous'] = site_url() . "/administrator/searchBookByAuthor/?pageNo=$previous_page&author=$author";
            $data['first'] = site_url() . "/administrator/searchBookByAuthor/?pageNo=1&author=$author";
        }
        $data['result'] = $result;
        $data['author'] = $author;
        if (!$result) {
            $error_message = 'No Search Results found';
            $data['errorMessage'] = $error_message;
            $this->load->view('admin/search_results', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('admin/search_results', $data);
        }
    }

    /**
     * Controls getting data(book title and author name) from view and returning the searched book to the view.
     * @return bool
     */
    public function search_book_by_title_and_author()
    {

        if (isset($_POST['author'])) {
            $author = $_POST['author'];
        } else if (isset($_GET['author'])) {
            $author = $_GET['author'];
        } else {
            return FALSE;
        }

        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        } else if (isset($_GET['title'])) {
            $title = $_GET['title'];
        } else {
            return FALSE;
        }

        if (isset($_GET['pageNo'])) {
            $page_no = $_GET['pageNo'];
        } else {
            $page_no = 1;
        }
        $this->load->model('Book');
        $count = $this->Book->get_count_books_by_title_and_author($title, $author);
        $items_per_page = 20;
        $last_page = ceil($count / $items_per_page);

        // ensuring page number is within the range(from 1 to lastPage)
        $page_no = (int)$page_no;
        if ($page_no > $last_page) {
            $page_no = $last_page;
        }

        if ($page_no < 1) {
            $page_no = 1;
        }

        $result = $this->Book->get_limited_books_by_title_and_author($title, $author, $page_no, $items_per_page);
        if ($page_no != $last_page) {
            $next_page = $page_no + 1;
            $data['next'] = site_url() . "/administrator/search_book_by_title_and_author/?pageNo=$next_page&title=$title&author=$author";
            $data['last'] = site_url() . "/administrator/search_book_by_title_and_author/?pageNo=$last_page&title=$title&author=$author";
        }
        if ($page_no !== 1) {
            $previous_page = $page_no - 1;
            $data['previous'] = site_url() . "/administrator/search_book_by_title_and_author/?pageNo=$previous_page&title=$title&author=$author";
            $data['first'] = site_url() . "/administrator/search_book_by_title_and_author/?pageNo=1&title=$title&author=$author";
        }
        $data['result'] = $result;
        $data['author'] = $author;
        if (!$result) {
            $error_message = 'No Search Results found';
            $data['errorMessage'] = $error_message;
            $this->load->view('admin/search_results', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('admin/search_results', $data);
        }
    }

    /**
     * Controls displaying details of a book in the view.
     * @return bool
     */
    public function view_book_details()
    {
        if (isset($_GET['isbn'])) {
            $isbn = $_GET['isbn'];
        } else {
            return FALSE;
        }

        $this->load->model('Book');
        $result = $this->Book->get_book_by_isbn($isbn);
        if (!$result) {
            $error_message = 'Error occurred';
            $data['errorMessage'] = $error_message;
            $this->load->view('admin/book_details', $data);
        } else {
            $data['book'] = $result[0];
            $this->load->view('admin/book_details', $data);
        }
    }

    /**
     * Controls displaying statistics of books.
     * @return void
     */
    public function load_statistics()
    {
        $this->load->view('admin/book_statistics');
    }

    /**
     * Returns information required to disply statistics graphs in BookStatistics page.
     * @return String
     * 0: Error occurred when getting the number of views
     * 1: Request successful
     */
    public function get_stat_graph_info()
    {
        if (isset($_POST['numberOfDays'])) {
            $number_of_days = ceil($_POST['numberOfDays']);
            $this->load->model('Book');

            $result1 = $this->Book->get_most_viewed_books(5);
            $result2 = $this->Book->get_most_viewed_categories(5);
            $result3 = $this->Book->get_most_viewed_subcategories(5);
            $result4 = $this->Book->get_total_number_of_book_views($number_of_days);

            $top_books = array();
            $top_book_views = array();
            $top_categories = array();
            $top_category_views = array();
            $top_subcategories = array();
            $top_subcategory_views = array();
            $total_views = array();
            $dates = array();

            if ($result1) {
                foreach ($result1 as $top_book) {
                    $top_books[] = $top_book->title;
                    $top_book_views[] = $top_book->total;
                }
                $data['topBooks'] = $top_books;
                $data['topBookViews'] = $top_book_views;
            }
            if ($result2) {
                foreach ($result2 as $top_category) {
                    $top_categories[] = $top_category->categoryTitle;
                    $top_category_views[] = $top_category->total;
                }
                $data['topCategories'] = $top_categories;
                $data['topCategoryViews'] = $top_category_views;
            }
            if ($result3) {
                foreach ($result3 as $top_subcategory) {
                    $top_subcategories[] = $top_subcategory->subCategoryTitle;
                    $top_subcategory_views[] = $top_subcategory->total;
                }
                $data['topSubCategories'] = $top_subcategories;
                $data['topSubCategoryViews'] = $top_subcategory_views;
            }
            if ($result4) {
                foreach ($result4 as $view_per_day) {
                    $total_views[] = $view_per_day->NumberOfViews;
                    $dates[] = $view_per_day->visitedDate;
                }
                $data['totalViews'] = $total_views;
                $data['dates'] = $dates;
            }

            $data['status'] = '1';
            echo json_encode($data);
        } else {
            $data['status'] = '0';
            echo json_encode($data);
        }
    }

    /**
     * Loads the view for adding a book.
     * @return void
     */
    public function load_admin_portal()
    {
        $this->load->view('admin/home_view');
    }

    /**
     * Loads the view for adding a book.
     * @return void
     */
    public function load_add_book()
    {
        $this->load->helper('form');
        $main_categories = $this->get_all_categories();
        $authors = $this->get_all_authors();
        $publishers = $this->get_all_publishers();
        if ($main_categories) {
            $data['mainCategories'] = $main_categories;
        }
        if ($authors) {
            $data['authors'] = $authors;
        }
        if (!$publishers) {
            $this->load->view('admin/add_book');
        } else {
            $data['publishers'] = $publishers;
            $this->load->view('admin/add_book', $data);
        }
    }

    /**
     * Loads the view for adding a publisher.
     * @return void
     */
    public function load_add_publisher()
    {
        $this->load->view('admin/add_publisher');
    }

    /**
     * Loads the view for adding a Main Category.
     * @return void
     */
    public function load_add_main_category()
    {
        $this->load->view('admin/add_main_category');
    }

    /**
     * Loads the view for adding a Sub Category.
     * @return void
     */
    public function load_add_subcategory()
    {
        $result = $this->get_all_categories();
        if (!$result) {
            $this->load->view('admin/add_subcategory');
        } else {
            $data['mainCategories'] = $result;
            $this->load->view('admin/add_subcategory', $data);
        }
    }

    /**
     * Loads the view for searching a book.
     * @return void
     */
    public function load_search_book()
    {
        $this->load->view('admin/search');
    }
}

?>