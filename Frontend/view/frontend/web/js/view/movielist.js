define([
    'ko',
    'uiComponent',
    'mage/url',
    'mage/storage',
], function (ko, Component, urlBuilder,storage) {
    'use strict';


    return Component.extend({

        defaults: {
            template: 'Magenest_Frontend/movielist',
        },
        productList: ko.observableArray([]),


        /*initialize:function(){
            this._super();

            return this;
        },*/
        initObservable: function(){
            this._super();
            this.observe('name');

            return this;
        },

        getProduct: function () {

            var self = this;
            self.productList([]);
            var serviceUrl = urlBuilder.build('frontend/index/movie?name='+self.name());

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