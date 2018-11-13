<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'Header.php' ?>
<!-- js file for Add to Cart -->
<script src="<?php echo base_url(); ?>js/manageCart.js"></script>
<!-- breadcrumbs-area-start -->
<div class="breadcrumbs-area mb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs-menu">
                    <ul>
                        <li><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li><a href="#" class="active">Shop</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shop-main-area-start -->
<div class="shop-main-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="shop-left">
                    <div class="left-title mb-20">
                        <h4>Book Categories</h4>
                        <!-- store the base url to access in the js file -->
                        <input type="text" class="hide" id="siteURL" value="<?php echo site_url(); ?>"/>
                    </div>
                    <div style="height: 500px; overflow-y:scroll;">
                        <?php if (isset($categories)) {
                            foreach ($categories as $mainCategory) { ?>
                                <div class="left-menu mb-30">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <a role="button" data-toggle="collapse"
                                               href="#<?php echo $mainCategory[0]->categoryId
                                               ?>">
                                                <div class="pull-right fa fa-chevron-down"></div>
                                                <h4 class="panel-title"><?php echo $mainCategory[0]->categoryTitle; ?></h4>
                                            </a>
                                        </div>
                                        <div id="<?php echo $mainCategory[0]->categoryId ?>"
                                             class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>
                                                    <?php if (isset($mainCategory[1])) foreach ($mainCategory[1] as $subCategory) { ?>
                                                    <a href="<?php echo site_url(); ?>/visitor/viewBooksByCategory?mainCatId=<?php echo $mainCategory[0]->categoryId ?>&subCatId=<?php echo $subCategory->subCategoryId ?>">
                                                        <?php echo $subCategory->subCategoryTitle ?>
                                                    </a><br/>
                                                </p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <?php if (isset($errorMessage)) {
                    echo "<h3>" . $errorMessage . "</h3>";
                } else { ?>
                    <div class="section-title-5 ">
                        <h2>Book Results<?php
                            if (isset($mainCategoryTitle)) {
                                echo ' for Category: ' . $mainCategoryTitle;
                            }
                            if (isset($subCategoryTitle)) {
                                echo ' and Sub Category: ' . $subCategoryTitle;
                            } ?></h2>
                    </div>
                    <div class="toolbar mb-30">
                        <div class="shop-tab">
                            <div class="tab-3">
                                <ul>
                                    <li class="active"><a href="#th" data-toggle="tab"><i
                                                    class="fa fa-th-large"></i>Grid</a></li>
                                    <li><a href="#list" data-toggle="tab"><i class="fa fa-bars"></i>List</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- tab-area-start -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="th">
                            <div class="row">
                                <?php foreach ($result as $book) { ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <!-- single-product-start -->
                                        <div class="product-wrapper mb-40">
                                            <div class="product-img">
                                                <a href="<?php echo site_url() . '/visitor/viewBookDetails/?isbn='
                                                    . $book->isbnNo; ?>">
                                                    <img src="<?php echo base_url() . $book->imageURL; ?>"
                                                         alt="book" class="primary resizeImage"/>
                                                </a>
                                            </div>
                                            <div class="product-details text-center">
                                                <span class="text"><h4>
                                                    <a href="<?php echo site_url() . '/visitor/viewBookDetails/?isbn='
                                                        . $book->isbnNo; ?>"><?php echo $book->title; ?></a></h4></span>
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
                                                        <li>
                                                            <a href="<?php echo site_url() . '/visitor/viewBookDetails/?isbn='
                                                                . $book->isbnNo; ?>" title="Details"><i
                                                                        class="fa fa-external-link"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-end -->
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list">
                            <?php foreach ($result as $book) { ?>
                                <!-- single-shop-start -->
                                <div class="single-shop mb-30">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="product-wrapper-2">
                                                <div class="product-img">
                                                    <a href="<?php echo site_url() . '/visitor/viewBookDetails/?isbn='
                                                        . $book->isbnNo; ?>">
                                                        <img src="<?php echo base_url() . $book->imageURL; ?>"
                                                             alt="book" class="primary"/>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="product-wrapper-content">
                                                <div class="product-details">
                                                    <h4>
                                                        <a href="<?php echo site_url() . '/visitor/viewBookDetails/?isbn='
                                                            . $book->isbnNo; ?>"><?php echo $book->title; ?></a>
                                                    </h4>
                                                    <h5>
                                                        <a href="<?php echo site_url() . '/visitor/viewBookDetails/?isbn='
                                                            . $book->isbnNo; ?>">By <?php echo " " . $book->authorName; ?></a>
                                                    </h5>
                                                    <div class="product-price">
                                                        <ul>
                                                            <li>$<?php echo $book->price; ?></li>
                                                        </ul>
                                                    </div>
                                                    <p><?php echo $book->description; ?></p>
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
                                                            <li>
                                                                <a href="<?php echo site_url() . '/visitor/viewBookDetails/?isbn='
                                                                    . $book->isbnNo; ?>" title="Details"><i
                                                                            class="fa fa-external-link"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-shop-end -->
                            <?php } ?>
                        </div>
                    </div>
                    <!-- tab-area-end -->
                    <!-- pagination-area-start -->
                    <div class="pagination-area mt-50">
                        <div class="page-number">
                            <ul class="pagination ">
                                <?php if (isset($first)) { ?>
                                    <li class="page-item ">
                                        <a class="page-link" href="<?php echo $first; ?>">First</a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($previous)) { ?>
                                    <li class="page-item ">
                                        <a class="page-link" href="<?php echo $previous; ?>">Previous</a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($next)) { ?>
                                    <li class="page-item ">
                                        <a class="page-link" href="<?php echo $next; ?>">Next</a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($last)) { ?>
                                    <li class="page-item ">
                                        <a class="page-link" href="<?php echo $last; ?>">Last</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
                <!-- pagination-area-end -->
            </div>
        </div>
    </div>
</div>
<!-- shop-main-area-end -->
<?php include 'Footer.php' ?>
