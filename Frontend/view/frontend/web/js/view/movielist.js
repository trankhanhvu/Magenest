define([
    'ko',
    'uiComponent',
    'mage/url',
    'mage/storage',
    'jquery'
], function (ko, Component, urlBuilder,storage,$) {
    'use strict';

    var customurl = urlBuilder.build('frontend/index/movie?name=haha');
    console.log(customurl);

     var s = $.ajax({
            url: customurl,
            type: 'POST',
            async: false,
            dataType: 'json',
            complete: function(response) {
                console.log('success');
            },
            error: function () {
                console.log('fail');
                console.log('Error happens. Try again.');
            }
        }).responseJSON;
     console.log(s);

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
            this.observe({'name' : '',
            'productList' : s});
            console.log(this.productList);
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