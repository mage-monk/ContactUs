define([
    'jquery'
], function ($) {
    'use strict';

    return function (config, element) {
        $(config.select, element).on('change', function () {
            $(config.container, element).show();
        });
    };
});
