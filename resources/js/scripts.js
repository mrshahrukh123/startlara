/*!
    * Start Bootstrap - SB Admin v6.0.1 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    $('.list-datatables').on('click','.confirm_delete', function(e) {
        e.preventDefault();
        if(confirm('Are you sure you want to delete ?')) {
            $("#delete_form_"+$(this).data("id")).submit();
        }
    });
    /**
     * add class to datatable select entries list
     */
    $('.dataTables_length').addClass('dd-holder dd-holder-xs');
    /**
     * delete confirmation
     *
     *
     */
    $('.list-datatables').on('click','.confirm_delete', function(e) {
        e.preventDefault();
        if(confirm('Are you sure you want to delete ?')) {
            $("#delete_form_"+$(this).data("id")).submit();
        }
    });
    /**
     * enable tooltip
     *
     */
    $('.list-datatables').tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    $('.simple-select').select2();
    $(".sorting-trigger").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
})(jQuery);
