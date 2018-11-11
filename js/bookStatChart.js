function loadSingleBookStats($isbn) {
    var siteURL = $('#siteURL')[0].value;
    $.ajax({
        url: siteURL + '/administrator/get_views_for_book_for_last_days',
        type: "post",
        data: {isbn: $isbn, numberOfDays: 30},
        success: function (data) {
            var flag = $.parseJSON(data).status;
            if (flag === '1') {
                var dates = $.parseJSON(data).dates;
                var views = $.parseJSON(data).views;

                var barChart = new Chart($('#singleBookViews')[0], {
                    type: 'bar',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: "Book Views",
                            borderColor: "#000000",
                            borderWidth: 3,
                            data: views
                        }],
                    }
                });
            } else {
                alert('Error occurred when loading the statistics graph');
            }
        },
        error: function (XHR, status, response) {
            console.log(XHR.response);
            console.log(status);
            console.log(response);
            alert('Error occurred when validating the isbn number');
        }
    });
}

function loadStatGraphs() {
    var siteURL = $('#siteURL')[0].value;
    $.ajax({
        url: siteURL + '/administrator/get_stat_graph_info',
        type: "post",
        data: {numberOfDays: 30},
        success: function (data) {
            var flag = $.parseJSON(data).status;
            if (flag === '1') {
                var topBooks = $.parseJSON(data).topBooks;
                var topBookViews = $.parseJSON(data).topBookViews;

                var topCategories = $.parseJSON(data).topCategories;
                var topCategoryViews = $.parseJSON(data).topCategoryViews;

                var topSubCategories = $.parseJSON(data).topSubCategories;
                var topSubCategoryViews = $.parseJSON(data).topSubCategoryViews;

                var totalViews = $.parseJSON(data).totalViews;
                var dates = $.parseJSON(data).dates;

                // bar chart for top books
                var barChart1 = new Chart($('#topBooks')[0], {
                    type: 'bar',
                    data: {
                        labels: topBooks,
                        datasets: [{
                            label: "Top Books",
                            borderColor: "#000000",
                            borderWidth: 3,
                            data: topBookViews
                        }],
                    }
                });
                /*--------------------------------------------------------------------------------------------------------------------*/
                // bar chart for top categories
                var barChart2 = new Chart($('#topCategories')[0], {
                    type: 'bar',
                    data: {
                        labels: topCategories,
                        datasets: [{
                            label: "Main Categories",
                            borderColor: "#000000",
                            borderWidth: 3,
                            data: topCategoryViews
                        }],
                    }
                });
                /*--------------------------------------------------------------------------------------------------------------------*/
                // bar chart for top subCategories
                var barChart3 = new Chart($('#topSubCategories')[0], {
                    type: 'bar',
                    data: {
                        labels: topSubCategories,
                        datasets: [{
                            label: "Sub Categories",
                            borderColor: "#000000",
                            borderWidth: 3,
                            data: topSubCategoryViews
                        }],
                    }
                });
                /*---------------------------------------------------------------------------------------------------------------------*/
                // line chart for total book views
                var lineChart = new Chart($('#topSingleBookViews')[0], {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: "Book Views",
                            borderColor: "#000000",
                            borderWidth: 3,
                            data: totalViews
                        }],
                    }
                });
            } else {
                alert('Error occurred when loading the statistics graphs');
            }
        },
        error: function (XHR, status, response) {
            console.log(XHR.response);
            console.log(status);
            console.log(response);
            alert('Error occurred when loading the statistics graphs');
        }
    });
}