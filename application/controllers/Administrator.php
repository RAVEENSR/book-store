<?php
/**
 * This class represent all the controller work related to an Administrator.
 */

class Administrator extends CI_Controller {

    public function __construct() {
        // Parent constructor call
        parent::__construct();
    }
//TODO: add params and return types to all the methods
    /**
     * Controls getting all the categories from the database.
     */
    public function getAllCategories() {
        $this->load->model('BookModel');
        $result = $this->BookModel->getAllMainCategories();
        // if results not found false will be returned
        if (!$result) {
            return false;
        }
        $categories = array();
        foreach ($result as $row) {
            // row is an object, attributes are columns in the table
            $categories[] =$row->categoryTitle;
        }
        return $categories;
    }

    /**
     * Controls getting all the sub categories from the database.
     */
    public function getAllSubCategoriesOfMainCategory() {
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
            $subCategories[] =$row->subCategoryTitle;
        }
        $data['result'] = $subCategories;
        echo json_encode($data);
        exit;
    }

    /**
     * Controls getting all the authors from the database.
     */
    public function getAllAuthors() {
        $this->load->model('BookModel');
        $result = $this->BookModel->getAllAuthors();
        // if results not found false will be returned
        if (!$result) {
            return false;
        }
        $authors = array();
        foreach ($result as $row) {
            // row is an object, attributes are columns in the table
            $authors[] =$row->authorName;
        }
        return $authors;
    }

    /**
     * Controls getting all the publishers from the database.
     */
    public function getAllPublishers() {
        $this->load->model('BookModel');
        $result = $this->BookModel->getAllPublishers();
        // if results not found false will be returned
        if (!$result) {
            return false;
        }
        $publishers = array();
        foreach ($result as $row) {
            // row is an object, attributes are columns in the table
            $publishers[] =$row->publisherName;
        }
        return $publishers;
    }

    /**
     * Controls getting data(book details) from view and adding the book to the database.
     */
    public function addBook() {
        if(!isset($_POST['bookData'])) {
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
    public function addPublisher() {
        //TODO: use  isAuthorAvailable and give a proper error message
        if(!isset($_POST['publisherData'])) {
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
    public function createMainCategory() {
        //TODO: use  isCategoryAvailable and give a proper error message
        if(!isset($_POST['categories'])) {
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
    public function createSubCategory() {
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

    /**
     * Controls displaying details of a book in the view.
     */
    public function viewBookDetails() {

    }

    /**
     * Controls returning all the books to the view.
     */
    public function viewAllBooks() {

    }

    /**
     * Loads the view for adding a book.
     */
    public function loadAdminPortal() {
        //TODO: check whether admin is logged in or redirect to login page
        $this->load->view('AdminHomeView');
    }

    /**
     * Loads the view for adding a book.
     */
    public function loadAddBook() {
        $mainCategories = $this->getAllCategories();
        $authors = $this->getAllAuthors();
        $publishers = $this->getAllPublishers();
        if($mainCategories) {
            $data['mainCategories'] = $mainCategories;
        }
        if($authors) {
            $data['authors'] = $authors;
        }
        if(!$publishers) {
            $this->load->view('AddBook');
        } else {
            $data['publishers'] = $publishers;
            $this->load->view('AddBook', $data);
        }
    }

    /**
     * Loads the view for adding a publisher.
     */
    public function loadAddPublisher() {
        $this->load->view('AddPublisher');
    }

    /**
     * Loads the view for adding a Main Category.
     */
    public function loadAddMainCategory() {
        $this->load->view('AddMainCategory');
    }

    /**
     * Loads the view for adding a Sub Category.
     */
    public function loadAddSubCategory() {
        $result = $this->getAllCategories();
        if(!$result) {
            $this->load->view('AddSubCategory');
        } else {
            $data['mainCategories'] = $result;
            $this->load->view('AddSubCategory', $data);
        }
    }

    /**
     * Loads the view for searching a book.
     */
    public function loadSearchBook() {
        $this->load->view('AdminSearch');
    }

}

?>