function sayHello()
{
    window.alert('Hello World');
}

require([
        'jquery',
        'Magento_Ui/js/modal/alert'
    ],
    function($,alert) {
        $(".button2").click(function ()
        {
            alert
            ({
                title: 'Test Frontend',
                content: 'Hello World',
                actions: {
                    always: function(){
                    }
                }
            });
        })
    });

