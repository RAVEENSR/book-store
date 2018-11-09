/*
* Adds an item to cart
* */
function addToCart(bookId) {
    if (bookId) {
        var data;
        if($('#quantity').length) {
            var quantity = $('#quantity')[0].value;
            data = {bookId: bookId, quantity: quantity};
        } else {
            data = {bookId: bookId}
        }

        var siteURL = $('#siteURL')[0].value;

        $.ajax({
            url: siteURL + "/visitor/addToCart",
            type: "POST",
            data: data,
            success: function (data) {
                var flag = $.parseJSON(data);
                if (flag === 1) {
                    alert('Book Added to the Cart Successfully');
                } else if(flag === 2) {
                    alert('Book is already available in the cart');
                }else {
                    alert('Error occurred when adding the book into the cart');
                }
            },
            error: function (XHR, status, response) {
                console.log(XHR.response);
                console.log(status);
                console.log(response);
                alert('Error occurred when adding the book into the cart');
            }
        });
    }
}