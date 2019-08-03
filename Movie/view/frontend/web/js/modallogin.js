require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function($,modal)
    {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: 'Login Form',
            buttons: []
        };

        var popup = modal(options, $('#popup-modal'));

        $(".button3").click(function () {
            $('#popup-modal').modal('openModal');
        })

    }
);