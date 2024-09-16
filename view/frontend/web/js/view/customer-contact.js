define([
    'uiComponent',
    'Magento_Customer/js/model/customer',
    'mage/translate',
    'mage/url'
], function (Component, customer, $t, urlBuilder) {
    'use strict';

    return Component.extend({
        contactUrl: urlBuilder.build('customer_contact'),

        /**
         * Checks if customer is logged in
         *
         * @returns {Boolean}
         */
        isLoggedIn: function () {
            return customer.isLoggedIn();
        },

        /**
         * Gets label
         *
         * @returns {String}
         */
        getLabel: function () {
            return $t('Account Query');
        },

        /**
         * Gets customer contact url
         *
         * @returns {String}
         */
        getContactUrl: function () {
            return this.contactUrl;
        }
    });
});
