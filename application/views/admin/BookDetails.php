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
                        <li><a href="<?php echo site_url(); ?>/administrator/loadAdminPortal">Home</a></li>
                        <li><a href="#" class="active">Book Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs-area-end -->
<?php if (isset($errorMessage)) {
    echo "<h3>" . $errorMessage . "</h3>";
} else { ?>
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
                                        <li data-thumb="<?php echo base_url().$book->imageURL;?>">
                                            <img src="<?php echo base_url().$book->imageURL;?>" alt="bookImage"/>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                                <div class="product-info-main">
                                    <div class="page-title">
                                        <h1><?php echo $book->title;?></h1>
                                    </div>
                                    <div class="product-attribute">
                                        <span class="value"><?php echo $book->categoryTitle;?></span>
                                        <span class="value"><i class="fa fa-angle-right"></i></span>
                                        <span class="value"><?php echo $book->subCategoryTitle;?></span>
                                    </div>
                                    <div class="product-info-price">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td align="right" class=""><strong>Author:</strong></td>
                                                <td><?php echo $book->authorName;?></td>
                                            </tr>
                                            <tr>
                                                <td align="right" class=""><strong>ISBN:</strong></td>
                                                <td><?php echo $book->isbnNo;?></td>
                                            </tr>
                                            <tr>
                                                <td align="right" class=""><strong>Edition:</strong></td>
                                                <td><?php echo $book->edition;?></td>
                                            </tr>
                                            <tr>
                                                <td align="right" class=""><strong>Publisher:</strong></td>
                                                <td><?php echo $book->publisherName;?></td>
                                            </tr>
                                            <tr>
                                                <td align="right" class=""><strong>Available Qty:</strong></td>
                                                <td><?php echo $book->availableCopies;?></td>
                                            </tr>
                                            <tr>
                                                <td align="right" class=""><strong>Price:</strong></td>
                                                <td>$<?php echo $book->price;?></td>
                                            </tr>
                                            </tbody>
                                        </table>
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
                                    <li class="active"><a href="#description" data-toggle="tab"
                                                          aria-expanded="true">Description</a></li>
                                    <li><a href="#stats" data-toggle="tab" aria-expanded="true">Statistics</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="description">
                                        <div class="valu">
                                            <p><?php echo $book->description;?></p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="stats">
                                        <div class="chartContainer">
                                            <h2>Number of views in last 5 days</h2>
                                            <div>
                                                <canvas id="canvas"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-4 col-xs-12"></div>
                        </div>
                    </div>
                    <!-- product-info-area-end -->
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- book stat chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>js/bookStatChart.js"></script>
<!-- product-main-area-end -->
<?php include 'Footer.php' ?>
