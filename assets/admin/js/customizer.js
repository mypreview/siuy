/**
 * Theme Customizer enhancements for a better user experience.
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @author      Mahdi Yazdani
 * @package     Siuy
 * @since       1.1.0
 */
(function(window, $, undefined) {
    "use strict";
    // Update site title
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });
    // Update site tagline content
    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });
    // Hide site tagline
    wp.customize('siuy_toggle_site_tagline', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-description').css({
                    'clip': 'auto',
                    'position': 'relative'
                });
            }
        });
    });
    // Header text color.
    wp.customize('header_textcolor', function(value) {
        value.bind(function(to) {
            if ('blank' === to) {
                $('.site-title, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title, .site-description').css({
                    'clip': 'auto',
                    'position': 'relative'
                });
                $('.site-title a, .site-description').css({
                    'color': to
                });
            }
        });
    });
    /**
     * "Layout" section
     * General Layout
     *
     * @since 1.1.0
     */
    wp.customize('siuy_layout_sidebar', function(value) {
        value.bind(function(to) {
            if ('left-sidebar' === to && ! $('body').hasClass('no-sidebar')) {
                $('body').removeClass('right-sidebar');
                $('body').addClass('left-sidebar');
            } else if ('right-sidebar' === to && ! $('body').hasClass('no-sidebar')) {
                $('body').removeClass('left-sidebar');
                $('body').addClass('right-sidebar');
            }
        });
    });
})(this, jQuery);