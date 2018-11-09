<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'Header.php' ?>

<!-- slider-area-start -->
<div class="slider-area mt-30">
    <div class="container">
        <div class="slider-active owl-carousel">
            <div class="single-slider pt-100 pb-145 bg-img" style="background-image:url(<?php echo base_url();?>img/slider/13.jpg);">
                <div class="row">
                    <div class="col-md-12">
                        <div class="slider-content-3 slider-animated-1 pl-100">
                            <h1>A Game <br>Fuck up</h1>
                            <p class="slider-sale">
                                <span class="sale1">-20%</span>
                                <span class="sale2">
                                            <strong>£80.00</strong>
                                            £60.00
                                        </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider pt-100 pb-145 bg-img" style="background-image:url(<?php echo base_url();?>img/slider/12.jpg);">
                <div class="row">
                    <div class="col-md-12">
                        <div class="slider-content-3 slider-animated-1 pl-100">
                            <h1>Wake The <br>of Thrones</h1>
                            <p class="slider-sale">
                                <span class="sale1">-20%</span>
                                <span class="sale2">
                                            <strong>£80.00</strong>
                                            £60.00
                                        </span>
                            </p>
                            <a href="#">Shop now!</a>
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
            <?php for ($x=1; $x<= 6; $x++) { ?>
            <div class="tab-total">
                <!-- single-product-start -->
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <img src="<?php echo base_url();?>img/product/1.jpg" alt="book" class="primary" />
                        </a>
                        <div class="product-flag">
                            <ul>
                                <li><span class="sale">new</span> <br></li>
                                <li><span class="discount-percentage">-5%</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-details text-center">
                        <h4><a href="#">Joust Duffle Bag</a></h4>
                        <div class="product-price">
                            <ul>
                                <li>$60.00</li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-link">
                        <div class="product-button">
                            <a href="#" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        <div class="add-to-link">
                            <ul>
                                <li><a href="product-details.html" title="Details"><i class="fa fa-external-link"></i></a></li>
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
                    <a href="#"><img src="<?php echo base_url();?>img/banner/5.jpg" alt="banner" /></a>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title section-title-res text-center mb-30">
                    <h2>New Releases</h2>
                    <p>Collection of books newly added to the store. <br> Grab your copy now.</p>
                </div>
            </div>
        </div>
        <div class="tab-active owl-carousel">
            <?php for ($x=1; $x<= 5; $x++) { ?>
                <div class="tab-total">
                    <!-- single-product-start -->
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="#">
                                <img src="<?php echo base_url();?>img/product/1.jpg" alt="book" class="primary" />
                            </a>
                            <div class="product-flag">
                                <ul>
                                    <li><span class="sale">new</span> <br></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-details text-center">
                            <h4><a href="#">Joust Duffle Bag</a></h4>
                            <div class="product-price">
                                <ul>
                                    <li>$60.00</li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-link">
                            <div class="product-button">
                                <a href="#" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            <div class="add-to-link">
                                <ul>
                                    <li><a href="product-details.html" title="Details"><i class="fa fa-external-link"></i></a></li>
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
                        <a href="#"><img src="<?php echo base_url();?>img/banner/1.png" alt="Free Shipping" /></a>
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
                        <a href="#"><img src="<?php echo base_url();?>img/banner/2.png" alt="Money Back Guarantee" /></a>
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
                        <a href="#"><img src="<?php echo base_url();?>img/banner/3.png" alt="Cash on delivery" /></a>
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
                        <a href="#"><img src="<?php echo base_url();?>img/banner/4.png" alt="Customer Support" /></a>
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
<?php include 'Footer.php' ?>
