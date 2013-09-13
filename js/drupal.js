(function ($) {

    // Tweak the proportions of teaser image to teaser text. This should be moved to the templating layer instead.

    var hasLeftNavigation = $('.campl-tertiary-navigation').length > 0;
    var hasSidebar = $('.campl-secondary-content').length > 0;

    if (!(hasLeftNavigation && hasSidebar)) {
        $('.campl-horizontal-teaser-img').parent('.campl-column6').each(function () {
            var columns;
            if ((!hasLeftNavigation && !hasSidebar)) {
                columns = 3;
            } else {
                columns = 4;
            }
            $(this).removeClass('campl-column6').addClass('campl-column' + columns);
        });
        $('.campl-horizontal-teaser-txt').parent('.campl-column6').each(function () {
            var columns;
            if ((!hasLeftNavigation && !hasSidebar)) {
                columns = 9;
            } else {
                columns = 8;
            }
            $(this).removeClass('campl-column6').addClass('campl-column' + columns);
        });
    }

})(jQuery);
