import "./bootstrap";

import $ from "jquery";
window.$ = window.jQuery = $;

import "bootstrap/dist/js/bootstrap.bundle.min.js";

import "overlayscrollbars/js/OverlayScrollbars.min.js";
import "admin-lte/dist/js/adminlte.min.js";

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
