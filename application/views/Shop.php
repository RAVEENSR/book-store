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
                        <li><a href="#">Home</a></li>
                        <li><a href="#" class="active">shop</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs-area-end -->
<!--    <div class="panel-group accordion-group" role="tablist" aria-multiselectable="true">-->
<!--        <div class="panel">-->
<!--            <div class="panel-heading" role="tab">-->
<!--                <a role="button" data-toggle="collapse" data-parent=".accordion-group" href="#100">-->
<!--                    <div class="pull-right fa fa-chevron-down" id="tgl9d5343b33bb84d89870087244438d179"></div>-->
<!--                    <h4 class="panel-title">Antiques &amp; Collectibles</h4>-->
<!--                </a>-->
<!--            </div>-->
<!--            <div id="100" class="panel-collapse collapse" role="tabpanel" >-->
<!--                <div class="panel-body">-->
<!--                    <p>-->
<!--                        <a href="/Store/Browse?Nc=1&Ns=102">Art</a><br />-->
<!--                        <a href="/Store/Browse?Nc=1&Ns=203">Books</a><br />-->
<!--                        <a href="/Store/Browse?Nc=1&Ns=328">Clocks &amp; Watches</a><br />-->
<!--                        <a href="/Store/Browse?Nc=1&Ns=334">Coins, Currency &amp; Medals</a><br />-->
<!--                        <a href="/Store/Browse?Nc=1&Ns=624">Firearms &amp; Weapons</a><br />-->
<!--                    </p>-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->



<!-- shop-main-area-start -->
<div class="shop-main-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="shop-left">
                    <div class="left-title mb-20">
                        <h4>Book Categories</h4>
                    </div>
                    <?php for ($x=1; $x<= 3; $x++) { ?>
                    <div class="left-menu mb-30">
                        <div class="panel">
                            <div class="panel-heading">
                                <a role="button" data-toggle="collapse" href="#100">
                                    <div class="pull-right fa fa-chevron-down"></div>
                                    <h4 class="panel-title">Antiques &amp; Collectibles</h4>
                                </a>
                            </div>
                            <div id="100" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>
                                        <a href="/Store/Browse?Nc=1&Ns=102">Art</a><br/>
                                        <a href="/Store/Browse?Nc=1&Ns=203">Books</a><br/>
                                        <a href="/Store/Browse?Nc=1&Ns=328">Clocks &amp; Watches</a><br/>
                                        <a href="/Store/Browse?Nc=1&Ns=334">Coins, Currency &amp; Medals</a><br/>
                                        <a href="/Store/Browse?Nc=1&Ns=624">Firearms &amp; Weapons</a><br/>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <div class="section-title-5 ">
                    <h2>Book Results</h2>
                </div>
                <div class="toolbar mb-30">
                    <div class="shop-tab">
                        <div class="tab-3">
                            <ul>
                                <li class="active"><a href="#th" data-toggle="tab"><i class="fa fa-th-large"></i>Grid</a></li>
                                <li><a href="#list" data-toggle="tab"><i class="fa fa-bars"></i>List</a></li>
                            </ul>
                        </div>
                        <div class="list-page">
                            <p>Items 1-9 of 11</p>
                        </div>
                    </div>
                </div>
                <!-- tab-area-start -->
                <div class="tab-content">
                    <div class="tab-pane active" id="th">
                        <div class="row">
                            <?php for ($x=1; $x<= 16; $x++) { ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <!-- single-product-start -->
                                <div class="product-wrapper mb-40">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="<?php echo base_url();?>img/product/1.jpg" alt="book" class="primary" />
                                        </a>
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
                    <div class="tab-pane fade" id="list">
                        <?php for ($x=1; $x<= 16; $x++) { ?>
                        <!-- single-shop-start -->
                        <div class="single-shop mb-30">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="product-wrapper-2">
                                        <div class="product-img">
                                            <a href="#">
                                                <img src="img/product/1.jpg" alt="book" class="primary" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="product-wrapper-content">
                                        <div class="product-details">
                                            <h4><a href="#">Crown Summit</a></h4>
                                            <h5><a href="#">By abc author</a></h5>
                                            <div class="product-price">
                                                <ul>
                                                    <li>$36.00</li>
                                                </ul>
                                            </div>
                                            <p>The sporty Joust Duffle Bag can't be beat - not in the gym, not on the luggage carousel, not anywhere. Big enough to haul a basketball or soccer ball and some sneakers with plenty of room to spare,...											</p>
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
                    <div class="list-page-2">
                        <p>Items 1-16 of 16</p>
                    </div>
                    <div class="page-number">
                        <ul>
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#" class="angle"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- pagination-area-end -->
            </div>
        </div>
    </div>
</div>
<!-- shop-main-area-end -->
<?php include 'Footer.php' ?>