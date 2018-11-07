function validateMainCategoryForm() {
    var category1 = $('#mainCat1')[0].value;
    var form = $('#mainCategoryForm')[0];
    var alertSection = $('#mainCategoryAlertSection');
    var siteURL = $('#siteURL')[0].value;
    var data = [];
    // get the category values
    var formData = form.elements['mainCategory[]'];
    for (var i = 0, len = formData.length; i < len; i++) {
        if (formData[i].value !== '') {
            data.push(formData[i].value);
        }
    }
    // check for first category field whether it is empty
    if (category1 === '') {
        alertSection.html('<div class="alert alert-danger">"Main Category 1" field cannot be blank.</div>');
    } else {
        $.ajax({
            url: siteURL + "/administrator/createMainCategory",
            type: "POST",
            data: {categories: data},
            success: function (data) {
                console.log(data);
                alertSection.html('<div class="alert alert-success">Successfully added categories.</div>');
            },
            error: function (XHR, status, response) {
                console.log(XHR.response);
                console.log(status);
                console.log(response);
                alertSection.html('<div class="alert alert-danger">Error occurred' +
                    ' when adding categories.</div>');
            }
        });
    }
}