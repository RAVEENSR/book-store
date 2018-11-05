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
    public function getAllCategories() {

    }

    /**
     * Controls getting all the sub categories from the database.
     */
    public function getAllSubCategories() {

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

    }

    /**
     * Controls returning all the books to the view.
     */
    public function viewAllBooks() {

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