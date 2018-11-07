<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'AdminHeader.php' ?>

<!-- breadcrumbs-area-start -->
<div class="breadcrumbs-area mb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs-menu">
                    <ul>
                        <li><a href="#">Admin Home</a></li>
                        <li><a href="#" class="active">Admin Search</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- admin-search-area-start -->
    <div class="user-login-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-title text-center mb-30">
                        <h2>Book Search</h2>
                        <p>Enter the details of the book</p>
                    </div>
                </div>
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#Title" data-toggle="tab">By Title</a></li>
                        <li><a href="#Author" data-toggle="tab">By Author</a></li>
                        <li><a href="#TitleAuthor" data-toggle="tab">By Title and Author</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="Title">
                            <div class="login-form">
                                <form>
                                    <div class="form-group dynamic-main-category">
                                        <label for="formGroupExampleInput">Title</label>
                                        <input type="text" class="form-control" name="mainCategory[]"
                                               placeholder="Enter title of the book" />
                                    </div>
                                    <div class="single-login single-login-2">
                                        <a href="#" onclick="document.forms[0].submit();" >Search</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="Author">
                            <div class="login-form">
                                <form>
                                    <div class="form-group dynamic-main-category">
                                        <label for="formGroupExampleInput">Author</label>
                                        <input type="text" class="form-control" name="mainCategory[]"
                                               placeholder="Enter name of the author"/>
                                    </div>
                                    <div class="single-login single-login-2">
                                        <a href="#" onclick="document.forms[0].submit();" >Search</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="TitleAuthor">
                            <div class="login-form">
                                <form>
                                    <div class="form-group dynamic-main-category">
                                        <label for="formGroupExampleInput">Title</label>
                                        <input type="text" class="form-control" name="mainCategory[]"
                                               placeholder="Enter title of the book" />
                                    </div>
                                    <div class="form-group dynamic-main-category">
                                        <label for="formGroupExampleInput">Author</label>
                                        <input type="text" class="form-control" name="mainCategory[]"
                                               placeholder="Enter name of the author"/>
                                    </div>
                                    <div class="single-login single-login-2">
                                        <a href="#" onclick="document.forms[0].submit();" >Search</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- admin-search-area-end -->

<?php include 'AdminFooter.php' ?>