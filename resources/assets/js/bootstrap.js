window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

// Set ajax to send CSRF token each time
$.ajaxPrefilter(function (options) {
    if (!options.beforeSend) {
        options.beforeSend = function (xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', Laravel.csrfToken);
        }
    }
});