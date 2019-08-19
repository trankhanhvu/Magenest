define([
    'ko',
    'uiComponent',
    'mage/url',
    'mage/storage',
    'jquery'
], function (ko, Component, urlBuilder,storage,$) {
    'use strict';

    var notificationUrl = urlBuilder.build('/notification/customer/notificationofcustomer');

    var notificationlist = $.ajax({
        url: notificationUrl,
        type: 'POST',
        showLoader:true,
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

    return Component.extend({

        defaults: {
            template: 'Magenest_PromoNotification/notification',
        },
        viewed : ko.observable(notificationlist['viewed']),
        notilist : ko.observableArray(notificationlist),
        initialize:function(){
            this._super();
            var self = this;
            return this;
        },

        initObservable: function(){
            this._super();
            this.observe({'notilist' : notificationlist});
            return this;
        },
        deleteNotification: function (notification) {


            var deleteUrl = urlBuilder.build('/notification/customer/deletenotification');
            console.log(deleteUrl);
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                dataType: 'json',
                data: {
                    entity_id: notification['entity_id']
                },
                complete: function(response) {
                    console.log('success');
                    console.log(response);
                },
                error: function () {
                    console.log('fail');
                    console.log('Error happens. Try again.');
                }
            });

            this.notilist.remove(notification);

            if (notification['viewed'] == null)
            {
                var countUnread = 0;
                for(var i = 0 ; i < this.notilist().length ; i++)
                {
                    if(this.notilist()[i]['viewed'] === null)
                    {
                        countUnread++;
                    }
                }

                $("strong").each(function (index) {
                    if ($(this).text().search("My Notification") != -1 ) {
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
            }
        },
        markasreadNotification: function (notification) {
            for(var i = 0 ; i < this.notilist().length ; i++)
            {
                if(this.notilist()[i]['entity_id'] === notification['entity_id'])
                {

                    this.notilist()[i]['viewed'] = 1;
                    break;
                }
            }

            var countUnread = 0;
            for(var i = 0 ; i < this.notilist().length ; i++)
            {
                if(this.notilist()[i]['viewed'] === null)
                {
                    countUnread++;
                }
            }

            $("strong").each(function (index) {
                if ($(this).text().search("My Notification") != -1 ) {
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

            var markUrl = urlBuilder.build('/notification/customer/markasview');
            console.log(markUrl);
            $.ajax({
                url: markUrl,
                type: 'POST',
                dataType: 'json',
                data: {
                    entity_id: notification['entity_id']
                },
                complete: function(response) {
                    console.log('success');
                    console.log(response);
                },
                error: function () {
                    console.log('fail');
                    console.log('Error happens. Try again.');
                }
            });

            $('.unread').css('background-color' , 'white');
            $('.unread2').remove();
        },
    });
});