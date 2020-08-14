define([
    "jquery",
    'Magento_Ui/js/form/element/abstract',
    'ko'
], function($,AbstractComponent,ko){
    "use strict";

    console.log('hello');

    return AbstractComponent.extend({
        defaults: {
        },
        /*checkedBox : ko.observable(),*/
        initialize : function () {
            this._super();
            this.checkedBox(this.initialValue/2);
            this.source.data.rating = this.initialValue/2;
            this.initialValue = this.source.data.rating;
            console.log(this);

        },
        initObservable: function(){
            this._super();
            this.observe({'checkedBox' : '',
                'checkHover' : [{'rating1' : ko.observable(false),
                                'rating2' :ko.observable(false),
                                'rating3' :ko.observable(false),
                                'rating4' :ko.observable(false),
                                'rating5' :ko.observable(false),}]});
            return this;
        },
        selectRating:function (data) {
            data.source.data.rating = this.checkedBox;
            return true;
        },
        mouseOver : function (data) {
            this.checkHover()[0]['rating1'](true);
        },
        mouseOut :function (data) {
            this.checkHover()[0]['rating1'](false);
        },
        mouseOver2 : function (data) {
            this.checkHover()[0]['rating1'](true);
            this.checkHover()[0]['rating2'](true);
        },
        mouseOut2 :function (data) {
            this.checkHover()[0]['rating1'](false);
            this.checkHover()[0]['rating2'](false);
        },
        mouseOver3 : function (data) {
            this.checkHover()[0]['rating1'](true);
            this.checkHover()[0]['rating2'](true);
            this.checkHover()[0]['rating3'](true);
        },
        mouseOut3 :function (data) {
            this.checkHover()[0]['rating1'](false);
            this.checkHover()[0]['rating2'](false);
            this.checkHover()[0]['rating3'](false);
        },
        mouseOver4 : function (data) {
            this.checkHover()[0]['rating1'](true);
            this.checkHover()[0]['rating2'](true);
            this.checkHover()[0]['rating3'](true);
            this.checkHover()[0]['rating4'](true);
        },
        mouseOut4 :function (data) {
            this.checkHover()[0]['rating1'](false);
            this.checkHover()[0]['rating2'](false);
            this.checkHover()[0]['rating3'](false);
            this.checkHover()[0]['rating4'](false);
        },
        mouseOver5 : function (data) {
            this.checkHover()[0]['rating1'](true);
            this.checkHover()[0]['rating2'](true);
            this.checkHover()[0]['rating3'](true);
            this.checkHover()[0]['rating4'](true);
            this.checkHover()[0]['rating5'](true);
        },
        mouseOut5 :function (data) {
            this.checkHover()[0]['rating1'](false);
            this.checkHover()[0]['rating2'](false);
            this.checkHover()[0]['rating3'](false);
            this.checkHover()[0]['rating4'](false);
            this.checkHover()[0]['rating5'](false);
        },
    });

});