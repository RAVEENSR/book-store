<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Visitor Class
 *
 * This class represent all the controller work related to a Visitor.
 *
 * @author Raveen Savinda Rathnayake
 */
class Visitor extends CI_Controller
{

    public function __construct()
    {
        // Parent constructor call
        parent::__construct();
        $this->_manage_unique_user_id();
    }

    public function index()
    {
        $this->load->model('Book');
        $result1 = $this->Book->get_newest_books(5);
        $result2 = $this->Book->get_editor_picked_books(5);
        $data['newBooks'] = $result1;
        $data['editorBooks'] = $result2;
        $this->load->view('visitor/home_view', $data);
    }

    /**
     * Creates a unique user id for every new user if it is not created yet. Then will update the database with the id.
     * @return void
     */
    private function _manage_unique_user_id()
    {
        if (!$this->session->userdata('visitorId') && !$this->session->userdata('admin_username')) {
            $visitor_id = uniqid();
            $this->load->model('Book');
            $result = $this->Book->add_visitor($visitor_id);
            $session_data = array('visitorId' => $visitor_id);
            $this->session->set_userdata($session_data);
        }
    }

//    /**
//     * Controls getting all the categories from the database.
//     */
//    public function get_all_categories()
//    {
//        $this->load->model('Book');
//        $result = $this->Book->get_all_main_categories();
//        // if results not found FALSE will be returned
//        if (!$result) {
//            return FALSE;
//        }
//        $categories = array();
//        foreach ($result as $row) {
//            // row is an object, attributes are columns in the table
//            $categories[] = $row->categoryTitle;
//        }
//        return $categories;
//    }

//    /**
//     * Controls getting all the sub categories from the database.
//     */
//    public function get_all_subcategories_of_main_category()
//    {
//        $mainCategory = $_POST['mainCategory'];
//        $this->load->model('Book');
//        $result = $this->Book->get_subcategories_of_main_category($mainCategory);
//        // if results not found FALSE will be returned
//        if (!$result) {
//            return FALSE;
//        }
//        $subCategories = array();
//        foreach ($result as $row) {
//            // row is an object, attributes are columns in the table
//            $subCategories[] = $row->subCategoryTitle;
//        }
//        $data['result'] = $subCategories;
//        echo json_encode($data);
//        exit;
//    }

    /**
     * Controls adding an item to the cart.
     * Returns String 0, 1, 2, 3
     * 0: Quantity should be less than the available copies
     * 1: Book is already available in the cart
     * 2: Book Added to the Cart Successfully
     * 3: Error occurred when adding the book into the cart
     */
    public function add_to_cart()
    {
        if (isset($_POST['isbn']) && isset($_POST['quantity'])) {
            $isbn = $_POST['isbn'];
            $quantity = $_POST['quantity'];
            $quantity = ceil($quantity);

            $this->load->model('Book');
            $book_result = $this->Book->get_book_by_isbn($isbn);
            if (!$book_result) {
                echo '3';
                exit;
            }

            $book = $book_result[0];
            $available_copies = $book->availableCopies;
            if ($quantity > $available_copies) {
                echo '0';
                exit;
            }

            // get the cart from the session
            $user_cart = $this->session->userdata('bookCart');
            if ($user_cart != NULL) {
                $found_item = $this->_is_book_available_in_cart($user_cart, $isbn);
                if ($found_item) {
                    echo '1';
                    exit;
                }
                // add the book to the cart if book is not in the cart
                $book_item = array(
                    'isbn' => $book->isbnNo,
                    'imgURL' => $book->imageURL,
                    'title' => $book->title,
                    'qty' => $quantity,
                    'price' => $book->price,
                    'total' => ($book->price) * $quantity);
                $user_cart[] = $book_item;
                $this->session->set_userdata('bookCart', $user_cart);
                echo '2';
                exit;

            } else {
                // if the user do not has a cart create a cart and save the book item
                $user_cart = array();
                $book_item = array(
                    'isbn' => $book->isbnNo,
                    'imgURL' => $book->imageURL,
                    'title' => $book->title,
                    'qty' => $quantity,
                    'price' => $book->price,
                    'total' => ($book->price) * $quantity);
                $user_cart[] = $book_item;
                $this->session->set_userdata('bookCart', $user_cart);
                echo '2';
                exit;
            }
        } else {
            echo '3';
            exit;
        }
    }

    /**
     * Checks whether a book is already in the cart.
     * @param $cart ArrayObject cart of the visitor
     * @param $isbn String isbn number of the book
     * @return bool returns TRUE if the book is found in the cart or FALSE otherwise.
     */
    private function _is_book_available_in_cart($cart, $isbn)
    {
        foreach ($cart as $key => $book) {
            if ($book['isbn'] === $isbn) {
                return TRUE;
            }
        }
        // if the book is not in the cart
        return FALSE;
    }

    /**
     * Controls displaying a cart for a particular user.
     * @return void
     */
    public function view_cart()
    {
        // get the cart from the session
        $user_cart = $this->session->userdata('bookCart');
        if ($user_cart != NULL && sizeof($user_cart) !== 0) {
            $total_price = 0;
            foreach ($user_cart as $book) {
                $total_price += $book['total'];
            }
            $data['totalPrice'] = $total_price;
            $data['userCart'] = $user_cart;
            $this->load->view('visitor/cart', $data);
        } else {
            $error_message = 'You have no items in the cart';
            $data['errorMessage'] = $error_message;
            $this->load->view('visitor/cart', $data);
        }
    }

    /**
     * Updates the quantity of item in the cart
     * Returns Object with status and price data
     * 0: Quantity should be less than the available copies
     * 1: Successfully update the quantity
     * 2: Error occurred when adding the book into the cart
     */
    public function update_cart()
    {
        $isbn = $this->input->post('isbn');
        $quantity = $this->input->post('quantity');
        // get the cart from the session
        $user_cart = $this->session->userdata('bookCart');
        if ($user_cart != NULL) {
            for ($x = 0; $x < sizeof($isbn); $x++) {
                $book_id = $isbn[$x];
                $new_quantity = $quantity[$x];
                $found_array_key_for_item = $this->_get_book_key_in_cart($user_cart, $book_id);
                $old_details = $user_cart[$found_array_key_for_item];
                $new_book_item = array(
                    'isbn' => $old_details['isbn'],
                    'imgURL' => $old_details['imgURL'],
                    'title' => $old_details['title'],
                    'qty' => $new_quantity,
                    'price' => $old_details['price'],
                    'total' => ($old_details['price']) * $new_quantity);
                $user_cart[$found_array_key_for_item] = $new_book_item;
            }
            $this->session->set_userdata('bookCart', $user_cart);
            $this->view_cart();
        } else {
            $data['status'] = '2';
            echo json_encode($data);
            exit;
        }
    }

    /**
     * Checks whether a book is already in the cart.
     * @param $cart ArrayObject cart of the visitor
     * @param $isbn String isbn number of the book
     * @return String|NULL returns the key of the row if the book is found in the cart or NULL otherwise.
     */
    private function _get_book_key_in_cart($cart, $isbn)
    {
        foreach ($cart as $key => $book) {
            if ($book["isbn"] === $isbn) {
                return $key;
            }
        }
        // if the book is not in the cart
        return NULL;
    }

    /**
     * Controls removing an item from the cart.
     * @return void
     */
    public function remove_cart_item()
    {
        $book_id = $_GET['bookId'];
        // get the cart from the session
        $user_cart = $this->session->userdata('bookCart');
        $found_array_key_for_item = $this->_get_book_key_in_cart($user_cart, $book_id);
        unset($user_cart[$found_array_key_for_item]);
        $this->session->set_userdata('bookCart', $user_cart);
        $this->view_cart();
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
            $this->load->view('visitor/book_details', $data);
        } else {
            $visitorId = $this->session->userdata('visitorId');
            $result2 = $this->Book->add_user_book_view($visitorId, $isbn);
            if (!$result2) {
                $error_message = 'Error occurred';
                $data['errorMessage'] = $error_message;
                $this->load->view('visitor/book_details', $data);
            } else {
                $data['book'] = $result[0];
                $data['similarBooks'] = $this->_get_similar_viewed_books($isbn);
                $this->load->view('visitor/book_details', $data);
            }
        }
    }

    /**
     * Returns top 5 of similar viewed books by users who viewed the given book as an array.
     * @param $isbn String isbn number of the currently viewing book
     * @return array top five book object s array
     */
    private function _get_similar_viewed_books($isbn)
    {
        $this->load->model('Book');
        $results = $this->Book->get_top_six_books($isbn);
        $books = array();
        foreach ($results as $book) {
            if ($book->isbnNo !== $isbn) {
                $books[] = $book;
            }
        }
        return $books;
    }

    /**
     * Controls returning all the books to the view.
     * @return void
     */
    public function view_all_books()
    {
        if (isset($_GET['pageNo'])) {
            $page_no = $_GET['pageNo'];
        } else {
            $page_no = 1;
        }

        $this->load->model('Book');
        // get all the categories and create an array
        $categories = array();
        $main_categories = $this->Book->get_all_main_categories_with_main_category_id();
        if ($main_categories) {
            for ($x = 0; $x < sizeof($main_categories); $x++) {
                $categories[$x][0] = $main_categories[$x];
                $main_category_title = $main_categories[$x]->categoryTitle;
                // get sub categories for the main category
                $sub_categories = $this->Book->get_subcategories_of_main_category_with_subcategory_id
                ($main_category_title);
                if ($sub_categories) {
                    $categories[$x][1] = $sub_categories;
                }
            }
        }
        $data['categories'] = $categories;

        // get all the books according to the page number
        $count = $this->Book->get_count_books();
        $items_per_page = 12;
        $last_page = ceil($count / $items_per_page);

        // ensuring page number is within the range(from 1 to lastPage)
        $page_no = (int)$page_no;
        if ($page_no > $last_page) {
            $page_no = $last_page;
        }
        if ($page_no < 1) {
            $page_no = 1;
        }

        $result = $this->Book->get_limited_books($page_no, $items_per_page);
        if ($page_no != $last_page) {
            $next_page = $page_no + 1;
            $data['next'] = site_url() . "/visitor/view_all_books/?pageNo=$next_page";
            $data['last'] = site_url() . "/visitor/view_all_books/?pageNo=$last_page";
        }
        if ($page_no != 1) {
            $previous_page = $page_no - 1;
            $data['previous'] = site_url() . "/visitor/view_all_books/?pageNo=$previous_page";
            $data['first'] = site_url() . "/visitor/view_all_books/?pageNo=1";
        }

        $data['result'] = $result;
        if (!$result) {
            $error_message = 'No Results found';
            $data['errorMessage'] = $error_message;
            $this->load->view('visitor/shop', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('visitor/shop', $data);
        }
    }

    /**
     * Controls returning all the books to the view.
     * @return void
     */
    public function view_books_by_category()
    {
        if (isset($_GET['pageNo'])) {
            $page_no = $_GET['pageNo'];
        } else {
            $page_no = 1;
        }

        if (isset($_GET['mainCatId']) && filter_var($_GET['mainCatId'], FILTER_VALIDATE_INT)) {
            $main_cat_id = $_GET['mainCatId'];
        } else {
            $error_message = 'Valid Main Category Id not received';
            $data['errorMessage'] = $error_message;
            $this->load->view('visitor/shop', $data);
            return;
        }
        if (isset($_GET['subCatId']) && filter_var($_GET['subCatId'], FILTER_VALIDATE_INT)) {
            $subCatId = $_GET['subCatId'];
        } else {
            $error_message = 'Valid Main Category Id not received';
            $data['errorMessage'] = $error_message;
            $this->load->view('visitor/shop', $data);
            return;
        }

        $this->load->model('Book');
        // get all the categories and create an array
        $categories = array();
        $main_categories = $this->Book->get_all_main_categories_with_main_category_id();
        if ($main_categories) {
            for ($x = 0; $x < sizeof($main_categories); $x++) {
                $categories[$x][0] = $main_categories[$x];
                $main_category_title = $main_categories[$x]->categoryTitle;
                // get sub categories for the main category
                $sub_categories = $this->Book->get_subcategories_of_main_category_with_subcategory_id($main_category_title);
                if ($sub_categories) {
                    $categories[$x][1] = $sub_categories;
                }
            }
        }
        $data['categories'] = $categories;

        // get all the books according to the page number
        $main_category = $this->Book->get_main_category_title_by_id($main_cat_id);
        if (!$main_category) {
            $error_message = 'Valid Main Category Id not received';
            $data['errorMessage'] = $error_message;
            $this->load->view('visitor/shop', $data);
            return;
        }
        $subcategory = $this->Book->get_subcategory_title_by_id($subCatId);
        if (!$subcategory) {
            $error_message = 'Valid Sub Category Id not received';
            $data['errorMessage'] = $error_message;
            $this->load->view('visitor/shop', $data);
            return;
        }
        $count = $this->Book->get_count_books_by_main_category_and_subcategory($main_category, $subcategory);
        $items_per_page = 12;
        $last_page = ceil($count / $items_per_page);

        // ensuring page number is within the range(from 1 to lastPage)
        $page_no = (int)$page_no;
        if ($page_no > $last_page) {
            $page_no = $last_page;
        }
        if ($page_no < 1) {
            $page_no = 1;
        }

        $result = $this->Book->get_limited_books_by_main_category_and_subcategory($main_category, $subcategory, $page_no,
            $items_per_page);
        if ($page_no != $last_page) {
            $next_page = $page_no + 1;
            $data['next'] = site_url() . "/visitor/view_books_by_category/?mainCatId=$main_cat_id&subCatId=$subCatId&pageNo=$next_page";
            $data['last'] = site_url() . "/visitor/view_books_by_category/?mainCatId=$main_cat_id&subCatId=$subCatId&pageNo=$last_page";
        }
        if ($page_no != 1) {
            $previous_page = $page_no - 1;
            $data['previous'] = site_url() . "/visitor/view_books_by_category/?mainCatId=$main_cat_id&subCatId=$subCatId&pageNo=$previous_page";
            $data['first'] = site_url() . "/visitor/view_books_by_category/?mainCatId=$main_cat_id&subCatId=$subCatId&pageNo=1";
        }

        $data['mainCategoryTitle'] = $main_category;
        $data['subCategoryTitle'] = $subcategory;
        $data['result'] = $result;
        if (!$result) {
            $error_message = "No Results found for Category: $main_category and Sub Category: $subcategory";
            $data['errorMessage'] = $error_message;
            $this->load->view('visitor/shop', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('visitor/shop', $data);
        }
    }

    /**
     * Controls getting data(search term either can be author name or book title) from view and returning the searched
     * book to the view.
     * @return bool
     */
    public function search_book_by_title_or_author()
    {
        if (isset($_POST['searchTerm'])) {
            $search_term = $_POST['searchTerm'];
        } else if (isset($_GET['searchTerm'])) {
            $search_term = $_GET['searchTerm'];
        } else {
            return FALSE;
        }
        if (isset($_GET['pageNo'])) {
            $page_no = $_GET['pageNo'];
        } else {
            $page_no = 1;
        }
        $this->load->model('Book');
        $count = $this->Book->get_count_books_by_title_or_author($search_term);
        $items_per_page = 12;
        $last_page = ceil($count / $items_per_page);

        // ensuring page number is within the range(from 1 to lastPage)
        $page_no = (int)$page_no;
        if ($page_no > $last_page) {
            $page_no = $last_page;
        }

        if ($page_no < 1) {
            $page_no = 1;
        }

        $result = $this->Book->get_limited_books_by_title_or_author($search_term, $page_no, $items_per_page);
        if ($page_no != $last_page) {
            $next_page = $page_no + 1;
            $data['next'] = site_url() . "/visitor/search_book_by_title_or_author/?searchTerm=$search_term&pageNo=$next_page";
            $data['last'] = site_url() . "/visitor/search_book_by_title_or_author/?searchTerm=$search_term&pageNo=$last_page";
        }
        if ($page_no !== 1) {
            $previous_page = $page_no - 1;
            $data['previous'] = site_url() . "/visitor/search_book_by_title_or_author/?searchTerm=$search_term&pageNo=$previous_page";
            $data['first'] = site_url() . "/visitor/search_book_by_title_or_author/?searchTerm=$search_term&pageNo=1";
        }
        $data['result'] = $result;
        $data['searchTerm'] = $search_term;
        if (!$result) {
            $error_message = 'No Search Results found';
            $data['errorMessage'] = $error_message;
            $this->load->view('visitor/search_results', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('visitor/search_results', $data);
        }
    }
}

?>