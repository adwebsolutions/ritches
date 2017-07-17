/**
 * Created by yailet on 14-Jul-17.
 */
jQuery(function($) {
    $('.navbar-nav .dropdown').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();

    });

    $('.navbar-nav .dropdown > a').click(function(){
        location.href = this.href;
    });
});