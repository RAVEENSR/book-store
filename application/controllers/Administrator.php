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
        } else {
            $this->loadAdminPortal();
        }
    }

    /**
     * Controls getting all the categories from the database.
     * @return array|bool
     */
    public function getAllCategories()
    {
        $this->load->model('Book');
        $result = $this->Book->getAllMainCategories();
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
     * @return array|bool
     */
    public function getAllSubCategoriesOfMainCategory()
    {
        $mainCategory = $_POST['mainCategory'];
        $this->load->model('Book');
        $result = $this->Book->getSubCategoriesOfMainCategory($mainCategory);
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
    }

    /**
     * Controls validating the ISBN number of a book.
     * @return String
     */
    public function validateBookIsbn()
    {
        $isbn = $_POST['isbn'];
        $this->load->model('Book');
        $result = $this->Book->getBookByIsbn($isbn);
        // flag determines the validity of the isbn number
        $flag = false;
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
    public function validatePublisherName()
    {
        $publisherName = $_POST['publisherName'];
        $this->load->model('Book');
        // flag determines the validity of the isbn number
        $flag = $this->Book->isPublisherAvailable($publisherName);
        echo json_encode(!$flag);
    }

    /**
     * Controls validating the main category title.
     * @return String
     */
    public function validateMainCategory()
    {
        $categoryName = $_POST['categoryName'];
        $this->load->model('Book');
        // flag determines the validity of the isbn number
        $flag = $this->Book->isCategoryAvailable($categoryName);
        echo json_encode(!$flag);
    }

    /**
     * Controls validating the sub category title.
     * @return String
     */
    public function validateSubCategory()
    {
        $subCategoryName = $_POST['subCategoryName'];
        $this->load->model('Book');
        // flag determines the validity of the isbn number
        $flag = $this->Book->isSubCategoryAvailable($subCategoryName);
        echo json_encode(!$flag);
    }

    /**
     * Controls getting all the authors from the database.
     * @return array|bool
     */
    public function getAllAuthors()
    {
        $this->load->model('Book');
        $result = $this->Book->getAllAuthors();
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
     * @return array|bool
     */
    public function getAllPublishers()
    {
        $this->load->model('Book');
        $result = $this->Book->getAllPublishers();
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
     * @return String
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
            $quantity = $this->input->post('quantity');
            $description = $this->input->post('description');
            $img = 'img/product/' . $image;

            $this->load->model('Book');
            // check whether the entered author name exists. If not add the author.
            if (!$this->Book->isAuthorAvailable($author)) {
                $this->Book->addAuthor(array('authorName' => $author));
            }

            // check whether the entered main category exists. If not add the main category.
            if (!$this->Book->isCategoryAvailable($mainCategory)) {
                $categoryData = array();
                array_push($categoryData, array('categoryTitle' => $mainCategory));
                $this->Book->createBookCategories($categoryData);
            }

            // check whether the entered sub category exists. If not add the sub category.
            if (!$this->Book->isSubCategoryAvailableInMainCategory($subCategory, $mainCategory)) {
                $subCategoryData = array();
                array_push($subCategoryData, array('subCategoryTitle' => $subCategory, 'categoryTitle' => 
                    $mainCategory));
                $this->Book->createBookSubCategories($subCategoryData);
            }

            $newEntry = array('isbnNo' => $isbn,
                'title' => $title,
                'categoryTitle' => $mainCategory,
                'subCategoryTitle' => $subCategory,
                'authorName' => $author,
                'publisherName' => $publisher,
                'price' => number_format((float)$price, 2, '.', ''),
                'availableCopies' => $quantity,
                'description' => $description,
                'edition' => $edition,
                'imageURL' => $img);
            $result = $this->Book->addBook($newEntry);
            $data = array();
            // flag determines the validity
            $flag = false;
            if ($result) {
                $flag = TRUE;
            }
            // get updated authors
            $result2 = $this->Book->getAllAuthors();
            // if results not found false will be returned
            $authors = array();
            if (!$result2) {
                $flag = false;
            } else {
                foreach ($result2 as $row) {
                    // row is an object, attributes are columns in the table
                    $authors[] = $row->authorName;
                }
            }
            $data['result'] = $flag;
            $data['authors'] = $authors;
            echo json_encode($data);
        }
    }

    /**
     * Controls getting data(new publisher data) from view and adding the publisher to the database.
     * @return bool
     */
    public function addPublisher()
    {
        if (!isset($_POST['publisherData'])) {
            return false;
        }
        $receivedData = $_POST['publisherData'];
        $newEntry = array('publisherName' => $receivedData['publisherName'],
            'contactNo' => $receivedData['contactNo']);
        $this->load->model('Book');
        return $this->Book->addPublisher($newEntry);
    }

    /**
     * Returns number of views of a book per day for a given date limit.
     * @return String
     * 0: Error occurred when getting the number of views
     * 1: Request successful
     */
    public function getViewsForBookForLastDays()
    {
        if (isset($_POST['isbn']) && isset($_POST['numberOfDays'])) {
            $isbn = $_POST['isbn'];
            $numberOfDays = ceil($_POST['numberOfDays']);
            $this->load->model('Book');
            $results = $this->Book->getLastDaysViewsOfBook($isbn, $numberOfDays);
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
    public function createMainCategory()
    {
        if (!isset($_POST['categories'])) {
            return false;
        }
        $data = array();
        $this->load->model('Book');
        foreach ($_POST['categories'] as $category) {
            // check whether the entered main category exists. If not add the main category.
            if (!$this->Book->isCategoryAvailable($category)) {
                $newEntry = array('categoryTitle' => $category);
                array_push($data, $newEntry);
            }
        }
        return $this->Book->createBookCategories($data);
    }

    /**
     * Controls getting data(sub category title/s) from view and adding the sub category to the database.
     * @return bool
     */
    public function createSubCategory()
    {
        if (!isset($_POST['mainCategory']) OR !isset($_POST['subCategories'])) {
            return false;
        }
        $mainCategory = $_POST['mainCategory'];
        $data = array();
        $this->load->model('Book');
        foreach ($_POST['subCategories'] as $subCategory) {
            // check whether the entered sub category exists. If not add the sub category.
            if (!$this->Book->isSubCategoryAvailableInMainCategory($subCategory, $mainCategory)) {
                $newEntry = array('subCategoryTitle' => $subCategory, 'categoryTitle' => $mainCategory);
                array_push($data, $newEntry);
            }
        }
        return $this->Book->createBookSubCategories($data);
    }

    /**
     * Controls getting data(book title) from view and returning the searched book to the view.
     * @return bool
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
        $this->load->model('Book');
        $count = $this->Book->getCountBooksByTitle($title);
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

        $result = $this->Book->getLimitedBooksByTitle($title, $pageNo, $itemsPerPage);
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
            $errorMessage = 'No Search Results found';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('admin/SearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('admin/SearchResults', $data);
        }
    }

    /**
     * Controls getting data(author name) from view and returning the searched book to the view.
     * @return bool
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
        $this->load->model('Book');
        $count = $this->Book->getCountBooksByAuthor($author);
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

        $result = $this->Book->getLimitedBooksByAuthor($author, $pageNo, $itemsPerPage);
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
            $errorMessage = 'No Search Results found';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('admin/SearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('admin/SearchResults', $data);
        }
    }

    /**
     * Controls getting data(book title and author name) from view and returning the searched book to the view.
     * @return bool
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
        $this->load->model('Book');
        $count = $this->Book->getCountBooksByTitleAndAuthor($title, $author);
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

        $result = $this->Book->getLimitedBooksByTitleAndAuthor($title, $author, $pageNo, $itemsPerPage);
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
            $errorMessage = 'No Search Results found';
            $data['errorMessage'] = $errorMessage;
            $this->load->view('admin/SearchResults', $data);
        } else {
            $data['result'] = $result;
            $this->load->view('admin/SearchResults', $data);
        }
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
            $this->load->view('admin/BookDetails', $data);
        } else {
            $data['book'] = $result[0];
            $this->load->view('admin/BookDetails', $data);
        }
    }

    /**
     * Controls displaying statistics of books.
     * @return void
     */
    public function loadStatistics()
    {
        $this->load->view('admin/BookStatistics');
    }

    /**
     * Returns information required to disply statistics graphs in BookStatistics page.
     * @return String
     * 0: Error occurred when getting the number of views
     * 1: Request successful
     */
    public function getStatGraphInfo()
    {
        if (isset($_POST['numberOfDays'])) {
            $numberOfDays = ceil($_POST['numberOfDays']);
            $this->load->model('Book');

            $result1 = $this->Book->getMostViewedBooks(5);
            $result2 = $this->Book->getMostViewedCategories(5);
            $result3 = $this->Book->getMostViewedSubCategories(5);
            $result4 = $this->Book->getTotalNumberOfBookViews($numberOfDays);

            $topBooks = array();
            $topBookViews = array();
            $topCategories = array();
            $topCategoryViews = array();
            $topSubCategories = array();
            $topSubCategoryViews = array();
            $totalViews = array();
            $dates = array();

            if ($result1) {
                foreach ($result1 as $topBook) {
                    $topBooks[] = $topBook->title;
                    $topBookViews[] = $topBook->total;
                }
                $data['topBooks'] = $topBooks;
                $data['topBookViews'] = $topBookViews;
            }
            if ($result2) {
                foreach ($result2 as $topCategory) {
                    $topCategories[] = $topCategory->categoryTitle;
                    $topCategoryViews[] = $topCategory->total;
                }
                $data['topCategories'] = $topCategories;
                $data['topCategoryViews'] = $topCategoryViews;
            }
            if ($result3) {
                foreach ($result3 as $topSubCategory) {
                    $topSubCategories[] = $topSubCategory->subCategoryTitle;
                    $topSubCategoryViews[] = $topSubCategory->total;
                }
                $data['topSubCategories'] = $topSubCategories;
                $data['topSubCategoryViews'] = $topSubCategoryViews;
            }
            if ($result4) {
                foreach ($result4 as $viewPerDay) {
                    $totalViews[] = $viewPerDay->NumberOfViews;
                    $dates[] = $viewPerDay->visitedDate;
                }
                $data['totalViews'] = $totalViews;
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
    public function loadAdminPortal()
    {
        $this->load->view('admin/HomeView');
    }

    /**
     * Loads the view for adding a book.
     * @return void
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
     * @return void
     */
    public function loadAddPublisher()
    {
        $this->load->view('admin/AddPublisher');
    }

    /**
     * Loads the view for adding a Main Category.
     * @return void
     */
    public function loadAddMainCategory()
    {
        $this->load->view('admin/AddMainCategory');
    }

    /**
     * Loads the view for adding a Sub Category.
     * @return void
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
     * @return void
     */
    public function loadSearchBook()
    {
        $this->load->view('admin/Search');
    }
}

?>