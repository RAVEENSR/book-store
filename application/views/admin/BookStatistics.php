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
                        <li><a href="#" class="active">Book Statistics</a></li>
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
                    <div class="product-info-area ">
                        <div class="row mb-50">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#stats1" data-toggle="tab"
                                                          aria-expanded="true">Top 5 Books</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="stats1">
                                        <div class="chartContainer">
                                            <!-- store the base url to access in the js file -->
                                            <input type="text" class="hide" id="siteURL" value="<?php echo site_url(); ?>"/>
                                            <div>
                                                <canvas id="topBooks"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-50">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#stats2" data-toggle="tab"
                                                          aria-expanded="true">Top 5 Main Book Categories</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="stats2">
                                        <div class="chartContainer">
                                            <div>
                                                <canvas id="topCategories"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-50">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#stats3" data-toggle="tab"
                                                          aria-expanded="true">Top 5 Sub Book Categories</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="stats3">
                                        <div class="chartContainer">
                                            <div>
                                                <canvas id="topSubCategories"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-50">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#stats4" data-toggle="tab"
                                                          aria-expanded="true">Total book views in past 30 days</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="stats4">
                                        <div class="chartContainer">
                                            <div>
                                                <canvas id="topSingleBookViews"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- book stat chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bookStatChart.js"></script>

    <script>// loads the graphs
        loadStatGraphs();
    </script>
<?php } ?>
<!-- product-main-area-end -->
<?php include 'Footer.php' ?>
