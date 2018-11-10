<?php
/**
 * This class represent all the controller work related to a Visitor.
 */

class Visitor extends CI_Controller {

    public function __construct() {
        // Parent constructor call
        parent::__construct();
        $this->manageUniqueUserId();
    }

    public function index()
    {
//        $this->manageUniqueUserId();
        $this->load->view('visitor/HomeView');
    }

    /**
     * Creates a unique user id for every new user if it is not created yet. Then will update the database with the id.
     */
    private function manageUniqueUserId()
    {
        if (!$this->session->userdata('visitorId') && !$this->session->userdata('adminUsername')) {
            $visitorId = uniqid();
            $this->load->model('BookModel');
            $result = $this->BookModel->addVisitor($visitorId);
            if (!$result) {
                //TODO: Add a error message: php error handling
            }
            $session_data = array('visitorId' => $visitorId);
            $this->session->set_userdata($session_data);
        }
    }

    /**
     * Controls getting all the categories from the database.
     */
    public function getAllCategories()
    {
        $this->load->model('BookModel');
        $result = $this->BookModel->getAllMainCategories();
        // if results not found false will be returned
        if (!$result) {
            return false;
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
     */
    public function getAllSubCategoriesOfMainCategory()
    {
        $mainCategory = $_POST['mainCategory'];
        $this->load->model('BookModel');
        $result = $this->BookModel->getSubCategoriesOfAMainCategory($mainCategory);
        // if results not found false will be returned
        if (!$result) {
            return false;
        }
        $subCategories = array();
        foreach ($result as $row) {
            // row is an object, attributes are columns in the table
            $subCategories[] = $row->subCategoryTitle;
        }
        $data['result'] = $subCategories;
        echo json_encode($data);
        exit;
    }

    /**
     * Controls getting all the books of a given category from the database.
     */
    public function getBooksOfACategory() {

    }

    /**
     * Controls adding an item to the cart.
     */
    public function addItemToCart() {

    }

    /**
     * Controls displaying a cart for a particular user.
     */
    public function viewCart() {
        $this->load->view('visitor/Cart');
    }

    /**
     * Controls removing an item from the cart.
     */
    public function removeCartItem() {

    }

    /**
     * Controls displaying details of a book in the view.
     */
    public function viewBookDetails() {
        if (isset($_GET['isbn'])) {
            $isbn = $_GET['isbn'];
        } else {
            return false;
        }

        $this->load->model('BookModel');
        $result = $this->BookModel->getBookByISBN($isbn);
        if (!$result) {
            $errorMessage = "Error occurred";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/BookDetails', $data);
        } else {
            $data['book'] = $result[0];
            $this->load->view('visitor/BookDetails', $data);
        }
    }

    /**
     * Controls returning all the books to the view.
     */
    public function viewAllBooks() {
        if (isset($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
        } else {
            $pageNo = 1;
        }

        $this->load->model('BookModel');
        // get all the categories and create an array
        $categories = array();
        $mainCategories = $this->BookModel->getAllMainCategoriesWithMainCategoryId();
        if($mainCategories) {
            for ($x=0; $x<sizeof($mainCategories); $x++) {
                $categories[$x][0] = $mainCategories[$x];
                $mainCategoryTitle = $mainCategories[$x]->categoryTitle;
                // get sub categories for the main category
                $subCategories = $this->BookModel->getSubCategoriesOfAMainCategoryWithSubCategoryId($mainCategoryTitle);
                if($subCategories) {
                    $categories[$x][1] = $subCategories;
                }
            }
        }
        $data['categories'] = $categories;

        // get all the books according to the page number
        $count = $this->BookModel->getCountBooks();
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

        $result = $this->BookModel->getLimitedBooks($pageNo, $itemsPerPage);
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
            $errorMessage = "No Results found";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('visitor/Shop', $data);
        }
    }

    /**
     * Controls returning all the books to the view.
     */
    public function viewBooksByCategory() {
        if (isset($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
        } else {
            $pageNo = 1;
        }

        if (isset($_GET['mainCatId']) && filter_var($_GET['mainCatId'], FILTER_VALIDATE_INT)) {
            $mainCatId = $_GET['mainCatId'];
        } else {
            $errorMessage = "Valid Main Category Id not received";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
            return;
        }
        if (isset($_GET['subCatId']) && filter_var($_GET['subCatId'], FILTER_VALIDATE_INT)) {
            $subCatId = $_GET['subCatId'];
        } else {
            $errorMessage = "Valid Main Category Id not received";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
            return;
        }

        $this->load->model('BookModel');
        // get all the categories and create an array
        $categories = array();
        $mainCategories = $this->BookModel->getAllMainCategoriesWithMainCategoryId();
        if($mainCategories) {
            for ($x=0; $x<sizeof($mainCategories); $x++) {
                $categories[$x][0] = $mainCategories[$x];
                $mainCategoryTitle = $mainCategories[$x]->categoryTitle;
                // get sub categories for the main category
                $subCategories = $this->BookModel->getSubCategoriesOfAMainCategoryWithSubCategoryId($mainCategoryTitle);
                if($subCategories) {
                    $categories[$x][1] = $subCategories;
                }
            }
        }
        $data['categories'] = $categories;

        // get all the books according to the page number
        $mainCategory = $this->BookModel->getMainCategoryTitleById($mainCatId);
        if (!$mainCategory) {
            $errorMessage = "Valid Main Category Id not received";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
            return;
        }
        $subCategory = $this->BookModel->getSubCategoryTitleById($subCatId);
        if (!$subCategory) {
            $errorMessage = "Valid Sub Category Id not received";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/Shop', $data);
            return;
        }
        $count = $this->BookModel->getCountBooksByMainCategoryAndSubCategory($mainCategory, $subCategory);
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

        $result = $this->BookModel->getLimitedBooksByMainCategoryAndSubCategory($mainCategory, $subCategory,$pageNo,
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
        $data['subCategoryTitle'] = $subCategory;
        $data['result'] = $result;
        if (!$result) {
            $errorMessage = "No Results found for Category: $mainCategory and Sub Category: $subCategory";
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
        $this->load->model('BookModel');
        $count = $this->BookModel->getCountBooksByTitleOrAuthor($searchTerm);
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

        $result = $this->BookModel->getLimitedBooksByTitleOrAuthor($searchTerm, $pageNo, $itemsPerPage);
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
            $errorMessage = "No Search Results found";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('visitor/SearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('visitor/SearchResults', $data);
        }
    }

    /**
     * Controls getting data(book title) from view and returning the searched book to the view.
     */
    public function searchBookByTitle() {

    }

    /**
     * Controls getting data(author name) from view and returning the searched book to the view.
     */
    public function searchBooksByAuthor() {

    }

    /**
     * Controls getting data(book title and author name) from view and returning the searched book to the view.
     */
    public function searchBookByTitleAndAuthor() {

    }

    /**
     * Controls getting data(book title, author name and main category) from view and returning the searched book to
     * the view.
     */
    public function searchBookByTitleAuthorCategory() {

    }

    /**
     * Controls getting data(book title, author name, main category, sub category) from view and returning the searched
     * book to the view.
     */
    public function searchBookByTitleAuthorCategorySubCategory() {

    }

}

?>