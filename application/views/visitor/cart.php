<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'header.php' ?>
    <!-- js file for Add to Cart -->
    <script src="<?php echo base_url(); ?>js/manageCart.js"></script>
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="<?php echo site_url(); ?>">Home</a></li>
                            <li><a href="#" class="active">Shopping Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- entry-header-area-start -->
    <div class="entry-header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="entry-header-title">
                        <h2>Shopping Cart</h2>
                        <?php if (isset($errorMessage)) {
                            echo "<h3>" . $errorMessage . "</h3>";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- entry-header-area-end -->
<?php if (!isset($errorMessage)) { ?>
    <!-- cart-main-area-start -->
    <div class="cart-main-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form id="cartForm" action="<?php echo site_url() . '/visitor/update_cart' ?>" method="post">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-thumbnail">Book</th>
                                    <th class="product-name">Title</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($userCart)) {
                                    foreach ($userCart as $item) { ?>
                                        <tr id="row-<?php echo $item['isbn'] ?>">
                                            <td class="product-thumbnail">
                                                <a href="<?php echo site_url() . '/visitor/view_book_details/?isbn=' . $item['isbn'];
                                                ?> ">
                                                    <img src="<?php echo base_url() . $item['imgURL']; ?>" alt="book"/>
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a href="<?php echo site_url() . '/visitor/view_book_details/?isbn=' . $item['isbn'];
                                                ?>"><?php echo $item['title']; ?>
                                                </a>
                                            </td>
                                            <td class="product-price"><span
                                                        class="amount">$<?php echo $item['price']; ?></span>
                                            </td>
                                            <td class="product-quantity">
                                                <input type="number" name="quantity[]"
                                                       value="<?php echo $item['qty']; ?>">
                                                <!-- store the book id -->
                                                <input type="text" class="hide" name="isbn[]"
                                                       value="<?php echo $item['isbn'];
                                                       ?>"/>
                                            </td>
                                            <td class="product-subtotal">$<?php echo $item['total']; ?></td>
                                            <td class="product-remove"><a href="<?php echo site_url();
                                                ?>/visitor/remove_cart_item?bookId=<?php echo $item['isbn'] ?>"><i
                                                            class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <div class="buttons-cart mb-30">
                        <ul>
                            <li><a href="#" onclick="document.getElementById('cartForm').submit();">Update
                                    Cart</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="cart_totals">
                        <table>
                            <tbody>
                            <tr class="order-total">
                                <th>Total</th>
                                <td>
                                    <strong>
                                        <span class="amount">$<?php echo $totalPrice ?></span>
                                    </strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="wc-proceed-to-checkout">
                            <a href="#">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area-end -->
<?php } ?>
<?php include 'footer.php' ?>