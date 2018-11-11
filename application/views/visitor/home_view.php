<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'header.php' ?>
<!-- js file for Add to Cart -->
<script src="<?php echo base_url(); ?>js/manageCart.js"></script>
<!-- slider-area-start -->
<div class="slider-area mt-30">
    <div class="container">
        <div class="slider-active owl-carousel">
            <div class="single-slider pt-100 pb-145 bg-img"
                 style="background-image:url(<?php echo base_url(); ?>img/slider/13.jpg);">
                <div class="row">
                    <div class="col-md-12">
                        <div class="slider-content-3 slider-animated-1 pl-100">
                            <h1>Read More <br>Spend Less</h1>
                            <p class="slider-sale">
                                <span class="sale1">-20%</span>
                                <span class="sale2">On EVERY Book</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider-area-end -->

<!-- editor-area-start -->
<div class="new-book-area pt-100">
    <div class="container" id="editorsCorner">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title section-title-res text-center mb-30">
                    <h2>Editors' PickUps</h2>
                    <p>Collection of books picked up by the editors.</p>
                </div>
            </div>
        </div>
        <div class="tab-active owl-carousel">
            <?php foreach ($newBooks as $book) { ?>
                <div class="tab-total">
                    <!-- single-product-start -->
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="<?php echo site_url() . '/visitor/view_book_details/?isbn='
                                . $book->isbnNo; ?>">
                                <img src="<?php echo base_url() . $book->imageURL; ?>" alt="book" class="primary"/>
                            </a>
                        </div>
                        <div class="product-details text-center">
                            <h4><a href="<?php echo site_url() . '/visitor/view_book_details/?isbn='
                                    . $book->isbnNo; ?>"><?php echo $book->title; ?></a></h4>
                            <div class="product-price">
                                <ul>
                                    <li>$<?php echo $book->price; ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-link">
                            <div class="product-button">
                                <button type="button" id="<?php echo $book->isbnNo; ?>"
                                        class="btn btn-default"
                                        onclick="addToCart(this.id)">Add to Cart
                                </button>
                            </div>
                            <div class="add-to-link">
                                <ul>
                                    <li><a href="<?php echo site_url() . '/visitor/view_book_details/?isbn='
                                            . $book->isbnNo; ?>" title="Details"><i class="fa fa-external-link"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- single-product-end -->
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- editor-area-end -->

<!-- banner-area-start -->
<div class="banner-area-5 mtb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-img-2">
                    <a href="#"><img src="<?php echo base_url(); ?>img/banner/5.jpg" alt="banner"/></a>
                    <div class="banner-text">
                        <h3>Books from J.G. Meyer Press</h3>
                        <h2>Discounts up to 50% off</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner-area-end -->

<!-- new releases-area-start -->
<div class="new-book-area  pb-50">
    <div class="container">
        <div class="row" id="newReleases">
            <div class="col-lg-12">
                <div class="section-title section-title-res text-center mb-30">
                    <h2>New Releases</h2>
                    <p>Collection of books newly added to the store. <br> Grab your copy now.</p>
                </div>
            </div>
        </div>
        <div class="tab-active owl-carousel">
            <!-- store the base url to access in the js file -->
            <input type="text" class="hide" id="siteURL" value="<?php echo site_url(); ?>"/>
            <?php foreach ($editorBooks as $book) { ?>
                <div class="tab-total">
                    <!-- single-product-start -->
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="<?php echo site_url() . '/visitor/view_book_details/?isbn='
                                . $book->isbnNo; ?>">
                                <img src="<?php echo base_url() . $book->imageURL; ?>" alt="book" class="primary"/>
                            </a>
                            <div class="product-flag">
                                <ul>
                                    <li><span class="sale">new</span> <br></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-details text-center">
                            <h4><a href="<?php echo site_url() . '/visitor/view_book_details/?isbn='
                                    . $book->isbnNo; ?>"><?php echo $book->title; ?></a></h4>
                            <div class="product-price">
                                <ul>
                                    <li>$<?php echo $book->price; ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-link">
                            <div class="product-button">
                                <button type="button" id="<?php echo $book->isbnNo; ?>"
                                        class="btn btn-default"
                                        onclick="addToCart(this.id)">Add to Cart
                                </button>
                            </div>
                            <div class="add-to-link">
                                <ul>
                                    <li><a href="<?php echo site_url() . '/visitor/view_book_details/?isbn='
                                            . $book->isbnNo; ?>" title="Details"><i class="fa fa-external-link"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- single-product-end -->
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- new releases-area-end -->
<hr></hr>
<!-- banner-area-start -->
<div class="banner-area banner-res-large pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="single-banner">
                    <div class="banner-img">
                        <a href="#"><img src="<?php echo base_url(); ?>img/banner/1.png" alt="Free Shipping"/></a>
                    </div>
                    <div class="banner-text">
                        <h4>Free Shipping</h4>
                        <p>For all orders over $200</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="single-banner">
                    <div class="banner-img">
                        <a href="#"><img src="<?php echo base_url(); ?>img/banner/2.png"
                                         alt="Money Back Guarantee"/></a>
                    </div>
                    <div class="banner-text">
                        <h4>Money Back Guarantee</h4>
                        <p>100% assurance</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 hidden-sm col-xs-12">
                <div class="single-banner">
                    <div class="banner-img">
                        <a href="#"><img src="<?php echo base_url(); ?>img/banner/3.png" alt="Cash on delivery"/></a>
                    </div>
                    <div class="banner-text">
                        <h4>Cash on Delivery</h4>
                        <p>*T&C Apply</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="single-banner mrg-none-xs" id="contactUs">
                    <div class="banner-img">
                        <a href="#"><img src="<?php echo base_url(); ?>img/banner/4.png" alt="Customer Support"/></a>
                    </div>
                    <div class="banner-text">
                        <h4>Customer Support</h4>
                        <p>Call us : +9411-22-12345</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner-area-end -->
<?php include 'footer.php' ?>
