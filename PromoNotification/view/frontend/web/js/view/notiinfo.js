require([
    'ko',
    'uiComponent',
    'mage/url',
    'jquery'
], function (ko, Component, urlBuilder, $) {

    urlBuilder.setBaseUrl('http://127.0.0.1/ma2');
    var notificationUrl = urlBuilder.build('/notification/customer/notificationofcustomer');
    console.log(notificationUrl);

    var notificationlist = $.ajax({
        url: notificationUrl,
        type: 'POST',
        showLoader: true,
        async: false,
        dataType: 'json',
        complete: function (response) {

        },
        error: function () {
            console.log('fail');
            console.log('Error happens. Try again.');
        }
    }).responseJSON;

    var countUnread = 0;
    for (var i = 0; i < notificationlist.length; i++) {
        if (notificationlist[i]['viewed'] === null) {
            countUnread++;
        }
    }

    console.log(countUnread);

    $("a").each(function (index) {
        if ($(this).text() === "My Notification") {
            $(this).html("My Notification  " + "<span style = 'background-color: red;" +
                "border-radius: 50%;" +
                "width: 15px;" +
                "display: inline-block;" +
                "height: 15px;" +
                "text-align: center;" +
                "line-height: 1;" +
                "color: #fff;" +
                "font-weight: bold;'>" + countUnread + " </span>");
        }
    });

    $("strong").each(function (index) {
        if ($(this).text() === "My Notification") {
            $(this).html("My Notification  " + "<span style = 'background-color: red;" +
                "border-radius: 50%;" +
                "width: 15px;" +
                "display: inline-block;" +
                "height: 15px;" +
                "text-align: center;" +
                "line-height: 1;" +
                "color: #fff;" +
                "font-weight: bold;'>" + countUnread + " </span>");
        }
    });
});