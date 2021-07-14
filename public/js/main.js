$(function() {
    "use strict";
    feather.replace(), $(".nav-toggler").on("click", function() {
        $("#main-wrapper").toggleClass("show-sidebar"), $(".nav-toggler i").toggleClass("ti-menu")
    }), $(function() {
        $(".service-panel-toggle").on("click", function() {
            $(".customizer").toggleClass("show-service-panel")
        }), $(".page-wrapper").on("click", function() {
            $(".customizer").removeClass("show-service-panel")
        })
    }), $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    }), $(function() {
        $('[data-toggle="popover"]').popover()
    }), $(".message-center, .customizer-body, .scrollable, .scroll-sidebar").perfectScrollbar({
        wheelPropagation: !0
    }), $("body, .page-wrapper").trigger("resize"), $(".page-wrapper").delay(20).show(), $(".list-task li label").click(function() {
        $(this).toggleClass("task-done")
    }), $(".show-left-part").on("click", function() {
        $(".left-part").toggleClass("show-panel"), $(".show-left-part").toggleClass("ti-menu")
    }), $(".custom-file-input").on("change", function() {
        var e = $(this).val();
        $(this).next(".custom-file-label").html(e)
    })

    var setsidebartype = function () {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        if (width < 1170) {
            $("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
            $("#main-wrapper").addClass("mini-sidebar");
        } else {
            $("#main-wrapper").attr("data-sidebartype", "full");
            $("#main-wrapper").removeClass("mini-sidebar");
        }
    };
    setsidebartype()
    $(window).on("resize", setsidebartype);

    //****************************
    /* Top navbar Theme Change function Start */
    //****************************
    function handlenavbarbg() {
        if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
            // do this
            $(".topbar .navbar").addClass('navbar-light');
            $(".topbar .navbar").removeClass('navbar-dark');
        } else {
            // do that

        }
        $('.theme-color .theme-item .theme-link').on("click", function () {
            var navbarbgskin = $(this).attr("data-navbarbg");
            $('#main-wrapper').attr("data-navbarbg", navbarbgskin);
            $('.topbar .navbar-collapse').attr("data-navbarbg", navbarbgskin);
            if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
                // do this
                $(".topbar .navbar").addClass('navbar-light');
                $(".topbar .navbar").removeClass('navbar-dark');
            } else {
                // do that
                $(".topbar .navbar").removeClass('navbar-light');
                $(".topbar .navbar").addClass('navbar-dark');
            }
        });

    };
    handlenavbarbg();
});
