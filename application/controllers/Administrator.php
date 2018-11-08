<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . 'models/Book.php');

/**
 * This class represent all the controller work related to an Administrator.
 */
class Administrator extends CI_Controller
{

    public function __construct()
    {
        // Parent constructor call
        parent::__construct();
        if (!$this->session->userdata('username'))
        {
            // if the admin user is not logged in redirect them to the login page
            redirect(site_url().'/login/loadAdminLogin');
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
        if (!isset($_POST['bookData'])) {
            return false;
        }
        $receivedData = $_POST['bookData'];
        $this->load->model('BookModel');
        // check whether the entered author name exists. If not add the author.
        if (!$this->BookModel->isAuthorAvailable($receivedData['author'])) {
            $this->BookModel->addAuthor(array('authorName' => $receivedData['author']));
        }

        // check whether the entered main category exists. If not add the main category.
        if (!$this->BookModel->isCategoryAvailable($receivedData['mainCategory'])) {
            $categoryData = array();
            array_push($categoryData, array('categoryTitle' => $receivedData['mainCategory']));
            $this->BookModel->createBookCategories($categoryData);
        }

        // check whether the entered sub category exists. If not add the sub category.
        if (!$this->BookModel->isSubCategoryAvailableInMainCategory($receivedData['subCategory'],
            $receivedData['mainCategory'])) {
            $subCategoryData = array();
            array_push($subCategoryData, array('subCategoryTitle' => $receivedData['subCategory'],
                'categoryTitle' => $receivedData['mainCategory']));
            $this->BookModel->createBookSubCategories($subCategoryData);
        }

        $newEntry = array('isbnNo' => $receivedData['isbn'],
            'title' => $receivedData['title'],
            'categoryTitle' => $receivedData['mainCategory'],
            'subCategoryTitle' => $receivedData['subCategory'],
            'authorName' => $receivedData['author'],
            'publisherName' => $receivedData['publisher'],
            'price' => number_format((float)$receivedData['price'], 2, '.', ''),
            'availableCopies' => $receivedData['qty'],
            'description' => $receivedData['description'],
            'edition' => $receivedData['edition'],
            'imageURL' => $receivedData['img']);

        return $this->BookModel->addBook($newEntry);
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

    /**
     * Controls getting data(new category title/s) from view and adding the main category to the database.
     */
    public function createMainCategory()
    {
        //TODO: use  isCategoryAvailable and give a proper error message
        if (!isset($_POST['categories'])) {
            return false;
        }
        $data = array();
        foreach ($_POST['categories'] as $category) {
            $newEntry = array('categoryTitle' => $category);
            array_push($data, $newEntry);
        }
        $this->load->model('BookModel');
        return $this->BookModel->createBookCategories($data);
    }

    /**
     * Controls getting data(sub category title/s) from view and adding the sub category to the database.
     */
    public function createSubCategory()
    {
        //TODO: use this isSubCategoryAvailableInMainCategory and give a proper error message
        $mainCategory = $_POST['mainCategory'];
        $data = array();
        foreach ($_POST['subCategories'] as $subCategory) {
            $newEntry = array('subCategoryTitle' => $subCategory, 'categoryTitle' => $mainCategory);
            array_push($data, $newEntry);
        }
        $this->load->model('BookModel');
        return $this->BookModel->createBookSubCategories($data);
    }

    /**
     * Controls getting data(book title) from view and returning the searched book to the view.
     */
    public function searchBookByTitle()
    {
        $title = $_POST['title'];
        $this->load->model('BookModel');
        $result = $this->BookModel->getBooksByTitle($title);
        $data['title'] = $title;
        if (!$result){
            $errorMessage = "No Search Results found";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('AdminSearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('AdminSearchResults', $data);
        }
    }

    /**
     * Controls getting data(author name) from view and returning the searched book to the view.
     */
    public function searchBooksByAuthor()
    {
        $author = $_POST['author'];
        $this->load->model('BookModel');
        $result = $this->BookModel->getBooksByAuthor($author);
        $data['author'] = $author;
        if (!$result){
            $errorMessage = "No Search Results found";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('AdminSearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('AdminSearchResults', $data);
        }
    }

    /**
     * Controls getting data(book title and author name) from view and returning the searched book to the view.
     */
    public function searchBookByTitleAndAuthor()
    {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $this->load->model('BookModel');
        $result = $this->BookModel->getBookByTitleAndAuthor($title, $author);
        $data['title'] = $title;
        $data['author'] = $author;
        if (!$result){
            $errorMessage = "No Search Results found";
            $data['errorMessage'] = $errorMessage;
            $this->load->view('AdminSearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('AdminSearchResults', $data);
        }
    }

    /**
     * Controls getting data(book title, author name and main category) from view and returning the searched book to
     * the view.
     */
    public function searchBookByTitleAuthorCategory()
    {

    }

    /**
     * Controls getting data(book title, author name, main category, sub category) from view and returning the searched
     * book to the view.
     */
    public function searchBookByTitleAuthorCategorySubCategory()
    {

    }

    /**
     * Controls displaying details of a book in the view.
     */
    public function viewBookDetails()
    {

    }

    /**
     * Controls returning all the books to the view.
     */
    public function viewAllBooks()
    {

    }

    /**
     * Loads the view for adding a book.
     */
    public function loadAdminPortal()
    {
        $this->load->view('AdminHomeView');
    }

    /**
     * Loads the view for adding a book.
     */
    public function loadAddBook()
    {
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
            $this->load->view('AddBook');
        } else {
            $data['publishers'] = $publishers;
            $this->load->view('AddBook', $data);
        }
    }

    /**
     * Loads the view for adding a publisher.
     */
    public function loadAddPublisher()
    {
        $this->load->view('AddPublisher');
    }

    /**
     * Loads the view for adding a Main Category.
     */
    public function loadAddMainCategory()
    {
        $this->load->view('AddMainCategory');
    }

    /**
     * Loads the view for adding a Sub Category.
     */
    public function loadAddSubCategory()
    {
        $result = $this->getAllCategories();
        if (!$result) {
            $this->load->view('AddSubCategory');
        } else {
            $data['mainCategories'] = $result;
            $this->load->view('AddSubCategory', $data);
        }
    }

    /**
     * Loads the view for searching a book.
     */
    public function loadSearchBook()
    {
        $this->load->view('AdminSearch');
    }

//    /**
//     * Creates an array of Book objects for a given result array.
//     * @param $resultArray ArrayObject An array of objects which contains details of books
//     * @return array Returns a array of Book objects
//     */
//    private function createBookArray($resultArray) {
//        $bookArray = array();
//        foreach ($resultArray as $bookConfig) {
//            $bookArray[] = $bookConfig;
//        }
//        return $bookArray;
//    }

    /**
     * Creates an array of Book objects for a given result array.
     * @param $resultArray ArrayObject An array of objects which contains details of books
     * @return array Returns a array of Book objects
     */
    private function handlePagination() {
        $bookArray = array();
        foreach ($resultArray as $bookConfig) {
            $bookArray[] = $bookConfig;
        }
        return $bookArray;
    }


}
?>