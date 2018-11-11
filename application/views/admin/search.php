<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'header.php' ?>

    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="<?php echo site_url(); ?>/administrator/load_admin_portal">Home</a></li>
                            <li><a href="#" class="active">Book Search</a></li>
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
                                <form action="<?php echo site_url(); ?>/administrator/search_book_by_title"
                                      method="POST">
                                    <div class="form-group">
                                        <label for="title">Title<span>*</span></label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="Enter title of the book" required/>
                                    </div>
                                    <div class="single-login single-login-2">
                                        <button type="submit" class="btn btn-default">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="Author">
                            <div class="login-form">
                                <form action="<?php echo site_url(); ?>/administrator/search_books_by_author"
                                      method="POST">
                                    <div class="form-group">
                                        <label for="author">Author<span>*</span></label>
                                        <input type="text" class="form-control" id="author" name="author"
                                               placeholder="Enter name of the author" required/>
                                    </div>
                                    <div class="single-login single-login-2">
                                        <button type="submit" class="btn btn-default">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="TitleAuthor">
                            <div class="login-form">
                                <form action="<?php echo site_url(); ?>/administrator/search_book_by_title_and_author"
                                      method="POST">
                                    <div class="form-group">
                                        <label for="title">Title<span>*</span></label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="Enter title of the book" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Author<span>*</span></label>
                                        <input type="text" class="form-control" id="author" name="author"
                                               placeholder="Enter name of the author" required/>
                                    </div>
                                    <div class="single-login single-login-2">
                                        <button type="submit" class="btn btn-default">Search</button>
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

<?php include 'footer.php' ?>