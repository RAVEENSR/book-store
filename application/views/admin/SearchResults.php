<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'Header.php' ?>
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="<?php echo site_url(); ?>/administrator/loadAdminPortal">Home</a></li>
                            <li><a href="#" class="active">Search Results</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- search-results-main-area-start -->
    <div class="shop-main-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>Search Results for books<?php
                        if (isset($title)) {
                            echo ' of Title: ' . $title;
                        }
                        if (isset($author)) {
                            echo ' by Author: ' . $author;
                        } ?></h2><br>
                    <?php if (isset($errorMessage)) {
                        echo "<h3>" . $errorMessage . "</h3>";
                    } else { ?>
                        <!-- tab-area-start -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="th">
                                <div class="row">
                                    <?php foreach ($result as $book) { ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <!-- single-product-start -->
                                            <div class="product-wrapper mb-40">
                                                <div class="product-img">
                                                    <a href="<?php echo site_url() . '/administrator/viewBookDetails/?isbn='
                                                        . $book->isbnNo; ?>">
                                                        <img src="<?php echo base_url() . $book->imageURL; ?>"
                                                             alt="book"
                                                             class="primary"/>
                                                    </a>
                                                </div>
                                                <div class="product-details text-center">
                                                    <h4>
                                                        <a href="<?php echo site_url() . '/administrator/viewBookDetails/?isbn='
                                                            . $book->isbnNo; ?>"><?php echo $book->title; ?></a></h4>
                                                    <div class="product-price">
                                                        <ul>
                                                            <li>$<?php echo $book->price; ?></li>
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
    <!-- search-results-main-area-start -->
<?php include 'Footer.php' ?>