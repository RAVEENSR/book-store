<?php
/**
 * This class represents a Book object in the book store.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Book {

    private $isbnNo;
    private $title;
    private $mainCategory;
    private $subCategories;
    private $authors;
    private $publisher;
    private $price;
    private $availableCopies;
    private $description;
    private $edition;
    private $imageURL;

    /**
     * Book constructor.
     * @param $config ArrayObject Configurations for the book object
     */
    public function __construct($config) {
        // initialising the private attributes
        $this->isbnNo = $config->isbnNo;
        $this->title = $config->title;
        $this->mainCategory = $config->mainCategory;
        $this->subCategories = $config->subCategories;
        $this->authors = $config->authors;
        $this->publisher = $config->publisher;
        $this->price = $config->price;
        $this->availableCopies = $config->availableCopies;
        $this->description = $config->description;
        $this->edition = $config->edition;
        $this->imageURL = $config->imageURL;
    }

    public function getISBNNo(){
        return $this->isbnNo;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getMainCategory(){
        return $this->mainCategory;
    }

    public function getSubCategories() {
        return $this->subCategories;
    }

    public function getAuthors(){
        return $this->authors;
    }

    public function getPublisher(){
        return $this->publisher;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getAvailableCopies(){
        return $this->availableCopies;
    }

    public function  getDescription() {
        return $this->description;
    }

    public function getEdition(){
        return $this->edition;
    }

    public function getImageURL(){
        return $this->imageURL;
    }

}
?>