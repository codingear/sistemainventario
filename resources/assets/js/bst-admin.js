(function($) {
    'use strict'; // Start of use strict

   // Toggle the side navigation
    let sidebarState = sessionStorage.getItem('sidebar');
    $(".sidebar").toggleClass(sidebarState);

    $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            sessionStorage.setItem('sidebar', 'toggled');
            $('.sidebar .collapse').collapse('hide');
        } else {
            sessionStorage.setItem('sidebar', '');
        };
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function() {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
            $('.sidebar').addClass('toggled');
        }
        if ($(window).width() >= 768) {
            $('.sidebar').removeClass('toggled');
        }
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(
        e
    ) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });


    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(e) {
        var $anchor = $(this);
        $('html, body')
            .stop()
            .animate(
                {
                    scrollTop: $($anchor.attr('href')).offset().top,
                },
                1000,
                'easeInOutExpo'
            );
        e.preventDefault();
    });
})(jQuery); // End of use strict


