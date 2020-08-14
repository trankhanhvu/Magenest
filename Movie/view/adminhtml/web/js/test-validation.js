define([
    'jquery',
    'moment'
], function ($, moment) {
    'use strict';

    return function (validator) {

        validator.addRule(
            'test-validation',
            function (value, params, additionalParams) {
                return value !== "hello";
            },
            $.mage.__("Sorry, you don't have the age to purchase the current articles.")
        );

        return validator;
    };
});
