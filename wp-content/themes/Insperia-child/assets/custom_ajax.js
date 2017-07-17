/**
 * Created by yailet on 16-Jul-17.
 */
jQuery(function($) {
    "use strict";

    $('.testimonial-filter li').on('click', function(){
        var $this = $(this), $terms = $this.closest('.testimonials-wrapper'), $termsFilter= $this.closest('.testimonial-filter').find('li'), $termsList = $terms.find('.testimonials-content');

        $termsList.addClass('ic-ajaxing');
        $termsFilter.removeClass('active');
        $this.addClass('active');

        var termData = {
            'action'    : '__call_filter_testimonial_terms',
            'term'      : $this.attr('data-term'),
            'columns'   : $termsList.attr('data-columns')
        };
        var ajaxurl = ic_theme_ajax.ajax;
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: termData,
            success: function (response) {
                $termsList.removeClass('ic-ajaxing');
                $termsList.html( response );
            },
            error : function(){
                alert ('error');
            }
        });
    });
});