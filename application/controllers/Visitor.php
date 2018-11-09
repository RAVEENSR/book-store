<?php
/**
 * This class represent all the controller work related to a Visitor.
 */

class Visitor extends CI_Controller {

    public function __construct() {
        // Parent constructor call
        parent::__construct();
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
        $this->load->view('Cart');
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
            $this->load->view('BookDetails', $data);
        } else {
            $data['book'] = $result[0];
            $this->load->view('BookDetails', $data);
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
            $this->load->view('Shop', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('Shop', $data);
        }
    }

    /**
     * Controls returning all the books to the view.
     */
    public function viewBooksByCategory() {
        if (isset($_GET['mainCatId'])) {
            $mainCatId = $_GET['mainCatId'];
        } else {
            $errorMessage = "Main Category Id not received";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('Shop', $data);
            return;
        }
        if (isset($_GET['subCatId'])) {
            $subCatId = $_GET['subCatId'];
        } else {
            $errorMessage = "Main Category Id not received";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('Shop', $data);
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
            $this->load->view('Shop', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('Shop', $data);
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