define([
    'ko',
    'uiComponent',
    'mage/url',
    'mage/storage',
    'Magento_Customer/js/customer-data'
], function (ko, Component, urlBuilder,storage,customerData) {
    'use strict';


    var getCustomerInfo = function () {
        var customer = customerData.get('customer');

        return customer();
    };

    console.log(getCustomerInfo());

    return Component.extend({

        defaults: {
            template: 'Magenest_Frontend/editaccount',
        },
        productList: ko.observableArray([]),


        /*initialize:function(){
            this._super();

            return this;
        },*/
        initObservable: function(){
            this._super();
            this.observe({
                'name': ''
            });
            return this;
        },

        getProduct: function () {

            var self = this;
            self.productList([]);
            var serviceUrl = urlBuilder.build('frontend/index/account?name='+self.name());

            return storage.post(
                serviceUrl,
                ''
            ).done(
                function (response) {
                    var a = JSON.parse(response);
                    for (var i = 0; i<a.length;i++)
                    {
                        self.productList.push(JSON.parse(JSON.stringify(a[i])));
                    }
                }
            ).fail(
                function (response) {
                    alert('No movie found !!!');
                }
            );
        },

    });
});