function validatePublisherForm() {
    var publisherName = $('#publisherName')[0].value;
    var contactNo = $('#contactNo')[0].value;
    var alertSection = $('#publisherAlertSection');
    var siteURL = $('#siteURL')[0].value;
    var data = {};

    if (publisherName === '') {
        alertSection.html('<div class="alert alert-danger">Please enter a "Publisher Name"</div>');
        return;
    }
    if (contactNo === '') {
        alertSection.html('<div class="alert alert-danger">Please enter a "Contact Number"</div>');
        return;
    }

    data['publisherName'] = publisherName;
    data['contactNo'] = contactNo;

    $.ajax({
        url: siteURL + "/administrator/addPublisher",
        type: "POST",
        data: {publisherData : data},
        success: function (data) {
            console.log(data);
            alertSection.html('<div class="alert alert-success">Successfully added the Publisher.</div>');
        },
        error: function (XHR, status, response) {
            console.log(XHR.response);
            console.log(status);
            console.log(response);
            alertSection.html('<div class="alert alert-danger">Error occurred when adding the publisher.</div>');
        }
    });
}