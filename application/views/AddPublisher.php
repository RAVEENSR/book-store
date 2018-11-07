<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'AdminHeader.php' ?>
    <!-- js file for Add main category -->
    <script src="<?php echo base_url(); ?>js/addPublisher.js"></script>
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="<?php echo site_url(); ?>/administrator/loadAdminPortal">Home</a></li>
                            <li><a href="#" class="active">Add Publisher</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- add-publisher-area-start -->
    <div class="user-login-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-title text-center mb-30">
                        <h2>Add Publisher</h2>
                        <p>Enter the details of the Publisher</p>
                    </div>
                </div>
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <div class="login-form">
                        <form id="publisherForm">
                            <div class="form-group">
                                <label for="publisherName">Publisher Name<span>*</span></label>
                                <input type="text" class="form-control" id="publisherName" placeholder="Ex: Elsevier"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="contactNo">Contact Number</label>
                                <input type="text" class="form-control" id="contactNo" placeholder="Ex: +94112212345"/>
                            </div>
                            <div class="single-login single-login-2" id="addPublisherBtn">
                                <a href="javascript:validatePublisherForm()">Add</a>
                            </div>
                            <!-- store the base url to access in the js file -->
                            <input type="text" class="hide" id="siteURL" value="<?php echo site_url(); ?>"/>
                            <div id="publisherAlertSection"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add-publisher-area-end -->
<?php include 'AdminFooter.php' ?>