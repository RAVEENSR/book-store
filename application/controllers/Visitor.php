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
        $this->manageUniqueUserId();
    }

    public function index()
    {
        $this->load->model('Book');
        $result1 = $this->Book->getNewestBooks(5);
        $result2 = $this->Book->getEditorPickedBooks(5);
        if ($result1 && $result2) {
            $data['newBooks'] = $result1;
            $data['editorBooks'] = $result2;
            $this->load->view('visitor/HomeView', $data);
        } else {
            $this->load->view('visitor/HomeView');
        }
    }

    /**
     * Creates a unique user id for every new user if it is not created yet. Then will update the database with the id.
     * @return void
     */
    private function manageUniqueUserId()
    {
        if (!$this->session->userdata('visitorId') && !$this->session->userdata('adminUsername')) {
            $visitor_id = uniqid();
            $this->load->model('Book');
            $this->Book->addVisitor($visitor_id);
            $sessionData = array('visitorId' => $visitor_id);
            $this->session->set_userdata($sessionData);
        }
    }

    /**
     * Controls adding an item to the cart.
     * Returns String 0, 1, 2, 3
     * 0: Quantity should be less than the available copies
     * 1: Book is already available in the cart
     * 2: Book Added to the Cart Successfully
     * 3: Error occurred when adding the book into the cart
     */
    public function addToCart()
    {
        if (isset($_POST['isbn']) && isset($_POST['quantity'])) {
            $isbn = $_POST['isbn'];
            $quantity = $_POST['quantity'];
            $quantity = ceil($quantity);

            $this->load->model('Book');
            $bookResult = $this->Book->getBookByIsbn($isbn);
            if (!$bookResult) {
                echo '3';
                return;
            }

            $book = $bookResult[0];
            $availableCopies = $book->availableCopies;
            if ($quantity > $availableCopies) {
                echo '0';
                return;
            }

            // get the cart from the session
            $userCart = $this->session->userdata('bookCart');
            if ($userCart != null) {
                $foundItem = $this->isBookAvailableInCart($userCart, $isbn);
                if ($foundItem) {
                    echo '1';
                    return;
                }
                // add the book to the cart if book is not in the cart
                $bookItem = array(
                    'isbn' => $book->isbnNo,
                    'imgURL' => $book->imageURL,
                    'title' => $book->title,
                    'qty' => $quantity,
                    'price' => $book->price,
                    'total' => ($book->price) * $quantity);
                $userCart[] = $bookItem;
                $this->session->set_userdata('bookCart', $userCart);
                echo '2';

            } else {
                // if the user do not has a cart create a cart and save the book item
                $userCart = array();
                $bookItem = array(
                    'isbn' => $book->isbnNo,
                    'imgURL' => $book->imageURL,
                    'title' => $book->title,
                    'qty' => $quantity,
                    'price' => $book->price,
                    'total' => ($book->price) * $quantity);
                $userCart[] = $bookItem;
                $this->session->set_userdata('bookCart', $userCart);
                echo '2';
            }
        } else {
            echo '3';
        }
    }

    /**
     * Checks whether a book is already in the cart.
     * @param $cart ArrayObject cart of the visitor
     * @param $isbn String isbn number of the book
     * @return bool returns true if the book is found in the cart or false otherwise.
     */
    private function isBookAvailableInCart($cart, $isbn)
    {
        foreach ($cart as $key => $book) {
            if ($book['isbn'] === $isbn) {
                return true;
            }
        }
        // if the book is not in the cart
        return false;
    }

    /**
     * Controls displaying a cart for a particular user.
     * @return void
     */
    public function view_cart()
    {
        // get the cart from the session
        $userCart = $this->session->userdata('bookCart');
        if ($userCart != null && sizeof($userCart) !== 0) {
            $totalPrice = 0;
            foreach ($userCart as $book) {
                $totalPrice += $book['total'];
            }
            $data['totalPrice'] = $totalPrice;
            $data['userCart'] = $userCart;
            $this->load->view('visitor/Cart', $data);
        } else {
            $errorMessage = 'You have no items in the cart';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Cart', $data);
        }
    }

    /**
     * Updates the quantity of item in the cart
     * Returns Object with status and price data
     * 0: Quantity should be less than the available copies
     * 1: Successfully update the quantity
     * 2: Error occurred when adding the book into the cart
     */
    public function updateCart()
    {
        $isbn = $this->input->post('isbn');
        $quantity = $this->input->post('quantity');
        // get the cart from the session
        $userCart = $this->session->userdata('bookCart');
        if ($userCart != null) {
            for ($x = 0; $x < sizeof($isbn); $x++) {
                $bookId = $isbn[$x];
                $newQuantity = $quantity[$x];
                $foundArrayKeyForItem = $this->getBookKeyInCart($userCart, $bookId);
                $oldDetails = $userCart[$foundArrayKeyForItem];
                $newBookItem = array(
                    'isbn' => $oldDetails['isbn'],
                    'imgURL' => $oldDetails['imgURL'],
                    'title' => $oldDetails['title'],
                    'qty' => $newQuantity,
                    'price' => $oldDetails['price'],
                    'total' => ($oldDetails['price']) * $newQuantity);
                $userCart[$foundArrayKeyForItem] = $newBookItem;
            }
            $this->session->set_userdata('bookCart', $userCart);
            $this->view_cart();
        } else {
            $data['status'] = '2';
            echo json_encode($data);
        }
    }

    /**
     * Checks whether a book is already in the cart.
     * @param $cart ArrayObject cart of the visitor
     * @param $isbn String isbn number of the book
     * @return String|null returns the key of the row if the book is found in the cart or null otherwise.
     */
    private function getBookKeyInCart($cart, $isbn)
    {
        foreach ($cart as $key => $book) {
            if ($book["isbn"] === $isbn) {
                return $key;
            }
        }
        // if the book is not in the cart
        return null;
    }

    /**
     * Controls removing an item from the cart.
     * @return void
     */
    public function removeCartItem()
    {
        $bookId = $_GET['bookId'];
        // get the cart from the session
        $userCart = $this->session->userdata('bookCart');
        $foundArrayKeyForItem = $this->getBookKeyInCart($userCart, $bookId);
        unset($userCart[$foundArrayKeyForItem]);
        $this->session->set_userdata('bookCart', $userCart);
        $this->view_cart();
    }

    /**
     * Controls displaying details of a book in the view.
     * @return bool
     */
    public function viewBookDetails()
    {
        if (isset($_GET['isbn'])) {
            $isbn = $_GET['isbn'];
        } else {
            return false;
        }
        $this->load->model('Book');
        $result = $this->Book->getBookByIsbn($isbn);
        if (!$result) {
            $errorMessage = 'Error occurred';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/BookDetails', $data);
        } else {
            $visitorId = $this->session->userdata('visitorId');
            $result2 = $this->Book->addUserBookView($visitorId, $isbn);
            if (!$result2) {
                $errorMessage = 'Error occurred';
                $data['errorMessage'] = $errorMessage;
                $this->load->view('visitor/BookDetails', $data);
            } else {
                $data['book'] = $result[0];
                $data['similarBooks'] = $this->getSimilarViewedBooks($isbn);
                $this->load->view('visitor/BookDetails', $data);
            }
        }
    }

    /**
     * Returns top 5 of similar viewed books by users who viewed the given book as an array.
     * @param $isbn String isbn number of the currently viewing book
     * @return array top five book object s array
     */
    private function getSimilarViewedBooks($isbn)
    {
        $this->load->model('Book');
        $results = $this->Book->getTopSixBooks($isbn);
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
    public function viewAllBooks()
    {
        if (isset($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
        } else {
            $pageNo = 1;
        }

        $this->load->model('Book');
        // get all the categories and create an array
        $categories = array();
        $mainCategories = $this->Book->getAllMainCategoriesWithMainCategoryId();
        if ($mainCategories) {
            for ($x = 0; $x < sizeof($mainCategories); $x++) {
                $categories[$x][0] = $mainCategories[$x];
                $mainCategoryTitle = $mainCategories[$x]->categoryTitle;
                // get sub categories for the main category
                $subCategories = $this->Book->getSubCategoriesOfMainCategoryWithSubCategoryId
                ($mainCategoryTitle);
                if ($subCategories) {
                    $categories[$x][1] = $subCategories;
                }
            }
        }
        $data['categories'] = $categories;

        // get all the books according to the page number
        $count = $this->Book->getCountBooks();
        $itemsPerPage = 12;
        $lastPage = ceil($count / $itemsPerPage);

        // ensuring page number is within the range(from 1 to lastPage)
        $pageNo = (int)$pageNo;
        if ($pageNo > $lastPage) {
            $pageNo = $lastPage;
        }
        if ($pageNo < 1) {
            $pageNo = 1;
        }

        $result = $this->Book->getLimitedBooks($pageNo, $itemsPerPage);
        if ($pageNo != $lastPage) {
            $nextPage = $pageNo + 1;
            $data['next'] = site_url() . "/visitor/viewAllBooks/?pageNo=$nextPage";
            $data['last'] = site_url() . "/visitor/viewAllBooks/?pageNo=$lastPage";
        }
        if ($pageNo != 1) {
            $previousPage = $pageNo - 1;
            $data['previous'] = site_url() . "/visitor/viewAllBooks/?pageNo=$previousPage";
            $data['first'] = site_url() . "/visitor/viewAllBooks/?pageNo=1";
        }

        $data['result'] = $result;
        if (!$result) {
            $errorMessage = 'No Results found';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('visitor/Shop', $data);
        }
    }

    /**
     * Controls returning all the books to the view.
     * @return void
     */
    public function viewBooksByCategory()
    {
        if (isset($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
        } else {
            $pageNo = 1;
        }

        if (isset($_GET['mainCatId']) && filter_var($_GET['mainCatId'], FILTER_VALIDATE_INT)) {
            $mainCatId = $_GET['mainCatId'];
        } else {
            $errorMessage = 'Valid Main Category Id not received';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
            return;
        }
        if (isset($_GET['subCatId']) && filter_var($_GET['subCatId'], FILTER_VALIDATE_INT)) {
            $subCatId = $_GET['subCatId'];
        } else {
            $errorMessage = 'Valid Main Category Id not received';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
            return;
        }

        $this->load->model('Book');
        // get all the categories and create an array
        $categories = array();
        $mainCategories = $this->Book->getAllMainCategoriesWithMainCategoryId();
        if ($mainCategories) {
            for ($x = 0; $x < sizeof($mainCategories); $x++) {
                $categories[$x][0] = $mainCategories[$x];
                $mainCategoryTitle = $mainCategories[$x]->categoryTitle;
                // get sub categories for the main category
                $subCategories = $this->Book->getSubCategoriesOfMainCategoryWithSubCategoryId($mainCategoryTitle);
                if ($subCategories) {
                    $categories[$x][1] = $subCategories;
                }
            }
        }
        $data['categories'] = $categories;

        // get all the books according to the page number
        $mainCategory = $this->Book->getMainCategoryTitleById($mainCatId);
        if (!$mainCategory) {
            $errorMessage = 'Valid Main Category Id not received';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
            return;
        }
        $subcategory = $this->Book->getSubCategoryTitleById($subCatId);
        if (!$subcategory) {
            $errorMessage = 'Valid Sub Category Id not received';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
            return;
        }
        $count = $this->Book->getCountBooksByMainCategoryAndSubCategory($mainCategory, $subcategory);
        $itemsPerPage = 12;
        $lastPage = ceil($count / $itemsPerPage);

        // ensuring page number is within the range(from 1 to lastPage)
        $pageNo = (int)$pageNo;
        if ($pageNo > $lastPage) {
            $pageNo = $lastPage;
        }
        if ($pageNo < 1) {
            $pageNo = 1;
        }

        $result = $this->Book->getLimitedBooksByMainCategoryAndSubCategory($mainCategory, $subcategory, $pageNo,
            $itemsPerPage);
        if ($pageNo != $lastPage) {
            $nextPage = $pageNo + 1;
            $data['next'] = site_url() . "/visitor/viewBooksByCategory/?mainCatId=$mainCatId&subCatId=$subCatId&pageNo=$nextPage";
            $data['last'] = site_url() . "/visitor/viewBooksByCategory/?mainCatId=$mainCatId&subCatId=$subCatId&pageNo=$lastPage";
        }
        if ($pageNo != 1) {
            $previousPage = $pageNo - 1;
            $data['previous'] = site_url() . "/visitor/viewBooksByCategory/?mainCatId=$mainCatId&subCatId=$subCatId&pageNo=$previousPage";
            $data['first'] = site_url() . "/visitor/viewBooksByCategory/?mainCatId=$mainCatId&subCatId=$subCatId&pageNo=1";
        }

        $data['mainCategoryTitle'] = $mainCategory;
        $data['subCategoryTitle'] = $subcategory;
        $data['result'] = $result;
        if (!$result) {
            $errorMessage = "No Results found for Category: $mainCategory and Sub Category: $subcategory";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('visitor/Shop', $data);
        }
    }

    /**
     * Controls getting data(search term either can be author name or book title) from view and returning the searched
     * book to the view.
     * @return bool
     */
    public function searchBookByTitleOrAuthor()
    {
        if (isset($_POST['searchTerm'])) {
            $searchTerm = $_POST['searchTerm'];
        } else if (isset($_GET['searchTerm'])) {
            $searchTerm = $_GET['searchTerm'];
        } else {
            return false;
        }
        if (isset($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
        } else {
            $pageNo = 1;
        }
        $this->load->model('Book');
        $count = $this->Book->getCountBooksByTitleOrAuthor($searchTerm);
        $itemsPerPage = 12;
        $lastPage = ceil($count / $itemsPerPage);

        // ensuring page number is within the range(from 1 to lastPage)
        $pageNo = (int)$pageNo;
        if ($pageNo > $lastPage) {
            $pageNo = $lastPage;
        }

        if ($pageNo < 1) {
            $pageNo = 1;
        }

        $result = $this->Book->getLimitedBooksByTitleOrAuthor($searchTerm, $pageNo, $itemsPerPage);
        if ($pageNo != $lastPage) {
            $nextPage = $pageNo + 1;
            $data['next'] = site_url() . "/visitor/searchBookByTitleOrAuthor/?searchTerm=$searchTerm&pageNo=$nextPage";
            $data['last'] = site_url() . "/visitor/searchBookByTitleOrAuthor/?searchTerm=$searchTerm&pageNo=$lastPage";
        }
        if ($pageNo !== 1) {
            $previousPage = $pageNo - 1;
            $data['previous'] = site_url() . "/visitor/searchBookByTitleOrAuthor/?searchTerm=$searchTerm&pageNo=$previousPage";
            $data['first'] = site_url() . "/visitor/searchBookByTitleOrAuthor/?searchTerm=$searchTerm&pageNo=1";
        }
        $data['result'] = $result;
        $data['searchTerm'] = $searchTerm;
        if (!$result) {
            $errorMessage = 'No Search Results found';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/SearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('visitor/SearchResults', $data);
        }
    }
}

?>