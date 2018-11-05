<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'Header.php' ?>
<!-- breadcrumbs-area-start -->
<div class="breadcrumbs-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs-menu">
                    <ul>
                        <li><a href="https://d29u17ylf1ylz9.cloudfront.net/koparion-v1/product-details.html#">Home</a></li>
                        <li><a href="https://d29u17ylf1ylz9.cloudfront.net/koparion-v1/product-details.html#" class="active">product-details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs-area-end -->
<!-- product-main-area-start -->
<div class="product-main-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- product-main-area-start -->
                <div class="product-main-area">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="flexslider">
                                <ul class="slides">
                                    <li data-thumb="<?php echo base_url();?>img/product/1.jpg">
                                        <img src="<?php echo base_url();?>img/product/1.jpg" alt="woman" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                            <div class="product-info-main">
                                <div class="page-title">
                                    <h1>Savvy Shoulder Tote</h1>
                                </div>
                                <div class="product-attribute">
                                    <span class="value">Technology</span>
                                    <span class="value"><i class="fa fa-angle-right"></i></span>
                                    <span class="value">Computer Science</span>
                                </div>
                                <div class="product-info-price">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td align="right" class=""><strong>Author:</strong></td>
                                            <td>Andersen, Hans Christian</td>
                                        </tr>
                                        <tr>
                                            <td align="right" class=""><strong>ISBN:</strong></td>
                                            <td>205-11110432-534346</td>
                                        </tr>
                                        <tr>
                                            <td align="right" class=""><strong>Edition:</strong></td>
                                            <td>2nd Edition</td>
                                        </tr>
                                        <tr>
                                            <td align="right" class=""><strong>Publisher:</strong></td>
                                            <td>Oreily</td>
                                        </tr>
                                        <tr>
                                            <td align="right" class=""><strong>Price:</strong></td>
                                            <td>$34.00</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="product-add-form">
                                    <form action="https://d29u17ylf1ylz9.cloudfront.net/koparion-v1/product-details.html#">
                                        <div class="quality-button">
                                            <input class="qty" type="number" value="1">
                                        </div>
                                        <a href="#">Add to cart</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product-main-area-end -->
                <!-- product-info-area-start -->
                <div class="product-info-area ">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-12"></div>
                        <div class="col-lg-10 col-md-10 col-sm-4 col-xs-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="https://d29u17ylf1ylz9.cloudfront.net/koparion-v1/product-details
                        .html#Details" data-toggle="tab" aria-expanded="true">Description</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="Description">
                                    <div class="valu">
                                        <p>The sporty Joust Duffle Bag can't be beat - not in the gym, not on the
                                            luggage
                                            carousel, not anywhere. Big enough to haul a basketball or soccer ball and
                                            some
                                            sneakers with plenty of room to spare, it's ideal for athletes with places
                                            to
                                            go.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-12"></div>
                    </div>
                </div>
                <!-- product-info-area-end -->
                <!-- new-book-area-start -->
                <div class="new-book-area mt-60">
                    <div class="section-title text-center mb-30">
                        <h3>You May Also Like</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12"></div>
                        <div class="col-lg-8 col-md-8 col-sm-4 col-xs-12">
                    <div class="tab-active-2 owl-carousel">
                        <?php for ($x=1; $x<= 5; $x++) { ?>
                        <!-- single-product-start -->
                        <div class="product-wrapper">
                            <div class="product-img">
                                <a href="#">
                                    <img src="<?php echo base_url();?>img/product/1.jpg" alt="book" class="primary" />
                                </a>
                            </div>
                            <div class="product-details text-center">
                                <h4><a href="#">Strive Shoulder Pack</a></h4>
                                <div class="product-price">
                                    <ul>
                                        <li>$30.00</li>
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
                        <?php } ?>
                    </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12"></div>
                    </div>
                </div>
                <!-- new-book-area-end -->
            </div>
        </div>
    </div>
</div>
<!-- product-main-area-end -->
<?php include 'Footer.php' ?>
