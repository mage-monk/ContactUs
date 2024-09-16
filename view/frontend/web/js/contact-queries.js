
define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('magemonk.contactQueries', {
        options: {
            cardTypesSelector: '[data-role="card-type"]',
            queriesSelector: '[data-role="query"]',
            subQueriesSelector: '[data-role="subquery"]',
            cardTypes: {
                items: [],
                totalRecords: 0
            },
            queries: {
                items: [],
                totalRecords: 0
            },
            defaultFieldsConfiguration: {}
        },

        /**
         * Widget initialization function
         *
         * @private
         */
        _create: function () {
            this._bind();
        },

        /**
         * Bind widget
         *
         * @private
         */
        _bind: function () {
            let self = this,
                $cardTypes = self.element.find(this.options.cardTypesSelector),
                $queries = self.element.find(this.options.queriesSelector),
                $subQueries = self.element.find(this.options.subQueriesSelector);

            $cardTypes.on('change', function () {
                let value = $(this).val(),
                    currentQueries = self.options.queries.items.filter(function (el) {
                    return el['card_type_id'] === value;
                });

                self._updateSelect($queries, currentQueries);
                self._updateSelect($subQueries, []);
                //self._updateRequiredFields();
            });

            $queries.on('change', function () {
                let value = $(this).val(),
                    currentQuery = self.options.queries.items.find(function (el) {
                        return el['entity_id'] === value;
                    });

                if (!currentQuery) {
                    //self._updateRequiredFields();
                    self._updateSelect($subQueries, []);
                    return;
                }
                self._updateSelect($subQueries, currentQuery.children);
                $subQueries.closest('.subquery').show();
                //self._updateRequiredFields(currentQuery);
            });

            $subQueries.on('change', function () {
                let queryValue = $queries.val(),
                    value = $(this).val(),
                    currentQuery = self.options.queries.items.find(function (el) {
                        return el['entity_id'] === queryValue;
                    }),
                    currentSubQuery = currentQuery.children.find(function (el) {
                        return el['entity_id'] === value;
                    });

                if (!currentSubQuery) {
                    self._updateRequiredFields();
                    return;
                }
                self._updateRequiredFields(currentSubQuery);
            });
            $cardTypes.trigger('change');
            $queries.trigger('change');
        },

        /**
         * @param {jQuery} $element
         * @param {Integer} values
         * @private
         */
        _updateSelect: function ($element, values) {
            $element.find('option:not([disabled])').remove();
            $element.prop('selectedIndex', '');

            $.each(values, function (index, value) {
                $element.append(`<option value="${value['entity_id']}">${value['title']}</option>`);
            });
        },

        /**
         * @param {Array} config
         * @private
         */
        _updateRequiredFields: function (config) {

            const regex = /^is_(.*)_mandatory$/;

            if (this.element.validation) {
                this.element.validation('clearError');
            }

            config = config || this.options.defaultFieldsConfiguration;

            $.each(config, function (index, item) {
                let matches = index.match(regex),
                    $element, $parent;
                const required = item === '1';

                if (!matches) {
                    return;
                }

                $element = $(`[id="${matches[1]}"]`);
                if (!$element.length) {
                    return;
                }

                $parent = $element.parents('.field');

                const metadata = $element.data('metadata');

                if (metadata) {
                    metadata.validate.required = required;
                }

                $parent.toggleClass('required', required);
            });
        }
    });

    return $.magemonk.contactQueries;
});
