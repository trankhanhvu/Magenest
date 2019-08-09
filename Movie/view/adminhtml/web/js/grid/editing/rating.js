define([
    'Magento_Ui/js/grid/editing/record'
], function (Record) {
    'use strict';

    return Record.extend({
        defaults: {
            templates: {
                fields: {
                    // Add tag element
                    rating: {
                        template: 'Magenest_Movie/form/elements/rating',
                    }
                }
            },
        },
    });
});