<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * This class represent all the controller work related to an Administrator.
 */
class Administrator extends CI_Controller
{

    public function __construct()
    {
        // Parent constructor call
        parent::__construct();
        if (!$this->session->userdata('adminUsername')) {
            // if the admin user is not logged in redirect them to the login page
            redirect(site_url() . '/login/loadAdminLogin');
        }
    }

    public function index()
    {
        if (!$this->session->userdata('adminUsername')) {
            // if the admin user is not logged in redirect them to the login page
            redirect(site_url() . '/login/loadAdminLogin');
        } else{
            $this->loadAddminPortal();
        }
    }

//TODO: add params and return types to all the methods

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
     * Controls validating the ISBN number of a book.
     */
    public function validateBookISBN()
    {
        $isbn = $_POST['isbn'];
        $this->load->model('BookModel');
        $result = $this->BookModel->getBookByISBN($isbn);
        // flag determines the validity of the isbn number
        $flag = false;
        if (!$result) {
            // if results not found that means isbn is not in the db. Hence flag will be true.
            $flag = true;
        }
        echo json_encode($flag);
        exit;
    }

    /**
     * Controls validating the ISBN number of a book.
     */
    public function validatePublisherName()
    {
        $publisherName = $_POST['publisherName'];
        $this->load->model('BookModel');
        // flag determines the validity of the isbn number
        $flag = $this->BookModel->isPublisherAvailable($publisherName);
        echo json_encode(!$flag);
        exit;
    }

    /**
     * Controls validating the main category title.
     */
    public function validateMainCategory()
    {
        $categoryName = $_POST['categoryName'];
        $this->load->model('BookModel');
        // flag determines the validity of the isbn number
        $flag = $this->BookModel->isCategoryAvailable($categoryName);
        echo json_encode(!$flag);
        exit;
    }

    /**
     * Controls validating the sub category title.
     */
    public function validateSubCategory()
    {
        $subCategoryName = $_POST['subCategoryName'];
        $this->load->model('BookModel');
        // flag determines the validity of the isbn number
        $flag = $this->BookModel->isSubCategoryAvailable($subCategoryName);
        echo json_encode(!$flag);
        exit;
    }

    /**
     * Controls getting all the authors from the database.
     */
    public function getAllAuthors()
    {
        $this->load->model('BookModel');
        $result = $this->BookModel->getAllAuthors();
        // if results not found false will be returned
        if (!$result) {
            return false;
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
     */
    public function getAllPublishers()
    {
        $this->load->model('BookModel');
        $result = $this->BookModel->getAllPublishers();
        // if results not found false will be returned
        if (!$result) {
            return false;
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
     */
    public function addBook()
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
            $mainCategory = $this->input->post('mainCategorySelect');
            $subCategory = $this->input->post('subCategorySelect');
            $publisher = $this->input->post('publisher');
            $edition = $this->input->post('edition');
            $price = $this->input->post('price');
            $qty = $this->input->post('quantity');
            $description = $this->input->post('description');
            $img = 'img/product/' . $image;

            $this->load->model('BookModel');
            // check whether the entered author name exists. If not add the author.
            if (!$this->BookModel->isAuthorAvailable($author)) {
                $this->BookModel->addAuthor(array('authorName' => $author));
            }

            // check whether the entered main category exists. If not add the main category.
            if (!$this->BookModel->isCategoryAvailable($mainCategory)) {
                $categoryData = array();
                array_push($categoryData, array('categoryTitle' => $mainCategory));
                $this->BookModel->createBookCategories($categoryData);
            }

            // check whether the entered sub category exists. If not add the sub category.
            if (!$this->BookModel->isSubCategoryAvailableInMainCategory($subCategory, $mainCategory)) {
                $subCategoryData = array();
                array_push($subCategoryData, array('subCategoryTitle' => $subCategory, 'categoryTitle' => $mainCategory));
                $this->BookModel->createBookSubCategories($subCategoryData);
            }

            $newEntry = array('isbnNo' => $isbn,
                'title' => $title,
                'categoryTitle' => $mainCategory,
                'subCategoryTitle' => $subCategory,
                'authorName' => $author,
                'publisherName' => $publisher,
                'price' => number_format((float)$price, 2, '.', ''),
                'availableCopies' => $qty,
                'description' => $description,
                'edition' => $edition,
                'imageURL' => $img);
            $result = $this->BookModel->addBook($newEntry);
            // flag determines the validity
            $flag = false;
            if ($result) {
                $flag = true;
            }
            echo json_encode($flag);
        }
    }

    /**
     * Controls getting data(new publisher data) from view and adding the publisher to the database.
     */
    public function addPublisher()
    {
        if (!isset($_POST['publisherData'])) {
            return false; //TODO: check whether to return a ajax error message(edit in other places as well)
        }
        $receivedData = $_POST['publisherData'];
        $newEntry = array('publisherName' => $receivedData['publisherName'],
            'contactNo' => $receivedData['contactNo']);
        $this->load->model('BookModel');
        return $this->BookModel->addPublisher($newEntry);
    }

//    /**
//     * Controls getting data(new category title/s) from view and adding the main category to the database.
//     */
//    public function createMainCategory()
//    {
//        //TODO: use  isCategoryAvailable and give a proper error message
//        if (!isset($_POST['categories'])) {
//            return false;
//        }
//        $data = array();
//        foreach ($_POST['categories'] as $category) {
//            $newEntry = array('categoryTitle' => $category);
//            array_push($data, $newEntry);
//        }
//        $this->load->model('BookModel');
//        return $this->BookModel->createBookCategories($data);
//    }
//
//    /**
//     * Controls getting data(sub category title/s) from view and adding the sub category to the database.
//     */
//    public function createSubCategory()
//    {
//        //TODO: use this isSubCategoryAvailableInMainCategory and give a proper error message
//        $mainCategory = $_POST['mainCategory'];
//        $data = array();
//        foreach ($_POST['subCategories'] as $subCategory) {
//            $newEntry = array('subCategoryTitle' => $subCategory, 'categoryTitle' => $mainCategory);
//            array_push($data, $newEntry);
//        }
//        $this->load->model('BookModel');
//        return $this->BookModel->createBookSubCategories($data);
//    }

    /**
     * Controls getting data(book title) from view and returning the searched book to the view.
     */
    public function searchBookByTitle()
    {
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        } else if (isset($_GET['title'])) {
            $title = $_GET['title'];
        } else {
            return false;
        }

        if (isset($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
        } else {
            $pageNo = 1;
        }
        $this->load->model('BookModel');
        $count = $this->BookModel->getCountBooksByTitle($title);
        $itemsPerPage = 20;
        $lastPage = ceil($count / $itemsPerPage);

        // ensuring page number is within the range(from 1 to lastPage)
        $pageNo = (int)$pageNo;
        if ($pageNo > $lastPage) {
            $pageNo = $lastPage;
        }

        if ($pageNo < 1) {
            $pageNo = 1;
        }

        $result = $this->BookModel->getLimitedBooksByTitle($title, $pageNo, $itemsPerPage);
        if ($pageNo != $lastPage) {
            $nextPage = $pageNo + 1;
            $data['next'] = site_url() . "/administrator/searchBookByTitle/?pageNo=$nextPage&title=$title";
            $data['last'] = site_url() . "/administrator/searchBookByTitle/?pageNo=$lastPage&title=$title";
        }
        if ($pageNo !== 1) {
            $previousPage = $pageNo - 1;
            $data['previous'] = site_url() . "/administrator/searchBookByTitle/?pageNo=$previousPage&title=$title";
            $data['first'] = site_url() . "/administrator/searchBookByTitle/?pageNo=1&title=$title";
        }
        $data['result'] = $result;
        $data['title'] = $title;
        if (!$result) {
            $errorMessage = "No Search Results found";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('admin/SearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('admin/SearchResults', $data);
        }
    }

    /**
     * Controls getting data(author name) from view and returning the searched book to the view.
     */
    public function searchBooksByAuthor()
    {
        if (isset($_POST['author'])) {
            $author = $_POST['author'];
        } else if (isset($_GET['author'])) {
            $author = $_GET['author'];
        } else {
            return false;
        }

        if (isset($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
        } else {
            $pageNo = 1;
        }
        $this->load->model('BookModel');
        $count = $this->BookModel->getCountBooksByAuthor($author);
        $itemsPerPage = 20;
        $lastPage = ceil($count / $itemsPerPage);

        // ensuring page number is within the range(from 1 to lastPage)
        $pageNo = (int)$pageNo;
        if ($pageNo > $lastPage) {
            $pageNo = $lastPage;
        }

        if ($pageNo < 1) {
            $pageNo = 1;
        }

        $result = $this->BookModel->getLimitedBooksByAuthor($author, $pageNo, $itemsPerPage);
        if ($pageNo != $lastPage) {
            $nextPage = $pageNo + 1;
            $data['next'] = site_url() . "/administrator/searchBookByAuthor/?pageNo=$nextPage&author=$author";
            $data['last'] = site_url() . "/administrator/searchBookByAuthor/?pageNo=$lastPage&author=$author";
        }
        if ($pageNo !== 1) {
            $previousPage = $pageNo - 1;
            $data['previous'] = site_url() . "/administrator/searchBookByAuthor/?pageNo=$previousPage&author=$author";
            $data['first'] = site_url() . "/administrator/searchBookByAuthor/?pageNo=1&author=$author";
        }
        $data['result'] = $result;
        $data['author'] = $author;
        if (!$result) {
            $errorMessage = "No Search Results found";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('admin/SearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('admin/SearchResults', $data);
        }
    }

    /**
     * Controls getting data(book title and author name) from view and returning the searched book to the view.
     */
    public function searchBookByTitleAndAuthor()
    {

        if (isset($_POST['author'])) {
            $author = $_POST['author'];
        } else if (isset($_GET['author'])) {
            $author = $_GET['author'];
        } else {
            return false;
        }

        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        } else if (isset($_GET['title'])) {
            $title = $_GET['title'];
        } else {
            return false;
        }

        if (isset($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
        } else {
            $pageNo = 1;
        }
        $this->load->model('BookModel');
        $count = $this->BookModel->getCountBooksByTitleAndAuthor($title, $author);
        $itemsPerPage = 20;
        $lastPage = ceil($count / $itemsPerPage);

        // ensuring page number is within the range(from 1 to lastPage)
        $pageNo = (int)$pageNo;
        if ($pageNo > $lastPage) {
            $pageNo = $lastPage;
        }

        if ($pageNo < 1) {
            $pageNo = 1;
        }

        $result = $this->BookModel->getLimitedBooksByTitleAndAuthor($title, $author, $pageNo, $itemsPerPage);
        if ($pageNo != $lastPage) {
            $nextPage = $pageNo + 1;
            $data['next'] = site_url() . "/administrator/searchBookByTitleAndAuthor/?pageNo=$nextPage&title=$title&author=$author";
            $data['last'] = site_url() . "/administrator/searchBookByTitleAndAuthor/?pageNo=$lastPage&title=$title&author=$author";
        }
        if ($pageNo !== 1) {
            $previousPage = $pageNo - 1;
            $data['previous'] = site_url() . "/administrator/searchBookByTitleAndAuthor/?pageNo=$previousPage&title=$title&author=$author";
            $data['first'] = site_url() . "/administrator/searchBookByTitleAndAuthor/?pageNo=1&title=$title&author=$author";
        }
        $data['result'] = $result;
        $data['author'] = $author;
        if (!$result) {
            $errorMessage = "No Search Results found";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('admin/SearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('admin/SearchResults', $data);
        }
    }

    /**
     * Controls displaying details of a book in the view.
     */
    public function viewBookDetails()
    {
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
            $this->load->view('admin/BookDetails', $data);
        } else {
            $data['book'] = $result[0];
            $this->load->view('admin/BookDetails', $data);
        }
    }

    /**
     * Loads the view for adding a book.
     */
    public function loadAdminPortal()
    {
        $this->load->view('admin/HomeView');
    }

    /**
     * Loads the view for adding a book.
     */
    public function loadAddBook()
    {
        $this->load->helper('form');
        $mainCategories = $this->getAllCategories();
        $authors = $this->getAllAuthors();
        $publishers = $this->getAllPublishers();
        if ($mainCategories) {
            $data['mainCategories'] = $mainCategories;
        }
        if ($authors) {
            $data['authors'] = $authors;
        }
        if (!$publishers) {
            $this->load->view('admin/AddBook');
        } else {
            $data['publishers'] = $publishers;
            $this->load->view('admin/AddBook', $data);
        }
    }

    /**
     * Loads the view for adding a publisher.
     */
    public function loadAddPublisher()
    {
        $this->load->view('admin/AddPublisher');
    }

    /**
     * Loads the view for adding a Main Category.
     */
    public function loadAddMainCategory()
    {
        $this->load->view('admin/AddMainCategory');
    }

    /**
     * Loads the view for adding a Sub Category.
     */
    public function loadAddSubCategory()
    {
        $result = $this->getAllCategories();
        if (!$result) {
            $this->load->view('admin/AddSubCategory');
        } else {
            $data['mainCategories'] = $result;
            $this->load->view('admin/AddSubCategory', $data);
        }
    }

    /**
     * Loads the view for searching a book.
     */
    public function loadSearchBook()
    {
        $this->load->view('admin/Search');
    }
}

?>