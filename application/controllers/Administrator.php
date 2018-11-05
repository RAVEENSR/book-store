<?php
/**
 * This class represent all the controller work related to an Administrator.
 */

class Administrator extends CI_Controller {

    public function __construct() {
        // Parent constructor call
        parent::__construct();
    }

    /**
     * Controls getting all the categories from the database.
     */
    public function getAllCategories() {

    }

    /**
     * Controls getting all the sub categories from the database.
     */
    public function getAllSubCategories() {

    }

    /**
     * Controls getting data(book details) from view and adding the book to the database.
     */
    public function addBook() {

    }

    /**
     * Controls getting data(new category title) from view and adding the main category to the database.
     */
    public function createMainCategory() {

    }

    /**
     * Controls getting data(sub category title) from view and adding the sub category to the database.
     */
    public function createSubCategory() {

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

}

?>