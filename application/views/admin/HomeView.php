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
                        <li><a href="#">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner-area-start -->
<div class="banner-area banner-res-large pb-50 pt-100 pb-145">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <a href="<?php echo site_url();?>/administrator/loadAddBook">
                <div class="single-banner">
                    <div class="banner-img">
                        <img src="<?php echo base_url();?>img/banner/addBook.png" alt="Add Book" />
                    </div>
                    <div class="banner-text">
                        <h3>Add Book</h3>
                        <p>Add a book to the database.</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <a href="<?php echo site_url();?>/administrator/loadSearchBook">
                <div class="single-banner">
                    <div class="banner-img">
                        <img src="<?php echo base_url();?>img/banner/searchBook.png" alt="Search Book" />
                    </div>
                    <div class="banner-text">
                        <h3>Search Book</h3>
                        <p>Search a book within the database.</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            </div>
        </div>
        <div class="row pt-100 ">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <a href="<?php echo site_url();?>/administrator/loadAddMainCategory">
                <div class="single-banner">
                    <div class="banner-img">
                        <img src="<?php echo base_url();?>img/banner/mainCategory.png" alt="Create Main Category"/>
                    </div>
                    <div class="banner-text">
                        <h3>Create Main Category</h3>
                        <p>Create a main category for books.</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <a href="<?php echo site_url();?>/administrator/loadAddSubCategory">
                <div class="single-banner">
                    <div class="banner-img">
                        <img src="<?php echo base_url();?>img/banner/subCategory.png" alt="Create Sub Category" />
                    </div>
                    <div class="banner-text">
                        <h3>Create Sub Category</h3>
                        <p>Create a sub category for books.</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            </div>
        </div>
        <div class="row pt-100 pb-145">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <a href="<?php echo site_url();?>/administrator/loadAddPublisher">
                    <div class="single-banner">
                        <div class="banner-img">
                            <img src="<?php echo base_url();?>img/banner/publisher.png" alt="Add Publisher" />
                        </div>
                        <div class="banner-text">
                            <h3>Add Publisher</h3>
                            <p>Add a publisher tot the database.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
        </div>
    </div>
</div>
<!-- banner-area-end -->
<?php include 'Footer.php' ?>